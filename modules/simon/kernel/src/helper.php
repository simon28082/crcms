<?php
use Filter\DataFilters;
use Filter\Component\Shell;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Fields\Field;
use Carbon\Carbon;
use Simon\Document\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


    function input($key = null)
    {
        return \Illuminate\Support\Facades\Request::input($key);
    }


    /**
     * 静态资源
     * @param unknown $file
     * @param string $url
     * @return string
     */
    function static_asset($file = null,$url = null)
    {

        static $staticAssetUrl;

        if (empty($staticAssetUrl))
        {
            $staticAssetUrl = rtrim(env('CDN_URL',str_replace('\\','/',dirname(env('SCRIPT_NAME')))),'/');
        }

        return "{$staticAssetUrl}/{$file}";
    }


	/**
	 * 加密并加入混淆符
	 * @param string $key
	 * @param number $length
	 * @return unknown|string
	 */
	function create_hash($key,$length = 3)
	{
		$hash = Crypt::encrypt($key);
		if ($length === 0) 
		{
			return $hash;
		}
		return str_random($length).$hash.str_random($length);
	}

	/**
	 * 验证加密
	 * @param string $key
	 * @param string $hash
	 * @param number $length
	 */
	function check_hash($key,$hash,$length = 3)
	{
		if ($length !== 0)
		{
			$stringLength = strlen($hash);
			$hash = substr($hash,$length,$stringLength-($length*2));
		}
		
		return $key == Crypt::decrypt($hash);
	}
	
	/**
	 * 
	 * @param array $data
	 * @param string $key
	 * @param string $hash
	 * @return array
	 * @author simon
	 */
	function hash_append(array $data,$key = 'id',$hash = 'hash')
	{
		foreach ($data as &$values)
		{
			is_object($values) ? $values->$hash = create_hash($values->$key) : $values[$hash] = create_hash($values[$key]);
		}
		return $data;
	}
	
	/**
	 * 日期格式
	 * @param int $timestamp
	 * @param number $type
	 * @return string
	 */
	function format_date($timestamp,$type = 2)
	{
		switch($type)
		{
			case 1:
				$format = 'Y/m/d';
				break;
			case 2:
				$format = 'Y/m/d H:i';
				break;
			case 3:
				$format = 'Y/m/d H:i:s';
				break;
			case 4:
				$format = 'H:i:s';
				break;
		}
		return date($format,$timestamp);
	}
	
	/**
	 * 
	 * @param unknown $string
	 * @author simon
	 */
	function format_xss($string, $config = null)
	{
		return clean($string, $config);
	}
	
	/**
	 * 更加规范的命名参数+功能更健壮
	 * @param string $shell
	 * @param string $type
	 * @param string|boolean $symbol
	 * @param string $path
	 * @return Ambigous <Ambigous, multitype:, string>
	 */
	function shell($shell,$symbol = false,$type = 'bash',$path = null) {
		
		empty($path) && $path = script_path().'/';
		
		switch (strtolower($type)) {
			case 'bash':
				$exec = "sudo /bin/bash ";
				break;
			case 'python':
				$exec = 'sudo /usr/bin/python ';
				break;
			case 'php':
				$exec = 'sudo /usr/bin/php ';
				break;
			case 'cli':
				$exec = 'sudo ';
				$path = '';
				break;
		}
		//cli纯命令行操作
// 		if (is_null($exec)) {
// 			$bash = $shell;
// 		} else {
			$bash = "{$exec}{$path}{$shell}";
// 		}

		//$bash = escapeshellcmd($bash);
		//echo $bash,'<br />';
		$result = trim(shell_exec($bash));
		//快捷设置
		if ($symbol === true) {
			$symbol = "\n";
		}
		return $symbol&&$result ? explode($symbol, $result) : $result;
	}
	
	/**
	 * shell 过滤
	 * @param string $shell
	 */
	function shell_filter($shell)
	{
		$filters = new DataFilters(new Shell());
		return is_array($shell) ? $filters->filters($shell) : $filters->filter($shell);
	}
	
	/**
	 * 脚本目录路径
	 * @param string $path
	 * @return string
	 */
	function script_path($path = null)
	{
		$scriptPath = dirname(public_path()).'/scripts';
		return empty($path) ? $scriptPath : $scriptPath.'/'.ltrim($path);
	}
	
	/**
	 * 
	 * @param unknown $table
	 * @param string $key
	 * @return NULL|unknown
	 */
	function table_status($table,$key = null)
	{
		$cacheKey = "{$table}_status";
		
		if ((bool)$result = Cache::get($cacheKey))
		{
			
		}
		else
		{
			$result = DB::select("show table status like '{$table}'");
			if (empty($result))
			{
				return null;
			}
			$result = $result[0];
			Cache::put($cacheKey,$result,172800);
		}
		
		return empty($key) ? $result : $result->$key;
	}
	
	/**
	 * 字段实例
	 * @param array $fields
	 * @param array $data
	 * @param string $method
	 * @return \App\Fields\array_object
	 */
	function fields_instanse(array $fields,array $data = [],$method = null)
	{
		return Field::factory($fields,$data,$method);
	}
	
