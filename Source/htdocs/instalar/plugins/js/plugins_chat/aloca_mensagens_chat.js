
// aloca as mensagens do chat
function aloca_mensagens_chat(dados){

// contador
var v_contador = 0;

// construindo atualizacoes de chat...
for(v_contador == v_contador; v_contador <= dados.length; v_contador++){
	
	// valida variavel d dados existe
	if(retorne_variavel_existe(dados[v_contador]) == true){
		
		// separa os dados
		var v_uid = dados[v_contador][0];

		// separa os dados
		var v_numero_mensagens = dados[v_contador][1];
		var v_numero_novas_mensagens = dados[v_contador][2];
		var v_numero_conversando = dados[v_contador][3];
		
		// valida id de usuario
		if(retorne_variavel_existe(v_uid) == true){

			// id de campos
			var v_idcampos = [];

			// id de campos
			v_idcampos[0] = v_variaveis_javascript['pcu_2'] + v_uid;
			v_idcampos[1] = v_variaveis_javascript['pcu_6'] + v_uid;
			v_idcampos[2] = v_variaveis_javascript['id_campo_numero_usuarios_abertos_chat'];

			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[0]) == true){
			
				// seta as mensagens
				carregar_mensagens_usuario_chat(v_uid, v_idcampos[0]);

			};
			
			// valida o numero de mensagens
			if(v_numero_mensagens == 0){
				
				// valida se elemento existe
				if(retorna_elemento_id_existe(v_idcampos[0]) == true){
			
					// limpa as conversas antigas...
					seta_valor_campo(v_idcampos[0], null, 1);
					
				};
				
			};
			
			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[1]) == true){
			
				// seta o numero de novas mensagens
				document.getElementById(v_idcampos[1]).innerHTML = v_numero_novas_mensagens;

			};
			
			// valida se elemento existe
			if(retorna_elemento_id_existe(v_idcampos[2]) == true){
			
				// seta o numero de usuarios abertos no chat
				document.getElementById(v_idcampos[2]).innerHTML = v_numero_conversando;

			};
			
			// oculta ou exibe a janela de usuarios abertos
			ocultar_janela_usuarios_abertos(v_numero_conversando);
			
		};
		
	};
	
};

};
