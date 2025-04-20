import { getProvince } from "../utils/get-api-address";
import {isVietnamPhone} from "../utils/check-phone";

$(document).ready(function () {
    // $('#editModalUser').on('show.bs.modal', function (e) {
    //     const button = $(e.relatedTarget);
    //     const userId = button.data('user-id');
    //     console.log("User ID:", userId);
    //     showEditUserForm(userId);
    saved("selectedRoles", "#rolelist");
    saved("selectedAddresses", "#addresslist");
    saved("selectedPhones", "#phonelist");
    // });
    console.log("Route:", window.route.getRoles || null);
    console.log("Route:", window.authToken || null);
    $("#editModal").on("show.bs.modal", function (e) {
        const type = $(e.relatedTarget).data("type");
        console.log("Type:", type);
        const data = window.user;
        console.log("Data:", data);
        loadItem(type, data);
    });
    $("#addModal").on("show.bs.modal", function (e) {
        const type = $(e.relatedTarget).data("type");
        console.log("Type:", type);
        const listTable = $("#listTable");
        const addItemWrapper = $("#addItemWrapper");
        listTable.empty();
        addItemWrapper.empty();
        getItem(type, function (data) {
            // console.log("Data:", data);
            loadItem(type, data);
        });
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

    $("#listTable").on("click", ".deleteItem", function () {
        const rowDelete = $(this).data("item");
        const type = $(this).data("type");
        if (type === "address") {
            deleteItem("selectedAddresses", rowDelete);
            $(this).parent().parent().remove();
        } else if (type === "phone") {
            deleteItem("selectedPhones",rowDelete);
            $(this).parent().parent().remove();
        }
    });

    $("#listTable").on("click", "#selectRole", function () {
        const roleName = $(this).data("name");
        console.log("roleID: ", roleName);
        let selectedRoles =
            JSON.parse(sessionStorage.getItem("selectedRoles")) || [];

        const isSelected = selectedRoles.includes(roleName);

        if (!isSelected) {
            selectedRoles.push(roleName);
            $(this)
                .removeClass("btn-primary")
                .addClass("btn-warning")
                .text("Unselect");
        } else {
            selectedRoles = selectedRoles.filter((name) => name !== roleName);
            $(this)
                .removeClass("btn-warning")
                .addClass("btn-primary")
                .text("Select");
        }
        sessionStorage.setItem("selectedRoles", JSON.stringify(selectedRoles));
        saved("selectedRoles", "#rolelist");
    });

    //adduser
    $("#addUser").on("click", function (e) {

        e.preventDefault();

        const data ={
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
            roles: JSON.parse(sessionStorage.getItem("selectedRoles") || "[]"),
            addresses: JSON.parse(sessionStorage.getItem("selectedAddresses") || "[]"),
            phones: JSON.parse(sessionStorage.getItem("selectedPhones") || "[]")
        }

        if(data.name == '' || data.email == '' || data.password == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu thông tin',
                text: 'Vui lòng nhập đầy đủ thông tin',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
        }
        $.ajax({
            url: window.route.addUser,
            type: "POST",
            data: data,
            headers: {
                'Authorization': `Bearer ${window.authToken}`
            },
            success: function (response) {
                console.log("Response:", response);
                if (response.status === 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Thêm user thành công",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {  
                            sessionStorage.clear();  
                            window.location.reload();
                        }
                    });
                }   
        },
            error: function (error) {
                console.error("Error adding user:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error.responseJSON.message,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                })
    }
        });
    }); 
});

