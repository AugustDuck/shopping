@extends('layout.admin.app')
@section('title', 'Edit User')
@section('content')
    <div class="container">
        <h2>Edit {{ $user->name }}  </h2>
        <form action="">
            @csrf
            @method('PUT')
            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" value="{{ $user->name }}" name="name" class="form-control" required>
            </div>
            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" value="{{ $user->email }}" name="email" class="form-control" required>
            </div>
            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" placeholder="Nhập mật khẩu mới" name="password" class="form-control" required>
                <div class="form-text text-muted">
                    Để trống nếu không muốn thay đổi mật khẩu.
                </div>
            </div>
            {{-- Roles --}}
            <div class="mb-3">
                <label class="form-label">Role</label>
                <div id="role-wrapper">
                    <div class="input-group mb-2" id="rolelist">
                        @foreach ($user->roles as $role)
                            <input type="text" name="role" class="form-control" value="{{ $role->name }}" readonly>
                        @endforeach

                    </div>
                </div>
                <a type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-warning"
                    id="editrole" data-type="roles">Edit Role</a>
            </div>
            {{-- Addresses --}}
            <div class="mb-3">
                <label class="form-label">Addresses</label>
                <div id="address-wrapper">
                    <div class="input-group mb-2" id="addresslist">
                        @foreach ($user->addresses as $address)
                            <input type="text" name="addresses" class="form-control" value="{{ $address->address }}" readonly>

                        @endforeach
                    </div>
                </div>
                <a type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-warning"
                    id="editaddress" data-type="addresses">Edit Address</a>
            </div>

            {{-- Phones --}}
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <div id="phone-wrapper">
                    <div class="input-group mb-2" id="phonelist">
                        @foreach ($user->phones as $phone)
                            <input type="text" name="phones" class="form-control" value="{{ $phone->phone_number }}"
                                readonly>
                        @endforeach
                    </div>
                </div>
                <a type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-warning"
                    id="editphone" data-type="phones">Edit Phone</a>
            </div>

            <button type="button" id="saveEditUser" class="btn btn-success">Save Edit User</button>
        </form>
    </div>


    {{-- modal edit role phone address --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="listModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listModalLabel">Role List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="listTable">
                            {{-- thêm từ db --}}
                        </tbody>
                    </table>
                    <div class="mt-3" id="addItemWrapper" >

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.user = @json($user)
    </script>
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

        document.addEventListener('click', function (e) {
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

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-phone')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
    @endpush --}}
    @push('scripts')
   @vite(['resources/js/admin/admin-edit-user.js']) 
    @endpush
@endsection