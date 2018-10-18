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
        $app = $start->bindApp($this->mode);
        $start->loadKernel();

        $app->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        return $app;
    }
}
