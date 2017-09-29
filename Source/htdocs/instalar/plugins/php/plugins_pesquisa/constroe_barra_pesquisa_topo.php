<?php

// barra de pesquisa do topo
function constroe_barra_pesquisa_topo(){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// pagina inicial
$pagina_inicial = PAGINA_INICIAL."?$variavel_campo[2]=106&$variavel_campo[8]=$idioma_sistema[299]";

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida modo mobile
if($modo_mobile == true){
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(68, null, false);

	// html
	$html = "
	
	<div class='classe_pesquisa_topo_mobile'>
	<a href='$pagina_inicial'>
	$imagem_sistema[0]
	</a>
	</div>
	
	";
	
	// retorno
	return $html;
	
};

// id de campo
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();

// link
$link[0] = "<a href='$pagina_inicial' title='$idioma_sistema[485]'>$idioma_sistema[485]</a>";

// funcao
$funcao[0] = "carregar_visualizador_pesquisa_geral(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"\", \"\", 1);";
$funcao[1] = "exibe_visualizador_pesquisa_geral(\"classe_div_menu_suspense\", \"$idcampo[3]\", true)";
$funcao[2] = "exibe_visualizador_pesquisa_geral(\"classe_div_menu_suspense\", \"$idcampo[3]\", false)";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";

// progresso
$progresso[0] = campo_progresso_gif($idcampo[1]);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(74, null, false);

// scripts
$script[0] = "
<script>

// oculta
$(document).click(function() {
    
	$funcao[2]
	
});


// exibe
$('#$idcampo[4]').click(function(event) {
    
	$funcao[1]
	
    event.stopPropagation();
	
});

</script>
";

// campos
$campo[0] = "
<div class='classe_barra_pesquisa_topo_entrada'>
$imagem_sistema[0]
<input type='text' placeholder='$idioma_sistema[484]' id='$idcampo[2]' onkeyup='$funcao[0]' $evento[1]>
</div>

$script[0]
";

// campos
$campo[1] = "
<div class='classe_barra_pesquisa_topo_resultados cor_borda_div_4' id='$idcampo[3]'>

<div class='classe_barra_pesquisa_topo_resultados_opcoes classe_cor_3 classe_cor_8'>

<div class='classe_barra_pesquisa_topo_resultados_opcoes_progresso'>
$progresso[0]
</div>

<div class='classe_barra_pesquisa_topo_resultados_opcoes_links'>
$link[0]
</div>

</div>

<div class='classe_barra_pesquisa_topo_resultados_usuarios' id='$idcampo[0]'></div>

<span class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</span>

</div>
";

// html
$html = "
<div class='classe_barra_pesquisa_topo' id='$idcampo[4]'>
$campo[0]
$campo[1]
</div>
";

// retorno
return $html;

};

?>