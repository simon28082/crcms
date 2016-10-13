<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/4
 * Time: 7:40
 */

namespace Simon\Kernel\Services\Interfaces;


interface VisitedInterface
{

    public function get();

    public function put();

    public function destroy();

}