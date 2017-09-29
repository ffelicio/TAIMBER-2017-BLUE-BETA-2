
// excluir pagina de usuario
function excluir_pagina_usuario(pagina, idcampo_1, idcampo_2, idcampo_3){

// seta valores de variaveis globais
v_variaveis_javascript['senha_atual'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_pagina_excluir'] = pagina;

// valida se a senha foi informada
if(v_variaveis_javascript['senha_atual'].length == 0 || v_variaveis_javascript['id_pagina_excluir'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_1).focus();
	
	// retorno nulo
	return null;
	
};

// remove campos...
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_3);

// exclui pagina de usuario
executador_acao(null, 60, idcampo_2);

};
