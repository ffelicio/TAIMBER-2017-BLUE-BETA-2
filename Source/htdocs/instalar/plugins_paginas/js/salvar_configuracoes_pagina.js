
// salva as configuracoes da pagina
function salvar_configuracoes_pagina(idcampo_1, modo, numero_campo, pagina){

// valor de configuracao
var v_valor_configuracao = obtem_valor_campo(idcampo_1, modo);

// valida valor e converte para numerico
if(v_valor_configuracao == true){
	
	// valor de configuracao
	v_valor_configuracao = 1;
	
}else{
	
	// valor de configuracao
	v_valor_configuracao = 0;
	
};

// seta valores globais
v_variaveis_javascript['valor_configuracao_pagina'] = v_valor_configuracao;
v_variaveis_javascript['numero_configuracao_pagina'] = numero_campo;
v_variaveis_javascript['id_pagina_salva_configuracao'] = pagina;

// salva configuracao de pagina...
executador_acao(null, 59, null);

};
