@extends('layout.admin.app')
@section('title', 'Danh sách sản phẩm')
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
        <h1 class="h2">User Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New Product</a>
        </div>
    </div>
    
    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-success">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <select name="address" id="address" class="form-select">
                                @foreach($user->addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->address }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="phone" id="phone" class="form-select">
                                @foreach($user->phones as $phone)
                                    <option value="{{ $phone->id }}">{{ $phone->phone_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a  class="btn btn-sm btn-warning" 
                                id="editBtn" 
                                href="{{ route('admin.users.edit', $user->id) }}"
                                data-user-id="{{ $user->id }}">Edit</a>
                          
                                <button type="button" class="btn btn-sm btn-danger deleteUserBtn"
                                 data-user-id="{{ $user->id }}">Delete</button>
                           
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
        @vite('resources/js/admin/admin-delete-user.js')
    @endpush
@endsection
