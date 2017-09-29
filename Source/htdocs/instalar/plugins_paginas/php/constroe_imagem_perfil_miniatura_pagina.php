<?php

// constroe a imagem de perfil em miniatura de pagina
function constroe_imagem_perfil_miniatura_pagina($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[20];

// query
$query = "select *from $tabela where id='$id';";

// dados de perfil
$dados_perfil = retorne_dados_perfil_pagina($id);

// dados de imagem
$dados_imagem = plugin_executa_query($query);

// separa os dados
$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];
$url_host_miniatura = $dados_imagem["dados"][0][URL_HOST_MINIATURA];

// imagem da pagina
$imagem[0] = "
<img src='$url_host_miniatura' title='$titulo_da_pagina' alt='$titulo_da_pagina'>
";

// adiciona o link da pagina na imagem de perfil
$imagem[0] = retorne_link_pagina($id, $titulo_da_pagina, $imagem[0]);

// html
$html = "

<div class='classe_div_imagem_perfil_miniatura_div_img'>
$imagem[0]
</div>

";

// html
$html = "
<div class='classe_div_imagem_perfil_miniatura'>
$html
</div>
";

// retorno
return $html;

};

?>