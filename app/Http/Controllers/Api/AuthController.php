<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use Domains\Login\Requests\LoginRequest;
use Domains\Login\Resources\LoginResource;
use Domains\Login\Services\LoginService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Authentification"},
     *      summary="Get a JWT access token via given credentials.",
     *      @OA\RequestBody(
     *          description="Create customers object",
     *          required=true,
     *          @OA\JsonContent(
     *		        @OA\Property(property="username", type="string", format="text", example="glowe"),
     *			    @OA\Property(property="password", type="string", format="text", example="123456"),
     *            ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="bad request",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="validation",
     *          @OA\JsonContent()
     *      ),
     *  )
     *
     * Get a JWT access token via given credentials.
     *
     * @param LoginRequest $request
     * @param LoginService $loginService
     * @return LoginResource|JsonResponse
     */
    public function login(LoginRequest $request, LoginService $loginService): LoginResource|JsonResponse
    {
        try {
            $token = $loginService->login(
                username: $request->get('username'),
                password: $request->get('password')
            );
            return new LoginResource($token);
        } catch (NotFoundException $exception) {
            return $this->notFound($exception);
        } catch (Exception $exception) {
            return $this->error($exception);
        }
    }


}
