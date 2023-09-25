<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Test case API",
 *     version="1.0.0",
 *
 * )
 * @OA\Server(
 *     description="Laravel Swagger API server",
 *     url="http://localhost:8080/api"
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 *  )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
