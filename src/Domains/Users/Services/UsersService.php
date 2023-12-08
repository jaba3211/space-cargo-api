<?php

namespace Domains\Users\Services;

use App\Models\Activity;
use App\Models\Customer;
use App\Models\VolunteerExperience;
use App\Services\BaseService;
use DateTime;


class UsersService extends BaseService
{
    /**
     * @param $birthDate
     * @return int
     * @throws \Exception
     */
    public function calculateAge($birthDate): int
    {
        $birthDateObj = new DateTime($birthDate);
        $currentDate = new DateTime();
        return $currentDate->diff($birthDateObj)->y;
    }

    /**
     * @param int $customerId
     * @param $fieldName
     * @return mixed
     */
    public function profileIsCreated(int $customerId, $fieldName): mixed
    {
        return Customer::where('id', $customerId)
            ->whereNotNull($fieldName)
            ->exists();
    }


    /**
     * @param $customerId
     * @return bool
     */
    public function hasPreviousActivity($customerId): bool
    {
        $volunteerExperience = Activity::where('customer_id', $customerId)
            ->where('is_previous', 1)
            ->exists();
        if ($volunteerExperience) {
            return true;
        }
        return false;
    }


    /**
     * @param $customerId
     * @return bool
     */
    public function hasVolunteerExperience($customerId): bool
    {
        $volunteerExperience = VolunteerExperience::where('customer_id', $customerId)->exists();
        if ($volunteerExperience) {
            return true;
        }
        return false;
    }
}
