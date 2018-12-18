<?php

namespace CrCms\Tests;

use CrCms\Foundation\Start;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $start = Start::instance();

        $start->bootstrap();

        $start->getApplication()->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        return $start->getApplication();
    }
}
