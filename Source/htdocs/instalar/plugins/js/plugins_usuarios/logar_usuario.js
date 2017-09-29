
// logar usuario
function logar_usuario(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7){

// array de valores
var array_valores = [];

// obtendo valores
array_valores[0] = obtem_valor_campo(idcampo_2, 0);
array_valores[1] = obtem_valor_campo(idcampo_3, 0);
array_valores[2] = idcampo_1;
array_valores[3] = idcampo_5;
array_valores[4] = idcampo_6;
array_valores[5] = idcampo_7;
array_valores[6] = v_variaveis_javascript['id_formulario_cadastro'];

// valida email
if(array_valores[0].length == 0){
	
	// movendo o foco
	document.getElementById(idcampo_2).focus();
	
	// retorno
	return false;
	
};
	
// valida senha
if(array_valores[1].length == 0){
	
	// movendo o foco
	document.getElementById(idcampo_3).focus();
	
	// retorno
	return false;
	
};

// exibe a barra de progresso gif
oculta_exibe_elemento_idcampo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_5, 1);
oculta_exibe_elemento_idcampo(array_valores[6], null);

// limpando campos
seta_valor_campo(idcampo_3, null, 0);

// logando usuario
executador_acao(array_valores, 1, idcampo_4);

};
