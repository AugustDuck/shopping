import { getProvince } from "../utils/get-api-address";
import { isVietnamPhone } from "../utils/check-phone";
window.addEventListener("beforeunload", function () {
    sessionStorage.clear();
});
$(document).ready(function () {
    sessionStorage.setItem("selectedRoles", JSON.stringify(window.user.roles));
    sessionStorage.setItem(
        "selectedAddresses",
        JSON.stringify(window.user.addresses)
    );
    sessionStorage.setItem(
        "selectedPhones",
        JSON.stringify(window.user.phones)
    );
    saved("selectedRoles", "#rolelist");
    $("#editrole").on("click", function () {
        const roles = JSON.parse(sessionStorage.getItem("selectedRoles"));
        console.log(roles);
        getRoles(roles, function (res) {
            console.log(res);
            const unselectedRoles = res.filter((role) => {
                return !roles.some((roleId) => roleId.id === role.id);
            });
            console.log(unselectedRoles);
            showItem("#listTable", unselectedRoles, "role");
        });
    });

    $("#editaddress").on("click", function () {
        const addresses = JSON.parse(
            sessionStorage.getItem("selectedAddresses")
        );
        console.log(addresses);
        showItem("#listTable", addresses, "address");
    });
    $("#editphone").on("click", function () {
        const phones = JSON.parse(sessionStorage.getItem("selectedPhones"));
        console.log(phones);
        showItem("#listTable", phones, "phone");
    });

    $("#listTable").on("click", ".deleteItem", function () {
        const type = $(this).data("type");
        const id = $(this).data("id");
        console.log(type, id);
        if (type === "role") {
        } else if (type === "address") {
            deleteItem("selectedAddresses", type, id);
            $(this).closest("tr").remove();
        } else if (type === "phone") {
            deleteItem("selectedPhones", type, id);
            $(this).closest("tr").remove();
        }
    });
    $("#listTable").on("click", "#selectRole", function () {
        const id = $(this).data("id");
        const name = $(this).data("name");
        let selectedRoles = JSON.parse(sessionStorage.getItem("selectedRoles"));

        if (selectedRoles.some((role) => role.id === id)) {
            $(this)
                .removeClass("btn-danger")
                .addClass("btn-primary")
                .text("Select");
        } else {
            $(this)
                .removeClass("btn-primary")
                .addClass("btn-danger")
                .text("Unselect");
        }
        if (selectedRoles.some((role) => role.id === id)) {
            selectedRoles = selectedRoles.filter((role) => role.id !== id);
        } else {
            selectedRoles.push({ id: id, name: name });
        }
        sessionStorage.setItem("selectedRoles", JSON.stringify(selectedRoles));
        saved("selectedRoles", "#rolelist");
    });

        //add address or phone values
        $("#addItemWrapper").on("click", "#addBtn", function () {
            const type = $(this).data("type");
            if (type === "address") {
                addAddress();
                console.log("success");
            } else if (type == "phone") {
                addPhone();
            }
        });

        $("#saveEditUser").on("click", function () {

            const data = {
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
                roles: JSON.parse(sessionStorage.getItem("selectedRoles") || "[]"),   
                addresses: JSON.parse(sessionStorage.getItem("selectedAddresses") || "[]"),
                phones: JSON.parse(sessionStorage.getItem("selectedPhones") || "[]")
            }

            if(data.name == '' || data.email == '' ||data.addresses == '' || data.phones == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Thiếu thông tin',
                    text: 'Vui lòng nhập đầy đủ thông tin',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            }

            $.ajax({
                url: window.route.updateUser.replace(':id', window.user.id),
                type: "PUT",
                data: data,
                headers: {
                    'Authorization': `Bearer ${window.authToken}`
                },
                success: function (res) {
                    console.log(res);
                    if(res.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        })
                    }
                },
                 error: function (error) {
                     console.error("Error adding user:", error);
                     Swal.fire({
                         icon: "error",
                         title: "Error",
                         text: error.responseJSON,
                         confirmButtonColor: "#3085d6",
                         confirmButtonText: "OK",
                     })
                 }
            })
        });

});

