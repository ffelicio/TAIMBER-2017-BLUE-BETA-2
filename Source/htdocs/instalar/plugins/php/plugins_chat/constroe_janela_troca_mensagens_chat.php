<?php

// constroe a janela de troca de mensagens de chat
function constroe_janela_troca_mensagens_chat(){

// id de campos
$idcampo[0] = retorne_id_janela_chat_mensagens();

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(16, null, false);

// html
$html = "
<div class='classe_janela_troca_mensagens classe_chat_cor_1' id='$idcampo[0]'>

<div class='classe_janela_troca_mensagens_barra_progresso'>
$imagem_sistema[0]
</div>

</div>
";

// retorno
return $html;

};

?>