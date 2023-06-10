<?php

use App\Http\Middleware\Maintenance;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTwoStepAuth;
use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Middleware\RedirectIsActiveAccount;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\SubscribeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ShareScreenController;
use App\Http\Controllers\Admin\GroupChannelController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AccountVerificationController;
use App\Http\Controllers\Auth\TwoStepVerificationController;

Route::get('p', function () {
    auth()->loginUsingId(2);
});
Route::middleware(Maintenance::class)->group(function () {
    Route::get('/', function () {
        return view('site.index');
    })->name('home');
    //----------------- Authenticate Routes --------------------------
    Route::as('auth.')->group(function () {
        Route::prefix('register')
            ->controller(RegisterController::class)
            ->group(function () {
                Route::get('/', 'showForm')->name('register.form');
                Route::post('/', 'register')->name('register');
            });

        // Authentication Routes
        Route::prefix('login')
            ->controller(LoginController::class)
            ->group(function () {
                // auth with static password
                Route::get('/', 'loginForm')->name('login.form');
                Route::post('/', 'login')->name('login');

                // auth with one time password
                Route::prefix('otp')->group(function () {
                    Route::get('/', 'showFormOtp')->name('login.form.otp');
                    Route::post('/', 'sendCode')->name('login.send.code');
                    Route::prefix('verify')->group(function () {
                        Route::get('/', 'showVerifyForm')->name(
                            'login.verify.form'
                        );
                        Route::post('/', 'verify')->name('login.verify');
                    });
                });
            });

        //Two Step Authentication Routes
        Route::prefix('two/step/authentication')
            ->controller(TwoStepVerificationController::class)
            ->group(function () {
                Route::get('/', 'form')->name('two.step.authentication.form');
                Route::post('/', 'verify')->name(
                    'two.step.authentication.verify'
                );
            });

        //forgot-password
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::prefix('forgot')->group(function () {
                Route::get('/', 'showForm')->name('forgot.password.form');
                Route::post('/', 'send')->name('forgot.link');
            });
            Route::post('reset/password', 'update')->name('password.update');
        });

        // // Routes that require authentication
        Route::middleware('auth')->group(function () {
            Route::get('logout', [LoginController::class, 'logout'])->name(
                'logout'
            );

            // Verification Email Routes
            Route::prefix('account/verify')
                ->middleware(RedirectIsActiveAccount::class)
                ->controller(AccountVerificationController::class)
                ->group(function () {
                    Route::get('/notice', 'notice')->name(
                        'verification.notice'
                    );
                    Route::get('/resend/code', 'reSendCode')->name(
                        'account.verify.re.send.code'
                    );
                    Route::post('/finally', 'verify')->name('verify.account');
                });
        });
    });

    Route::prefix('reset/password')
        ->controller(ForgotPasswordController::class)
        ->group(function () {
            Route::get('/{token}', 'resetPassword')->name('password.reset');
        });

    //  ----------------- End Authenticate Routes ---------------------

    Route::get('news/letters/verify/email/{newsLetter}', [
        SubscribeController::class,
        'verifyEmail',
    ])->name('news.letters.verify.email');
});

// Begin Admin Routes

