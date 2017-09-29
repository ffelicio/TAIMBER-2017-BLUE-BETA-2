<?php

// constroe a capa do perfil da pagina do usuario
function constroe_capa_perfil_pagina_usuario(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[21];

// id de pagina
$pagina = retorne_idpagina_request();

// usuario dono da pagina
$usuario_dono = retorne_usuario_dono_pagina(retorne_idusuario_request(), $pagina);

// query
$query = "select *from $tabela where id='$pagina';";

// dados
$dados = retorne_dados_query($query);

// url grande da imagem da capa
$url_host_grande = $dados[URL_HOST_GRANDE];

// variáveis de posição
$topo = $dados[TOPO]."px";

// valida usuario dono da página e capa foi definida
if($usuario_dono == false and $url_host_grande == null){

	// retorno nulo
	return null;
	
};

// valida usuario dono do perfil e capa foi definida
if($usuario_dono == true and $url_host_grande == null){

	// define a url de uma imagem padrão
	$url_host_grande = retorne_imagem_sistema(130, null, true);
	
};

// valida host de imagem
if($url_host_grande != null){
    
	// id de classe
	$classe_id[0] = retorne_idcampo_md5();

	// proprieades css
	$propriedade_css[0] = "

	background-image: url(\"$url_host_grande\");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 50% $topo;

	";

	// css
	$css[0] = constroe_css_manual(null, $classe_id[0], $propriedade_css[0]);

	// campos
	$campo[1] = "
	
	<div class='classe_div_capa_usuario_imagem_pagina' id='$classe_id[0]' title='$idioma_sistema[19]'>
	</div>
	
	$css[0]
	";
	
};

// valida se o usuário é o dono do perfil
if($usuario_dono == true){

	// constroe opcoes de capa
	$campo[0] = constroe_opcoes_capa(true, $classe_id[0], $dados);

};

// html
$html = "
<div class='classe_div_capa_usuario_pagina classe_cor_35'>
	$campo[0]
	$campo[1]
</div>
";

// retorno
return $html;

};

?>