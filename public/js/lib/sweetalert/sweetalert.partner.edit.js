
document.querySelector('.sweet-confirm').onclick = function(){
    swal({
            title: "Are you sure to update this data?",
            text: "Your account information will be recorded as last updater",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            closeOnConfirm: false
        },
        function(){
            $('#edit_form').submit();
        });
};

