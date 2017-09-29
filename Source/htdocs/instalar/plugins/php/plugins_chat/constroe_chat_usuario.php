<?php

// constroe o chat de usuario
function constroe_chat_usuario(){

// globals
global $idioma_sistema;

// valida pode construir o chat
if(retorne_pode_construir_chat() == false){
	
	// retorno nulo
	return null;
	
};

// id de usuario logado
$uid = retorne_idusuario_logado();

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_id_janela_principal_chat();
$idcampo[3] = PREFIXO_CHAT_USUARIO_ONLINE_4;
$idcampo[4] = PREFIXO_CHAT_USUARIO_ONLINE_6;
$idcampo[5] = retorne_idcampo_md5();
$idcampo[6] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "pesquisar_amigos_chat(\"$idcampo[0]\", \"$idcampo[1]\");";
$funcao[1] = "pesquisar_amigos_chat(null, \"$idcampo[1]\");";
$funcao[2] = "paginar_amigos_chat(\"$idcampo[1]\");";
$funcao[3] = "minimizar_chat_usuario(\"$idcampo[2]\", \"$idcampo[5]\");";
$funcao[4] = constroe_lista_inicializar_chat();

// eventos
$eventos[0] = "onkeyup='$funcao[0]'";
$eventos[1] = "onscroll='$funcao[1]'";
$eventos[2] = "onclick='$funcao[3]'";

// valida modo mobile
if($modo_mobile == true){

	// limpa evento	
	$eventos[2] = null;

};

// numero de amigos online
$numero_amigos_online = retorne_tamanho_resultado(retorna_numero_amigos_online($uid));

// executador
$executador[0] = "
<script language='javascript'>
\n
$funcao[3]
\n
$funcao[2]
\n
$funcao[4]
\n
</script>
";

// campo topo
$campo_topo = "
<div class='classe_chat_usuario_topo classe_cor_1' $eventos[2]>
<span>$idioma_sistema[229] - </span>
<span id='$idcampo[3]'>$numero_amigos_online</span>
</div>
";

// campo usuarios
$campo_usuarios = "
<div class='classe_chat_usuario_usuarios cor_borda_div' id='$idcampo[1]' $eventos[1]></div>
";

// campo pesquisa
$campo_pesquisa = "
<div class='classe_chat_pesquisa_amigos' id='$idcampo[6]'>
<input type='text' placeholder='$idioma_sistema[230]' id='$idcampo[0]' $eventos[0]>
</div>
";

// janela de troca de mensagens
$janela_troca_mensagens = constroe_janela_troca_mensagens_chat();

// campo atualizador de chat
$campo_atualizador[0] = "
\n
atualizador_chat_usuario();
\n
";

// adiciona o timer
$campo_atualizador[0] = plugin_timer_sistema(3, $campo_atualizador[0]);

// campo com usuarios abertos de chat
$campo_usuarios_abertos = janela_usuarios_abertos_chat();

// valida modo mobile
if($modo_mobile == false){
	
	// classe
	$classe[0] = "classe_chat_cor_1";

};

// imagem de perfil
$imagem_perfil = constroe_imagem_perfil_miniatura_sem_nome($uid, true);

// campos
$campo[0] = "
<div class='classe_abrir_chat_usuario classe_cor_34' id='$idcampo[5]' $eventos[2]>

<div class='classe_abrir_chat_usuario_perfil'>
$imagem_perfil
</div>

<div class='classe_abrir_chat_usuario_online'>

<span class='classe_cor_21'>
$idioma_sistema[232]
</span>

<span id='$idcampo[4]' class='classe_cor_21'>
$numero_amigos_online
</span>

</div>

</div>
";

// html
$html = "
$campo[0]

<div class='classe_chat_usuario $classe[0]' id='$idcampo[2]'>
$campo_topo
$campo_usuarios
$campo_pesquisa
</div>

$janela_troca_mensagens
$campo_usuarios_abertos
$campo_atualizador[0]
$executador[0]
";

// retorno
return $html;

};

?>