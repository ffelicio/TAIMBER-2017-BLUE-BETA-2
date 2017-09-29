
// seta o valor de checkbox de campo de privacidade
function seta_valor_checkbox_campo_privacidade(icampo_1, idcampo_2){

// valida configuracao
if(document.getElementById(idcampo_2).checked == true){

    // valor
    var v_valor = 1;

}else{

    // valor
    var v_valor = 0;	
	
};

// setando valor
document.getElementById(icampo_1).value = v_valor; 

};
