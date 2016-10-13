<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 18:26
 */

namespace Simon\Discuss\Models;


use Laravel\Scout\Searchable;
use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;

class Discuss extends Model
{

    use SoftDeletes,Searchable;

    /**
     * @var string
     */
    protected $table = 'discuss';

    /**
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasOneDiscussData()
    {
        return $this->hasOne(DiscussData::class,'did','id');
    }

}