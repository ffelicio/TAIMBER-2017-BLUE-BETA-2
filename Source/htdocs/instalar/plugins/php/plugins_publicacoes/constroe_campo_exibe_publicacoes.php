<?php

// constroe o campo de exibição de publicaoes
function constroe_campo_exibe_publicacoes($idcampo_1){

// globals
global $idioma_sistema;

// id de campos
$id_campos[0] = retorna_idcampo_conteudo_geral();
$id_campos[3] = $idcampo_1;
$id_campos[6] = retorna_idcampo_progresso_gif_geral();

// campo de progresso
$campo_progresso_gif[1] = campo_progresso_gif($id_campos[6]);

// id de usuario requeste
$uid = retorne_idusuario_request();

// id de pagina via requeste
$pagina = retorne_idpagina_request();

// valida modo pagina
if(retorne_modo_pagina() == true){

	// valida o numero de publicacoes e se o usuário é o dono da página
	if(retorne_numero_publicacoes_pagina($pagina) == 0 and retorne_usuario_dono_pagina($uid, $pagina) == false){
		
		// nome de pagina
		$nome_pagina = retorne_titulo_pagina_id($pagina);

		// texto
		$texto[0] = $idioma_sistema[326].$nome_pagina.$idioma_sistema[584];

		// adiciona mensagem
		$texto[0] = mensagem_sucesso($texto[0]);
		
	};
	
}else{
	
	// valida numero de publicacoes
	if(retorne_numero_publicacoes(null) == 0 and retorne_usuario_dono_perfil($uid) == false){

		// nome de usuario
		$nome_usuario = retorne_nome_usuario(true, $uid);
		
		// texto
		$texto[0] = $nome_usuario.$idioma_sistema[584];
		
		// adiciona mensagem
		$texto[0] = mensagem_sucesso($texto[0]);
		
	};

};

// campo de publicacoes
$html = "

<div class='classe_div_publicacoes_usuario_novas' id='$id_campos[3]'></div>
<div class='classe_div_publicacoes_usuario' id='$id_campos[0]'>
$texto[0]
</div>

$campo_progresso_gif[1]

";

// retorno
return $html;

};

?>