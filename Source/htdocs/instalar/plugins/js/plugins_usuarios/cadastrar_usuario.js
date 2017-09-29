
// cadastra o usuario
function cadastrar_usuario(idcampo_0, idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7){

// atualiza as variaveis globais
v_variaveis_javascript['campo_cadastro_0'] = obtem_valor_campo(idcampo_0, 0);
v_variaveis_javascript['campo_cadastro_1'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['campo_cadastro_2'] = obtem_valor_campo(idcampo_2, 0);
v_variaveis_javascript['campo_cadastro_3'] = obtem_valor_campo(idcampo_3, 0);
v_variaveis_javascript['campo_cadastro_4'] = obtem_valor_campo(idcampo_4, 0);
v_variaveis_javascript['campo_cadastro_5'] = idcampo_5;
v_variaveis_javascript['campo_cadastro_6'] = idcampo_6;
v_variaveis_javascript['campo_cadastro_7'] = idcampo_7;

// valida e move o foco
if(v_variaveis_javascript['campo_cadastro_0'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_0).focus();
	
	// retorno nulo
	return null;
	
};

// valida e move o foco
if(v_variaveis_javascript['campo_cadastro_1'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_1).focus();
	
	// retorno nulo
	return null;
	
};

// valida e move o foco
if(v_variaveis_javascript['campo_cadastro_2'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_2).focus();
	
	// retorno nulo
	return null;
	
};

// valida e move o foco
if(v_variaveis_javascript['campo_cadastro_3'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_3).focus();
	
	// retorno nulo
	return null;
	
};

// valida e move o foco
if(v_variaveis_javascript['campo_cadastro_4'].length == 0){
	
	// move o foco
	document.getElementById(idcampo_4).focus();
	
	// retorno nulo
	return null;
	
};

// valida se as senhas sao iguais
if(v_variaveis_javascript['campo_cadastro_3'] != v_variaveis_javascript['campo_cadastro_4']){

	// move o foco
	document.getElementById(idcampo_4).focus();
	
	// retorno nulo
	return null;	

};

// oculta o botao de cadastro
exibe_elemento_oculto(idcampo_6, 0);

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_7, 0);

// cadastra usuario
executador_acao(null, 2, v_variaveis_javascript['campo_cadastro_5']);

};
