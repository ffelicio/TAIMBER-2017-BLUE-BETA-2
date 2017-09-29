
// fecha a janela de chat
function fechar_janela_chat(uid, idcampo_1){

// modo mobile
var v_modo_mobile = parseInt(v_variaveis_javascript['modo_mobile']);

// valida modo mobile
if(v_modo_mobile == 1){

	// exibe a janela com usuarios do chat
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_chat_principal'], 0);

	// exibe a janela principal de chat
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_principal_chat'], 0);

};

// id de janela
var id_janela = v_janelas_chat_id[uid];

// valida janela existe
if(retorna_elemento_id_existe(id_janela) == false){
	
	// retorno nulo
	return null;
	
};

// limpa arrays globais com informacoes de uids de chat
delete v_array_usuarios_abertos_chat[v_array_usuarios_abertos_chat.indexOf(uid)];
delete v_usuarios_chat[v_usuarios_chat.indexOf(uid)];

// seta o uid de janela de chat que sera fechada
v_variaveis_javascript['uid_usuario_fecha_chat'] = uid;

// limpa os dados de sessao
executador_acao(null, 50, null);

// remove janela de chat
remove_elemento_id(id_janela);

// remove usuario de lista de usuarios abertos do chat
remove_elemento_id(idcampo_1);

// atualiza o contador
v_variaveis_javascript['contador_nova_janela_chat']--;

// atualiza o array
v_usuarios_chat[uid] = null;
	
};
