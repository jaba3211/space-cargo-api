<?php

namespace App\Http\Controllers\Api;



class UsersController extends ApiController
{
    /**
     * @OA\Get(
     * path="/api/users",
     * summary="Get a list of users",
     * tags={"Users"},
     * @OA\Response(
     * response=200,
     * description="List of users",
     * ),
     * )
     */
    public function geUser()
    {

    }

}
