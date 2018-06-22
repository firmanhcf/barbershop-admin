function accountActivation(id, status){

	var actForm = APP_URL+'/account/activation/'+id+'/'+status;
    $('#activation_form').attr('action', actForm);
    $('#activation_form').submit();
}