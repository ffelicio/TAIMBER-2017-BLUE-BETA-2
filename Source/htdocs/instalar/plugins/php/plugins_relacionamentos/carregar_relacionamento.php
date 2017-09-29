<?php

// carrega o relacionamento
function carregar_relacionamento($relacao, $aceito){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[39];

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida relacao
if(retorne_permite_carregar_multiplos_relacionamentos($relacao) == false){
	
	// adiciona limit de query
	$limit_query = "limit 1";
	
};

// query
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='$aceito' order by id desc $limit_query;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// valida numero de linhas
if($linhas == 0){
	
	// retorno
	return null;
	
};

// contador
$contador = 0;

// listando e contruindo usuários
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$id = $dados["id"];
	$uid = $dados[UID];
	$uidamigo = $dados[UIDAMIGO];
	$relacao = $dados[RELACAO];
	$aceito = $dados[ACEITO];
	$visualizado = $dados[VISUALIZADO];
	$uidenviou = $dados[UIDENVIOU];
	$data = $dados[DATA];
	
	// valida id
	if($id != null){
		
		// id de campo
		$idcampo[0] = retorne_idcampo_md5();
		
		// perfil de usuario
		$perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uidamigo);

		// classes
		$classe[0] = "classe_separa_usuario_aceita_relacionamento_separa";
		$classe[1] = "classe_separa_usuario_aceita_relacionamento_separa_botao";
		$classe[2] = "classe_separa_usuario_aceita_relacionamento_separa_span";
		$classe[3] = "classe_separa_usuario_aceita_relacionamento_separa_span_2";
		
		// funcoes
		$funcao[0] = "excluir_relacionamento(\"$uidamigo\", \"$relacao\");";
		$funcao[1] = "aceita_relacionamento(\"$uidamigo\", \"$relacao\");";
		
		// eventos
		$eventos[0] = "onclick='$funcao[0]'";
		$eventos[1] = "onclick='$funcao[1]'";
		$eventos[2] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
	
		// campos
		$campo[0] = "
		<div class='classe_texto_caixa_dialogo'>
		$idioma_sistema[594]
		</div>

		<div class='classe_botao_caixa_dialogo'>
		<input type='button' value='$idioma_sistema[32]' $eventos[0]>
		</div>
		";

		// adiciona dialogo
		$campo[0] = constroe_dialogo($idioma_sistema[557], $campo[0], $idcampo[0]);

		// valida aceito
		if($aceito == false){

			// valida quem enviou solicitacao de relacionamento
			if($uidenviou == $uid){

				// campos
				$campo[0] = "
				<div class='$classe[0]'>

				<div class='$classe[2]'>
				<span class='span_link_3' $eventos[2]>$idioma_sistema[558]</span>
				</div>
				
				</div>
				
				$campo[0]
				";
				
			}else{

				// campos
				$campo[0] = "
				<div class='$classe[0]'>
				
				<div class='$classe[1]'>
				<input type='button' value='$idioma_sistema[552]' $eventos[1]>
				</div>
				
				<div class='$classe[3]'>
				<span class='span_link_3' $eventos[2]>$idioma_sistema[559]</span>
				</div>
				
				</div>
				
				$campo[0]
				";			
				
			};

		}else{
			
			// campos
			$campo[0] = "
			<div class='$classe[0]'>

			<div class='$classe[2]'>
			<span class='span_link_3' $eventos[2]>$idioma_sistema[557]</span>
			</div>
			
			</div>
			
			$campo[0]
			";			
			
		};
		
		// html
		$html .= "
		<div class='classe_separa_usuario_aceita_relacionamento'>
		
		$perfil_usuario
		$campo[0]
		
		</div>
		";
	
	};
	
};

// retorno
return $html;

};

?>