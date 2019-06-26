<?php

namespace App\Http\Controllers\Task\Index;

use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskIndexController extends Task
{
//    use App\Http\Controllers\Task\Index\TaskIndexController;
//    use Hhxsv5\LaravelS\Swoole\Task\Task;
//    public function index(){
//
//        echo date('Y-m-d H:i:s');
//        $data['task_id'] = 0;
//        $data['task_url'] = 'http://vpns.com/do';
//        $data['task_params'] = json_encode(['aa'=>1,'bb'=>2,'cc'=>3]);
//
//        $task = new TaskIndexController($data);
//        $ret = Task::deliver($task);
//        echo "<br />";
//        var_dump($ret);//判断是否投递成功
//    }
//
//    public function do(){
//        sleep(10);
//        echo "ok";
//    }

    private $data;
    private $task_loop = true;//默认任务状态，
    private $result;
    public function __construct($data)
    {
        $this->data = $data;
    }
    // 处理任务的逻辑，运行在Task进程中，不能投递任务
    public function handle()
    {
        // throw new \Exception('an exception');// handle时抛出的异常上层会忽略，并记录到Swoole日志，需要开发者try/catch捕获处理

        $data = $this->data;
        Log::info(__CLASS__ . ':handle start', [$data]);

        //流程
        //通知频率 暂时不设置 每3秒通知一次 通知到死
        //按微信支付走 15s/15s/30s/3m/10m/20m/30m/30m/30m/60m/3h/3h/3h/6h/6h
        //入库
        $task_id = $data['task_id'];
        unset($data['task_id']);

        //直接通知
        $result=$this->httpGet($data['task_url']);
        if($result == 'ok'){//成功更换状态
            $this->task_loop = false;
            Log::info('success');
        }
        else{
            Log::info('error');
        }

        //新任务
        if($task_id == 0){
            $task_id = DB::table('task')->insertGetId($data);
            $this->data['task_id'] = $task_id;
        }
        //旧任务
        else{
            $exists = DB::table('task')->where('task_id',$task_id)->exists();
            //如果任务存在 更新
            if($exists){
                $res = DB::table('task')->where('task_id',$task_id)->update([
                    'created_at' =>date('Y-m-d H:i:s'),
                    'count' => DB::raw('count+1')
                ]);
            }
            //如果任务不见了 不再循环
            else{
                $this->task_loop = false;
            }
        }
//        Log::info($res);
    }
    // 可选的，完成事件，任务处理完后的逻辑，运行在Worker进程中，可以投递任务
    public function finish()
    {
        Log::info(__CLASS__ . ':finish start ');
        if($this->task_loop){
            $task = new TaskIndexController($this->data);
            $task->delay(3);
            Task::deliver($task);
            Log::info(__CLASS__ . ':re task', [$this->result]);
        }
    }
    //通知函数
    function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

//        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_URL, 'http://192.168.201.131/do');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: vpns.com'));

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //如果有跳转 循环跟进
        $res = curl_exec($curl);

        curl_close($curl);
        return $res;
    }

}
