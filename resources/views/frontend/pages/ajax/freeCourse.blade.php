@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
<div class="course-general related-course__wrapper animate-fade-in">
    <h2 class="heading-5 heading-section animate-fade-in">Khóa học 0 đồng <span style="color: #ff7818;"></span></h2>

    <div class="free-course__slider slick__slider--normal animate-fade-in">
        @if (count($items) > 0)
            @foreach ($items as $item)
                @php
                    $id = $item['id'];
                    $thumbnail = Obn::showThumbnail($item['thumbnail']);
                    $teacher = $item->teacher()->first();
                    $teacherAvatar = Obn::showThumbnail($teacher['thumbnail']);
                    $teacherTitle = $teacher['title'] ?? '-';
                    $teacherPosition = $teacher['position'] ?? '-';
                    $price = Obn::showPrice($item['price']);
                    $created_at = Obn::showTime($item['created_at']) ?? '';
                    $totalStudent = $item->student()->count();
                    $description = $item['description'] ?? '';
                    $slug = $item['slug'] ?? '';
                    $detailUrl = route('fe_course/detail', ['slug' => $slug]);
                    $lessonHasTry = $item->lessonIsTry();
                    $tryVideoId = $lessonHasTry['video_youtube'] ?? '';
                    $tryVideoUrl = CoursePackage::videoLink($tryVideoId,true,1);
                    $videoClass = !$tryVideoId ? 'none-video' : '';
                @endphp
                <div class="card-course" data-toggle="popover" data-trigger="hover" data-id="{{ $id }}"
                    data-upload-date="{{ $created_at }}" data-duration="3 giờ" data-user-enroll="{{ $totalStudent }}"
                    data-description="{!! $description !!}" data-promo-text="" data-is-best-seller="0"
                    data-status-item="1" data-course-item-free="1"
                    data-cart-url="{{ route('fe_cart/add', ['id' => $id]) }}">
                    <div class="ribbon-position">
                        <img width="100%" height="auto" class="img" src="{{ asset('kyna/img/ribbon-free.png') }}"
                            alt="RPAGROUP">
                    </div>
                    <div class="card-inner">
                        <a href="{{ $detailUrl }}" class="card-link">
                            <div class="card-header">
                                <img src="{{ $thumbnail }}" alt="course-image">
                                <div class="card-header__badget">
                                    <span class="card-header__badget-item"><i class="fal fa-play-circle"></i>0</span>
                                    <span class="card-header__badget-item"><i class="fal fa-star"></i>5</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="heading-card">
                                        <span class="heading-card__main">{{ $item['title'] ?? '-' }}</span>
                                    </h5>

                                    <p class="pricing-card">
                                        <a href="#" class="cta-open-video" data-source="{{ $tryVideoUrl }}">
                                            <button class="btn-ripple">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            Học thử
                                        </a>
                                        <span class="course-pricing">0 đ</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>