// load phone or address or role of user
function loadItem(type, data) {
    const listTable = $("#listTable");
    const addItemWrapper = $("#addItemWrapper");

    const selectedRoles = sessionStorage.getItem("selectedRoles") || [];
    listTable.empty();
    addItemWrapper.empty();
    if (type === "roles") {
        data.data.forEach((item) => {
            // console.log("Item:", item);
            const isSelected = selectedRoles
                ? selectedRoles.includes(item.name)
                : false;
            listTable.append(`
                <tr>
                <td>${item.name}</td>
                <td><button class="btn btn-${
                    isSelected ? "warning" : "primary"
                } delete-item" id="selectRole" data-name="${item.name}">${
                isSelected ? "Unselect" : "Select"
            }</button></td>
                </tr>
            `);
        });
    } else if (type === "addresses") {
        const addressList =
            JSON.parse(sessionStorage.getItem("selectedAddresses")) || [];

        console.log(addressList);
        getProvince();
        addressList.forEach((item) => {
            console.log(item);
            listTable.append(`
                <tr>
                <td> ${item}</td>
                <td><button class="btn btn-danger deleteItem mt-2" data-type ="address" data-item="${item}">Delete</button></td>
                </tr>
            `);
        });
        addItemWrapper.append(`
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
                <button class="btn btn-success mt-2" data-type ="address" id="addBtn">Add Address</button>
            `);
    } else {
        const phoneList =
            JSON.parse(sessionStorage.getItem("selectedPhones")) || [];
        phoneList.forEach((item) => {
            console.log(item);
            listTable.append(`
                <tr>
                <td> ${item}</td>
                <td><button class="btn btn-danger deleteItem mt-2" data-type ="phone" data-item="${item}" >Delete</button></td>
                </tr>
            `);
        });
        addItemWrapper.append(`
                <input type="text"class="form-control" 
                id="inputValue" 
                name="phone" 
                data-type ="phone" 
                placeholder="Enter new phone"
               
                >
                <button class="btn btn-success mt-2" data-type = "phone" id="addBtn">Add Phone</button>
        `);
    }
}

// use create.user page
function getItem(type, callback) {
    let url;
    if (type === "roles") {
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
                console.log("Data:", res.data);
                callback(res);
            },
            error: function (error) {
                console.error("Error fetching :", error);
            },
        });
    } else {
        callback(type);
    }
}
// function showList(elementId,data) {

//     const select = $(elementId);
//     // console.log("data showlist:", data);
//     select.empty();
//     data.forEach((item) => {
//         console.log("Item:", item);
//         select.append(`<input type="text" name="${item.name}" class="form-control" placeholder="No role" readonly>`);
//     });

// }

// Noite
function saved(key, elementId) {
    const values = JSON.parse(sessionStorage.getItem(key)) || [];
    const input = $(elementId).empty();
    if (values.length === 0 && Array.isArray(values)) {
        input.append(`
                 <input type="text" class="form-control" placeholder="No infor" readonly>
                `);
    } else if (values.length > 0 && Array.isArray(values)) {
        console.log("values:", values);
        values.forEach((value) => {
            input.append(`
                 <input type="text" class="form-control" placeholder="${value}" readonly>
                `);
        });
    } else {
        alert("valuse ko phải mảng");
    }
}
// delete address or phone
function deleteItem(key, value) {
    let itemList = JSON.parse(sessionStorage.getItem(key));
    itemList = itemList.filter((item) => item !== value);
    sessionStorage.setItem(key, JSON.stringify(itemList));

    if (key === "selectedAddresses"){
        saved('selectedAddresses','#addresslist')
    } else if (key === "selectedPhones"){
        saved('selectedPhones','#phonelist')
    }
}
export function addPhone() {
    const listTable = $("#listTable");
    const phoneNumber = $("#inputValue").val().trim();

    let phoneList = JSON.parse(sessionStorage.getItem("selectedPhones")) || [];

    if (phoneNumber === "") {
        Swal.fire({
            icon: "warning",
            title: "Thiếu thông tin!",
            text: "Vui lòng nhập đầy đủ địa chỉ.",
        });
        return;
    } else if (!isVietnamPhone(phoneNumber)) {
        Swal.fire({
            icon: "warning",
            title: "Thiếu Thông Tin",
            text: "Số điện thoại không hợp lệ.",
        });
        return;
    }

    phoneList.push(phoneNumber);
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
export function addAddress() {
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

    const address = `${street}, ${ward}, ${district}, ${province}`;

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



