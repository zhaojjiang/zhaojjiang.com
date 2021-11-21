<?php

namespace App\Http\Controllers\Debug;

use App\Http\Controllers\Controller;

class DebugController extends Controller
{
    public function index($function = null)
    {
        if (empty($function) || !is_string($function) || !method_exists(__CLASS__, $function)) {
            abort(404);
        }

        return $this->$function();
    }

    public function debug()
    {
        die('debug');
    }
}
