<?php

// constroe o campo de notificacao de relacionamento
function constroe_campo_notifica_relacionamento(){

// globals
global $pagina_inicial;
global $variavel_campo;

// url de inicio
$url_inicio = $pagina_inicial."?$variavel_campo[2]=109";

// numero de relacionamentos a serem aceitos
$numero_aceitar = retorne_tamanho_resultado(retorne_numero_relacionamentos_aceitar());

// links
$link[0] = "<a href='$url_inicio' title='$idioma_sistema[539]'>$numero_aceitar</a>";

// id de campos
$idcampo[0] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "atualiza_notifica_relacionamento(\"$idcampo[0]\");";

// timer
$timer[0] = plugin_timer_sistema(2, $funcao[0]);

// scripts
$script[0] = "
<script>
	$funcao[0]
</script>
";

// html
$html = "
<div class='classe_div_opcao_menu_suspense'>

	<span class='classe_span_opcao_notifica' id='$idcampo[0]'>
		$link[0]
	</span>

</div>

$script[0]
$timer[0]
";

// retorno
return $html;

};

?>