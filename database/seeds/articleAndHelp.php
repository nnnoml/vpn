<?php

use Illuminate\Database\Seeder;

class articleAndHelp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('article_class')->insert([
            'ac_name'=>'公司新闻',
            'is_del'=>0,
            'parent_id'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        \Illuminate\Support\Facades\DB::table('article_class')->insert([
            'ac_name'=>'行业新闻',
            'is_del'=>0,
            'parent_id'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        \Illuminate\Support\Facades\DB::table('article_detail')->insert([
            'ac_id'=>1,
            'title'=>'新闻111',
            'content'=>'<h1>asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        \Illuminate\Support\Facades\DB::table('article_detail')->insert([
            'ac_id'=>1,
            'title'=>'新闻222',
            'content'=>'<h1>222asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        \Illuminate\Support\Facades\DB::table('article_detail')->insert([
            'ac_id'=>2,
            'title'=>'新闻333',
            'content'=>'<h1>333asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

//-------------------------------help
        \Illuminate\Support\Facades\DB::table('help_class')->insert([
            'hc_name'=>'软件帮助',
            'is_del'=>0,
            'parent_id'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        \Illuminate\Support\Facades\DB::table('help_class')->insert([
            'hc_name'=>'套餐帮助',
            'is_del'=>0,
            'parent_id'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        \Illuminate\Support\Facades\DB::table('help_detail')->insert([
            'hc_id'=>1,
            'title'=>'帮助111',
            'content'=>'<h1>asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        \Illuminate\Support\Facades\DB::table('help_detail')->insert([
            'hc_id'=>1,
            'title'=>'帮助222',
            'content'=>'<h1>222asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        \Illuminate\Support\Facades\DB::table('help_detail')->insert([
            'hc_id'=>2,
            'title'=>'帮助333',
            'content'=>'<h1>333asdfasd<B>ddd</B>fasdf</h1>',
            'on_show'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
