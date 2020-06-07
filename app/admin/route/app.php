<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use think\facade\Route;
use xiaodi\JWTAuth\Middleware\Jwt;
use app\admin\middleware\Permission;

Route::get('/', function () {
    return 'Hello,ThinkPHP6!';
});

Route::get('/hello', function () {
    return 'Hello,ThinkPHP6!';
});

Route::group('auth', function () use ($route) {
    $route->post('login', '@login');
    $route->post('logout', '@logout');
    $route->get('refresh_token', '@refreshToken');
})->prefix(\TAnt\App\Controller\Auth::class);

Route::group('permission', function () use ($route) {
    $route->get('', '@list')->middleware(Permission::class, 'PermissionGet');
    $route->post('', '@create')->middleware(Permission::class, 'PermissionAdd');
    $route->put(':id', '@update')->middleware(Permission::class, 'PermissionUpdate');
    $route->delete(':id', '@delete')->middleware(Permission::class, 'PermissionDelete');
})->prefix(\TAnt\App\Controller\Permission::class)->middleware(JWT::class);

Route::group('role', function () use ($route) {
    $route->get('', '@list', 'GET')->middleware(Permission::class, 'RoleGet');
    $route->post('', '@create', 'POST')->middleware(Permission::class, 'RoleAdd');
    $route->get('all$', '@all', 'GET');
    $route->put(':id$', '@update', 'PUT')->middleware(Permission::class, 'RoleUpdate');
    $route->delete(':id$', '@delete', 'DELETE')->middleware(Permission::class, 'RoleDelete');
})->prefix(\TAnt\App\Controller\Role::class)->middleware(JWT::class);

Route::group('user', function () use ($route) {
    $route->get('data', '@data');
    //获取 个人信息
    $route->get('current$', '@current');
    //更新 个人信息
    $route->put('current$', '@updateCurrent');
    //更新 头像
    $route->post('avatar$', '@avatar');
    //更新 密码
    $route->put('reset-password$', '@resetPassword');
    $route->get('', '@list')->middleware(Permission::class, 'AccountGet');
    $route->post('', '@create')->middleware(Permission::class, 'AccountAdd');
    $route->get('info$', '@info');
    $route->put(':id', '@update')->middleware(Permission::class, 'AccountUpdate');
    $route->delete(':id', '@delete')->middleware(Permission::class, 'AccountDelete');
})->prefix(\TAnt\App\Controller\User::class)->middleware(JWT::class);

Route::group('log', function () use ($route) {
    $route->get('account', '@list')->middleware(Permission::class, 'LogAccountGet');
    $route->delete('account', '@delete')->middleware(Permission::class, 'LogAccountDelete');
})->prefix(\TAnt\App\Controller\AccountLog::class)->middleware(JWT::class);

Route::group('log', function () use ($route) {
    $route->get('database', '@list')->middleware(Permission::class, 'LogAccountGet');
    $route->delete('database', '@delete')->middleware(Permission::class, 'LogAccountDelete');
})->prefix(\TAnt\App\Controller\DataBaseLog::class)->middleware(JWT::class);

Route::group('system', function () use ($route) {
    $route->get('dept', '@list')->middleware(Permission::class, 'DeptGet');
    $route->post('dept', '@create')->middleware(Permission::class, 'DeptAdd');
    $route->put('dept/:id', '@update')->middleware(Permission::class, 'DeptUpdate');
    $route->delete('dept/:id', '@delete')->middleware(Permission::class, 'DeptDelete');
})->prefix(\TAnt\App\Controller\Dept::class)->middleware(JWT::class);

Route::group('system', function () use ($route) {
    $route->get('/post', '@all')->middleware(Permission::class, 'PostGet');
    $route->post('/post', '@create')->middleware(Permission::class, 'PostAdd');
    $route->put('/post/:id', '@update')->middleware(Permission::class, 'PostUpdate');
    $route->delete('/post/:id', '@delete')->middleware(Permission::class, 'PostDelete');
})->prefix(\TAnt\App\Controller\Post::class)->middleware(JWT::class);

Route::group('article', function () use ($route) {
    $route->get('category', '@list');
    $route->post('category', '@create');
    $route->put('category/:id', '@update');
    $route->delete('category/:id', '@delete');
})->prefix(\TAnt\App\Controller\ArticleCategory::class)->middleware(JWT::class);

Route::group('article', function () use ($route) {
    $route->get('/', '@list');
    $route->get('/:id$', '@info');
    $route->post('/', '@create');
    $route->put('/:id', '@update');
    $route->delete('/:id', '@delete');
})->prefix(\TAnt\App\Controller\Article::class)->middleware(JWT::class);

Route::group('mock', function () use ($route) {
    $route->get('list/search/projects', '@projects');
    $route->get('workplace/activity', '@activity');
    $route->get('workplace/radar', '@radar');
    $route->get('workplace/teams', '@teams');
})->prefix(\TAnt\App\Controller\Mock::class);