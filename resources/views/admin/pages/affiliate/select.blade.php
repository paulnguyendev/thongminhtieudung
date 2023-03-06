<select class="form-control" name="parent_id">
    <option value="" selected="selected">
        Không có
    </option>
    @foreach ($categories as $category_id => $category_name)
        <option value="{{ $category_id }}">
            {{ $category_name }}
        </option>
    @endforeach
</select>
