@extends('layouts.backend.app')

@section('title','Roles')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All Roles</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.roles.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Role
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Permissions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key=>$role)
                            <tr>
                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td class="text-center">{{ $role['name'] }}</td>
                                <td class="text-center">
                                    @if (is_array($role['permissions']) && count($role['permissions']) > 0)
                                        @foreach($role['permissions'] as $permission)
                                            <span class="badge badge-info">{{ $permission }}</span>
                                        @endforeach
                                    @elseif ($role['permissions'] > 0)
                                        <span class="badge badge-info">{{ $role['permissions'] }}</span>
                                    @else
                                        <span class="badge badge-danger">No permission found :</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm m-2" href="{{ route('admin.roles.edit',$role['id']) }}"><i
                                            class="fas fa-edit"></i>
                                     
                                    </a>
                                 
                                        <form id="delete-form-{{ $role['id'] }}"
                                              action="{{ route('admin.roles.delete',$role['id']) }}" method="POST">
                                            @csrf()
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteData({{ $role['id'] }})">
                                                <i class="fas fa-trash-alt"></i>
                                               
                                            </button>
                                        </form>
                                   
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush
