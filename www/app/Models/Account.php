<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'active_balance',
        'hold_balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addBalance($value)
    {
        $this->active_balance += $value;
        return $this->active_balance;
    }

    public function holdBalance($value)
    {
        if($this->active_balance>=$value){
            $this->hold_balance += $value;
            $this->active_balance -= $value; 
            return $this->hold_balance;
        } 
        return 0;
    }

    public function sendTo(&$account,$value)
    {
        if($value<0){
            return 0;
        } elseif ($this->hold_balance < $value) {
            return 0;
        }
        $this->hold_balance -= $value;
        $account->active_balance += $value;

        return $account->active_balance;
    }

}
