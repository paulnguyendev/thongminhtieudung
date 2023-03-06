@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
@extends('frontend.main')
@section('body_class', 'user_course')
@section('content')
    <section id="my-course">
        <div class="container">
            <div class="user-profile-heading">
                <h1>Khu vực học tập </h1>
                <p>Khóa học, tài liệu mà bạn đăng ký sẽ được hiển thị dưới đây </p>
            </div>
            <div id="myCoursesList">
                <div id="myCoursesContent">
                    @if ($total > 0)
                        @foreach ($myCourses as $course)
                            @php
                                $course_info = $course['course_info'] ?? [];
                                $courseTitle = $course_info['title'] ?? '-';
                                $thumbnail = Obn::showThumbnail($course_info['thumbnail'] ?? '');
                                $teacher_id = $course_info['teacher_id'];
                                $teacher = $teacherModel::find($teacher_id);
                                $slug = $course_info['slug'] ?? '-';
                               
                                $course_id = $course_info['id'] ?? '-';
                                $courseInfo = $courseModel::find($course_id);
                                $lesson = $courseInfo->lesson()->count();
                                $lessonFirst = CoursePackage::getFirstLesson($course_id);
                                $lesson_id = $lessonFirst['id'] ?? ""; 
                                $link = route('user_course/detail', ['slug' => $slug,'lesson_id' => $lesson_id ]);
                              
                                
                                
                            @endphp
                            <div class="my-courses-card">
                                <a href="{{ $link }}" class="inner" title="{{ $courseTitle }}">
                                    <div class="left-side">
                                        <img src="{{ $thumbnail }}" alt="Google Ads Smart Marketing A-Z">
                                    </div>
                                    <div class="right-side">
                                        <h5 class="course-name">{{ $courseTitle }}</h5>
                                        <div class="course-trainer">
                                            {{ $teacher['title'] ?? '-' }}
                                            <i class="fas fa-circle"></i>
                                            <span class="course-trainer-title"> {{ $teacher['position'] ?? '-' }}</span>
                                        </div>
                                        <div class="course-document ">
                                            <span class="course-link" data-href="{{ $link }}">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-365.000000, -386.000000)">
                                                            <g transform="translate(113.000000, 298.000000)">
                                                                <g transform="translate(252.000000, 16.000000)">
                                                                    <g transform="translate(0.000000, 72.000000)">
                                                                        <polygon points="0 0 20 0 20 20 0 20"></polygon>
                                                                        <path
                                                                            d="M6.66666667,13.3333333 L13.3333333,13.3333333 L13.3333333,15 L6.66666667,15 L6.66666667,13.3333333 Z M6.66666667,10 L13.3333333,10 L13.3333333,11.6666667 L6.66666667,11.6666667 L6.66666667,10 Z M11.6666667,1.66666667 L5,1.66666667 C4.08333333,1.66666667 3.33333333,2.41666667 3.33333333,3.33333333 L3.33333333,16.6666667 C3.33333333,17.5833333 4.075,18.3333333 4.99166667,18.3333333 L15,18.3333333 C15.9166667,18.3333333 16.6666667,17.5833333 16.6666667,16.6666667 L16.6666667,6.66666667 L11.6666667,1.66666667 Z M15,16.6666667 L5,16.6666667 L5,3.33333333 L10.8333333,3.33333333 L10.8333333,7.5 L15,7.5 L15,16.6666667 Z"
                                                                            fill="#979797" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>{{$lesson}} bài học
                                            </span>


                                        </div>
                                        {{-- <div class="course-progress">
                                            <div class="course-progress-bar">
                                                <span style="width: 33%"></span>
                                            </div>
                                            <span class="course-progress-number">33% Hoàn thành</span>
                                        </div> --}}
                                        <div class="course-cta-learn">Học tiếp <svg width="18px" height="18px"
                                                viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-1219.000000, -417.000000)">
                                                        <g transform="translate(1158.000000, 417.000000)">
                                                            <g
                                                                transform="translate(70.000000, 9.000000) rotate(180.000000) translate(-70.000000, -9.000000) translate(61.000000, 0.000000)">
                                                                <polygon points="0 0 18 0 18 18 0 18"></polygon>
                                                                <polygon fill="#50AD4E" fill-rule="nonzero"
                                                                    points="15.75 8.25 5.1225 8.25 7.8075 5.5575 6.75 4.5 2.25 9 6.75 13.5 7.8075 12.4425 5.1225 9.75 15.75 9.75">
                                                                </polygon>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    @else
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection
@section('custom_style')
    <link rel="stylesheet" href="https://cdn-skill.kynaenglish.vn/css/user-profile.css?v=15217955218005">
@endsection
