<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleClassModel extends Model
{
    protected $table = 'article_class';

    /**
     * 获取分类
     * @return array
     */
    public static function getList(){
        $res = self::where('is_del',0)->orderby('ac_id','asc')->select('ac_id','ac_name','parent_id')->get()->toArray();
        $res2 = $res;
        //格式化数据
        $new_res = array();
        foreach ($res as $k => $v) {
            $parent_ids = [];
            $parent_ids[$v['ac_id']] = 0;
            if($v['parent_id']==0){
                $v['ac_name_format'] = $v['ac_name'];
                $new_res[] = $v;
            }
            foreach ($res2 as $k2 => $v2) {
                if($v2['parent_id']!=0 && in_array($v2['parent_id'],array_keys($parent_ids),true)){
                    $parent_ids[$v2['ac_id']] = $parent_ids[$v2['parent_id']]+1;
                    $i = $parent_ids[$v2['ac_id']];
                    $nbsp = '';
                    while($i){
                        $nbsp .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        $i--;
                    }
                    $v2['ac_name_format'] = $nbsp.'|----'.$v2['ac_name'];
                    $new_res[] = $v2;
                    unset($res2[$k2]);
                }
            }
        }
        return $new_res;
    }

    /**
     * 新增文章分类
     * @param $parent_id
     * @param $name
     * @return mixed
     */
    public static function addClass($parent_id,$name){
        return self::insert([
            'ac_name'=>$name,
            'parent_id'=>$parent_id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 修改文章分类
     * @param $id
     * @param $parent_id
     * @param $name
     * @return mixed
     */
    public static function updateClass($id,$parent_id,$name){
        return self::where('ac_id',$id)->update([
            'parent_id'=>$parent_id,
            'ac_name'=>$name,
            'updated_at'=>date('Y-m-d H:i:s')
            ]);
    }

    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public static function deleteClass($id){
        //查询出所有子类
        $del_list = [$id];

        $id_list = self::where('parent_id',$id)->pluck('ac_id')->toArray();
        $del_list = array_merge($del_list,$id_list);

        while($id_list){
            $id_list = self::whereIn('parent_id',$id_list)->pluck('ac_id')->toArray();
            if($id_list){
                $del_list = array_merge($del_list,$id_list);
            }
        }

        return self::whereIn('ac_id',$del_list)->update([
            'is_del'=>1,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 首页文章分类
     */
    public static function getListIndex(){
        return self::where('is_del',0)->where('parent_id',0)->select('ac_id','ac_name')->get()->toArray();
    }

    /**
     * 内页文章分类
     * @param $ac_id
     * @return array
     */
    public static function getListArticle($ac_id){
        $ret = [];
        $ret['self'] = self::where('is_del',0)->where('ac_id',$ac_id)->select('ac_id','ac_name')->first()->toArray();
        $ret['other'] = self::where('is_del',0)->where('ac_id','<>',$ac_id)->select('ac_id','ac_name')->get()->toArray();
        return $ret;
    }

    public static function getArticleDetail($ac_id,$id){
        $self = new self();
        $self_table = $self->getTable();
        $article_detail = new ArticleDetailModel();
        $article_detail_table = $article_detail->getTable();

        $ret['main'] = $self->from("$self_table as c")
            ->leftJoin("$article_detail_table as d",'d.ac_id','c.ac_id')
            ->where('d.id',$id)
            ->where('d.ac_id',$ac_id)
            ->where('d.on_show',1)
            ->where('d.is_del',0)
            ->select('d.*','c.ac_name')
            ->first()->toArray();

        $act_list = self::where('is_del',0)->select('ac_id','ac_name')->get()->toArray();

        foreach ($act_list as $key => $vo) {
            $act_list[$key]['list'] = ArticleDetailModel::getDetailArticle($vo['ac_id']);
        }
        $ret['right_nav'] = $act_list;
        return $ret;
    }
}
