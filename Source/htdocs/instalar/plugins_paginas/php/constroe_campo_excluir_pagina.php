<?php

// constroe campo excluir pagina
function constroe_campo_excluir_pagina(){

// globals
global $idioma_sistema;

// pagina
$pagina = retorne_idpagina_request();

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false){
	
	// retorno nulo
	return null;
	
};

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// mensagem
$mensagem[0] = $nome_usuario.$idioma_sistema[273];

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();

// eventos
$evento[0] = "onclick='excluir_pagina_usuario(\"$pagina\", \"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\");'";

// html
$html = "

<div class='classe_div_campo_excluir_pagina_separa'>
$mensagem[0]
</div>

<div class='classe_div_campo_excluir_pagina_separa'>

<div class='classe_div_campo_excluir_pagina_separa_campo' id='$idcampo[1]'></div>

<div class='classe_div_campo_excluir_pagina_separa_entrada'>
<input type='password' placeholder='$idioma_sistema[2]' id='$idcampo[0]'>
</div>

<div class='classe_div_campo_excluir_pagina_separa_botao' id='$idcampo[2]'>
<input type='button' value='$idioma_sistema[274]' $evento[0]>
</div>

</div>

";

// retorno
return $html;

};

?>