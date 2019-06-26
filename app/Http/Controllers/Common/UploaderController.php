<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UploaderController extends Controller
{
    //TODO 整体过滤没做

    //{
    //    "code": 0 //0表示成功，其它失败
    //    ,"msg": "" //提示信息 //一般上传失败后返回
    //    ,"data": {
    //    "src": "图片路径"
    //    ,"title": "图片名称" //可选
    //    }
    //}

    public function img(Request $request,$type=''){

        if(!$request->hasFile('file')){
            $ret["code"] = 1;
            $ret["msg"] = '上传失败 文件不存在';
        }
        else if($request->file('file')->getSize()>1024*1024){
            $ret["code"] = 1;
            $ret["msg"] = '上传文件过大,最大允许1M';
        }
        else if(!in_array($type,['article','help'])){
            $ret["code"] = 1;
            $ret["msg"] = '上传失败 参数错误';
        }
        else{
            $img = $request->file('file');
            $mimeType = $img->getMimeType();

            if($mimeType != 'image/png' && $mimeType != 'image/jpeg') {
                $ret["code"] = 1;
                $ret["msg"] = '错误的 mimeType';
            }
            else{
                $path = $img->store(date('Ymd'),"img_$type");
                if($img->isValid()) {
                    $ret["code"] = 0;
                    $ret["msg"] = '上传成功';
                    $ret['data']['src'] = config("filesystems.disks.img_$type")['url'] . '/' . $path;
                }
                else{
                    $ret["code"] = 1;
                    $ret["msg"] = '上传失败';
                }
            }
        }
        return response()->json($ret);
    }

    public function itemContent(Request $request){
        if(!$request->hasFile('upfile')){
            echo "hasfile";
        }
        $img = $request->file('upfile');
        $path = $img->store(date('Ymd'),'item_content');
        if($img->isValid()){
            $ret["originalName"] = $img->getClientOriginalName();
            $ret["name"] = $path ;
            $ret["url"] = config('filesystems.disks.item_content')['url'] . '/' .$path ;
            $ret["size"] = $img->getClientSize();
            $ret["type"] = $img->getClientOriginalExtension();
            $ret["state"] = 'SUCCESS';
            echo json_encode($ret);
        }
    }

    public function apply(Request $request){
        if(!$request->hasFile('file')){
            echo "hasfile";
        }
        $img = $request->file('file');
        $path = $img->store(date('Ymd'),'apply');
        if($img->isValid()) {
            $ret["url"] = config('filesystems.disks.apply')['url'] . '/' . $path;
            $ret["state"] = 'SUCCESS';
            echo json_encode($ret);
        }
    }

}
