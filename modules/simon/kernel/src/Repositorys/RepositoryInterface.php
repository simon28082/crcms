<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 11:46
 */
namespace Simon\Kernel\Repositorys;
interface RepositoryInterface
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);


    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findAllPaginate(int $perPage = 15, array $columns = ['*']);


    /**
     * @param array $data
     * @return RepositoryInterface
     */
//    public function allPaginateBySearch(array $data) : RepositoryInterface;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);


    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data,int $id);


    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);


    /**
     * @param int $id
     * @param array $columns
     * @return mixed
     */
    public function findById(int $id, array $columns = ['*']);


    /**
     * @param string $field
     * @param string $value
     * @param array $columns
     * @return mixed
     */
    public function findBy(string $field,string $value,array $columns = ['*']);


    /**
     * @param string $field
     * @param string $value
     * @param array $columns
     * @return mixed
     */
    public function findOneBy(string $field,string $value,array $columns = ['*']);


    /**
     * @param array $wheres
     * @param array $order
     * @param int $take
     * @param int $skip
     * @param array $columns
     * @return mixed
     */
//    public function find(array $wheres,array $order = ['id','desc'],int $take = 0,int $skip = 0,array $columns = ['*']);

}