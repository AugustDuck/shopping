import { error } from "laravel-mix/src/Log";

$(document).ready(function () {
    saved('selectedPermissions', '#permissionList');
    $('#addPermissionModal').on('show.bs.modal', function (e) {
        getPermissions(function (data) {
            console.log(data);
            $('#listTable').empty();
            let selectedPermissions = JSON.parse(sessionStorage.getItem('selectedPermissions')) || [];
            data.forEach(function (item) {

                const isSelected = selectedPermissions.some(permission => permission.id === item.id);
                console.log(isSelected);
                $('#listTable').append(`
                    <tr>
                        <td><span class="badge bg-success">${item.name}</span></td>
                        <td><input type="button" class="btn ${isSelected ? 'btn-success' : 'btn-primary'} permissions" data-id="${item.id}" data-name="${item.name}" name="permissions" value="${isSelected ? 'Selected' : 'Select'}"></td>
                    </tr>
                `);
               
            });
        });
    })
    $('#addPermissionModal').on('click','.permissions', function () {
        const id = $(this).data('id');
        const name = $(this).data('name').trim();  

        let selectedPermissions = JSON.parse(sessionStorage.getItem('selectedPermissions')) || [];
        console.log(selectedPermissions);
        if (!selectedPermissions.some(permission => permission.id === id)) {
            selectedPermissions.push({ id: id, name:name});
            $(this).removeClass('btn-primary').addClass('btn-success').val('Selected');
        } else {
          
            selectedPermissions = selectedPermissions.filter(permission => permission.id !== id);
            $(this).removeClass('btn-success').addClass('btn-primary').val('Select');
        }
        sessionStorage.setItem('selectedPermissions', JSON.stringify(selectedPermissions));
        saved('selectedPermissions', '#permissionList');
    })
    $('#addRoleBtn').on('click', function () {
       
        const name = $('#roleName').val();
        const permissions = JSON.parse(sessionStorage.getItem('selectedPermissions')).map(permission => permission.name);
        console.log(permissions);
       if (name == '') {
           Swal.fire({
               icon: 'warning', 
               title: 'Thiếu thông tin',
               text: 'Vui lòng nhập đầy đủ thông tin',
               confirmButtonColor: '#3085d6',
               confirmButtonText: 'OK'
           })
           return;
        }

        $.ajax({
            url: window.route.addRole,
            type: "POST",
            data: {
                name: name,
                permissions: permissions
            },
            headers: {
                'Authorization': `Bearer ${window.authToken}`
            },
            success: function (res) {
                console.log(res);
                if(res.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tạo role thành công',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK' 
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log(res);
                    }
                }) 
                }
            },
            error: function (error) {
                console.error("Error fetching :", error.responseJSON.message);
            }
        })
   
        
    });
    
})

function getPermissions(callback) {
    $.ajax({
        url: window.route.getPermissions,
        type: "GET",
        dataType: "json",
        headers: {
            Authorization: `Bearer ${window.authToken}`,
        },
        success: function (res) {
            console.log(res);
            callback(res.data);
        },
        error: function (error) {
            console.error("Error fetching :", error);
        },
    })
}
function saved(key, elementId) {
    const values = JSON.parse(sessionStorage.getItem(key)) || [];
    console.log(values);
    const input = $(elementId).empty();
    if (values.length === 0 && Array.isArray(values)) {
        input.append(`
                 <input type="text" class="form-control" placeholder="No infor" readonly>
                `);
    } else if (values.length > 0 && Array.isArray(values)) {
        values.forEach((value) => {
            input.append(`
                 <input type="text" class="form-control" placeholder="${
                     value.name
                 }" readonly>
                `);
        });
    } else {
        alert("valuse ko phải mảng");
    }
}