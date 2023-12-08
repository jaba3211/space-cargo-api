<?php

namespace App\Http\Controllers\Api;


use Domains\Parcels\Requests\CreateParcelRequest;
use Domains\Parcels\Resources\ParcelResource;
use Domains\Parcels\Services\ParcelsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ParcelsController extends ApiController
{

    /**
     * @OA\Post(
     *     path="/api/parcels/create",
     *     tags={"Parcels"},
     *     summary="Create parcel",
     *     security={{"apiAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new parcel",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="string", example="AC44BB13#TT"),
     *             @OA\Property(property="price", type="numeric", example="12.33"),
     *             @OA\Property(property="quantity", type="numeric", example="12"),
     *             @OA\Property(property="store_address", type="string", example="test address"),
     *             @OA\Property(property="comment", type="string", example="test comment"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation",
     *         @OA\JsonContent()
     *     )
     * )
     *
     * Create a new activity.
     *
     * @param CreateParcelRequest $request
     * @param ParcelsService $parcelsService
     * @return ParcelResource|JsonResponse
     */
    public function create(
        CreateParcelRequest $request,
        ParcelsService      $parcelsService
    )
    {
        try {
            $data = $parcelsService->create(
                userId: Auth::id(),
                code: $request->get('code'),
                price: $request->get('price'),
                quantity: $request->get('quantity'),
                storeAddress: $request->get('store_address'),
                comment: $request->get('comment'),
            );
            return new ParcelResource($data);
        } catch (Exception $exception) {
            return $this->error($exception);
        }
    }

}
