@extends('layouts.backend.app')

@section('title', 'studentpackage')

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
                <div>Create New studentpackage</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form id="classForm" role="form" method="POST"
      action="{{ route('studentpackages.store') }}" enctype="multipart/form-data">

        @csrf
    
                    
                    <div class="card-body">
                        <h5 class="card-title">Manage studentpackages</h5>

                        <div class="form-group">
                            <label for="permissions">Exam Name</label>
                            <select class="form-control js-example-basic-multiple" id="exam_id"
                                name="exam_id" required>
                                <option value="">Select Exam Name</option>
                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->id }}">
                                        {{ $exam->exam_name }}
                                    </option>
                                @endforeach
                            </select>

                            
                        </div>


                        <div class="form-group">
                            <label for="studentpackage_name">studentpackage Name</label>
                            <input type="text" class="form-control" id="studentpackage_name" name="studentpackage_name"
                                 placeholder="Enter studentpackage Name" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="studentpackage_price">studentpackage Price</label>
                            <input type="number" class="form-control" id="studentpackage_price" name="studentpackage_price"
                                 placeholder="Enter studentpackage Price" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="studentpackage_des">studentpackage Description</label>
                            <textarea class="form-control" cols="40" rows="5" id="studentpackage_des" name="studentpackage_des"
                                placeholder="Enter studentpackage Description"></textarea>
                        </div>
                       

                        @if ($errors->has('studentpackage_image'))
                            <span class="text-danger">{{ $errors->first('studentpackage_image') }}</span>
                        @endif

                        <div class="form-group">
                            <label for="studentpackage_image">studentpackage Image</label>
                            
                                <input type="file" class="form-control-file" id="studentpackage_image" name="studentpackage_image">
                            
                        </div>

                       
                        <button type="button" class="btn btn-danger" onclick="resetForm('settingForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i>
                            <span>Create</span>
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
