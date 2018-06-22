
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

        var strOpt = '<option value="">Select Regency</option>';
        for (var i = 0; i < res.length; i++) {
            strOpt += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
        }

        $('#regency').html(strOpt);
                    
    });
}

function getDistrict(){
    $.get(APP_URL+"/config/district/"+$('#regency').val(), function(res, status) {
        $('#district').html("");

        var strOpt = '<option value="">Select District</option>';
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
                    "partner_id": {
                        required: "Please enter a partner ID",
                        minlength: "Your Partner ID must consist of at least 8 characters"
                    },
                    "province": {
                        required: "Please select a province"
                    },
                    "regency": {
                        required: "Please select a regency"
                    },
                    "district": {
                        required: "Please select a district"
                    },
                    "address": {
                        required: "Please enter an owner address",
                        minlength: "Your owner address must consist of at least 10 characters"
                    },
                    "telephone_number": {
                        required: "Please enter a telephone number",
                        number: "Your telephone number must be a number"
                    },
                    "partner_id": {
                        required: "Please select an owner"
                    },
                    "partnership_id": {
                        required: "Please select a partnership schema"
                    },
                    "total_barber_seat": {
                        required: "Please enter barber seat on outlet",
                        number: "Total seat must be a number"
                    },
                    "total_refelction_seat": {
                        required: "Please enter massage seat on outlet",
                        number: "Total seat must be a number"
                    },
                    "total_training_seat": {
                        required: "Please enter training seat on outlet",
                        number: "Total seat must be a number"
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