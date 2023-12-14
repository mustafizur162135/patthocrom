@extends('layouts.backend.app')

@section('title', 'Order')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All Order</div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Order Date</th>
                                <th class="text-center">Package Name</th>
                                <th class="text-center">Package Price</th>
                                <th class="text-center">Payment Type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $order->studentorder_name }}</td>
                                    <td class="text-center">{{ $order->studentorder_phone }}</td>
                                    <td class="text-center">{{ $order->studentorder_email }}</td>
                                    <td class="text-center">{{ $order->studentorder_date }}</td>
                                    <td class="text-center">{{ $order->studentpackage_name }}</td>
                                    <td class="text-center">{{ $order->studentpackage_price }}</td>
                                    <td class="text-center">{{ $order->studentorder_card_type }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $order->studentorder_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $order->studentorder_status == 1 ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="btn btn-primary m-2">View</a>

                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush
