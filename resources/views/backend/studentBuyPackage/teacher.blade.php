@extends('layouts.backend.app')

@section('title', 'Student Packages')

@push('css')
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            transition: background-color 0.3s ease-in-out;
        }

        .card:hover .card-body {
            background-color: #f8f9fa;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-footer button {
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .card-footer button:hover {
            background-color: #28a745;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All Student Packages</div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($teacherPackages as $teacherpackage)
            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teacherpackage->teacherpackage_name }}</h5>
                        <p class="card-text">Price: {{ $teacherpackage->teacherpackage_price }}</p>

                        @if ($teacherpackage->studentpackage_image)
                            <img class="img-whp"
                                src="{{ asset('storage/images/teacherpackages/' . $teacherpackage->teacherpackage_image) }}"
                                alt="{{ $teacherpackage->teacherpackage_name }}">
                        @else
                            <p>No Image</p>
                        @endif
                        {{-- Add any other details you want to display in the card --}}
                    </div>
                    <div class="card-footer">
                        <form method="post" action="{{ route('student.checkout') }}">
                            @csrf <!-- Add a CSRF token for security -->
                            <input type="hidden" name="studentPackage_id" value="{{ $teacherpackage->id }}">
                            <input type="hidden" name="studentpackage_price"
                                value="{{ $teacherpackage->teacherpackage_price }}">
                            <input type="hidden" name="studentpackage_name"
                                value="{{ $teacherpackage->teacherpackage_name }}">
                            <button type="submit" class="btn btn-success">Buy Now</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p>No student packages found</p>
            </div>
        @endforelse
    </div>
@endsection

@push('js')
    <!-- Add any additional JavaScript for card interactions here -->
@endpush
