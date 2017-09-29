
// carrega os comentarios
function carregar_comentarios(tipo_campo, idpost, idcampo_1, idcampo_2, idcampo_3){

// array de valores
var array_valores = [];

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_3, 0);

// exibe o paginador
document.getElementById(idcampo_2).style.display = "block";

// informa o campo de paginacao de comentario atual
v_variaveis_javascript['campo_comentario_paginacao_atual'] = idcampo_2;

// define a tabela do comentario
v_variaveis_javascript['tabela_campo'] = tipo_campo;

// define o id de post
v_variaveis_javascript['comentario_idpostar'] = idpost;

// atualiza o array de valores
array_valores[0] = idcampo_3;

// carrega os comentarios
executador_acao(array_valores, 19, idcampo_1);

};
