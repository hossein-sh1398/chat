<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Group;
use App\Enums\GroupType;
use App\Models\UserChat;
use Illuminate\Support\Str;
use App\Models\ChatMessages;
use App\Utility\FileManager;
use Illuminate\Http\Request;
use App\Events\OnlineUserEvent;
use App\Events\PrivateChatMessage;
use App\Events\ChatSeenMessageEvent;
use App\Http\Controllers\Controller;
use App\Utility\UploadFile\ChatImage;
use App\Utility\UploadFile\ChatVideo;
use App\Utility\UploadFile\ChatAudioFile;
use App\Utility\UploadFile\ChatOtherMedia;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    public function __construct($enableAuthorize = true)
    {
        parent::__construct($enableAuthorize);
    }

    public function index()
    {
        $this->pageInfo->title = 'صفحه گفتگو';

        $groupTypes = GroupType::toArray();

        // Get users for create group/channel
        $userList = User::where('id', '!=', auth()->id())->get();

        // Get group and channel id for user
        $groupsIds = auth()
            ->user()
            ->groups->pluck('id')->toArray();

        return view(
            'admin.pages.chat.index',
            compact('groupTypes', 'userList', 'groupsIds')
        );
    }

    /**
     * send message between users
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function sendMessage(Request $request, User $user)
    {
        $this->validate($request, ['file' => 'nullable|max:5120',]);

        $message = ChatMessages::create([
            'from_id' => auth()->id(),
            'to_id' => $user->id,
            'message' => $request->get('message') ?? '',
            'seen' => $user->isSeen()
        ]);


        if ($request->hasFile('file')) {
            $this->uploadChatMedia($request, $message);
        }

        $countUnseen = ChatMessages::where([
            'from_id' => auth()->id(),
            'to_id' => $user->id,
            'seen' => false,
        ])->count();

        event(new PrivateChatMessage(countUnseen:$countUnseen, message:$message, user:$user,));

        return response()->json([
            'status' => true,
            'message' => view(
                'admin.pages.chat.in-message',
                compact('message')
            )->render(),
        ]);
    }

    /**
     * upload file
     *
     * @param Request $request
     * @param [type] $message
     * @return void
     */
    public function uploadChatMedia(Request $request, $message)
    {
        $fm = new FileManager();

        if (Str::contains($request->type, 'image/')) {
            $fm->uploadWay(new ChatImage($request->file('file')));

            $fm->upload();

            $info = $fm->getFileInfo();

            $message->image()->create($info);
        } elseif (Str::contains($request->type, 'video/')) {
            $fm->uploadWay(new ChatVideo($request->file('file')));

            $fm->upload();

            $info = $fm->getFileInfo();

            $message->video()->create($info);
        } elseif (Str::contains($request->type, 'audio/')) {
            $fm->uploadWay(new ChatAudioFile($request->file('file')));

            $fm->upload();

            $info = $fm->getFileInfo();

            $message->audio()->create($info);
        } else {
            $fm->uploadWay(new ChatOtherMedia($request->file('file')));

            $fm->upload();

            $info = $fm->getFileInfo();

            $message->otherMedia()->create($info);
        }
    }

    /**
     * get users for sidebar
     *
     * @return void
     */
    public function users(Request $request)
    {
        $users = User::withCount([
            'chatMessages as un_read_count' => function ($query) {
                $query->where(['to_id' => auth()->id(), 'seen' => false]);
            },
        ])
            ->with('chatStatus')
            ->where('id', '!=', auth()->id())
            ->orderByDesc('name')
            ->get();


        $groups = [];
        $channels = [];

        foreach (Group::get() as $value) {
            if (
                auth()
                    ->user()
                    ->groups->contains($value->id)
            ) {
                if ($value->type == GroupType::Group) {
                    $groups[] = $value;
                } else {
                    $channels[] = $value;
                }
            }
        }

        return response()->json(
            [
                'status' => true,
                'html' => view(
                    'admin.pages.chat.users',
                    compact('users', 'groups', 'channels')
                )->render(),
            ],
            200
        );
    }

    /**
     * Get Messages a user
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function messages(Request $request, User $user)
    {
        UserChat::updateOrCreate(
            ['user_id' => auth()->id()],
            ['active_user_id' => $user->id]
        );

        $peerId = UserChat::where('user_id', $user->id)->value('peer_id');

        ChatMessages::where([
            'from_id' => $user->id,
            'to_id' => auth()->id(),
            'seen' => false
        ])
        //
        ->update(['seen' => true]);

        $lists = ChatMessages::where(function ($query) use ($user) {
            $query->where([
                'from_id' => auth()->id(),
                'to_id' => $user->id,
            ]);
        })
            ->orWhere(function ($query) use ($user) {
                $query->where([
                    'from_id' => $user->id,
                    'to_id' => auth()->id(),
                ]);
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->sortBy('id');

        if ($user->isSeen()) {
            event(new ChatSeenMessageEvent($user));
        }

        $view = $request->query('page') == 1 ? 'messages' : 'message';

        return response()->json(
            [
                'status' => true,
                'peerId' => $peerId,
                'html' => view(
                    "admin.pages.chat.$view",
                    compact('user', 'lists')
                )->render(),
            ],
            200
        );
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function download(Request $request)
    {
        try {
            return FileManager::download($request->query('path'));
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
     * set status online user is true
     *
     * @param User $user
     * @return void
     */
    public function onlineUser()
    {
        UserChat::updateOrCreate(
            ['user_id' =>  auth()->id()],
            [
                'is_online' => true,
                'is_calling' => false,
                'active_user_id' => 0,
            ]
        );

        broadcast(new OnlineUserEvent(auth()->user(), true))->toOthers();
    }

    /**
     * set status online user is false
     *
     * @param User $user
     * @return void
     */
    public function offlineUser()
    {
        UserChat::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'is_online' => false,
                'is_calling' => false,
                'active_user_id' => 0,
            ]
        );

        broadcast(new OnlineUserEvent(auth()->user(), false))->toOthers();
    }
}
