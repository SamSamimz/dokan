<?php

namespace App\Listeners;

use App\Events\NewDueEvent;
use App\Models\Due;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewDueListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewDueEvent $event): void
    {
        $sale = $event->sale;
        if (!Due::where('sale_id', $sale->id)->exists()) {
            Due::create([
                'sale_id' => $sale->id,
                'user_id' => $sale->user_id,
                'customer_id' => $sale->customer_id,
                'amount' => $sale->due_amount,
            ]);
        }
    }
}
