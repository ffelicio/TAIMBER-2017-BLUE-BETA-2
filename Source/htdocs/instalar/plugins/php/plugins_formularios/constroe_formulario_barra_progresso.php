<?php

// constroe o formulario com barra de progresso
function constroe_formulario_barra_progresso($url_envio, $id_formulario, $nome_file, $tipo_pagina, $multiplo, $tipo_arquivo){

// globals
global $idioma_sistema;
global $variavel_campo;
global $extensao_formulario;

# >> isto evita erro de nomes nos formularios <<
$numero_nome_funcao = $tipo_pagina.retorne_contador_iteracao();

// tipo de arquivo aceito
switch($tipo_arquivo){

    case 1:
    $tipo_arquivo = $extensao_formulario[0];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(2, null, false);
    break;

    case 2:
    $tipo_arquivo = $extensao_formulario[1];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(34, null, false);
    break;

    case 3:
    $tipo_arquivo = $extensao_formulario[2];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(111, null, false);
    break;
	
};

// valida o tipo da pagina
switch($tipo_pagina){
	
	case 6:
	// id da pagina
    $id = retorne_idpagina_request();
	
	// campos extras
	$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	break;
	
	case 53:
	// id da pagina
    $id = retorne_idpagina_request();
	
	// campos extras
	$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	break;

	case 55:
	
	// id da pagina
    $id = retorne_idpagina_request();
	
	// campos extras
	$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	
	break;
	
	case 114:
	
	// gera uma chave aleatoria
	$chave = gera_chave_aleatoria();

	// campos extras
	$campos_extras .= "
	<input type='hidden' value='$chave' name='$variavel_campo[3]'>
	";
	
	break;
	
};

// id de campo de porcentagem
$id_porcentagem = codifica_md5("porcentagem".$numero_nome_funcao);
$id_campo_file = codifica_md5("campo_file".$numero_nome_funcao);
$id_div_progresso = codifica_md5("campo_div_progresso".$numero_nome_funcao);
$id_div_botao_upload = codifica_md5("campo_botao_upload".$numero_nome_funcao);

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
<div class='classe_div_formulario_progresso'>
<form action='$url_envio' method='post' enctype='multipart/form-data' id='$id_formulario'>
<input type='file' id='$id_campo_file' name='$nome_file' $evento[1] $tipo_arquivo $multiplo>

<div class='classe_exibe_barra_progresso_formulario' id='$id_div_progresso'>
<progress value='0' max='100'></progress>
<span id='$id_porcentagem' class='classe_barra_progresso_formulario_span'>0%</span>
<input type='hidden' name='$variavel_campo[2]' value='$tipo_pagina'>
$campos_extras
</div>

<div class='classe_div_botao_upload_formulario_progresso' id='$id_div_botao_upload'>

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
location.reload();
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
document.getElementById('$id_div_botao_upload').style.display = 'none';

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