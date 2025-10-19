<?php

namespace Framework3;

class Input
{

    public Files $files;
    public Cookies $cookies;
    public Request $request;
    public Parameters $parameters;

    public function __construct()
    {
        $this->files = new Files();
        $this->cookies = new Cookies();
        $this->request = new Request();
        $this->parameters = new Parameters();
    }

    public function get(string $key, mixed $default = null)
    {
        // Lookup the key
    }
}
