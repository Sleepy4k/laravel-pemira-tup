<?php

namespace App\Models;

use App\Casts\AsEncrypt;
use App\Concerns\HasUuid;
use App\Concerns\MakeCacheable;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasUuid, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'vote_token',
        'has_voted',
        'voted_at',
        'batch_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'name' => AsEncrypt::class,
            'email' => AsEncrypt::class,
            'vote_token' => AsEncrypt::class,
            'has_voted' => 'boolean',
            'voted_at' => 'datetime',
            'batch_id' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Set the cache prefix.
     *
     * @return string
     */
    public function setCachePrefix(): string {
        return 'voter.cache';
    }

    /**
     * Route notifications for the voter.
     */
    public function routeNotificationFor()
    {
        return $this->email;
    }

    /**
     * Get the batch that owns the voter.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
