@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2">Dokumentasi & Portofolio</span>
            <h1 class="fw-bold display-5">Galeri Kegiatan Sekolah</h1>
            <p class="text-muted mx-auto" style="max-width: 550px;">Dokumentasi berbagai kegiatan, fasilitas, serta prestasi karya siswa dan guru.</p>
        </div>

        <div class="row g-4">
            @forelse($galleries as $index => $item)
                <div class="col-6 col-md-4 col-lg-3 gallery-card stagger-item" data-bs-toggle="modal" data-bs-target="#galleryModal" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 80 }}" data-gallery-id="{{ $item->id }}" data-image="{{ url('optimized-image/' . $item->image) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-upload-date="{{ ($item->upload_date ?? $item->created_at)->format('d M Y') }}" style="cursor: pointer; transition-delay: {{ ($index % 4) * 60 }}ms;">
                    <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden gallery-item-card">
                        <div class="img-zoom-container position-relative">
                            @if(!empty($item->image))
                                <img src="{{ url('optimized-image/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 220px; object-fit: cover;" loading="lazy" onload="this.classList.add('loaded');" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="bg-light d-none align-items-center justify-content-center" style="height: 220px; display: none;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 transition-opacity">
                                <div class="bg-white bg-opacity-90 rounded-circle p-3 shadow-lg">
                                    <i class="bi bi-arrows-fullscreen text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <h5 class="card-title fw-bold mb-1 text-truncate">{{ $item->title }}</h5>
                            <p class="card-text text-muted small mb-1 text-truncate">{{ Str::limit($item->description, 70) }}</p>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ ($item->upload_date ?? $item->created_at)->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5" data-aos="fade-up">
                    <p class="text-muted">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
            {{ $galleries->links() }}
        </div>
    </div>
</div>

<!-- Gallery Detail Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="galleryModalTitle">Detail Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="row g-4">
                    <div class="col-lg-7 position-relative" style="min-height: 250px;">
                        <div id="galleryModalImgSpinner" class="position-absolute top-50 start-50 translate-middle text-center" style="z-index: 5;">
                            <div class="spinner-border text-primary" role="status" style="width: 2.2rem; height: 2.2rem;"></div>
                            <p class="text-muted small mt-2 mb-0">Memuat gambar...</p>
                        </div>
                        <img id="galleryModalImage" src="" alt="" class="w-100 rounded-4 position-relative" style="max-height: 70vh; object-fit: contain; background: #f8f9fa; transition: opacity 0.3s ease; opacity: 0;" onload="this.style.opacity=1; document.getElementById('galleryModalImgSpinner').classList.add('d-none');">
                    </div>
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2 d-inline-block">Dokumentasi</span>
                            <h5 class="fw-bold mb-2 text-dark" id="galleryModalTitleText"></h5>
                            <div class="d-flex align-items-center gap-2 text-muted mb-2">
                                <i class="bi bi-calendar3"></i>
                                <small id="galleryModalUploadDate"></small>
                            </div>
                            <p class="text-secondary small mb-0" id="galleryModalDescription"></p>
                        </div>
                        <div class="d-flex gap-2 mb-3">
                            <button class="btn btn-outline-danger flex-fill rounded-pill px-3" id="galleryLikeBtn">
                                <i class="bi bi-heart"></i> <span id="galleryLikeCount">0</span> Suka
                            </button>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary rounded-pill px-3" type="button" id="shareDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-share"></i> Share
                                </button>
                                <ul class="dropdown-menu w-100 rounded-3 border-0 shadow-sm" aria-labelledby="shareDropdownBtn">
                                    <li><a class="dropdown-item rounded-2" href="#" id="shareFacebook"><i class="bi bi-facebook me-2 text-primary"></i>Facebook</a></li>
                                    <li><a class="dropdown-item rounded-2" href="#" id="shareLinkedIn"><i class="bi bi-linkedin me-2 text-info"></i>LinkedIn</a></li>
                                    <li><a class="dropdown-item rounded-2" href="#" id="shareInstagram"><i class="bi bi-instagram me-2 text-warning"></i>Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="comments-section">
                            <h6 class="fw-bold mb-3 text-dark">Komentar</h6>
                            <div id="commentsList" class="mb-3" style="max-height: 300px; overflow-y: auto;">
                                <div class="text-center py-4">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    <p class="text-muted small mt-2">Memuat komentar...</p>
                                </div>
                            </div>
                            <form id="commentForm">
                                @auth
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                @endauth
                                @guest
                                    <div class="mb-2">
                                        <input type="text" name="name" class="form-control form-control-sm rounded-3 border-0 bg-light" placeholder="Nama Anda" required>
                                    </div>
                                @endguest
                                <div class="input-group">
                                    <textarea name="comment" class="form-control rounded-start-3 border-0 bg-light" rows="2" placeholder="Tulis komentar..." required></textarea>
                                    <button class="btn btn-primary rounded-end-3 px-4" type="submit"><i class="bi bi-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gallery-item-card {
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform;
    }

    .gallery-item-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.14) !important;
    }

    .gallery-overlay {
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(2px);
        opacity: 0;
        transition: opacity 0.4s ease, backdrop-filter 0.4s ease;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
        backdrop-filter: blur(4px);
    }

    .gallery-card img {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    .gallery-card img.loaded {
        animation: none;
        background: none;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Modal smooth transition */
    .modal.fade .modal-dialog {
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-content {
        border-radius: 16px;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Smooth like button animation */
    #galleryLikeBtn {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .like-comment-btn {
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .like-comment-btn:hover {
        transform: scale(1.08);
    }

    #galleryLikeBtn, .like-comment-btn { position: relative; overflow: visible; }

    @keyframes heartPop {
        0%   { transform: scale(1); }
        35%  { transform: scale(1.45); }
        60%  { transform: scale(.8); }
        100% { transform: scale(1); }
    }
    .heart-pop { animation: heartPop .45s cubic-bezier(.2,.8,.3,1.2); }

    @keyframes floatHeart {
        0%   { opacity: 0; transform: translate(-50%, 0) scale(.5) rotate(var(--r, 0deg)); }
        20%  { opacity: 1; }
        100% { opacity: 0; transform: translate(-50%, -78px) scale(1.15) rotate(var(--r, 0deg)); }
    }
    .float-heart {
        position: absolute;
        left: 50%; top: 45%;
        pointer-events: none;
        color: #e2336b;
        font-size: 1.05rem;
        z-index: 6;
        animation: floatHeart 1s ease forwards;
    }

    @keyframes countBump {
        0%   { transform: translateY(0) scale(1); }
        40%  { transform: translateY(-6px) scale(1.2); }
        100% { transform: translateY(0) scale(1); }
    }
    .count-bump { display: inline-block; animation: countBump .4s ease; }

    .comment-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 12px 14px;
        margin-bottom: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }
    .comment-item:hover {
        background: #ffffff;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    @keyframes commentSmoothInsert {
        0% {
            opacity: 0;
            transform: translateY(-20px) scale(0.94);
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            background-color: #e0f2fe;
            border-color: #0284c7;
            box-shadow: 0 0 18px rgba(2, 132, 199, 0.25);
        }
        55% {
            opacity: 1;
            transform: translateY(2px) scale(1.01);
            max-height: 250px;
            padding-top: 12px;
            padding-bottom: 12px;
            margin-bottom: 10px;
            background-color: #f0f9ff;
            border-color: #38bdf8;
            box-shadow: 0 4px 20px rgba(56, 189, 248, 0.2);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            max-height: 250px;
            padding-top: 12px;
            padding-bottom: 12px;
            margin-bottom: 10px;
            background-color: #f8fafc;
            border-color: #e2e8f0;
            box-shadow: none;
        }
    }
    .comment-smooth-enter {
        animation: commentSmoothInsert 0.75s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes commentSmoothDelete {
        0% {
            opacity: 1;
            transform: translateX(0) scale(1);
            max-height: 200px;
        }
        40% {
            opacity: 0.5;
            transform: translateX(20px) scale(0.95);
            background-color: #fef2f2;
            border-color: #fca5a5;
        }
        100% {
            opacity: 0;
            transform: translateX(40px) scale(0.9);
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            border-width: 0;
        }
    }
    .comment-smooth-exit {
        animation: commentSmoothDelete 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentGalleryId = null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

    function handleGalleryCardClick(card) {
        if (!card) return;

        currentGalleryId = card.dataset.galleryId;
        const imageUrl = card.dataset.image;
        const title = card.dataset.title || 'Detail Galeri';

        const modalImg = document.getElementById('galleryModalImage');
        const modalImgSpinner = document.getElementById('galleryModalImgSpinner');
        const modalTitle = document.getElementById('galleryModalTitle');
        const modalTitleText = document.getElementById('galleryModalTitleText');
        const modalDate = document.getElementById('galleryModalUploadDate');
        const modalDesc = document.getElementById('galleryModalDescription');

        if (modalImgSpinner) modalImgSpinner.classList.remove('d-none');

        if (modalImg) {
            modalImg.style.opacity = '0';
            modalImg.src = imageUrl;
            modalImg.alt = title;
            if (modalImg.complete && modalImg.naturalWidth !== 0) {
                modalImg.style.opacity = '1';
                if (modalImgSpinner) modalImgSpinner.classList.add('d-none');
            }
        }
        if (modalTitle) modalTitle.textContent = title;
        if (modalTitleText) modalTitleText.textContent = title;
        if (modalDate) modalDate.textContent = card.dataset.uploadDate ? ('Diunggah: ' + card.dataset.uploadDate) : '';
        if (modalDesc) modalDesc.textContent = card.dataset.description || '';

        loadGalleryData(currentGalleryId);

        const modalEl = document.getElementById('galleryModal');
        if (modalEl && typeof bootstrap !== 'undefined') {
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.show();
        }
    }

    document.addEventListener('click', function (e) {
        const card = e.target.closest('.gallery-card');
        if (card) {
            handleGalleryCardClick(card);
        }
    });

    async function loadGalleryData(galleryId) {
        const commentsList = document.getElementById('commentsList');
        commentsList.innerHTML = '<div class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary" role="status"></div><p class="text-muted small mt-2">Memuat komentar...</p></div>';

        try {
            const response = await fetch(`/gallery/${galleryId}/comments`, {
                headers: {
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) throw new Error('Gagal memuat data');

            const data = await response.json();
            const gallery = data.gallery;
            const comments = data.comments;

            document.getElementById('galleryLikeCount').textContent = gallery.like_count;
            updateGalleryLikeButton(gallery.is_liked);

            renderComments(comments);
        } catch (error) {
            commentsList.innerHTML = '<div class="text-center py-4 text-danger">Gagal memuat komentar.</div>';
        }
    }

    function updateGalleryLikeButton(isLiked) {
        const btn = document.getElementById('galleryLikeBtn');
        const icon = btn.querySelector('i');
        if (isLiked) {
            btn.classList.remove('btn-outline-danger');
            btn.classList.add('btn-danger');
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill');
        } else {
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-outline-danger');
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart');
        }
    }

    function popHeart(icon) {
        icon.classList.remove('heart-pop');
        void icon.offsetWidth;
        icon.classList.add('heart-pop');
    }

    function burstHearts(button) {
        for (let i = 0; i < 6; i++) {
            const h = document.createElement('i');
            h.className = 'bi bi-heart-fill float-heart';
            h.style.left = (42 + (Math.random() * 16 - 8)) + '%';
            h.style.setProperty('--r', (Math.random() * 50 - 25) + 'deg');
            h.style.animationDelay = (Math.random() * 0.15) + 's';
            button.appendChild(h);
            setTimeout(function () { h.remove(); }, 1200);
        }
    }

    function bumpCount(el) {
        el.classList.remove('count-bump');
        void el.offsetWidth;
        el.classList.add('count-bump');
    }

    function renderComments(comments) {
        const commentsList = document.getElementById('commentsList');
        
        if (comments.length === 0) {
            commentsList.innerHTML = '<div class="text-center py-4 text-muted">Belum ada komentar.</div>';
            return;
        }

        let html = '';
        comments.forEach(function (comment) {
            const authorName = escapeHtml(comment.name || (comment.user ? comment.user.name : 'User'));
            const initial = authorName.charAt(0).toUpperCase();
            const dateDisplay = comment.formatted_date || comment.created_at_formatted || 'Baru saja';

            html += `
                <div class="comment-item">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 28px; height: 28px; font-size: 0.75rem; flex-shrink: 0; background: linear-gradient(135deg, #0d6efd, #0b5ed7) !important;">
                                ${initial}
                            </div>
                            <div>
                                <strong class="text-dark d-block" style="font-size: 0.875rem; line-height: 1.2;">${authorName}</strong>
                                <small class="text-muted" style="font-size: 0.725rem;">${escapeHtml(dateDisplay)}</small>
                            </div>
                        </div>
                    </div>
                    <p class="mb-2 text-dark mt-2" style="font-size: 0.875rem; line-height: 1.45; word-break: break-word;">${escapeHtml(comment.comment)}</p>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm ${comment.is_liked ? 'btn-danger' : 'btn-outline-danger'} like-comment-btn py-0 px-2" style="font-size: 0.75rem; border-radius: 6px;" data-comment-id="${comment.id}">
                            <i class="bi ${comment.is_liked ? 'bi-heart-fill' : 'bi-heart'}"></i> <span class="like-count">${comment.like_count}</span>
                        </button>
                        ${comment.can_delete ? `<button class="btn btn-sm btn-outline-secondary delete-comment-btn py-0 px-2" style="font-size: 0.75rem; border-radius: 6px;" data-comment-id="${comment.id}" title="Hapus komentar"><i class="bi bi-trash"></i></button>` : ''}
                    </div>
                </div>
            `;
        });

        commentsList.innerHTML = html;
    }

    document.getElementById('commentsList').addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.delete-comment-btn');
        if (deleteBtn) {
            e.preventDefault();
            e.stopPropagation();
            const commentId = deleteBtn.dataset.commentId;
            deleteComment(commentId, deleteBtn);
            return;
        }

        const likeBtn = e.target.closest('.like-comment-btn');
        if (likeBtn) {
            e.preventDefault();
            e.stopPropagation();
            const commentId = likeBtn.dataset.commentId;
            toggleCommentLike(commentId, likeBtn);
            return;
        }
    });

    async function deleteComment(commentId, btn) {
        if (!commentId) return;

        const isConfirmed = window.confirm('Apakah Anda yakin ingin menghapus komentar ini?');
        if (!isConfirmed) return;

        const item = btn.closest('.comment-item');
        if (!item) return;

        btn.disabled = true;
        const originalContent = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" style="width: 10px; height: 10px;"></span>';

        try {
            const response = await fetch(`/gallery/comment/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            });

            const data = await response.json().catch(function () { return {}; });

            if (!response.ok) {
                alert(data.message || 'Gagal menghapus komentar. Anda tidak memiliki akses.');
                btn.disabled = false;
                btn.innerHTML = originalContent;
                return;
            }

            item.classList.add('comment-smooth-exit');
            setTimeout(function () {
                item.remove();
                const commentsList = document.getElementById('commentsList');
                if (!commentsList.querySelector('.comment-item')) {
                    commentsList.innerHTML = '<div class="text-center py-4 text-muted small">Belum ada komentar.</div>';
                }
            }, 480);
        } catch (error) {
            console.error('Error deleting comment:', error);
            alert('Terjadi kesalahan saat menghapus komentar. Silakan coba lagi.');
            btn.disabled = false;
            btn.innerHTML = originalContent;
    }
    }

    async function toggleCommentLike(commentId, btnElement) {
        try {
            const response = await fetch(`/gallery/comment/${commentId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    user_id: {{ Auth::id() ?: 'null' }},
                }),
            });

            const data = await response.json();
            const countSpan = btnElement.querySelector('.like-count');
            const icon = btnElement.querySelector('i');
            countSpan.textContent = data.count;
            bumpCount(countSpan);
            popHeart(icon);

            if (data.liked) {
                btnElement.classList.remove('btn-outline-danger');
                btnElement.classList.add('btn-danger');
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
            } else {
                btnElement.classList.remove('btn-danger');
                btnElement.classList.add('btn-outline-danger');
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    document.getElementById('galleryLikeBtn').addEventListener('click', async function () {
        if (!currentGalleryId) return;
        const btn = this;
        const icon = btn.querySelector('i');
        popHeart(icon);
        if (icon.classList.contains('bi-heart')) {
            burstHearts(btn);
        }

        try {
            const response = await fetch(`/gallery/${currentGalleryId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    user_id: {{ Auth::id() ?: 'null' }},
                }),
            });

            const data = await response.json();
            const countEl = document.getElementById('galleryLikeCount');
            countEl.textContent = data.count;
            bumpCount(countEl);
            updateGalleryLikeButton(data.liked);
            if (data.liked) {
                burstHearts(btn);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    document.getElementById('shareFacebook').addEventListener('click', function (e) {
        e.preventDefault();
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    });

    document.getElementById('shareLinkedIn').addEventListener('click', function (e) {
        e.preventDefault();
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'width=600,height=400');
    });

    document.getElementById('shareInstagram').addEventListener('click', function (e) {
        e.preventDefault();
        navigator.clipboard.writeText(window.location.href).then(function () {
            alert('Tautan disalin! Buka Instagram dan paste untuk berbagi.');
        }).catch(function () {
            alert('Gagal menyalin tautan.');
        });
    });

    document.getElementById('commentForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        if (!currentGalleryId) return;

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

        const formData = new FormData(this);
        const comment = formData.get('comment');
        const name = formData.get('name');

        try {
            const response = await fetch(`/gallery/${currentGalleryId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: new URLSearchParams({ comment: comment, name: name || '' }),
            });

            const data = await response.json();

            if (!response.ok) {
                alert(data.message || 'Gagal menambahkan komentar.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                return;
            }

            this.reset();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;

            const commentsList = document.getElementById('commentsList');
            if (commentsList.children.length === 1 && !commentsList.querySelector('.comment-item')) {
                commentsList.innerHTML = '';
            }

            const newComment = data.comment;
            const authorName = escapeHtml(newComment.name || (newComment.user ? newComment.user.name : 'User'));
            const commentText = escapeHtml(newComment.comment);
            const initial = authorName.charAt(0).toUpperCase();

            const commentElement = document.createElement('div');
            commentElement.className = 'comment-item comment-smooth-enter';
            commentElement.innerHTML = `
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 28px; height: 28px; font-size: 0.75rem; flex-shrink: 0; background: linear-gradient(135deg, #0d6efd, #0b5ed7) !important;">
                            ${initial}
                        </div>
                        <div>
                            <strong class="text-dark d-block" style="font-size: 0.875rem; line-height: 1.2;">${authorName}</strong>
                            <small class="text-muted" style="font-size: 0.725rem;">Baru saja</small>
                        </div>
                    </div>
                </div>
                <p class="mb-2 text-dark mt-2" style="font-size: 0.875rem; line-height: 1.45; word-break: break-word;">${commentText}</p>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-danger like-comment-btn py-0 px-2" style="font-size: 0.75rem; border-radius: 6px;" data-comment-id="${newComment.id}">
                        <i class="bi bi-heart"></i> <span class="like-count">0</span>
                    </button>
                    ${newComment.can_delete ? `<button class="btn btn-sm btn-outline-secondary delete-comment-btn py-0 px-2" style="font-size: 0.75rem; border-radius: 6px;" data-comment-id="${newComment.id}" title="Hapus komentar"><i class="bi bi-trash"></i></button>` : ''}
                </div>
            `;

            const likeBtn = commentElement.querySelector('.like-comment-btn');
            if (likeBtn) {
                likeBtn.addEventListener('click', function () {
                    toggleCommentLike(newComment.id, this);
                });
            }

            const delBtn = commentElement.querySelector('.delete-comment-btn');
            if (delBtn) {
                delBtn.addEventListener('click', function () {
                    deleteComment(newComment.id, this);
                });
            }

            commentsList.insertBefore(commentElement, commentsList.firstChild);
            commentsList.scrollTo({ top: 0, behavior: 'smooth' });

        } catch (error) {
            console.error('Error:', error);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
        }
    });
});

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
@endsection