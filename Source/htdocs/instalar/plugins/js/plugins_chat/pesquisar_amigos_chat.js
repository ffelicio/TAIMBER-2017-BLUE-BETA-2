
// pesquisa amigos de chat
function pesquisar_amigos_chat(idcampo_1, idcampo_2){

// apenas paginar
if(idcampo_1 != null){

	// nome de pesquisa atual
	v_variaveis_javascript['nome_pesquisa_amigo_local_chat'] = obtem_valor_campo(idcampo_1, 0);

	// valida se um conteudo para pesquisa foi informado
	if(v_variaveis_javascript['nome_pesquisa_amigo_local_chat'].length == 0){

		// limpa lista de usuarios de chat antigos
		$("#" + idcampo_2).html("");
		
		// limpa contador de avanco de pesquisa de amigos de chat
		executador_acao(null, 91, null);

	};
	
};

// carregando os amigos
executador_acao(null, 89, idcampo_2);

};
