@extends('layouts.backend.app')

@section('title', 'Question Create')

@push('css')
    <style type="text/css">
        .ck-editor__editable_inline {
            height: 200px;
        }
    </style>
@endpush

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
                <div>{{ isset($question) ? 'Edit' : 'Create New' }} Question</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('questions.index') }}" class="btn-shadow btn btn-danger">
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
                <form id="qcForm" role="form" method="POST"
                    action="{{ isset($question) ? route('questions.update', $question->id) : route('questions.store') }}">
                    @csrf
                    @if (isset($question))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage Question</h5>

                        <div class="form-group">

                            <label for="question_type_code">Question Type</label>
                            <select class="form-control" id="question_type_code" name="question_type_code" required>
                                @foreach ($qc_type as $item)
                                    <option value="{{ $item->question_type_code }}"
                                        @if (isset($question)) @foreach ($question->questionType as $value)
                {{ $question->question_type_code == $value->question_type_code ? 'selected' : '' }}
            @endforeach @endif>
                                        {{ $item->question_type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Question Name</label>
                                    <textarea id="editor" name="question_name"></textarea>

                                </div>

                                <div class="form-group">
                                    <label for="name">Option 1</label>
                                    <textarea id="editor" name="question_option_1"></textarea>

                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="class_name">Select Class</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="class_name" name="class_name[]" required>
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

                                    <label for="subject">Select Subject</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="subject" name="subject[]" required>
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

                                    <label for="question_diff_level_code">Question Diff Level</label>
                                    <select class="form-control" id="question_diff_level_code"
                                        name="question_diff_level_code" required>
                                        @foreach ($qc_diff_level as $item)
                                            <option value="{{ $item->question_diff_level_code }}"
                                                @if (isset($question)) @foreach ($question->questionDiffLevel as $value)
                        {{ $question->question_diff_level_code == $value->question_diff_level_code ? 'selected' : '' }}
                    @endforeach @endif>
                                                {{ $item->question_diff_level_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>








                        <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>


                        <button type="submit" class="btn btn-primary">
                            @isset($question)
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
        function resetForm(qcForm) {
            document.getElementById(qcForm).reset();
            $('.js-example-basic-multiple').val(null).trigger('change');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#subject').select2();
        });
    </script>


    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    options: {
                        resourceType: 'Images', // Restrict to images only
                        // Set additional minimal options here
                    },
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    onInsert: function(file) {
                        // Dynamically set image attributes here
                        var img = new CKEDITOR.dom.element('img');
                        img.setAttribute('src', file.url);
                        img.setAttribute('width', '800');
                        img.setAttribute('height', '600');
                        // Add any other attributes you need
                        editor.insertElement(img);
                    },
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
