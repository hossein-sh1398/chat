<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Group;
use App\Enums\GroupRole;
use App\Enums\GroupType;
use App\Models\GroupMessage;
use App\Utility\FileManager;
use Illuminate\Http\Request;
use App\Events\GroupMessageEvent;
use App\Http\Controllers\Controller;
use App\Events\DeleteMessageGroupEvent;
use App\Utility\UploadFile\GroupAvatar;
use App\Http\Requests\Admin\GroupRequest;
use Symfony\Component\HttpFoundation\Response;

class GroupChannelController extends Controller
{
    public function __construct($enableAuthorize = true)
    {
        parent::__construct($enableAuthorize);
    }

    /**
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function sendMessage(Request $request, Group $group)
    {
        $this->validate($request, [
            'file' => 'nullable|max:5120',
        ]);

        if (!$group->users->contains(auth()->id())) {
            return response()->json([
                'status' => false,
            ]);
        }

        $isAdmin = auth()
            ->user()
            ->isAdminInGroup($group);

        if ($group->type == GroupType::Channel && !$isAdmin) {
            return response()->json([
                'status' => false,
            ]);
        }

        $message = GroupMessage::create([
            'from_id' => auth()->id(),
            'group_id' => $group->id,
            'message' => $request->get('message') ?? '',
        ]);

        if ($request->hasFile('file')) {
            (new ChatController())->uploadChatMedia($request, $message);
        }

        foreach ($group->users->where('id', '!=', auth()->id()) as $user) {
            event(new GroupMessageEvent($group, $user, $message));
        }

        $canDelete = $isAdmin;

        $view = $group->type == GroupType::Group ? 'group' : 'channel';

        return response()->json([
            'status' => true,
            'message' => view(
                "admin.pages.chat.{$view}.in-message",
                compact('message', 'canDelete')
            )->render(),
        ]);
    }

    /**
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function getMessages(Request $request, Group $group)
    {
        if (!$group->users->contains(auth()->id())) {
            return response()->json([
                'status' => false,
            ]);
        }

        $group->load('users');

        $lists = GroupMessage::where([
            'group_id' => $group->id,
        ])
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->sortBy('id');

        $users = User::whereNotIn('id', [auth()->id(), $group->user_id])->get();

        $groupUsers = $group->users->whereNotIn('id', [
            auth()->id(),
            $group->user_id,
        ]);

        $canDelete = auth()
            ->user()
            ->isAdminInGroup($group);

        $view = $request->query('page') == 1 ? 'messages' : 'message';

        $type = $group->type == GroupType::Group ? 'group' : 'channel';

        return response()->json(
            [
                'status' => true,
                'html' => view(
                    "admin.pages.chat.$type.$view",
                    compact(
                        'lists',
                        'group',
                        'canDelete',
                        'groupUsers',
                        'users'
                    )
                )->render(),
            ],
            200
        );
    }

    /**
     *
     * @param GroupRequest $request
     * @return void
     */
    public function make(GroupRequest $request)
    {
        try {
            $group = auth()
                ->user()
                ->createdGroups()
                ->create($request->only('username', 'type', 'title'));

            if ($request->hasFile('photo')) {
                $fm = new FileManager();

                $fm->uploadWay(new GroupAvatar($request->file('photo')));

                $fm->upload();

                $group->avatar()->create($fm->getFileInfo());
            }

            $list = [];
            $list[auth()->id()] = ['role' => GroupRole::Admin];

            foreach ($request->get('users') as $userId) {
                $list[$userId] = ['role' => GroupRole::User];
            }

            $group->users()->sync($list);

            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     *
     * @param GroupMessage $group_message
     * @return void
     */
    public function deleteMessage(GroupMessage $group_message)
    {
        try {
            $canDelete = auth()
                ->user()
                ->isAdminInGroup($group_message->group);

            if (!$canDelete) {
                throw new Exception('شما قادر به حذف پیام ها نمی باشید');
            }

            if (!$group_message->message) {
                if ($group_message->image) {
                    FileManager::delete(
                        $group_message->image->url .
                            '/' .
                            $group_message->image->name
                    );

                    $group_message->image()->delete();
                } elseif ($group_message->audio) {
                    FileManager::delete(
                        $group_message->audio->url .
                            '/' .
                            $group_message->audio->name
                    );

                    $group_message->audio()->delete();
                } elseif ($group_message->video) {
                    FileManager::delete(
                        $group_message->video->url .
                            '/' .
                            $group_message->video->name
                    );

                    $group_message->video()->delete();
                } elseif ($group_message->otherMedia) {
                    FileManager::delete(
                        $group_message->otherMedia->url .
                            '/' .
                            $group_message->otherMedia->name
                    );

                    $group_message->otherMedia()->delete();
                }
            }

            $group_message->delete();

            event(new DeleteMessageGroupEvent($group_message));

            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     *
     * @param GroupRequest $request
     * @param Group $group
     * @return void
     */
    public function update(GroupRequest $request, Group $group)
    {
        try {
            if (
                !auth()
                    ->user()
                    ->isAdminInGroup($group)
            ) {
                throw new Exception('شما قادر به ویرایش گروه نمی باشید');
            }

            $group->update($request->only('title'));

            if ($request->hasFile('photo')) {
                $fm = new FileManager();

                if ($group->avatar) {
                    FileManager::delete(
                        $group->avatar->url . '/' . $group->avatar->name
                    );

                    $group->avatar->delete();
                }

                $fm->uploadWay(new GroupAvatar($request->file('photo')));

                $fm->upload();

                $group->avatar()->create($fm->getFileInfo());
            }

            $users = $request->get('users');

            $users = User::with('groups')
                ->whereIn('id', $users)
                ->get();

            $list = [];
            foreach ($users as $user) {
                $userGroup = $user->groups->where('id', $group->id)->first();

                $list[$user->id] = [
                    'role' => $userGroup
                        ? $userGroup->pivot->role
                        : GroupRole::User,
                ];
            }

            $list[auth()->id()] = ['role' => GroupRole::Admin];

            if (auth()->id() != $group->user_id) {
                $list[$group->user_id] = ['role' => GroupRole::Admin];
            }

            $group->users()->sync($list);

            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     *
     * @param User $user
     * @param Group $group
     * @return void
     */
    public function removeUser(User $user, Group $group)
    {
        if (
            !auth()
                ->user()
                ->isAdminInGroup($group) ||
            $group->user_id == $user->id
        ) {
            return response()->json(
                [
                    'status' => false,
                    'message' =>
                        'کاربر گرامی شما مجاز به انجام عملیات مورد نظر نمی باشید',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $group->users()->detach($user->id);

        return response()->json(
            [
                'status' => true,
                'message' => 'کاربر مد نظر حذف گردید',
            ],
            Response::HTTP_OK
        );
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function getInfoSetting(Request $request)
    {
        $group = Group::with('users')->findOrFail($request->get('groupId'));

        if (
            auth()
                ->user()
                ->isAdminInGroup($group)
        ) {
            $users = User::whereNotIn('id', [
                auth()->id(),
                $group->user_id,
            ])->get();

            $groupUsers = $group->users->whereNotIn('id', [
                auth()->id(),
                $group->user_id,
            ]);

            return response()->json([
                'status' => true,
                'html' => view(
                    'admin.pages.chat.group.modal.setting-modal-content',
                    compact('users', 'group', 'groupUsers')
                )->render(),
            ]);
        }
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function manageRole(Request $request)
    {
        try {
            $group = Group::with('users')->findOrFail($request->get('groupId'));

            $user = User::findOrFail($request->get('userId'));

            if (
                !auth()
                    ->user()
                    ->isAdminInGroup($group) ||
                $group->user_id == $user->id ||
                !$group->users->contains($user->id)
            ) {
                throw new Exception(
                    'شما قادر به تغییر دسترسی کاربران گروه نمی باشید'
                );
            }

            $group->users()->detach($user->id);

            $role = [
                'role' => $request->boolean('isAdmin')
                    ? GroupRole::Admin
                    : GroupRole::User,
            ];

            $group->users()->attach($user->id, $role);

            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
