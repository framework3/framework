<?php

namespace Framework3;

class Environment
{

    public Context $context;
    public Input $input;

    public function __construct()
    {
        $this->context = new Context();
        $this->input = new Input();
    }
}
