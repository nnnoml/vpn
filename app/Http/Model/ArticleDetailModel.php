<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleDetailModel extends Model
{
    protected $table = 'article_detail';

    public static function getList($page,$limit){
        $self = new self();
        $self_table = $self->getTable();
        $article_class = new ArticleClassModel();
        $article_class_table = $article_class->getTable();

        $res = $self->from("$self_table as d")
            ->leftJoin("$article_class_table as c",'c.ac_id','d.ac_id')
            ->select('d.*','c.ac_name')
            ->where('d.is_del',0);

        $ret['count'] = $res->count();
        $ret['list'] = $res->skip($limit*($page-1))->take($limit)->orderBy('d.id','desc')->get()->toArray();

        return $ret;
    }

    public static function getInfo($id){
        return self::where('is_del',0)->where('id',$id)->first();
    }

    public static function addDetail($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }

    public static function updateDetail($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id',$id)->update($data);
    }

    public static function deleteDetail($id){
        return self::where('id',$id)->update([
            'is_del'=>1,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 首页文章列表
     */
    public static function getDetailIndex($p_id){
        return self::where('ac_id',$p_id)->where('on_show',1)->where('is_del',0)
                    ->select('id','ac_id','title','created_at')->orderby('order','desc')->take(6)->get()->toArray();
    }

    public static function getDetailArticle($p_id,$page=0){
        $res = self::where('ac_id',$p_id)->where('on_show',1)->where('is_del',0);

        if($page==0){
            return $res->select('id','ac_id','title','created_at')->orderby('order','desc')->orderby('id','desc')->take(5)->get()->toArray();
        }
        else{
            $limit=6;
            $ret['count'] = $res->count();
            $ret['list'] = $res->skip($limit*($page-1))->take($limit)->orderby('order','desc')->orderby('id','desc')->get()->toArray();
            return $ret;
        }
    }

    public static function addCount($id){
        self::where('id',$id)->increment('view_count');
    }
}
