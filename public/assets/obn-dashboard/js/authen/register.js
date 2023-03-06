const formRegister = jQuery("#formRegister");
formRegister.validate({
    // Specify validation rules
    rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        name: "required",
        username: "required",
        parent_code: "required",
        password: {
            minlength: 6,
            required: true,
        },
        phone: {
            minlength: 10,
            required: true,
        },
        email: {
            email: true,
            required: true,
        },
    },
    // Specify validation error messages
    messages: {
        name: "Vui lòng nhập Họ & tên",
        parent_code: "Vui lòng nhập Mã giới thiệu",
        username: "Vui lòng nhập tên đăng nhập",
        password: {
            minlength: "Mật khẩu ít nhất 6 ký tự",
            required: "Vui lòng nhập mật khẩu",
        },
        phone: {
            minlength: "Số điện thoại ít nhất 10 ký tự",
            required: "Vui lòng nhập số điện thoại",
        },
        email: {
            email: "Email không hợp lệ.",
            required: "Vui lòng nhập email",
        },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
        const params = getFormData(formRegister);
        const url = formRegister.data("url");
        params.url = url;
        handleRegister(params);
        return false;
    },
});
const handleRegister = (params) => {
    let _token = $('meta[name="csrf-token"]').attr("content");
    params._token = _token;
    $.ajax({
        type: "post",
        url: params.url,
        data: params,
        dataType: "json",
        beforeSend: function () {
            showLoading();
        },
        success: function (response) {
            let status = response.status;
            let msg = response.msg;
            if (status == 200) {
                swal(
                    {
                        title: "Thông báo",
                        text: `${msg}`,
                        type: "success",
                    },
                    function () {
                       location.reload();
                    }
                );
                
            } else {
                swal(
                    {
                        title: "Thông báo",
                        text: "Vui lòng kiểm tra lại thông tin",
                        type: "warning",
                    },
                    function () {
                        for (let key in msg) {
                            const msg_item = msg[key];
                            parent = jQuery(`input[name='${key}']`).parent();
                            parent.append(
                                `<label id='${key}-error' class="error" for='${key}'>${msg_item}</label>`
                            );
                        }
                    }
                );
            }

            console.log(response);
        },
        complete: function () {
            hideLoading();
        },
    });
};
