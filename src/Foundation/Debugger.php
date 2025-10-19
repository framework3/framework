<?php

namespace Framework3;

class Debugger
{
    public function __construct()
    {
    }

    public function dd(...$args) : void
    {
        $f = debug_backtrace();

        $message = sprintf("dd() %s:%s\n\n", $f[0]['file'], $f[0]['line']);

        foreach ($args as $arg) {
            $message .= var_export($arg, true) . "\n\n";
        }

        echo $message;

        exit;
    }
}


