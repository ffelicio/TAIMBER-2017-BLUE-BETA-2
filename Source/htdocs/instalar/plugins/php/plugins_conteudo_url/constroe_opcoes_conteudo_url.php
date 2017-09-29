<?php

// constroe opcoes de conteudo de url
function constroe_opcoes_conteudo_url($chave, $idcampo_1, $modo, $idcampo_2){

// validar se é dono
// modo exibir opcoes ou nao

// globals
global $idioma_sistema;

// valida o modo
if($modo == false){
	
	// retorno nulo
	return null;
	
};

// id de campos
$idcampo[0] = retorne_idcampo_md5();

// imagem
$imagem[0] = retorne_imagem_sistema(36, null, false);

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// eventos
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='exclui_conteudo_url(\"$chave\", \"$idcampo_2\");'";

// campos
$campo[0] = "
<div class='classe_opcoes_conteudo_url_separa' $evento[0]>
$imagem[0]
</div>
";

// campos
$campo[1] = "
<div class='classe_opcoes_conteudo_url_separa_1'>
$nome_usuario$idioma_sistema[408]
</div>

<div class='classe_opcoes_conteudo_url_separa_2'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";

// adiciona o dialogo
$campo[1] = constroe_dialogo($idioma_sistema[409], $campo[1], $idcampo[0]);

// html
$html = "
<div class='classe_opcoes_conteudo_url'>
$campo[0]
</div>

$campo[1]
";

// retorno
return $html;

};

?>