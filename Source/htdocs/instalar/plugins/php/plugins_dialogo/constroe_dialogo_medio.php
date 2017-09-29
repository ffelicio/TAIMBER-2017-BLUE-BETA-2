<?php

// constroe dialogo medio
function constroe_dialogo_medio($titulo_janela, $conteudo_dialogo, $dialogo_id){

// imagem de sistema
$imagem[0] = retorne_imagem_sistema(80, null, false);

// botao fechar
$botao_fechar = "
<span class='span_botao_fechar_mensagem_dialogo_medio' onclick='exibe_dialogo(\"$dialogo_id\");'>
$imagem[0]
</span>
";

// html
$html = "
<div id=\"$dialogo_id\" class='div_janela_principal_mensagem_dialogo_medio'>
<div class='div_janela_mensagem_dialogo_medio'>

<div class='div_janela_mensagem_dialogo_titulo_medio classe_cor_1'>
$botao_fechar
$titulo_janela
</div>

<div class='div_janela_mensagem_conteudo_medio'>
$conteudo_dialogo
</div>

</div>
</div>
";

// retorno
return $html;

};

?>