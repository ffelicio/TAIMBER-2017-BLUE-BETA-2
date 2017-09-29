
// exibe um elemento oculto
function exibe_elemento_oculto(idcampo_1, modo){

// valida elemento existe por id
if(retorna_elemento_id_existe(idcampo_1) == false){

    // retorno nulo
    return null;	
	
};

// valor atual
var v_valor = $("#" + idcampo_1).css('display');

// valida estado atual de exibicao
if(v_valor.toLowerCase() == "none"){
	
    // exibe um elemento oculto
    switch(modo){
	
	    case 0:
	    document.getElementById(idcampo_1).style.display = "table";
	    break;
	
	    case 1:
	    document.getElementById(idcampo_1).style.display = "block";
	    break;
		
		case 2:
		$("#" + idcampo_1).show();
		break;

		case 3:
		$("#" + idcampo_1).hide();
		break;
		
		default:
        document.getElementById(idcampo_1).style.display = "none";
		
    };	

}else{

    // valida o modo
    if(modo == null){
	
        // oculta elemento
        document.getElementById(idcampo_1).style.display = "none";
	
    };

};

// valida modo
if(modo == 3){
	
	// valida classe
	if(v_valor.toLowerCase() == "none"){
		
		// exibe
		document.getElementById(idcampo_1).style.display = "table";
		
	}else{
		
		// oculta
		document.getElementById(idcampo_1).style.display = "none";
		
	};
	
};

};
