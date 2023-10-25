@extends('layouts.backend.app')

@section('title','Sliders')

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
                <div>All Sliders</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('sliders.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Slider
                    </a>
                </div>
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
                            <th class="text-center">slider Name</th>
                            <th class="text-center">slider Image</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($sliders) > 0)
                            @foreach($sliders as $key => $slider)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $slider['slider_name'] }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('images/sliders/' . $slider->slider_image) }}" alt="slider image" class="mb-2" style="max-width: 100px;">
                                    </td>
                        
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm m-2" href="{{ route('sliders.edit', $slider['id']) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                        
                                        <form id="delete-form-{{ $slider['id'] }}"
                                              action="{{ route('sliders.destroy', $slider['id']) }}" method="POST">
                                            @csrf()
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $slider['id'] }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="4">No data found</td>
                            </tr>
                        @endif
                        
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
