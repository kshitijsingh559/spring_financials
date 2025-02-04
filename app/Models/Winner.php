<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Winner extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'points',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
