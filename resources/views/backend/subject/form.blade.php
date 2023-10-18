@extends('layouts.backend.app')

@section('title', 'subjects')

@section('content')
    <div class="app-page-title">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="page-title-wrapper">

            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($subject) ? 'Edit' : 'Create New' }} Class</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.subject') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        Back to list
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <!-- form start -->
                <form id="subjectForm" role="form" method="POST"
                    action="{{ isset($subject) ? route('admin.subject.update', $subject->id) : route('admin.subject.store') }}">
                    @csrf
                    @if (isset($subject))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage subjects</h5>

                        <div class="form-group">
                            <label for="permissions">Class Name</label>
                            <select class="form-control js-example-basic-multiple" id="class_id"
                                name="class_id" required>
                                <option value="">Select Class Name</option>
                                @foreach ($classes as $class)
        <option value="{{ $class->id }}" {{ isset($subject) && $subject->class_id == $class->id ? 'selected' : '' }}>
            {{ $class->class_name }}
        </option>
    @endforeach
                            </select>

                            
                        </div>

                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            <input type="text" class="form-control" id="sub_name" name="sub_name"
                                value="{{ $subject->sub_name ?? '' }}" placeholder="Enter subject name" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="name">Subject Code</label>
                            <input type="text" class="form-control" id="sub_code" name="sub_code"
                                value="{{ $subject->sub_code ?? '' }}" placeholder="Enter subject Code" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="class_note">Subject Note</label>
                            <textarea class="form-control" cols="40" rows="5" id="sub_note" name="sub_note" placeholder="Enter subject Note" required>{{ $subject->sub_note ?? '' }}</textarea>
                        </div>
                        

                        

                        <button type="button" class="btn btn-danger" onClick="resetForm('subjectForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>


                        <button type="submit" class="btn btn-primary">
                            @isset($subject)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Update</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script>
        function resetForm(subjectForm) {
            document.getElementById(subjectForm).reset();
            $('.js-example-basic-multiple').val(null).trigger('change');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
