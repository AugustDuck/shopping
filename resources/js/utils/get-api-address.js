export function getProvince() {
    $.get("https://provinces.open-api.vn/api/p/", function (data) {
        data.forEach(function (province) {
            $("#province").append(
                `<option value="${province.code}">${province.name}</option>`
            );
        });
    });
    $(document).on("change", "#province", function () {
        const provinceId = $(this).val();
        $("#district").empty().append("<option>-- Chọn huyện --</option>");
        $("#ward").empty().append("<option>-- Chọn xã --</option>");

        $.get(
            `https://provinces.open-api.vn/api/p/${provinceId}?depth=2`,
            function (data) {
                data.districts.forEach(function (district) {
                    $("#district").append(
                        `<option value="${district.code}">${district.name}</option>`
                    );
                });
            }
        );
    });

    $(document).on("change", "#district", function () {
        const districtId = $(this).val();
        $("#ward").empty().append("<option>-- Chọn xã --</option>");

        $.get(
            `https://provinces.open-api.vn/api/d/${districtId}?depth=2`,
            function (data) {
                data.wards.forEach(function (ward) {
                    $("#ward").append(
                        `<option value="${ward.code}">${ward.name}</option>`
                    );
                });
            }
        );
    });
}