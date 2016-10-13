<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 17:48
 */

namespace Simon\Mail\Services\Interfaces;


use Illuminate\Mail\Mailable;

interface MailInterface
{

    /**
     * 邮件发送接口
     * @param string $to
     * @param Mailable $Mail
     * @return mixed
     */
    public function send(string $to,Mailable $Mail);

    /**
     * 邮件日志
     * @param string $to
     * @param string $content
     * @return mixed
     */
    public function log(string $to,string $content,string $type);

}