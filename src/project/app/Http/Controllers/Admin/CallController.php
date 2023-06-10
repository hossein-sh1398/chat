<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\UserChat;
use App\Events\VideoAudioCallEvent;
use Illuminate\Http\Request;
use App\Events\CloseVideoAudioCallEvent;
use App\Events\AcceptCallEvent;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\Response;

class CallController extends Controller
{
    public function __construct($enableAuthorize = true)
    {
        parent::__construct($enableAuthorize);
    }

    /**
     * Get Peer id for call
     *
     * @param Request $request
     * @return void
     */
    public function getPeerId(Request $request)
    {
        try {
            $user = User::findOrFail($request->get('userId'));

            if ($user->isCalling()) {
                throw new Exception("در حال مکالمه می باشد $user->name");
            }

            if (!$user->chatStatus && !$user->chatStatus->peer_id) {
                throw new Exception(
                    "در حال حاضر تماس با $user->name امکان پذیر نمی باشد"
                );
            }

            event(
                new VideoAudioCallEvent($user, $request->boolean('_isVideo'))
            );

            return response()->json([
                'status' => true,
                'peerId' => $user->chatStatus->peer_id,
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_EXPECTATION_FAILED
            );
        }
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function storePeerId(Request $request)
    {
        $id = auth()->id();

        UserChat::updateOrCreate(
            ['user_id' => $id],
            [
                'peer_id' => $request->get('peerId'),
                'user_id' => $id,
            ]
        );

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function confirmedCall(Request $request)
    {
        $user = User::find($request->get('userId'));

        event(new AcceptCallEvent($user, $request->boolean('isVideoCall')));

        return response()->json(
            [
                'user' => $user,
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function endCall(Request $request)
    {
        event(
            new CloseVideoAudioCallEvent(
                User::find($request->query('user')),
                $request->boolean('isAnswer')
            )
        );

        return response()->json(
            [
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }

    public function setIsCalling(Request $request)
    {
        UserChat::whereIn('user_id', $request->only('from', 'to'))->update([
            'is_calling' => $request->boolean('value'),
        ]);

        return response()->json(
            [
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }
}
