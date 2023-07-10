<?php

namespace App\Observers;

use App\Models\Delivery;

class DeliveryOrdersObserver
{
    /**
     * Handle the delivery "created" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function created(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "updated" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function updated(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "deleted" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function deleted(Delivery $delivery)
    {
        // $delivery->deliveryOrders()->delete(); //when we want to delete delivery all orders under this delivery it will be delete
    }

    /**
     * Handle the delivery "restored" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function restored(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "force deleted" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function forceDeleted(Delivery $delivery)
    {
        //
    }
}
