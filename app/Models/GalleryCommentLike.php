<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCommentLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_comment_id',
        'user_id',
        'session_id',
    ];

    public function comment()
    {
        return $this->belongsTo(GalleryComment::class, 'gallery_comment_id');
    }
}
