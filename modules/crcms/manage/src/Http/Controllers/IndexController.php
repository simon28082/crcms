<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/26
 * Time: 14:57
 */

namespace CrCms\Manage\Http\Controllers;


use Simon\Kernel\Http\Controllers\Controller;

class IndexController extends Controller
{

    /**
     * @var string
     */
    protected $view = 'manage::default.index.';


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return $this->view('index');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDescription()
    {
        return $this->view('description');
    }

}