<?php

// constroe o perfil basico do usuario
function constroe_perfil_basico(){

// globals
global $tabela_banco;
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa dados por tabela
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$dados_imagem = $dados_compilados_usuario[$tabela_banco[2]];

// separa dados de tabela
$url_host_grande = $dados_imagem[URL_HOST_GRANDE];
$url_host_mobile = $dados_imagem[URL_HOST_MOBILE];

// valida modo mobile
if($modo_mobile == true){
	
	// altera o host grande para mobile
	$url_host_grande = $url_host_mobile;
	
};

// valida url de host de imagem
if($url_host_grande == null){
	
	// url de host de imagem
	$url_host_grande = retorne_imagem_sexo_usuario(true, $dados_perfil, $uid);
	
};

// nome do usuario
$nome = captular($dados_perfil[NOME]." ".$dados_perfil[SOBRENOME]);

// id do usuario
$uid = $dados_perfil[UID];

// usuario amigo
$usuario_amigo = retorne_usuario_amigo($uid);

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// campos
$campo_opcoes_imagem_perfil = constroe_opcoes_imagem_perfil();

// campo imagem de perfil
$campo_imagem_perfil = "
<div class='classe_div_imagem_perfil_grande'>
<img src='$url_host_grande' title='$nome' alt='$nome'>
</div>
";

// valida modo mobile
if($modo_mobile == false){
	
	// adiciona link de publicacoes do usuario
	$campo_imagem_perfil = retorna_link_acao($campo_imagem_perfil, 9, $uid);

};

// campo conta ativada
$campo_conta_ativada = campo_conta_ativada($uid);

// valida mobile
if($modo_mobile == false){

	// nome do usuário
	$nome_usuario = retorne_nome_usuario(true, $uid);

	// campos
	$campo[0] = "

	<div class='classe_perfil_basico_usuario_imagem'>
		$campo_imagem_perfil
	</div>
	
	<span class='classe_nome_topo_perfil_basico_usuario_nome'>
		
		$campo_conta_ativada 
		
		<span class='classe_nome_topo_perfil_basico_usuario_nome_separa'>
			$nome_usuario
		</span>
		
	</span>
	
	";

	// campos
	$campo[0] = campo_redimensionar_imagem($campo[0], 0);
	
};

// valida mobile
if($modo_mobile == true){
	
	// data da ultima visualizacao
	$data_ultima_visualizacao = retorne_data_ultima_visualizacao_conexao($uid, false);

	// campo para enviar mensagem
	$campo_envia_mensagem = campo_envia_mensagem($uid);
	
	// valida campo para enviar mensagem
	if($campo_envia_mensagem != null){
		
		// campo para enviar mensagem
		$campo_envia_mensagem = "
		
		<div class='classe_perfil_basico_miniatura_campos_separa_mensagem'>
		$campo_envia_mensagem
		</div>
	
		";
	
	};

	// valida a data de nascimento
	if($dados_perfil[NASCEU] != null){
		
		// idade de usuario
		$idade_usuario = retorne_idade_usuario($dados_perfil[NASCEU]);
	
		// valida idade de usuario
		if($idade_usuario != null){
			
			// campo idade de usuario
			$campo_idade_usuario = "
			
			<div class='classe_perfil_basico_miniatura_campos_separa'>
			$idade_usuario$idioma_sistema[336]
			</div>
			
			";
		
		};
	
	};
	
	// cidade e estado
	$cidade = $dados_perfil[CIDADE];
	$estado = $dados_perfil[ESTADO];
	
	// valida cidade e estado
	if($cidade != null and $estado != null){
		
		// campo mora
		$campo_mora = "
		<div class='classe_perfil_basico_miniatura_campos_separa'>
		$idioma_sistema[482]$cidade, $estado
		</div>
		";
	
	};
	
	// campo adicionar amizade
	$campo_amizade = campo_adicionar_pessoa(true, false, $uid);
	
	// valida campo adicionar amizade
	if($campo_amizade != null){
		
		// campo adicionar amizade
		$campo_amizade = "
		<div class='classe_perfil_basico_miniatura_campos_separa'>
		$campo_amizade
		</div>
		";
	
	};
	
	// campos
	$campo[1] = "
	<div class='classe_perfil_basico_miniatura'>

	<div class='classe_perfil_basico_miniatura_imagem'>
	<div class='classe_perfil_basico_miniatura_imagem_usuario'>
	<img src='$url_host_grande' title='$nome' alt='$nome'>
	</div>
	</div>

	<div class='classe_perfil_basico_miniatura_campos'>
	
	<div class='classe_perfil_basico_miniatura_campos_nome'>
		
		$campo_conta_ativada
		
		<span class='classe_perfil_basico_miniatura_campos_nome_separa'>
			$nome
		</span>
		
	</div>
	
	<div class='classe_perfil_basico_miniatura_campos_separa'>
	$data_ultima_visualizacao
	</div>

	$campo_idade_usuario
	$campo_mora
	$campo_amizade
	
	</div>
	
	$campo_envia_mensagem

	</div>
	";
	
};

// modo mobile
if($modo_mobile == true){

	// campos
	$campo[2] = $campo_opcoes_imagem_perfil;
	
	// limpa opcoes
	$campo_opcoes_imagem_perfil = null;
	
	// campos
	$campo[3] = constroe_campo_album_perfil_basico();

}else{

	// array de amizade
	$array_amizade = campo_adicionar_pessoa(true, true, $uid);
	
	// array bloquear
	$array_bloquear = campo_bloquear_usuario(true, $uid);
	
	// valida usuario amigo
	if($usuario_amigo == true){
		
		// lista de dialogos
		$dialogos .= $array_amizade["dialogo"];
		$dialogos .= $array_bloquear["dialogo"];
		
		// opcoes do perfil
		$opcoes_perfil .= "<div class='classe_div_opcao_menu_suspense'>".$array_amizade["html"]."</div>";
		$opcoes_perfil .= "<div class='classe_div_opcao_menu_suspense'>".$array_bloquear["html"]."</div>";
		
	}else{
		
		// campo de amizade
		$campo_amizade = "<div class='classe_separa_opcao_perfil_usuario_3'>".$array_amizade["html"]."</div>".$array_amizade["dialogo"];
		$campo_bloqueio = "<div class='classe_separa_opcao_perfil_usuario_3'>".$array_bloquear["html"]."</div>".$array_bloquear["dialogo"];
	
	};

	// valida usuario amigo
	if($usuario_amigo == true){
	
		// opcoes do perfil
		$opcoes_perfil = constroe_menu_suspense(false, null, false, null, null, $opcoes_perfil);

		// adiciona div para separar as opcoes
		$opcoes_perfil = "
		<div class='classe_div_opcoes_perfil_basico_menu classe_cor_4'>
		$opcoes_perfil
		</div>
		";		
	
	};

	// opcoes do perfil
	$opcoes_perfil .= $campo_amizade;
	$opcoes_perfil .= $campo_bloqueio;
	$opcoes_perfil .= constroe_campo_opcoes_perfil(4);

};

// campos mobile
$campos_mobile = "
$campo[1]
$campo[2]
$campo[3]
";

// html
$html = "
<div class='classe_perfil_basico_usuario'>

$campos_mobile
$campo[0]
$campo_opcoes_imagem_perfil
$opcoes_perfil

</div>

$dialogos
";

// retorno
return $html;

};

?>