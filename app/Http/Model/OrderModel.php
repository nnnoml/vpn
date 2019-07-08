<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'order_flow';

    public static function getOrderList($u_id){
        $self = new self();
        $self_table = $self->getTable();
        $product = new ProductModel();
        $product_table = $product->getTable();

        $res = $self->from("$self_table as o")
            ->leftJoin("$product_table as p",'p.p_id','o.p_id')
            ->where('o.u_id',$u_id)
            ->select('o.*','p.desc')
            ->get();
        return $res;
    }
}
