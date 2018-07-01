
function partnershipChanged(){
    
    if($('#partnership_id').val() == 3){
        $('#total_training_seat').attr('readonly', false);
    }
    else{
        $('#total_training_seat').attr('readonly', true);
    }

    $.get(APP_URL+"/config/service/"+$('#partnership_id').val(), function(res, status) {
        $('#outlet_price_table tbody').html("");

        var strOpt = '';
        for (var i = 0; i < res.length; i++) {
            strOpt += '<tr><td align="center">'+(i+1)+'</td> <td>'+res[i].name+' <input type="hidden" name="service_id[]" value="'+res[i].service_id+'"></td> <td><input type="number" class="form-control input-sm" name="adult_price[]"></td> <td><input type="number" class="form-control input-sm" name="kid_price[]"></td> </tr>';
        }

        $('#outlet_price_table tbody').html(strOpt);
                    
    });
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

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
});

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
                    "outlet_id": {
                        required: !0,
                        minlength: 8
                    },
                    "name": {
                        required: !0
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
                    "telephone_number": {
                        required: !0,
                        number: !0
                    },
                    "partner_id": {
                        required: !0
                    },
                    "partnership_id": {
                        required: !0
                    },
                    "total_barber_seat": {
                        required: !0,
                        number: !0
                    },
                    "total_reflection_seat": {
                        required: !0,
                        number: !0
                    },
                    "total_training_seat": {
                        required: !0,
                        number: !0
                    }
                    
                },
                messages: {
                    "outlet_id": {
                        required: "Masukkan ID outlet",
                        minlength: "ID Outlet minimal terdiri dari 8 karakter"
                    },
                    "name": {
                        required: "Masukkan nama outlet barber shop"
                    },
                    "province": {
                        required: "Silakan pilih provinsi"
                    },
                    "regency": {
                        required: "Silakan pilih kabupaten/kota"
                    },
                    "district": {
                        required: "Silakan pilih kecamatan"
                    },
                    "address": {
                        required: "Masukkan alamat outlet",
                        minlength: "Alamat Outlet minimal terdiri dari 10 karakter"
                    },
                    "telephone_number": {
                        required: "Masukkan nomor telepon outlet",
                        number: "Nomor telepon harus berupa nomor"
                    },
                    "partner_id": {
                        required: "Silakan pilih pemilik/investor"
                    },
                    "partnership_id": {
                        required: "Silakan pilih kemitraan"
                    },
                    "total_barber_seat": {
                        required: "Masukkan jumlah kursi potong",
                        number: "Jumlah kursi potong harus berupa nomor"
                    },
                    "total_reflection_seat": {
                        required: "Masukkan jumlah kursi pijat",
                        number: "Jumlah kursi pijat harus berupa nomor"
                    },
                    "total_training_seat": {
                        required: "Masukkan jumlah kursi pelatihan",
                        number: "Jumlah kursi pelatihan harus berupa nomor"
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