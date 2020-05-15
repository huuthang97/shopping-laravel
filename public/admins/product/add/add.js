$(document).ready(function() {
    $(".tag").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $(".category").select2({
        placeholder: 'Chọn danh mục'
    });


  });