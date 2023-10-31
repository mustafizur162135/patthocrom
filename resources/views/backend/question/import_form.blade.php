@extends('layouts.backend.app')

@section('title', 'Import Question')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
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
            
                    <div class="form-group">
                        <label for="file">Select Excel File:</label>
                        <input type="file" class="form-control-file dropify" name="file" id="file" accept=".xlsx, .xls">
                    </div>
            
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            // Initialize Dropify with options
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop an Excel file here or click to choose',
                    'replace': 'Drag and drop or click to replace the file',
                    'remove': 'Remove',
                    'error': 'Invalid file type. Only .xlsx and .xls files are allowed.',
                },
                error: {
                    'fileExtension': 'The file is not allowed. Only .xlsx and .xls files are allowed.'
                }
            });
        });
    </script>
@endpush
