<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 13:15
 */

namespace Simon\Kernel\Models;


use Illuminate\Database\Eloquent\Builder;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{

    /**
     * 不允许写入的字段，默认解除禁止
     * @var array
     */
    protected $guarded = [];

    /**
     * 软删除
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param DateTime|int $value
     * @return DateTime|int
     */
    public function fromDateTime($value) {
        return $value;

    }

    /**
     * select的时候避免转换时间为Carbon
     *
     * @param mixed $value
     * @return mixed
     */
//  protected function asDateTime($value) {
//	  return $value;
//  }

    /**
     * 从数据库获取的为获取时间戳格式
     *
     * @return string
     */
    public function getDateFormat() {
        return 'U';
    }

    protected function byScopeWhere(Builder $query,string $field,string $value,string $operator = '=')
    {
        return $query->where($field,$operator,$value);
    }

}