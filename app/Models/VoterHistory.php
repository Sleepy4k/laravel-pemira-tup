<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\MakeCacheable;
use Illuminate\Database\Eloquent\Model;

class VoterHistory extends Model
{
    use HasUuid, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'candidate_type_id',
        'voted_at',
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
            'user_id' => 'string',
            'candidate_type_id' => 'string',
            'voted_at' => 'datetime',
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
        return 'voter.history.cache';
    }

    /**
     * Get the user that owns the voter history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the candidate type that owns the voter history.
     */
    public function candidateType()
    {
        return $this->belongsTo(CandidateType::class);
    }
}
