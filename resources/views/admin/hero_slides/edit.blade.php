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

                            <!-- English Title -->
                            <div class="mb-3">
                                <label for="en_title">English Title</label>
                                <input type="text" name="en_title" id="en_title"
                                    class="form-control @error('en_title') is-invalid @enderror"
                                    value="{{ old('en_title', $record->en_title ?? '') }}" placeholder="English Title">
                                @error('en_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- English Sub Title -->
                            <div class="mb-3">
                                <label for="en_sub_title">English Sub Title</label>
                                <input type="text" name="en_sub_title" id="en_sub_title"
                                    class="form-control @error('en_sub_title') is-invalid @enderror"
                                    value="{{ old('en_sub_title', $record->en_sub_title ?? '') }}"
                                    placeholder="English Sub Title">
                                @error('en_sub_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Arabic Title -->
                            <div class="mb-3">
                                <label for="ar_title">Arabic Title</label>
                                <input type="text" name="ar_title" id="ar_title"
                                    class="form-control @error('ar_title') is-invalid @enderror"
                                    value="{{ old('ar_title', $record->ar_title ?? '') }}" placeholder="Arabic Title"
                                    dir="rtl">
                                @error('ar_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Arabic Sub Title -->
                            <div class="mb-3">
                                <label for="ar_sub_title">Arabic Sub Title</label>
                                <input type="text" name="ar_sub_title" id="ar_sub_title"
                                    class="form-control @error('ar_sub_title') is-invalid @enderror"
                                    value="{{ old('ar_sub_title', $record->ar_sub_title ?? '') }}"
                                    placeholder="Arabic Sub Title" dir="rtl">
                                @error('ar_sub_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if (!empty($record->image))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $record->image) }}" alt="Current Image"
                                            class="img-thumbnail" width="200">
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
