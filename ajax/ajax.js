// $(".book").click(function(){
//     var timeslot = $(this).attr('data-timeslot');
//     $("#slot").html(timeslot);
//     $("#timeslot").val(timeslot);
//     $("#myModal").modal("show");
// });



// Modal

$(document).ready(function(){
    $(".book").click(function(){
        // AJAX request
        $.ajax({
            url: 'modalForm.php',
            type: 'post',
            data: {ts: $(this).data('timeslot'), date: $(this).data('date') },
            success: function(response){
                // Add response in Modal body
                $('#myModal').html(response);

                // Display Modal
                $('#myModal').modal('show');
            }
        });
    });
});
