<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /** @use HasFactory<\Database\Factories\NewsletterFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'subscribed_at',
        'unsubscribed_at',
        'is_subscribed',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'is_subscribed' => 'boolean',
    ];

    public function scopeSubscribed($query)
    {
        return $query->where('is_subscribed', true);
    }

    public function scopeUnsubscribed($query)
    {
        return $query->where('is_subscribed', false);
    }

    public function subscribe()
    {
        $this->update([
            'is_subscribed' => true,
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
        ]);
    }

    public function unsubscribe()
    {
        $this->update([
            'is_subscribed' => false,
            'unsubscribed_at' => now(),
        ]);
    }

    public function toggleSubscription()
    {
        if ($this->is_subscribed) {
            $this->unsubscribe();
        } else {
            $this->subscribe();
        }
    }
}
