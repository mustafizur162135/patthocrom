<!-- resources/views/confirmation.blade.php -->

@extends('frontend.front_app')

@section('title', 'Order Confirmation')

@section('css')
    <!-- Add any CSS styles or links for your confirmation page here -->
@endsection

@section('frontend-content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Order Confirmation</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Confirmation</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <section class="confirmation-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="confirmation-message">
                        <h2>Thank you for your order!</h2>
                        <h4>Order no <b>{{ $studentorder_code }}</b></h4>
                        <p>Your purchase of <b>{{ $studentpackage_name }}</b> has been confirmed.</p>
                        <!-- You can display more order details here if needed -->
                    </div>
                </div>

                <!-- Add a "Home" button to return to the home page -->
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
        </div>
            </div>
        </section>

        
    </div>
@endsection
