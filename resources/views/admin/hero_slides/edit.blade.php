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

                    <form action="{{ route($routePath . '.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   value="{{ old('title', $record->title) }}" placeholder="Title">
                        </div>

                        <!-- Sub Title -->
                        <div class="mb-3">
                            <label for="sub_title">Sub Title</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control"
                                   value="{{ old('sub_title', $record->sub_title) }}" placeholder="Sub Title">
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if ($record->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $record->image) }}" width="200" alt="Current Image">
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
