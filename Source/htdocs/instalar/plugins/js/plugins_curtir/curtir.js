
// curte
function curtir(tipo_campo, id, id_elemento, idusuario){

// seta o id temporario de post que sera curtido
v_variaveis_javascript['id_post'] = id;
v_variaveis_javascript['tabela_campo'] = tipo_campo;

// define o id de amigo
v_variaveis_javascript['uidamigo'] = idusuario;

// curtindo...
executador_acao(null, 23, id_elemento);

};
