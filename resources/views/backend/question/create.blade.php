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
                            <select class="form-control" id="question_type_code" name="question_type_code"
                                onchange="showQuestionFields()" required>
                                @foreach ($questionTypes as $type)
                                    <option value="{{ $type['question_type_code'] }}">{{ $type['question_type_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Question Name</label>
                                    <textarea id="editor" name="question_name"></textarea>

                                </div>

                                {{-- <div class="form-group">
                                    <label for="name">Option 1</label>
                                    <textarea id="editor1" name="question_option_1"></textarea>

                                </div> --}}
                                <div id="msaContainer" style="display: none;">
                                    <div class="form-group" id="msa-options-container">
                                        <button type="button" class="btn btn-success" id="msaaddOption"
                                            onclick="addOption('msa')">
                                            <i class="fas fa-plus"></i>
                                            <span>Add Option</span>
                                        </button>
                                    </div>
                                </div>

                                <div id="mmaContainer" style="display: none;">
                                    <div class="form-group" id="mma-options-container">
                                        <button type="button" class="btn btn-success" id="mmaaddOption"
                                            onclick="addOption('mma')">
                                            <i class="fas fa-plus"></i>
                                            <span>Add Option</span>
                                        </button>
                                    </div>
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


    <script>
        function showQuestionFields() {
            var selectedType = document.getElementById("question_type_code").value;
            var msaContainer = document.getElementById("msaContainer");
            var mmaContainer = document.getElementById("mmaContainer");
            var option = document.getElementById("op") ?? '';

            option.remove();

        

            if (selectedType === "MSA") {
                msaContainer.style.display = "block"; // Show the MSA container
                mmaContainer.style.display = "none"; // Hide the MMA container
                optionCount = 0;

            } else if (selectedType === "MMA") {
                mmaContainer.style.display = "block"; // Show the MMA container
                msaContainer.style.display = "none"; // Hide the MSA container
                optionCount = 0;

            } else {
                msaContainer.style.display = "none"; // Hide both containers for other question types
                mmaContainer.style.display = "none";
                optionCount = 0;
            }
        }
    </script>

    <script>
        var optionCount = 0; // Initialize the option count

        // Function to initialize CKEditor for a new option
        function initializeCKEditor(optionCount) {
            ClassicEditor
                .create(document.querySelector('#editor' + optionCount), {
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
        }
       // Add Option button click event
    function addOption(optionType) {
        if (optionCount < 6) { // Limit the total number of options to 6
            optionCount++;

            var inputType = optionType === "msa" ? "radio" : "checkbox"; // Determine input type based on question type

            var newOptionHTML = '<div class="form-group" id="op">' +
            '<label for="name">Option ' + optionCount + '</label>' +
            '<textarea id="editor' + optionCount + '" name="question_option_' + optionCount +
            '"></textarea>' +
            '<input type="' + inputType + '" name="correct_answer" value="' + optionCount + '"> Correct Answer' +
            '</div>';

            // Create a new div for the option
            var newOptionDiv = document.createElement('div');
            newOptionDiv.innerHTML = newOptionHTML;

            // Insert the new option above the "Add Option" button
            var optionsContainer = document.getElementById(optionType + '-options-container');
            optionsContainer.insertBefore(newOptionDiv, document.getElementById(optionType + 'addOption'));

            // Initialize CKEditor for the new option
            initializeCKEditor(optionCount);

            // If it's an "MSA" question, add a change event to clear other selected options
            if (questionType === "msa" && inputType === "radio") {
                var radioButtons = newOptionDiv.querySelectorAll('input[type="radio"]');
                radioButtons.forEach(function(radioButton) {
                    radioButton.addEventListener('change', function() {
                        if (radioButton.checked) {
                            radioButtons.forEach(function(otherRadioButton) {
                                if (otherRadioButton !== radioButton) {
                                    otherRadioButton.checked = false;
                                }
                            });
                        }
                    });
                });
            }
        } else {
            alert('You have reached the maximum limit of 6 options.');
        }
    }

    </script>
@endpush
