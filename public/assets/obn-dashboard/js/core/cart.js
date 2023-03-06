const checkCart = () => {
    let url = $(`meta[name="cart-data"]`).attr("content");
    let data = {};
    let products = [];
    $.ajax({
        type: "get",
        url: url,
        data: { action: "checkCart" },
        dataType: "json",
        success: function (response) {
            console.log("Checkcart", response);
            $.each(response, function (key, item) {
                data.action = "add";
                data.id = item.rowId;
                data.title = item.title;
                data.thumbnail = item.options.thumbnail;
                data.price = item.price;
                data.quantity = item.qty;
                data.weight = "";
                _update(data);
            });
        },
    });
    // console.log(shoppingCart);
};
function _update(data) {
    if (data.action == "add") {
        var isExit = false;
        $.each(shoppingCart.products, function (index, item) {
            if (item.id == data.id) {
                isExit = true;
                return false;
            }
        });
        if (!isExit) {
            let quantity = data?.quantity ? data.quantity : 1;
            shoppingCart.products.push({
                id: data.id,
                product_title: data.title,
                price: data.price,
                quantity: quantity,
                thumbnail: data.thumbnail,
                weight: data.weight,
            });
            shoppingCart.subtotal = 0;
            shoppingCart.total_weight = 0;
            renderTableProduct();
            $(document).find(".button-next").show();
        }
    }
    if (data.action == "delete") {
        $("#product_item tbody tr#item_" + data.id).remove();
        $.each(shoppingCart.products, function (index, item) {
            if (item.id == data.id) {
                shoppingCart.products.splice(index, 1);
                return false;
            }
        });
        const removeCart = (data) => {
            let url = $(`meta[name="cart-remove"]`).attr("content");
            $.ajax({
                type: "get",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log("delete cart", response);
                    successNotice("Thông báo", "Xóa giỏ hàng thành công");
                },
            });
        };
        removeCart(data);
        // alert("remove itme cart");
        renderTableProduct();
    }
    if (shoppingCart.products.length == 0) {
        $(document).find(".button-next").hide();
    }
}
function renderTableProduct() {
    $("#product_item tbody").empty();
    shoppingCart.subtotal = 0;
    shoppingCart.total_weight = 0;
    console.log(shoppingCart);
    $.each(shoppingCart.products, function (index, item) {
        var related_html = '<tr id="item_' + item.id + '">';
        related_html +=
            '<td><img src="' +
            item.thumbnail +
            '" style="max-height: 50px;" /></td>';
        related_html += "<td>" + item.product_title + "</td>";
        related_html += "<td>" + priceFormat(item.price) + "</td>";
        related_html +=
            '<td><input type="number" min="1" data-id="' +
            item.id +
            '" class="quantity" value="' +
            item.quantity +
            '" /></td>';
        related_html +=
            "<td>" +
            priceFormat(parseInt(item.price) * item.quantity) +
            "</td>";
        related_html +=
            '<td><a class="remove_group_item" data-id="' +
            item.id +
            '"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
        related_html += "</tr>";
        $("#product_item tbody").append(related_html);
        shoppingCart.subtotal += parseInt(item.price) * item.quantity;
        if (!isNaN(parseFloat(item.weight))) {
            shoppingCart.total_weight +=
                parseFloat(item.weight) * item.quantity;
        }
    });
}
function priceFormat(number) {
    if (parseInt(number) > 0) {
        return parseInt(number).format(0);
    }
    return "0đ";
}
Number.prototype.format = function (n, x) {
    var re = "(\\d)(?=(\\d{" + (x || 3) + "})+" + (n > 0 ? "\\." : "$") + ")";
    return (
        this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, "g"), "$1.") + "đ"
    );
};
$(document).ready(function () {
    $("#formCreateOrder").on("change", ".quantity", function () {
        if ($(this).val() < 1) {
            $(this).val(1);
        }
        $(this).val(parseInt($(this).val()));
        var product_id = $(this).data("id");
        var quantity = $(this).val();
        const updateCart = (quantity) => {
            let url = $(`meta[name="cart-update"]`).attr("content");
            $.ajax({
                type: "get",
                url: url,
                data: { qty: quantity, rowId: product_id },
                dataType: "json",
                success: function (response) {
                    console.log("update cart", response);
                    successNotice("Thông báo", "Cập nhật giỏ hàng thành công");
                },
            });
        };
        updateCart(quantity);
        $.each(shoppingCart.products, function (index, item) {
            if (item.id == product_id) {
                item.quantity = quantity;
                return false;
            }
        });
        handleProductQuantityBreak();
    });
    buildAddress($("#province"), $("#district"), $("#ward"));
    if (!$("#same-as-billing").prop("checked")) {
        $("#name").change(function () {
            $("#sname").val($("#name").val());
        });
        $("#email").change(function () {
            $("#semail").val($("#email").val());
        });
        $("#phone").change(function () {
            $("#sphone").val($("#phone").val());
        });
        $("#address").change(function () {
            $("#saddress").val($("#address").val());
        });
    }
    $("#formCreateOrder").on("submit", function () {
        shoppingCart.payment.status = 0;
        if ($("#paid").prop("checked")) {
            shoppingCart.payment.status = 1;
        }
        $.ajax({
            url: $(`meta[name="cart-order"]`).attr("content"),
            type: "POST",
            data: {
                shoppingCart: shoppingCart,
            },
        })
            .done(function (response) {
                console.log("order", response);
                successNotice("Thông báo", "Đặt đơn hàng thành công");
                setTimeout(() => {
                    if (response.redirect.length) {
                        location.href = response.redirect;
                    }
                }, 1500);
            })
            .fail(function (res) {
                console.log(res);
            });
        return false;
    });
    $("#btnApplyCoupon").on("click", function () {
        $("#coupon_msg").hide();
        var coupon = $("#txtCoupon").val().trim();
        $("#txtCoupon").val("");
        if (coupon) {
            var isExit = false;
            $.each(shoppingCart.coupons, function (index, item) {
                if (coupon == item.coupon) {
                    $("#coupon_msg")
                        .text("Đang sử dụng mã giảm giá này")
                        .show();
                    isExit = true;
                    return false;
                }
            });
            if (!isExit) {
                var product_ids = [];
                if (shoppingCart.products.length) {
                    $.each(shoppingCart.products, function (index, item) {
                        product_ids.push(item.id);
                    });
                }
                var order = {
                    product_ids: product_ids,
                    price: shoppingCart.subtotal,
                    shipping_fee: shoppingCart.shipping.fee,
                    is_freeship: 0,
                    applied_code: 0,
                    allow_more_coupon: true,
                };
                $.ajax({
                    url: base_domain + "/apply-coupon",
                    type: "GET",
                    data: {
                        code: coupon,
                        order: order,
                    },
                }).done(function (response) {
                    if (response.success) {
                        var html_coupon = "";
                        html_coupon +=
                            '<div id="' +
                            coupon +
                            '" class="coupon">' +
                            coupon +
                            '<i class="fa fa-times" aria-hidden="true"></i></div>';
                        $("td.coupon").append(html_coupon);
                        var coupon_value = response.coupon.value;
                        if (response.coupon.type == "free_shipping") {
                            shoppingCart.shipping.discount =
                                shoppingCart.shipping.fee;
                        }
                        if (response.coupon.type == "money_bill") {
                            shoppingCart.discount += response.coupon.value;
                        }
                        shoppingCart.coupons[coupon] = response.coupon;
                        renderTableCart();
                    } else {
                        $("#coupon_msg")
                            .text("Mã giảm giá không hợp lệ")
                            .show();
                    }
                });
            }
        }
        return false;
    });
    $(document).on("click", "td.coupon div.coupon", function () {
        var id = $(this).attr("id");
        $.each(shoppingCart.coupons, function (index, item) {
            if (id == index) {
                if (item.type == "free_shipping") {
                    shoppingCart.shipping.discount = 0;
                }
                if (item.type == "money_bill") {
                    shoppingCart.discount -= item.value;
                }
                delete shoppingCart.coupons[index];
                return false;
            }
        });
        $(this).remove();
        $("#coupon_msg").hide();
        renderTableCart();
    });
});
function buildAddress($wb_province, $wb_district, $wb_ward) {
    if ($wb_province.length > 0) {
        var province_id = $wb_province.data("id");
        var province_name = $wb_province.data("name");
        var province_value = $wb_province.data("value");
        if ($wb_district.length > 0) {
            $wb_province.change(function () {
                var district_id = $wb_district.data("id");
                var district_value = $wb_district.data("value");
                var district_name = $wb_district.data("name");
                $wb_district.find("option:not(:first)").remove();
                var province_id = $(this).find(":selected").data("id");
                if (province_id) {
                    var data = { province_id: province_id };
                    $.ajax({
                        type: "GET",
                        url: base_domain + "/api/province/distrist",
                        data: data,
                        success: function (response) {
                            $.each(response, function (index, value) {
                                var option = document.createElement("option");
                                option.text = value.name;
                                option.setAttribute("data-id", value.id);
                                if (district_value == "name") {
                                    option.value = value.name;
                                } else {
                                    option.value = value.id;
                                }
                                if (
                                    district_name == value.name ||
                                    district_id == value.id
                                ) {
                                    option.selected = true;
                                }
                                $wb_district.append(option);
                            });
                            if (district_id || district_name) {
                                $wb_district.trigger("change");
                            }
                        },
                    });
                }
            });
        }
        if ($wb_ward.length > 0) {
            $wb_district.change(function () {
                var ward_id = $wb_ward.data("id");
                var ward_value = $wb_ward.data("value");
                var ward_name = $wb_ward.data("name");
                $wb_ward.find("option:not(:first)").remove();
                var district_id = $(this).find(":selected").data("id");
                if (district_id) {
                    var data = { district_id: district_id };
                    $.ajax({
                        type: "GET",
                        url: base_domain + "/api/district/ward",
                        data: data,
                        success: function (response) {
                            $.each(response, function (index, value) {
                                var option = document.createElement("option");
                                option.text = value.name;
                                option.setAttribute("data-id", value.id);
                                if (ward_value == "name") {
                                    option.value = value.name;
                                } else {
                                    option.value = value.id;
                                }
                                if (
                                    ward_name == value.name ||
                                    ward_id == value.id
                                ) {
                                    option.selected = true;
                                }
                                $wb_ward.append(option);
                            });
                            if (ward_id || ward_name) {
                                $wb_ward.trigger("change");
                            }
                        },
                    });
                }
            });
        }
        $.ajax({
            type: "GET",
            url: $(`meta[name="cart-province"]`).attr("content"),
            success: function (response) {
                $.each(response, function (index, value) {
                    var option = document.createElement("option");
                    option.text = value.name;
                    option.setAttribute("data-id", value.id);
                    if (province_value == "name") {
                        option.value = value.name;
                    } else {
                        option.value = value.id;
                    }
                    if (
                        province_id == value.id ||
                        province_name == value.name
                    ) {
                        option.selected = true;
                    }
                    $wb_province.append(option);
                });
                if (province_id || province_name) {
                    $wb_province.trigger("change");
                }
            },
        });
    }
}
