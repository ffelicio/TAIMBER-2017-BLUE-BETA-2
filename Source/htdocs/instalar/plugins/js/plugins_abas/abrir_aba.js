
// funcao para abrir aba
function abrir_aba(idcampo_1, idcampo_2, classe_1, array_ids){

// percorrendo ids
for(i = 0; i <= array_ids.length; i++){
	
	// id
	var v_id = array_ids[i];
	
	// valida id
	if(retorna_elemento_id_existe(v_id) == true){
		
		// css de abas
		var aba_1 = $("#" + v_id).css('display').toLowerCase();
		var aba_2 = $("#" + idcampo_1).css('display').toLowerCase();
		
		// valida se está tentando ocultar a aba atual novamente
		if(idcampo_1 == v_id){
			
			// valida visibilidade da aba
			if(aba_1 != "table" && aba_2 != "table"){
				
				// exibe a aba oculta
				oculta_exibe_elemento_idcampo(v_id, 0);
				
			};

		}else{
		
			// oculta a aba em visualizacao
			oculta_exibe_elemento_idcampo(v_id, null);			
			
		};
		
	};

};

// seta uma classe em todos os elementos
seta_elementos_classe(classe_1, "classe_cor_4", "classe_cor_32");

// adiciona a cor da classe selecionada
$("#" + idcampo_2).addClass("classe_cor_4");

};
