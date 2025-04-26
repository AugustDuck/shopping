$(document).ready(function () {
    $(".deleteUserBtn").on("click", function () {
        const idUser = $(this).data("user-id");
        const row = $(this).closest("tr");
        
        Swal.fire({
            icon: 'warning',
            title: 'Bảo mật dữ liệu',
            text: 'Bạn có chắc chắn xóa?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xoa',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(idUser);
                deleteUser(idUser);
                // row.remove();
            }
        })
    })
});

function deleteUser(idUser){
    let url = window.route.deleteUser.replace(':id', idUser);
    console.log(url);
    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        headers: {
            Authorization: `Bearer ${window.authToken}`,
        },
        data: {
            id: idUser,
        },
        success: function (res) {
            if (res.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Xoá người dung thanh cong',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
                console.log(res);
                
            }
        },
        error: function (error) {
            console.error("Error fetching :", error);
        },
    });
}
