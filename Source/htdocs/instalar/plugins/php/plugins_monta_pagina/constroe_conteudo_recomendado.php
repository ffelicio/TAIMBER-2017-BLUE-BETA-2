<?php

// constroe o conteudo recomendado
function constroe_conteudo_recomendado(){

// globals
global $idioma_sistema;

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida configuracao de privacidade de usuário
if(retorna_configuracao_privacidade(11, $uid) == false){

	// array de titulos
	$array_titulos[] = retorne_imagem_sistema(119, null, false);

	// array de ids
	$array_ids[] = retorne_idcampo_md5();

	// array de conteudos
	$array_conteudos[] = campo_recomendar_noticias();

};

// array de titulos
$array_titulos[] = retorne_imagem_sistema(118, null, false);
$array_titulos[] = retorne_imagem_sistema(121, null, false);
$array_titulos[] = retorne_imagem_sistema(120, null, false);

// array de ids
$array_ids[] = retorne_idcampo_md5();
$array_ids[] = retorne_idcampo_md5();
$array_ids[] = retorne_idcampo_md5();

// array de conteudos
$array_conteudos[] = carrega_recomendacoes_usuarios();
$array_conteudos[] = carrega_recomendacoes_paginas();
$array_conteudos[] = carrega_recomendacoes_musicas(true);

// retorno
return constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);

};

?>