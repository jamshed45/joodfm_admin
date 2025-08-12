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
                {{ $title }}
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
                                @can('create ' . $permission)
                                    <a href="{{ route($routePath . '.create') }}" class="btn btn-primary float-end">Add New</a>
                                @endcan
                            </div>
                        </div>

                        <table id="datatable-tb-grid" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Organization</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($records as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($record->organization)
                                                {{ $record->organization->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                // echo $record->user?->id;
                                                // echo "<pre>";
                                                // print_r($record->user);
                                                // echo "</pre>";
                                            @endphp
                                            {{ $record->user?->name }}
                                        </td>
                                        <td>
                                            @if ($record->user)
                                                {{ $record->user?->email }}
                                            @endif
                                        </td>
                                        <td>{{ $record->phone }}</td>
                                        <th>
                                           @foreach ($record->user?->getRoleNames() ?? [] as $role)
                                                <span class="badge bg-primary">{{ $role }}</span>
                                            @endforeach
                                        </th>
                                        <td>
                                            @can('view ' . $permission)
                                                <a href="javascript:void(0);" class="text-info mx-2" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $record->id }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @endcan

                                            @can('edit ' . $permission)
                                                <a href="{{ route($routePath . '.edit', $record) }}" class="text-success mx-2">
                                                    <i class="fas fa-marker" aria-hidden="true"></i>
                                                </a>
                                            @endcan

                                            @can('delete ' . $permission)
                                                <a href="#"
                                                    onclick="confirmDelete('{{ route($routePath . '.destroy', $record) }}')"
                                                    class="text-danger mx-2">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            @endcan

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModal{{ $record->id }}" tabindex="-1"
                                                aria-labelledby="viewModalLabel{{ $record->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content shadow-lg rounded-3">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="viewModalLabel{{ $record->id }}">
                                                                {{ $record->user?->name }} - Details
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">

                                                            <div class="row mb-4 border-bottom pb-3">
                                                                <!-- Logo -->
                                                                <div class="col-md-3 text-center border-end">
                                                                    <a href="{{ asset('storage/' . $record->state_id_image_1) }}" target="_blank"><img src="{{ $record->state_id_image_1 ? asset('storage/' . $record->state_id_image_1) : asset('assets/placeholder.jpg') }}"
                                                                        alt="State ID Front Image"
                                                                        class="img-thumbnail rounded shadow-sm"
                                                                        style=" cursor: zoom-in; max-width: 120px; max-height: 120px;"></a><br><br>
                                                                    <a href="{{ asset('storage/' . $record->state_id_image_2) }}" target="_blank"><img src="{{ $record->state_id_image_2 ? asset('storage/' . $record->state_id_image_2) : asset('assets/placeholder.jpg') }}"
                                                                        alt="State ID Back Image"
                                                                        class="img-thumbnail rounded shadow-sm"
                                                                        style=" cursor: zoom-in; max-width: 120px; max-height: 120px;"></a>    
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <!-- Details -->
                                                                    <strong>Name:</strong> {{ $record->user?->name }}<br><br>
                                                                    <strong>Email:</strong>
                                                                    {{ $record->user?->email ?? 'N/A' }}<br><br>
                                                                    <strong>Phone:</strong>
                                                                    {{ $record->phone ?? 'N/A' }}<br><br>
                                                                    <strong>Date of Birth:</strong>
                                                                    {{ $record->dob ?? 'N/A' }}<br><br>
                                                                    <strong>Address:</strong>
                                                                    {{ $record->address ?? 'N/A' }}<br><br>
                                                                    <strong>State ID:</strong>
                                                                    {{ $record->state_id ?? 'N/A' }}<br><br>



                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No records found.</td>
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
            $(document).ready(function() {

                //Buttons examples
                var table = $('#datatable-tb-grid').DataTable({

                    lengthChange: false,
                    // buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                $(".dataTables_length select").addClass('form-select form-select-sm');
            });
        </script>

        <script src="{{ URL::asset('assets/js/client_filter.js') }}"></script>

        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
