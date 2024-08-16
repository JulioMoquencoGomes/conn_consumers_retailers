<?php
namespace App\Models; 
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = "websites";

    protected $fillable = [
        'id',
        'name',
        'url',
        'traffic',
        'da',
        'dr',
        'spam',
        'trafficsprint',
        'niche',
        'contact',
        'email',
        'user_id'
    ];
}
?>