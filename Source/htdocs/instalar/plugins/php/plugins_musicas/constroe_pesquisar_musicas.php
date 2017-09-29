<?php

// constroe o campo de pesquisa de musicas
function constroe_pesquisar_musicas(){

// globals
global $idioma_sistema;
global $url_link_acao;
global $pagina_inicial;
global $variavel_campo;

// id de usuario
$uid = retorne_idusuario_request();

// id de campos
$idcampo[0] = codifica_md5("id_campo_pesquisa_musica_entrada_".retorne_contador_iteracao());
$idcampo[1] = retorna_idcampo_conteudo_geral();
$idcampo[2] = codifica_md5("id_campo_pesquisa_musica_progresso_".retorne_contador_iteracao());
$idcampo[3] = codifica_md5("id_campo_pesquisa_musica_informacoes_".retorne_contador_iteracao());

// barra de progresso
$barra_progresso[0] = campo_progresso_gif($idcampo[2]);

// funcoes
$funcao[0] = "pesquisar_musicas_usuarios(\"$idcampo[0]\", \"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\");";

// eventos
$evento[0] = "onkeyup='$funcao[0]'";
$evento[1] = "onclick='$funcao[0]'";

// scripts
$script[0] = "
<script>
$funcao[0]
</script>
";

// nome de musica a pesquisar
$musica = retorne_campo_formulario_request(42);

// campo de upload
$campo_musica = constroe_campo_anexar_musica(false, null);

// separando campos
$campo_musica_html = $campo_musica["html"];
$campo_musica_dialogo = $campo_musica["dialogo"];

// numero de musicas
$numero_musicas = retorne_tamanho_resultado(retorne_numero_musicas_usuario(retorne_idusuario_request()));

// links
$link[0] = "<a href='$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=78' title='$idioma_sistema[368]'>$idioma_sistema[368] - $numero_musicas</a>";

// campos
$campo[0] = "
<div class='classe_pesquisa_musicas_entrada'>

<div class='classe_pesquisa_musicas_div_entrada_caixa_texto'>
<input type='text' placeholder='$idioma_sistema[363]' id='$idcampo[0]' value='$musica' $evento[0]>
</div>

<div class='classe_pesquisa_musicas_div_entrada_botao'>
<input type='button' value='$idioma_sistema[66]' $evento[1]>
</div>

</div>
";

// id de campos
$campo[1] = "
<div class='classe_resultados_pesquisa_musicas' id='$idcampo[1]'></div>
";

$campo[2] = "
<div class='classe_resultados_pesquisa_progresso'>$barra_progresso[0]</div>
";

// campo paginador
$campo[3] = "
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[1]>
$idioma_sistema[61]
</div>
";

// exibe numero de resultados de musicas etc
$campo[4] = "
<div class='classe_pesquisa_musicas_informacoes classe_cor_5' id='$idcampo[3]'></div>
";

// campos
$campo[5] = "
<div class='classe_pesquisa_musicas_links_1'>

<div class='classe_pesquisa_musicas_links_separa'>
$link[0]
</div>

</div>

<div class='classe_pesquisa_musicas_links_2'>
$campo_musica_html
</div>

$campo_musica_dialogo
";

// html
$html = "
<div class='classe_pesquisa_musicas'>

$campo[0]
$campo[5]
$campo[1]
$campo[2]
$campo[4]
$campo[3]

</div>

$script[0]
";

// retorno
return constroe_conteudo_padrao(true, $html, null);

};

?>