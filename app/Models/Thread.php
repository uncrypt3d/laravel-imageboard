<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['board_id', 'user_id', 'title'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function posts()
    {
    return $this->hasMany(Post::class)->orderBy('created_at', 'asc');
    }

    public function checkAndLock()
    {
    if ($this->posts()->count() >= 999) {
        $this->locked = true;
        $this->save();
    }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
