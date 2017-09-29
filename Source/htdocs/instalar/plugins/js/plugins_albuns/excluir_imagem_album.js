
// exclui imagem de album
function excluir_imagem_album(idcampo_1, id, idcampo_2){

// array de valores
var array_valores = [];

// remove o dialogo de imagem
remove_elemento_id(idcampo_2);

// remove div com imagens
remove_elemento_id(idcampo_1);

// atualiza o array de valores
array_valores[0] = id;

// exclui imagem
executador_acao(array_valores, 11, null);

};
