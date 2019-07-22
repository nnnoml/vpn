<?php

use Illuminate\Database\Seeder;

class userinfo extends Seeder
{
    use \App\Http\Controllers\Common\Common;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('user')->insert([
            'account'=>'13111111111',
            'appkey'=>'asdfasdfasdf123',
            'pwd'=>$this->rc4('123456'),
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
