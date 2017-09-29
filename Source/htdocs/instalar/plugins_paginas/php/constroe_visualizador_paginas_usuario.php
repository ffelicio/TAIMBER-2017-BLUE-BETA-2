<?php

// constroe o visualizador de paginas de usuario
function constroe_visualizador_paginas_usuario(){

// globals
global $idioma_sistema;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// modo
$modo = retorne_campo_formulario_request(6);

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "carregar_paginas_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\")";
$funcao[1] = "alterar_modo_pesquisa_paginas(\"$idcampo[3]\")";

// eventos
$evento[0] = "onkeyup='$funcao[0];'";

// numero de paginas
$numero_paginas_criadas = retorne_tamanho_resultado(retorne_numero_paginas_usuario($uid));
$numero_paginas_inscritas = retorne_tamanho_resultado(retorne_numero_paginas_inscritas_usuario($uid));

// array de opcoes
$array_options .= $numero_paginas_criadas.$idioma_sistema[236].",";
$array_options .= $numero_paginas_inscritas.$idioma_sistema[266].",";
$array_options .= $idioma_sistema[536];

// array de valores
$array_valores = "0,1,2";

// campo select option
$campo_select_option = gerador_select_option_especial($array_options, $array_valores, $modo, null, $idcampo[3], "$funcao[1], $funcao[0]");

// campos
$campo[0] = "
<div class='classe_opcoes_pesquisa_pagina_usuario classe_cor_2'>

<div class='classe_opcoes_pesquisa_pagina_usuario_separa1'>
<input type='text' placeholder='$idioma_sistema[535]' id='$idcampo[2]' $evento[0]>
</div>

<div class='classe_opcoes_pesquisa_pagina_usuario_separa2'>
$campo_select_option
</div>

</div>
";

// campo visualizador de paginas
$campo[1] = constroe_conteudo_padrao(false, null, $idcampo[0]);

// campo paginador
$campo[2] = constroe_paginador_padrao($idcampo[1], $funcao[0]);

// script para iniciar a primeira pesquisa
$script = "
<script>
$funcao[0];
</script>
";

// html
$html = "
$campo[0]
$campo[1]
$campo[2]

$script
";

// retorno
return constroe_conteudo_padrao(true, $html, null);

};

?>