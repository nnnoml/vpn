<?php

use Illuminate\Database\Seeder;

class order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('order_flow')->insert([
            'p_id' => 1,
            'u_id' => 1,
            'pay_type' => 1,
            'order_money'=>10000,
            'pay_money'=>9000,
            'order_money_change'=>-1000,
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
