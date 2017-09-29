
// restaura a imagem de album de dados
// usado quando se pagina uma imagem via slide
function restaurar_imagem_album_dados(id, idcampo_1){

// array de valores
var array_valores = [];

// isto evita uma requeste desnecessária
if(retorne_variavel_existe((v_array_ids_imagens_albuns[idcampo_1])) == false){
	
	// retorno nulo
	return null;
	
}else{
	
	// remove variavei da memoria ao restaurar
	delete(v_array_ids_imagens_albuns[idcampo_1]);

};

// atualiza o array de valores
array_valores[0] = id;
array_valores[1] = idcampo_1;

// atualiza as variaveis globais
v_array_ids_imagens_albuns_abertos[idcampo_1] = id;

// restaurando...
executador_acao(array_valores, 126, idcampo_1);

};
