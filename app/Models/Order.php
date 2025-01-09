<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it's the plural of the model name)
    protected $table = 'orders';

    // Specify the fillable columns for mass assignment
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'amount', 
        'address', 
        'status', 
        'transaction_id', 
        'currency', 
        'first_name', 
        'last_name', 
        'bangla_name', 
        'photo', 
        'mobile_number', 
        'dob', 
        'nid', 
        'gender', 
        'blood_group', 
        'education', 
        'profession', 
        'skills', 
        'password', 
        'country', 
        'division', 
        'district', 
        'thana', 
        'membership_type', 
        'user_id'
    ];

    // Define any relationships (if necessary) - example for user_id as a foreign key
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
