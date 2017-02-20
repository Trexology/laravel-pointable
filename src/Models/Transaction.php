<?php

namespace Trexology\Pointable\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @var string
     */
    protected $table = 'point_transactions';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function pointable()
    {
        return $this->morphTo();
    }

    /**
     * @param Model $pointable
     *
     * @return static
     */
     public function getCurrentPoints(Model $pointable)
     {
         $currentPoint = Transaction::
         where('pointable_id', $pointable->id)
         ->where('pointable_type', $pointable->getMorphClass())
         ->orderBy('created_at', 'desc')
         ->pluck('current')->first();

         if (!$currentPoint) {
           $currentPoint = 0.0;
         }

         return $currentPoint;
     }

    /**
     * @param Model $pointable
     * @param $amount
     * @param $message
     * @param $data
     *
     * @return static
     */
    public function addTransaction(Model $pointable, $amount, $message, $data = null)
    {
        $transaction = new static();
        $transaction->amount = $amount;

        $transaction->current = $this->getCurrentPoints($pointable) + $amount;

        $transaction->message = $message;
        if ($data) {
          $transaction->fill($data);
        }
        // $transaction->save();
        $pointable->transactions()->save($transaction);

        return $transaction;
    }
}
