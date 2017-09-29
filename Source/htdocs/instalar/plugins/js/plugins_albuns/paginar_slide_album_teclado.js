
// pagina a imagem de album estilo slide via teclado
function paginar_slide_album_teclado(idcampo_1, uid, tecla){

// valida se algum conteudo editável mantem o foco
if(retorne_conteudo_editavel_mantem_foco() == true){
	
	// retorno nulo
	return null;
	
};

// modo padrao
var v_modo = -1;

// valida o modo mobile
if(v_variaveis_javascript['modo_mobile'] == 1){
	
	// valida tecla
	if(tecla == 37){
		
		var v_modo = 0;
		
	};

	// valida tecla
	if(tecla == 39){

		var v_modo = 1;	
		
	};

}else{
	
	// valida tecla
	if(tecla == 37 || tecla == 40){
		
		var v_modo = 0;
		
	};

	// valida tecla
	if(tecla == 39 || tecla == 38){

		var v_modo = 1;	
		
	};	
	
};

// valida o modo
if(v_modo == -1){

	// retorno nulo
	return null;

};
	
// id de imagem aberta
var id = v_array_ids_imagens_albuns_abertos[idcampo_1];

// paginando slide de imagem...
paginar_slide_album(id, v_modo, idcampo_1, uid);

};
