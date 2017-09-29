<?php

// constroe o amigo marcado
function constroe_uidamigo_marcado($uidamigo, $chave){

// perfil de usuario
$perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);

// campo marcador
$campo_marcador = constroe_campo_marcador_usuario($uidamigo, $chave, sessao_marcador_usuario_seta_retorna(null, null, $chave, $uidamigo, 3), true);

// html
$html = "
<div class='classe_campo_marcar_usuario classe_cor_8'>
<div class='classe_campo_marcar_usuario_perfil'>
$perfil_usuario
</div>
$campo_marcador
</div>
";

// retorno
return $html;

};

?>