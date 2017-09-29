
// salva o comentario editado
function salvar_comentario_editado(id_campo_entrada, id_comentario, id_campo_texto_comentario, id_dialogo_editar){

// comentario
var v_comentario = obtem_valor_campo(id_campo_entrada, 1);

// valida comentario
if(v_comentario.length == 0){
	
    // move o foco
    document.getElementById(id_campo_entrada).focus();
	
	// retorno
	return null;
	
};

// seta o texto temporario de comentario editado
v_variaveis_javascript['campo_temp_texto_coment_editado'] = v_comentario;

// informa o comentario a ser atualizado
v_variaveis_javascript['comentario_idatualizar'] = id_comentario;

// atualiza o comentario
executador_acao(null, 20, id_campo_texto_comentario);

// fecha o dialogo atual
exibe_dialogo(id_dialogo_editar);

};
