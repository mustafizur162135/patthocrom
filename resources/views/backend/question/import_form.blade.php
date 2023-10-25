@extends('layouts.backend.app')

@section('title', 'Import Question')

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
                <div>Import Question</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">

                    <a href="{{ route('download.sample.excel') }}" class="btn btn-primary btn-shadow">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="pe-7s-angle-down-circle"></i>
                        </span>
                        Download Sample Excel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form action="{{ route('question.import.route') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <button type="submit">Upload Excel File</button>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
   
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
