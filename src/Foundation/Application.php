<?php

namespace Framework3;

use Framework3\Commands\Test;

class Application
{

    private Core $core;

    public function __construct() {
        $this->core = new Core();
    }

    public function handleCommand() : int
    {

        // TODO: Implement actual logic
        echo "handling command: \n";

        $cmd = new Test();

        $cmd->handle();

        // 0 success, 1 failure, etc
        return 0;
    }
}
