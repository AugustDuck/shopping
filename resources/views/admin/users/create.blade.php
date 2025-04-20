@extends('layout.admin.app')
@section('title', 'Create User')
@section('content')
<div class="container">
    <h2>Create New User </h2>
    <form action="" id="createUserForm" method="POST">
        @csrf
        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" >
        </div>
        {{-- Roles --}}
        <div class="mb-3">
            <label class="form-label">Roles</label>
            <div id="role-wrapper">
                <div class="input-group mb-2" id = "rolelist">
                    <input type="text" name="role" class="form-control" placeholder="No infor" readonly>
                </div>
            </div>
            <button 
            type="button" 
            class="btn btn-outline-primary" 
            id="add-role"
            data-type="roles"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
            Add Role
            </button>
        </div>

        {{-- Addresses --}}
        <div class="mb-3">
            <label class="form-label">Addresses</label>
            <div id="address-wrapper">
                <div class="input-group mb-2" id = "addresslist">
                    <input type="text" name="addresses" class="form-control" placeholder="No infor" readonly>
                   
                </div>
            </div>
            <button 
            type="button" 
            class="btn btn-outline-primary" 
            id="add-address"
            data-type="addresses"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
            Add Address
            </button>
        </div>

        {{-- Phones --}}
        <div class="mb-3">
            <label class="form-label">Phones</label>
            <div id="phone-wrapper">
                <div class="input-group mb-2" id ="phonelist">
                    <input type="text" name="phones" class="form-control" placeholder="No infor" readonly>
                    
                </div>
            </div>
            <button 
            type="button" 
            class="btn btn-outline-primary" 
            id="add-phone"
            data-type="phones"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
            Add Phone
            </button>
        </div>

        <button type="submit" class="btn btn-success" id="addUser">Create User</button>
    </form>
</div>
    {{-- modal add role phone address --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="listModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listModalLabel">Role List</h5>
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

{{-- @push('scripts')
<script>
    // Addresses
    document.getElementById('add-address').addEventListener('click', () => {
        const wrapper = document.getElementById('addresses-wrapper');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" name="addresses[]" class="form-control" placeholder="Enter address">
            <button type="button" class="btn btn-outline-secondary remove-address">🗑️</button>
        `;
        wrapper.appendChild(inputGroup);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-address')) {
            e.target.closest('.input-group').remove();
        }
    });

    // Phones
    document.getElementById('add-phone').addEventListener('click', () => {
        const wrapper = document.getElementById('phones-wrapper');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" name="phones[]" class="form-control" placeholder="Enter phone number">
            <button type="button" class="btn btn-outline-secondary remove-phone">🗑️</button>
        `;
        wrapper.appendChild(inputGroup);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-phone')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>
@endpush --}}

@push('scripts')
@vite(['resources/js/admin/admin-create-user.js'])
@endpush
@endsection