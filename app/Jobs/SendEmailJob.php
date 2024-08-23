<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $name;
    protected $cart;
    protected $amount;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $name, $cart, $amount)
    {
        $this->email = $email;
        $this->name = $name;
        $this->cart = $cart;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Mail::send('website.Email.email', [
        //     'name' => $this->name,
        //     'cart' => $this->cart,
        //     'amount' => $this->amount,
        // ], function ($message) {
        //     $message->to($this->email)
        //             ->subject('Order Placed Successfully!');
        // });
        Log::info('into job');
        try{
        $name=$this->name;
        $cart = $this->cart;
        $amount = $this->amount;
        Mail::send('website.Email.email', compact('name', 'cart', 'amount'), function ($message) {
            $message->to($this->email)
                    ->subject('Order Placed Successfully!');
        });
        Log::info('Job Submitted successfully');
    }
   catch(\Exception $ex){
Log::error($ex->getMessage());
    }
}

}
