<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInformation extends Model
{
    protected $table = 'payment_informations';
    use HasFactory;
    protected $fillable = [
        "card_holder_name",
        "credit_debit_card_number",
        "expiration_date",
        "cvv",
        "billing_address",
        "emp_id",
    ];
}
