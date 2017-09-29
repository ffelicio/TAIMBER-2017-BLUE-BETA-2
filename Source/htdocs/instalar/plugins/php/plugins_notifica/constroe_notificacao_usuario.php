<?php

// constroe a notificaco do usuario
function constroe_notificacao_usuario($dados){

// globals
global $tabela_banco;
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$idpost = $dados[IDPOST];
$tabela_notifica = $dados[TABELA_NOTIFICA];
$tabela_acao = $dados[TABELA_ACAO];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$visualizado = $dados[VISUALIZADO];
$data = $dados[DATA];
$idcomentario = $dados[IDCOMENTARIO];

// valida id
if($id == null){
	
	// retorno nulo
	return null;
	
};

// notificaco de amizades aceitas
if($tabela_notifica == -1 and $tabela_acao == $tabela_banco[6]){
	
	// seta tabela de notificaco
	$tabela_notifica = $tabela_banco[6];
	
};

// identifica o tipo de tabela de notificaco
switch($tabela_notifica){
	
	case $tabela_banco[4]: // albuns
	
		// agora avalia o tipo de acao feito nesta tabela
		switch($tabela_acao){
			
			case $tabela_banco[7]: // comentou
			
			// comentario...
			$comentario = retorne_comentario_id($idcomentario);
			
			// campos
			$campo[0] = constroe_imagem_id($idpost);
			
			// valida imagem construida
			if($campo[0] == null){
				
				// saindo de break...
				break;
				
			};
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[283]."</span>";
			
			// campos
			$campo[0] = "
			<div class='classe_campo_notificacao classe_cor_2'>
			
			<div class='classe_campo_notificacao_texto'>
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$comentario
			</div>
			
			</div>

			<div class='classe_campo_notificacao_imagem'>
			$campo[0]
			</div>

			</div>
			";
			
			break;
			
			case $tabela_banco[9]: // curtiu
			
			// campos
			$campo[0] = constroe_imagem_id($idpost);
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[287]."</span>";
			
			// campos
			$campo[0] = "
			<div class='classe_campo_notificacao classe_cor_2'>
			<div class='classe_campo_notificacao_texto'>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>

			</div>

			<div class='classe_campo_notificacao_imagem'>
			$campo[0]
			</div>

			</div>
			";

			break;

		};

	break;
	
	case $tabela_banco[5]: // publicacoes
	
		// agora avalia o tipo de acao feito nesta tabela
		switch($tabela_acao){
			
			case $tabela_banco[7]: // comentou
			
			// comentario...
			$comentario = retorne_comentario_id($idcomentario);
			
			// campos
			$campo[0] = retorna_link_referencia_publicacao_id($idpost, $idioma_sistema[462]);
			
			// valida imagem construida
			if($campo[0] == null){
				
				// saindo de break...
				break;
				
			};
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[284].$campo[0]."</span>";
			
			// campos
			$campo[0] = "
			<div class='classe_campo_notificacao classe_cor_2'>
			
			<div class='classe_campo_notificacao_texto'>
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$comentario
			</div>
			
			</div>

			<div class='classe_campo_notificacao_imagem'>
			$campo[0]
			</div>

			</div>
			";
			
			break;
			
			case $tabela_banco[9]: // curtiu

			// campos
			$campo[0] = retorna_link_referencia_publicacao_id($idpost, $idioma_sistema[462]);
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[288].$campo[0]."</span>";
			
			// campos
			$campo[0] = "
			<div class='classe_campo_notificacao classe_cor_2'>
			<div class='classe_campo_notificacao_texto'>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>

			</div>
			</div>
			";

			break;

		};
	
	break;
	
	case $tabela_banco[13]: // depoimentos

			// campos
			$campo[0] = constroe_depoimento_id($idpost);
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[290]."</span>";
			
			// campos
			$campo[0] = "
			<div class='classe_campo_notificacao classe_cor_2'>
			<div class='classe_campo_notificacao_texto'>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>

			</div>

			<div class='classe_campo_notificacao_imagem'>
			$campo[0]
			</div>

			</div>
			";

	break;

	case $tabela_banco[14]: // marcacoes
	
		// valida o tipo de acao
		switch($tabela_acao){
			
			case $tabela_banco[5]: // publicacoes
			
			// campos
			$campo[0] = retorna_link_publicacao_id($idpost);
			
			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[294]."</span>";
			
			// campos
			$campo[0] = "
			
			<div class='classe_campo_notificacao classe_cor_2'>
			<div class='classe_campo_notificacao_texto'>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>

			</div>

			<div class='classe_campo_notificacao_imagem'>
			$campo[0]
			</div>

			</div>
			
			";

			break;
			
			case $tabela_banco[7]: // comentarios

			// comentario
			$comentario = retorne_comentario_id($idcomentario);

			// perfil do usuario
			$perfil[0] = retorne_nome_link_usuario(true, $uid);
			
			// link de comentario
			$link[0] = retorne_link_comentario($idcomentario);
		
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[295].$link[0]."</span>";
			
			// campos
			$campo[0] = "
			
			<div class='classe_campo_notificacao classe_cor_2'>
			<div class='classe_campo_notificacao_texto'>
			
			<div class='classe_campo_notificacao_texto_separa'>
			$mensagem[0]
			</div>

			</div>

			<div class='classe_campo_notificacao_imagem'>
			$comentario
			</div>

			</div>
			
			";

			break;

		};

	break;

	case $tabela_banco[7]: // comentarios

		// comentario
		$comentario = retorne_comentario_id($idcomentario);

		// perfil do usuario
		$perfil[0] = retorne_nome_link_usuario(true, $uid);

		// link de comentario
		$link[0] = retorne_link_comentario($idpost);
		
		// mensagem
		$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[347].$link[0]."</span>";

		// valida o tipo de acao
		switch($tabela_acao){
			
			case $tabela_banco[7]:
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[463].$link[0]."</span>";
			break;

		};

		// campo responde comentario
		$campo_responde = constroe_campo_comentario(null, 3, $idpost, true, $uidamigo);
		
		// campos
		$campo[0] = "

		<div class='classe_campo_notificacao classe_cor_2'>
		<div class='classe_campo_notificacao_texto'>

		<div class='classe_campo_notificacao_texto_separa'>
		$mensagem[0]
		</div>

		</div>

		<div class='classe_campo_notificacao_imagem'>
		$comentario
		</div>

		$campo_responde
		
		</div>

		";		

	break;
	
	case $tabela_banco[6]:

		// perfil do usuario
		$perfil[0] = retorne_nome_link_usuario(true, $uid);

		// data
		$data = converte_data_amigavel(true, $data);
		
		// sexos
		$sexo[0] = retorne_sexo_usuario(retorne_dados_perfil_usuario($uidamigo));
		$sexo[1] = retorne_sexo_usuario(retorne_dados_perfil_usuario($uid));
		
		// valida sexo de usuario
		if($sexo[0] == false and $sexo[1] == false){
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[424]."</span>";
			
			
		}else{
			
			// mensagem
			$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[422]."</span>";

		};

		// campos
		$campo[0] = "
		<div class='classe_campo_notificacao classe_cor_2'>

		<div class='classe_campo_notificacao_texto'>
		<div class='classe_campo_notificacao_texto_separa'>
		$mensagem[0]
		<div class='classe_campo_notificacao_data classe_cor_15'>$data</div>
		</div>

		<div class='classe_campo_notificacao_texto_separa'>
		$comentario
		</div>

		</div>

		<div class='classe_campo_notificacao_imagem'>
		$campo[0]
		</div>

		</div>
		";

	break;
	
};

// html
$html = "
$campo[0]
";

// retorno
return $html;

};

?>