// 	/**
// 	 * 用户会话--只限于用户session设置
// 	 * @return mixed
// 	 * @author simon
// 	 */
// 	function user_session($value = null)
// 	{
// 		//通过URL访问判断前后台SESSION
// 		$Request = app('request');
// 		//后台session
// 		//if (stripos($Request->root(), 'backend/index.php' ))
// 		if ($Request->is('manage/*'))
// 		{
// 			$markKey = 'backend.session';
// 			$sessionType = 1;
// 		}
// 		else//前台session
// 		{
// 			$markKey = config('site.user_session');
// 			$sessionType = 2;
// 		}
		
// 		//获取或赋值
// 		if (is_null($value))
// 		{
// 			return session($markKey);
// 		}
// 		elseif (is_string($value))
// 		{
// 			return session($markKey) ? session($markKey)->$value : null;
// 		}
// 		elseif (is_object($value))
// 		{
// 			$value->session_type = $sessionType;
// 			return session([$markKey=>$value]);
// 		}
// 		elseif (is_array($value))
// 		{
// 			$session = session($markKey);
// 			foreach ($value as $k=>$vo)
// 			{
// 				$session->$k = $vo;
// 			}
// 			return session([$markKey=>$session]);
// 		}
// 	}

	/**
	 * 用户会话--只限于用户session设置
	 * @param $value mixed
	 * @return mixed
	 * @author simon
	 */
	function user_session($value = null)
	{
		//通过URL访问判断前后台SESSION
		$Request = app('request');
		//后台session
		//if (stripos($Request->root(), 'backend/index.php' ))
		if ($Request->is('manage/*'))
		{
			$markKey = 'backend.session';
			$sessionType = 1;
		}
		else//前台session
		{
			$markKey = config('site.user_session','user_session');
			$sessionType = 2;
		}
		
		//销毁session
		if (is_bool($value) && $value === false)
		{
			session()->forget($markKey);
			return ;
		}
		
		//获取或赋值
		if (is_null($value))
		{
			return session($markKey);
		}
		elseif (is_string($value))
		{
			return session($markKey) ? session($markKey)->$value : null;//&& property_exists(session($markKey), $value) 
		}
		elseif (is_object($value))
		{
			$value->session_type = $sessionType;
			return session([$markKey=>$value]);
		}
		elseif (is_array($value))
		{
			$session = session($markKey);
			foreach ($value as $k=>$vo)
			{
				$session->$k = $vo;
			}
			return session([$markKey=>$session]);
		}
	}
	
// 	/**
// 	 * 用户会话
// 	 * @return mixed
// 	 * @author simon
// 	 */
// 	function user_session($value = null)
// 	{
// 		//通过URL访问判断前后台SESSION
// 		$Request = app('request');
// 		//后台session
// 		if (stripos($Request->root(), 'backend/index.php' ))
// 		{
// 			$key = 'backend.session';
// 			$type = 1;
// 		}
// 		else//前台session
// 		{
// 			$key = config('site.user_session');
// 			$type = 2;
// 		}
		
