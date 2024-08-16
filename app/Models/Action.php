<?php
namespace App\Models; 
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = "actions";

    protected $fillable = [
        'id',
        'act',
        'user_id',
        'website_id',
    ];
}

?>