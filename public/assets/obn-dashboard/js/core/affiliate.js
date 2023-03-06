$(document).ready(function () {
  const usersDatatableColumns = [
    {
      data: null,
      orderable: false,
      searchable: true,
      render: function (data) {
        let html = "";
        html += "Họ tên: " + data.fullname + "<br/>";
        html += "Email: " + data.email + "<br>";
        html += "Cấp độ: " + data.levelName ?? "-";
        if (data.status == "active") {
          html +=
            '<br/>Link affiliate: <a target="_blank" href="' +
            data.affilate_link +
            '">' +
            data.affilate_link +
            "</a>";
        }
        return html;
      },
    },
    {
      data: "fullname",
      orderable: false,
      searchable: true,
      className: "d-none",
    },
    {
      data: "email",
      orderable: false,
      searchable: true,
      className: "d-none",
    },
    {
      data: "phone",
      orderable: false,
      searchable: true,
    },
    {
      data: "status",
      orderable: false,
      searchable: false,
      render: function (status) {
        switch (status) {
          case "pending":
            return '<span class="label bg-grey-400">Đang chờ duyệt</span>';
            break;
          case "active":
            return '<span class="label bg-success-400">Đang hoạt động</span>';
            break;
        }
        //return '<span class="label bg-danger">'+transaction.translated_status+'</span>'
      },
    },
    {
      data: null,
      searchable: false,
      orderable: false,
      render: function (data) {
        var view_detail =
          data.status == "pending"
            ? ""
            : '<a href="' +
              data.route_detail +
              '" class="mr-10 text-info-600"><i class="icon-info3"></i>Xem chi tiết</a>';
        var status =
          data.status == "pending"
            ? '<a class="mr-15 text-success-600 approve_affiliate" data-id="' +
              data.id +
              '"><i class="icon-checkmark"></i> Duyệt tài khoản</a>'
            : "";
        return (
          view_detail +
          status +
          WBDatatables.showRemoveIcon(
            data.route_remove,
            "Bạn có chắc muốn xóa tài khoản này không?"
          )
        );
      },
    },
    {
      data: "created_at",
      orderable: true,
      searchable: true,
      className: "d-none",
    },
  ];

  $(document).on("click", ".approve_affiliate", function () {
    var user_id = $(this).data("id");
    swal(
      {
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        title: "Bạn có chắc duyệt tài khoản này không ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        cancelButtonText: "Không",
        confirmButtonText: "Có",
      },
      function () {
        $(document).find("a.approve_affiliate").addClass("disabled");
        $.ajax({
          url: base_domain + "/admin/affiliate/approve-account",
          type: "POST",
          dataType: "json",
          data: {
            _token: _token,
            id: user_id,
          },
          success: function (response) {
            swal.close();
            affiliateUsersDatatable.ajax.reload();
            if (response.success) {
              successNotice("Thông báo", "Đổi trạng thái yêu cầu thành công");
            } else {
              errorNotice("Thông báo", "Có lỗi xảy ra");
            }
          },
          error: function () {
            swal.close();
            errorNotice("Thông báo", "Có lỗi xảy ra");
          },
          complete: function () {
            $(document).find("a.approve_affiliate").removeClass("disabled");
          },
        });
      }
    );
  });

  if ($("#affiliateUsersDatatable").length) {
    var affiliateUsersDatatable = WBDatatables.init(
      "#affiliateUsersDatatable",
      usersDatatableColumns,
      {
        ordering: true,
        lengthChange: false,
        searchDelay: 400,
      }
    );

    affiliateUsersDatatable.column("8:visible").order("desc").draw();
  }

  const userRefColumns = [
    {
      data: "fullname",
    },
    {
      data: "email",
    },
    {
      data: "formatted_created_at",
      searchable: false,
    },
  ];
  $("#userRef").length &&
    WBDatatables.init("#userRef", userRefColumns, {
      ordering: false,
      lengthChange: false,
      searchDelay: 400,
    });

  const orderProfitColumns = [
    {
      data: null,
      name: "order.code",
      render: function (transaction) {
        return (
          `<a href="` +
          base_domain +
          `/admin/order/${transaction.order_id}" target="_blank">${transaction.order.code}</a>`
        );
      },
    },
    {
      data: "order.fullname",
    },
    {
      data: "formatted_created_at",
      searchable: false,
    },
    {
      data: "formatted_total",
      searchable: false,
    },
    {
      data: "formatted_amount",
      searchable: false,
    },
    {
      data: null,
      searchable: false,
      render: function (transaction) {
        switch (transaction.status) {
          case "pending":
            return (
              '<span class="label bg-grey-400">' +
              transaction.translated_status +
              "</span>"
            );
            break;
          case "success":
            return (
              '<span class="label bg-success-400">' +
              transaction.translated_status +
              "</span>"
            );
            break;
        }
        return (
          '<span class="label bg-danger">' +
          transaction.translated_status +
          "</span>"
        );
      },
    },
  ];
  $("#orderProfit").length &&
    WBDatatables.init("#orderProfit", orderProfitColumns, {
      ordering: false,
      lengthChange: false,
      searchDelay: 400,
    });

  const transactionColumns = [
    {
      data: "formatted_created_at",
      searchable: false,
      orderable: false,
    },
    {
      data: "description",
      searchable: false,
      orderable: false,
    },
    {
      data: "formatted_amount",
      searchable: false,
      orderable: false,
    },
    {
      data: "translated_status",
      searchable: false,
      orderable: false,
    },
  ];

  $("#transactionHistory").length &&
    WBDatatables.init("#transactionHistory", transactionColumns, {
      ordering: false,
      lengthChange: false,
      searching: false,
    });

  const withdrawalRequestColumns = [
    {
      data: "formatted_created_at",
      searchable: false,
    },
    {
      data: "affiliate_user_fullname",
    },
    {
      data: "affiliate_user_phone",
    },
    {
      data: "formatted_total_balance",
      searchable: false,
    },
    {
      data: "formatted_amount",
      searchable: false,
    },
    {
      data: "translated_status",
      searchable: false,
    },
    {
      data: null,
      render: function (data) {
        if (data.is_user_exist == 0) {
          return '<span class="text-danger-600">User không tồn tại</span>';
        }
        if (data.status == "new" || data.status == "pending") {
          return `<a href="javascript:void(0)" data-href="${data.route_accept}" class="change-transaction-status mr-5 text-success-600"><i class="icon-checkmark"></i> Duyệt yêu cầu</a>
                    <a href="javascript:void(0)" data-href="${data.route_cancel}" class="change-transaction-status text-danger-600"> <i class="icon-cross2"></i> Hủy yêu cầu</a>`;
        }
        return "";
      },
    },
  ];
  if ($("#withdrawalRequestDatatable").length) {
    let $withdrawalDatatable = WBDatatables.init(
      "#withdrawalRequestDatatable",
      withdrawalRequestColumns,
      {
        ordering: false,
        lengthChange: false,
        searchDelay: 400,
      }
    );
    $(document).on("click", ".change-transaction-status", function () {
      let url = $(this).data("href");
      swal(
        {
          showLoaderOnConfirm: true,
          closeOnConfirm: false,
          title: "Bạn có chắc thực hiện thao tác này không ?",
          text: "Bạn sẽ thay đổi trạng thái yêu cầu rút tiền!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#FF7043",
          cancelButtonText: "Không",
          confirmButtonText: "Có",
        },
        function () {
          $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
              _token: _token,
            },
            success: function (response) {
              swal.close();
              $withdrawalDatatable.ajax.reload();
              if (response.success) {
                successNotice("Thông báo", "Đổi trạng thái yêu cầu thành công");
              } else {
                errorNotice("Thông báo", "Có lỗi xảy ra");
              }
            },
            error: function () {
              swal.close();
              errorNotice("Thông báo", "Có lỗi xảy ra");
            },
            complete: function () {},
          });
        }
      );
    });
  }
});
