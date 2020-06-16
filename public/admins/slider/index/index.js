function deleteSlider(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    var that = $(this);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
        $.get( url, function( data ) {
            if ( data['code'] == 200 ){
                that.parent().parent().remove();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
          });
        }

        
      })
}

$(document).ready(function(){

    $(".delete-action").click(deleteSlider);
});