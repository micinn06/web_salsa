@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Judul Foto -->
    <h1 class="text-center mb-4 animate__animated animate__fadeInDown" style="color: var(--highlight-color);">{{ $photo->title }}</h1>

    <!-- Gambar Foto -->
    <div class="text-center mb-5">
        <img src="{{ $photo->image_url }}" 
             class="img-fluid rounded shadow-lg animate__animated animate__zoomIn" 
             alt="{{ $photo->title }}" 
             style="max-height: 500px; object-fit: cover;">
    </div>

    <!-- Deskripsi Foto -->
    <div class="text-center mb-5">
        <p class="lead text-muted">{{ $photo->description }}</p>
    </div>

    <hr>

    <!-- Bagian Komentar -->
    <h3 class="mt-5 mb-4"><i class="fas fa-comments"></i> Komentar</h3>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- List Komentar -->
    @forelse ($photo->comments as $comment)
        <div class="card mb-4 shadow-sm border-0 animate__animated animate__fadeInUp comment-card">
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $comment->user->name }}</strong>
                        <span class="text-muted d-block">{{ $comment->created_at->format('d M Y') }}</span>
                    </div>
                    @if (Auth::id() === $comment->user_id)
                        <div>
                            <!-- Tombol Edit -->
                            <button class="btn btn-outline-primary btn-sm edit-button" 
                                    data-comment-id="{{ $comment->id }}" 
                                    data-comment-content="{{ $comment->content }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <button class="btn btn-outline-danger btn-sm delete-button" 
                                    data-comment-id="{{ $comment->id }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>

                            <form id="delete-comment-{{ $comment->id }}" 
                                  action="{{ route('comments.destroy', $comment->id) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endif
                </div>
                <p class="mt-3">{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Belum ada komentar.</p>
    @endforelse

    <!-- Form Tambah Komentar -->
    @auth
        <div class="mt-5">
            <h4 class="mb-3">Tambah Komentar</h4>
            <form action="{{ route('photos.comment.store', $photo->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Komentar</label>
                    <textarea name="content" id="content" rows="3" 
                              class="form-control rounded-3 shadow-sm" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill">
                    <i class="fas fa-paper-plane"></i> Kirim Komentar
                </button>
            </form>
        </div>
    @else
        <p class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-decoration-none">Login</a> untuk menambahkan komentar.
        </p>
    @endauth
</div>

<!-- Modal Edit Komentar -->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel">Edit Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-content" class="form-label">Komentar</label>
                        <textarea name="content" id="edit-content" rows="3" 
                                  class="form-control rounded-3 shadow-sm" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script>
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            const commentContent = this.getAttribute('data-comment-content');

            // Isi textarea dengan konten komentar
            document.getElementById('edit-content').value = commentContent;

            // Set action form untuk update komentar
            document.getElementById('editCommentForm').action = `/comments/${commentId}`;

            // Tampilkan modal
            new bootstrap.Modal(document.getElementById('editCommentModal')).show();
        });
    });

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            if (confirm('Yakin ingin menghapus komentar ini?')) {
                document.getElementById(`delete-comment-${commentId}`).submit();
            }
        });
    });
</script>
@endsection

<style>
    /* Warna Utama */
    :root {
        --bg-color: #eff0f3;
        --text-color: #0d0d0d;
        --text-muted: #2a2a2a;
        --btn-color: #ff8e3c;
        --highlight-color: #ff8e3c;
        --secondary-color: #fffffe;
        --tertiary-color: #d9376e;
    }

    /* Efek Hover untuk Card Komentar */
    .comment-card:hover {
        transform: scale(1.02);
        border-left: 4px solid var(--highlight-color);
    }

    /* Button Style */
    .btn-primary {
        background-color: var(--btn-color);
        color: #ffffff;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--tertiary-color);
        color: #ffffff;
    }

    /* Modal Form Styling */
    .modal-content {
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Image Styling */
    .img-fluid {
        transition: transform 0.3s;
    }

    .img-fluid:hover {
        transform: scale(1.02);
    }

    /* Card Title */
    h1.text-primary {
        color: var(--highlight-color);
    }

    /* Flash Message */
    .alert {
        font-size: 0.9rem;
    }
</style>
