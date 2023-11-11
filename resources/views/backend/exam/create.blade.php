@extends('layouts.backend.app')

@section('title', 'exam')

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
                <div>Create New exam</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form id="classForm" role="form" method="POST"
      action="{{ route('exams.store') }}" enctype="multipart/form-data">

        @csrf
    
                    
                    <div class="card-body">
                        <h5 class="card-title">Manage exams</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exam_name">Exam Name</label>
                                    <input type="text" class="form-control" id="exam_name" name="exam_name"
                                         placeholder="Enter exam Name" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="exam_name">Exam Code</label>
                                    <input type="text" class="form-control" id="exam_code" name="exam_code"
                                         placeholder="Enter exam Code" required autofocus>
                                </div>
                                
                               

                                <div class="form-group">
                                    <label for="exam_desc">Exam Description</label>
                                    <textarea class="form-control" cols="40" rows="5" id="exam_desc" name="exam_desc"
                                       ></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="class_code">Select Class</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="class_code" name="class_code[]" required>
                                        @foreach ($class_name as $item)
                                            <option value="{{ $item->class_code }}"
                                                @if (isset($question)) @foreach ($question->class_name as $value)
                                                    {{ $question->class_code == $value->class_code ? 'selected' : '' }}
                                                @endforeach @endif>
                                                {{ $item->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">

                                    <label for="sub_code">Select Subject</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="sub_code" name="sub_code[]" required>
                                        @foreach ($subject as $item)
                                            <option value="{{ $item->sub_code }}"
                                                @if (isset($question)) @foreach ($question->subject as $value)
                                        {{ $question->sub_code == $value->sub_code ? 'selected' : '' }}
                                    @endforeach @endif>
                                                {{ $item->sub_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="total_qc">Total Question</label>
                                    <input type="number" class="form-control" id="total_qc" name="total_qc"
                                         placeholder="Enter Total Question Number" required autofocus>
                                </div>
                            </div>
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
