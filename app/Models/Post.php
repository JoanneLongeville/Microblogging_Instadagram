<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Conner\Likeable\Likeable;

class Post extends Model
{
    use HasFactory;
    use Likeable;

    //Un post ne peut avoir qu'un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'img_url',
        'description',
    ];
}