// 		//获取或赋值
// 		if (is_null($value))
// 		{
// 			return session($key);
// 		}
// 		elseif (is_array($value))
// 		{
// 			$value['session_type'] = $type;
// 		}
// 		elseif (is_object($value))
// 		{
// 			$value->session_type = $type;
// 		}
// 		else
// 		{
// 		}
// 		return session([$key=>$value]);
// 	}
	
	/**
	 * 人性化时间差
	 * @param int $timestamp
	 * @return string
	 * @author simon
	 */
	function time_difference($timestamp)
	{
		$Time = Carbon::createFromTimestamp($timestamp);
		
		if (($minute = $Time->diffInMinutes(Carbon::now())) < 60)
		{
			return $minute.'分钟';
		}
		elseif (($hour = $Time->diffInHours(Carbon::now())) < 24)
		{
			return $hour.'小时';
		}
		elseif (($day = $Time->diffInDays(Carbon::now())) < 30)
		{
			return $day.'天';
		}
		elseif (($month = $Time->diffInMonths(Carbon::now())) < 12)
		{
			return $month.'月';
		}
		else 
		{
			$year = $Time->diffInYears(Carbon::now());
			return $year.'年';
		}
		
	}
	
	/**
	 * Xss过滤
	 * @param string|array $data
	 * @param boolean $strip_tags
	 * @return string|array
	 * @author simon
	 */
	function xss_clean($data,$strip_tags = true)
	{
		if (is_array($data))
		{
			foreach ($data as &$value)
			{
				$value = xss_clean($value);
			}
		}
		else
		{
			//$data = clean(trim($data));
			$data = trim($data);
			//$data = $strip_tags ? strip_tags($data) : $data;
		}
		return $data;
	}
	
	/**
	 * 获取ip地址信息
	 * @param string $ip
	 * @return Ambigous <multitype:, NULL, string>
	 */
// 	function ip_location($ip)
// 	{
// 		$IpLocation = new App\Helpers\IpLocation();
// 		return $IpLocation->getlocation($ip);
// 	}
	
// 	function category_tree($Category = null)
// 	{
// 		$Category = empty($Category) ? new Category() : $Category;
// 		$category = $Category->orderBy('created_at','desc')->get()->toArray();
// 		return show_tree(array_tree($category));
// 	}
	
	/**
	 * 判断当前模型是否存在
	 * @param string $module
	 * @return boolean
	 * @author root
	 */
	function module_exists($module)
	{
		$module = ucwords($module);
		
		//静态变量缓存，这里就先这样，后期还可以再优化，例如做成memcache Cache缓存
		static $modules;
		
		if (empty($modules))
		{
			$content = Storage::disk('root')->get('composer.json');
			$content = json_decode($content,true);
			$modules = array_get($content, 'autoload.psr-4');
		}
		
		return in_array("Simon\\{$module}\\", array_keys($modules),true);
	}

    /**
     * @param $request
     * @param $status
     * @param array $data
     * @param null $url
     * @return $this|JsonResponse
     */
    function responding($request,$status,$data = [],$url = null)
    {

        /*if (is_array($status))
        {
            $response = isset($status[1]) ? app_response($status[0],$status[1]) : app_response($status[0]);
        }
        else
        {
            $response = app_response($status);
        }*/
        $status = app_response((array)$status);

        //快捷$mixed参数设置
        if (is_string($data) || is_bool($data))
        {
            $url = $data;
            $data = [];
        }

        //ajax加载
        if (($request->ajax() && !$request->pjax()) || $url === true || $request->wantsJson() || intval($request->input('_json')) === 1)
        {
            $httpCode = array_pop($status);

            return new JsonResponse(array_merge($status,['data'=>$data]),$httpCode);
        }
        //数据提交返回
        else
        {
            $redirect = empty($url) ? redirect()->back() : redirect($url);
            return $redirect->with($status)->withInput(array_merge($request->all(),$data));
        }
    }

    /**
     * @return bool
     */
    function response_json()
    {
        return app('request')->is('api/*') ? true : false;
    }
	
	
