@extends('layouts.backend.app')

@section('title','exams')

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
            <div>Exams List</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    {{-- <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">exam Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>  --}}
                    <tbody>
                        @if(count($exams) > 0)
                        @foreach($exams as $key => $exam)
                        <tr>
                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                            <td class="text-center">{{ $exam['exam_name'] }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm m-2" href="{{ route('exams.show', $exam['id']) }}">
                                    <i class="fas fa-eye"></i> Participate This Exam
                                </a>
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
