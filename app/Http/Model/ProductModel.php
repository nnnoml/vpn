<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';

    public static function getList(){
        $res = self::where('on_show',1)->where('is_del',0)->get();
        return $res;
    }

    public static function add($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }

    public static function getDetail($id){
        $res = self::where('on_show',1)->where('is_del',0)->where('p_id',$id)->first();
        $res['money'] /=100;
        $res['money_desc'] /=100;
        $res['money_asc'] /=100;
        return $res;
    }

    public static function edit($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::where('p_id',$id)->update($data);
    }

    public static function del($p_id){
        $res = self::where('p_id',$p_id)->update(['is_del'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
        return $res;
    }

    public static function getIndexList(){
        $res = self::where('on_show',1)->where('is_del',0)->get();
        return $res;
    }
}
