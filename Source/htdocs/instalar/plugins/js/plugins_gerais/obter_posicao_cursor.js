
// obtem a posicao atual do cursor
function obter_posicao_cursor(idcampo_1, modo){

// modo true posicao inicial
// modo false posicao final

// valida o modo
if(modo == true){
	
	// retorno
	return $("#" + idcampo_1).prop("selectionStart");

}else{
	
	// retorno
	return $("#" + idcampo_1).prop("selectionEnd");
	
};

};
