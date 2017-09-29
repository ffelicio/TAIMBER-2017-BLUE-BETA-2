<?php

// constroe o formulario de relacionamento
function constroe_formulario_relacionamento($modo){

// modo true carrega somente o relacionamento
// modo false carrega o selecionador de relacionamentos

// globals
global $idioma_sistema;

// id de usuario via requeste
$idusuario = retorne_idusuario_request();

// valida modo editar, e se o usuário é o dono deste perfil
if($modo == false and retorne_usuario_dono_perfil($idusuario) == false){
	
	// retorno nulo
	return null;
	
};

// setando relacionamentos como visualizados
setar_relacionamentos_visualizados();

// contador
$contador = 0;

// campos
$array_titulos[] = $idioma_sistema[540];
$array_titulos[] = $idioma_sistema[541];
$array_titulos[] = $idioma_sistema[542];
$array_titulos[] = $idioma_sistema[545];
$array_titulos[] = $idioma_sistema[546];
$array_titulos[] = $idioma_sistema[553];
$array_titulos[] = $idioma_sistema[560];
$array_titulos[] = $idioma_sistema[572];
$array_titulos[] = $idioma_sistema[573];
$array_titulos[] = $idioma_sistema[574];
$array_titulos[] = $idioma_sistema[575];

// contador final
$contador_final = count($array_titulos) - 1;

// id de usuario logado
$uid = retorne_idusuario_logado();

// contruindo campos
for($contador == $contador; $contador <= $contador_final; $contador++){
	
	// uidamigo
	$uidamigo = retorne_relacionamento_usuario($contador, $idusuario);

	// valida o contador
	if($contador == 0){
		
		// valida se o usuário está em um relacionamento sério
		if(retorne_usuario_relacionamento_serio($uid, $contador) == true){

			// titulo
			$titulo = retorne_texto_relacionamento($uidamigo);
		
		}else{
			
			// titulo
			$titulo = $array_titulos[$contador];

		}
		
	}else{
		
		// titulo
		$titulo = $array_titulos[$contador];

	};
	
	// valida o modo
	if($modo == true){
		
		// valida uidamigo
		if($uidamigo != null){

			// perfil de usuario
			$perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uidamigo);

			// campos
			$campos .= "
			
			<div class='classe_relacionamento_usuario'>
			
			<div class='classe_relacionamento_usuario_titiulo'>
			$titulo
			</div>
			
			<div class='classe_relacionamento_usuario_perfil'>
			$perfil_usuario
			</div>
			
			</div>
			
			";
		
		};

	}else{
		
		// id de campos
		$idcampo[0] = retorne_idcampo_md5();
		$idcampo[1] = retorne_idcampo_md5();
		
		// evento
		$evento = "alterar_relacionamento(\"$contador\", \"$idcampo[0]\", \"$idcampo[1]\");";
		
		// campos
		$campos .= constroe_selecionador_amizade($evento, $uidamigo, $titulo, $idcampo[0], $idcampo[1], $contador);

	};
	
};

// html
$html = "
<div class='classe_formulario_relacionamento'>
$campos
</div>
";

// retorno
return $html;

};

?>