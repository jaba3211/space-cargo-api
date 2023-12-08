<?php

namespace Domains\Parcels\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParcelResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     * @throws \Exception
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'store_address' => $this->store_address,
            'comment' => $this->comment,
        ];
    }

}
