<?php

namespace Framework3\Framework\Commands;

class Test
{
    public function __construct()
    {

    }

    public function handle() : void
    {
        $process = new Process(['./vendor/bin/phpunit']);
        $process->run();

        if (!$process->isSuccessful()) {
            echo "Error running PHPUnit: " . $process->getErrorOutput();
            return;
        }

        echo $process->getOutput();
    }
}
