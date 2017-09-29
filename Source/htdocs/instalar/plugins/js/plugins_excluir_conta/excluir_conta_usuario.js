
// excluir conta de usuario
function excluir_conta_usuario(id_campo_senha, id_campo_mensagem, idcampo_1){

// informa a senha usada para excluir a conta
v_variaveis_javascript['campo_senha_excluir_conta'] = document.getElementById(id_campo_senha).value;

// limpa e move o foco para o campo da senha
document.getElementById(id_campo_senha).value = null;
document.getElementById(id_campo_senha).focus();

// oculta campo excluir conta de usuario
oculta_exibe_elemento_idcampo(idcampo_1, null);

// array de valores
var array_valores = [];

// atualiza variaveis de valores
array_valores[0] = idcampo_1;

// exclui a conta de usuario
executador_acao(array_valores, 32, id_campo_mensagem);	
	
};
