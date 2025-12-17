<?php

namespace Modules\Auth\app\Http\Interface\Api;


interface AuthInterface
{
    public function create($data);
    public function find($data);
}
