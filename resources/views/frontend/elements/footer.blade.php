@php
    use App\Helpers\Obn;
    $social = Obn::getSetting('social');
    $social = json_decode($social, true);
@endphp
<div id="k-footer">
    <div class="box container clearfix">
        <div class="hotline">
            <h4 class="text-transform title">Kết nối với RPA</h4>
            <ul class="bottom">
                <li>
                    <first><i class="fas fa-phone-alt"></i> Hotline</first>
                    <second>{{ Obn::getSetting('phone') }}</second>
                </li>
                <li>
                    <first><i class="fas fa-envelope"></i> Email</first>
                    <second>{{ Obn::getSetting('email') }}</second>
                </li>
            </ul>
            <!--end .bottom-->
            <div class="social">
                <a href="{{$social['facebook'] ?? ""}}" target="_blank">
                    <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/fb_icon_footer.png"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                        alt="facebook" width="44" height="44">
                </a>
                <a href="{{$social['youtube'] ?? ""}}" target="_blank" style="margin:0 5px">
                    <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/youtube_icon_footer.png"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                        alt="youtube" width="44" height="44">
                </a>
                <!--<a href="https://zalo.me/1985686830006307471" target="_blank">
    <img class="img-lazy" data-src="/img/zalo_icon_footer.png"
         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
         alt="zalo" width="44" height="44">
  </a>-->
            </div>
            <!--end .social-->
        </div>
        <!--end .hotline -->
        <div class="info">
            <h4 class="title">Chính sách</h4>
            <ul>
                <li><a href="{{ route('fe_post/detail',['slug' => 'chinh-sach-bao-mat-thong-tin']) }}">Chính sách bảo mật thông tin</a></li>
                <li><a href="{{ route('fe_post/detail',['slug' => 'chinh-sach-doi-tra-hang-va-hoan-tien']) }}">Chính sách đổi trả hàng và hoàn tiền</a></li>
                <li><a href="{{ route('fe_post/detail',['slug' => 'chinh-sach-kiem-hang']) }}">Chính sách kiểm hàng</a></li>
                <li><a href="{{ route('fe_post/detail',['slug' => 'hinh-thuc-thanh-toan']) }}">Hình thức thanh toán</a>
                </li>
                
            </ul>
            <!--end .top-->
        </div>
        <!--end .info-->
        <div class="about ">
            <h4 class="text-transform title">Về RPA</h4>
            <ul>
                <li><a href="{{ route('fe_teacher/detail',['slug' => 'dam-thu-chung']) }}" class="hover-color-green">Về giảng viên</a></li>
                <li><a href="{{ route('home/index') }}" class="hover-color-green">Đào tạo doanh nghiệp</a></li>
            </ul>
           {{-- <a target="_blank" href="http://online.gov.vn/Home/WebDetails/102636"> <img src="{{asset('kyna/img/logoSaleNoti.png')}}" alt="" width="150"></a> --}}
            <!--end .top-->
        </div>
        <!--end .about-->
        <div class="app-col" style="opacity: 0;pointer-events: none">
            <h4 class="bold title">TẢI ỨNG DỤNG MOBILE</h4>
            <div class="icon-app">
                <a href="https://play.google.com/store/apps/details?id=com.navikyna" target="_blank" title="Android">
                    <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/playstore_icon.png"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                        alt="android-app-icon">
                </a>
                <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/QR-code.png"
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                    alt="qr-code">
            </div>
        </div>
        <div class="fanpage ">
            <div class="face-content">
                <iframe
                    src="//www.facebook.com/plugins/likebox.php?href={{$social['facebook'] ?? ""}}&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=350&amp;width=255"
                    scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:220px;"
                    allowTransparency="false"></iframe>
            </div>
        </div>
        <!--end .fanpage-->
    </div>
    <!--end .container-->
</div>
<!--    Copyright   -->
<div id="k-footer-copyright">
    <div class="container">
        <!-- Start Anchor Text -->
        <!-- End Anchor Text -->
        <div class="col-lg-8 col-xs-12 address ">
            <div class="text">
                <p class="text-copyright">© 2023 - Bản quyền thuộc về CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO RPA
                </p>
            
                <p>
                    {!! Obn::getSetting('address') !!}
                    {{-- {!! Obn::getSetting('office') !!} --}}
                </p>

            </div>
            <!--end col-xs-8 text-->
        </div>
        <!--end .col-sm-7 col-xs-12 left-->
        <!--end .col-sm-5 col-xs-12 right-->
    </div>
    <!--end .container-->
</div>
<!--end #wrap-copyright-->
<div id="k-footer-mb">
    <ul class="k-footer-mb-contact">
        <li>
            <a href="tel:{{ Obn::getSetting('phone') }}" target="_blank"><i class="fas fa-phone-alt"></i>{{ Obn::getSetting('phone') }}</a>
        </li>
        <li>
            <a href="{{ Obn::getSetting('email') }}" target="_blank"><i class="fas fa-envelope"></i></i>
                {{ Obn::getSetting('email') ?? "" }}</a>
        </li>
    </ul>
    <div class="link">

        <a href="{{ route('home/index') }}" class="link-text" target="_blank" title="">CÂU HỎI
            THƯỜNG GẶP</a>
        <a href="{{ route('home/index') }}" target="_blank" class="link-text" title="">THÔNG TIN HỮU ÍCH</a>

    </div>
    <div class="social">
        <a href="{{$social['facebook'] ?? ""}}" target="_blank">
            <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/fb_icon_footer.png"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                alt="facebook">
        </a>
        <a href="{{$social['youtube'] ?? ""}}" target="_blank" style="margin:0 5px">
            <img class="img-lazy" data-src="https://cdn-skill.kynaenglish.vn/img/youtube_icon_footer.png"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                alt="youtube">
        </a>
    </div>
    <p class="copyright">© 2022 - Bản quyền của <br> CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO RPA</p>

</div>
<!--end #k-footer-mb-->
