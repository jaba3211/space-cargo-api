<?php

namespace Domains\Parcels\Services;

use App\Models\Parcel;
use App\Services\BaseService;


class ParcelsService extends BaseService
{
    /**
     * @param int $userId
     * @param string $code
     * @param string $price
     * @param int $quantity
     * @param string $storeAddress
     * @param string $comment
     * @return mixed
     */
    public function create(
        int    $userId,
        string $code,
        string $price,
        int    $quantity,
        string $storeAddress,
        string $comment,
    ): mixed
    {
        return Parcel::create([
            'user_id' => $userId,
            'code' => $code,
            'price' => $price,
            'quantity' => $quantity,
            'store_address' => $storeAddress,
            'comment' => $comment,
        ]);
    }

}
