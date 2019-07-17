<?php

use Illuminate\Database\Seeder;

class sys extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('sys_admin')->insert([
            'account' => 'admin',
            'password' => sha1('123456'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        \Illuminate\Support\Facades\DB::table('sys_sms_log')->insert([
            'tel' => '13111111111',
            'code' => 123123,
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        \Illuminate\Support\Facades\DB::table('sys_conf')->insert([
            'title' => 'title',
            'keywords' => 'keywords',
            'description' => 'description',
            'qq' => 'qq',
            'tel' => 'tel',
            'icp' => 'icp',
            'comp_name' => 'comp_name',
            'comp_address' => 'comp_address',
            'logo' => '/index_src/img/new_index_logo2.png',
            'logo2' => '/index_src/img/new_index_logo.png',
            'wechat' => '/index_src/img/weiweiwei.png',
        ]);
    }
}
