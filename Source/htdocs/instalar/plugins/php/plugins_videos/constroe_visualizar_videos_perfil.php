<?php

// constroe o visualizador de videos de perfil
function constroe_visualizar_videos_perfil(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// id de usuario
$uid = retorne_idusuario_request();

// numero de videos de usuario
$numero_videos = retorne_tamanho_resultado(retorne_numero_videos_usuario($uid));

// tabela
$tabela = $tabela_banco[27];

// limit
$limit = "limit ".NUMERO_VIDEOS_CAMPO_PERFIL;

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// url de link
$link[0] = "$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=82";

// links
$link[0] = "
<a href='$link[0]' title='$numero_videos'>
$idioma_sistema[591]$numero_videos
</a>";

// campos
$campo[0] = "
<div class='classe_visualizador_video_perfil_basico_titulo'>
$link[0]
</div>
";

// campos
$campo[1] = constroe_player_playlist(false, $dados_query);

// html
$html = "
<div class='classe_videos_miniatura_perfil_usuario'>

<div class='classe_videos_miniatura_perfil_usuario'>

<div class='classe_numero_videos_perfil_usuario_topo'>
$campo[0]
</div>

</div>


<div class='classe_videos_miniatura_perfil_usuario_videos'>
$campo[1]
</div>

</div>
";

// retorno
return $html;

};

?>