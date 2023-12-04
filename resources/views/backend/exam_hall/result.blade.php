@extends('layouts.backend.app')

@section('title', 'Exams Result')

@push('css')
<!-- Add any additional CSS styles if needed -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<style>
    /* Center the icon */
    .text-center {
        text-align: center;
    }

    /* Style the card */
    .main-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style the card header */
    .card-header {
        background-color: #3498db;
        /* Change the background color as needed */
        color: #fff;
        border-bottom: 1px solid #ddd;
    }

    /* Style the card body */
    .card-body {
        padding: 20px;
    }

    /* Style the title text */
    .page-title-heading div {
        font-size: 24px;
        font-weight: bold;
    }

    /* Style the button */
    .btn-primary {
        background-color: #3498db;
        /* Change the background color as needed */
        border: 1px solid #3498db;
    }

    .btn-primary:hover {
        background-color: #2c3e50;
        /* Change the hover color as needed */
        border: 1px solid #2c3e50;
    }

    .icon-text {
        margin-right: 10px;
        /* Adjust spacing as needed */
    }

</style>

@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
            </div>
            <div>Result Exams</div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <p>{{ $exam->exam_name }} Result Sheet</p>
                </div>
                <div class="card-body">
                    <!-- Display results with icons -->
                    <p class="card-text"><i class="fas fa-question icon-text"></i>Total Questions: {{ $questions }}</p>
                    <p class="card-text"><i class="fas fa-check-circle icon-text text-success"></i>Correct Answers: {{ $correctCount }}</p>
                    <p class="card-text"><i class="fas fa-times-circle icon-text text-danger"></i>Incorrect Answers: {{ $errorCount }}</p>
                    <p class="card-text"><i class="fas fa-percent icon-text"></i>Correct Percentage: {{ number_format($correctPercentage, 2) }}%</p>

                    <!-- FontAwesome Icons -->
                    <div class="text-center">
                        <i class="fas fa-award fa-5x text-success"></i> <!-- Change the icon and color as needed -->
                    </div>

                    <a href="{{ url('/student/dashboard') }}" class="btn btn-primary mt-3">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush
