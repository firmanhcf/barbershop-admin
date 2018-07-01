
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
                        required: "Masukkan ID Partner",
                        minlength: "ID Partner minimal harus terdiri dari 8 karakter"
                    },
                    "name": {
                        required: "Masukkan nama pemilik",
                        minlength: "Nama pemilik minimal harus terdiri dari 3 karakter"
                    },
                    "address": {
                        required: "Masukkan nama pemilik",
                        minlength: "Alamat pemilik minimal harus terdiri dari 3 karakter"
                    },
                    "id_card_number": {
                        required: "Masukkan nomor identitas",
                        minlength: "Nomor identitas pemilik minimal harus terdiri dari 3 karakter"
                    },
                    "email": "Masukkan alamat email yang valid",
                    "password": {
                        required: "Masukkan password",
                        minlength: "Password minimal harus terdiri dari 8 karakter"
                    },
                    "confirm_password": {
                        required: "Masukkan password kembali",
                        minlength: "Password minimal harus terdiri dari 3 karakter",
                        equalTo: "Please enter the same password as above"
                    },
                    "pks_number": {
                        required: "Masukkan nomor PKS"
                    },
                    "pks_date": {
                        required: "Masukkan tanggal PKS"
                    },
                    "pks_start_date": {
                        required: "Masukkan tanggal berlaku PKS"
                    },
                    "pks_end_date": {
                        required: "Masukkan tanggal berakhir PKS"
                    },
                    "investation": {
                        required: "Masukkan nilai investasi"
                    },
                    "pks_file": {
                        required: "Upload hasil scan PKS, berupa file PDF"
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