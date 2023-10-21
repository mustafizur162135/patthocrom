@extends('layouts.backend.app')

@section('title', 'Setting')

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
                <div>{{ isset($setting) ? 'Edit' : 'Create New' }} setting</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form id="classForm" role="form" method="POST"
      action="{{ route('admin.setting.storeOrUpdate', isset($setting) ? ['id' => $setting->id] : []) }}">
    @csrf
    @if (isset($setting))
        @method('PUT')
    @endif
                    <input type="hidden" name="operation" value="{{ isset($setting) ? 'update' : 'create' }}">
                    <div class="card-body">
                        <h5 class="card-title">Manage setting</h5>
                        <div class="form-group">
                            <label for="mail">Mail Address</label>
                            <input type="text" class="form-control" id="mail" name="mail"
                                value="{{ old('mail', $setting->mail ?? '') }}" placeholder="Enter mail Address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no"
                                value="{{ old('contact_no', $setting->contact_no ?? '') }}" placeholder="Enter Contact No" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="fb_link">FaceBook Link</label>
                            <input type="text" class="form-control" id="fb_link" name="fb_link"
                                value="{{ old('fb_link', $setting->fb_link ?? '') }}" placeholder="Enter Facebook Link" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="youtube_link">YouTube Link</label>
                            <input type="text" class="form-control" id="youtube_link" name="youtube_link"
                                value="{{ old('youtube_link', $setting->youtube_link ?? '') }}" placeholder="Enter YouTube Link" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" cols="40" rows="5" id="address" name="address"
                                placeholder="Enter address" required>{{ old('address', $setting->address ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_us">About Us</label>
                            <textarea class="form-control" cols="40" rows="5" id="about_us" name="about_us"
                                placeholder="Enter About Us" required>{{ old('about_us', $setting->about_us ?? '') }}</textarea>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="resetForm('settingForm')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-{{ isset($setting) ? 'arrow-circle-up' : 'plus-circle' }}"></i>
                            <span>{{ isset($setting) ? 'Update' : 'Create' }}</span>
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
