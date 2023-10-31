@extends('layouts.backend.app')

@section('title', 'Question Create')

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
                <div>{{ isset($question) ? 'Edit' : 'Create New' }} Role</div>
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

                            <label for="class_name">Select Class</label>
                            <select multiple="multiple" class="form-control js-example-basic-multiple" id="class_name"
                                name="class_name[]" required>
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
                            <select multiple="multiple" class="form-control js-example-basic-multiple" id="subject"
                                name="subject[]" required>
                                @foreach ($subject as $item)
                                    <option value="{{ $item->sub_code }}"
                                        @if (isset($question)) @foreach ($question->subject as $value)
                                            {{ $question->sub_code == $value->sub_code ? 'selected' : '' }}
                                        @endforeach @endif>
                                        {{ $item->sub_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        {{-- <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $role->name ?? '' }}" placeholder="Enter role name" required autofocus>
                        </div> --}}



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
@endpush
