
// encvia o modo de redefinir senha
function envia_redefinir_senha(idcampo_1, idcampo_2){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = obtem_valor_campo(idcampo_1, 0);

// valida conteudo
if(array_valores[0].length == 0){
	
	// move o foco
	document.getElementById(idcampo_1).focus();

	// retorno nulo
	return null;
	
};

// redefinindo senha
executador_acao(array_valores, 101, idcampo_2);

};
