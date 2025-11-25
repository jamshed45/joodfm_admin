@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.master')
@section('title')
    {{ $title }}
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

                    <form method="POST" action="{{ route($routePath . '.update', $record->id) }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $record->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <small>
    ( Allowed formats: JPG, JPEG, PNG, GIF — Max size: 0.5 MB (512 KB) )
</small>
                            @if ($record->image)
                                <div class="mb-2">
                                    <img src="{{ asset($folderPath . '/' . $record->image) }}" alt="Profile Image" width="200">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control">
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
