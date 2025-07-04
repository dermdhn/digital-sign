@extends('Base::layouts.base')

@section('title')
{{ $title }}
@endsection

@section('pre-css')
<link href="{{ asset('myunnes/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('myunnes/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
        <li class="breadcrumb-item"><a href="{{ route($base_route.'.read', $route_params) }}">{{ $title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Form {{ $title }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <span class="pull-right">
                        <a href="{{ route($base_route.'.read', $route_params) }}" class="btn btn-soft-secondary me-1 mb-1"><i class="bi bi-arrow-left-circle-fill"></i> {{ __('Base::misc.back_txt') }}</a>
                    </span>
                </div>

                <h3 class="mb-3 text-center">Form {{ $title }} {!! $add_title !!}</h3>
                {{ Form::model($data, ['route' => $form_route, 'class' => 'form-horizontal mt-3', 'enctype' => 'multipart/form-data'] ) }}
                    {{ Form::hidden($model->getKeyName(), null) }}
                    @foreach ($form as $c => $f)
                        @if ($c === 'durasi')
                            <div id="durasi-wrapper" class="row mb-3">
                                <label for="durasi" class="col-5 col-xl-4 col-form-label text-end">
                                    {!! $f[0] !!}
                                </label>
                                <div class="col-5 col-xl-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control"
                                            placeholder="ex: 10"
                                            id="durasi"
                                            name="durasi"
                                            value="{{ old('durasi', $data['durasi'] ?? '') }}">
                                        @if ($errors->has('durasi'))
                                            <div class="invalid-feedback">{{ implode(' | ', $errors->get('durasi')) }}</div>
                                            <script>(function() {
                                                document.getElementById('durasi')?.classList.add('is-invalid')
                                            })();</script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif ($c === 'media')
                            <div class="row mb-3">
                                <label for="media" class="col-5 col-xl-4 col-form-label text-end">
                                    {!! $f[0] !!}
                                    @if (isset($model::validation_data()[$c]) && str_contains($model::validation_data()[$c], 'required'))
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <div class="col-5 col-xl-6">
                                    <div class="form-group">
                                        <input type="file" name="media" id="media" class="form-control" accept="image/*,video/*">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mb-3">
                                <label for="{{ $c }}" class="col-5 col-xl-4 col-form-label text-end">
                                    {!! $f[0] !!}
                                    @if (isset($model::validation_data()[$c]) && str_contains($model::validation_data()[$c], 'required') && @$f[1][0][1] != 'hidden' )
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <div class="col-5 col-xl-6">
                                    <div class="form-group">
                                        @if (is_array($f[1]))
                                            {!! forward_static_call_array($f[1][0], $f[1][1]) !!}
                                        @else
                                            {!! $f[1] !!}
                                        @endif
                                        @if ($errors->has($c))
                                            <div class="invalid-feedback">{{ implode(' | ', $errors->get($c)) }}</div>
                                            <script>(function() {
                                                document.getElementById('{{ $c }}')?.classList.add('is-invalid')
                                            })();</script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="row">
                        <div class="col-5 col-xl-4 col-form-label"></div>
                        <div class="col-5 col-xl-6">
                            {!! (new BApp)->btnSubmit(__('Base::misc.save_txt')) !!}
                            <a href="{{ route($base_route.'.read', $route_params) }}" class="btn btn-soft-secondary me-1 mb-1">{{ __('Base::misc.cancel_txt') }}</a>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@include('Base::layouts.components.nominal')
@endsection

@section('extra-js')
<script src="{{ asset('myunnes/libs/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('myunnes/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('myunnes/libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputMedia = document.getElementById("media");
    const inputDurasi = document.getElementById("durasi");
    const form = document.querySelector("form");

    if (!inputMedia || !inputDurasi || !form) {
        console.warn("❗ Elemen media, durasi, atau form tidak ditemukan.");
        return;
    }

    let videoDuration = null;
    let videoLoading = false;

    inputMedia.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        const fileType = file.type.split('/')[0];

        if (fileType === 'video') {
            inputDurasi.readOnly = true;
            inputDurasi.value = "";
            videoDuration = null;
            videoLoading = true;

            const video = document.createElement('video');
            video.preload = 'metadata';
            video.muted = true;
            video.src = URL.createObjectURL(file);

            video.onloadedmetadata = function () {
                URL.revokeObjectURL(video.src);
                videoDuration = Math.round(video.duration);
                inputDurasi.value = videoDuration;
                videoLoading = false;
                console.log("🎥 Durasi video:", videoDuration);
            };

            video.onerror = function () {
                console.error("❌ Gagal membaca metadata video.");
                videoDuration = null;
                inputDurasi.value = "";
                videoLoading = false;
            };
        } else {
            inputDurasi.readOnly = false;
            inputDurasi.value = "";
            videoDuration = null;
            videoLoading = false;
        }
    });

    form.addEventListener("submit", function (e) {
        // Jika file video dan durasi belum terbaca, cegah submit
        if (videoLoading) {
            alert("Tunggu sampai durasi video selesai dibaca sebelum submit!");
            e.preventDefault();
            return false;
        }
        // Pastikan input durasi sudah terisi jika video
        if (inputMedia.files[0] && inputMedia.files[0].type.split('/')[0] === 'video') {
            if (!inputDurasi.value) {
                alert("Durasi video belum terbaca. Silakan tunggu sebentar.");
                e.preventDefault();
                return false;
            }
        }
        // Tidak perlu manipulasi FormData jika submit biasa
    });
});
</script>
@endsection
