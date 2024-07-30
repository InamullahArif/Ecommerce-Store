<?php
namespace App\Http\Controllers\website;

use App\Mail\MyTestMailOne;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string',
            'cart' => 'required|array',
            'amount' => 'required|numeric',
        ]);
        // Retrieve the request data
        $email = $request->input('email');
        $name = $request->input('first_name');
        $cart = $request->input('cart');
        $amount = $request->input('amount');
        // dd($cart[0]['image']);
        // Send the email
        Mail::send('website.Email.email', compact('name', 'cart', 'amount'), function ($message) use ($email) {
            $message->to($email)
                    ->subject('Order Placed Successfully!');
        });
        // $mailData = [
        //     'name' => $name,
        //     'cart' => $cart,
        //     'amount' => $amount,
        // ];
        // Mail::to($email)->send(new MyTestMailOne($mailData));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
