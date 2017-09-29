<?php

// constroe configurar pagina
function constroe_configurar_pagina(){

// globals
global $idioma_sistema;

// conteudo
$conteudo[0] = constroe_opcoes_configuracoes_pagina();

// id de pagina
$id = retorne_idpagina_request();

// valida usuario logado dono da pagina
if(retorne_usuario_logado_dono_pagina($id) == false){
	
	// retorno nulo
	return null;
	
};

// valida modo de configuracao
switch(retorne_campo_formulario_request(46)){
	
	case 1:
	// titulo
	$titulo = $idioma_sistema[397];
	// conteudo
	$conteudo[1] = constroe_campo_alterar_url_usuario(true);
	break;
	
	case 2:
	// titulo
	$titulo = $idioma_sistema[398];
	// conteudo
	$conteudo[1] = constroe_imagem_redimensionar(1);
	break;
	
	case 3:
	// titulo
	$titulo = $idioma_sistema[269];
	// conteudo
	$conteudo[1] = campo_formulario_configuracoes_pagina();
	break;
	
	case 4:
	$titulo = $idioma_sistema[250];
	$conteudo[1] = campo_formulario_atualizar_pagina($id);
	break;
	
	case 5:
	$titulo = $idioma_sistema[272];
	$conteudo[1] = constroe_campo_excluir_pagina();
	break;
	
	default:
	// titulo
	$titulo = $idioma_sistema[397];
	// conteudo
	$conteudo[1] = constroe_campo_alterar_url_usuario(true);
	
};

// html
$html = "
<div class='classe_div_titulo_formulario_ed_perfil'>
$titulo
</div>


<div class='classe_div_campos_formulario_ed_perfil'>

<div class='classe_opcoes_configuracoes_perfil cor_borda_div'>
$conteudo[0]
</div>

<div class='classe_conteudo_configuracoes_perfil'>
$conteudo[1]
</div>

</div>
";

// retorno
return $html;

};

?>