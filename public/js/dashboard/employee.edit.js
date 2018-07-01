
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
});


function setOutlet(){
    if($('#staff_position').val()=='6' || $('#staff_position').val()=='8' || $('#staff_position').val()=='9' || $('#staff_position').val()=='10'){
        $('#outlet_id').attr('readonly', false);
        $('#outlet_id').css('pointer-events', '');
    }
    else{
        $('#outlet_id').val(0);
        $('#outlet_id').attr('readonly', true);
        $('#outlet_id').css('pointer-events', 'none');
    }
}

function getRegency(){
    $.get(APP_URL+"/config/regency/"+$('#province').val(), function(res, status) {
        $('#regency').html("");

        var strOpt = '<option value="">Pilih Kabupaten/Kota</option>';
        for (var i = 0; i < res.length; i++) {
            strOpt += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
        }

        $('#regency').html(strOpt);
                    
    });
}

function getDistrict(){
    $.get(APP_URL+"/config/district/"+$('#regency').val(), function(res, status) {
        $('#district').html("");

        var strOpt = '<option value="">Pilih Kecamatan</option>';
        for (var i = 0; i < res.length; i++) {
            strOpt += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
        }

        $('#district').html(strOpt);
                    
    });
}

var form_validation = function() {
    var e = function() {
            jQuery(".form-valide").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
                    "nik": {
                        required: !0,
                        minlength: 8
                    },
                    "name": {
                        required: !0,
                        minlength: 3
                    },
                    "province": {
                        required: !0
                    },
                    "regency": {
                        required: !0
                    },
                    "district": {
                        required: !0
                    },
                    "address": {
                        required: !0,
                        minlength: 8
                    },
                    "birthdate": {
                        required: !0
                    },
                    "religion": {
                        required: !0
                    },
                    "last_education": {
                        required: !0
                    },
                    "staff_status": {
                        required: !0
                    },
                    "staff_position": {
                        required: !0
                    },
                    "id_card_number": {
                        required: !0,
                        minlength: 8
                    },
                    "pks_number": {
                        required: !0
                    },
                    "pks_date": {
                        required: !0
                    },
                    "pks_start_date": {
                        required: !0
                    },
                    "pks_end_date": {
                        required: !0
                    },
                    "salary": {
                        required: !0
                    }
                },
                messages: {
                    "nik": {
                        required: "Masukkan ID karyawan",
                        minlength: "ID Karyawan minimal terdiri dari 8 Karakter"
                    },
                    "name": {
                        required: "Masukkan nama karyawan",
                        minlength: "Nama Karyawan minimal terdiri dari 3 karakter"
                    },
                    "province": {
                        required: "Silakan pilih provinsi"
                    },
                    "regency": {
                        required: "Silakan pilih kabupaten/kota"
                    },
                    "district": {
                        required: "Silakan pilih Kecamatan"
                    },
                    "address": {
                        required: "Masukkan alamat karyawan",
                        minlength: "Alamat karyawan minimal terdiri dari 10 karakter"
                    },
                    "birthdate": {
                        required: "Pilih tanggal lahir"
                    },
                    "religion": {
                        required: "Pilih agama"
                    },
                    "id_card_number": {
                        required: "Masukkan nomor KTP/SIM/Paspor",
                        minlength: "Your id card number must consist of at least 8 characters"
                    },
                    "last_education": {
                        required: "Pilih pendidikan terakhir"
                    },
                    "staff_status": {
                        required: "Pilih status karyawan"
                    },
                    "staff_position": {
                        required: "pilih posisi karyawan"
                    },
                    "pks_number": {
                        required: "Masukkan nomor PKS"
                    },
                    "pks_date": {
                        required: "Pilih tanggal pembuatan PKS"
                    },
                    "pks_start_date": {
                        required: "Pilih tanggal berlaku PKS"
                    },
                    "pks_end_date": {
                        required: "Pilih tanggal berakhir PKS"
                    },
                    "salary": {
                        required: "Masukkan nominal upah"
                    }
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});