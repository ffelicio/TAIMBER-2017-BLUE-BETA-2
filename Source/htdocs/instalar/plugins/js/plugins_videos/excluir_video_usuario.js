
// exclui video de usuario
function excluir_video_usuario(id, idcampo_1, idcampo_2){

// atualiza as variaveis globais
v_variaveis_javascript['id_video_excluir'] = id;

// remove campo com a video
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_2);

// removendo video
executador_acao(null, 81, idcampo_1);

};
