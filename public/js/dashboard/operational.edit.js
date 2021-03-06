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
                        required: !0
                    },
                    "item_id": {
                        required: !0
                    },
                    "qty": {
                        required: !0,
                        number: !0
                    },
                    "price": {
                        required: !0
                    }
                    
                    
                },
                messages: {
                    "outlet_id": {
                        required: "Silakan pilih outlet"
                    },
                    "item_id": {
                        required: "Silakan pilih kegiatan operational"
                    },
                    "qty": {
                        required: "Masukkan jumlah aset",
                        number: "Nomor telepon harus berupa nomor"
                    },
                    "price": {
                        required: "Masukkan harga satuan"
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