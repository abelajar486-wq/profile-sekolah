<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryComment;
use App\Models\GalleryCommentLike;
use App\Models\GalleryLike;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    // Helper privat untuk mengambil data setting sebagai array
    private function getSettings()
    {
        return Setting::pluck('value', 'key')->toArray();

    }

    public function index()
    {
        $settings = $this->getSettings();
        $galleries = Gallery::latest()->take(6)->get();

        return view('public.home', compact('settings', 'galleries'));
    }

    public function about()
    {
        $settings = $this->getSettings();

        return view('public.about', compact('settings'));
    }

    public function gallery()
    {
        $settings = $this->getSettings();
        $galleries = Gallery::latest()->paginate(9);

        return view('public.gallery', compact('settings', 'galleries'));
    }

    public function contact()
    {
        $settings = $this->getSettings();

        return view('public.contact', compact('settings'));
    }

    public function toggleLike(Request $request, Gallery $gallery)
    {
        $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'session_id' => 'nullable|string',
        ]);

        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id') ?? $request->session()->getId();

        $query = GalleryLike::where('gallery_id', $gallery->id)
            ->where('created_at', '>=', now()->subDay());

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        $existingLike = $query->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            GalleryLike::create([
                'gallery_id' => $gallery->id,
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $gallery->todayLikes()->count(),
        ]);
    }

    public function storeComment(Request $request, Gallery $gallery)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'name' => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();
        $name = $userId ? null : $request->input('name');

        if (! $userId && ! $name) {
            return response()->json(['message' => 'Nama harus diisi untuk komentar.'], 422);
        }

        $comment = GalleryComment::create([
            'gallery_id' => $gallery->id,
            'user_id' => $userId,
            'name' => $name,
            'comment' => $request->input('comment'),
        ]);

        $request->session()->push('my_comment_ids', $comment->id);

        $comment->load('user');
        $comment->like_count = 0;
        $comment->is_liked = false;
        $comment->can_delete = true;
        $comment->formatted_date = 'Baru saja';
        $comment->created_at_formatted = $comment->created_at ? $comment->created_at->format('d M Y, H:i') : 'Baru saja';

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan!',
            'comment' => $comment,
        ]);
    }

    public function getComments(Gallery $gallery, Request $request)
    {
        $userId = Auth::id();
        $sessionId = $request->session()->getId();
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        $myCommentIds = $request->session()->get('my_comment_ids', []);

        // 1. Ambil komentar dengan relasi user dan hitung hari ini dalam 1 query saja (mencegah N+1 query)
        $comments = $gallery->comments()
            ->with(['user'])
            ->withCount(['likes as today_likes_count' => function ($q) {
                $q->where('created_at', '>=', now()->subDay());
            }])
            ->latest()
            ->take(50)
            ->get();

        // 2. Ambil ID komentar yang disukai user/session dalam 1 query bulk
        $commentIds = $comments->pluck('id');
        $likedCommentIds = [];
        if ($commentIds->isNotEmpty()) {
            $likeQuery = GalleryCommentLike::whereIn('gallery_comment_id', $commentIds)
                ->where('created_at', '>=', now()->subDay());
            if ($userId) {
                $likedCommentIds = $likeQuery->where('user_id', $userId)->pluck('gallery_comment_id')->toArray();
            } else {
                $likedCommentIds = $likeQuery->where('session_id', $sessionId)->pluck('gallery_comment_id')->toArray();
            }
        }

        // 3. Pemetaan data super cepat di memori
        $comments->transform(function ($comment) use ($userId, $isAdmin, $myCommentIds, $likedCommentIds) {
            $comment->like_count = $comment->today_likes_count ?? 0;
            $comment->is_liked = in_array($comment->id, $likedCommentIds);
            $comment->can_delete = $isAdmin || in_array($comment->id, $myCommentIds) || ($userId && $comment->user_id === $userId);
            $comment->formatted_date = $comment->created_at ? $comment->created_at->diffForHumans() : 'Baru saja';

            return $comment;
        });

        // 4. Hitung like galeri dalam query cepat
        $galleryLikeCount = $gallery->todayLikes()->count();
        $galleryLikeQuery = $gallery->likes()->where('created_at', '>=', now()->subDay());
        $galleryIsLiked = $userId
            ? $galleryLikeQuery->where('user_id', $userId)->exists()
            : $galleryLikeQuery->where('session_id', $sessionId)->exists();

        return response()->json([
            'gallery' => [
                'like_count' => $galleryLikeCount,
                'is_liked' => $galleryIsLiked,
            ],
            'comments' => $comments,
        ]);
    }

    public function toggleCommentLike(Request $request, GalleryComment $comment)
    {
        $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'session_id' => 'nullable|string',
        ]);

        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id') ?? $request->session()->getId();

        $query = GalleryCommentLike::where('gallery_comment_id', $comment->id)
            ->where('created_at', '>=', now()->subDay());

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        $existingLike = $query->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            GalleryCommentLike::create([
                'gallery_comment_id' => $comment->id,
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $comment->todayLikes()->count(),
        ]);
    }

    public function destroyComment(Request $request, GalleryComment $comment)
    {
        $user = Auth::user();
        $isAdmin = $user && $user->role === 'admin';
        $myCommentIds = $request->session()->get('my_comment_ids', []);
        $isMyComment = in_array($comment->id, $myCommentIds) || ($user && $comment->user_id === $user->id);

        if (! $isAdmin && ! $isMyComment) {
            return response()->json(['message' => 'Anda tidak memiliki akses untuk menghapus komentar ini.'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus!']);
    }
}
