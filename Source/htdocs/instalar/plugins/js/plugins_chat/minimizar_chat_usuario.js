
// minimiza o chat do usuario
function minimizar_chat_usuario(idcampo_1, idcampo_2){

// 0 esta maximizado
// 1 esta minimizado

// valida dados
if(v_variaveis_javascript['chat_minimizado'] == 0){

	// atualiza estado atual
	v_variaveis_javascript['chat_minimizado'] = 1;
	
	// exibindo elementos
	exibe_elemento_oculto(idcampo_1, 2);
	
	// ocultando elementos
	exibe_elemento_oculto(idcampo_2, 3);
	
}else{

	// atualiza estado atual
	v_variaveis_javascript['chat_minimizado'] = 0;
	
	// ocultando elementos
	exibe_elemento_oculto(idcampo_1, 3);
	
	// exibindo elementos
	exibe_elemento_oculto(idcampo_2, 2);

};

};
