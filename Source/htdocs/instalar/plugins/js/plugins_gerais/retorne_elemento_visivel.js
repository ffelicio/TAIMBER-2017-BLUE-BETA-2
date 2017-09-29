
// retorna se um elemento está visível pelo seu id
function retorne_elemento_visivel(idcampo_1){

// valor atual
var v_valor = $("#" + idcampo_1).css('display');

// valida elemento existe por id
if(retorna_elemento_id_existe(idcampo_1) == false){

    // retorno falso
    return false;	
	
};

// retorno
return v_valor.toLowerCase() == "none";

};
