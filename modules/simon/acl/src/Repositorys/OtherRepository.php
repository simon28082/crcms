<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 16:00
 */

namespace Simon\Acl\Repositorys;


use Simon\Acl\Models\AclOther;
use Simon\Acl\Repositorys\Interfaces\OtherRepositoryInterface;
use Simon\Kernel\Repositorys\AbstraceRepository;

class OtherRepository extends AbstraceRepository implements OtherRepositoryInterface
{

    const STATUS_OPEN = 1;

    const STATUS_CLOSE = 2;

    const STATUS = [self::STATUS_OPEN=>'开启',self::STATUS_CLOSE=>'关闭'];

    public function __construct(AclOther $Model)
    {
        parent::__construct($Model);
    }

    public function status() : array
    {
        // TODO: Implement status() method.
        return static::STATUS;
    }

    public function statusOpen() : int
    {
        // TODO: Implement statusOpen() method.
        return static::STATUS_OPEN;
    }

    public function statusClose() : int
    {
        // TODO: Implement statusClose() method.
        return static::STATUS_CLOSE;
    }
}