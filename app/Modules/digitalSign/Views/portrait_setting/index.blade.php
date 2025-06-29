@extends('Base::layouts.base')

@section('title')
{{ $title }}
@endsection

@section('extra-css')
    <style>
        .preview-wrapper {
            width: 540px; /* 1080 x 0.5 */
            height: 960px; /* 1920 x 0.5 */
            overflow: hidden;
            margin: auto;
        }

        .preview-wrapper iframe {
            width: 1080px;
            height: 1920px;
            transform: scale(0.5);
            transform-origin: top left;
            border: none;
            display: block;
        }
    </style>

@endsection

@section('header-title')
{{ $title }}
@endsection

@section('header-desc')
{!! $subtitle !!}
@endsection

@section('content-header-right')
<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $nmB => $url)
        <li class="breadcrumb-item"><a href="{{ $url }}">{{ $nmB }}</a></li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">{{ __('Base::misc.setting_txt').' '.$title }}</h4>
                <p class="sub-header font-13 mb-3">
                    {{ $subtitle }}
                </p>
                <form class="form form-horizontal mt-3" action="{{ route($base_route.'.update') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row mb-2">
                            <label for="nama_template" class="col-md-4 col-form-label">
                                <code>nama_template</code>
                            </label>
                            <div class="col-md-8">
                                <select id="nama_template"
                                        name="nama_template"
                                        class="form-select @error('nama_template') is-invalid @enderror">
                                    <option value="">-- Pilih Template --</option>
                                    @foreach($template_options as $value => $label)
                                        <option value="{{ $value }}"
                                                @if(old('nama_template', $setting->nama_template ?? '') == $value) selected @endif>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nama_template')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="button" class="btn btn-outline-info" onclick="previewTemplate()">
                                    <i class="bi bi-eye"></i> Preview Template
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                {!! (new BApp)->btnSubmit(__('Base::misc.save_txt')) !!}
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-xl-custom">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Preview Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body bg-dark p-0 d-flex justify-content-center">
                            <div class="preview-wrapper bg-white shadow">
                                <iframe id="previewIframe" src=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script>
        function previewTemplate() {
            const selected = document.getElementById('nama_template').value;
            if (!selected) {
                alert('Silakan pilih template terlebih dahulu.');
                return;
            }

            const url = "{{ route('portrait_setting.preview', ['template' => '__TEMPLATE__']) }}".replace('__TEMPLATE__', selected);

            document.getElementById('previewIframe').src = url;
            const modal = new bootstrap.Modal(document.getElementById('previewModal'));
            modal.show();
        }
    </script>

@endsection
