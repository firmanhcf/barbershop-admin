$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
}); 

$('.datetimepicker').datetimepicker();


function getPrice(rowid){
    for (var i = 0; i < PRICES.length; i++) {
        if(PRICES[i].service_id == $('#service_'+rowid).val()){
            $('#price_'+rowid).val(PRICES[i].price);
        } 
    }

    if($('#service_'+rowid).val() == ""){
        $('#price_'+rowid).val(0);
    }

    var selectedService = $('#service_'+rowid).val();
    var serviceCode = selectedService.split("-");
    var staffPosition = 8;

    if(serviceCode[0] == 3){
        staffPosition = 9;
    }
    else if(serviceCode[0] == 4){
        staffPosition = 10;
    }

    var strOpt = '<option value="">Pilih Kapster/Terapis/Trainer</option>';
    for (var i = 0; i < CUSTSERV.length; i++) {
        if(CUSTSERV[i].staff_position == staffPosition){
            strOpt += '<option value="'+CUSTSERV[i].id+'">'+CUSTSERV[i].name+'</option>';
        }
    }

    $("#capster_"+rowid).html(strOpt);

    countSubtotal(rowid);
}

function countTotal(){
    var totalPayment = 0;
    for (var i = 1; i <= TRANDETROW; i++) {
        var subtotal = ($('#price_'+i).val() * $('#qty_'+i).val()) - ( ($('#discount_'+i).val()/100) *($('#price_'+i).val() * $('#qty_'+i).val()));
        totalPayment += subtotal;
    }
    $('#total_payment').val(totalPayment);
}

function countSubtotal(rowid){

    var subtotal = ($('#price_'+rowid).val() * $('#qty_'+rowid).val()) - ( ($('#discount_'+rowid).val()/100) *($('#price_'+rowid).val() * $('#qty_'+rowid).val()));
    $('#subtotal_'+rowid).val(subtotal);

    masterDiscount();
    
}

function masterDiscount(){

    countTotal();

    var totalAfterDiscount = $('#total_payment').val() - ( ($('#master_discount').val()/100) * $('#total_payment').val());
    $('#total_payment').val(totalAfterDiscount);
}

function getOutletInfo(){

    $.get(APP_URL+"/outlet/info/"+$('#outlet_id').val(), function(res, status) {

        PRICES = [];

        // $('#capster_id').html("");

        // var strOpt = '<option value="">Pilih Kapster</option>';
        for (var i = 0; i < res.capsters.length; i++) {
            
            var custService = {
                id : res.capsters[i].id,
                name : res.capsters[i].name,
                staff_position : res.capsters[i].staff_position
            };

            CUSTSERV.push(custService);

        }

        // $('#capster_id').html(strOpt);
                    
        for(var i = 0; i < res.prices.length; i++){

            var adult = {
                name : res.prices[i].name+" - Dewasa",
                service_id : res.prices[i].service_id+"-"+1,
                price : res.prices[i].adult_price
            };

            var kid = {
                name : res.prices[i].name+" - Anak",
                service_id : res.prices[i].service_id+"-"+2,
                price : res.prices[i].kid_price
            };

            PRICES.push(adult);
            PRICES.push(kid);
        }

        $('#service_1').html("");
        
        var strOpt = '<option value="">Pilih Layanan</option>';
        for (var i = 0; i < PRICES.length; i++) {
            strOpt += '<option value="'+PRICES[i].service_id+'">'+PRICES[i].name+'</option>';
        }

        $('#service_1').html(strOpt);
    });

}

