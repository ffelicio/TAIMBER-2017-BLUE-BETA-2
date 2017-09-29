
// abrir menu de suspense
function abrir_menu_suspense(modo_topo, menu_id, element, modo){

// oculta outros menus da mesma classe
ocultar_elementos_classe("classe_div_menu_suspense");
ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");

// obtendo posicoes
var v_posicao = $(element).position();

// valida o modo
if(modo == true){

	// setando coordendas
	var x = element.offsetTop - 5;
	var y = element.offsetLeft + 0;	
	
}else{
	
	// setando coordendas
	var x = element.offsetTop - 5;
	var y = element.offsetLeft - 193;
	
};

// valida o modo topo
if(modo_topo == true){
	
	// setando coordendas
	var x = element.offsetTop - 225;	
	
};

// criando novo elemento
var v_elemento = document.getElementById(menu_id);

// setando coordenadas
v_elemento.style.display = "table";
v_elemento.style.position = "absolute";
v_elemento.style.left = y + "px";
v_elemento.style.top = x + "px";

};
