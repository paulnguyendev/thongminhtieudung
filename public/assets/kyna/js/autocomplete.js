$(document).ready(function () {
  let searchUrl = $("#live-search-bar").data('url');
  let categoryUrl = $("#live-search-bar").data('url-category');
  $("#live-search-bar").autocomplete({
    source: function (request, respone) {
      if (request.term != "") {
        $.ajax({
          url: searchUrl,
          data: {
            searchText: request.term
          },
          success: function (data) {
            result = [];
            $.each(data.data, function (index, value) {
              result.push(value);
            });
            if (result.length > 0)
              result[result.length - 1].isLastItem = true;
            respone(result);
          }
        });
      } else // neu trong thi xuat ra 5 khoa hoc hot nhat
      {
        $.ajax({
          url: "/course/default/livesearch",
          data: {
            searchText: ""
          },
          success: function (data) {
            result = [];
            $.each(data.data, function (index, value) {
              result.push(value);
            });
            if (result.length > 0)
              result[result.length - 1].isLastItem = true;
            respone(result);
          }
        });
      }
    },
    open: function (event, ui) {
      if ($(this).val().trim() == "")
        $('.ui-autocomplete').append(
          `<div class = 'live-search-result-full-search'><a href='${categoryUrl}'>» Xem tất cả khóa học</a></div>`); //See all results
      else
        $('.ui-autocomplete').append(
          `<div class = 'live-search-result-full-search'><a href='${categoryUrl}/tim-kiem?q=` + $("#live-search-bar").val() + "'>» Xem tất cả kết quả cho <b>'" + $('<div/>').text($("#live-search-bar").val()).html() + "'</b></a></div>"); //See all results
    },
    appendTo: $("#live-search-result"),
    minLength: 0,
    delay: 0
  }).focus(function () {
    $(this).data("uiAutocomplete").search($(this).val());
  });

  $("#live-search-bar").autocomplete("instance")._renderItem = function (ul, item) {
    khoa_hoc_type_text = "Khóa học khác";
    switch (item.type) {
      case 1:
        khoa_hoc_type_text = "Khóa học lẻ";
        break;
      case 2:
        khoa_hoc_type_text = "Combo khuyến mãi";
        break;
      default:
        break;
    }
    highlight_course_name = item.highlight_name;
    highlight_teacher_name = item.highlight_teacher_name;
    if (item.isLastItem == true)
      course_name =
        "<a href='" + item.url + "'><b>" + highlight_course_name + "</b><div>" + highlight_teacher_name + " • " + khoa_hoc_type_text + "</div>" +
        "<div class='bottom-border last-item'></div></a>";
    else
      course_name =
        "<a href='" + item.url + "'><b>" + highlight_course_name + "</b><div>" + highlight_teacher_name + " • " + khoa_hoc_type_text + "</div>" +
        "<div class='bottom-border'></div></a>";

    return $("<li>")
      .append(course_name)
      .appendTo(ul);
  };
});


$(document).ready(function () {

  if (!$("#m-live-search-bar").length) {
    return
  }
  $("#m-live-search-bar").autocomplete({
    source: function (request, respone) {
      if (request.term != "") {
        $.ajax({
          url: "/course/default/livesearch",
          data: {
            searchText: request.term
          },
          success: function (data) {
            result = [];
            $.each(data.data, function (index, value) {
              result.push(value);
            });
            if (result.length > 0)
              result[result.length - 1].isLastItem = true;
            respone(result);
          }
        });
      } else // neu trong thi xuat ra 5 khoa hoc hot nhat
      {
        $.ajax({
          url: "/course/default/livesearch",
          data: {
            searchText: ""
          },
          success: function (data) {
            result = [];
            $.each(data.data, function (index, value) {
              result.push(value);
            });
            if (result.length > 0)
              result[result.length - 1].isLastItem = true;
            respone(result);
          }
        });
      }
    },
    open: function (event, ui) {
      if ($(this).val().trim() == "")
        $('.ui-autocomplete').append(
          "<div class = 'live-search-result-full-search'><a href='/danh-sach-khoa-hoc'>» Xem tất cả khóa học</a></div>"); //See all results
      else
        $('.ui-autocomplete').append(
          "<div class = 'live-search-result-full-search'><a href='/danh-sach-khoa-hoc?q=" + $("#live-search-bar").val() + "'>» Xem tất cả kết quả cho <b>'" + $('<div/>').text($("#live-search-bar").val()).html() + "'</b></a></div>"); //See all results
    },
    appendTo: $("#m-live-search-result"),
    minLength: 0,
    delay: 0
  }).focus(function () {
    $(this).data("uiAutocomplete").search($(this).val());
  });

  $("#m-live-search-bar").autocomplete("instance")._renderItem = function (ul, item) {
    khoa_hoc_type_text = "Khóa học khác";
    switch (item.type) {
      case 1:
        khoa_hoc_type_text = "Khóa học lẻ";
        break;
      case 2:
        khoa_hoc_type_text = "Combo khuyến mãi";
        break;
      default:
        break;
    }
    highlight_course_name = item.highlight_name;
    highlight_teacher_name = item.highlight_teacher_name;
    if (item.isLastItem == true)
      course_name =
        "<a href='" + item.url + "'><b>" + highlight_course_name + "</b><div>" + highlight_teacher_name + " • " + khoa_hoc_type_text + "</div>" +
        "<div class='bottom-border last-item'></div></a>";
    else
      course_name =
        "<a href='" + item.url + "'><b>" + highlight_course_name + "</b><div>" + highlight_teacher_name + " • " + khoa_hoc_type_text + "</div>" +
        "<div class='bottom-border'></div></a>";

    return $("<li>")
      .append(course_name)
      .appendTo(ul);
  };
});
