
// marca o usuario
function marcar_usuario(uidamigo, chave, modo, idcampo_1){

// seta valores de variaveis globais
v_variaveis_javascript['idusuario_marcar'] = uidamigo;
v_variaveis_javascript['chave_marcar_usuario'] = chave;
v_variaveis_javascript['marcar_usuario_modo'] = modo;

// marca usuario
executador_acao(null, 38, idcampo_1);

};
