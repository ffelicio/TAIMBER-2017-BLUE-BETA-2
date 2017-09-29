
// obtem o valor de campo de entrada
function obtem_valor_campo(idcampo_1, modo){

// retorna se o elemento existe por id
if(retorna_elemento_id_existe(idcampo_1) == false){
	
	// retorno nulo
	return null;
	
};

// valida o modo
switch(parseInt(modo)){
	
	case 0: // campo de entrada comum, text, password
	return document.getElementById(idcampo_1).value;
	break;
	
	case 1: // codigo html de elemento
	return document.getElementById(idcampo_1).innerHTML;
	break;
	
	case 2: // obtem elemento checado
	return document.getElementById(idcampo_1).checked;
	break;

	case 3: // obtem elemento de div
	return $("#" + idcampo_1).text();
	break;
	
};

};
