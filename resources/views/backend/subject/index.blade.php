@extends('layouts.backend.app')

@section('title','Subjects')

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
                <div>All Subjects</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.subject.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Subject
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
                            <th class="text-center">Subject Name</th>
                            <th class="text-center">Subject Code</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($subjects) > 0)
                            @foreach($subjects as $key => $subject)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $subject['sub_name'] }}</td>
                                    <td class="text-center">{{ $subject['sub_code'] }}</td>
                        
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm m-2" href="{{ route('admin.subject.edit', $subject['id']) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                        
                                        <form id="delete-form-{{ $subject['id'] }}"
                                              action="{{ route('admin.subject.delete', $subject['id']) }}" method="POST">
                                            @csrf()
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $subject['id'] }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="4">No data found</td>
                            </tr>
                        @endif
                        
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
