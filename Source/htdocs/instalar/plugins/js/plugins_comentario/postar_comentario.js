
// posta comentario
function postar_comentario(id_campo_entrada_comentario, id_visualizador_comentarios, tipo_campo, idpost, id_campo_numero_comentarios, id_campo_paginar_comentarios, idusuario, idcampo_1){

// comentario
var v_comentario = obtem_valor_campo(id_campo_entrada_comentario, 1);

// valida campo de entrada
if(v_comentario.length == 0){

    // move o foco
    document.getElementById(id_campo_entrada_comentario).focus();
	
	// retorno
	return null;
	
};

// define o comentario a ser postado
v_variaveis_javascript['comentario_postar'] = v_comentario;

// define a tabela do comentario
v_variaveis_javascript['tabela_campo'] = tipo_campo;

// define o id de post
v_variaveis_javascript['comentario_idpostar'] = idpost;

// id de campo com numero de comentarios
v_variaveis_javascript['campo_numero_comentarios'] = id_campo_numero_comentarios;

// define o id de amigo
v_variaveis_javascript['uidamigo'] = idusuario;

// limpa campos
seta_valor_campo(id_campo_entrada_comentario, null, 2);

// move o foco
document.getElementById(id_campo_entrada_comentario).focus();

// carrega os comentarios
carregar_comentarios(tipo_campo, idpost, id_visualizador_comentarios, id_campo_paginar_comentarios);

// array de valores
var array_valores = [];

// atualiza array com valores
array_valores[0] = idcampo_1;

// posta o comentario
executador_acao(array_valores, 18, id_visualizador_comentarios);

};
