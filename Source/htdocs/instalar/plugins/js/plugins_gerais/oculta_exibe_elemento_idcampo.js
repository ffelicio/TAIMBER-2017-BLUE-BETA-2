
// oculta ou exibe um elemento por id
function oculta_exibe_elemento_idcampo(idcampo_1, modo){

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

    };	

}else{

    // oculta elemento
    document.getElementById(idcampo_1).style.display = "none";

};

};
