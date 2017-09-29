
// altera o titulo ao atualizar as notificacoes
function altera_titulo_notifica(numero_notifica){

// converte para inteiro
numero_notifica = parseInt(numero_notifica);

// valida numero de notificacoes
if(numero_notifica > 0){
	
	// novo titulo da pagina
	var v_titulo = "(" + numero_notifica + ") - " + v_variaveis_javascript['titulo_pagina'];

}else{
	
	// novo titulo da pagina
	var v_titulo = v_variaveis_javascript['titulo_pagina'];

};

// atualizando o titulo
$('title').html(v_titulo);

};
