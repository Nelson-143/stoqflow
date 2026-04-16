@extends('layouts.tabler')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('✨ Ad Studio') }}
                    </h2>
                    <div class="text-secondary mt-1">
                        {{ __('Create stunning ads in seconds — upload, customize, and download') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-icon alert-success alert-dismissible fade show mb-4" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="alert alert-icon alert-danger alert-dismissible fade show mb-4" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                            <strong>{{ __('Please fix the following errors:') }}</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('ads.generator.upload') }}" method="POST" enctype="multipart/form-data" id="adGeneratorForm">
                        @csrf

                        <div class="card card-lg shadow-sm border-0">
                            {{-- Card Header --}}
                            <div class="card-header bg-primary-lt py-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-lg bg-primary-lt text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="card-title mb-0">{{ __('Create Your Custom Ad') }}</h3>
                                        <p class="text-secondary mb-0 small">{{ __('Upload an image and add your branding in seconds') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 p-lg-5">
                                <div class="row g-4">

                                    {{-- Left Column: Image Upload & Preview --}}
                                    <div class="col-lg-6">
                                        <div class="card card-borderless bg-light">
                                            <div class="card-body text-center">
                                                <label class="form-label fw-semibold mb-3">{{ __(' Upload Image') }}</label>

                                                {{-- Dropzone Upload Area --}}
                                                <div class="upload-zone border-2 border-dashed rounded-3 p-4 mb-3 cursor-pointer transition-all hover:border-primary hover:bg-primary-lt"
                                                     id="dropZone"
                                                     onclick="document.getElementById('image').click()">
                                                    <input type="file"
                                                           class="d-none"
                                                           id="image"
                                                           name="photo"
                                                           accept="image/*"
                                                           onchange="previewImage(this)"
                                                           required>

                                                    <div id="uploadPlaceholder">
                                                        <div class="avatar avatar-lg bg-primary-lt text-primary mb-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                                        </div>
                                                        <p class="fw-medium mb-1">{{ __('Click or drag image here') }}</p>
                                                        <p class="text-secondary small mb-0">{{ __('JPG, PNG • Max 5MB') }}</p>
                                                    </div>

                                                    <div id="uploadPreview" class="d-none">
                                                        <img id="image-preview" class="img-fluid rounded-2 shadow-sm" src="" alt="Preview" style="max-height: 250px;">
                                                        <button type="button" class="btn btn-sm btn-ghost-danger mt-2" onclick="resetUpload(event)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                                                            {{ __('Remove') }}
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- Progress Bar --}}
                                                <div class="progress progress-sm d-none" id="uploadProgress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                                                </div>

                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                    <span class="badge bg-secondary-lt text-secondary">1:1 Square</span>
                                                    <span class="badge bg-secondary-lt text-secondary">16:9 Landscape</span>
                                                    <span class="badge bg-secondary-lt text-secondary">9:16 Portrait</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Right Column: Customization Options --}}
                                    <div class="col-lg-6">
                                        <div class="card card-borderless">
                                            <div class="card-body p-0">
                                                <label class="form-label fw-semibold">{{ __(' Customize Your Ad') }}</label>

                                                {{-- Overlay Text --}}
                                                <div class="mb-4">
                                                    <label class="form-label small text-muted">{{ __('Overlay Text') }}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                                                        </span>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="overlay_text"
                                                               placeholder="{{ __('e.g., Summer Sale 50% Off') }}"
                                                               maxlength="100">
                                                    </div>
                                                    <small class="text-secondary">{{ __('Add promotional text that appears on your ad') }}</small>
                                                </div>

                                                {{-- Watermark --}}
                                                <div class="mb-4">
                                                    <label class="form-label small text-muted">{{ __('💧 Watermark') }} <span class="text-secondary">{{ __('(optional)') }}</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v6"/><path d="M12 22v-6"/><path d="M2 12h6"/><path d="M22 12h-6"/><path d="M4.93 4.93l4.24 4.24"/><path d="M14.83 14.83l4.24 4.24"/><path d="M14.83 9.17l4.24-4.24"/><path d="M4.93 19.07l4.24-4.24"/></svg>
                                                        </span>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="watermark"
                                                               placeholder="{{ __('© Your Brand') }}"
                                                               maxlength="50">
                                                    </div>
                                                </div>

                                                {{-- Color Filter --}}
                                                <div class="mb-4">
                                                    <label class="form-label small text-muted">{{ __('Color Filter') }}</label>
                                                    <select class="form-select form-select-lg" name="color_filter">
                                                        <option value="none" selected>{{ __(' None (Original)') }}</option>
                                                        <option value="grayscale">{{ __(' Grayscale') }}</option>
                                                        <option value="sepia">{{ __('Vintage Sepia') }}</option>
                                                        <option value="contrast">{{ __(' High Contrast') }}</option>
                                                        <option value="vibrant">{{ __(' Vibrant') }}</option>
                                                        <option value="cool">{{ __(' Cool Tone') }}</option>
                                                        <option value="warm">{{ __(' Warm Tone') }}</option>
                                                    </select>
                                                </div>

                                                {{-- Advanced Toggle --}}
                                                <div class="mb-4">
                                                    <button type="button"
                                                            class="btn btn-link link-secondary p-0"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#advancedOptions"
                                                            aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                                        {{ __('Advanced Options') }}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="ms-1 toggle-icon"><path d="M6 9l6 6l6 -6"/></svg>
                                                    </button>

                                                    <div class="collapse mt-3" id="advancedOptions">
                                                        <div class="card card-body bg-light">
                                                            <div class="row g-3">
                                                                <div class="col-6">
                                                                    <label class="form-label small">{{ __('Opacity') }}</label>
                                                                    <input type="range" class="form-range" name="opacity" min="0" max="100" value="100">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label small">{{ __('Blur') }}</label>
                                                                    <input type="range" class="form-range" name="blur" min="0" max="10" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit Section --}}
                                <div class="mt-5 pt-4 border-top">
                                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                                        <div class="text-secondary small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M12 7v5l3 3"/></svg>
                                            {{ __('Processing takes ~5 seconds') }}
                                        </div>
                                        <button type="submit"
                                                class="btn btn-primary btn-lg px-5"
                                                id="generateBtn">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M13.8 12H3"/></svg>
                                                {{ __('Generate Ad') }}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Generated Ad Result --}}
                    @if (isset($ad_image))
                        <div class="card card-lg shadow-sm border-0 mt-4 animate__animated animate__fadeIn">
                            <div class="card-header bg-success-lt py-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-lg bg-success-lt text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="card-title mb-0 text-success">{{ __('✅ Ad Generated Successfully!') }}</h3>
                                        <p class="text-secondary mb-0 small">{{ __('Your custom ad is ready to download and share') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center p-4 p-lg-5">
                                <div class="position-relative d-inline-block mb-4">
                                    <img src="{{ $ad_image }}"
                                         alt="Generated Ad"
                                         class="img-fluid rounded-3 shadow-lg"
                                         style="max-width: 100%; height: auto; max-height: 400px;">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3">{{ __('NEW') }}</span>
                                </div>

                                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                    <a href="{{ $ad_image }}"
                                       download="custom-ad-{{ date('Ymd-His') }}.png"
                                       class="btn btn-success btn-lg px-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/><path d="M7 11l5 5l5-5"/><path d="M12 4v12"/></svg>
                                        {{ __('Download PNG') }}
                                    </a>
                                    <a href="{{ route('ads.generator') }}"
                                       class="btn btn-outline-secondary btn-lg px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                        {{ __('Create Another') }}
                                    </a>
                                </div>

                                {{-- Share Options --}}
                                <div class="mt-4 pt-4 border-top">
                                    <p class="text-secondary small mb-3">{{ __('Or share directly:') }}</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-icon btn-sm btn-facebook" title="Share on Facebook">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                        </button>
                                        <button class="btn btn-icon btn-sm btn-twitter" title="Share on Twitter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                        </button>
                                        <button class="btn btn-icon btn-sm btn-instagram" title="Share on Instagram">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                        </button>
                                        <button class="btn btn-icon btn-sm" title="Copy Link" onclick="copyImageLink('{{ $ad_image }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
@push('styles')
<style>
    .upload-zone {
        transition: all 0.2s ease;
        background: repeating-linear-gradient(45deg, #f8f9fa, #f8f9fa 10px, #ffffff 10px, #ffffff 20px);
    }
    .upload-zone:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.2s ease; }

    .toggle-icon { transition: transform 0.2s ease; }
    [data-bs-toggle="collapse"][aria-expanded="true"] .toggle-icon {
        transform: rotate(180deg);
    }

    .btn-facebook { background: #1877f2; color: white; }
    .btn-twitter { background: #1da1f2; color: white; }
    .btn-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; }

    @media (max-width: 768px) {
        .card-body.p-4.p-lg-5 { padding: 1.5rem !important; }
    }
</style>
@endpush

{{-- Scripts --}}
@push('scripts')
<script>
// Image Preview Function
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('uploadPlaceholder');
    const previewContainer = document.getElementById('uploadPreview');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert('{{ __("Image must be less than 5MB") }}');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            placeholder.classList.add('d-none');
            previewContainer.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
}

// Reset Upload
function resetUpload(e) {
    e.stopPropagation();
    const input = document.getElementById('image');
    const placeholder = document.getElementById('uploadPlaceholder');
    const previewContainer = document.getElementById('uploadPreview');

    input.value = '';
    previewContainer.classList.add('d-none');
    placeholder.classList.remove('d-none');
}

// Copy Image Link
function copyImageLink(url) {
    navigator.clipboard.writeText(url).then(() => {
        // Show toast notification
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 m-3';
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">{{ __("Link copied to clipboard!") }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        toast.addEventListener('hidden.bs.toast', () => toast.remove());
    });
}

// Form Submission with Loading State
document.getElementById('adGeneratorForm')?.addEventListener('submit', function(e) {
    const btn = document.getElementById('generateBtn');
    const originalContent = btn.innerHTML;

    // Check if image is selected
    const imageInput = document.getElementById('image');
    if (!imageInput.files || imageInput.files.length === 0) {
        e.preventDefault();
        alert('{{ __("Please upload an image first") }}');
        return;
    }

    // Show loading state
    btn.disabled = true;
    btn.innerHTML = `
        <span class="d-flex align-items-center gap-2">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            {{ __("Generating...") }}
        </span>
    `;

    // Optional: Show progress animation
    const progress = document.getElementById('uploadProgress');
    if (progress) {
        progress.classList.remove('d-none');
        const progressBar = progress.querySelector('.progress-bar');
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 90) {
                clearInterval(interval);
            } else {
                width += Math.random() * 15;
                progressBar.style.width = Math.min(width, 90) + '%';
            }
        }, 300);
    }
});

// Drag & Drop Support
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('image');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone?.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone?.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone?.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    dropZone.classList.add('border-primary', 'bg-primary-lt');
}

function unhighlight() {
    dropZone.classList.remove('border-primary', 'bg-primary-lt');
}

dropZone?.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    if (files.length) {
        fileInput.files = files;
        previewImage(fileInput);
    }
}

// Initialize Bootstrap Toasts
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toast').forEach(toastEl => {
        new bootstrap.Toast(toastEl).show();
    });
});
</script>
@endpush
@endsection
