
// carrega as mensagens do usuario via chat
function carregar_mensagens_usuario_chat(v_uid, idcampo_1){

// seta variaveis globais
v_variaveis_javascript['uidamigo_conversa_chat_temp'] = v_uid;

// valida se variavel existe
if(retorne_variavel_existe(v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid]) == false){

    // zerar o contador...
    v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid] = 1;

};

// carregando mensagens...
executador_acao(null, 48, idcampo_1);

// informa que nao deve zerar mais o contador
v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid] = 0;

};
