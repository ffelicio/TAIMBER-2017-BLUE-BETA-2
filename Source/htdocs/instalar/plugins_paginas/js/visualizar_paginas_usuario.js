
// visualiza as paginas criadas ou inscritas do usuario
function visualizar_paginas_usuario(modo, idcampo_1, idcampo_2, idcampo_3){

// modo 0 paginas que criou
// modo 1 paginas que se inscreveu
// modo 2 zerar contador
// modo 3 paginar

// atualiza variaveis globais
v_variaveis_javascript['modo_visualiza_paginas_usuario'] = modo;
	
// valida o modo
if(v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] != modo && modo != 3){

	// atualiza variaveis globais
    v_variaveis_javascript['modo_visualiza_paginas_usuario_paginar'] = modo;
	
    // atualiza o ultimo modo
	v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] = modo;

	// atualiza variaveis globais
    v_variaveis_javascript['modo_visualiza_paginas_usuario'] = 2;	

};

// atualiza variaveis globais
v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'] = idcampo_2;

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_2, 0);

// carrega as paginas
executador_acao(null, 58, idcampo_3);

};
