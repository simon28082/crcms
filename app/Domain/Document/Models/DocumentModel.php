<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 10:22
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Domain\Document\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $dateFormat = 'U';

    protected $dates = ['published_at'];

    protected $guarded = [];

    protected $table = 'documents';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) \Webpatser\Uuid\Uuid::generate(4);
        });
    }
}
