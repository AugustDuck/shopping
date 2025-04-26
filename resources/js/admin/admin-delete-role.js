$(document).ready(function () {
    $(".deleteRoleBtn").on("click", function () {
        const idRole = $(this).data("role-id");
        const row = $(this).closest("tr");
        console.log(idRole);
        let url = window.route.deleteRole.replace(':id', idRole);  // Chắc chắn rằng URL này hợp lệ
        console.log("URL DELETE: ", url);
        
        Swal.fire({
            icon: 'warning',
            title: 'Bảo mật dữ liệu',
            text: 'Bạn có chắc chắn xóa?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(idRole);
                deleteRole(idRole, row); // Chuyển cả row để xóa sau khi thành công
            }
        });
    });
});

function deleteRole(idRole, row) {
    let url = window.route.deleteRole.replace(':id', idRole);  // Đảm bảo rằng URL có chứa :id chính xác
    console.log("URL to send DELETE request: ", url);

    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        headers: {
            Authorization: `Bearer ${window.authToken}`, // Xác thực thông qua token
        },
        success: function (res) {
            console.log(res); // Debug response
            if (res.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Xoá thành công!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });

                // Sau khi xóa thành công, loại bỏ dòng role khỏi bảng
                row.remove(); // Loại bỏ row từ table nếu xóa thành công
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không thể xóa role này!',
                });
            }
        },
        error: function (error) {
            console.error("Error fetching:", error);
            const msg = error.responseJSON?.message || 'Lỗi không xác định từ server';
            Swal.fire({
                icon: 'error',
                title: 'Xóa role thất bại',
                text: msg
            });
        }
    });
}
