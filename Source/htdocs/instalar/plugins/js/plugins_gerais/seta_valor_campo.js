
// seta o valor de campo
function seta_valor_campo(idcampo_1, valor, modo){

// valida o modo
switch(modo){
	
	case 0: // campo de entrada comum, text, password
	document.getElementById(idcampo_1).value = valor;
	break;
	
	case 1: // codigo html de elemento
	$("#" + idcampo_1).html(valor);
	break;
	
	case 2:
	$("#" + idcampo_1).empty();
	break;
	
};

};
