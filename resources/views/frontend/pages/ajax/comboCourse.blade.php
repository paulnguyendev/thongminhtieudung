@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
<style>
    .k-box-card-list .k-box-card .k-box-card-wrap .content {
        border-bottom: none;
    }

    .k-box-card-list .k-box-card .k-box-card-wrap .content h4 {
        color: #000;
        font-size: 1rem;
        min-height: 40px;
        margin-top: 0;
        display: -webkit-box;
        max-width: 100%;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .k-box-card .k-box-card-wrap .content {
        height: 35px !important;
    }

    .k-box-card-list .k-box-card .k-box-card-wrap .view-price ul .price {
        font-size: 1rem;
    }

    .combo-home {
        margin: 0 -15px;
    }

    .k-box-card-list.combo-home .k-box-card .k-box-card-wrap {
        margin: 0;
    }
</style>
<h2 class="heading-section">Combo tại RPA</h2>
<section>
    <ul id="w0" class=" k-box-card-list combo-home ">
        @if (count($items) > 0)
            @foreach ($items as $item)
                @php
					$totalCourse = $item->courseList()->count();
                    $id = $item['id'];
                    $thumbnail = Obn::showThumbnail($item['thumbnail'] ?? '');
                    $price = Obn::showPrice($item['price']) ?? 'Liên hệ';
                    $slug = $item['slug'];
                    $link = route('fe_combo/detail', ['slug' => $slug]);
                @endphp
                <li class="col-xl-3 col-md-6 col-xs-12 k-box-card" data-key="0">
                    <div class="k-box-card-wrap clearfix" data-id="{{ $id }}" data-course-type="1">
                        <div class="img">
                            <img class="img-fluid img-lazy" src="{{ $thumbnail }}" size="263x147"
                                alt="Tự động hóa kinh doanh Online" resizeMode="cover" returnMode="img" lazyImg
                                data-src="{{ $thumbnail }}">
                            <div class="label-wrap">
                            </div>
                        </div>
                        <!--end .img-->
                        <div class="content">
                            <div class="box-style">
                            </div>
                            <h4>{{ $item['title'] ?? '-' }}</h4>
                        </div>
                        <!--end .content -->
                        <!--end .content mb -->
                        <div class="view-price">
                            <ul>
                                <li class="price"><strong>{{ $price }}</strong></li>
                            </ul>
                        </div>
                        <!--end .view-price-->
                        <div class="view-price-mb">
                            <div class="student">
                                <div class="number">0</div>
                                <div class="text">học viên</div>
                            </div>
                            <div class="time">
                                <div class="number">{{$totalCourse ?? 0}}</div>
                                <div class="text">khóa học</div>
                            </div>
                            <div class="price">
                                <div class="label-price">
                                    <div class="first">{{$price}}</div>
                                </div>
                            </div>
                        </div>
                        <!--end .view-price mb-->
                        <a href="{{ $link }}" class="link-wrap"></a>
                    </div>
                    <a href="{{ $link }}" class="card-popup"></a>
                    <!--end .wrap-->
                </li>
            @endforeach
        @else
            <p>Nội dung đang cập nhật..</p>
        @endif
    </ul>
    <nav id="pager-container">
    </nav>
</section>
