<?php

namespace Trexology\Pointable\Traits;

use Trexology\Pointable\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

trait Pointable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions($amount = null)
    {
        return $this->morphMany(Transaction::class, 'pointable')->orderBy('created_at','desc')->take($amount);
    }

    // /**
    //  *
    //  * @return mix
    //  */
    // public function averagePoint($round= null)
    // {
    //   if ($round) {
    //         return $this->transactions()
    //           ->selectRaw('ROUND(AVG(amount), '.$round.') as averagePointTransaction')
    //           ->pluck('averagePointTransaction');
    //     }
    //
    //     return $this->transactions()
    //         ->selectRaw('AVG(amount) as averagePointTransaction')
    //         ->pluck('averagePointTransaction');
    // }
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function countPoint(){
    //   return $this->transactions()
    //       ->selectRaw('count(amount) as countTransactions')
    //       ->pluck('countTransactions');
    // }
    //
    // /**
    //  *
    //  * @return mix
    //  */
    // public function sumPoint()
    // {
    //     return $this->transactions()
    //         ->selectRaw('SUM(amount) as sumPointTransactions')
    //         ->pluck('sumPointTransactions');
    // }
    //
    // /**
    //  * @param $max
    //  *
    //  * @return mix
    //  */
    // public function pointPercent($max = 5)
    // {
    //     $transactions = $this->transactions();
    //     $quantity = $transactions->count();
    //     $total = $transactions->selectRaw('SUM(amount) as total')->pluck('total');
    //     return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    // }

    /**
     *
     * @return mix
     */
    public function countTransactions(){
      return $this->transactions()
          ->count();
    }

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
        return (new Transaction())->addTransaction($this, $amount, $message, $data);
    }
}
