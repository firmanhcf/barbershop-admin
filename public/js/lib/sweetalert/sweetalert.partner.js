
function showSweetAlert(type, id){
    
    var actForm = type+'/delete/'+id;
    $('#del_form').attr('action', actForm);

    swal({
            title: "Are you sure to delete this data?",
            text: "You can restore it later",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it",
            closeOnConfirm: false
        },
        function(){
            $('#del_form').submit();
        });
};

