<?php

// campo de navegação do perfil mobile
function campo_navegacao_perfil_mobile(){

// globals
global $variavel_campo;
global $idioma_sistema;

// id de usuario
$uid = retorne_idusuario_request();

// pagina inicial
$pagina_inicial[0] = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]";
$pagina_inicial[1] = PAGINA_INICIAL;

// classes
$classe[0] = "classe_perfil_basico_navega_perfil classe_cor_2";

// links
$link[0] = "<a href='$pagina_inicial[0]=7' title='$idioma_sistema[167]'>$idioma_sistema[167]</a>";
$link[1] = "<a href='$pagina_inicial[0]=82' title='$idioma_sistema[381]'>$idioma_sistema[381]</a>";
$link[2] = "<a href='$pagina_inicial[0]=78' title='$idioma_sistema[483]'>$idioma_sistema[483]</a>";
$link[3] = "<a href='$pagina_inicial[0]=104' title='$idioma_sistema[474]'>$idioma_sistema[474]</a>";
$link[4] = "<a href='$pagina_inicial[0]=9' title='$idioma_sistema[494]'>$idioma_sistema[494]</a>";
$link[5] = "<a href='$pagina_inicial[0]=98' title='$idioma_sistema[321]'>$idioma_sistema[321]</a>";
$link[6] = "<a href='$pagina_inicial[1]' title='$idioma_sistema[94]'>$idioma_sistema[94]</a>";
$link[7] = "<a href='$pagina_inicial[0]=108' title='$idioma_sistema[247]'>$idioma_sistema[247]</a>";

// campo para a alteração do idioma
$campo_idioma = constroe_alterar_idioma();

// html
$html = "
<div class='classe_perfil_basico_miniatura_campos_separa'>

<div class='$classe[0]'>$link[6]</div>
<div class='$classe[0]'>$link[0]</div>
<div class='$classe[0]'>$link[1]</div>
<div class='$classe[0]'>$link[2]</div>
<div class='$classe[0]'>$link[3]</div>
<div class='$classe[0]'>$link[4]</div>
<div class='$classe[0]'>$link[7]</div>
<div class='$classe[0]'>$link[5]</div>
<div class='$classe[0]'>$campo_idioma</div>

</div>
";

// html
$html = constroe_menu_suspense(false, null, true, 86, null, $html);

// html
$html = "
<div class='campo_opcoes_navegacao_perfil_mobile'>
$html
</div>
";

// retorno
return $html;

};

?>