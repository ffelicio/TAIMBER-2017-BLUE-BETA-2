
// funcao para excluir capa de perfil ou pagina
function excluir_capa(pagina){

// array de valores
var array_valores = [];

// valida pagina
if(retorne_variavel_existe(pagina) == true){

	// atualizando array com valores
	array_valores[0] = parseInt(pagina);

}else{

	// atualizando array com valores
	array_valores[0] = null;		
	
};

// excluindo capa
executador_acao(array_valores, 67, null);

};
