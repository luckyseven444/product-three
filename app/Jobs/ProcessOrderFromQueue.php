<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class ProcessOrderFromQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderData;

    /**
     * Create a new job instance.
     */
    public function __construct($orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {   
        // Update product stock
        Product::where('id', $this->orderData['product_id'])->decrement('stock', $this->orderData['quantity']);

        \Log::info('Processed Order: ' . json_encode($this->orderData));
    }
}
