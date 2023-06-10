<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class MenuShareProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('adminMenus', $this->getAdminMenus());
    }

    private function getAdminMenus(): array
    {
        return [
            [
                'permissions' => ['admin.index'],
                'title' => 'صفحه اصلی',
                'active' => 'admin',
                'icon' => 'home',
                'route' => '/admin',
                'sub' => []
            ],
            [
                'permissions' => ['admin.users.index', 'admin.roles.index', 'admin.permissions.index', 'admin.roles.access'],
                'title' => 'کاربران',
                'active' => '',
                'icon' => 'home',
                'route' => '/admin/users',
                'sub' => [
                    [
                        'permissions' => ['admin.users.index'],
                        'title' => 'مدیریت کاربران',
                        'active' => 'admin/users',
                        'icon' => 'home',
                        'route' => '/admin/users',
                        'sub' => []
                    ],
                    [
                        'permissions' => ['admin.roles.index'],
                        'title' => 'مدیریت دسته بندی کاربران',
                        'active' => 'admin/roles',
                        'icon' => 'home',
                        'route' => '/admin/roles',
                        'sub' => []
                    ],
                    [
                        'permissions' => ['admin.permissions.index',],
                        'title' => 'مدیریت دسترسی',
                        'active' => 'admin/permissions',
                        'icon' => 'home',
                        'route' => '/admin/permissions',
                        'sub' => []
                    ],
                    [
                        'permissions' => ['admin.roles.access'],
                        'title' => 'مدیریت سطوح دسترسی',
                        'active' => 'admin/access/roles',
                        'icon' => 'home',
                        'route' => '/admin/access/roles',
                        'sub' => []
                    ]
                ]
            ],
            [
                'permissions' => ['admin.index'],
                'title' => 'گفتگوها',
                'active' => 'admin/chat',
                'icon' => 'home',
                'route' => '/admin/chat',
                'sub' => []
            ],
            [
                'permissions' => ['admin.configs.index', 'admin.configs.mains', 'admin.profile.index'],
                'title' => 'بخش تنظیمات',
                'active' => '',
                'icon' => 'home',
                'route' => 'admin/configs',
                'sub' => [
                    [
                        'permissions' => ['admin.configs.mains'],
                        'title' => 'تنظیمات اصلی',
                        'active' => 'admin/primitive/configs',
                        'icon' => 'home',
                        'route' => '/admin/primitive/configs',
                        'sub' => []
                    ],
                    [
                        'permissions' => ['admin.configs.index'],
                        'title' => 'تنظیمات اختیاری',
                        'active' => 'admin/configs',
                        'icon' => 'home',
                        'route' => '/admin/configs',
                        'sub' => []
                    ],
                    // [
                    //     'title' => 'تنظیمات سئو',
                    //     'active' => 'admin/configs',
                    //     'icon' => 'home',
                    //     'route' => '/admin/configs',
                    //     'sub' => []
                    // ],
                    [
                        'permissions' => ['admin.profile.index'],
                        'title' => 'ویرایش پروفایل کاربری',
                        'active' => 'admin/profile/index',
                        'icon' => 'home',
                        'route' => '/admin/profile/index',
                        'sub' => []
                    ],
                ]
            ],
        ];
    }
}
