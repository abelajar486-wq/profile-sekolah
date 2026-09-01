@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4" role="alert" style="border-radius: 12px; background-color: #ecfdf5; color: #065f46; border: 1px solid rgba(16, 185, 129, 0.25) !important;">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 34px; height: 34px; background-color: rgba(16, 185, 129, 0.15); color: #059669;">
                <i class="bi bi-check-circle-fill fs-6"></i>
            </div>
            <span class="fw-medium">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem; opacity: 0.6;"></button>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4" role="alert" style="border-radius: 12px; background-color: #f0f9ff; color: #0369a1; border: 1px solid rgba(56, 189, 248, 0.25) !important;">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 34px; height: 34px; background-color: rgba(14, 165, 233, 0.15); color: #0284c7;">
                <i class="bi bi-info-circle-fill fs-6"></i>
            </div>
            <span class="fw-medium">{{ session('info') }}</span>
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem; opacity: 0.6;"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4" role="alert" style="border-radius: 12px; background-color: #fffbeb; color: #92400e; border: 1px solid rgba(245, 158, 11, 0.25) !important;">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 34px; height: 34px; background-color: rgba(245, 158, 11, 0.15); color: #d97706;">
                <i class="bi bi-exclamation-circle-fill fs-6"></i>
            </div>
            <span class="fw-medium">{{ session('warning') }}</span>
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem; opacity: 0.6;"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b; border: 1px solid rgba(239, 68, 68, 0.25) !important;">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 34px; height: 34px; background-color: rgba(239, 68, 68, 0.15); color: #dc2626;">
                <i class="bi bi-exclamation-triangle-fill fs-6"></i>
            </div>
            <span class="fw-medium">{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem; opacity: 0.6;"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-start justify-content-between p-3 mb-4" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b; border: 1px solid rgba(239, 68, 68, 0.25) !important;">
        <div class="d-flex align-items-start gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0 mt-1" style="width: 34px; height: 34px; background-color: rgba(239, 68, 68, 0.15); color: #dc2626;">
                <i class="bi bi-exclamation-triangle-fill fs-6"></i>
            </div>
            <div>
                <strong class="d-block fw-semibold mb-1">Terjadi kesalahan! Silakan periksa kembali isian berikut:</strong>
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="btn-close ms-2 mt-1" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem; opacity: 0.6;"></button>
    </div>
@endif
