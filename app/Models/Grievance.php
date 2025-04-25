<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status', 'response'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
