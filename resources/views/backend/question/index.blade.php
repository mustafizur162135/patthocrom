@extends('layouts.backend.app')

@section('title', 'Question')

@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All Question</div>

            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('questions.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Question
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="dataTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question Code</th>
                                <th>Class Code</th>
                                <th>Subject Code</th>
                                <th>Difficulty Code</th>
                                <th>Type Code</th>
                                <th>Name</th>
                                <th>Marks</th>
                                <th>Visibility</th>
                                <th>Is Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                
                            </tr>

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
    $(function() {
        $('#dataTable').DataTable({
         
            processing: true,
            serverSide: true,
            ajax: "{{ route('questions.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'question_code', name: 'question_code' },
                { data: 'class_code', name: 'class_code' },
                { data: 'sub_code', name: 'sub_code' },
                { data: 'question_diff_code', name: 'question_diff_code' },
                { data: 'question_type_code', name: 'question_type_code' },
                { data: 'question_name', name: 'question_name' },
                { data: 'question_default_marks', name: 'question_default_marks' },
                { data: 'visibility', name: 'visibility' },
                { data: 'is_paid', name: 'is_paid' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Datatable
        $("#datatable").DataTable();
    });
</script>

@endpush