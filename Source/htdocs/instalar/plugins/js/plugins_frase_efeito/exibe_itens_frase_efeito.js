
// exibe os itens ocultos da frase de efeito
function exibe_itens_frase_efeito(idcampo_1, idcampo_2){

// valida se o elemento já está visivel
if(retorne_elemento_visivel(idcampo_2) == true){
	
	// retorno nulo
	return null;
	
};

// exibe os itens
oculta_exibe_elemento_idcampo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_2, 0);

};
