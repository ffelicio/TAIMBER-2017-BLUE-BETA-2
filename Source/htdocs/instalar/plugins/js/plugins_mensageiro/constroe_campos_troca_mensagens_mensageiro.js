
// constroe campos de troca de mensagem de mensageiro
function constroe_campos_troca_mensagens_mensageiro(uid, idcampo_1){

// array de valores
var array_valores = [];

// converte uid de usuario para numero
array_valores[0] = parseInt(uid);

// construindo campos de troca de mensagens de mensageiro
executador_acao(array_valores, 112, idcampo_1);

};
