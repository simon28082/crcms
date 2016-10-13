<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/30
 * Time: 10:31
 */

namespace Simon\Kernel\Services;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;
use Simon\Kernel\Services\Interfaces\VisitedInterface;

class Visited implements VisitedInterface
{

    protected $cache = null;

    protected $fingerprint = '';

    public function __construct(string $fingerprint,Cache $Cache)
    {
        $this->cache = $Cache;
        $this->fingerprint = $fingerprint;
    }

    public function get()
    {
        return $this->cache->get($this->fingerprint);
    }

    public function put()
    {
        if ($this->cache->has($this->fingerprint))
        {
            $data = $this->cache->get($this->fingerprint);
            $data['frequency'] += 1;
            $data['time'] = time();
        }
        else
        {
            $data['frequency'] = 1;
            $data['time'] = time();
        }
        //保存一天记录
        $this->cache->put($this->fingerprint,$data,60*24);
    }

    public function destroy()
    {
        $this->cache->forget($this->fingerprint);
    }
}