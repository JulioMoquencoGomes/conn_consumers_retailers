<?php
namespace App\Models; 
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $table = "competitors";

    protected $fillable = [
        'id',
        'name',
        'url',
        'niche',
        'user_id',
        'start_km',
        'website_id'
    ];
}
?>