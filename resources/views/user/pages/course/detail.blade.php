@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
@extends('frontend.main')
@section('body_class', 'user_course course_detail')
@section('title', $current_lesson['title'] ?? '-')
@section('content')
    <section id="course-detail">

        <div class="row">
            <div class="col-md-4">
                <div class="course-sidebar">
                    <div class="course-sidebar-head">
                        <h4>Nội dung bài học</h4>
                    </div>
                    <div class="course-general syllabus__wrapper">
                        @if (count($lessons) > 0)
                            <div class="syllabus">
                                @foreach ($lessons as $key => $lesson)
                                    @php
                                        $lesson_index = $key + 1;
                                        $lesson_id = $lesson['id'];
                                        $depth = $lesson['depth'] ?? 0;
                                        $lesson_title = $lesson['title'] ?? '-';
                                        $expanded = $lesson_index == 1 ? 'true' : 'false';
                                        $collapse = $lesson_index == 1 ? 'in' : '';
                                        $childs = $lesson->descendantsOf($lesson_id);
                                        $lesson_link = route('user_course/detail', ['slug' => $slug, 'lesson_id' => $lesson_id]);
                                        $lesson_active = $current_lesson_id == $lesson_id ? 'active' : '';
                                    @endphp
                                    <div class="syllabus-item {{ $lesson_active }}">
                                        @if (count($childs) > 0)
                                            <a href="#chapter{{ $lesson_id }}" class="syllabus__cta collapsed "
                                                data-toggle="collapse" role="button" aria-expanded="true"
                                                aria-controls="collapseExample">
                                                <div class="syllabus__chapter">
                                                    <span class="syllabus__icon">
                                                        <img src="https://cdn-skill.kynaenglish.vn/img/arrow.svg"
                                                            alt="Kyna" width="20px" height="20px">
                                                    </span>
                                                    <div class="syllabus__heading">
                                                        <h6 class="heading"> {{ $lesson_title }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="collapse {{ $collapse }}" id="chapter{{ $lesson_id }}"
                                                aria-expanded="{{ $expanded }}">
                                                <div class="syllabus__section">
                                                    @foreach ($childs as $child)
                                                        <div class="syllabus__section-item">
                                                            <span class="syllabus__section--icon">
                                                                <picture>
                                                                    <source media="(min-width:768px)"
                                                                        srcset="https://cdn-skill.kynaenglish.vn/img/play.svg">
                                                                    <img src="https://cdn-skill.kynaenglish.vn/img/play-green.svg"
                                                                        alt="Kyna" width="20px" height="20px">
                                                                </picture>
                                                            </span>
                                                            <span class="syllabus__section--title">
                                                                <a href="{{ $lesson_link }}">
                                                                    {{ $child['title'] ?? '-' }}
                                                                </a></span>
                                                            <!-- Next week -->
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            @php
                                                $collapse = 'in';
                                            @endphp
                                            <div class="collapse {{ $collapse }}" id="chapter{{ $lesson_id }}"
                                                aria-expanded="{{ $expanded }}">
                                                <div class="syllabus__section">
                                                    <div class="syllabus__section-item">
                                                        <span class="syllabus__section--icon">
                                                            <picture>
                                                                <source media="(min-width:768px)"
                                                                    srcset="https://cdn-skill.kynaenglish.vn/img/play.svg">
                                                                <img src="https://cdn-skill.kynaenglish.vn/img/play-green.svg"
                                                                    alt="Kyna" width="20px" height="20px">
                                                            </picture>
                                                        </span>
                                                        <span class="syllabus__section--title">
                                                            <a href="{{ $lesson_link }}"
                                                                class="syllabus__section--title-video">
                                                                {{ $lesson_title }}
                                                            </a></span>
                                                        <!-- Next week -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="course-content">
                    <div class="course-content-head">
                        <div class="course-logo">
                            <a href="{{ route('home/index') }}"><img src="{{ Obn::get_logo() }}" alt=""
                                    class="img-fluid"></a>
                        </div>
                        <div class="cousre-btn-back">
                            <a href="{{ route('user_course/index') }}">Trở về Khu vực học tập</a>
                        </div>
                    </div>
                    <div class="course-content-detail">
                        <div class="course-video">
                            @php
                            $videoEmbedUrl =  $current_lesson['video'] ? CoursePackage::videoLink($current_lesson['video'] ?? '', 'false') : Obn::getYoutubeEmbedUrl($current_lesson['video_youtube']);
                            @endphp
                            <div style="position: relative; padding-top: 56.25%;">

                                <iframe src="{{ $videoEmbedUrl }}"
                                    loading="lazy"
                                    style="border: none; position: absolute; top: 0; height: 100%; width: 100%;"
                                    allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
                                    allowfullscreen="true"></iframe>
                            </div>
                        </div>
                        <div class="course-content-inner">
                            {!! $current_lesson['content'] ?? 'Nội dung đang cập nhật...' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom_style')
    <style>
        .course_detail #navDesktop {
            display: none;
        }

        .course_detail footer {
            display: none;
        }

        .course-general.syllabus__wrapper {
            padding-top: 0;
            padding-block: 0
        }

        .syllabus .syllabus-item {
            border: none;
        }

        .course-sidebar-head {
            padding: 20px 24px;
        }

        .syllabus__cta {
            background-color: rgb(222, 233, 243);
        }

        .course-sidebar-head h4 {
            font-weight: bold;
            color: var(--color-main);
            text-transform: uppercase;
        }

        .syllabus__section--title-video {
            cursor: pointer;
            pointer-events: inherit;
            display: block;
        }

        section#course-detail {
            overflow: hidden;
        }

        .course-logo img {
            height: 70px;
        }

        .course-content-head {
            padding: 20px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .course-sidebar {
            background: #f8f9ff;
            height: 100vh;
            overflow: auto;
            position: fixed;
            width: 33.3333333333%;
        }

        .cousre-btn-back {
            font-weight: bold;
            font-size: 18px;
        }

        .cousre-btn-back a {
            color: var(--color-main);
        }

        #course-detail .row>* {
            padding: 0;
        }

        .course-content-detail {
            padding: 45px 100px;
            background: url({{ asset('kyna/img/img-lesson-bg.png') }}) center top no-repeat;
        }

        .course-content-detail>*:not(:last-child) {
            margin-bottom: 30px;
        }

        .course_detail {
            background: #f8f9ff;
        }

        .course-content-info {
            background: #fff;
            padding: 15px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .content-checked {
            color: rgb(87, 218, 194);
        }

        .course-sidebar::-webkit-scrollbar {
            width: 0;
        }

        .active .syllabus__section {
            background: rgb(236, 239, 255);
        }

        @media screen and (max-width: 767.98px) {
            .course-content-head {
                flex-wrap: wrap;
                display: none;
            }

            .course-sidebar {
                position: inherit;
                width: 100%;
                padding: 15px;
            }

            section#course-detail .row {
                display: flex;
                flex-direction: column;
            }

            section#course-detail .row>*:last-child {
                order: 1;
            }

            section#course-detail .row>*:first-child {
                order: 2;
            }

            .course-content-detail {
                padding: 30px;
                background: none;
            }
        }
    </style>
@endsection
