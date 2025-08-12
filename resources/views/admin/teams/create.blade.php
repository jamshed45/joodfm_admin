@php
    use Faker\Factory;

    $faker = app()->environment('local') ? Factory::create() : null;
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
            {{ $title }}
        @endslot
        @slot('subtitle')
            <a href="{{ route($routePath . '.index') }}">{{ $plural }}</a>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ $plural }}</h4>
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

                    <form method="POST" action="{{ route($routePath . '.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $faker?->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control"
                                   value="{{ old('role', $faker?->jobTitle) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Profile Image</label>
                            <input type="file" name="image" class="form-control" {{ request()->isMethod('post') ? 'required' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $faker?->safeEmail) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $faker?->phoneNumber) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required>{{ old('description', $faker?->paragraph) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('scripts')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
