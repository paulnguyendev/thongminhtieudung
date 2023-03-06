const formLogin = jQuery("#formLogin");
formLogin.validate({
    // Specify validation rules
    rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        username: "required",
        password: {
            minlength: 6,
            required: true,
        },
    },
    // Specify validation error messages
    messages: {
        username: "Vui lòng nhập tên đăng nhập",
        password: {
            minlength: "Mật khẩu ít nhất 6 ký tự",
            required: "Vui lòng nhập mật khẩu",
        },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
        const params = getFormData(formLogin);
        const url = formLogin.data("url");
        const type = formLogin.data("type");
        params.url = url;
        handleLogin(params);
        return false;
    },
});
const handleLogin = (params) => {
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
                let redirect = response.redirect;
                window.location.href = redirect;
            } else {
                swal(
                    {
                        title: "Thông báo",
                        text: msg,
                        type: "error",
                    },
                    function () {
                        
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
