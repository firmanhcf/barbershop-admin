
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
});

function photoChanged(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#photo_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function changePhoto(){
    $('#profile_photo').click();
}

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
                    "current_password": {
                        required: !0
                    },
                    "new_password": {
                        required: !0,
                        minlength: 8
                    },
                    "confirm_password": {
                        required: !0,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    "current_password": {
                        required: "Please enter your current password"
                    },
                    "new_password": {
                        required: "Please provide a new password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    "confirm_password": {
                        required: "Please provide a new password",
                        minlength: "Your password must be at least 8 characters long",
                        equalTo: "Please enter the same password as above"
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