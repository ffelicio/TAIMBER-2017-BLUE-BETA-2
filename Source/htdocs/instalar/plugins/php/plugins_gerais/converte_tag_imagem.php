<?php

// converte url em imagem
function converte_tag_imagem($conteudo, $modo){

// modo true adiciona link
// modo false não adiciona link

// valida o modo
if($modo == true){
	
	// converte url em tag de imagem
	$conteudo = preg_replace('#(http://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<a href="$1.$2" target="_blank"><img src="$1.$2" alt="$1.$2" /></a>', $conteudo);
	$conteudo = preg_replace('#(https://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<a href="$1.$2" target="_blank"><img src="$1.$2" alt="$1.$2" /></a>', $conteudo);
	
}else{
	
	// converte url em tag de imagem
	$conteudo = preg_replace('#(http://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" />', $conteudo);
	$conteudo = preg_replace('#(https://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" />', $conteudo);

};

// retorno
return $conteudo;

};

?>