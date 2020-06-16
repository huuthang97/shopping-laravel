function filterPrice(categoryId='') {
    let url = $('#_url').data('url');
    let img_loading = url + '/frontend/images/loading/Spinner-1s-200px.gif';
    $(".well").mouseup(function(){
        let strPrice = $('.tooltip-inner').text();
        $.get( url + "/sidebar/filter-price",
            { strPrice, categoryId },
            function(data){
                let loading = '<div class="text-center"><img src=' + img_loading + '/>';
                $('.features_items').html(loading);
                setTimeout(function(){ $('.features_items').html(data); }, 1000);
        });
    });
}
