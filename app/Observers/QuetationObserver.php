<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Quetation;

class QuetationObserver
{
    /**
     * Handle the Quetation "created" event.
     *
     * @param  \App\Models\Quetation  $quetation
     * @return void
     */
    public function creating(Quetation $quetation)
    {
        $product = Product::find($quetation->product_id);

        $quetation->amount = $product->price;
    }

    /**
     * Handle the Quetation "updated" event.
     *
     * @param  \App\Models\Quetation  $quetation
     * @return void
     */
    public function updated(Quetation $quetation)
    {
        //
    }

    /**
     * Handle the Quetation "deleted" event.
     *
     * @param  \App\Models\Quetation  $quetation
     * @return void
     */
    public function deleted(Quetation $quetation)
    {
        //
    }

    /**
     * Handle the Quetation "restored" event.
     *
     * @param  \App\Models\Quetation  $quetation
     * @return void
     */
    public function restored(Quetation $quetation)
    {
        //
    }

    /**
     * Handle the Quetation "force deleted" event.
     *
     * @param  \App\Models\Quetation  $quetation
     * @return void
     */
    public function forceDeleted(Quetation $quetation)
    {
        //
    }
}
