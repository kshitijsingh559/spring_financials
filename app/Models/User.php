<?php

namespace App\Models;

use App\Events\UserCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            UserCreatedEvent::dispatch($user);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'age',
        'points',
        'address',
    ];

    public function winners()
    {
        return $this->hasMany(Winner::class, 'user_id', 'id');
    }
}
