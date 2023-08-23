<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <form method="POST" id="settings_form" action="{{ route('admin.settings.post') }}">
        @csrf
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Lưu</button>
        </div>
        @foreach(\App\Models\Settings::all() as $setting)
            <div class="mb-3">
                <label for="{{ $setting->id }}" class="form-label h5">{{ $setting->name }}</label>
                <textarea class="form-control" id="{{ $setting->id }}" rows="3" name="{{ $setting->name }}">{{ $setting->value }}</textarea>
            </div>
        @endforeach
    </form>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {

        })
    </script>
@endsection
