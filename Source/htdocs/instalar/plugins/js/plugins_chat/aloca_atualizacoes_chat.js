
// aloca as atualizacoes do chat nos devidos lugares
function aloca_atualizacoes_chat(dados, mensagens){

// contador
var v_contador = 0;

// aloca as mensagens do chat
aloca_mensagens_chat(mensagens);

// construindo atualizacoes de chat...
for(v_contador == v_contador; v_contador <= dados.length; v_contador++){
	
	// valida variavel d dados existe
	if(retorne_variavel_existe(dados[v_contador]) == true){
		
		// separa os dados
		var v_uid = dados[v_contador][0];
		var v_online = dados[v_contador][1];
		var v_numero_online = dados[v_contador][2];

		// valida id de usuario
		if(retorne_variavel_existe(v_uid) == true){

			// id de campos
			var v_idcampos = [];

			// id de campos
			v_idcampos[0] = v_variaveis_javascript['pcu_0'] + v_uid;
			v_idcampos[1] = v_variaveis_javascript['pcu_5'] + v_uid;
			v_idcampos[2] = v_variaveis_javascript['pcu_4'];
			v_idcampos[3] = v_variaveis_javascript['pcu_7'];
			
			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[0]) == true){
			
				// setando imagem de online
				document.getElementById(v_idcampos[0]).innerHTML = v_online;

			};
			
			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[1]) == true){
			
				// setando imagem de online
				document.getElementById(v_idcampos[1]).innerHTML = v_online;

			};

			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[2]) == true){
			
				// seta o numero de usuarios online
				document.getElementById(v_idcampos[2]).innerHTML = v_numero_online;
				
			};
			
			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[3]) == true){
			
				// seta o numero de usuarios online
				document.getElementById(v_idcampos[3]).innerHTML = v_numero_online;
				
			};
			
		};
		
	};
	
};

};