function redrawTable(rowid){

    rowid = parseInt(rowid);
    var row = '';
    for (var i = rowid+1; i <= TRANDETROW; i++) {

        row += '<tr id="row_'+(i-1)+'">';
        row += '<td id="row_num_'+(i-1)+'">'+(i-1)+'</td>';
        row += '<td id="service_num_'+(i-1)+'">';
        row += '<select class="form-control input-sm" name="service_'+(i-1)+'" id="service_'+(i-1)+'" onchange="getPrice('+(i-1)+')">';
        row += '<option value="">Pilih Layanan</option>';

        for (var j = 0; j < PRICES.length; j++) {

            var strSelected = "";
            if(PRICES[j].service_id == $('#service_'+i).val()){
                strSelected = "selected";
            }

            row += '<option value="'+PRICES[j].service_id+'" '+strSelected+'>'+PRICES[j].name+'</option>';

        }

        row += '</select>';
        row += '</td>';

        row += '<td id="capster_num_'+(i-1)+'">';
        row += '<select class="form-control input-sm" name="capster_'+(i-1)+'" id="capster_'+(i-1)+'" >';
        
        var selectedService = $('#service_'+i).val();
        var serviceCode = selectedService.split("-");
        var staffPosition = 8;

        if(serviceCode[0] == 3){
            staffPosition = 9;
        }
        else if(serviceCode[0] == 4){
            staffPosition = 10;
        }

        row +=  '<option value="">Pilih Kapster/Terapis/Trainer</option>';
        for (var j = 0; j < CUSTSERV.length; j++) {
            
            if(CUSTSERV[j].staff_position == staffPosition){

                var strSelected = "";
                if(CUSTSERV[j].id == $('#capster_'+i).val()){
                    strSelected = "selected";
                }

                row += '<option value="'+CUSTSERV[j].id+'" '+strSelected+'>'+CUSTSERV[j].name+'</option>';
            }
        }

        row += '</select>';
        row += '</td>';

        row += '<td id="price_num_'+(i-1)+'">';
        row += '<input type="text" class="form-control input-sm" id="price_'+(i-1)+'" name="price_'+(i-1)+'" value="'+$('#price_'+i).val()+'" readonly>';
        row += '</td>';
        row += '<td id="qty_num_'+(i-1)+'">';
        row += '<input type="text" class="form-control input-sm" id="qty_'+(i-1)+'" name="qty_'+(i-1)+'" value="'+$('#qty_'+i).val()+'"  onkeyup="countSubtotal('+(i-1)+')">';
        row += '</td>';
        row += '<td id="discount_num_'+(i-1)+'">';
        row += '<input type="text" class="form-control input-sm" id="discount_'+(i-1)+'" name="discount_'+(i-1)+'" value="'+$('#discount_'+i).val()+'" onkeyup="countSubtotal('+(i-1)+')">';
        row += '</td>';
        row += '<td id="subtotal_num_'+(i-1)+'">';
        row += '<input type="text" class="form-control input-sm" id="subtotal_'+(i-1)+'" name="subtotal_'+(i-1)+'" value="'+$('#subtotal_'+i).val()+'" readonly>';
        row += '</td>';
        row += '<td id="remove_num_'+(i-1)+'">';
        row += '<button id="remove_'+(i-1)+'" type="button" class="btn btn-xs btn-danger" onclick="removeRow('+(i-1)+')"><i class="fa fa-times"></i></button>';
        row += '</td>';
        row += '</tr>';
        
        $('#row_'+i).remove();
    }

    if(rowid == 1){
        $('#transaction_detail_table tbody').html(row);
    }
    else{
        $('#transaction_detail_table tbody tr:last').after(row);
    }
    

    TRANDETROW--;
    $('#transaction_detail_row').val(TRANDETROW);

}

function removeRow(rowid){

    if(TRANDETROW == 1){
        return;
    }

    $('#row_'+rowid).remove();
    redrawTable(rowid);
    masterDiscount();
}

function addRow(){

    if(PRICES.length == 0){
        return;
    }

    TRANDETROW++;
    $('#transaction_detail_row').val(TRANDETROW);

    var row = '';
    row += '<tr id="row_'+TRANDETROW+'">';
    row += '<td id="row_num_'+TRANDETROW+'">'+TRANDETROW+'</td>';
    row += '<td id="service_num_'+TRANDETROW+'">';
    row += '<select class="form-control input-sm" name="service_'+TRANDETROW+'" id="service_'+TRANDETROW+'" onchange="getPrice('+TRANDETROW+')">';
    row += '<option value="">Pilih Layanan</option>';

    for (var i = 0; i < PRICES.length; i++) {
        row += '<option value="'+PRICES[i].service_id+'">'+PRICES[i].name+'</option>';
    }

    row += '</select>';
    row += '</td>';

    row += '<td id="capster_num_'+TRANDETROW+'">';
    row += '<select class="form-control input-sm" name="capster_'+TRANDETROW+'" id="capster_'+TRANDETROW+'">';
    row += '<option value="">Pilih Kapster/Terapis/Trainer</option>';
    row += '</select>';
    row += '</td>';

    row += '<td id="price_num_'+TRANDETROW+'">';
    row += '<input type="text" class="form-control input-sm" id="price_'+TRANDETROW+'" name="price_'+TRANDETROW+'" value="0" readonly>';
    row += '</td>';
    row += '<td id="qty_num_'+TRANDETROW+'">';
    row += '<input type="text" class="form-control input-sm" id="qty_'+TRANDETROW+'" name="qty_'+TRANDETROW+'" value="0"  onkeyup="countSubtotal('+TRANDETROW+')">';
    row += '</td>';
    row += '<td id="discount_num_'+TRANDETROW+'">';
    row += '<input type="text" class="form-control input-sm" id="discount_'+TRANDETROW+'" name="discount_'+TRANDETROW+'" value="0" onkeyup="countSubtotal('+TRANDETROW+')">';
    row += '</td>';
    row += '<td id="subtotal_num_'+TRANDETROW+'">';
    row += '<input type="text" class="form-control input-sm" id="subtotal_'+TRANDETROW+'" name="subtotal_'+TRANDETROW+'" value="0" readonly>';
    row += '</td>';
    row += '<td id="remove_num_'+TRANDETROW+'">';
    row += '<button id="remove_'+TRANDETROW+'" type="button" class="btn btn-xs btn-danger" onclick="removeRow('+TRANDETROW+')"><i class="fa fa-times"></i></button>';
    row += '</td>';
    row += '</tr>';

    $('#transaction_detail_table tbody tr:last').after(row);
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
                    "invoice_num": {
                        required: !0,
                        minlength: 8
                    },
                    "outlet_id": {
                        required: !0
                    },
                    "capster_id": {
                        required: !0
                    }

                    
                },
                messages: {
                    "invoice_num": {
                        required: "Masukkan nomor invoice",
                        minlength: "Nomor invoice minimal teridiri dari 8 karakter"
                    },
                    "outlet_id": {
                        required: "Silakan pilih outlet"
                    },
                    "capster_id": {
                        required: "Silakan pilih kapster"
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

