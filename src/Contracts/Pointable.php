<?php

namespace Trexology\Pointable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Pointable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions();

    // /**
    //  *
    //  * @return mix
    //  */
    // public function averageRating($round= null);
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function countRating();
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function sumRating();
    //
    // /**
    //  * @param $max
    //  *
    //  * @return mix
    //  */
    // public function ratingPercent($max = 5);

    /**
     * @param $amount
     * @param $message
     * @param $data
     *
     * @return static
     */
    public function addPoints($amount, $message, $data = null);
}
