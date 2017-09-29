<?php

// constroe a pagina em miniatura
function constroe_pagina_miniatura($dados, $dados_perfil, $modo, $modo_perfil){

// globals
global $idioma_sistema;

// modo true carrega as paginas criadas
// modo false carrega as paginas curtidas

// valida o modo
if($modo == true){
	
	// id da pagina
	$id = $dados_perfil["id"];
	
}else{
	
	// define o id da pagina
    $id = $dados[PAGINA];

	// dados da pagina
    $dados_perfil = retorne_dados_perfil_pagina($id);	
	
};

// valida id
if($id == null){
	
	// retorno nulo
    return null;
	
};

// separa os dados
$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];

// numero de inscritos
$numero_inscritos = retorne_numero_inscritos_pagina($id);

// singular ou plural
if($numero_inscritos > 1){
	
	// numero de inscritos
	$numero_inscritos = retorne_tamanho_resultado($numero_inscritos).$idioma_sistema[506];
	
}else{
	
	// numero de inscritos
	$numero_inscritos .= $idioma_sistema[507];
	
};

// imagem de perfil de pagina
$imagem_perfil = retorne_imagem_perfil_pagina($id, false);

// adiciona link ao titulo da pagina
$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);

// valida modo perfil
if($modo_perfil == true){
	
	// campos
	$campo[0] = "
	
	<div class='classe_pagina_miniatura_conteudo_pesquisa'>

	<div class='classe_pagina_miniatura_titulo'>
	
	<div class='classe_pagina_miniatura_titulo_titulo'>
	$titulo_da_pagina
	</div>
	
	<div class='classe_pagina_miniatura_titulo_inscritos classe_cor_15'>
	$numero_inscritos
	</div>
	
	</div>

	</div>
	
	";
	
}else{

	// campos
	$campo[0] = "
	
	<div class='classe_pagina_miniatura_conteudo'>

	<div class='classe_pagina_miniatura_titulo'>
	
	<div class='classe_pagina_miniatura_titulo_titulo'>
	$titulo_da_pagina
	</div>
	
	<div class='classe_pagina_miniatura_titulo_inscritos classe_cor_15'>
	$numero_inscritos
	</div>
	
	</div>

	</div>
	
	";

};

// html
$html = "
<div class='classe_pagina_miniatura'>

<div class='classe_pagina_miniatura_imagem'>
$imagem_perfil
</div>

$campo[0]

</div>
";

// retorno
return $html;

};

?>