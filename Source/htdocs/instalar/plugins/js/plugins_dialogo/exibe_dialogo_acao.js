
// exibe o menu de acao
function exibe_menu_acao(menu_id, element){

// oculta outros menus da mesma classe
ocultar_elementos_classe("classe_div_menu_suspense");
ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");

// obtendo posicoes
var v_posicao = $(element).position();
var x = element.offsetTop + 3;
var y = element.offsetLeft;

// criando novo elemento
var v_elemento = document.getElementById(menu_id);

// setando coordenadas
v_elemento.style.display = "table";
v_elemento.style.position = "absolute";
v_elemento.style.left = y + "px";
v_elemento.style.top = x + "px";

};
