@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.master')
@section('title')
    Edit {{ $title }}
@endsection
@section('css')
@endsection
@section('body')

    <body data-sidebar="dark">
    @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('page_title')
                Edit {{ $title }}
            @endslot
            @slot('subtitle')
                <a href="{{ route($routePath . '.index') }}">{{ Str::ucfirst(Str::plural($title)) }}</a>
            @endslot
        @endcomponent

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit {{ Str::ucfirst($title) }}</h4>
                        <p class="card-title-desc"></p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route($routePath . '.update', $record->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

{{-- English Fields --}}
<div class="mb-3">
    <label>English Name</label>
    <input type="text" name="en_name" value="{{ old('en_name', $record->en_name ?? '') }}"
        class="form-control @error('en_name') is-invalid @enderror">
    @error('en_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>English Location</label>
    <input type="text" name="en_location" value="{{ old('en_location', $record->en_location ?? '') }}"
        class="form-control @error('en_location') is-invalid @enderror">
    @error('en_location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>English Scope</label>
    <textarea name="en_scope" class="form-control @error('en_scope') is-invalid @enderror">{{ old('en_scope', $record->en_scope ?? '') }}</textarea>
    @error('en_scope')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>English Objective</label>
    <textarea name="en_objective" class="form-control @error('en_objective') is-invalid @enderror">{{ old('en_objective', $record->en_objective ?? '') }}</textarea>
    @error('en_objective')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>

{{-- Arabic Fields --}}
<div class="mb-3">
    <label>Arabic Name</label>
    <input type="text" name="ar_name" value="{{ old('ar_name', $record->ar_name ?? '') }}"
        class="form-control @error('ar_name') is-invalid @enderror" dir="rtl">
    @error('ar_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Arabic Location</label>
    <input type="text" name="ar_location" value="{{ old('ar_location', $record->ar_location ?? '') }}"
        class="form-control @error('ar_location') is-invalid @enderror" dir="rtl">
    @error('ar_location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Arabic Scope</label>
    <textarea name="ar_scope" class="form-control @error('ar_scope') is-invalid @enderror" dir="rtl">{{ old('ar_scope', $record->ar_scope ?? '') }}</textarea>
    @error('ar_scope')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Arabic Objective</label>
    <textarea name="ar_objective" class="form-control @error('ar_objective') is-invalid @enderror" dir="rtl">{{ old('ar_objective', $record->ar_objective ?? '') }}</textarea>
    @error('ar_objective')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>

{{-- Image --}}
<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image"
        class="form-control @error('image') is-invalid @enderror"
        accept="image/jpeg,image/png,image/jpg,image/gif">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Show preview if editing --}}
    @if (isset($record) && $record->image)
        <div class="mt-2">
            <img src="{{ asset($folderPath . '/' . $record->image) }}" alt="Preview" width="120"
                class="img-thumbnail">
        </div>
    @endif
</div>



                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    @endsection

    @section('scripts')
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
