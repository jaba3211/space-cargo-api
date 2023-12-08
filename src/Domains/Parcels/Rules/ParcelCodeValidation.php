<?php

namespace Domains\Parcels\Rules;

use Carbon\Carbon;
use Closure;
use Domains\Parcels\Queries\ParcelQuery;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ParcelCodeValidation implements ValidationRule
{


    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parcelQuery = new ParcelQuery();
        $parcel = $parcelQuery->getParcel(Auth::id(), request()->get('id'));
        if ($parcel and $parcel->code != $value) {
            $fail('The :attribute .');
        }

    }

}
