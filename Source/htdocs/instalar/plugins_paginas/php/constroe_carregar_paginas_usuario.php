<?php

// constroe o carregar paginas de usuario
function constroe_carregar_paginas_usuario(){

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = retorna_idcampo_conteudo_geral();

// campo
$campo[0] = "
<div class='classe_paginas_criadas_usuario_titulo'>
$idioma_sistema[475]
</div>
";

// campos
$campo[1] = "
<div class='classe_paginas_criadas_usuario_lista' id='$idcampo[0]'></div>
";

// campo paginar
$campo[2] = constroe_campo_paginar(null);

// html
$html = "
<div class='classe_paginas_criadas_usuario classe_cor_8'>
$campo[0]
$campo[1]
$campo[2]
</div>
";

// retorno
return $html;

};

?>