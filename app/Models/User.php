<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Stevebauman\Location\Facades\Location;
use App\Traits\TracksUserDevices;

class User extends Authenticatable  implements HasMedia, FilamentUser
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, InteractsWithMedia, TracksUserDevices;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'email_verified_at',
        'avatar',
        'last_login',
        'last_ip',
        'login_count',
        'city',
        'region',
        'country',
        'country_code',
        'timezone',
        'locale',
        'currency',
        'ip_address',
        'latitude',
        'longitude',
        'registration_ip',
        'browser',
        'platform',
        'device',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login' => 'datetime',
            'login_count' => 'integer',
            'status' => 'integer',
            'is_banned' => 'boolean',
            'banned_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the panel instance associated with the user.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin') && $this->hasVerifiedEmail();
    }


    /**
     * Get all of the user's phones.
     */
    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    /**
     * Get the user's social providers.
     */
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    /**
     * Get all of the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function isAuthenticated(): bool
    {
        return $this->exists;
    }

    /**
     * Update user's location data from IP address
     */
    public function updateLocationData(?string $ip = null): void
    {
        $ip = $ip ?: request()->ip();
        $location = Location::get();

        if ($location) {
            $this->update([
                'ip_address' => $ip,
                'city' => $location->cityName ?? $this->city,
                'region' => $location->regionName ?? $this->region,
                'country' => $location->countryName,
                'country_code' => $location->countryCode ?? null,
                'currency' => $location->currencyCode ?? $this->currency ?? 'USD',
                'latitude' => $location->latitude ?? null,
                'longitude' => $location->longitude ?? null,
                'timezone' => $location->timezone ?? $this->timezone ?? 'UTC',
            ]);
        }
    }
}
