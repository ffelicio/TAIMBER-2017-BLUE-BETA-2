
// oculta ou exibe a janela de usuarios abertos
function ocultar_janela_usuarios_abertos(v_numero_conversando){

// valida numero de usuarios conversando e oculta ou exibe janela
if(v_numero_conversando > v_variaveis_javascript['numero_maximo_janelas_chat']){
	
	// exibe
    exibe_elemento_oculto(v_variaveis_javascript['id_lista_usuarios_abertos_chat'], 0);	

};

// valida numero de usuarios conversando e oculta ou exibe janela
if(v_numero_conversando == 0){
	
    // oculta
	exibe_elemento_oculto(v_variaveis_javascript['id_lista_usuarios_abertos_chat'], null);
	
};

};
