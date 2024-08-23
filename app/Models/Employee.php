<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        "full_name",
        "email_address",
        "phone_number",
        "date_of_birth",
        "gender",
        "address",
        "username",
        "password",
        "comments",
        "contact_method",
    ];
}
