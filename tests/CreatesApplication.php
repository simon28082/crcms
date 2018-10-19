<?php

namespace CrCms\Tests;

use CrCms\Foundation\Start;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * @var string
     */
    protected $mode = 'laravel';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $start = Start::instance();

        $start->bootstrap($this->mode);

        $start->getApp()->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        return $start->getApp();
    }
}
