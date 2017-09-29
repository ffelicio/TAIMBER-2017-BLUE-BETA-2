
// oculta elementos do chat ao digitar
function ocultar_elementos_chat_digitar(modo, idcampo_1){

// modo 0 oculta
// modo 1 exibe

// atualiza variaveis globais
v_variaveis_javascript['elementos_ocultos_chat'] = modo;

// valida o modo
switch(parseInt(modo)){
	
	case 0:
	oculta_exibe_elemento_idcampo(idcampo_1, null);
	break;
	
	case 1:
	oculta_exibe_elemento_idcampo(idcampo_1, 1);
	break;
	
};

};
