<?php

namespace App\Http\Controllers\Api;

use App\Support\ResponseSupport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      title="Space Cargo Api",
 *      version="1.0"
 *  )
 * @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 *
 *      @OA\SecurityScheme(
 *          type="http",
 *          description="Login with email and password to get the authentication token",
 *          name="Token based Based",
 *          in="header",
 *          scheme="bearer",
 *          bearerFormat="JWT",
 *          securityScheme="apiAuth",
 *      )
 *  )
 */
class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseSupport;

    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }
}
