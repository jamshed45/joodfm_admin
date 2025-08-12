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

                        <h4 class="card-title">{{ $title }}</h4>
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
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $record->name) }}" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Permissions</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Module Name</th>
                                            <th>Access</th>
                                            <th>Add</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modulesList as $module)
                                            @php
                                                $moduleName = $module->name;
                                                $actions = ['access', 'create', 'edit', 'delete'];
                                                $permissionsByAction = [];

                                                foreach ($actions as $action) {
                                                    $permissionName = "$action $moduleName";
                                                    $permissionsByAction[$action] = $permissions->firstWhere(
                                                        'name',
                                                        $permissionName,
                                                    );
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ ucfirst($moduleName) }}</td>
                                                @foreach ($actions as $action)
                                                    <td class="text-center">
                                                        @if ($permissionsByAction[$action])
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permissionsByAction[$action]->name }}"
                                                                id="perm_{{ $permissionsByAction[$action]->id }}"
                                                                {{ in_array($permissionsByAction[$action]->name, $rolePermissions ?? []) ? 'checked' : '' }}>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
