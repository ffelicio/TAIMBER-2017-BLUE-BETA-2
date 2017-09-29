<?php

// retorna se pode interagir social
function retorne_pode_interagir_social($id, $modo){

// modo true deve ser usado em compartilhamento
// modo false para qualquer outro
// por exemplo não permitir compartilhar algo de alguém que não é amigo
// mas se for um compartilhamento já feito pode curtir e comentar porque não é a publicação real mas sim uma publicação copiada!

// valida se o post é de pagina
if(retorne_idpagina_postagem($id) != null){
	
	// retorno verdadeiro
	return true;

};

// valida o modo
if($modo == true){
	
	// id de post
	$id_post = retorne_idcompartilhamento_id_post($id);

}else{
	
	// id de post
	$id_post = $id;

};

// id de usuario dono da publicacao
$uid_dono = retorne_idusuario_dono_publicacao($id_post);

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil($uid_dono) == true){
	
	// retorno verdadeiro
	return true;
	
};

// retorno
return retorne_usuario_amigo($uid_dono);

};

?>