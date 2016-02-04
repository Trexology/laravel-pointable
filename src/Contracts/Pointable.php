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
    // public function averagePoint($round= null);
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function countPoint();
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function sumPoint();
    //
    // /**
    //  * @param $max
    //  *
    //  * @return mix
    //  */
    // public function pointPercent($max = 5);

    /**
     *
     * @return mix
     */
    public function countTransactions();


    /**
     * @param $amount
     * @param $message
     * @param $data
     *
     * @return static
     */
    public function addPoints($amount, $message, $data = null);
}
