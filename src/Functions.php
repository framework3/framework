<?php

use Framework3\Debugger;

// TODO: Can this be written and compiled as a C++ extension, with ffi loading?
if (!function_exists('dd')) {
    function dd(...$args) {
        (new Debugger())->dd(...$args);
    }
}
