<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorTracking extends Model
{
    use HasFactory;
    protected $table = 'visitor_tracking';
    protected $fillable = ['ip_address', 'browser', 'page_name', 'location', 'visited_at', 'time_spent'];
}
