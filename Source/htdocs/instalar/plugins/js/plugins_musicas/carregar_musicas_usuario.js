
// carrega as musicas do usuario
function carregar_musicas_usuario(uid, idcampo_1, idcampo_2){

// atualiza as variaveis globais
v_variaveis_javascript['uid_musicas_usuario'] = uid;
v_variaveis_javascript['id_campo_progresso_musicas_usuario'] = idcampo_2;

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_2, 0);

// carrega as musicas do usuario
executador_acao(null, 77, idcampo_1)

};
