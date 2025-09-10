<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'requester_name',
        'problem_detail',
        'definition_of_done',
        'status',
        'assigned_to',
        'user_id',
        'role',
        'assigned_at',
        'resolved_at'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime'
    ];
    
    // Auto generate ticket code when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (empty($ticket->ticket_code)) {
                $ticket->ticket_code = static::generateTicketCode();
            }
        });
    }

    // Relationship: Ticket belongs to team
    public function assignedTeam()
    {
        return $this->belongsTo(Team::class, 'assigned_to');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate unique ticket code
    public static function generateTicketCode(): string
    {
        do {
            $code = '';
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }

            $exists = self::where('ticket_code', $code)->exists();
        } while ($exists);

        return $code;
    }

    // Scope untuk filter berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk ticket yang belum selesai
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['open', 'in_progress']);
    }

    // Scope untuk filter berdasarkan role
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Scope untuk filter berdasarkan user (untuk user biasa hanya lihat tiket mereka sendiri)
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}