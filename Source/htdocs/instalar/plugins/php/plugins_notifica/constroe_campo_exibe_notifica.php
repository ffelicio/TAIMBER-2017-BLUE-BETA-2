<?php

// constroe o campo de exibicao de notificacoes
function constroe_campo_exibe_notifica(){

// globals
global $idioma_sistema;

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// id de campo geral
$idcampo[0] = retorna_idcampo_conteudo_geral();
$idcampo[1] = retorna_idcampo_progresso_gif_geral();

// eventos
$evento[0] = "onclick='executador_acao(null, \"$tipo_acao\", \"$idcampo[0]\");'";

// campo de progresso
$barra_progresso[0] = campo_progresso_gif($idcampo[1]);

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// imagens
$imagem[0] = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());

// campos
$campo[0] = "
<div class='classe_exibe_notificacoes_usuario_usuario classe_cor_2'>

<div class='classe_exibe_notificacoes_usuario_usuario_imagem'>
$imagem[0]
</div>

<div class='classe_exibe_notificacoes_usuario_usuario_texto'>
$idioma_sistema[281]$nome_usuario$idioma_sistema[282]
</div>

</div>
";

// adiciona a div de conteudo
$html = "
<div class='classe_exibe_notificacoes_usuario'>

$campo[0]

<div class='classe_lista_notifica_usuario' id='$idcampo[0]'></div>

<div class='classe_exibe_notificacoes_usuario_progresso'>
$barra_progresso[0]
</div>

<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>

</div>
";
	
// retorno
return $html;

};

?>