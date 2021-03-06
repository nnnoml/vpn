<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(userinfo::class);
        $this->call(product::class);
        $this->call(sys::class);
        $this->call(articleAndHelp::class);
    }
}
