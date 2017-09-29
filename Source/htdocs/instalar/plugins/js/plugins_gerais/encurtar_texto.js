
// encutador de texto
function encurtar_texto(idcampo_1, idcampo_2, idcampo_3, modo){

// valida modo
if(modo == true){
	
	// oculta e exibe
	oculta_exibe_elemento_idcampo(idcampo_1, null);
	oculta_exibe_elemento_idcampo(idcampo_2, 0);
	oculta_exibe_elemento_idcampo(idcampo_3, 0);
	
}else{
	
	// oculta e exibe
	oculta_exibe_elemento_idcampo(idcampo_1, 0);
	oculta_exibe_elemento_idcampo(idcampo_2, null);
	oculta_exibe_elemento_idcampo(idcampo_3, 0);
	
};

};
