
// adicionar amizade
function adicionar_amizade(uidamigo, idcampo_email, idcampo_mensagem, id, modo){

// modo temporario de adicionar amizade
v_variaveis_javascript['modo_temp_adicionar_amizade'] = modo;

// valida existencia de campo
if($("#" + idcampo_email).length > 0){
	
    // email de privacidade
    v_variaveis_javascript['e_mail_campo_add_amizade'] = document.getElementById(idcampo_email).value;

};

// seta o id de usuario amigo
v_variaveis_javascript['uidamigo'] = uidamigo;

// seta o campo id de mensagem de falha ao adicionar amizade
v_variaveis_javascript['campo_mensagem_falha_add_amizade'] = idcampo_mensagem

// adiciona a lista de amigos
executador_acao(null, 13, id);

};
