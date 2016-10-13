<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/8
 * Time: 6:37
 */

namespace Simon\Mail\Services\Traits;


trait MailView
{

    public function getView() : string
    {
        // TODO: Implement getView() method.
        return (string)view($this->buildView(),$this->buildViewData());
    }

}