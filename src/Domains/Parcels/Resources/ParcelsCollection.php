<?php

namespace Domains\Parcels\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParcelsCollection extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'store_address' => $this->store_address,
        ];
    }

}
