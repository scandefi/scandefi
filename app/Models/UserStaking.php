<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStaking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'token_id', 'amount', 'staking_days', 'status', 'transaction_id', 'meta'];

    protected $casts = ['meta' => 'array'];

    protected $appends = ['vault', 'harvest_amount', 'early_unstake_amount'];

    /* RELATIONS */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function token()
    {
        return $this->belongsTo(Token::class);
    }

    /* ATTRIBUTES */

    public function getVaultAttribute()
    {
        if(!empty($this->meta['vault'])):
            return collect([
                'id' => $this->meta['vault'][0],
                'stacked' => $this->meta['vault'][2],
                'reward' => $this->meta['vault'][1],
            ]);
        endif;
    }

    public function getHarvestAmountAttribute()
    {
        $decimals = $this->token()->first()->decimals;
        return number_format(((int) $this->vault['stacked'] + (int) $this->vault['reward']) / 10**$decimals, $decimals);
    }

    public function getEarlyUnstakeAmountAttribute()
    {
        $decimals = $this->token()->first()->decimals;
        return number_format(((int) $this->vault['stacked'] * 0.9) / 10**$decimals, $decimals);
    }
}
