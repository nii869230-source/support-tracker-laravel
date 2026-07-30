<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_title',
        'description',
        'status',
        'remarks',
    ];

        // relationship each activity log belongs to staff/user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
