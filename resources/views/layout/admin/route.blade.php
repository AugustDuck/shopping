<script>
    window.authToken = @json($token);
    window.route = {
        getUser: "{{ route('admin.users.edit', ':id') }}",
        getRoles: "{{ route('admin.api.roles.index') }}",
        getAddresses: "{{ route('admin.api.addresses.index') }}",
        getPhones: "{{ route('admin.api.phones.index') }}",
        addUser:"{{ route('admin.api.users.store') }}",
        updateUser:"{{ route('admin.api.users.update', ':id') }}",
        deleteUser:"{{ route('admin.api.users.destroy', ':id') }}",
        getPermissions:"{{ route('admin.api.permissions.index') }}",
        addRole:"{{ route('admin.api.roles.store')}}",
        updateRole:"{{ route('admin.api.roles.update', ':id') }}",
        deleteRole:"{{ route('admin.api.roles.destroy', ':id') }}",
       
    }
</script>