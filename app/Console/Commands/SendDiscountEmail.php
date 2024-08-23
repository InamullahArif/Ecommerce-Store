<?php
namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendDiscountEmail extends Command
{
    protected $signature = 'email:send-discount';
    protected $description = 'Send a 5% discount email for the latest product to users who have ordered in the last 7 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $latestProduct = Product::latest()->first();
    
            if (!$latestProduct) {
                $this->error('No latest product found.');
                return;
            }
    
            $recentOrders = Order::where('created_at', '>=', now()->subDays(7))->get();
    
            foreach ($recentOrders as $order) {
                $email = $order->email;
                $name = $order->first_name;
                Mail::send('dashboard.Email.email', compact('email', 'name', 'latestProduct'), function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Get 5% Off on Our Latest Product!');
                });
            }
    
            Log::info('Discount emails sent successfully.');
            $this->info('Discount emails sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error sending discount emails: ' . $e->getMessage());
    
            $this->error('Failed to send discount emails. Please check the logs for more details.');
        }
    }
    
}
