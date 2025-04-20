
$(document).ready(function () {

    $('#editModalUser').on('show.bs.modal', function (e) {
        // const button = $(e.relatedTarget);
        // const userId = button.data('user-id');
        // console.log("User ID:", userId);
        // showEditUserForm(userId);
        alert("show edit user form");

    });

    alert("show edit user form 2");
    // $('#editModal').on('show.bs.modal', function (e) {
    //     const button = $(e.relatedTarget);
    //     const itemType = button.data('item-type');
    //     let userId = $('#userId').val(); // Lấy userId từ modal editUser
    //     loadItem(itemType, userId);
    //     console.log("User id item :", userId);

    // });
})

function showEditUserForm(userId) {
    const url = "{{ route('admin.users.edit', ':id') }}".replace(':id', userId);
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log("User data:", data.roles);
            $('#editEmail').val(data.email);
            $('#editName').val(data.name);
            showList('#editRole', data.roles, 'role');
            showList('#editAddress', data.addresses, 'address');
            showList('#editPhone', data.phones, 'phone_number');
            console.log("ID data:", data.id);
            $('#userId').val(data.id); // Lưu userId vào input ẩn trong modal
            // trả về id để sử dụng cho modal tiếp theo


        },
        error: function (xhr, status, error) {
            console.error("Error fetching user data:", error);
        }
    });

};
function loadItem(type, userId) {
    const listTable = $('#listTable') || null;
    console.log("List table:", listTable);
    let url;
    if (type === 'role') {
        url = "{{ route('admin.api.role.getRoleByUserId', ':id')}}".replace(':id', userId);
    } else if (type === 'address') {
        url = "{{ route('admin.api.address.getAddressByUserId', ':id')}}".replace(':id', userId);
    } else if (type === 'phone') {
        url = "{{ route('admin.api.phone.getPhoneByUserId', ':id')}}".replace(':id', userId);
    } else {
        console.error("Invalid type:", type);
        return;
    }
    // l = "{{ route('admin.users.edit', ':id') }}".replace(':id', userId);
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${window.authToken}`
        },
        success: function (data) {
            listTable.empty();
            console.log("Data in load item", type);
            data.forEach((item) => {
                console.log("Item id :", item);
                listTable.append(`
                        <tr>
                            <td>${item.address || item.phone_number || item.name}</td>

                            ${type === 'phone' || type === 'address' ? `<td><button class="btn btn-primary save-item" data-id="${item.id}">Save</button></td>` : ''}

                            <td><button class="btn btn-danger delete-item" data-id="${item.id}">Delete</button></td>
                        </tr>`);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching user data:", error);
        }

    })
}
function showList(id, data, type) {

    const select = $(id);
    // console.log("data showlist:", data);
    select.empty();
    data.forEach((item) => {
        select.append(`<option value="">${item.name || item.phone_number || item.address}</option>`);
    });

}