@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                {{-- <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <select name="cat_id" class="form-control">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $category_id => $category_name)
                                                <option value="{{ $category_id }}">{{ $category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-block">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
                <div class="panel-body">
                    <div class="row row-5">
                        @if (count($items) > 0)
                            @foreach ($items as $item)
                                <div class="col-md-2">
                                    @include('user.templates.product_item', $item)
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p>Sản phẩm đang cập nhật...</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_srcipt')
    <script>
        $('select[name="cat_id"]').select2({
            placeholder: 'Chọn thể loại'
        });
    </script>
@endsection
