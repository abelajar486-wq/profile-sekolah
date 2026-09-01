<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'user_id',
        'name',
        'comment',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(GalleryCommentLike::class);
    }

    public function todayLikes()
    {
        return $this->likes()->where('created_at', '>=', now()->subDay());
    }
}
