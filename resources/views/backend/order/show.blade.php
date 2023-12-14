@extends('layouts.backend.app')

@section('title', 'Invoice')

@push('css')
    <!-- Include any additional CSS styles for the invoice if needed -->
    <style>
        /* Include any additional CSS styles for the invoice if needed */
        .invoice {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 20px;
        }

        /* Style for invoice details */
        h2 {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        p {
            margin-bottom: 10px;
        }

        /* Style for buttons */
        .btn-accept {
            background-color: #5cb85c;
            /* Green color for accept button */
            color: #fff;
            /* White text */
            margin-right: 10px;
        }

        .btn-reject {
            background-color: #d9534f;
            /* Red color for reject button */
            color: #fff;
            /* White text */
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-cash icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Invoice</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="invoice">
                    <h2>Invoice Details</h2>

                    <!-- Display order details from the studentorders table -->
                    <p>Order ID: {{ $order->id }}</p>
                    <p>Date: {{ $order->studentorder_date }}</p>
                    <p>Order Code: {{ $order->studentorder_code }}</p>
                    <!-- Replace the existing <p> tag with the Bootstrap badge -->
                    <p>Status:
                        <span class="badge {{ $order->studentorder_status == 1 ? 'badge-success' : 'badge-danger' }}">
                            {{ $order->studentorder_status == 1 ? 'Paid' : 'Unpaid' }}
                        </span>
                    </p>


                    <h2>Student Details</h2>
                    <p>Name: {{ $order->studentorder_name }}</p>
                    <p>Phone: {{ $order->studentorder_phone }}</p>
                    <p>Email: {{ $order->studentorder_email }}</p>
                    <p>Address: {{ $order->studentorder_address }}</p>
                    <p>ZIP Code: {{ $order->studentorder_zipcode ?? 'N/A' }}</p>
                    <p>City: {{ $order->studentorder_city ?? 'N/A' }}</p>

                    <h2>Package Details</h2>
                    <p>Package Name: {{ $order->studentpackage_name }}</p>
                    <p>Package Price: {{ $order->studentpackage_price }}</p>

                    <h2>Payment Details</h2>
                    <p>Card Type: {{ $order->studentorder_card_type }}</p>
                    <p>Nagad Transaction ID: {{ $order->nagadTranId ?? 'N/A' }}</p>
                    <p>bKash Transaction ID: {{ $order->bkashTranId ?? 'N/A' }}</p>

                    <!-- Additional order details as needed -->

                    <!-- Buttons for Accept and Reject -->
                    <div class="mt-3">
                        <button class="btn btn-success" onclick="updateStatus(1)">Accept</button>
                        <button class="btn btn-danger" onclick="updateStatus(0)">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function updateStatus(newStatus) {
            // Make an AJAX request to update the status
            $.ajax({
                type: 'PUT',
                url: '{{ route('orders.updateStatus', $order->id) }}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: newStatus
                },
                success: function(response) {
                    // Update the UI or perform any additional actions if needed
                    Swal.fire('Success', 'Status updated successfully', 'success');
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                    Swal.fire('Error', 'Error updating status', 'error');
                }
            });
        }
    </script>
@endpush
