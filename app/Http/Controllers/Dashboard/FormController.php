<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;


use App\Services\FormService;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    private $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }
    public function showForm(Request $request)
    {
        try {
            // $cat = $this->blogService->getCateogries();
            return view('dashboard.multiStepForm');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function store(Request $request)
{
    try {
        // Check if step_id exists in the request
        if ($request->has('step_id')) {
            // dd($request->all());
            // Validate request based on the step_id value
            if ($request->step_id == "0") {
                $validatedData = $request->validate([
                    'full_name' => 'required|string|max:255',
                    'email_address' => 'required|email|max:255',
                    'phone_number' => 'required|string|max:20',
                    'date_of_birth' => 'required|date',
                    'gender' => 'required',
                    'address' => 'required|string',
                ]);
            } elseif ($request->step_id == "1") {
                $validatedData = $request->validate([
                    'username' => 'required|string|max:255',
                    'password' => 'required|string|min:8',
                ]);
            } else
            {
                $validatedData = $request->validate([
                    'card_holder_name' => 'required|string|max:255',
                    'credit_debit_card_number' => 'required|string|max:255',
                    'expiration_date' => 'required|date',
                    'cvv' => 'required|string|max:4',
                    'billing_address' => 'required|string',
                ]);
            }
        } 
        $data = $this->formService->storeEmployee($request);
        // Perform any further actions like saving to the database

        // Return success response
        return response()->json([
            'success' => true,
            'data'=> $data,
            'message' => 'Data saved successfully',
        ]);
        
    } catch (\Illuminate\Validation\ValidationException $exception) {
        // Return validation errors in JSON format
        return response()->json([
            'success' => false,
            'errors' => $exception->errors(),
        ], 422); // HTTP 422 Unprocessable Entity
    }
}


}
