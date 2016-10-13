<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 17:56
 */

namespace Simon\Mail\Services;

use Illuminate\Mail\Mailable;
use Simon\Mail\Events\MailLogEvent;
use Simon\Mail\Repositorys\Interfaces\MailRepositoryInterface;
use Simon\Mail\Services\Interfaces\MailInterface;

class MailService implements MailInterface
{

    /**
     * @param string $view
     * @param string $to
     * @param null $model
     * @return mixed
     */
    public function send(string $to,Mailable $Mail)
    {
        // TODO: Implement send() method.
        \Illuminate\Support\Facades\Mail::to($to)->send($Mail);
    }

    /**
     * @param string $view
     * @param string $to
     * @param null $model
     * @return mixed
     */
    public function log(string $to, string $content,string $type)
    {
        event(new MailLogEvent($to,$content,$type));
    }

}