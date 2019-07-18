<?php

use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('product')->insert([
            [
                'type'=>2,
                'h_type'=>1,
                'money'=>50000,
                'time_length'=>0,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'按次扣费 冲50',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>2,
                'h_type'=>1,
                'money'=>100000,
                'time_length'=>0,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'按次扣费 冲100',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>2,
                'h_type'=>1,
                'money'=>200000,
                'time_length'=>0,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'按次扣费 冲200',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>1,
                'h_type'=>0,
                'money'=>10000,
                'time_length'=>86400*30,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'按月购买',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>1,
                'h_type'=>0,
                'money'=>19000,
                'time_length'=>86400*60,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'双月购买',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>1,
                'h_type'=>0,
                'money'=>50000,
                'time_length'=>86400*180,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'半年购买',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type'=>1,
                'h_type'=>0,
                'money'=>90000,
                'time_length'=>86400*365,
                'h_type_id'=>'1,2,3,4,5',
                'desc'=>'全年购买',
                'on_show'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ]);

        \Illuminate\Support\Facades\DB::table('product_h_type')->insert([
            [
                'start_second'=>5*60,
                'end_second'=>25*60,
                'price'=>4,
                'created_at'=>date('Y-m-d H:i:s')
            ],[
                'start_second'=>25*60,
                'end_second'=>3*60*60,
                'price'=>10,
                'created_at'=>date('Y-m-d H:i:s')
            ],[
                'start_second'=>3*60*60,
                'end_second'=>6*60*60,
                'price'=>20,
                'created_at'=>date('Y-m-d H:i:s')
            ],[
                'start_second'=>6*60*60,
                'end_second'=>12*60*60,
                'price'=>50,
                'created_at'=>date('Y-m-d H:i:s')
            ],[
                'start_second'=>48*60*60,
                'end_second'=>72*60*60,
                'price'=>500,
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ]);
    }
}
