<?php

// constroe o formulario com barra de progresso de postagem
function constroe_formulario_barra_progresso_postagem($url_envio, $id_formulario, $nome_file, $tipo_pagina, $multiplo, $tipo_arquivo, $funcoes_javascript){

// globals
global $idioma_sistema;
global $variavel_campo;
global $extensao_formulario;

# >> isto evita erro de nomes nos formularios <<
$numero_nome_funcao = $tipo_pagina.retorne_contador_iteracao();

// id de campo de porcentagem
$id_porcentagem = codifica_md5("porcentagem".$numero_nome_funcao);
$id_campo_file = codifica_md5("campo_file".$numero_nome_funcao);
$id_div_progresso = codifica_md5("campo_div_progresso".$numero_nome_funcao);
$id_div_botao_upload = codifica_md5("campo_botao_upload".$numero_nome_funcao);

// retorna a chave de publicacao
$chave = retorna_seta_chave_publicacao(false);

// id de usuario amigo
$uidamigo = $_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT];

// valida uidamigo
if($uidamigo != null){
	
    // campo uidamigo
    $campo_uidamigo = "
    <input type='hidden' value='$uidamigo' name='$variavel_campo[5]'>
    ";

};

// valida modo pagina
if(retorne_modo_pagina() == true){
	
	// id de pagina
	$pagina = retorne_idpagina_request();

	// campo pagina
	$campo_pagina[0] = "
	<input type='hidden' value='$pagina' name='$variavel_campo[25]'>
	";
	
};

// tipo de arquivo aceito
switch($tipo_arquivo){

    case 1:
    $tipo_arquivo = $extensao_formulario[0];
    $campos_extras .= $campo_uidamigo;
	$imagem_botao = retorne_imagem_sistema(2, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_imagem";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;

    case 2:
    $tipo_arquivo = $extensao_formulario[1];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(34, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_musica";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;

    case 3:
    $tipo_arquivo = $extensao_formulario[2];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(37, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_video";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;

};

// valida usar multiplos arquivos
if($multiplo == true){
	
	// multiplos arquivos
    $multiplo = "multiple";
	
};

// funcoes
$funcao[0] = "simula_clique_file_formulario_barra_progresso_".$numero_nome_funcao."()";
$funcao[1] = "simula_enviar_formulario_barra_progresso_".$numero_nome_funcao."()";

// eventos
$evento[0] = "onclick='$funcao[0];'";
$evento[1] = "onchange='$funcao[1];'";

// campo formulario
$campo_formulario = "
<div class='classe_div_formulario_progresso_publicacao'>
<form action='$url_envio' method='post' enctype='multipart/form-data' id='$id_formulario'>
<input type='file' id='$id_campo_file' name='$nome_file' $evento[1] $tipo_arquivo $multiplo>

<div class='classe_exibe_barra_progresso_formulario_publicacao' id='$id_div_progresso'>
<progress value='0' max='100'></progress>
<span id='$id_porcentagem' class='classe_barra_progresso_formulario_span_publicacao'>0%</span>
<input type='hidden' name='$variavel_campo[2]' value='$tipo_pagina'>
$campos_extras
$campo_pagina[0]
</div>

<div class='classe_div_botao_upload_formulario_progresso_publicacao' id='$id_div_botao_upload'>
$campo_chave_publicacao
<div $evento[0]>$imagem_botao</div>
</div>

</form> 
</div>
";

// campo script
$campo_script = "
<script language='javascript'>

$('#$id_formulario').ajaxForm({uploadProgress: function(event, position, total, percentComplete){
	
$('progress').attr('value',percentComplete);
$('#$id_porcentagem').html(percentComplete+'%');

}, success: function(data){

$('progress').attr('value','100');
$('#$id_porcentagem').html('100%');
$('pre').html(data);
document.getElementById('$id_div_progresso').style.display = 'none';

$funcoes_javascript

}

});


// simula clique em campo file
function $funcao[0]{

// simula clique
$('#' + '$id_campo_file').click();

};


// simular envio de dados
function $funcao[1]{

// simula envio
$('#$id_formulario').submit();

// exibe e oculta divs
document.getElementById('$id_div_progresso').style.display = 'inline';

};


</script>
";

// html
$html = "
$campo_formulario
$campo_script
";

// retorno
return $html;

};

?>