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
                            <select disabled class="form-control" id="question_type_code" name="question_type_code"
                                onchange="showQuestionFields()" required>
                                @foreach ($questionTypes as $type)
                                    <option value="{{ $type['question_type_code'] }}"
                                        {{ isset($question) && $question->question_type_code == $type['question_type_code'] ? 'selected' : '' }}>
                                        {{ $type['question_type_name'] }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Question Name</label>
                                    <textarea id="editor" name="question_name"> {{ $question->question_name }}</textarea>

                                </div>


                                @if ($question->question_type_code == 'MSA')
                                    @for ($optionCount = 1; $optionCount <= 6; $optionCount++)
                                        <div class="form-group" id="op">
                                            <label for="name">Option {{ $optionCount }}</label>
                                            <textarea id="editor{{ $optionCount }}" name="question_option_{{ $optionCount }}">{{ isset($question) ? $question->{'question_option_' . $optionCount} : '' }}</textarea>

                                            @php
                                                $ca = isset($question) ? explode(',', $question->question_correct_ans) : [];
                                                $checked = in_array($optionCount, $ca) ? 'checked' : '';
                                            @endphp

                                            <input type="radio" name="question_correct_ans[]" value="{{ $optionCount }}"
                                                {{ $checked }}> Correct Answer
                                        </div>
                                    @endfor

                                    <div id="msaContainer">
                                        <div class="form-group" id="msa-options-container">
                                            <button type="button" class="btn btn-success" id="msaaddOption"
                                                onclick="addOption('msa')">
                                                <i class="fas fa-plus"></i>
                                                <span>Add Option</span>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div id="mmaContainer">
                                        @for ($optionCount = 1; $optionCount <= 6; $optionCount++)
                                        <div class="form-group" id="op">
                                            <label for="name">Option {{ $optionCount }}</label>
                                            <textarea id="editor{{ $optionCount }}" name="question_option_{{ $optionCount }}">{{ isset($question) ? $question->{'question_option_' . $optionCount} : '' }}</textarea>
                                    
                                            @php
                                                $ca = isset($question) ? explode(',', $question->question_correct_ans) : [];
                                                $checked = in_array($optionCount, $ca) ? 'checked' : '';
                                            @endphp
                                    
                                            <input type="checkbox" name="question_correct_ans[]" value="{{ $optionCount }}" {{ $checked }}> Correct Answer
                                    
                                           
                                        </div>
                                    @endfor
                                    
                                    
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="class_name">Select Class</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="class_name" name="class_name[]" required>
                                        @foreach ($class_name as $item)
                                            @php
                                                $ca = isset($question) ? explode(',', $question->class_code) : [];
                                                $selected = in_array($item->class_code, $ca) ? 'selected' : '';
                                            @endphp

                                            <option value="{{ $item->class_code }}" {{ $selected }}>
                                                {{ $item->class_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">

                                    <label for="subject">Select Subject</label>
                                    <select multiple="multiple" class="form-control js-example-basic-multiple"
                                        id="subject" name="subject[]" required>

                                        @foreach ($subject as $item)
                                            @php
                                                $a = isset($question) ? explode(',', $question->sub_code) : [];
                                                $selectedSubject = in_array($item->sub_code, $a) ? 'selected' : '';
                                            @endphp


                                            <option value="{{ $item->sub_code }}" {{ $selectedSubject }}>
                                                {{ $item->sub_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>



                                <div class="form-group">
                                    <label for="question_diff_code">Question Diff Level</label>
                                    <select class="form-control" id="question_diff_code" name="question_diff_code" required>
                                        @foreach ($qc_diff_level as $item)
                                            <option value="{{ $item->question_diff_level_code }}"
                                                @if ($question && isset($question->questionDiffLevel)) {{ $question->question_diff_code == $item->question_diff_level_code ? 'selected' : '' }} @endif>
                                                {{ $item->question_diff_level_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>




                                {{--
                                <div class="form-group">
                                    <label for="name">Question Answer</label>
                                    <textarea id="question_solution" name="question_solution"></textarea>

                                </div> --}}

                                <div class="form-group">
                                    <label for="name">Question Mark</label>
                                    <input type="text" class="form-control" id="question_default_marks"
                                        name="question_default_marks" placeholder="Enter Question Default Marks"
                                        value="{{ $question->question_default_marks }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="name">Question Solve Time</label>
                                    <input type="text" class="form-control" id="question_default_time_to_solve"
                                        name="question_default_time_to_solve"
                                        value="{{ $question->question_default_time_to_solve }}"
                                        placeholder="Enter Question Solve Time" required autofocus>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_paid" name="is_paid"
                                            {{ isset($question) && $question->is_paid ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_paid">Paid</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status"
                                            {{ isset($question) && $question->status ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'), {
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor3'), {
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor4'), {
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor5'), {
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor6'), {
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
