<?php

// constroe o visualizador de amigos de perfil
function constroe_visualizador_amigos_perfil(){

// globals
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;

// id de usuario
$uid = retorne_idusuario_request();

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com dados de amigos
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_dados_amigos);

// carrega a lista de amigos
$lista_amigos = carregar_lista_amigos_perfil_basico($array_dados_amigos, $uid);

// valida numero de amigos
if($numero_amigos > 1){

    // numero de amigos de usuario
    $numero_amigos = retorne_tamanho_resultado($numero_amigos).$idioma_sistema[58];

}else{
	
	// numero de amigos de usuario
	$numero_amigos = $numero_amigos.$idioma_sistema[59];
	
};

// url de index de inicio
$url_index_inicio = PAGINA_INDEX_INICIO;

// campos
$campo[0] = constroe_campo_visualizador_amigos_online();

// urls
$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=104";

// links
$link[0] = "<a href='$url[0]' title='$numero_amigos'>$numero_amigos</a>";

// campos amigos do perfil
$campo[1] = "
<div class='classe_div_visualizador_amigos_perfil'>

<div class='classe_div_visualizador_amigos_perfil_titulo classe_cor_29'>
$link[0]
$campo[0]
</div>

<div class='classe_div_visualizador_amigos_perfil_amigos'>
$lista_amigos
</div>

</div>
";

// html
$html = "
$campo[1]
";

// retorno
return $html;

};

?>