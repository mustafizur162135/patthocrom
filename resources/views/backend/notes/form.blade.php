@extends('layouts.backend.app')

@section('title', 'Note')

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
            <div>{{ isset($note) ? 'Edit' : 'Create New' }} Note</div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <a href="{{ route('notes.index') }}" class="btn-shadow btn btn-danger">
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
            <form id="noteForm" role="form" method="POST" action="{{ isset($note) ? route('notes.update', $note->id) : route('notes.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($note))
                @method('PUT')
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $note->title ?? '' }}" placeholder="Enter Title" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" required>{{ $note->description ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="file">PDF File</label>
                        <input type="file" class="form-control-file" name="file" accept=".pdf">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-danger" onClick="resetForm('roleForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            @isset($note)
                            <i class="fas fa-arrow-circle-up"></i>
                            <span>Update</span>
                            @else
                            <i class="fas fa-plus-circle"></i>
                            <span>Create</span>
                            @endisset
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('js')
<script>
    function resetForm(roleFrom) {
        document.getElementById(roleFrom).reset();
        $('.js-example-basic-multiple').val(null).trigger('change');
    }

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>
@endpush
