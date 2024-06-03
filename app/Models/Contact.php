<?php

namespace App\Models;

use Prism\Database\Model;

class Contact extends Model {
    protected array $fillable = [
        'name',
        'phone_number',
        'user_id',
    ];
}