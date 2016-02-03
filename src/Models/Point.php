<?php

namespace Trexology\Pointable\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
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
     * @param $amount
     * @param $message
     * @param $data
     *
     * @return static
     */
    public function addTransaction(Model $pointable, $amount, $message, $data = null)
    {
        $transaction = new static();
        $transaction->$amount = $amount;

        $pointable->currentPoints += $amount;
        $transaction->currentPoints = $pointable->$currentAmount;

        $transaction->$message = $message;
        if ($data) {
          $transaction->fill($data);
        }
        // $transaction->save();
        $pointable->transactions()->save($transaction);

        return $transaction;
    }
}
