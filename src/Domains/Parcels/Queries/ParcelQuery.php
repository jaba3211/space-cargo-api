<?php

namespace Domains\Parcels\Queries;

use App\Models\Parcel;
use App\Queries\BaseQuery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ParcelQuery extends BaseQuery
{

    public function create(
        int    $userId,
        string $code,
        string $price,
        int    $quantity,
        string $storeAddress,
        string $comment,
    )
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
}
