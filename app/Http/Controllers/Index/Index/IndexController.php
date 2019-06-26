<?php

namespace App\Http\Controllers\Index\Index;


use App\Http\Controllers\Controller;
use App\Http\Model\ArticleClassModel;
use App\Http\Model\ArticleDetailModel;
use Illuminate\Support\Facades\Config;


class IndexController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = Config::get('sys_conf.web_title');
        $this->ret_data['nav'] = '';
    }
    public function Index(){
        $article = ArticleClassModel::getListIndex();
        foreach ($article as $key => $vo) {
            $article[$key]['list'] = ArticleDetailModel::getDetailIndex($vo['ac_id']);
        }

        return view('Index.Index.index',array_merge($this->ret_data,compact('article')));
    }
}
