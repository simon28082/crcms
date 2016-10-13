<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 18:26
 */

namespace Simon\Discuss\Models;


use Simon\Kernel\Models\Model;

class Discuss extends Model
{

    protected $table = 'discuss';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasOneDiscussData()
    {
        return $this->hasOne(DiscussData::class,'did','id');
    }

}