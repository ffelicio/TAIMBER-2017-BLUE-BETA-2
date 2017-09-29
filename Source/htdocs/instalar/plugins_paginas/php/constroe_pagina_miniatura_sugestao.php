<?php

// constroe a pagina em miniatura de sugestao
function constroe_pagina_miniatura_sugestao($dados){

// globals
global $idioma_sistema;

// separando dados
$id = $dados["id"];
$uid = $dados[UID];
$titulo_da_pagina = $dados[TITULO_DA_PAGINA];
$descricao_da_pagina = $dados[DESCRICAO_DA_PAGINA];
$web_site = $dados[WEB_SITE];
$telefone = $dados[TELEFONE];

// valida id
if($id == null or retorne_idpagina_request() != null){
	
	// retorno nulo
	return null;
	
};

// imagem de perfil de pagina
$imagem_perfil = retorne_imagem_perfil_pagina($id, false);

// adiciona link ao titulo da pagina
$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);

// numero de inscritos da pagina
$numero_inscritos = retorne_numero_inscritos_pagina($id);

// valida numero de inscritos
if($numero_inscritos > 1){
	
	// textos
	$texto[0] = retorne_tamanho_resultado($numero_inscritos).$idioma_sistema[506];
	
}else{
	
	// textos
	$texto[0] = $numero_inscritos.$idioma_sistema[507];

};

// campos
$campo[0] = "
<div class='classe_pagina_miniatura_campo_inscrever'>

<span>
$titulo_da_pagina
</span>

<span class='classe_cor_15'>
$texto[0]
</span>

</div>
";

// html
$html = "
<div class='classe_pagina_miniatura_sugestao'>

<div class='classe_pagina_miniatura_imagem_sugestao'>
$imagem_perfil
</div>

$campo[0]

</div>
";

// retorno
return $html;

};

?>