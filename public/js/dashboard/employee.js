
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
});


function setOutlet(){
    if($('#staff_position').val()=='6' || $('#staff_position').val()=='8'){
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
                    "id_card_files": {
                        required: !0
                    },
                    "staff_status": {
                        required: !0
                    },
                    "staff_position": {
                        required: !0
                    },
                    "last_education_certificate": {
                        required: !0
                    },
                    "id_card_number": {
                        required: !0,
                        minlength: 8
                    },
                    "email": {
                        required: !0,
                        email: !0
                    },
                    "password": {
                        required: !0,
                        minlength: 8
                    },
                    "confirm_password": {
                        required: !0,
                        equalTo: "#password"
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
                    },
                    "pks_file": {
                        required: !0
                    }
                },
                messages: {
                    "partner_id": {
                        required: "Please enter a partner ID",
                        minlength: "Your Partner ID must consist of at least 8 characters"
                    },
                    "name": {
                        required: "Please enter a name",
                        minlength: "Your name must consist of at least 3 characters"
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
                        required: "Please enter an address",
                        minlength: "Your address must consist of at least 10 characters"
                    },
                    "birthdate": {
                        required: "Please select a birthdate"
                    },
                    "religion": {
                        required: "Please select a religion"
                    },
                    "id_card_number": {
                        required: "Please enter an id card number",
                        minlength: "Your id card number must consist of at least 8 characters"
                    },
                    "last_education": {
                        required: "Please select a last education"
                    },
                    "staff_status": {
                        required: "Please select a employee status"
                    },
                    "staff_position": {
                        required: "Please select a employee position"
                    },
                    "id_card_files": {
                        required: "Please upload a scan of ID card"
                    },
                    "last_education_certificate": {
                        required: "Please upload a certificate of last education"
                    },
                    "email": "Please enter a valid email address",
                    "password": {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    "confirm_password": {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    "pks_number": {
                        required: "Please enter a pks number"
                    },
                    "pks_date": {
                        required: "Please enter a pks start date"
                    },
                    "pks_start_date": {
                        required: "Please enter a pks start date"
                    },
                    "pks_end_date": {
                        required: "Please enter a pks end date"
                    },
                    "salary": {
                        required: "Please enter a salary"
                    },
                    "pks_file": {
                        required: "Please upload a pks file"
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