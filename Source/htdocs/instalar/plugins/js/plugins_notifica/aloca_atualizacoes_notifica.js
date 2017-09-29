
// aloca as atualizacoes das notificacoes
function aloca_atualizacoes_notifica(v_dados, array_valores){

// valida numero de notificacoes gerais
if(parseInt(v_dados[0]) == 0){
	
	// oculta campo de notificacoes
	exibe_elemento_oculto(v_variaveis_javascript['id_notifica_num_geral'], null);
	
}else{
	
	// exibe o campo de notificacoes
	exibe_elemento_oculto(v_variaveis_javascript['id_notifica_num_geral'], 0);	
	
};

// alocando atualizacoes
seta_valor_campo(v_variaveis_javascript['id_notifica_num_geral'], v_dados[0], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_curtida'], v_dados[1], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_comentario'], v_dados[2], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_mensagens'], v_dados[3], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_depoimentos'], v_dados[4], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_amizades_add'], v_dados[5], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_marcacoes'], v_dados[6], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'], v_dados[7], 1);

// valida numero de novas mensagens
if(parseInt(v_dados[8]) > 0){
	
	// alocando atualizacoes
	seta_valor_campo(array_valores[0], v_dados[8], 1);

}else{
	
	// alocando atualizacoes
	seta_valor_campo(array_valores[0], null, 1);
	
};

// altera o titulo ao atualizar as notificacoes
altera_titulo_notifica(v_dados[9]);

};
