
// exclui o relacionamento
function excluir_relacionamento(uidamigo, relacao){

// array de valores
var array_valores = [];

// atualizando array de valores
array_valores[0] = parseInt(uidamigo);
array_valores[1] = parseInt(relacao);

// excluindo relacionamento
executador_acao(array_valores, 118, null);

};
