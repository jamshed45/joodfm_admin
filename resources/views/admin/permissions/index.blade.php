@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('body')

    <body data-sidebar="dark">
    @endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('page_title')
                All {{ $plural }}
            @endslot
            @slot('subtitle')
                {{ $plural }}
            @endslot
        @endcomponent



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                {{-- @can('create ' . $permission)
<a href="{{ route($routePath . '.create') }}" class="btn btn-primary float-end">Add New</a>
@endcan --}}
                            </div>
                        </div>

<table id="datatable-tb-grid" class="table table-striped table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Module Name</th>
            <th>Scope</th>
        </tr>
    </thead>
    <tbody>
        @forelse($modulesList as $module)
            @php
                $moduleName = strtolower($module->name);
                $hasPermission = fn($action) => $records->contains('name', "$action $moduleName");
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucfirst($moduleName) }}</td>
                <td><span class="badge {{ $hasPermission('access') ? 'bg-primary' : 'bg-secondary' }} me-1">
                    Access
                </span>
                <span class="badge {{ $hasPermission('create') ? 'bg-primary' : 'bg-secondary' }} me-1">
                    Create
                </span>
                <span class="badge {{ $hasPermission('edit') ? 'bg-primary' : 'bg-secondary' }} me-1">
                    Edit
                </span>
                <span class="badge {{ $hasPermission('delete') ? 'bg-primary' : 'bg-secondary' }} me-1">
                    Delete
                </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No modules found.</td>
            </tr>
        @endforelse
    </tbody>
</table> 

                        <script>
                            function confirmDelete(action) {
                                $('#deleteForm').attr('action', action);
                                $('#deleteConfirmationModal').modal('show');
                            }
                        </script>


                        <div class="modal fade" id="deleteConfirmationModal" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{ $singular }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this {{ $singular }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form id="deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>

        <script>
            // $(document).ready(function() {

            //     //Buttons examples
            //     var table = $('#datatable-tb-grid').DataTable({
            //         // "pageLength": {{ get_records_per_page() }} ,
            //         lengthChange: false,
            //         // buttons: ['copy', 'excel', 'pdf', 'colvis']
            //     });

            //     table.buttons().container()
            //         .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            //         $(".dataTables_length select").addClass('form-select form-select-sm');
            // } );
        </script>

        <script src="{{ URL::asset('assets/js/client_filter.js') }}"></script>

        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
