
// altera o parametro de pesquisa de amigos
function altera_parametro_pesquisa_amigos(conteudo, idcampo_1){

// limpando valores de pesquisa atual
seta_valor_campo(idcampo_1, null, 0);

// alterando o conteudo
v_variaveis_javascript['parametro_pesquisa_amigos'] = parseInt(conteudo);

};
