<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class HelpClassModel extends Model
{
    protected $table = 'help_class';

    /**
     * 获取分类
     * @return array
     */
    public static function getList(){
        $res = self::where('is_del',0)->orderby('hc_id','asc')->select('hc_id','hc_name','parent_id')->get()->toArray();
        $res2 = $res;
        //格式化数据
        $new_res = array();
        foreach ($res as $k => $v) {
            $parent_ids = [];
            $parent_ids[$v['hc_id']] = 0;
            if($v['parent_id']==0){
                $v['hc_name_format'] = $v['hc_name'];
                $new_res[] = $v;
            }
            foreach ($res2 as $k2 => $v2) {
                if($v2['parent_id']!=0 && in_array($v2['parent_id'],array_keys($parent_ids),true)){
                    $parent_ids[$v2['hc_id']] = $parent_ids[$v2['parent_id']]+1;
                    $i = $parent_ids[$v2['hc_id']];
                    $nbsp = '';
                    while($i){
                        $nbsp .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        $i--;
                    }
                    $v2['hc_name_format'] = $nbsp.'|----'.$v2['hc_name'];
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
            'hc_name'=>$name,
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
        return self::where('hc_id',$id)->update([
            'parent_id'=>$parent_id,
            'hc_name'=>$name,
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

        $id_list = self::where('parent_id',$id)->pluck('hc_id')->toArray();
        $del_list = array_merge($del_list,$id_list);

        while($id_list){
            $id_list = self::whereIn('parent_id',$id_list)->pluck('hc_id')->toArray();
            if($id_list){
                $del_list = array_merge($del_list,$id_list);
            }
        }

        return self::whereIn('hc_id',$del_list)->update([
            'is_del'=>1,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }

    public static function getLeftNav(){
        $res = self::where('is_del',0)->where('parent_id',0)->get()->toArray();
        foreach ($res as $key => $vo) {
            $res[$key]['list'] = HelpDetailModel::where('hc_id',$vo['hc_id'])->where('on_show',1)->where('is_del',0)->orderby('order','desc')->get()->toArray();
        }
        return $res;
    }
}
