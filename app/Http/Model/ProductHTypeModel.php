<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ProductHTypeModel extends Model
{
    protected $table = 'product_h_type';


    public static function getList(){
        $res = self::get();
        return $res;
    }

    public static function add($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }

    public static function getDetail($id){
        $res = self::where('h_type_id',$id)->first();
        $res['price'] /=100;
        return $res;
    }

    public static function edit($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::where('h_type_id',$id)->update($data);
    }

    public static function del($id){
        $res = self::where('h_type_id',$id)->delete();
        return $res;
    }

    public static function getIndexList(){
        $res = self::where('on_show',1)->where('is_del',0)->get();
        return $res;
    }
}
