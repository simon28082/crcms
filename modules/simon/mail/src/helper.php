<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 18:21
 */
if (!function_exists('mailer'))
{
    function mailer(string $to,\Illuminate\Mail\Mailable $Mail)
    {
        $MailService = new \Simon\Mail\Services\MailService();
        $MailService->send($to,$Mail);
        $MailService->log($to,$Mail->getView(),get_class($Mail));
    }
}