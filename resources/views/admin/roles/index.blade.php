@extends('layout.admin.app')
@section('title', 'Danh sách vai trò')
@section('content')
    <!-- Hiển thị thông báo -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Role Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0 ">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mr-2">Add New Roles</a>
            {{-- <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mr-2">Add New Permisson</a> --}}
        </div>
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td> 
                            <select name="permisson" class="form-select">
                                @foreach ($role->permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" id="editBtn" href="{{ route('admin.roles.edit', $role->id) }}"
                                data-role-id="{{ $role->id }}">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger deleteRoleBtn"
                                data-role-id="{{ $role->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No products found</td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{-- <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div> --}}


    @push('scripts')
        @vite('resources/js/admin/admin-delete-role.js')
    @endpush
@endsection
