@extends('layouts.backend.app')

@section('title', 'teacherpackage')

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
            <div>Create New teacherpackage</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="main-card mb-3 card">
            <form id="classForm" role="form" method="POST" action="{{ route('teacherpackages.store') }}" enctype="multipart/form-data">

                @csrf


                <div class="card-body">
                    <h5 class="card-title">Manage teacherpackages</h5>



                    <div class="form-group">
                        <label for="teacherpackage_name">teacherpackage Name</label>
                        <input type="text" class="form-control" id="teacherpackage_name" name="teacherpackage_name" placeholder="Enter teacherpackage Name" required autofocus>
                    </div>


                    <div class="form-group">
                        <label for="no_of_question_print">No. Of Question Print</label>
                        <input type="text" class="form-control" id="no_of_question_print" name="no_of_question_print" placeholder="Enter Question Number" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="teacherpackage_price">teacherpackage Price</label>
                        <input type="number" class="form-control" id="teacherpackage_price" name="teacherpackage_price" placeholder="Enter teacherpackage Price" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="teacherpackage_des">teacherpackage Description</label>
                        <textarea class="form-control" cols="40" rows="5" id="teacherpackage_des" name="teacherpackage_des" placeholder="Enter teacherpackage Description"></textarea>
                    </div>


                    @if ($errors->has('teacherpackage_image'))
                    <span class="text-danger">{{ $errors->first('teacherpackage_image') }}</span>
                    @endif

                    <div class="form-group">
                        <label for="teacherpackage_image">teacherpackage Image</label>

                        <input type="file" class="form-control-file" id="teacherpackage_image" name="teacherpackage_image">

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


</script>
@endpush
