<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 22:10
 */

function auth_logger(int $type,\Simon\User\Models\User $user)
{
    $ip = ip_long(app('request')->ip());
    $browser = '';
    event(new \Simon\User\Events\AuthLogEvent($user,$type,$ip,$browser));
}