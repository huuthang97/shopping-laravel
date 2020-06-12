function search() {
    $('body').click(function(){
        $('.wrap-item-search').hide();
    })
$('.search_box input').on('keyup', function() {
    $('.wrap-item-search').fadeIn();
    let url = $('#_url').data('url');
    let keyWord = $(this).val();
    $.get( url + "/search",
        { keyWord },
        function(data){
            let img_loading = url + '/frontend/images/loading/Ellipsis-1s-200px.gif';
            let loading = '<div class="text-center"><img width="30" src=' + img_loading + '/>';
            $('.wrap-item-search').html(loading);
            setTimeout(function(){ $('.wrap-item-search').html(data); }, 1000);
    });
})
}