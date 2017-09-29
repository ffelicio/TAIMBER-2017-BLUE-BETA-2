
// alterar a senha do usuario
function alterar_senha(campo_mensagem, senha_atual, nova_senha, nova_senha_confirma){

// dados de entradas
var v_senha_atual = document.getElementById(senha_atual).value;
var v_nova_senha = document.getElementById(nova_senha).value;
var v_nova_senha_confirma = document.getElementById(nova_senha_confirma).value;

// valida campo
if(v_senha_atual.length == 0){

	// move o foco
    document.getElementById(senha_atual).focus()

	// retorno nulo
	return null;
	
};

// valida campo
if(v_nova_senha.length == 0){
	
	// move o foco
    document.getElementById(nova_senha).focus()

	// retorno nulo
	return null;
	
};

// valida campo
if(v_nova_senha_confirma.length == 0){
	
	// move o foco
    document.getElementById(nova_senha_confirma).focus()

	// retorno nulo
	return null;
	
};

// atualiza as variaveis
v_variaveis_javascript['senha_atual'] = v_senha_atual;
v_variaveis_javascript['nova_senha'] = v_nova_senha;
v_variaveis_javascript['nova_senha_confirma'] = v_nova_senha_confirma;

// altera a variavel que ira carregar o conteudo
v_variaveis_javascript['campo_carrega_conteudo'] = campo_mensagem;

// limpa os campos
document.getElementById(senha_atual).value = "";
document.getElementById(nova_senha).value = "";
document.getElementById(nova_senha_confirma).value = "";
document.getElementById(campo_mensagem).innerHTML = "";

// altera a senha de usuario
executador_acao(null, 30, campo_mensagem);

};
