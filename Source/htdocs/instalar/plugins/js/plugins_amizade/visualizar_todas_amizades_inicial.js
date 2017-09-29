
// carrega todas as amizades do inicio
function visualizar_todas_amizades_inicial(id_visualizador){

// limpa o parametro de pesquisa atual
altera_parametro_pesquisa_amigos(null, "id_campo_pesquisa_amigos_local");

// limpa termo de pesquisa atual
document.getElementById("id_campo_pesquisa_amigos_local").value = "";

// limpar dados antigos
$("#" + id_visualizador).html("");

// limpa nome de pesquisa de amigo local
v_variaveis_javascript['nome_pesquisa_amigo_local'] = "";

// carrega a lista de amigos
executador_acao(null, 15, id_visualizador);

// move o foco para o campo de pesquisa
document.getElementById("id_campo_pesquisa_amigos_local").focus();
	
};
