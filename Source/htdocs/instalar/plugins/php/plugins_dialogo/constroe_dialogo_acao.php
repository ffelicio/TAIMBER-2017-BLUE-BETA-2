<?php

// constroe um dialogo de acao
function constroe_dialogo_acao($titulo, $conteudo, $id_dialogo){

// eventos
$evento[0] = "onclick='fechar_menu_suspense(\"$id_dialogo\");'";

// html
$html = "
<div id='$id_dialogo' class='div_janela_mensagem_dialogo_acao classe_sombra_borda_1'>

<div class='div_janela_mensagem_dialogo_acao_fechar'>
<span $evento[0]>x</span>
</div>

<div class='div_janela_titulo_dialogo_acao'>
$titulo
</div>

<div class='div_janela_conteudo_dialogo_acao'>
$conteudo
</div>

</div>
";

// retorno
return $html;

};

?>