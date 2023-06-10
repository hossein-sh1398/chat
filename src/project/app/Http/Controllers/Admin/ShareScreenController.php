<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Events\ShareScreenEvent;
use Illuminate\Http\Request;
use App\Events\StopShareScreenEvent;
use App\Events\StartShareScreenEvent;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShareScreenController extends Controller
{
    public function __construct($enableAuthorize = true)
    {
        parent::__construct($enableAuthorize);
    }

    /**
     * show button share screen
     *
     * @param Request $request
     * @return void
     */
    public function showBtnShareScreen(Request $request)
    {
        event(
            new ShareScreenEvent(User::findOrFail($request->query('userId')))
        );

        return response()->json(
            [
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * start share screen
     *
     * @param Request $request
     * @return void
     */
    public function startShareScreen(Request $request)
    {
        event(new StartShareScreenEvent(User::findOrFail($request->query('userId'))));

        return response()->json(
            [
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * stop share screen
     *
     * @param Request $request
     * @return void
     */
    public function stopShareScreen(Request $request)
    {
        event(new StopShareScreenEvent(User::findOrFail($request->query('userId'))));

        return response()->json(
            [
                'status' => true,
            ],
            Response::HTTP_OK
        );
    }
}
