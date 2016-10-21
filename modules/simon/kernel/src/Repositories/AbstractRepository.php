<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 11:48
 */

namespace Simon\Kernel\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->select($columns)->orderBy($this->model->getKeyName(),'desc')->get();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findAllPaginate(int $perPage = 15, array $columns = ['*'])
    {
        return $this->model->select($columns)->orderBy($this->model->getKeyName(),'desc')->paginate($perPage);
    }

    /**
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data,int $id)
    {
        return $this->model->where($this->model->getKeyName(),$id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findById(int $id, array $columns = ['*'])
    {
        return $this->model->select($columns)->where($this->model->getKeyName(),$id)->firstOrFail();
    }

    public function findBy(string $field,string $value,array $columns = ['*'])
    {
        return $this->model->select($columns)->where($field,$value)->orderBy($this->model->getKeyName(),'desc')->get();
    }

    public function findOneBy(string $field,string $value,array $columns = ['*'])
    {
        return $this->model->select($columns)->where($field,$value)->orderBy($this->model->getKeyName(),'desc')->first();
    }

}