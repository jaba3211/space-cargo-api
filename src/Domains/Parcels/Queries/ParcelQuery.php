<?php

namespace Domains\Parcels\Queries;

use App\Models\Parcel;
use App\Queries\BaseQuery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ParcelQuery extends BaseQuery
{
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
        return Parcel::create([
            'user_id' => $userId,
            'code' => $code,
            'price' => $price,
            'quantity' => $quantity,
            'store_address' => $storeAddress,
            'comment' => $comment,
        ]);
    }

    /**
     * @param int $userId
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getList(int $userId, int $limit): LengthAwarePaginator
    {
        return Parcel::with([
            'user'
        ])
            ->where('user_id', $userId)
            ->paginate($limit)
            ->appends(request()->query());
    }

    /**
     * @param int $userId
     * @param int $id
     * @return Builder|Model|object|null
     */
    public function getParcel(
        int $userId,
        int $id,
    )
    {
        return Parcel::with([
            'user'
        ])
            ->where('user_id', $userId)
            ->where('id', $id)
            ->first();
    }

    /**
     * @param Object $parcel
     * @param string $code
     * @param string $price
     * @param int|null $quantity
     * @param string $storeAddress
     * @param string|null $comment
     * @return Object
     */
    public function update(
        Object $parcel,
        string $code,
        string $price,
        ?int    $quantity,
        string $storeAddress,
        ?string $comment,
    ): object
    {
        $parcel->update([
            'code' => $code,
            'price' => $price,
            'quantity' => $quantity,
            'store_address' => $storeAddress,
            'comment' => $comment,
        ]);
        return $parcel;
    }

}
