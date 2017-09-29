<?php

// campo redimensionar imagem
function campo_redimensionar_imagem($conteudo, $modo){

// modo 0 imagem de perfil
// modo 1 imagem de capa

// globals
global $idioma_sistema;
global $variavel_campo;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){
	
	// retorno de conteudo original
	return $conteudo;
	
};

// id de campo
$idcampo[0] = codifica_md5("id_campo_redimensiona_imagem_".$modo.retorne_contador_iteracao().data_atual());

// eventos
$evento[0] = "onmousemove='opacidade_elemento(\"$idcampo[0]\", 0);'";
$evento[1] = "onmouseout='opacidade_elemento(\"$idcampo[0]\", 1);'";

// imagens
$imagem[0] = retorne_imagem_sistema(31, null, false);

// campos
$campo[0] = "
<div class='classe_campo_redimensionar_imagem_conteudo'>
$conteudo
</div>
";

// valida o modo
switch($modo){

	case 0:
	
	// url de link
	$url_link[0] = PAGINA_INICIAL."?".$variavel_campo[2]."=105";

	// imagem de perfil de pagina
	$campo_opcao[0] = "
	<span class='opcao_campo_redimensionar_imagem_opcoes_imagem'>
	<a href='$url_link[0]'>$imagem[0]</a>
	</span>
	
	<span class='opcao_campo_redimensionar_imagem_opcoes_descreve'>
	<a href='$url_link[0]'>$idioma_sistema[296]</a>
	</span>	
	";
	
	break;
	
	case 1:
	
	// url de link
	$url_link[0] = PAGINA_INICIAL."?".$variavel_campo[25]."=".retorne_idpagina_request()."&".$variavel_campo[6]."=".MODO_RECORTAR_IMAGEM_PAGINA;

	// imagem de perfil de pagina
	$campo_opcao[0] = "
	<span class='opcao_campo_redimensionar_imagem_opcoes_imagem'>
	<a href='$url_link[0]'>$imagem[0]</a>
	</span>
	
	<span class='opcao_campo_redimensionar_imagem_opcoes_descreve'>
	<a href='$url_link[0]'>$idioma_sistema[296]</a>
	</span>	
	";
	
	break;
	
};

// campos
$campo[1] = "
<div class='classe_campo_redimensionar_imagem_opcoes' id='$idcampo[0]'>
$campo_opcao[0]
</div>
";

// html
$html = "
<div class='classe_campo_redimensionar_imagem' $evento[0] $evento[1]>
$campo[0]
$campo[1]
</div>
";

// retorno
return $html;

};

?>