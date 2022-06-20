<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponseTrait;


class Controller extends BaseController
{
    use ApiResponseTrait;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function init(){
        return $this->okResponse("success", ["Restaurant - Api Service Version 1"]);
    }
}
