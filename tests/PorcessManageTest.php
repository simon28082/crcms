<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/6/21 7:13
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */



use CrCms\Foundation\Swoole\Server\ProcessManage;

class PorcessManageTest extends TestCase
{

    protected $process;

    public function testStore()
    {
        $this->process = new ProcessManage(storage_path('test'));
        $this->process->store(collect([1,2,3]));
    }

    public function testAppend()
    {
        $this->process->append(4);
    }

}