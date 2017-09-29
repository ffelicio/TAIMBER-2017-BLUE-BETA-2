
// salva a url amigavel de perfil de usuario
function salvar_url_amigavel_usuario(idcampo_1, idcampo_2, modo){

// array com valores
var array_valores = [];

// setando valores de array de valores
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
array_valores[1] = parseInt(modo);

// salvando url amigavel
executador_acao(array_valores, 92, idcampo_2)

};
