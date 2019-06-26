<?php

namespace App\Http\Controllers\Index\Index;

use App\Http\Model\ArticleClassModel;
use App\Http\Model\ArticleDetailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ArticleController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = Config::get('sys_conf.web_title');
        $this->ret_data['nav'] = '';
    }
    public function Index(Request $request,$ac_id){
        $page = $request->input('page',1); //页码
        $article = ArticleClassModel::getListArticle($ac_id);
        $article['self'] = array_merge($article['self'],ArticleDetailModel::getDetailArticle($ac_id,$page));

        foreach ($article['other'] as $key => $vo) {
            $article['other'][$key]['list'] = ArticleDetailModel::getDetailArticle($vo['ac_id']);
        }
        return view('Index.Index.article_list',array_merge($this->ret_data,compact('article','page')));
    }

    public function Detail($ac_id,$id){
        $article = ArticleClassModel::getArticleDetail($ac_id,$id);
//        echo "<pre>";
//        var_dump($article);
//        echo "</pre>";
//        return;
        return view('Index.Index.article_detail',array_merge($this->ret_data,compact('article')));
    }

}
