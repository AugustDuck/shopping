<script>
    window.authToken = @json($token);
    window.route = {
        getUser: "{{ route('admin.users.edit', ':id') }}",
        getRoles: "{{ route('admin.api.roles.index') }}",
        getAddresses: "{{ route('admin.api.addresses.index') }}",
        getPhones: "{{ route('admin.api.phones.index') }}",
        addUser:"{{ route('admin.api.users.store') }}",
        updateUser:"{{ route('admin.api.users.update', ':id') }}",
        deleteUser:"{{ route('admin.api.users.destroy', ':id') }}"
    }
</script>