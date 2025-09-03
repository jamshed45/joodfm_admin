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

                        <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ old('title', $record->title ?? '') }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ old('description', $record->description ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Location</label>
                                <input type="text" name="location" value="{{ old('location', $record->location ?? '') }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Department</label>
                                <input type="text" name="department"
                                    value="{{ old('department', $record->department ?? '') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    @foreach (['full-time', 'part-time', 'contract', 'internship'] as $type)
                                        <option value="{{ $type }}"
                                            {{ old('type', $record->type ?? '') == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Vacancies</label>
                                <input type="number" name="vacancies" value="{{ old('vacancies', $record->vacancies ?? 1) }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Application Deadline</label>
                                <input type="date" name="application_deadline"
                                    value="{{ old('application_deadline', $record->application_deadline ?? '') }}"
                                    class="form-control">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="active" value="1" class="form-check-input"
                                    {{ old('active', $record->active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
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
