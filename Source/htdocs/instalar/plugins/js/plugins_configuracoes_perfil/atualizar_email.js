
// atualiza o email de usuario
function atualizar_email(idcampo_1, idcampo_2){

// array de valores
var array_valores = [];

// atualizando o array de valores
array_valores[0] = obtem_valor_campo(idcampo_1, 0);

// valida email digitado
if(array_valores[0].length == 0){
	
	// movendo o foco
	document.getElementById(idcampo_1).focus();
	
	// retorno nulo
	return null;
	
};

// atualizando email
executador_acao(array_valores, 103, idcampo_2);

};
