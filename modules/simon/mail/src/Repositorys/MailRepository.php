<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 18:05
 */

namespace Simon\Mail\Repositorys;


use Simon\Kernel\Repositorys\AbstraceRepository;
use Simon\Mail\Models\Email;
use Simon\Mail\Repositorys\Interfaces\MailRepositoryInterface;

class MailRepository extends AbstraceRepository implements MailRepositoryInterface
{

    public function __construct(Email $Model)
    {
        parent::__construct($Model);
    }

}