function deleteItem(key, type, id) {
    let selected = JSON.parse(sessionStorage.getItem(key));
    selected = selected.filter((item) => item.id !== id);
    sessionStorage.setItem(key, JSON.stringify(selected));
    saved(key, `#${type}list`);
}
function showItem(elementId, data, type) {
    const select = $(elementId);
    const itemWrapper = $("#addItemWrapper");
    select.empty();
    itemWrapper.empty();
    if (type === "role") {
        const selectedRoles = JSON.parse(
            sessionStorage.getItem("selectedRoles")
        );

        selectedRoles?.forEach((item) => {
            console.log("Item unslect:", item);
            select.append(`
                <tr>
                <td>${item.name}</td>
                <td><button class="btn btn-danger mt-2" id="selectRole" data-type="${type}"data-name="${item.name}" data-id="${item.id}">Unselect</button></td>
                </tr>
                `);
        });
        data.forEach((item) => {
            console.log("Item slect", item);
            select.append(`
                <tr>
                <td>${item.name}</td>
                <td><button class="btn btn-primary mt-2" id="selectRole" data-type="${type}" data-name="${item.name}" data-id="${item.id}">Select</button></td>
                </tr>
                `);
        });
    } else if (type === "address") {
        getProvince();
        data.forEach((item) => {
            console.log("Item slect", item);
            select.append(`
                <tr>
                <td>${item.address}</td>
                <td><button class="btn btn-danger mt-2 deleteItem"  data-type="${type}" data-name="${item.name}" data-id="${item.id}">Delete</button></td>
                </tr>
                `);
        });
        itemWrapper.append(`
            <input type="text" class="form-control" id="inputValue" placeholder="Nhập số nhà & tên đường">
            <div class="row pt-3 pb-3">
                <div class="col-md-4">
                    <label>Tỉnh/Thành phố</label>
                    <select id="province" class="form-select">
                        <option>-- Chọn tỉnh --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Quận/Huyện</label>
                    <select id="district" class="form-select">
                        <option>-- Chọn huyện --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Phường/Xã</label>
                    <select id="ward" class="form-select">
                        <option>-- Chọn xã --</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success mt-2 " data-type ="address" id="addBtn">Add Address</button>
        `);
    } else if (type === "phone") {
        data.forEach((item) => {
            console.log("Item slect", item);
            select.append(`
                <tr>
                <td>${item.phone_number}</td>
                <td><button class="btn btn-danger mt-2 deleteItem"  data-type="${type}"  data-id="${item.id}">Delete</button></td>
                </tr>
                `);
        });
        itemWrapper.append(`
            <input type="phone" class="form-control" id="inputValue" placeholder="Enter phone number">
            <button class="btn btn-success mt-2" data-type ="phone" id="addBtn">Add</button>
        `);
    }
}
// Noite
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
                     value.address || value.name || value.phone_number
                 }" readonly>
                `);
        });
    } else {
        alert("valuse ko phải mảng");
    }
}
function getRoles(data, callback) {
    let url;

    url = window.route.getRoles || null;
    console.log("URL:", url);
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        headers: {
            Authorization: `Bearer ${window.authToken}`,
        },
        success: function (res) {
            callback(res.data);
        },
        error: function (error) {
            console.error("Error fetching :", error);
        },
    });
}
function addPhone() {
    const listTable = $("#listTable");
    const phoneNumber = {'phone_number': $("#inputValue").val().trim()};
    
    let phoneList = JSON.parse(sessionStorage.getItem("selectedPhones")) || [];
    console.log("phoneList", phoneList);
    console.log("phoneNumber", phoneNumber);
    if (phoneNumber.phone_number === "") {
        Swal.fire({
            icon: "warning",
            title: "Thiếu thông tin!",
            text: "Vui lòng nhập đầy đủ địa chỉ.",
        });
        return;
    } else if (!isVietnamPhone(phoneNumber.phone_number)) {
        Swal.fire({
            icon: "warning",
            title: "Thiếu Thông Tin",
            text: "Số điện thoại không hợp lệ.",
        });
        return;
    }

    phoneList.push(phoneNumber);
    phoneList = [...new Set(phoneList)];
    sessionStorage.setItem("selectedPhones", JSON.stringify(phoneList));
    $("#inputValue").val("");

    listTable.append(`
        <tr>
         <td> ${phoneNumber}</td>
         <td><button class="btn btn-danger deleteItem mt-2" data-type ="phone" data-item="${phoneNumber}" >Delete</button></td
        </tr>
        `);
    saved("selectedPhones", "#phonelist");
}
function addAddress() {
    const listTable = $("#listTable");
    const street = $("#inputValue").val().trim();
    const province = $("#province option:selected").text();
    const district = $("#district option:selected").text();
    const ward = $("#ward option:selected").text();

    const selectedAddress =
        JSON.parse(sessionStorage.getItem("selectedAddresses")) || [];
    // Kiểm tra nếu chưa chọn đủ thông tin
    if (
        !street ||
        province.includes("Chọn") ||
        district.includes("Chọn") ||
        ward.includes("Chọn")
    ) {
        Swal.fire({
            icon: "warning",
            title: "Thiếu thông tin!",
            text: "Vui lòng nhập đầy đủ địa chỉ.",
        });
        return;
    }

    const address ={'address':`${street}, ${ward}, ${district}, ${province}`};

    selectedAddress.push(address);
    console.log("Address:", address);

    listTable.append(`
         <tr>
         <td> ${address}</td>
         <td><button class="btn btn-danger deleteItem mt-2" data-type ="phone" data-item="${address}" >Delete</button></td
         </tr>
     `);

    // Xoá form sau khi thêm
    $("#inputValue").val("");
    $("#province").val("");
    $("#district").empty().append("<option>-- Chọn huyện --</option>");
    $("#ward").empty().append("<option>-- Chọn xã --</option>");

    sessionStorage.setItem(
        "selectedAddresses",
        JSON.stringify(selectedAddress)
    );
    saved("selectedAddresses", "#addresslist");
}
