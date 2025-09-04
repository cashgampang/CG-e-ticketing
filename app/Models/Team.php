<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relationship: Team has many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    // Get active tickets count for this team member
    public function getActiveTicketsCount()
    {
        return $this->tickets()
            ->whereIn('status', ['open', 'in_progress'])
            ->count();
    }
}
