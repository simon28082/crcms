<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 20:08
 */

namespace Simon\Discuss\Models;


use Laravel\Scout\Searchable;
use Simon\Kernel\Models\Model;

class DiscussData extends Model
{

    use Searchable;

    /**
     * @var string
     */
    protected $table = 'discuss_datas';

    /**
     * @var string
     */
    protected $primaryKey = 'did';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;



}