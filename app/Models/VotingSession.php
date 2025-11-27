<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\MakeCacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingSession extends Model
{
    use HasFactory, HasUuid, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'batch_id',
        'start_time',
        'end_time',
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
            'batch_id' => 'string',
            'start_time' => 'datetime:Y-m-d H:i:s',
            'end_time' => 'datetime:Y-m-d H:i:s',
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
        return 'voting.session.cache';
    }

    /**
     * Get the batch that owns the voting session.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    /**
     * Get the voters for the voting session through batch.
     */
    public function voters()
    {
        return $this->hasManyThrough(Voter::class, Batch::class, 'id', 'batch_id', 'id', 'id');
    }

    /**
     * Get the votes for the voting session.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'voting_session_id');
    }
}
