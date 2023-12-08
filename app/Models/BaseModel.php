<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    /**
     * @throws Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
