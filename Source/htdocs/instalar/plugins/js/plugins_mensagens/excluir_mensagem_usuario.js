
// exclui a mensagem de usuario
function excluir_mensagem_usuario(id, idcampo_1, uidamigo, modo){

// valida o modo de exclusao
if(modo == true){
	
	// atualiza as variaveis globais
    v_variaveis_javascript['modo_excluir_mensagem'] = 1;
	
}else{
	
	// atualiza as variaveis globais
	v_variaveis_javascript['modo_excluir_mensagem'] = 2;
	
};

// remove elemento por id
remove_elemento_id(idcampo_1);

// atualiza as variaveis globais
v_variaveis_javascript['id_mensagem_excluir'] = id;
v_variaveis_javascript['uidamigo_exclui_mensagem'] = uidamigo;

// exclui mensagem de usuario...
executador_acao(null, 43, null);

};
