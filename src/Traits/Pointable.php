<?php

namespace Trexology\Pointable\Traits;

use Trexology\Pointable\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

trait Pointable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions()
    {
        return $this->morphMany(Point::class, 'pointable');
    }

    // /**
    //  *
    //  * @return mix
    //  */
    // public function averageRating($round= null)
    // {
    //   if ($round) {
    //         return $this->ratings()
    //           ->selectRaw('ROUND(AVG(rating), '.$round.') as averageReviewRateable')
    //           ->pluck('averageReviewRateable');
    //     }
    //
    //     return $this->ratings()
    //         ->selectRaw('AVG(rating) as averageReviewRateable')
    //         ->pluck('averageReviewRateable');
    // }
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function countRating(){
    //   return $this->ratings()
    //       ->selectRaw('count(rating) as countReviewRateable')
    //       ->pluck('countReviewRateable');
    // }
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function sumRating()
    // {
    //     return $this->ratings()
    //         ->selectRaw('SUM(rating) as sumReviewRateable')
    //         ->pluck('sumReviewRateable');
    // }
    //
    // /**
    //  * @param $max
    //  *
    //  * @return mix
    //  */
    // public function ratingPercent($max = 5)
    // {
    //     $ratings = $this->ratings();
    //     $quantity = $ratings->count();
    //     $total = $ratings->selectRaw('SUM(rating) as total')->pluck('total');
    //     return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    // }

    /**
     *
     * @return double
     */
    public function currentPoints()
    {
        return (new Transaction())->getCurrentPoints($this);
    }

    /**
     * @param $amount
     * @param $message
     * @param $data
     *
     * @return static
     */
    public function addPoints($amount, $message, $data = null)
    {
        return (new Transaction())->addTransaction($this, $amount, $message, $data = null);
    }
}
