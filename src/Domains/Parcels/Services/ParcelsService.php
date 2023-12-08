<?php

namespace Domains\Parcels\Services;

use App\Exceptions\NotFoundException;
use App\Services\BaseService;
use Domains\Parcels\Queries\ParcelQuery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class ParcelsService extends BaseService
{

    private ParcelQuery $parcelQuery;

    public function __construct(ParcelQuery $parcelQuery)
    {
        parent::__construct();
        $this->parcelQuery = $parcelQuery;
    }

    /**
     * @param int $userId
     * @param string $code
     * @param string $price
     * @param int|null $quantity
     * @param string $storeAddress
     * @param string|null $comment
     * @return mixed
     */
    public function create(
        int    $userId,
        string $code,
        string $price,
        ?int    $quantity,
        string $storeAddress,
        ?string $comment,
    ): mixed
    {
        return $this->parcelQuery->create(
            userId: $userId,
            code: $code,
            price: $price,
            quantity: $quantity,
            storeAddress: $storeAddress,
            comment: $comment
        );
    }

    /**
     * @param int $userId
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getList(int $userId, int $limit): LengthAwarePaginator
    {
        return $this->parcelQuery->getList(userId: $userId, limit: $limit);
    }

    public function getParcel(
        int $userId,
        int $id,
    )
    {
        return $this->parcelQuery->getParcel($userId, $id);
    }

    /**
     * @param int $userId
     * @param int $id
     * @param string $code
     * @param string $price
     * @param int|null $quantity
     * @param string $storeAddress
     * @param string|null $comment
     * @return object
     * @throws NotFoundException
     */
    public function update(
        int    $userId,
        int    $id,
        string $code,
        string $price,
        ?int    $quantity,
        string $storeAddress,
        ?string $comment,
    ): object
    {
        $parcel = $this->parcelQuery->getParcel(userId: $userId, id: $id);
        if (!$parcel) {
            throw new NotFoundException('The parcel not found.');
        }
        return $this->parcelQuery->update(
            parcel: $parcel,
            code: $code,
            price: $price,
            quantity: $quantity,
            storeAddress: $storeAddress,
            comment: $comment
        );
    }

}
