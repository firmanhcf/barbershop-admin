
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
                    "partner_id": {
                        required: !0,
                        minlength: 8
                    },
                    "name": {
                        required: !0,
                        minlength: 3
                    },
                    "address": {
                        required: !0,
                        minlength: 5
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
                    "investation": {
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
                        required: "Please enter an owner name",
                        minlength: "Your owner name must consist of at least 3 characters"
                    },
                    "address": {
                        required: "Please enter an owner address",
                        minlength: "Your owner address must consist of at least 10 characters"
                    },
                    "id_card_number": {
                        required: "Please enter an id card number",
                        minlength: "Your id card number must consist of at least 8 characters"
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
                    "investation": {
                        required: "Please enter a investation"
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