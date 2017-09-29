
// atualiza a publicacao de usuario
function atualizar_publicacao(id, idcampo_1, idcampo_2, idcampo_3){

// conteudo
var v_conteudo = obtem_valor_campo(idcampo_2, 1);

// valida o conteudo
if(v_conteudo.length == 0){
	
	// movendo o foco
	document.getElementById(idcampo_2).focus();
	
	// retorno
	return null;
	
};

// atualiza as variaveis globais
v_variaveis_javascript['conteudo_atualiza_publicacao'] = v_conteudo;
v_variaveis_javascript['id_post'] = id;

// atualiza publicacao
executador_acao(null, 71, idcampo_1);

// fecha janela de dialogo
exibe_dialogo(idcampo_3);

};
