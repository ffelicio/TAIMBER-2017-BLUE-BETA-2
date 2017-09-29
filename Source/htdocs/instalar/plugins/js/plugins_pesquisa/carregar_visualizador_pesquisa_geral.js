
// carrega o visualizador de pesquisa geral
function carregar_visualizador_pesquisa_geral(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, modo){

// obtem dados da pesquisa
var v_nome_pesquisa = obtem_valor_campo(idcampo_3, 0);

// valida se elemento existe
if(idcampo_4.length > 0){
	
	// modo de pesquisa
	var v_modo_pesquisa = obtem_valor_campo(idcampo_4, 0);

}else{

	// modo de pesquisa
	var v_modo_pesquisa = null;
	
};

// valida se elemento existe
if(idcampo_5.length > 0){
	
	// cidade de pesquisa
	var v_cidade_pesquisa = obtem_valor_campo(idcampo_5, 0);

}else{

	// cidade de pesquisa
	var v_cidade_pesquisa = null;
	
};

// array com valores
var array_valores = [];

// valida se deve zerar o contador
if(v_variaveis_javascript['nome_pesquisa_geral'] != v_nome_pesquisa || v_variaveis_javascript['modo_pesquisa_geral'] != v_modo_pesquisa || v_variaveis_javascript['cidade_pesquisa_geral'] != v_cidade_pesquisa){
	
	// atualiza o array de valores
	array_valores["modo_limpa_contador"] = 1;

}else{
	
	// atualiza o array de valores
	array_valores["modo_limpa_contador"] = 0;
	
};

// nome a ser pesquisado
v_variaveis_javascript['nome_pesquisa_geral'] = v_nome_pesquisa;
v_variaveis_javascript['modo_pesquisa_geral'] = v_modo_pesquisa;
v_variaveis_javascript['cidade_pesquisa_geral'] = v_cidade_pesquisa;

// atualiza o array de valores
array_valores[0] = idcampo_2;
array_valores[1] = v_cidade_pesquisa;
array_valores[2] = modo;

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_2, 0);

// movendo scroll
move_scroll_bottom(idcampo_1);

// pesquisa geral
executador_acao(array_valores, 16, idcampo_1);

};
