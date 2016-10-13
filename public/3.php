<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/11
 * Time: 15:53
 */

class Test
{

    public function a($status = false)
    {
        if ($status)
        {

        }
        else
        {


        throw new Exception('abc');
        }
    }

    public function b()
    {
        $this->a();
        echo 1212121;
    }

}

(new Test())->b();
