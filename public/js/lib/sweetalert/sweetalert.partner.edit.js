
document.querySelector('.sweet-confirm').onclick = function(){
    swal({
            title: "Apakah Anda yakin akan memperbarui data tersebut?",
            text: "Akun Anda akan tercatat sebagai last updater",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Update",
            closeOnConfirm: false
        },
        function(){
            $('#edit_form').submit();
        });
};

