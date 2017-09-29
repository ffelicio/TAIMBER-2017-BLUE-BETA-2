<?php

// janela com usuarios abertos de chat
function janela_usuarios_abertos_chat(){

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = retorne_id_janela_usuarios_abertos_chat(1);
$idcampo[1] = PREFIXO_CHAT_ABERTOS_NUMERO_6;
$idcampo[2] = retorne_id_janela_usuarios_abertos_chat(0);

// campo de progresso
$campo_progresso[0] = campo_progresso_gif(null);

// html
$html = "
<div class='classe_janela_usuarios_abertos_chat classe_chat_cor_1' id='$idcampo[2]'>

<div class='classe_janela_usuarios_abertos_chat_topo classe_cor_1'>
<span>$idioma_sistema[234]</span>
<span id='$idcampo[1]'>$campo_progresso[0]</span>
</div>

<div class='classe_janela_usuarios_abertos_chat_usuarios' id='$idcampo[0]'></div>
</div>
";

// retorno
return $html;

};

?>