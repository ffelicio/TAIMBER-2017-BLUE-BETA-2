
// marcacoes concluidas
function marcacoes_concluidas(chave, identificador, modo){

// limpa resultados de pesquisa antigos
document.getElementById(v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados']).innerHTML = null;

// atualiza variaveis globais
v_variaveis_javascript['marcacoes_concluidas_modo'] = modo;

// oculta dialogo
exibe_dialogo(identificador);

// retorna os itens marcados
executador_acao(null, 39, v_variaveis_javascript['idcampo_balao_notifica_marcador']);

};
