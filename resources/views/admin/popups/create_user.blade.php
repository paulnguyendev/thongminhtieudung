<style>
    #createUser .alert-danger {
        display: none;
    }
</style>
<div id="createUser" class="modal fade in">
    <form method="POST" action="{{route('admin_order/createUser')}}" accept-charset="UTF-8" id="buyer-form"
        enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title">Thông tin tài khoản</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Họ Tên
                        </label>
                        <input class="form-control" name="name" type="text"
                            value="{{ $infoOrder['fullname'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Điện thoại
                        </label>
                        <input class="form-control" name="phone" type="text"
                            value="{{ $infoOrder['phone'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Email
                        </label>
                        <input class="form-control" name="email" type="text"
                            value="{{ $infoOrder['email'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Tài khoản đăng nhập
                        </label>
                        <input class="form-control" name="username" type="text" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu
                        </label>
                        <input class="form-control" name="password" type="password" value="">
                        <span class="help-block"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
                    <button type="submit" id="btnCreateUser" data-url="{{route('admin_order/createUser')}}" class="btn btn-info btn-ladda btn-ladda-spinner"><span class="ladda-label">Lưu</span></button>
                </div>
            </div>
        </div>
        <input type="hidden" name="is_exist" value="{{$checkUser['is_exist'] ?? 0}}">
        <input type="hidden" name="is_affiliate" value="{{$checkUser['is_affiliate'] ?? 0}}">
        <input type="hidden" name="has_id" value="{{$checkUser['has_id'] ?? 0}}">
        <input type="hidden" name="parent_id" value="{{$checkUser['parent_id'] ?? ""}}">
    </form>
</div>
