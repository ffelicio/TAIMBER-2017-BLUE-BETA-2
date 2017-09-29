<?php

// constroe gerenciar plano de fundo
function constroe_gerenciar_plano_fundo(){

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "exibe_dialogo(\"$idcampo[0]\");";
$funcao[1] = "remover_plano_fundo_usuario();";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// dados de plano de fundo
$dados = retorne_dados_plano_fundo();

// separando dados
$url_host_miniatura = $dados[URL_HOST_MINIATURA];

// valida url host miniatura
if($url_host_miniatura == null){
	
	// retorno nulo
	return null;
	
};

// campos
$campo[0] = "
<div class='classe_imagem_apresenta_plano_fundo'>
<img src='$url_host_miniatura'>
</div>
";

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(95, null, false);

// campos
$campo[1] = "
<div class='classe_mensagem_dialogo_remover_plano_fundo_texto'>
$nome_usuario$idioma_sistema[532]
</div>

<div class='classe_mensagem_dialogo_remover_plano_fundo_botao'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";

// dialogo
$dialogo[0] = constroe_dialogo($idioma_sistema[533], $campo[1], $idcampo[0]);

// campos
$campo[1] = "
<div class='classe_opcao_gerenciar_plano_fundo' $evento[0]>
$imagem_sistema[0]
</div>
";

// campos
$campo[1] = "
<div class='classe_gerencia_plano_fundo_separa'>
$campo[1]
</div>
";

//  html
$html = "
<div class='classe_gerencia_plano_fundo'>
$campo[0]
$campo[1]
</div>

$dialogo[0]
";

// retorno
return $html;

};

?>