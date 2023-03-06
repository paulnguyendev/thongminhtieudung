@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
@section('body_class','page-teacher')
@extends('frontend.main')
@section('content')
<section id="k-courses-header" class="k-height-header">
    <div class="container">
        <header>
            <img class="img-fluid" src="{{$item['thumbnail'] ?? ""}}" size="120x120" width="120px" height="120px" alt="{{$item['title'] ?? ""}}" title="{{$item['title'] ?? ""}}" resizemode="crop" returnmode="img" max-width="100%">            <h1 class="name">{{$item['title'] ?? ""}}</h1>
            <h2 class="email">T{{$item['position'] ?? ""}}</h2>
            
        </header>
        <section class="k-courses-header-list mt-4">
            <div class="course-summary">
              {!! $item['content'] ?? "" !!}
            </div>
        </section>
    </div><!--end .container-->
</section>
@endsection
