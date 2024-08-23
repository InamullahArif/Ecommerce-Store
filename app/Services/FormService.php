<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Color;
use App\Models\Image;
use App\Models\Category;
use App\Models\Employee;
use App\Models\PaymentInformation;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class FormService
{
    public function storeEmployee($request)
    {
        // dd($request->all());
        if($request->step_id == "0")
        {
            $employee = Employee::updateOrCreate(
                ['email_address' => $request->email_address],
                [
                    'full_name' => $request->full_name,
                    'email_address' => $request->email_address,
                    'phone_number'=>$request->phone_number,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'address' => $request->address,
                ]
            );
        }elseif($request->step_id == "1")
        {
            $employee = Employee::updateOrCreate(
                ['email_address' => $request->email_address],
                [
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            );
        }else
        {
            $emp = Employee::where('email_address',$request->email_address)->first();
            // dd($emp->id);
            $employee = PaymentInformation::updateOrCreate(
                ['credit_debit_card_number' => $request->credit_debit_card_number],
                [
                    'card_holder_name' => $request->card_holder_name,
                    'credit_debit_card_number' => $request->credit_debit_card_number,
                    'expiration_date' => $request->expiration_date,
                    'cvv' => $request->cvv,
                    'billing_address' => $request->billing_address,
                    'emp_id' => $emp->id,
                ]
            );
            $employee = [
                'status' => 'done',
            ];
        }
        return $employee;
    }
}
