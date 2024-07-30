<?php
namespace App\Http\Controllers\website;

use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('website.stripe');
    }

    public function stripePost(Request $request)
    {
        // dd($request->all());
        // \Log::info('Stripe request data', $request->all());
        $data = $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $customer = Stripe\Customer::create([
                "address" => [
                    "line1" => $data['billing_address'],
                    "postal_code" => $data['zip_code'],
                    "city" => $data['city'],
                    // "state" => "GJ",
                    "country" => $data['country'],
                ],
                "email" => $data['email'],
                "name" => $data['first_name'] . ' ' . $data['second_name'],
            ]);
            // dd((int)($data['amount']));
            $amount = (int) (floatval($data['amount']) * 100);
            // dd($amount);
            $paymentIntent = Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $customer->id,
                'payment_method' => $data['payment_method'], 
                'off_session' => true,
                'confirm' => true,
                'description' => $data['first_name'] . ' Payment Received Successfully!',
                'shipping' => [
                    'name' => $data['first_name'],
                    'address' => [
                        'line1' => $data['shipping_address'],
                        'postal_code' => $data['zip_code'],
                        'city' =>  $data['city'],
                        // 'state' => 'CA',
                        'country' =>  $data['country'],
                    ],
                ],
            ]);

            Session::flash('success', 'Payment successful!');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            Log::error('Stripe payment error', ['error' => $e->getMessage()]);
        }

        return back();
    }
}
