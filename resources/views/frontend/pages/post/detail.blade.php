@extends('frontend.main')
@section('title', $item['title'] ?? '-')
@section('content')
    <div class="page-post">
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>
                        <a itemscope itemtype='http://schema.org/Thing' itemprop='item' id='https://skills.kynaenglish.vn/'
                            href='{{ route('home/index') }}'>
                            <span itemprop='name'>Trang chủ</span>
                            <meta itemprop='url' content=https://skills.kynaenglish.vn />
                        </a>
                        <meta itemprop='position' content='1'>
                    </li>
                    <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class='active'>
                        <span itemprop='name'>{{$item['title'] ?? "-"}}</span>
                        <meta itemprop='url' content='{{ route('fe_combo/index') }}'>
                        <meta itemprop='position' content='2'>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            {{-- <h1>{{ $item['title'] ?? '-' }}</h1> --}}
            <div class="post-content">
                {!! $item['content'] ?? "Nội dung đang cập nhật..." !!}
            </div>
        </div>
    </div>
@endsection
