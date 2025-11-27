<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\MakeCacheable;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasUuid, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'number',
        'head_name',
        'vice_name',
        'photo',
        'resume',
        'attachment',
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
            'number' => 'integer',
            'head_name' => 'string',
            'vice_name' => 'string',
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
        return 'candidate.cache';
    }

    /**
     * Get the full name attribute.
     */
    public function getNameAttribute(): string
    {
        return $this->head_name . ' & ' . $this->vice_name;
    }

    /**
     * Get the missions for the candidate.
     */
    public function missions()
    {
        return $this->hasMany(CandidateMission::class, 'candidate_id');
    }

    /**
     * Get the vision for the candidate.
     */
    public function vision()
    {
        return $this->hasOne(CandidateVision::class, 'candidate_id');
    }

    /**
     * Get the programs for the candidate.
     */
    public function programs()
    {
        return $this->hasMany(CandidateProgram::class, 'candidate_id');
    }

    /**
     * Get the votes for the candidate.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id');
    }
}
