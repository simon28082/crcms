<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/26
 * Time: 18:46
 */

namespace Simon\Kernel\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Simon\Filter\Facades\Input;

class Controller extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    protected $input = [];

    /**
     * @var \Illuminate\Foundation\Application|mixed|null
     */
    protected $request = null;

    /**
     * @var null
     */
    protected $repository = null;

    /**
     *
     * @var string
     * @author simon
     */
    protected $view = '';


    public function __construct()
    {
        $this->request = app('request');

//        $this->input = Input::get();//$this->request->all();
        $this->input = $this->request->all();;//$this->request->all();

        DB::enableQueryLog();
    }


    /**
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view,array $data = [],array $mergeData = [])
    {
        $theme = config('site.theme');
        $theme = $theme ? $theme.'.'  : null;
        return view($this->view.$view,$data,$mergeData);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $url
     * @return $this|\Illuminate\Http\JsonResponse
     */
    protected function response($status,$data = [],$url = null)
    {
        return responding($status,$data,$url);
    }

    /**
     * @param null $url
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirectUrl($url = null)
    {
        $redirect = $this->input['_redirect'] ?? $url ?? null;
        return $redirect ? redirect($redirect) : redirect()->back();
    }

    protected function redirectRoute($route = null,array $params = [])
    {
        $redirect = $this->input['_redirect'] ?? route($route,$params) ?? null;
        return $redirect ? redirect($redirect) : redirect()->back();
    }
}