
// pesquisa algo que sera marcado
function pesquisar_marcador(idcampo_entrada, idcampo_resultados, idcampo_balao, chave, id, tabela_campo){

// nao deixar id como nulo
if(id.length == 0){

    // valor padrao
    id = -1;	
	
};

// atualiza variaveis globais
v_variaveis_javascript['termo_pesquisa_marcador'] = document.getElementById(idcampo_entrada).value;
v_variaveis_javascript['idcampo_balao_notifica_marcador'] = idcampo_balao;
v_marcadores_usuario[idcampo_resultados] = chave;
v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados'] = idcampo_resultados;
v_variaveis_javascript['id_publicacao_campo_marcar'] = id;
v_variaveis_javascript['tabela_campo_marcar'] = tabela_campo;

// valida termo de pesquisa
if(v_variaveis_javascript['termo_pesquisa_marcador'].length == 0){

    // retorno nulo	
    return null;
	
};

// pesquisa termo
executador_acao(null, 37, idcampo_resultados);

};
