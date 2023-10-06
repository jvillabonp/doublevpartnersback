<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'token', 'description', 'user_id', 'status'
    ];

    protected $hidden = ['id', 'deleted_at', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