// 	function responding($status,$mixed = null,array $data = [])
// 	{
		
// 		//快捷$data参数设置
// 		if (is_array($mixed) && empty($data))
// 		{
// 			$data = $mixed;
// 			$mixed = null;
// 		}
		
// 		if (is_array($status))
// 		{
// 			$response = isset($status[1]) ? app_response($status[0],$status[1]) : app_response($status[0]);
// 		}
// 		else
// 		{
// 			$response = [];
// 		}
		
// 		$request = app('request');
		
// 		//ajax加载
// 		if (($request->ajax() && !$request->pjax()) || $request->wantsJson())
// 		{
// 			if ($response)
// 			{
// 				$response['data'] = $data;
// 				return new JsonResponse($response);
// 			}
// 			//返回html
// 			elseif (!is_array($status))
// 			{
// 				return view($status,$data);
// 			}
// 		}
// 		//正常视图渲染加载
// 		elseif (!is_array($status) && $mixed === null)//非跳转链接
// 		{
// 			return view($status,$data);
// 		}
// 		//数据提交返回
// 		else
// 		{
// 			$redirect = empty($mixed) ? redirect()->back() : redirect($mixed);
// 			return $redirect->with($response)->withInput(array_merge($request->all(),$data));
// 		}
// 	}
	
    /**
     *
     * @param string $appMessage
     * @param int $appCode
     * @return array
     * @author simon
     */
    function app_response($appMessage,$appCode = 1000,$httpCode = 200)
    {

        if (is_array($appMessage))
        {
            list($key,$sub) = explode('.',$appMessage[0]);

            if (empty($appMessage[1]))
            {

                //读取自己文件的状态码
                if ((bool)$temp = config()->get("code.{$key}.app.{$sub}"))
                {
                    $appMessage[1] = $temp;
                }
                //读取公共状态码
                elseif ((bool)$temp = config()->get("code.app.{$sub}"))
                {
                    $appMessage[1] = $temp;
                }
                else
                {
                    $appMessage[1] = $appCode;
                }
            }

            if (empty($appMessage[2]))
            {
                //读取自己文件的状态码
                if ((bool)$temp = config()->get("code.{$key}.http.{$sub}"))
                {
                    $appMessage[2] = $temp;
                }
                //读取公共状态码
                elseif ((bool)$temp = config()->get("code.http.{$sub}"))
                {
                    $appMessage[2] = $temp;
                }
                else
                {
                    $appMessage[2] = $httpCode;
                }
            }

            list($app_message,$app_code,$http_code) = $appMessage;
        }
        else
        {
            $app_message = $appMessage;
            $app_code = $appCode;
            $http_code = $httpCode;
        }

        return [
            'app_message'=>message_lang($app_message),
            'app_code'=>$app_code,
            'http_code'=>$http_code,
        ];
    }
	
	/**
	 * 
	 * @param string $message
	 * @return \Symfony\Component\Translation\TranslatorInterface|string|unknown
	 * @author simon
	 */
	function message_lang($message)
	{
		return strpos($message, '.') ? trans($message) : $message;
	}
	
	/**
	 * 获取安全的hash值
	 * @param array $data
	 * @param array $hashs
	 * @return array
	 * @author simon
	 */
	function hash_safe_data(array $data,array $hashs)
	{
		foreach ($hashs as $key=>$hash)
		{
			if (!check_hash($data[$key], $hash))
			{
				unset($data[$key]);
			}
		}
		return $data;
	}
	
	/**
	 * 获取IP地区
	 * @param string $ip
	 * @author simon
	 */
	function ip_location($ip)
	{
		return \Torann\GeoIP\GeoIPFacade::getLocation($ip);
	}
	