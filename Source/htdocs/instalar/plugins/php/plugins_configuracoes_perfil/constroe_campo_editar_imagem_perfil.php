<?php

// constroe o campo editar imagem de perfil
function constroe_campo_editar_imagem_perfil(){

// id de usuario logado
$uid = retorne_idusuario_logado();

// dados de imagem
$dados = retorne_dados_imagem_usuario(0, $uid);

// campos
$campo[0] = campo_recortar_imagem($dados, 0);

// html
$html = "
<div class='classe_conteudo_centro_padrao'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>