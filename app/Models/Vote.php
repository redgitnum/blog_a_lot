<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function post()
    {
        return $this->BelongsTo(Post::class);
    }

}
