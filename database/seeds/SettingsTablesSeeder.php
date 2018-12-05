<?php

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

class SettingsTablesSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'index_name' => 'user_init_password',
                'value' => '123456',
                'type' => 'text',
                'description' => '注册用户的初始密码'
            ],
            [
                'index_name' => 'is_open_seckill',
                'value' => 0,
                'type' => 'switch',
                'description' => '是否开始秒杀功能模块（需要配置好 redis）'
            ],
        ];

        $now = \Carbon\Carbon::now()->toDateTimeString();
        $settings = collect($settings)->map(function ($setting) use ($now) {

            $setting['created_at'] = $now;
            $setting['updated_at'] = $now;

            return $setting;
        });

        \App\Models\Setting::query()->insert($settings->all());
    }
}
