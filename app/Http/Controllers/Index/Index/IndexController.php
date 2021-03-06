<?php

namespace App\Http\Controllers\Index\Index;

use App\Http\Model\ArticleClassModel;
use App\Http\Model\ArticleDetailModel;


class IndexController extends \App\Http\Controllers\Index\IndexController
{

    public function __construct()
    {
        $this->ret_data['title'] = '';
        $this->ret_data['nav'] = '';
    }
    public function Index(){
        $this->Init();
        $article = ArticleClassModel::getListIndex();
        foreach ($article as $key => $vo) {
            $article[$key]['list'] = ArticleDetailModel::getDetailIndex($vo['ac_id']);
        }

        return view('Index.Index.index',array_merge($this->ret_data,compact('article')));
    }
}
