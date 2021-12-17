<?php

namespace App\Observers;

use App\Models\Letter;

class LetterObserver
{
    /**
     * Handle the Letter "created" event.
     *
     * @param  \App\Models\Letter  $letter
     * @return void
     */
    public function created(Letter $letter)
    {
        log2file('LetterObserver',$letter);
    }

    /**
     * Handle the Letter "updated" event.
     *
     * @param  \App\Models\Letter  $letter
     * @return void
     */
    public function updated(Letter $letter)
    {
        //
    }

    /**
     * Handle the Letter "deleted" event.
     *
     * @param  \App\Models\Letter  $letter
     * @return void
     */
    public function deleted(Letter $letter)
    {
        //
    }

    /**
     * Handle the Letter "restored" event.
     *
     * @param  \App\Models\Letter  $letter
     * @return void
     */
    public function restored(Letter $letter)
    {
        //
    }

    /**
     * Handle the Letter "force deleted" event.
     *
     * @param  \App\Models\Letter  $letter
     * @return void
     */
    public function forceDeleted(Letter $letter)
    {
        //
    }
}
