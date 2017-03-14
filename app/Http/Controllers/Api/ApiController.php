<?php

namespace App\Http\Controllers\Api;

class ApiController
{
    public function result($result, $code = 200)
    {
        return [
            'code' => $code,
            'data' => $result,
        ];
    }

    public function paginate($pagination)
    {
        return $pagination;
    }
}
