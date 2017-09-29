<?php

// constroe aba
function constroe_aba($aba_posts, $modo, $array_titulos, $array_conteudos, $array_ids){

// modo true titulo vertical
// modo false titulo horizontal

// contador
$contador = 0;

// id campo de inicio
$idcampo_inicio = null;

// id de campo de titulo de inicio
$idcampo_titulo_inicio = null;

// usuario logado
$usuario_logado = retorne_usuario_logado();

// nome de array js completo
$nome_array_js = "ids_array_js_".retorne_contador_iteracao();

// valida modo
if($modo == true){
	
	// classe
	$classe[0] = "conteudo_aba";
	$classe[1] = "titulo_aba span_link";
	$classe[2] = "classe_aba classe_cor_8";
	$classe[3] = "classe_aba_topo";
	
}else{
	
	// classe
	$classe[0] = "conteudo_aba_horizontal";
	$classe[1] = "titulo_aba_horizontal span_link classe_cor_9";
	$classe[2] = "classe_aba";

	// valida usuario logado
	if($usuario_logado == true){
		
		// classe
		$classe[3] = "classe_aba_topo_horizontal classe_cor_8";
		
	}else{
		
		// classe
		$classe[3] = "classe_aba_topo_horizontal_deslogado classe_cor_2 classe_cor_8";
		
	};

};

// backups de classes
$bkp_classe[0] = $classe[0];

// construindo abas
foreach($array_titulos as $titulo){
	
	// valida titulo
	if($titulo != null){
		
		// id de campo
		$idcampo = $array_ids[$contador];
		
		// campos
		$campo[3] .= "<script>".$nome_array_js."[$contador] = \"$idcampo\";"."</script>";

		// atualiza o contador
		$contador++;
		
	};
	
};

// contador
$contador = 0;

// construindo abas
foreach($array_titulos as $titulo){
	
	// valida titulo
	if($titulo != null){
		
		// conteudo
		$conteudo = $array_conteudos[$contador];
		
		// id de campo
		$idcampo = $array_ids[$contador];
		
		// id de campo de titulo de aba
		$idcampo_titulo = retorne_idcampo_md5();
		
		// evento
		$evento = "onclick='abrir_aba(\"$idcampo\", \"$idcampo_titulo\", \"$classe[1]\", $nome_array_js);'";
		
		// html
		$campo[0] .= "
		<span class='$classe[1]' id='$idcampo_titulo' $evento>
		$titulo
		</span>
		";

		// valida o modo de cor
		if($aba_posts == true and $contador == 0){
			
			// sub classe
			$sub_classe[0] = "classe_cor_33";
			
			// classes
			$classe[0] = "conteudo_aba_horizontal_posts";
			
		}else{
			
			// limpa a subclasse
			$sub_classe[0] = null;
			
			// restaura o backup de classe
			$classe[0] = $bkp_classe[0];
			
		};

		// html
		$campo[1] .= "
		<div class='$classe[0] $sub_classe[0]' id='$idcampo'>
		$conteudo
		</div>		
		";
		
		// valida contador
		if($contador == 0){
			
			// informa o primeiro id de campo de inicio
			$idcampo_inicio = $idcampo;
			
			// id de campo de titulo de inicio
			$idcampo_titulo_inicio = $idcampo_titulo;
			
		};
		
		// atualizando contador
		$contador++;
		
	};

};

// campos
$campo[2] = "
<script>
var $nome_array_js = [];
</script>

$campo[3]
";

// html
$html = "
$campo[2]

<div class='$classe[2]'>

<div class='$classe[3]'>
$campo[0]
</div>

$campo[1]
</div>

<script>
abrir_aba(\"$idcampo_inicio\", \"$idcampo_titulo_inicio\", \"$classe[1]\", $nome_array_js);
</script>
";

// retorno
return $html;

};

?>