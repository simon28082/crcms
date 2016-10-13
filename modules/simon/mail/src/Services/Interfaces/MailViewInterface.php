<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 21:17
 */

namespace Simon\Mail\Services\Interfaces;


interface MailViewInterface
{

    public function getView() : string;

}