Route::prefix('admin')
    ->middleware(['auth', 'active.account', CheckTwoStepAuth::class])
    ->as('admin.')
    ->group(function () {
        // Start Dashboard routes
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });

        //Begin Chat Routes
        Route::prefix('chat')
            ->as('chat.')
            ->group(function () {
                //Begin Chat Routes
                Route::prefix('/')
                    ->controller(ChatController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');

                        Route::post(
                            '/user/{user}/message',
                            'sendMessage'
                        )->name('send.message');

                        Route::post('/users', 'users')->name('users');

                        Route::get(
                            '/user/{user}/messages/all',
                            'messages'
                        )->name('messages');

                        Route::post('/file/download', 'download')->name(
                            'download'
                        );

                        Route::post('/users/online', 'onlineUser')->name(
                            'users.online'
                        );

                        Route::post('/users/offline', 'offlineUser')->name(
                            'users.offline'
                        );
                    });
                //End Chat Routes

                // Begin Group Channel Routes
                Route::prefix('/groups')
                    ->controller(GroupChannelController::class)
                    ->group(function () {
                        Route::post('/make', 'make')->name('group.make');

                        Route::get(
                            '/{group}/messages/all',
                            'getMessages'
                        )->name('group.messages');

                        Route::post('/{group}/message', 'sendMessage')->name(
                            'group.send.message'
                        );

                        Route::delete(
                            '/messages/{group_message}/delete',
                            'deleteMessage'
                        )->name('group.message.delete');

                        Route::patch('/{group}/update', 'update')->name(
                            'group.update'
                        );

                        Route::get(
                            '/user/{user}/group/{group}/remove',
                            'removeUser'
                        )->name('remove.user.in.group');

                        Route::post('/info/setting', 'getInfoSetting')->name(
                            'group.modal.info.setting'
                        );

                        Route::post('/manage/role', 'manageRole')->name(
                            'group.toggle.role'
                        );
                    });

                // End Group Channel Routes

                // Begin Video/Audio Call Routes
                Route::prefix('/call')
                    ->controller(CallController::class)
                    ->group(function () {
                        Route::post('/peer/is/store', 'storePeerId')->name(
                            'store.peer.id'
                        );

                        Route::post('/fetch/peer-id', 'getPeerId')->name(
                            'get.peer.id'
                        );

                        Route::post('/confirmed', 'confirmedCall')->name(
                            'confirmed.call'
                        );

                        Route::get('/end', 'endCall')->name('end.call');

                        Route::post('/set/is/calling', 'setIsCalling')->name(
                            'set.is.calling'
                        );
                    });

                // End Video/Audio Call Routes

                // Begin Share Screen Routes
                Route::prefix('/share/screen')
                    ->controller(ShareScreenController::class)
                    ->group(function () {
                        Route::get('/show/button', 'showBtnShareScreen')->name(
                            'show.btn.share.screen'
                        );

                        Route::get('/start', 'startShareScreen')->name(
                            'share.screen.start'
                        );

                        Route::get('/stop', 'stopShareScreen')->name(
                            'share.screen.stop'
                        );
                    });

                // Begin Share Screen Routes
            });
        //End Chat Routes

        // Start Profile routes
        Route::prefix('/profile')
            ->as('profile.')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::post('verify/emailCode', 'verifyEmailCode')->name(
                    'verify.email.code'
                );
                Route::post('verify/email', 'verifyEmail')->name(
                    'verify.email'
                );
                Route::post('verify/mobile/code', 'verifyMobileCode')->name(
                    'verify.mobile.code'
                );
                Route::post('verify/mobile', 'verifyMobile')->name(
                    'verify.mobile'
                );
                Route::post('generate/QRCode', 'generateQRCode')->name(
                    'generate.QRCode'
                );
                Route::post('verify/google', 'verifyGoogle')->name(
                    'verify.google'
                );
                Route::post('update', 'update')->name('update');
                Route::post('active/two/step', 'activeTwoStep')->name(
                    'active.two.step'
                );
                Route::get(
                    'active/un/active/two/step/type',
                    'activeUnActiveTwoStepType'
                )->name('active.unactive.two.step.type');
            });
        // End Profile Routes

        //Start Users Routes
        Route::prefix('/users')
            ->as('users.')
            ->controller(UserController::class)
            ->group(function () {
                Route::get('/get', 'getUsers')->name('get');
                Route::delete('/multiple/destroy', 'multipleDestroy')->name(
                    'multiple.destroy'
                );
                Route::post(
                    '/change/multiple/status',
                    'changeMultipleStatus'
                )->name('change.multiple.status');
                Route::get('/{user}/change/status', 'changeStatus')->name(
                    'change.status'
                );
                Route::get('/export', 'export')->name('export');
            });
        Route::resource('users', UserController::class)->except('show');
        // End Users Routes

        //Start Roles Routes
        Route::prefix('/roles')
            ->controller(RoleController::class)
            ->as('roles.')
            ->group(function () {
                Route::get('/ajax', 'roles')->name('ajax');
                Route::delete('/multi/destroy', 'multipleDestroy')->name(
                    'multiple.destroy'
                );
                Route::post(
                    '/add/permissions/to/role',
                    'addPermissionsToRole'
                )->name('add.permissions.to.role');
                Route::get('/export', 'export')->name('export');
            });
        Route::resource('roles', RoleController::class)->except('show');
        Route::get('/access/roles', [RoleController::class, 'access'])->name(
            'roles.access'
        );
        // End Roles Routes

        //Start Permissions Routes
        Route::prefix('/permissions')
            ->controller(PermissionController::class)
            ->as('permissions.')
            ->group(function () {
                Route::get('/sync', 'sync')->name('sync');
                Route::get('/ajax', 'permissions')->name('ajax');
                Route::delete('/multiple/destroy', 'multipleDestroy')->name(
                    'multiple.destroy'
                );
                Route::get('/export', 'export')->name('export');
            });
        Route::resource('permissions', PermissionController::class)->except(
            'show'
        );
        // End Permissions Routes

        //Start Configs Routes
        Route::prefix('/configs')
            ->controller(ConfigController::class)
            ->as('configs.')
            ->group(function () {
                Route::delete('/multiple/destroy', 'deletes')->name(
                    'multiple.destroy'
                );
                Route::patch('/main/update', 'mainUpdate')->name('main.update');
            });
        Route::resource('configs', ConfigController::class)->except('show');
        Route::get('/primitive/configs', [
            ConfigController::class,
            'getMains',
        ])->name('configs.mains');

        // End Configs Routes

        /** this route must be the last */
        Route::get('reports/logs/viewer/{type?}', [
            ReportController::class,
            'logViewer',
        ])->name('logs.viewer');
        // End Reports Routes
    });
// End Admin Routes

// redirect after google two fa to previous route
Route::post('/2fa/2faVerify', function () {
    return redirect(URL()->previous());
})
    ->name('2faVerify')
    ->middleware('2fa');


use Illuminate\Support\Facades\Redis;
Route::get('test', function () {
    Redis::set('name', 'Taylor');
    $name = Redis::get('name');
    dd($name);
});
