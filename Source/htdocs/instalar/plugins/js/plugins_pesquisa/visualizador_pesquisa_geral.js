
// exibe o menu com resultados de pesquisa de topo
function exibe_visualizador_pesquisa_geral(classe_1, idcampo_1, modo){

// valida o modo
if(modo == true){
	
	// exibe elemento
	exibe_elemento_oculto(idcampo_1, 0);
	
}else{
	
	// oculta os menus de suspense abertos
	ocultar_elementos_classe(classe_1);
	
	// oculta elemento
	exibe_elemento_oculto(idcampo_1, null);
	
};

};
