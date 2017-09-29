
// exclui musica de usuario
function excluir_musica_usuario(id, idcampo_1, idcampo_2){

// atualiza as variaveis globais
v_variaveis_javascript['id_musica_excluir'] = id;

// remove campo com a musica
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_2);

// removendo musica
executador_acao(null, 79, idcampo_1);

};
