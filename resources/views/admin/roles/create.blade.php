@extends('layout.admin.app')
@section('title', 'Create User')
@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Form thêm role và gán hành động -->
        <div class="col-md-5">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thêm Role mới</h5>
                </div>
                <div class="card-body">
                    <form id="addRoleForm">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Tên Role</label>
                            <input type="text" class="form-control" id="roleName" name="role_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div id="address-wrapper">
                                <div class="input-group mb-2" id ="permissionList">
                                    <input type="text" name="permisson" class="form-control" placeholder="No infor" readonly>                  
                                </div>
                            </div>
                            <button 
                            type="button" 
                            class="btn btn-outline-primary" 
                            id="add-permissions"
                            data-bs-toggle="modal"
                            data-bs-target="#addPermissionModal">
                            Add permission
                            </button>
                        </div>

                        <button type="button" id="addRoleBtn" class="btn btn-success w-100">Thêm Role</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Danh sách role -->
        <div class="col-md-7">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách Roles</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="rolesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Role</th>
                                <th>Hành động đã gán</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role )
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="scrollable-cell">
                                    @foreach ($role->permissions as $permission)
                                    <span class="badge bg-primary">{{$permission->name}}</span>
                                    @endforeach
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- modal add permissons --}}
    <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="listModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listModalLabel">Permission List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="listTable" >
                            {{-- thêm từ db --}}
                        </tbody>
                    </table>
                    <div class="mt-3" id="addItemWrapper">
                        {{-- <input type="text" class="form-control" id="newItemName" placeholder="Enter new role">
                        <button class="btn btn-success mt-2" id="addItemBtn">Add Role</button> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
@vite(['resources/js/admin/admin-create-role.js'])
@endpush
@endsection