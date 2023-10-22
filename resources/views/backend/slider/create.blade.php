@extends('layouts.backend.app')

@section('title', 'Slider')

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
                <div>Create New Slider</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form id="classForm" role="form" method="POST"
      action="{{ route('sliders.store') }}" enctype="multipart/form-data">

        @csrf
    
                    
                    <div class="card-body">
                        <h5 class="card-title">Manage Sliders</h5>
                        <div class="form-group">
                            <label for="slider_name">Slider Name</label>
                            <input type="text" class="form-control" id="slider_name" name="slider_name"
                                 placeholder="Enter Slider Name" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="slider_des">Slider Description</label>
                            <textarea class="form-control" cols="40" rows="5" id="slider_des" name="slider_des"
                                placeholder="Enter slider Description"></textarea>
                        </div>
                       

                        @if ($errors->has('slider_image'))
                            <span class="text-danger">{{ $errors->first('slider_image') }}</span>
                        @endif

                        <div class="form-group">
                            <label for="slider_image">Slider Image</label>
                            
                                <input type="file" class="form-control-file" id="slider_image" name="slider_image">
                            
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
