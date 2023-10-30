@extends('layouts.backend.app')

@section('title', 'Edit exam')

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
                    <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Edit exam</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form id="classForm" role="form" method="POST"
                action="{{ route('exams.update', ['exam' => $exam]) }}" enctype="multipart/form-data">
          

        @csrf
        @method('PUT')
    
                    
                    <div class="card-body">
                        <h5 class="card-title">Manage exams</h5>
                        <div class="form-group">
                            <label for="exam_name">exam Name</label>
                            <input type="text" class="form-control" id="exam_name" name="exam_name" value="{{ $exam->exam_name }}" 
                                 placeholder="Enter exam Name" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="exam_code">exam Code</label>
                            <textarea class="form-control" cols="40" rows="5" id="exam_code" name="exam_code"
                                placeholder="Enter exam Code">{{ $exam->exam_code }}</textarea>
                        </div>
                       

                      
                       
                        <button type="button" class="btn btn-danger" onclick="resetForm('settingForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i>
                            <span>Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function resetForm(settingForm) {
            document.getElementById(settingForm).reset();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
