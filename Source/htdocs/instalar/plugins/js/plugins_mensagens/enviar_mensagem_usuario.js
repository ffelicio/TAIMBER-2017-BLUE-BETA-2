
// envia mensagem para usuario
function enviar_mensagem_usuario(tecla_pressionada, uid, idcampo_1, id_dialogo_1, id_dialogo_2){

// fecha a janela de troca de mensagens
if(tecla_pressionada == 27){
	
	// fecha a janela de chat
	fechar_janela_chat(uid, idcampo_1);
	
	// retorno
	return null;
	
};

// verifica se enter foi pressionado
if(tecla_pressionada != 13){

	// retorno
	return null;	

};

// atualiza variaveis globais
v_variaveis_javascript['mensagem_enviar_usuario'] = obtem_valor_campo(idcampo_1, 1);
v_variaveis_javascript['uidamigo_envia_mensagem'] = uid;

// valida mensagem a ser enviada
if(v_variaveis_javascript['mensagem_enviar_usuario'].length == 0){

    // move o foco
    document.getElementById(idcampo_1).focus();

    // retorno nulo
    return null;	
	
};

// envia mensagem para usuario
executador_acao(null, 41, null);

// valida ocultar dialogos
if(retorna_elemento_id_existe(id_dialogo_1) == true && retorna_elemento_id_existe(id_dialogo_2) == true){
	
    // oculta o dialogo de mensagem e exibe o de sucesso ao enviar mensagem.
    exibe_dialogo(id_dialogo_1);
    exibe_dialogo(id_dialogo_2);

};

// limpa campos
seta_valor_campo(idcampo_1, null, 2);

// move o foco
document.getElementById(idcampo_1).focus();

};
