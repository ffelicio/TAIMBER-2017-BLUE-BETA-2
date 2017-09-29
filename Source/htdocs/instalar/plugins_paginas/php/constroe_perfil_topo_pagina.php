<?php

// constroe o topo do perfil da pagina
function constroe_perfil_topo_pagina(){

// globals
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// id da pagina
$id = retorne_idpagina_request();

// usuario logado dono da pagina
$usuario_dono = retorne_usuario_logado_dono_pagina($id);

// dados da pagina
$dados[0] = retorne_dados_perfil_pagina($id);
$dados[1] = retorne_dados_cadastro_pagina($id);

// separa os dados
$titulo_da_pagina = $dados[0][TITULO_DA_PAGINA];
$descricao_da_pagina = converter_urls(false, $dados[0][DESCRICAO_DA_PAGINA]);
$web_site = converte_url_link($dados[0][WEB_SITE]);
$telefone = $dados[0][TELEFONE];
$data = converte_data_amigavel(true, $dados[1][DATA]);

// campo subtitulo
$campo[1] ="
<div class='classe_subtitulo_pagina_usuario classe_cor_2'>
$titulo_da_pagina
</div>
";

// descricao da pagina
$campo[2] = "
<div class='classe_descricao_pagina'>

<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[248]
</div>

<div class='classe_descricao_pagina_descreve'>
$descricao_da_pagina
</div>

</div>
";

// website da pagina
$campo[3] = "
<div class='classe_descricao_pagina'>

<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[249]
</div>

<div class='classe_descricao_pagina_descreve'>
$web_site
</div>

</div>
";

// valida usuario dono da pagina
if($usuario_dono == true){
	
	// campo link para configuracoes da pagina
	$campo[4] = $pagina_inicial."?$variavel_campo[25]=$id&&$variavel_campo[6]=2";

	// campo link para configuracoes da pagina
	$campo[4] = "
	<span class='classe_campo_editar_pagina_span'>
	<a href='$campo[4]' title='$idioma_sistema[269]'>$idioma_sistema[269]</a>
	</span>
	";

};

// telefone da pagina
$campo[5] = "
<div class='classe_descricao_pagina'>

<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[252]
</div>

<div class='classe_descricao_pagina_descreve'>
$telefone
</div>

</div>
";

// data da criacao da pagina
$campo[6] = "
<div class='classe_descricao_pagina'>

<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[253]
</div>

<div class='classe_descricao_pagina_descreve'>
$data
</div>

</div>
";

// imagem da capa
$campo[7] = constroe_capa_perfil_pagina_usuario();

// conteudo de topo de meio de pagina
$campo[8] = constroe_conteudo_topo_meio();

// campo com imagens de album
$campo[9] = constroe_campo_album_perfil_basico();

// campos
$campo[9] = "
<div class='classe_campo_imagens_topo_pagina'>
$campo[9]
</div>
";

// campos do perfil
$campos_perfil = "

<div class='classe_pagina_ultima_visualizacao_usuario'>
$campo[8]
</div>

<div class='classe_campo_editar_pagina'>
$campo[4]
</div>

$campo[9]
$campo[1]
$campo[2]
$campo[3]
$campo[5]
$campo[6]

";

// adiciona caixa
$campos_perfil = constroe_caixa(false, $campos_perfil);

// html
$html = "
$campo[7]
$campos_perfil
";

// retorno
return $html;

};

?>