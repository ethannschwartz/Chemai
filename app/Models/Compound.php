<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compound extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'smile',
        'img_url',
    ];

    /**
     * @return BelongsToMany
     */
    public function User(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
