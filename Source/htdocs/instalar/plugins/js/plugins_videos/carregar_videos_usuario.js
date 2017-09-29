
// carrega as videos do usuario
function carregar_videos_usuario(uid, idcampo_1, idcampo_2){

// atualiza as variaveis globais
v_variaveis_javascript['uid_videos_usuario'] = uid;
v_variaveis_javascript['id_campo_progresso_videos_usuario'] = idcampo_2;

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_2, 0);

// carrega as videos do usuario
executador_acao(null, 82, idcampo_1)

};
