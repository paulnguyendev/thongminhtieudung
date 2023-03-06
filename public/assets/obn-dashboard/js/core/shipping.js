class Shipping {
    constructor (method = 'custom') {
        this.method = method;
        this.$orderDetailPanel = $('#orderDetailPanel');
        this.$shippingMethodForm = $('#' + method);
        this._order = {
            id: this.$orderDetailPanel.data('id'),
            code: this.$orderDetailPanel.data('code'),
            amount: this.$shippingMethodForm.find('.amount').val() || 0,
            pick_money: this.$shippingMethodForm.find('.pick_money').val() || 0,
            length: this.$shippingMethodForm.find('.length').val() || 0,
            width: this.$shippingMethodForm.find('.width').val() || 0,
            height: this.$shippingMethodForm.find('.height').val() || 0,
            weight: this.$shippingMethodForm.find('.weight').val() || 0,
            adminNote: this.$shippingMethodForm.find('.order-note').val() || '',
            methodNote: this.$shippingMethodForm.find('.method-note').val() || '',
            transportMethodId: this.$shippingMethodForm.find('.transport-method-id').find(':selected').val() || null,
            courierId: this.$shippingMethodForm.find('.transport-method-id').find(':selected').data('courierid') || null,
            sendMailFlag: this.$shippingMethodForm.find('.checkbox-send-mail').val() || 0,
            productName: this.joinProductsName(),
            cod: this.$shippingMethodForm.find('.amount').val() > 0 ? 1 : 0,
            is_freeship: this.$shippingMethodForm.find('.is_freeship').find(':selected').val() > 0 ? 1 : 0,
            sender: {
                name: this.$shippingMethodForm.find('.shop_address').find(':selected').data('sender-name') || '',
                phone: this.$shippingMethodForm.find('.shop_address').find(':selected').data('sender-phone') || '',
                email: this.$shippingMethodForm.find('.shop_address').find(':selected').data('sender-email') || '',
                addressId: null,
                wardId: null,
                wardName: this.$shippingMethodForm.find('.shop_address').find(':selected').data('ward-name') || '',
                provinceId: null,
                provinceName: this.$shippingMethodForm.find('.shop_address').find(':selected').data('province-name') || '',
                districtId: null,
                districtName: this.$shippingMethodForm.find('.shop_address').find(':selected').data('district-name') || '',
                address: this.$shippingMethodForm.find('.shop_address').find(':selected').data('address') || ''
            },
            receiver: {
                name: this.$orderDetailPanel.data('receiver-name') || '',
                phone: this.$orderDetailPanel.data('receiver-phone') || '',
                email: this.$orderDetailPanel.data('receiver-email') || '',
                addressId: null,
                provinceId: null,
                provinceName: this.$orderDetailPanel.data('province-name') || '',
                districtId: null,
                districtName: this.$orderDetailPanel.data('district-name') || '',
                wardId: null,
                wardName: this.$orderDetailPanel.data('ward-name') || '',
                address: this.$orderDetailPanel.data('address')
            },
            store: {
                groupAddressId: null,
                provinceId: null,
                districtId: null,
                wardId: null,
            },
            tracking_code: '',
            order_note: '',
            partner_shipping_fee: 0,
        };
        this.delayTimeOnChange = 500;
        this.eventObserver = null;
        this.handleStartDelivery();
        this.handleCancelDelivery();
        this.handleAmountChange();
        this.handleReceiverAddressChange();
        this.handleStoreAddressChange();
        this.handleReceiverWardChange();
        this.handleReceiverDistrictChange();
        this.handleReceiverProvinceChange();
        this.handleSendMailChange();
        this.handleOrderNoteChange();
    }
    set order (data = {}) {
        Object.assign(this._order, data);
    }
    get order () {
        return this._order;
    }
    set sender (data) {
        Object.assign(this.order.sender, data);
    }
    get sender () {
        return this.order.sender;
    }
    set store (data) {
        Object.assign(this.order.store, data);
    }
    get store () {
        return this.order.store;
    }
    set receiver (data) {
        Object.assign(this.order.receiver, data);
    }
    get receiver () {
        return this.order.receiver;
    }
    set amount (amount = 0) {
        this.order.amount = amount;
    }
    get amount () {
        return this.order.amount;
    }
    set length (length) {
        this.order.length = length;
    }
    get length () {
        return this.order.length;
    }
    set width (width) {
        this.order.width = width;
    }
    get width () {
        return this.order.width;
    }
    set height (height) {
        this.order.height = height;
    }
    get height () {
        return this.order.height;
    }
    set weight (weight) {
        this.order.weight = weight;
    }
    get weight () {
        return this.order.weight;
    }
    joinProductsName () {
        let nameArray = [];
        this.$orderDetailPanel.find('.order-product-name').each(function (index, el) {
            // xóa khoảng trắng, xóa html tags
            let quantity = $(el).data('quantity');
            let name = $(el).html().trim().replace(/\s\s+/g, ' ').replace(/<\/?[^>]+(>|$)/g, '');
            nameArray.push(`${name} , Số lượng: ${quantity}`);
        });
        return nameArray.join(' | ');
    }
    getProvinces () {
        infoNotice('Thông báo', 'Đang lấy thông tin...');
        let _this = this;
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: base_domain+'/admin/ship/provinces',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method
                },
                success: function (data, textStatus, xhr) {
                    resolve(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    reject(new Error('lỗi'));
                }
            });
        });
    }
    getDistricts (districtOf) {
        let _this = this;
        let provinceId;
        if (districtOf === 'sender') {
            provinceId = _this.order.sender.provinceId;
        } else if (districtOf === 'receiver') {
            provinceId = _this.order.receiver.provinceId;
        } else {
            return [];
        }
        if (provinceId === null) {
            return [];
        }
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: base_domain+'/admin/ship/provinces/' + provinceId + '/districts',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method,
                    district_of: districtOf
                },
                success: function (data, textStatus, xhr) {
                    resolve(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    reject(new Error('lỗi'));
                }
            });
        });
    }
    getWards (wardOf) {
        let _this = this;
        let districtId;
        if (wardOf === 'sender') {
            districtId = _this.order.sender.districtId;
        } else if (wardOf === 'receiver') {
            districtId = _this.order.receiver.districtId;
        } else if (wardOf === 'ghn') {
            districtId = _this.order.receiver.districtId;
        } else if (wardOf === 'vtp') {
            districtId = _this.order.receiver.districtId;
        }else if (wardOf === 'ghtk') {
            districtId = _this.order.receiver.districtId;
        }
        else {
            return [];
        }
        if (districtId === null) {
            return [];
        }
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: base_domain+'/admin/ship/districts/' + districtId + '/wards',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method,
                    ward_of: wardOf
                },
                success: function (data, textStatus, xhr) {
                    resolve(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    reject(new Error('lỗi'));
                }
            });
        });
    }
    compareLocationName (location1, location2) {
        let firstName = location1.toLowerCase();
        let secondName = location2.toLowerCase();
        const replaceString = ['thành phố', 'quận', 'huyện', 'thị xã'];
        replaceString.forEach(function (string) {
            firstName = firstName.replace(string, '');
            secondName = secondName.replace(string, '');
        });
        if (firstName === secondName) {
            return true;
        }
        return false;
    }
    mapProvinceDataToSenderAddress (provinces = []) {
        let _this = this;
        let senderProvinceName = _this.order.sender.provinceName;
        let provinceMatch = false;
        $.each(provinces, function (index, province) {
            if (senderProvinceName === province.name) {
                _this.order.sender.provinceId = province.id;
                if(_this.method == 'giaohangnhanh') {
                    _this.order.sender.provinceGHNId = province.ghn_code;
                }
                if(_this.method == 'viettelpost') {
                    _this.order.sender.provinceVTPId = province.vtp_code;
                }
                provinceMatch = true;
            }
        });
        return provinceMatch;
    }
    mapProvinceDataToReceiverAddress (provinces = []) {
        let _this = this;
        let receiverProvinceName = _this.order.receiver.provinceName;
        let provinceMatch = false;
        $.each(provinces, function (index, province) {
            if (provinces.length === 1) {
                _this.order.receiver.provinceId = province.id;
            }
            if (receiverProvinceName === province.name) {
                _this.order.receiver.provinceId = province.id;
                if(_this.method == 'giaohangnhanh') {
                    _this.order.receiver.provinceGHNId = province.ghn_code;
                }
                if(_this.method == 'viettelpost') {
                    _this.order.receiver.provinceVTPId = province.vtp_code;
                }
                provinceMatch = true;
            }
        });
        return provinceMatch;
    }
    mapDistrictDataToSenderAddress (districts = []) {
        let _this = this;
        let senderDistrictName = _this.order.sender.districtName;
        let districtMatch = false;
        $.each(districts, function (index, district) {
            if (_this.compareLocationName(senderDistrictName, district.name) === true) {
                _this.order.sender.districtId = district.id;
                if(_this.method == 'giaohangnhanh') {
                    _this.order.sender.districtId = district.ghn_code;
                }
                if(_this.method == 'viettelpost') {
                    _this.order.sender.districtId = district.vtp_code;
                }
                districtMatch = true;
            }
        });
        return districtMatch;
    }
    mapDistrictDataToReceiverAddress (districts) {
        let _this = this;
        let receiverDistrictName = _this.order.receiver.districtName;
        let districtMatch = false;
        $.each(districts, function (index, district) {
            if (districts.length === 1) {
                _this.order.receiver.districtId = district.id;
            }
            if (_this.compareLocationName(receiverDistrictName, district.name)) {
                _this.order.receiver.districtId = district.id;
                if(_this.method == 'giaohangnhanh') {
                    _this.order.receiver.districtId = district.ghn_code;
                }
                if(_this.method == 'viettelpost') {
                    _this.order.receiver.districtId = district.vtp_code;
                }
                districtMatch = true;
            }
        });
        return districtMatch;
    }
    mapWardDataToReceiverAddress (wards) {
        let _this = this;
        let receiverWardName = _this.order.receiver.wardName;
        let wardMatch = false;
        $.each(wards, function (index, ward) {
            if (wards.length === 1) {
                _this.order.receiver.wardId = ward.id;
            }
            if (_this.compareLocationName(receiverWardName, ward.name)) {
                _this.order.receiver.wardId = ward.id;
                wardMatch = true;
            }
        });
        return wardMatch;
    }
    createReceiverProvinceSelectBox (provinces = []) {
        let options = [];
        let receiverProvinceName = this.order.receiver.provinceName;
        let option = document.createElement('option');
        option.text = '-- Vui lòng chọn --';
        option.value = 'null';
        options.push(option);
        $.each(provinces, function (index, province) {
            let option = document.createElement('option');
            option.text = province.name;
            option.value = province.id;
            if(province.ghn_code) {
                option.setAttribute('data-ghn-id', province.ghn_code);
            }
            if(province.vtp_code) {
                option.setAttribute('data-vtp-id', province.vtp_code);
            }
            if (receiverProvinceName === province.name) {
                option.selected = true;
            }
            options.push(option);
        });
        this.$shippingMethodForm.find('.receiver-province-id').empty().append(options);
    }
    createReceiverDistrictSelectBox (districts = []) {
        let options = [];
        let receiverDistrictName = this.order.receiver.districtName;
        let option = document.createElement('option');
        option.text = '-- Vui lòng chọn --';
        option.value = 'null';
        options.push(option);
        $.each(districts, function (index, district) {
            let option = document.createElement('option');
            option.text = district.name;
            option.value = district.id;
            if(district.ghn_code) {
                option.setAttribute('data-ghn-id', district.ghn_code);
            }
            if(district.vtp_code) {
                option.setAttribute('data-vtp-id', district.vtp_code);
            }
            if (receiverDistrictName === district.name) {
                option.selected = true;
            }
            options.push(option);
        });
        this.$shippingMethodForm.find('.receiver-district-id').empty().append(options);
    }
    createReceiverWardSelectBox (wards = []) {
        let options = [];
        let receiverWardName = this.order.receiver.wardName;
        $.each(wards, function (index, ward) {
            let option = document.createElement('option');
            option.text = ward.name;
            option.value = ward.id;
            if (receiverWardName === ward.name) {
                option.selected = true;
            }
            options.push(option);
        });
        this.$shippingMethodForm.find('.receiver-ward-id').empty().append(options);
    }
    findAvailableTransportMethod () {
        let _this = this;
        if(_this.method == 'giaohangnhanh') {
            _this.order.sender.provinceId = _this.order.sender.provinceGHNId;
            _this.order.receiver.provinceId = _this.order.receiver.provinceGHNId;
        }
        if(_this.method == 'viettelpost') {
            _this.order.sender.provinceId = _this.order.sender.provinceVTPId;
            _this.order.receiver.provinceId = _this.order.receiver.provinceVTPId;
        }
        if(!_this.order.sender.provinceId) {
            return [];
        }
        if(!_this.order.sender.districtId) {
            return [];
        }
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: base_domain+'/admin/ship/find-available-transport-method',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method,
                    order: _this.order
                },
                success: function (response, textStatus, xhr) {
                    if (!response.success) {
                        errorNotice('Lỗi', response.message, {timeOut: 3000});
                    }
                    resolve(response.data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    reject(new Error('lỗi'));
                }
            });
        });
    }
    createTransportMethodsSelectBox (methods) {
        let _this = this;
        let options = [];
        $.each(methods, function (index, method) {
            let option = document.createElement('option');
            option.text = `${method.name} - ${currencyFormat(method.fee)} VND`;
            option.value = method.id;
            if (method.courier_id) {
                option.setAttribute('data-courierid', method.courier_id);
            }
            if (index === 0) {
                _this.order.transportMethodId = method.id;
                $(option).attr('selected', 'selected');
                if (method.courier_id) {
                    _this.order.courierId = method.courier_id;
                }
            }
            options.push(option);
        });
        this.$shippingMethodForm.find('.transport-method-id').empty().append(options);
        if (options.length > 0) {
            this.$shippingMethodForm.find('.btn-create-shipping-order').removeAttr('disabled');
        }
        this.handleTransportMethodChange();
    }
    clearReceiverDistrictSelectBox () {
        this.$shippingMethodForm.find('.btn-create-shipping-order').attr('disabled', 'disabled');
        this.$shippingMethodForm.find('.receiver-district-id').empty();
    }
    clearTransportMethodsSelectBox () {
        this.$shippingMethodForm.find('.btn-create-shipping-order').attr('disabled', 'disabled');
        this.$shippingMethodForm.find('.transport-method-id').empty();
    }
    handleTransportMethodChange () {
        let _this = this;
        _this.$shippingMethodForm.find('.transport-method-id').length && _this.$shippingMethodForm.off('change', '.transport-method-id').on('change', '.transport-method-id', function () {
            let $option = $(this).find(':selected');
            if ($option.data('courierid')) {
                _this.order.courierId = $option.data('courierid');
            }
            _this.order.transportMethodId = $option.val();
        });
    }
    handleStoreAddressChange () {
        let _this = this;
        _this.$shippingMethodForm && _this.$shippingMethodForm.off('change', '.shop_address').on('change', '.shop_address', function () {
            let $option = $(this).find(':selected');
            _this.order.sender.provinceName = $option.data('province-name');
            _this.order.sender.districtName = $option.data('district-name');
            _this.order.sender.wardName = $option.data('ward-name');
            _this.order.sender.districtId = null;
            _this.order.sender.provinceId = null;
            _this.order.sender.wardId = null;
            _this.clearTransportMethodsSelectBox();
            _this.getProvinces()
                .then((provinces) => {
                    _this.mapProvinceDataToSenderAddress(provinces);
                    return _this.getDistricts('sender');
                })
                .then((districts) => {
                    _this.mapDistrictDataToSenderAddress(districts);
                    return _this.findAvailableTransportMethod();
                })
                .then((transportMethods) => {
                    _this.createTransportMethodsSelectBox(transportMethods);
                });
        });
    }
    handleReceiverProvinceChange () {
        let _this = this;
        _this.$shippingMethodForm && _this.$shippingMethodForm.off('change', '.receiver-province-id').on('change', '.receiver-province-id', function () {
            let $option = $(this).find(':selected');
            _this.order.receiver.provinceName = $option.html();
            _this.order.receiver.provinceId = $option.val();
            if(_this.method == 'giaohangnhanh') {
                _this.order.receiver.provinceGHNId = $option.data('ghn-id');
            }
            if(_this.method == 'viettelpost') {
                _this.order.receiver.provinceVTPId = $option.data('vtp-id');
            }
            if(_this.method == 'giaohangtietkiem') {
                _this.order.receiver.provinceGHTKId = $option.attr('value');
            }
            _this.order.receiver.districtId = null;
            _this.clearReceiverDistrictSelectBox();
            _this.clearTransportMethodsSelectBox();
            _this.getDistricts('receiver')
                .then((districts) => {
                    _this.mapDistrictDataToReceiverAddress(districts);
                    _this.createReceiverDistrictSelectBox(districts);
                    if(_this.method == 'giaohangnhanh') {
                        return _this.getWards('ghn');
                    }
                    if(_this.method == 'viettelpost') {
                        return _this.getWards('vtp');
                    }
                    if(_this.method == 'giaohangtietkiem') {
                        return _this.getWards('ghtk');
                    }
                    return [];
                })
                .then((wards) => {
                    _this.mapWardDataToReceiverAddress(wards);
                    _this.createReceiverWardSelectBox(wards);
                    return _this.findAvailableTransportMethod();
                })
                .then((transportMethods) => {
                    _this.createTransportMethodsSelectBox(transportMethods);
                });
        });
    }
    handleReceiverDistrictChange () {
        let _this = this;
        _this.$shippingMethodForm && _this.$shippingMethodForm.off('change', '.receiver-district-id').on('change', '.receiver-district-id', function () {
            let $option = $(this).find(':selected');
            _this.order.receiver.districtName = $option.html();
            _this.order.receiver.districtId = $option.val();
            if(_this.method == 'giaohangnhanh') {
                _this.order.receiver.districtId = $option.data('ghn-id');
            }
            if(_this.method == 'viettelpost') {
                _this.order.receiver.districtId = $option.data('vtp-id');
            }
            if(_this.method == 'giaohangtietkiem') {
                _this.order.receiver.districtId = $option.attr('value');
            }
            _this.clearTransportMethodsSelectBox();
            _this.findAvailableTransportMethod()
                .then((methods) => {
                    _this.createTransportMethodsSelectBox(methods);
                });
            if(_this.method == 'giaohangnhanh') {
                _this.getWards('ghn')
                .then((wards) => {
                    _this.mapWardDataToReceiverAddress(wards);
                    _this.createReceiverWardSelectBox(wards);
                });
            }
            if(_this.method == 'viettelpost') {
                _this.getWards('vtp')
                .then((wards) => {
                    _this.mapWardDataToReceiverAddress(wards);
                    _this.createReceiverWardSelectBox(wards);
                });
            }
            if(_this.method == 'giaohangtietkiem') {
                _this.getWards('ghtk')
                .then((wards) => {
                    _this.mapWardDataToReceiverAddress(wards);
                    _this.createReceiverWardSelectBox(wards);
                });
            }
        });
    }
    handleReceiverWardChange () {
        let _this = this;
        _this.$shippingMethodForm && _this.$shippingMethodForm.off('change', '.receiver-ward-id').on('change', '.receiver-ward-id', function () {
            let $option = $(this).find(':selected');
            _this.order.receiver.wardId = $option.val();
            _this.order.receiver.wardName = $option.html();
        });
    }
    handleStartDelivery () {
        let _this = this;
        _this.$shippingMethodForm.on('click', '.btn-create-shipping-order', function () {
            if(_this.method == 'giaohangnhanh') {
                _this.order.receiver.wardId = _this.$shippingMethodForm.find('.receiver-ward-id').val();
            }
            if(_this.method == 'viettelpost') {
                _this.order.receiver.wardId = _this.$shippingMethodForm.find('.receiver-ward-id').val();
                let groupAddressId = $('#store_address').val();
                let provinceId = $('#store_province_id').val();
                let districtId = $('#store_district_id').val();
                let wardId = $('#store_ward_id').val();
                _this.order.store.groupAddressId = groupAddressId;
                _this.order.store.provinceId = provinceId;
                _this.order.store.districtId = districtId;
                _this.order.store.wardId = wardId;
            }
            if(_this.method == 'giaohangtietkiem') {
                _this.order.receiver.wardId = _this.$shippingMethodForm.find('.receiver-ward-id').val();
            }
            $(this).prop('disabled', true);
            $(this).parents('form').submit();
        });
        _this.$shippingMethodForm && _this.$shippingMethodForm.on('submit', '.delivery-form', function (event) {
            event.preventDefault();
            _this.order.code = _this.$shippingMethodForm.find('input[name=order_code]').val();
            if(_this.method == 'etop') {
                _this.order.tracking_code = _this.$shippingMethodForm.find('input[name=tracking_code]').val();
                _this.order.order_note = _this.$shippingMethodForm.find('input[name=order_note]').val();
                _this.order.partner_shipping_fee = _this.$shippingMethodForm.find('input[name=partner_shipping_fee]').val();
            }
            _this.order.is_freeship = _this.$shippingMethodForm.find('.is_freeship').find(':selected').val();
            infoNotice('Thông báo!', 'Đơn hàng đang được gửi đi!');
            _this.startDelivery();
            return false;
        });
    }
    startDelivery () {
        let _this = this;
        return new Promise((resolve, reject) => {
            $('.btn-create-shipping-order').addClass('disabled').html('Đang xử lý').prop('disabled', true);
            jQuery.ajax({
                url: base_domain+'/admin/ship/start-delivery',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method,
                    order: _this.order
                },
                success: function (response, textStatus, xhr) {
                    $('.btn-create-shipping-order').removeClass('disabled').prop('disabled', false).html('Gởi');
                    if (!response.success) {
                        errorNotice('Có lỗi xảy ra', response.message, {timeOut: 3000});
                        console.log(response);
                    } else {
                        successNotice('Thành công!', 'Đơn hàng đã được gửi đi!');
                        location.reload();
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $('.btn-create-shipping-order').removeClass('disabled').prop('disabled', false).html('Gởi');
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                    reject(new Error('Có lỗi xảy ra'));
                }
            });
        });
    }
    handleCancelDelivery () {
        let _this = this;
        const $btnCancelShipping = $('#btnCancelShipping');
        $btnCancelShipping && $btnCancelShipping.off('click').on('click', function (event) {
            event.preventDefault();
            infoNotice('Thông báo!', 'Đang hủy đơn hàng!');
            _this.cancelDelivery();
        });
    }
    cancelDelivery () {
        let _this = this;
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: base_domain+'/admin/ship/cancel-delivery',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: _token,
                    method: _this.method,
                    orderId: _this.order.id
                },
                success: function (response, textStatus, xhr) {
                    if (!response.success) {
                        errorNotice('Có lỗi xảy ra', response.message, {timeOut: 3000});
                        console.log(response);
                    } else {
                        successNotice('Thành công!', response.message);
                        location.reload();
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                    reject(new Error('Có lỗi xảy ra'));
                }
            });
        });
    }
    handleReceiverAddressChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('change', '.receiver-address').on('change', '.receiver-address', function (event) {
            _this.order.receiver.address = $(this).val();
        });
    }
    handleOrderWeightChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('keyup', '.weight').on('keyup', '.weight', function (event) {
            let $weightInput = $(this);
            _this.eventObserver && clearTimeout(_this.eventObserver);
            _this.eventObserver = setTimeout(function () {
                _this.order.weight = $weightInput.val();
                _this.clearTransportMethodsSelectBox();
                _this.findAvailableTransportMethod()
                    .then((methods) => {
                        _this.createTransportMethodsSelectBox(methods);
                        _this.eventObserver = null;
                    });
            }, _this.delayTimeOnChange);
        });
    }
    handleOrderLengthChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('change', '.length').on('keyup', '.length', function (event) {
            let $lengthInput = $(this);
            _this.eventObserver && clearTimeout(_this.eventObserver);
            _this.eventObserver = setTimeout(function () {
                _this.order.length = $lengthInput.val();
                _this.clearTransportMethodsSelectBox();
                _this.findAvailableTransportMethod()
                    .then((methods) => {
                        _this.createTransportMethodsSelectBox(methods);
                        _this.eventObserver = null;
                    });
            }, _this.delayTimeOnChange);
        });
    }
    handleOrderWidthChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('keyup', '.width').on('keyup', '.width', function (event) {
            let $widthInput = $(this);
            _this.eventObserver && clearTimeout(_this.eventObserver);
            _this.eventObserver = setTimeout(function () {
                _this.order.width = $widthInput.val();
                _this.clearTransportMethodsSelectBox();
                _this.findAvailableTransportMethod()
                    .then((methods) => {
                        _this.createTransportMethodsSelectBox(methods);
                        _this.eventObserver = null;
                    });
            }, _this.delayTimeOnChange);
        });
    }
    handleOrderHeightChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('keyup', '.height').on('keyup', '.height', function (event) {
            let $weightInput = $(this);
            _this.eventObserver && clearTimeout(_this.eventObserver);
            _this.eventObserver = setTimeout(function () {
                _this.order.height = $weightInput.val();
                _this.clearTransportMethodsSelectBox();
                _this.findAvailableTransportMethod()
                    .then((methods) => {
                        _this.createTransportMethodsSelectBox(methods);
                        _this.eventObserver = null;
                    });
            }, _this.delayTimeOnChange);
        });
    }
    handleSendMailChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('change', '.checkbox-send-mail').on('change', '.checkbox-send-mail', function (event) {
            _this.order.sendMailFlag = $(this).is(':checked') ? 1 : 0;
        });
    }
    handleAmountChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('keyup', '.amount').on('keyup', '.amount', function (event) {
            let $amountInput = $(this);
            // sau khoảng thời gian delayTimeOnChange thì mới gửi ajax
            _this.eventObserver && clearTimeout(_this.eventObserver);
            _this.eventObserver = setTimeout(function () {
                let amount = $amountInput.val();
                _this.order.amount = amount;
                if (amount > 0) {
                    _this.order.cod = 1;
                }
                _this.clearTransportMethodsSelectBox();
                _this.findAvailableTransportMethod()
                    .then((methods) => {
                        _this.createTransportMethodsSelectBox(methods);
                        // release observer after complete
                        _this.eventObserver = null;
                    });
            }, _this.delayTimeOnChange);
        });
    }
    handleOrderNoteChange () {
        let _this = this;
        this.$shippingMethodForm && this.$shippingMethodForm.off('keyup paste', '.order-note').on('keyup paste', '.order-note', function (event) {
            let $noteInput = $(this);
            _this.order.adminNote = $noteInput.val();
        });
    }
}
let checkOrderQuantity = function (id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'GET',
            url: base_domain+'/admin/order/check-quantity/' + id,
            data: {
                _token: _token
            },
            dataType: 'json',
            success: function (response) {
                resolve(response);
            },
            error: function () {
                reject(new Error('Không thể kiểm tra số lượng sản phẩm trong đơn hàng, vui lòng kiểm tra đường truyền mạng và thử lại'));
            }
        });
    });
}
const CONFIRM_ORDER_STATUS = 2;
jQuery(document).ready(function ($) {
    const $orderDetailPanel = $('#orderDetailPanel');
    const orderUpdateRoute = $orderDetailPanel.data('route-update');
    const orderId = $orderDetailPanel.data('id');
    $('#cancel_order').click(function () {
        swal({
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            title: 'Bạn có chắc thực hiện thao tác hủy không?',
            type: 'input',
            inputPlaceholder: 'Lý do',
            showCancelButton: true,
            confirmButtonColor: '#FF7043',
            cancelButtonText: 'Không',
            confirmButtonText: 'Có'
        }, function (reason) {
            if (reason === false) {
                swal.close(); 
                return false;
            }
            updateOrder(orderId, {
                admin_note: reason,
                status: 'cancel'
            });
            swal.close();
        });
    });
    $('.payment_status').change(function (e) {
        let paymentStatus = $(this).is(':checked') ? 1 : 0;
        updateOrder(orderId, {
            payment_status: paymentStatus
        });
    });
    $('.order_status').change(function (e) {
        let status = $(this).val();
        if (status == CONFIRM_ORDER_STATUS) {
            return updateOrder(orderId, {
                status: status,
                force_update: 0
            });
        }
        return updateOrder(orderId, {
            status: status,
            force_update: 1
        });
    });
    let updateOrder = (id, data) => {
        const token = {
            _token: _token
        };
        let submitData = Object.assign({
            type: 'update-status',
        }, token, data);
        jQuery.ajax({
            url: orderUpdateRoute,
            type: 'POST',
            dataType: 'json',
            data: submitData,
            success: function (response, textStatus, xhr) {
                if (response.success) {
                    successNotice('Thông báo', response.message);
                    window.location.reload();
                    swal.close();
                } else {
                    if (response.need_confirmation) {
                        swal({
                            showLoaderOnConfirm: true,
                            closeOnConfirm: false,
                            title: response.title,
                            text: response.message,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#FF7043',
                            cancelButtonText: 'Không',
                            confirmButtonText: 'Có'
                        }, function () {
                            data.force_update = 1;
                            return updateOrder(id, data);
                        });
                    } else {
                        errorNotice('Thông báo', response.message);
                        swal.close();
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                errorNotice('Thông báo', 'Cập nhật thất bại, vui lòng kiểm tra đường truyền mạng và thử lại');
            }
        });
    };
    $(document).on('change', 'select[id=service_shipping]', function () {
        let currentShippingMethod = $(this).val();
        $('.shipping_service').hide();
        $('#' + currentShippingMethod).show();
        if (currentShippingMethod !== 'custom') {
            $('#' + currentShippingMethod).find('.btn-create-shipping-order').attr('disabled', 'disabled');
        }else{
            new Shipping(currentShippingMethod);
        }
    });
    const $btnCancelShipping = $('#btnCancelShipping');
    if ($btnCancelShipping.length) {
        const currentShippingMethod = $btnCancelShipping.data('method');
        const service = new Shipping(currentShippingMethod);
    }
});
