<?php

namespace App\Http\Controllers\Common;

use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Task{
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
    use Common;
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
        Log::channel('daily')->info('Task start'.json_encode($data));

        //流程
        //通知频率 暂时不设置 每3秒通知一次 通知到死
        // 15s/15s/30s/3m/10m/20m/30m/30m/30m/60m/3h/3h/3h/6h/6h
        //入库
        $task_id = $data['task_id'];
        unset($data['task_id']);

        //直接通知
        $params = json_decode($data['task_params']);
        $params_index = 0;
        foreach ($params as $key => $vo) {
            if($params_index == 0){
                $data['task_url'] .= '?';
                $params_index = 1;
            }
            else{
                $data['task_url'] .= '&';
            }
            $data['task_url'] .=$key.'='.$vo;
        }
        $result=$this->httpGet($data['task_url']);
        $result=json_decode($result,true);

        //只要请求有正常返回值，不管结果，都退出任务
        if(isset($result['result']) && ($result['result'] == 1 || $result['result'] == 0)){
            //成功更换状态
            $this->task_loop = false;
            Log::channel('daily')->info('Task success');
        }
        else{
            Log::channel('daily')->info('Task  loop');
        }

        //新任务 入库 等待循环
        if($task_id == 0){
            $data['created_at'] = date('Y-m-d H:i:s');
            $task_id = DB::table('task')->insertGetId($data);
            //插入后 更新task_id数值
            $this->data['task_id'] = $task_id;
        }
        //旧任务
        else{
            $exists = DB::table('task')->where('task_id',$task_id)->where('is_del',0)->exists();
            //如果任务存在 更新
            if($exists){
                DB::table('task')->where('task_id',$task_id)->update([
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'count' => DB::raw('count+1')
                ]);
            }
            //如果任务不见了 不再循环
            else{
                $this->task_loop = false;
            }
        }
    }
    // 完成事件，任务处理完后的逻辑，运行在Worker进程中，可以投递任务
    // 循环投递
    public function finish()
    {
        Log::channel('daily')->info('Task finish end');
        if($this->task_loop){
            self::create($this->data);
            Log::channel('daily')->info('Task loop retask',[$this->result]);
        }
        else{
            //执行完毕删除
            DB::table('task')->where('task_id',$this->data['task_id'])->update([
                'updated_at' =>date('Y-m-d H:i:s'),
                'is_del' => 1
            ]);
        }
    }

    /**
     * 开始一个新的任务
     * @return bool
     */
    public static function create(array $task_info){
        //没定义task_id 默认给0
        isset($task_info['task_id']) ? '': $task_info['task_id'] = 0;

        $task = new TaskController($task_info);

        //非新任务 延迟
        if($task_info['task_id']){
            $task->delay(10);
        }
        return Task::deliver($task);
    }

}