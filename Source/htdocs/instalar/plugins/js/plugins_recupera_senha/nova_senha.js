
// define nova senha
function nova_senha(chave, idcampo_1, idcampo_2, idcampo_3){

// dados de entradas
var v_nova_senha = document.getElementById(idcampo_2).value;
var v_nova_senha_confirma = document.getElementById(idcampo_3).value;

// valida campo
if(v_nova_senha.length == 0){
	
	// move o foco
    document.getElementById(idcampo_2).focus()

	// retorno nulo
	return null;
	
};

// valida campo
if(v_nova_senha_confirma.length == 0){
	
	// move o foco
    document.getElementById(idcampo_3).focus()

	// retorno nulo
	return null;
	
};

// array de valores
var array_valores = [];

// atualiza as variaveis
array_valores[0] = v_nova_senha;
array_valores[1] = v_nova_senha_confirma;
array_valores[2] = chave;

// limpa os campos
document.getElementById(idcampo_2).value = "";
document.getElementById(idcampo_3).value = "";

// altera a senha de usuario
executador_acao(array_valores, 102, idcampo_1);

};
