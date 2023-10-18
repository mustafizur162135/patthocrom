@extends('layouts.backend.app')

@section('title', 'Classes')

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
                <div>{{ isset($class) ? 'Edit' : 'Create New' }} Class</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.class') }}" class="btn-shadow btn btn-danger">
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
                <form id="classForm" role="form" method="POST"
                    action="{{ isset($class) ? route('admin.class.update', $class->id) : route('admin.class.store') }}">
                    @csrf
                    @if (isset($class))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage Classes</h5>

                        <div class="form-group">
                            <label for="name">Class Name</label>
                            <input type="text" class="form-control" id="class_name" name="class_name"
                                value="{{ $class->class_name ?? '' }}" placeholder="Enter class name" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="name">Class Code</label>
                            <input type="text" class="form-control" id="class_code" name="class_code"
                                value="{{ $class->class_code ?? '' }}" placeholder="Enter class Code" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="class_note">Class Note</label>
                            <textarea class="form-control" cols="40" rows="5" id="class_note" name="class_note" placeholder="Enter Class Note" required>{{ $class->class_note ?? '' }}</textarea>
                        </div>
                        

                        

                        <button type="button" class="btn btn-danger" onClick="resetForm('classForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>


                        <button type="submit" class="btn btn-primary">
                            @isset($class)
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
        function resetForm(classForm) {
            document.getElementById(classForm).reset();
            $('.js-example-basic-multiple').val(null).trigger('change');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
