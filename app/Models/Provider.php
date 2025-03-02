<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /** @use HasFactory<\Database\Factories\ProviderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'provider_token',
        'avatar',
        'name',
        'nickname',
        'token',
    ];

    /**
     * Get the user that owns the provider.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Find a provider by the given provider and provider ID.
     *
     * @param  string  $provider
     * @param  string  $providerId
     * @return static|null
     */
    public static function findByProvider($provider, $providerId)
    {
        return static::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }

    /**
     * Find a provider by the given user ID.
     *
     * @param  int  $userId
     * @return static|null
     */
    public static function findByUserId($userId)
    {
        return static::where('user_id', $userId)
            ->first();
    }
}
