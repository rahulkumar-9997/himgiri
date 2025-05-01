<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCareRequest extends Model
{
    use HasFactory;
    protected $table = 'customer_care_requests';

    protected $fillable = [
        'ticket_id',
        'category_name',
        'model_name',
        'name',
        'email',
        'phone_number',
        'product_image',
        'message'
    ];
    
}
