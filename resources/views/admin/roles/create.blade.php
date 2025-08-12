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

                        <form method="POST" action="{{ route($routePath . '.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Assign Permissions</label>

                                {{-- <div class="row">
                                    @foreach ($modulesList as $module)
                                        @php
                                            $moduleName = $module->name;
                                            $modulePermissions = $permissions->filter(function ($perm) use (
                                                $moduleName,
                                            ) {
                                                return Str::contains($perm->name, $moduleName);
                                            });
                                        @endphp

                                        @if ($modulePermissions->isNotEmpty())
                                            <div class="col-12 mt-3">
                                                <h5 class="text-uppercase">{{ ucfirst($moduleName) }}</h5>
                                                <hr>
                                            </div>

                                            @foreach ($modulePermissions as $permission)
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->name }}"
                                                            id="perm_{{ $permission->id }}">
                                                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div> --}}


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
                                                $permissionsByAction = [
                                                    'access' => null,
                                                    'create' => null,
                                                    'edit' => null,
                                                    'delete' => null,
                                                ];

                                                foreach ($permissions as $perm) {
                                                    foreach ($permissionsByAction as $action => $_) {
                                                        if ($perm->name === "$action $moduleName") {
                                                            $permissionsByAction[$action] = $perm;
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ ucfirst($moduleName) }}</td>

                                                @foreach (['access', 'create', 'edit', 'delete'] as $action)
                                                    <td class="text-center">
                                                        @if ($permissionsByAction[$action])
                                                            <input type="checkbox" name="permissions[]"
                                                                id="perm_{{ $permissionsByAction[$action]->id }}"
                                                                value="{{ $permissionsByAction[$action]->name }}">
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


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
