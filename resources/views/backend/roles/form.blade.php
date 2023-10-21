@extends('layouts.backend.app')

@section('title', 'Roles')

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
                <div>{{ isset($role) ? 'Edit' : 'Create New' }} Role</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.role') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        Back to list
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <!-- form start -->
                <form id="roleFrom" role="form" method="POST"
                    action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage Roles</h5>

                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $role->name ?? '' }}" placeholder="Enter role name" required autofocus>
                        </div>

                        <div class="text-center">
                            <strong>Manage permissions for role</strong>
                            @error('permissions')
                                <p class="p-2">
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <select multiple="multiple" class="form-control js-example-basic-multiple" id="permissions"
                                name="permissions[]" required>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        @if (isset($role)) @foreach ($role->permissions as $rPermission)
                                            {{ $permission->id == $rPermission->id ? 'selected' : '' }}
                                        @endforeach @endif>
                                        {{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>


                        <button type="submit" class="btn btn-primary">
                            @isset($role)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Update</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script>
        function resetForm(roleFrom) {
            document.getElementById(roleFrom).reset();
            $('.js-example-basic-multiple').val(null).trigger('change');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
