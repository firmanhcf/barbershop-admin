
function showSweetAlert(type, id){
    
    var actForm = type+'/delete/'+id;
    $('#del_form').attr('action', actForm);

    swal({
            title: "Apakah Anda yakin akan menghapus data tersebut?",
            text: "Data tersebut akan dihaus secara parsial, dapat dikembalikan sewaktu-waktu",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus saja",
            closeOnConfirm: false
        },
        function(){
            $('#del_form').submit();
        });
};

