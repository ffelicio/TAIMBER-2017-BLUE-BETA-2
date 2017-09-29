
<?php
function constroe_aba($aba_posts, $modo, $array_titulos, $array_conteudos, $array_ids){
$contador = 0;
$idcampo_inicio = null;
$idcampo_titulo_inicio = null;
$usuario_logado = retorne_usuario_logado();
$nome_array_js = "ids_array_js_".retorne_contador_iteracao();
if($modo == true){
		$classe[0] = "conteudo_aba";
	$classe[1] = "titulo_aba span_link";
	$classe[2] = "classe_aba classe_cor_8";
	$classe[3] = "classe_aba_topo";
}else{
		$classe[0] = "conteudo_aba_horizontal";
	$classe[1] = "titulo_aba_horizontal span_link classe_cor_9";
	$classe[2] = "classe_aba";
		if($usuario_logado == true){
				$classe[3] = "classe_aba_topo_horizontal classe_cor_8";
	}else{
				$classe[3] = "classe_aba_topo_horizontal_deslogado classe_cor_2 classe_cor_8";
	};
};
$bkp_classe[0] = $classe[0];
foreach($array_titulos as $titulo){
		if($titulo != null){
				$idcampo = $array_ids[$contador];
				$campo[3] .= "<script>".$nome_array_js."[$contador] = \"$idcampo\";"."</script>";
				$contador++;
	};
};
$contador = 0;
foreach($array_titulos as $titulo){
		if($titulo != null){
				$conteudo = $array_conteudos[$contador];
				$idcampo = $array_ids[$contador];
				$idcampo_titulo = retorne_idcampo_md5();
				$evento = "onclick='abrir_aba(\"$idcampo\", \"$idcampo_titulo\", \"$classe[1]\", $nome_array_js);'";
				$campo[0] .= "
		<span class='$classe[1]' id='$idcampo_titulo' $evento>
		$titulo
		</span>
		";
				if($aba_posts == true and $contador == 0){
						$sub_classe[0] = "classe_cor_33";
						$classe[0] = "conteudo_aba_horizontal_posts";
		}else{
						$sub_classe[0] = null;
						$classe[0] = $bkp_classe[0];
		};
				$campo[1] .= "
		<div class='$classe[0] $sub_classe[0]' id='$idcampo'>
		$conteudo
		</div>		
		";
				if($contador == 0){
						$idcampo_inicio = $idcampo;
						$idcampo_titulo_inicio = $idcampo_titulo;
		};
				$contador++;
	};
};
$campo[2] = "
<script>
var $nome_array_js = [];
</script>
$campo[3]
";
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
return $html;
};
function atualizar_descricao_imagem_album(){
global $tabela_banco;
$conteudo = retorne_campo_formulario_request_htmlentites(36);
$id = retorne_campo_formulario_request(4);
$chave = retorne_campo_formulario_request(3);
$tabela = $tabela_banco[4];
$uid = retorne_idusuario_logado();
$query = "update $tabela set descricao_imagem='$conteudo' where id='$id' and uid='$uid' and chave='$chave';";
plugin_executa_query($query);
};
function carrega_albuns_usuario(){
global $idioma_sistema;
if(retorne_modo_pagina() == true){
		return null;
};
$uid = retorne_idusuario_request();
$campo[0] = carrega_lista_albuns_imagens_pagina();
$campo[1] = carrega_lista_albuns_imagens(1);
$campo[2] = carrega_lista_albuns_imagens(2);
if(retorne_numero_paginas_usuario($uid) > 0){
		$campo[3] = carrega_lista_albuns_imagens(3);
};
$classe[0] = "classe_lista_albuns_imagens_usuario_titulo classe_cor_8 classe_cor_4 classe_cor_21";
$classe[1] = "classe_lista_albuns_imagens_usuario_conteudo";
$classe[2] = "classe_lista_albuns_imagens_usuario_gerais";
$classe[3] = "classe_lista_albuns_imagens_usuario_paginas";
$sub_campo[0] = "
<div class='$classe[2]'>
<div class='$classe[0]'>
$idioma_sistema[602]
</div>
<div class='$classe[1]'>
$campo[1]
$campo[2]
$campo[3]
</div>
</div>
";
if(retorne_numero_paginas_usuario($uid) > 0){
		$sub_campo[1] = "
	<div class='$classe[3]'>
	<div class='$classe[0]'>
	$idioma_sistema[601]
	</div>
	<div class='$classe[1]'>
	$campo[0]
	</div>
	</div>
	";
};
$html = "
<div class='classe_lista_albuns_imagens_usuario'>
$sub_campo[0]
$sub_campo[1]
</div>
";
return $html;
};
function carrega_imagens_album_usuario(){
global $tabela_banco;
global $idioma_sistema;
if(retorne_modo_album() == true){
		return constroe_imagens_album_usuario_modo_album();
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];
$array_imagens = inverte_array($array_imagens);
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);
if(is_array($array_imagens) == false){
        return null;
};
for($contador == $contador; $contador <= $contador_final; $contador++){
		$html .= constroe_imagem_album_dados($array_imagens[$contador], 4, null);
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function carrega_lista_albuns_imagens($modo){
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
$tabela = $tabela_banco[4];
$uid = retorne_idusuario_request();
$limit_query = "limit 1";
switch($modo){
	case 1:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc;";
	break;
	case 2:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc;";
	break;
	case 3:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' order by id asc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' order by id asc;";
	break;
};
$dados = retorne_dados_query($query[0]);
$id = $dados["id"];
$pagina = $dados[PAGINA];
$chave = $dados[CHAVE];
$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];
$numero_imagens = retorne_numero_linhas_query($query[1]);
if($id != null){
		$numero_imagens_tamanho = retorne_tamanho_resultado($numero_imagens);
		switch($modo){
		case 1:
				$texto[0] = $idioma_sistema[597].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";
				$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=1";
		break;
		case 2:
				$texto[0] = $idioma_sistema[598].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";
				$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=0";
		break;
		case 3:
				$texto[0] = $idioma_sistema[600].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";
				$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=2";
		break;
	};
		$link[0] = "<a href='$url[0]' title='$texto[0]'>$texto[0]</a>";		
		$idcampo[0] = retorne_idcampo_md5();
		$propriedade_css[0] = "
	background-image: url(\"$url_host_thumbnail\");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 50% 50%;
	";
		$css[0] = constroe_css_manual(null, $idcampo[0], $propriedade_css[0]);
		$html = "
	<div class='classe_separador_albuns_usuario' id='$idcampo[0]'>
	<div class='classe_separador_albuns_usuario_texto'>
	$link[0]
	</div>
	</div>
	$css[0]
	";
};
return $html;
};
function constroe_campo_album_perfil_basico(){
global $tabela_banco;
$uid = retorne_idusuario_request();
$modo_pagina = retorne_modo_pagina();
$pagina = retorne_idpagina_request();
if($modo_pagina == true){
		$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);	
		$numero_imagens = retorne_numero_imagens_album_pagina($pagina);
}else{
		$usuario_dono = retorne_usuario_dono_perfil($uid);
		$numero_imagens = retorne_numero_todas_imagens_usuario($uid);
};
if($modo_pagina == true and $usuario_dono == false and $numero_imagens == 0){
		return null;	
};
if((retorne_perfil_privado(null) == true or $numero_imagens == 0) and $usuario_dono == false){
		return null;
};
$modo_mobile = retorne_modo_mobile();
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];
$array_imagens = inverte_array($array_imagens);
$contador = 0;
if($modo_mobile == true){
		$contador_final = NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL_MOBILE;
}else{
		$contador_final = NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL;
};
if(is_array($array_imagens) == false){
        return null;
};
for($contador == $contador; $contador <= $contador_final; $contador++){
		$html .= constroe_imagem_album_dados($array_imagens[$contador], 2, null);
};
if($modo_mobile == false){
		$campo_visualizar_imagens_album = constroe_visualizador_imagens_album();
};
$html = "
<div class='classe_div_campo_album_perfil_basico'>
<div class='classe_div_campo_album_perfil_basico_imagens'>
$html
</div>
$campo_visualizar_imagens_album
</div>
";
return $html;
};
function constroe_campo_descricao_imagem($dados){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$chave = $dados[CHAVE];
$descricao_imagem = html_entity_decode($dados[DESCRICAO_IMAGEM]);
if(retorne_idusuario_logado() == $uid){
		$placeholder[0] = retorne_nome_usuario_logado().$idioma_sistema[416];
		$idcampo[0] = retorne_idcampo_md5();
		$funcao[0] = "atualizar_descricao_imagem_album(\"$idcampo[0]\", \"$id\", \"$chave\");";
		$evento[0] = "onkeyup='$funcao[0]'";
	$evento[1] = "onclick='$funcao[0]'";
		$emoticons[0] = constroe_visualizador_emoticons(true, false, retorne_idcampo_md5(), $idcampo[0]);
		$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], $descricao_imagem, null, $evento[0], $placeholder[0]);
		$campo[0] = "
	<div class='classe_descricao_imagem classe_cor_3'>
	<div class='classe_descricao_imagem_campo'>
	$campo_entrada
	</div>
	<div class='classe_descricao_imagem_emoticons'>
	<div class='classe_descricao_imagem_emoticons_separa'>$emoticons[0]</div>
	</div>
	<div class='classe_descricao_imagem_campo_botao'>
	<input type='button' value='$idioma_sistema[12]' $evento[1]>
	</div>
	</div>
	";
}else{
		if($descricao_imagem != null){
				$descricao_imagem = converter_urls(false, $descricao_imagem);
				$campo[0] = "
		<div class='classe_descricao_imagem'>
		<div class='classe_descricao_imagem_descricao classe_cor_15'>
		$descricao_imagem
		</div>
		</div>
		";
	};
};
$html = "
$campo[0]
";
return $html;
};
function constroe_campo_gerenciar_imagem($dados, $identificador){
global $tabela_banco;
global $idioma_sistema;
$id = $dados["id"];
$idusuario = $dados[UID];
$usuario_dono = retorne_usuario_dono_perfil($idusuario);
if($id == null or $usuario_dono == false){
        return null;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil[0] = $dados_compilados_usuario[$tabela_banco[2]];
$dados_perfil[1] = $dados_compilados_usuario[$tabela_banco[1]];
$nome_usuario = $dados_perfil[1][NOME];
if($usuario_dono == true){
        $id_dialogo_excluir_imagem = retorne_idcampo_md5();
    	$dialogo_excluir_imagem = "
	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[31]
	</div>
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' onclick='excluir_imagem_album(\"$identificador[2]\", \"$id\", \"$identificador[0]\");'>
	</div>
	";
		$dialogo_excluir_imagem = constroe_dialogo($idioma_sistema[33], $dialogo_excluir_imagem, $id_dialogo_excluir_imagem);
		$campo[0] = "
	<div class='classe_div_opcao_menu_suspense' onclick='exibe_dialogo(\"$id_dialogo_excluir_imagem\");'>
	<span class='span_link'>$idioma_sistema[481]</span>
	</div>
	";
		$campo_excluir_imagem = constroe_menu_suspense(false, null, false, null, null, $campo[0]);
		$campo_excluir_imagem = "
	<div class='classe_div_campo_gerenciar_imagem_album_div'>
    $campo_excluir_imagem
    </div>
	";
};
$html = "
<div class='classe_div_campo_gerenciar_imagem_album'>
$campo_excluir_imagem
</div>
$dialogo_excluir_imagem
";
return $html;
};
function constroe_carregar_imagens(){
global $idioma_sistema;
$modo_pagina = retorne_modo_pagina();
$uid = retorne_idusuario_request();
$usuario_dono = retorne_usuario_dono_perfil($uid);
$numero_imagens = retorne_numero_todas_imagens_usuario($uid);
$idcampo[0] = retorna_idcampo_conteudo_geral();
$funcao[0] = "carregar_visualizador_imagens_album(\"$idcampo[0]\")";
$evento[0] = "onclick='$funcao[0]'";
if($modo_pagina == true){
		$titulo = $idioma_sistema[417].retorne_titulo_pagina_id(retorne_idpagina_request());
}else{
		$titulo = $idioma_sistema[417].retorne_nome_usuario(true, $uid);
};
$classe[0] = "classe_div_imagens_album";
$classe[1] = "classe_div_imagens_album_titulo classe_cor_5";
$classe[2] = "classe_div_imagens_album_conteudo";
$classe[3] = "classe_paginador_padrao classe_cor_29 span_link";
$classe[4] = "classe_campo_upload_imagem_album_usuario";
$classe[5] = "classe_progresso_div_imagens_album";
if($usuario_dono == true and $modo_pagina == false){
        $campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_imagens_album", "fotos[]", 6, true, 1);
		$campo_upload = "
	<div class='$classe[4]'>
	$campo_upload
	</div>
	";
};
$progresso[0] = campo_progresso_gif(retorna_idcampo_progresso_gif_geral());
if($numero_imagens == 0){
		$campo[0] = "
	<div class='$classe[0]' id='$idcampo[0]'>
	<div class='$classe[1]'>$titulo</div>
	<div class='$classe[2]'>$campo_upload</div>
	</div>
	";
}else{
		$campo[0] = "
	<div class='$classe[0]' id='$idcampo[0]'>
	<div class='$classe[1]'>$titulo</div>
	$campo_upload
	<div class='$classe[2]' id='$idcampo[0]'></div>
	</div>
	";	
		$campo[1] = "
	<div class='$classe[3]' $evento[0]>
	$idioma_sistema[23]
	</div>
	";
};
$campo[2] = "
<div class='$classe[5]'>$progresso[0]</div>
";
$html = "
$campo[0]
$campo[2]
$campo[1]
";
if($modo_pagina == false){
		if($numero_imagens > 0){
				$array_titulos[] = $idioma_sistema[167];
		$array_titulos[] = $idioma_sistema[599];
				$array_conteudos[] = $html;
		$array_conteudos[] = carrega_albuns_usuario();
				$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();
				return constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
	}else{
				if($usuario_dono == false){
						$html = retorne_nome_link_usuario(false, $uid).$idioma_sistema[605];
		};
	};
};
$html = "
<div class='classe_conteudo_centro_padrao'>
$html
</div>
";
return $html;
};
function constroe_imagem_album_dados($dados, $modo, $idcampo_1){
global $idioma_sistema;
global $tabela_banco;
$id = $dados["id"];
$uid = $dados[UID];
$url_host_grande = $dados[URL_HOST_GRANDE];
$url_host_miniatura = $dados[URL_HOST_MINIATURA];
$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];
$data = $dados[DATA];
if($id == null){
		return null;
};
$usuario_amigo = retorne_usuario_amigo($uid);
$nome_usuario = retorne_nome_usuario(true, $uid);
$usuario_dono = retorne_usuario_dono_perfil($uid);
switch($modo){
	case 0:
    $classe[0] = "classe_div_imagens_album_div_imagem_3";
	break;
	case 1:
    $classe[0] = "classe_div_imagens_album_div_imagem_publicacao";
		$url_host_thumbnail = $url_host_miniatura;
	break;
	case 2:
	$classe[0] = "classe_div_campo_album_perfil_basico_imagens_separa classe_cor_4";
	break;
	case 3:
	$classe[0] = "classe_ultima_imagem_album";
	break;
	case 4:
    $classe[0] = "classe_div_imagens_album_div_imagem_2";
	break;
};
if($url_host_grande != null){
		$modo_mobile = retorne_modo_mobile();
        $dialogo_id[0] = retorne_idcampo_md5();
    $dialogo_id[1] = retorne_idcampo_md5();
	$dialogo_id[2] = retorne_idcampo_md5();
		if($idcampo_1 == null){
				$idcampo_1 = retorne_idcampo_md5();
	};
		if($modo != 1){
				$classe_id[0] = $dialogo_id[2];
				$propriedade_css[0] = "
		background-image: url(\"$url_host_thumbnail\");
		cursor: pointer;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: 50% 50%;
		";
				$css[0] = constroe_css_manual(null, $classe_id[0], $propriedade_css[0]);
	};
		$funcao[0] = "
	restaurar_imagem_album_dados($id, \"$idcampo_1\")
	";
		$script[0] = "
	<script>
	v_array_ids_imagens_albuns_abertos[\"$idcampo_1\"] = $id;
	</script>	
	";
	    $campo_gerenciar_imagem = constroe_campo_gerenciar_imagem($dados, $dialogo_id);
        $campo_social = constroe_campo_social(2, $id, true, $uid);
        $campo_data = constroe_data_conteudo($data);
        $campo_descricao = constroe_campo_descricao_imagem($dados);
		$campo_perfil = constroe_imagem_perfil_miniatura(false, true, $uid);
		$paginador_slide = constroe_paginador_slide_album($dados, $idcampo_1, $nome_funcao[0]);
		$imagem_album = "
	<div class='classe_imagem_unica_album'>
	<img src='$url_host_grande' class='classe_imagem_album_usuario'>
	</div>
	$paginador_slide
	";
		$campo[0] = "
	<div id='$dialogo_id[1]' class='classe_div_imagem_grande_album_visualizar'>
	$imagem_album
	</div>
	$campo_gerenciar_imagem
	<div class='classe_data_album_imagem'>
	$campo_data
	</div>
	";
		$array_titulos[] = $idioma_sistema[537];
	$array_titulos[] = $idioma_sistema[538];
		$array_conteudos[] = $campo_social;
	$array_conteudos[] = $campo_descricao;
		$array_ids[] = retorne_idcampo_md5();
	$array_ids[] = retorne_idcampo_md5();
		$campo_aba = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		$campo[1] = "
	<div class='classe_perfil_usuario_dono_imagem_album classe_cor_13'>
	$campo_perfil
	</div>
	$campo_aba
	";
		$campo[2] = "
	$imagem_album
	";
		if($modo_mobile == true){
				$html = "
		$campo[0]
		$campo[1]
		";
	}else{
				if($usuario_amigo == true or $usuario_dono == true){
						$campo[1] = "
			<div class='classe_imagem_album_visualizar_social'>
			$campo[1]
			</div>
			";
		}else{
						$campo[1] = retorne_imagem_sistema(46, null, false);
						$campo[1] = "
			<div class='classe_imagem_album_visualizar_social_indisponivel'>
			<div class='classe_imagem_album_visualizar_social_indisponivel_texto'>
			$idioma_sistema[526]$nome_usuario$idioma_sistema[527]
			</div>
			<div class='classe_imagem_album_visualizar_social_indisponivel_imagem'>
			$campo[1]
			</div>
			</div>
			";
		};
				$html = "
		<div class='classe_imagem_album_visualizar_imagem'>
		$campo[0]
		</div>
		$campo[1]
		";
	};
		if($modo == 5){
				return $html;
	};
		$html = constroe_dialogo_grande($html, $dialogo_id[0], $idcampo_1, true, $id, $uid);
		$html .= $script[0];
		if($modo != 1){
				$html .= "
			<div class='$classe[0]' id='$classe_id[0]' onclick='$funcao[0], exibe_dialogo(\"$dialogo_id[0]\");'>
			</div>
			$css[0]
			";
		}else{
						$html .= "
			<div class='$classe[0]' onclick='$funcao[0], exibe_dialogo(\"$dialogo_id[0]\");'>
			<img src='$url_host_thumbnail'>
			</div>
			";
		};
				return $html;
}else{
		return null;
};
};
function constroe_imagem_id($id){
global $tabela_banco;
$query = "select *from $tabela_banco[4] where id='$id';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return null;
};
$dados = $dados_query["dados"][0];
$url_host_miniatura = $dados[URL_HOST_MINIATURA];
$html = "
<div class='classe_imagem_album_usuario'>
<img src='$url_host_miniatura'>
</div>
";
return $html;
};
function constroe_imagens_album_usuario_modo_album(){
global $tabela_banco;
$modo_album = retorne_campo_formulario_request(58);
$tabela = $tabela_banco[4];
$uid = retorne_idusuario_request();
$limit_query = retorne_limit_query_iniciar(false, retorne_tipo_acao_pagina());
switch($modo_album){
	case 0:
		$query = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc $limit_query;";
	break;
	case 1:
		$query = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc $limit_query;";
	break;
	default:
		$query = "select *from $tabela where uid='$uid' and modo_chat='0' order by id desc $limit_query;";
};
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$html .= constroe_imagem_album_dados($dados, 4, null);
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_paginador_slide_album($dados, $idcampo_1){
$id = $dados["id"];
$uid = $dados[UID];
$funcao[0] = "paginar_slide_album(\"$id\", 0, \"$idcampo_1\", \"$uid\");";
$funcao[1] = "paginar_slide_album(\"$id\", 1, \"$idcampo_1\", \"$uid\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";
$imagem[0] = retorne_imagem_sistema(113, null, false);
$imagem[1] = retorne_imagem_sistema(114, null, false);
$html = "
<div class='classe_paginador_slide_album_1' $evento[0]>
$imagem[0]
</div>
<div class='classe_paginador_slide_album_2' $evento[1]>
$imagem[1]
</div>
";
return $html;
};
function constroe_visualizador_imagens_album(){
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;
$uid = retorne_idusuario_request();
$modo_pagina = retorne_modo_pagina();
$pagina = retorne_idpagina_request();
if($modo_pagina == true){
		$numero_imagens = retorne_numero_imagens_album_pagina($pagina);
		$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);
}else{
		$numero_imagens = retorne_numero_todas_imagens_usuario($uid);
		$usuario_dono = retorne_usuario_dono_perfil($uid);
};
if($numero_imagens == 0){
		if($usuario_dono == true){
				$numero_imagens = retorne_imagem_sistema(116, null, false);
	}else{
				$numero_imagens = $numero_imagens.$idioma_sistema[21];
	};
}else{
		if($numero_imagens > 1){
				$numero_imagens = retorne_tamanho_resultado($numero_imagens).$idioma_sistema[22];
	}else{
				$numero_imagens = $numero_imagens.$idioma_sistema[21];
	};
};
$url_index_inicio = PAGINA_INDEX_INICIO;
if($modo_pagina == true){
		$url[0] = "$url_index_inicio?$variavel_campo[25]=$pagina&$variavel_campo[2]=7";
}else{
		$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=7";
};
$link[0] = "<a href='$url[0]'>$numero_imagens</a>";
$html = "
<div class='classe_div_visualizador_album_abrir_visualizador' id='id_div_numero_imagens_visualizador_imagens_album_perfil'>
$link[0]
</div>
";
return $html;
};
function excluir_imagem_album(){
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;
if(retorne_usuario_logado() == false){
	    return null;
};
$id = retorne_campo_formulario_request(4);
$uid = retorne_idusuario_logado();
$query[0] = "select *from $tabela_banco[4] where id='$id' and uid='$uid';";
$query[1] = "delete from $tabela_banco[4] where id='$id' and uid='$uid';";
$query[2] = "select *from $tabela_banco[4] where uid='$uid';";
$dados_imagem = plugin_executa_query($query[0]);
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_GRANDE]);
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_MINIATURA]);
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_THUMBNAIL]);
excluir_todos_comentarios($id, $tabela_banco[4]);
exclui_curtidas_publicacao($id, $tabela_banco[4]);
plugin_executa_query($query[1]);
atualiza_retorna_dados_usuario_sessao(true, true);
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];
$numero_imagens = count($array_imagens) - 1;
if($numero_imagens > 1){
		$numero_imagens = retorne_tamanho_resultado($numero_imagens).$idioma_sistema[22];
}else{
		$numero_imagens = $numero_imagens.$idioma_sistema[21];
};
$url_index_inicio = PAGINA_INDEX_INICIO;
$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=7";
$link[0] = "<a href='$url[0]' title='$numero_imagens'>$numero_imagens</a>";
$array_retorno["linhas"] = $link[0];
remove_notifica(null, $id, $tabela_banco[4], true);
return json_encode($array_retorno);
};
function exclui_imagens_chave($chave){
global $tabela_banco;
if(retorne_usuario_logado() == false){
	    return null;
};
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela_banco[4] where uid='$idusuario' and chave='$chave';";
$query[1] = "delete from $tabela_banco[4] where uid='$idusuario' and chave='$chave';";
$dados_imagem = plugin_executa_query($query[0]);
$contador = 0;
for($contador == $contador; $contador <= $dados_imagem["linhas"]; $contador++){
	    excluir_todos_comentarios($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);
	    exclui_curtidas_publicacao($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);
		remove_notifica(null, $dados_imagem["dados"][$contador]["id"], $tabela_banco[4], true);
        exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_GRANDE]);
    exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_MINIATURA]);
	exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_THUMBNAIL]);
};
plugin_executa_query($query[1]);
atualiza_retorna_dados_usuario_sessao(true, true);
};
function paginar_slide_album(){
global $tabela_banco;
$id_imagem = retorne_campo_formulario_request(4);
$modo = retorne_campo_formulario_request(6);
$idusuario = retorne_idusuario_request();
$idcampo[0] = retorne_campo_formulario_request(21);
$tabela = $tabela_banco[4];
$pagina = retorne_idpagina_request();
if($pagina == null){
		$query = "select *from $tabela where uid='$idusuario' and modo_chat='0';";
}else{
		$query = "select *from $tabela where pagina='$pagina' and modo_chat='0';";	
};
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
		if($id != null){
				if($id == $id_imagem){
						$bkp_dados_volta = $dados_query["dados"][$contador + 1];
			$bkp_dados_avanca = $dados_query["dados"][$contador - 1];
						break;
		};
	};
};
if($modo == true){
		$dados = $bkp_dados_avanca;
}else{
		$dados = $bkp_dados_volta;
};
if($dados != null){
		$html = constroe_imagem_album_dados($dados, 5, $idcampo[0]);
		$array_retorno["limpar_dados_antigos"] = 1;
		$id = $dados["id"];
}else{
		$array_retorno["limpar_dados_antigos"] = 0;
		$id = $id_imagem;
};
$array_retorno["dados"] = $html;
$array_retorno["id"] = $id;
return json_encode($array_retorno);
};
function restaurar_imagem_album_dados(){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
$idcampo[0] = retorne_campo_formulario_request(21);
$tabela = $tabela_banco[4];
$query = "select *from $tabela where id='$id';";
$dados = retorne_dados_query($query);
$html = constroe_imagem_album_dados($dados, 5, $idcampo[0]);
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function retorne_modo_album(){
return retorne_campo_formulario_request(58) != null;
};
function retorne_numero_imagens_album_chave($chave){
global $tabela_banco;
$tabela = $tabela_banco[4];
$query = "select *from $tabela where chave='$chave';";
return retorne_numero_linhas_query($query);
};
function retorne_numero_imagens_album_pagina($pagina){
global $tabela_banco;
$tabela = $tabela_banco[4];
$query = "select *from $tabela where pagina='$pagina';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_numero_imagens_album_usuario($uid, $pagina){
global $tabela_banco;
$tabela = $tabela_banco[4];
$query = "select *from $tabela where uid='$uid' and modo_chat='0' and pagina='$pagina';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_numero_todas_imagens_usuario($uid){
global $tabela_banco;
$tabela = $tabela_banco[4];
$query = "select *from $tabela where uid='$uid' and modo_chat='0';";
return retorne_numero_linhas_query($query);
};
function retorne_uid_dono_imagem($id){
global $tabela_banco;
$query = "select *from $tabela_banco[4] where id='$id';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
return $dados[UID];
};
function alterar_senha(){
global $idioma_sistema;
global $tabela_banco;
$senha_atual = converte_minusculo(retorne_campo_formulario_request(15));
$nova_senha = converte_minusculo(retorne_campo_formulario_request(16));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(17));
$senha_usuario = retorna_senha_usuario_logado();
$nome_usuario = retorne_nome_usuario_logado();
if(codifica_md5($senha_atual) != $senha_usuario){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[139]);
		return json_encode($array_retorno);
};
if($nova_senha != $nova_senha_confirma){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[140]);
		return json_encode($array_retorno);
};
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[141].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
		return json_encode($array_retorno);
};
$idusuario = retorne_idusuario_logado();
$email = retorna_email_usuario_logado();
$data = data_atual();
$nova_senha = codifica_md5($nova_senha);
$query = "update $tabela_banco[0] set senha='$nova_senha', data='$data' where uid='$idusuario' and e_mail='$email';";
plugin_executa_query($query);
salva_sessao_usuario($email, $nova_senha, $idusuario);
$array_retorno["dados"] = 1;
return json_encode($array_retorno);
};
function adicionar_amizade(){
global $tabela_banco;
global $idioma_sistema;
$uidamigo = retorne_idusuario_request();
if(retorne_usuario_dono_perfil($uidamigo) == true){
		$array_retorno["dados"] = null;
		return json_encode($array_retorno);	
};
$idusuario = retorne_idusuario_logado();
$data = data_atual();
$modo = retorne_campo_formulario_request(6);
if(retorna_configuracao_privacidade(0, $uidamigo) == true and $modo == 1){
	    $email = retorne_campo_formulario_request(0);
	    $dados_compilados_usuario = retorne_dados_compilados_usuario($uidamigo);
        $dados_login = $dados_compilados_usuario[$tabela_banco[0]];
		if($email != $dados_login[E_MAIL]){
				$nome_usuario = retorne_nome_usuario(true, $uidamigo);
				$nome_usuario_logado = retorne_nome_usuario(true, $idusuario);
		        $array_retorno["dados"] = -1;
        $array_retorno["mensagem_retorno"] = mensagem_erro($nome_usuario_logado.$idioma_sistema[162].$nome_usuario.$idioma_sistema[163]);
                return json_encode($array_retorno);
	};
};
$query[0] = "select *from $tabela_banco[6] where (uid='$idusuario' and uidamigo='$uidamigo') or (uid='$uidamigo' and uidamigo='$idusuario');";
$query[1] = "delete from $tabela_banco[6] where (uid='$idusuario' and uidamigo='$uidamigo') or (uid='$uidamigo' and uidamigo='$idusuario');";
$query[2] = "insert into $tabela_banco[6] values(null, '$idusuario', '$uidamigo', '$idusuario', '0', null, null, null, null, null, null, null, '$data');";
$query[3] = "insert into $tabela_banco[6] values(null, '$uidamigo', '$idusuario', '$idusuario', '0', null, null, null, null, null, null, null, '$data');";
$query[4] = "update $tabela_banco[6] set aceito='1', data='$data' where (uid='$uidamigo' and uidamigo='$idusuario') or (uid='$idusuario' and uidamigo='$uidamigo');";
$dados_amizade = plugin_executa_query($query[0]);
if($modo == 1 and $dados_amizade["linhas"] != 0){
        $modo = null;
};
switch($modo){
    case 1:     plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
    break;
	case 2:     plugin_executa_query($query[1]);
		excluir_dados_amizade($uidamigo, true);
	break;
	case 3: 	plugin_executa_query($query[4]);
		atualiza_novos_feeds_usuario($uidamigo);
	break;
	case 4: 	plugin_executa_query($query[1]);
		excluir_dados_amizade($uidamigo, true);
	break;
	case 5: 	plugin_executa_query($query[1]);
		excluir_dados_amizade($uidamigo, true);
	break;
};
$dados_amizade = plugin_executa_query($query[0]);
if($modo == 1){
		adicionar_notifica($dados_amizade["dados"][0]["id"], $uidamigo, $tabela_banco[6], $tabela_banco[6], null);
};
if($modo == 3){
		adicionar_notifica($dados_amizade["dados"][0]["id"], $uidamigo, -1, $tabela_banco[6], null);
};
remover_recomendacoes_usuario();
erradicar_recomendacoes();
atualize_dados_amigo($idusuario, $uidamigo, true);
atualiza_retorna_dados_usuario_sessao(true, true);
$array_retorno["dados"] = null;
return json_encode($array_retorno);
};
function atualiza_numero_amigos_online(){
global $idioma_sistema;
$numero_online = retorne_tamanho_resultado(retorna_numero_amigos_online(retorne_idusuario_request()));
$array_retorno["dados"] = $idioma_sistema[386].$numero_online;
return json_encode($array_retorno);
};
function atualize_dados_amigo($uid, $uidamigo, $modo){
global $tabela_banco;
$tabela = $tabela_banco[6];
if($modo == true){
		$query = "select *from $tabela where uid='$uid' and uidamigo='$uidamigo';";
		if(retorne_numero_linhas_query($query) == 0){
				return null;
	};
		$query = null;
		$dados_perfil[0] = retorne_dados_perfil_usuario($uidamigo);
	$dados_perfil[1] = retorne_dados_perfil_usuario($uid);
		$nome[0] = $dados_perfil[0][NOME];
	$sobrenome[0] = $dados_perfil[0][SOBRENOME];
	$sexo[0] = $dados_perfil[0][SEXO];
	$cidade[0] = $dados_perfil[0][CIDADE];
	$estado[0] = $dados_perfil[0][ESTADO];
	$estuda[0] = $dados_perfil[0][ESTUDA];
	$trabalha[0] = $dados_perfil[0][TRABALHA];
		$nome[1] = $dados_perfil[1][NOME];
	$sobrenome[1] = $dados_perfil[1][SOBRENOME];
	$sexo[1] = $dados_perfil[1][SEXO];
	$cidade[1] = $dados_perfil[1][CIDADE];
	$estado[1] = $dados_perfil[1][ESTADO];
	$estuda[1] = $dados_perfil[1][ESTUDA];
	$trabalha[1] = $dados_perfil[1][TRABALHA];
		$query[] = "update $tabela set nome='$nome[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set sobrenome='$sobrenome[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set sexo='$sexo[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set cidade='$cidade[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set estado='$estado[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set estuda='$estuda[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set trabalha='$trabalha[0]' where uid='$uid' and uidamigo='$uidamigo';";
		$query[] = "update $tabela set nome='$nome[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set sobrenome='$sobrenome[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set sexo='$sexo[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set cidade='$cidade[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set estado='$estado[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set estuda='$estuda[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set trabalha='$trabalha[1]' where uid='$uid' and uid='$uidamigo';";
}else{
		$uid = retorne_idusuario_logado();
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		$nome = $dados_perfil[NOME];
	$sobrenome = $dados_perfil[SOBRENOME];
	$sexo = $dados_perfil[SEXO];
	$cidade = $dados_perfil[CIDADE];
	$estado = $dados_perfil[ESTADO];
	$estuda = $dados_perfil[ESTUDA];
	$trabalha = $dados_perfil[TRABALHA];
		$query[] = "update $tabela set nome='$nome' where uidamigo='$uid';";
	$query[] = "update $tabela set sobrenome='$sobrenome' where uidamigo='$uid';";
	$query[] = "update $tabela set sexo='$sexo' where uidamigo='$uid';";
	$query[] = "update $tabela set cidade='$cidade' where uidamigo='$uid';";
	$query[] = "update $tabela set estado='$estado' where uidamigo='$uid';";
	$query[] = "update $tabela set estuda='$estuda' where uidamigo='$uid';";
	$query[] = "update $tabela set trabalha='$trabalha' where uidamigo='$uid';";
};
plugin_executa_varias_query($query);
};
function campo_adicionar_pessoa($modo_perfil_grande, $modo, $idusuario){
global $tabela_banco;
global $idioma_sistema;
if(retorne_usuario_dono_perfil($idusuario) == true or retorne_usuario_logado() == false){
        return null;
};
if($modo_perfil_grande == true){
		$classe[0] = "classe_div_campo_adicionar_amizade_campo_add";
	$classe[1] = "classe_div_campo_adicionar_amizade";
}else{
		$classe[0] = "classe_div_campo_adicionar_amizade_campo_add_2";
	$classe[1] = "classe_div_campo_adicionar_amizade_2";	
};
$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);
$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];
$nome = $dados_perfil[NOME];
$nome_logado = $dados_perfil_logado[NOME];
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];
$contador = 0;
$idcampo[0] = codifica_md5("idcampo_adicionar_amizade_$idusuario".data_atual());
$idcampo[1] = codifica_md5("idcampo_adicionar_amizade_email_$idusuario".data_atual());
$idcampo[2] = codifica_md5("idcampo_adicionar_amizade_mensagem_$idusuario".data_atual());
$dialogo_id = retorne_idcampo_md5();
$idusuario_logado = retorne_idusuario_logado();
for($contador == $contador; $contador <= count($array_amizade); $contador++){
    	$dados_amizade = $array_amizade[$contador];
		$id = $dados_amizade["id"];
	$uid = $dados_amizade[UID];
    $uidamigo = $dados_amizade[UIDAMIGO];
	$uidenviou = $dados_amizade[UIDENVIOU];
    $aceito = $dados_amizade[ACEITO];
		if($id != null and $uidamigo == $idusuario_logado and $aceito == 1){
		        $tipo_acao = 4;
	            break;
	};
		if($id != null and $uidenviou == $idusuario_logado and $uidamigo == $idusuario and $aceito == 1){
		        $tipo_acao = 5;
	            break;
	};
		if($id != null and $uidenviou == $idusuario and $uidamigo == $idusuario_logado){
		        $tipo_acao = 3;
	            break;
	};
		if($id != null and $uidenviou == $idusuario_logado){
				$tipo_acao = 2;
				break;
	};
};
switch($tipo_acao){
	case 2: 		$texto_dialogo = "
	<div class='classe_campo_add_amizade_texto'>
	$idioma_sistema[45]$nome$idioma_sistema[46]
	</div>
	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 2);'>
	</div>
	";
		$titulo_dialogo = $idioma_sistema[48];
	    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[49]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[49]</span>
    ";
	break;
	case 3: 	    if(retorne_sexo_usuario($dados_perfil_logado) == true){
        $texto_dialogo = "$nome_logado$idioma_sistema[51]$nome$idioma_sistema[46]";
	}else{
	    $texto_dialogo = "$nome_logado$idioma_sistema[52]$nome$idioma_sistema[46]";
    };
		$texto_dialogo = "
	<div class='classe_campo_add_amizade_texto'>
	$texto_dialogo
	</div>
	<div class='classe_campo_add_amizade_elementos'>
	<div class='classe_campo_add_amizade_elementos_separa'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 3);'>
	</div>
	<div class='classe_campo_add_amizade_elementos_separa'>
	<input type='button' value='$idioma_sistema[53]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 4);'>
	</div>
	</div>
	";
		$titulo_dialogo = $idioma_sistema[57];
	    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[50]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[50]</span>
    ";
	break;
	case 4: 		$texto_dialogo = "
	<div class='classe_campo_add_amizade_texto'>
	$nome_logado$idioma_sistema[56]$nome$idioma_sistema[46]
	</div>
	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 4);'>
	</div>
	";
	    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[55]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[55]</span>
    ";
    	$titulo_dialogo = $idioma_sistema[55];
	break;
	case 5: 		$texto_dialogo = "
	<div class='classe_campo_add_amizade_texto'>
	$nome_logado$idioma_sistema[56]$nome$idioma_sistema[46]
	</div>
	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 5);'>
	</div>
	";
	    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[55]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[55]</span>
    ";
    	$titulo_dialogo = $idioma_sistema[55];
	break;
	default:
		$solicita_email = retorna_configuracao_privacidade(0, $idusuario);
		if(retorne_sexo_usuario($dados_perfil) == true){
	    $texto_dialogo = "$nome$idioma_sistema[44]";
	}else{
		$texto_dialogo = "$nome$idioma_sistema[54]";
	};
		if($solicita_email == false){
	    	    $texto_dialogo = "
	    <div class='classe_campo_add_amizade_texto'>
		$texto_dialogo
		</div>
		<div class='classe_campo_add_amizade_elementos'>
	    <input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);'>
	    </div>
		";
	}else{
			    $texto_dialogo = "
		<div class='classe_campo_add_amizade_texto' id='$idcampo[2]'>
		$texto_dialogo
		<br>
		$nome_logado$idioma_sistema[160]$nome$idioma_sistema[46]
		</div>
		<div class='classe_campo_add_amizade_elementos'>
		<input type='text' id='$idcampo[1]' placeholder='$idioma_sistema[161]$nome' onkeydown='if(event.keyCode == 13){adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);}'>
		<br>
		<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);'>
		</div>
		";
	};
	    $campo_adicionar = "
    <div class='$classe[0]' title='$idioma_sistema[43]' onclick='exibe_dialogo(\"$dialogo_id\")'>
	<span class='botao_padrao'>
	$idioma_sistema[43]
	</span>
	</div>
    ";
    	$titulo_dialogo = $idioma_sistema[47];
};
$campo_dialogo_adicionar = constroe_dialogo($titulo_dialogo, $texto_dialogo, $dialogo_id);
$html = "
<div class='$classe[1]'>
$campo_adicionar
</div>
";
if($modo == true){
		$dados_retorno["html"] = $html;
	$dados_retorno["dialogo"] = $campo_dialogo_adicionar;
		return $dados_retorno;
}else{
		$html .= $campo_dialogo_adicionar;
		return $html;
};
};
function campo_opcoes_visualizador_amigos($id_campo_visualizador){
global $idioma_sistema;
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];
$numero_amigos = retorne_numero_amigos($array_dados_amigos);
if($numero_amigos > 1){
        $numero_amigos = retorne_tamanho_resultado(retorne_numero_amigos($array_dados_amigos));
		$texto_campo[1] = $idioma_sistema[62].$numero_amigos.$idioma_sistema[63];
}else{
		$texto_campo[1] = $idioma_sistema[64].$numero_amigos.$idioma_sistema[65];
};
$funcao[0] = "carregar_visualizador_amigos(\"$id_campo_visualizador\")";
$funcao[1] = "visualizar_todas_amizades_inicial(\"$id_campo_visualizador\")";
$evento[0] = "onkeyup='$funcao[0];'";
$evento[1] = "onclick='$funcao[1];'";
$idcampo[0] = "id_campo_pesquisa_amigos_local";
$campo_pesquisa[0] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_1'>
<input type='text' id='$idcampo[0]' placeholder='$idioma_sistema[42]' $evento[0]>
</div>
";
$campo_pesquisa[1] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_2'>
<span class='span_link' $evento[1]>$texto_campo[1]</span>
</div>
";
$opcoes_pesquisa = constroe_opcoes_parametros_pesquisa_amigos($funcao, $idcampo[0]);
$campo_pesquisa[2] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_3'>
$opcoes_pesquisa
</div>
";
$html = "
<div class='classe_div_opcoes_visualizador_amigos classe_cor_2'>
$campo_pesquisa[0]
$campo_pesquisa[2]
$campo_pesquisa[1]
</div>
";
return $html;
};
function campo_visualizar_amigos_usuario(){
global $idioma_sistema;
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];
$numero_amigos = retorne_numero_amigos($array_dados_amigos);
$id_dialogo_visualizador = retorne_idcampo_md5();
$id_campo_visualizador = retorna_idcampo_conteudo_geral();
$opcoes_visualizador = campo_opcoes_visualizador_amigos($id_campo_visualizador);
$funcao[0] = "carregar_visualizador_amigos(\"$id_campo_visualizador\");";
$evento[0] = "onclick='$funcao[0]'";
$progresso[0] = campo_progresso_gif(retorna_idcampo_progresso_gif_geral());
$conteudo_dialogo = "
$opcoes_visualizador
<div class='classe_div_campo_visualizar_amigos_usuario' id='$id_campo_visualizador'></div>
$progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";
$array_retorno["campo_visualizador"] = constroe_dialogo($idioma_sistema[60], $conteudo_dialogo, $id_dialogo_visualizador);
$array_retorno["id_dialogo_visualizador"] = $id_dialogo_visualizador;
$array_retorno["id_campo_visualizador"] = $id_campo_visualizador;
$array_retorno["campo_conteudo"] = $conteudo_dialogo;
return $array_retorno;
};
function carregar_lista_amigos_perfil_basico($array_dados_amigos, $idusuario_informado){
if(is_array($array_dados_amigos) == true){
        $array_dados_amigos = inverte_array($array_dados_amigos);
};
$contador = 0;
foreach($array_dados_amigos as $dados){
		if($contador >= NUMERO_AMIGOS_CAMPO_PERFIL){
	            break;	
	};
$idusuario = retorne_idamigo_dados_amigo(true, $dados, $idusuario_informado);
if($idusuario != null){
    	$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, true, $idusuario);
		$html .= "
	<div class='classe_div_separa_amigo_visualizar_perfil'>
	$imagem_perfil_usuario
	</div>
	";
	    $contador++;
};
};
return $html;
};
function carrega_amigos_usuario($modo_chat, $modo_jason){
global $idioma_sistema;
global $tabela_banco;
$tabela = $tabela_banco[6];
$tipo_acao = retorne_campo_formulario_request(2);
$nome_pesquisa = converte_minusculo(retorne_campo_formulario_request(7));
if($nome_pesquisa == null){
		$parametro_pesquisa = retorne_campo_formulario_request(54);
};
$conteudo_compara_zera_contador = $parametro_pesquisa.$nome_pesquisa;
if($tipo_acao == 104){
		$tipo_acao = 14;
};
if($modo_chat == null){
        $modo_chat = retorne_campo_formulario_request(24);
};
if($modo_chat == 1){
		$uid = retorne_idusuario_logado();
}else{
		$uid = retorne_idusuario_request();
};
erradicar_atualizacoes_amizades_usuario($uid);
if($parametro_pesquisa != null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
};
if(retorne_zerar_contador_avanco_pesq_amigo_local($conteudo_compara_zera_contador) == true){
		$limpar_dados_antigos = 1;
		retorne_limit_query_iniciar(true, $tipo_acao);
		$limit_query = retorne_limit_query_iniciar(false, $tipo_acao);
}else{
		$limpar_dados_antigos = 0;
		$limit_query = retorne_limit_query_iniciar(false, $tipo_acao);
};
switch($parametro_pesquisa){
	case 0: 	$campo_tabela = "estuda";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;
	case 1: 	$campo_tabela = "trabalha";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;
	case 2: 	$campo_tabela = "cidade";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;
	case 3: 	$campo_tabela = "sexo";
	$valor_tabela = 2;
	$query = "select *from $tabela where uid='$uid' and $campo_tabela='$valor_tabela' order by id desc $limit_query;";
	break;
	case 4: 	$campo_tabela = "sexo";
	$valor_tabela = 1;
	$query = "select *from $tabela where uid='$uid' and $campo_tabela='$valor_tabela' order by id desc $limit_query;";
	break;
};
if(is_numeric($parametro_pesquisa) == false){
		if($nome_pesquisa == null){
				$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
	}else{
				$query = "select *from $tabela where uid='$uid' and (nome like '%$nome_pesquisa%' or sobrenome like '%$nome_pesquisa%') order by id desc $limit_query;";
	};
};
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
$idusuario_logado = retorne_idusuario_logado();
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($modo_chat == 1){
				$idusuario = retorne_idamigo_dados_amigo(true, $dados, $idusuario_logado);
	}else{
				$idusuario = retorne_idamigo_dados_amigo(true, $dados, $uid);
	};
		if($idusuario != null){
				$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $idusuario));
				if($modo_chat == 1){
						$imagem_perfil_usuario = constroe_imagem_perfil_miniatura(true, false, $idusuario);
						$classe[0] = "classe_div_separa_amigo_visualizar_perfil_chat";
		}else{
						$imagem_perfil_usuario = constroe_imagem_perfil_medio($idusuario);
						$classe[0] = "classe_div_separa_amigo_medio_visualizar_perfil classe_cor_2";
		};
				$perfil_basico_usuario = "
		<div class='$classe[0]'>
		$imagem_perfil_usuario
		</div>
		";
				$html .= $perfil_basico_usuario;
	};
};
if($modo_jason == true){
        $array_retorno["dados"] = $html;
    $array_retorno["limpar_dados_antigos"] = $limpar_dados_antigos;
        return json_encode($array_retorno);
}else{
		return $html;
};
};
function carrega_solicitacoes_amizade(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;
$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;
$modo = retorne_campo_formulario_request(14);
if($modo == null){
        $modo = 1;	
};
switch($modo){
    case 1: 	$query = "select *from $tabela_banco[6] where uid='$idusuario' and aceito='0' order by id desc $limit_query;";
    break;
	case 2: 	$query = "select *from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0' and uidenviou!='$idusuario' order by id desc $limit_query;";
	break;
};
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados_usuario = $dados_query["dados"][$contador];
		if($modo == 1){
			    $uid = $dados_usuario[UIDAMIGO];
	}else{
				$uid = $dados_usuario[UID];
	};
		if($uid != null){
				$campo_adicionar = campo_adicionar_pessoa(false, false, $uid);
				$perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);
				$campo_usuario = "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3'>
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		$campo_adicionar
		</div>
		</div>
		";
			    $lista_solicitacoes .= $campo_usuario;
	};
};
return $lista_solicitacoes;
};
function constroe_campo_visualizador_amigos_online(){
global $idioma_sistema;
$numero_online = retorne_tamanho_resultado(retorna_numero_amigos_online(retorne_idusuario_request()));
$idcampo[0] = codifica_md5("id_campo_exibe_numero_amigos_online_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_campo_dialogo_amigos_online_".retorne_contador_iteracao());
$idcampo[2] = codifica_md5("id_campo_lista_amigos_online_".retorne_contador_iteracao());
$idcampo[3] = retorne_idcampo_md5();
$funcao[0] = "exibir_amigos_online(\"$idcampo[2]\", \"$idcampo[3]\", 1)";
$funcao[1] = "exibir_amigos_online(\"$idcampo[2]\", \"$idcampo[3]\", 0)";
$evento[0] = "onclick='$funcao[1];'";
$evento[1] = "onclick='exibe_dialogo(\"$idcampo[1]\"), $funcao[0]'";
$campo[0] = "
<div class='classe_div_visualizador_amigos_perfil_online classe_cor_7' id='$idcampo[0]' $evento[1]>
$idioma_sistema[386]$numero_online
</div>
";
$funcoes = "atualizar_numero_amigos_online(\"$idcampo[0]\")";
$campo[1] = plugin_timer_sistema(2, $funcoes);
$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());
$titulo_dialogo = $idioma_sistema[387].$nome_usuario;
$progresso[0] = campo_progresso_gif($idcampo[3]);
$campo[2] = "
<div class='classe_div_visualizador_amigos_perfil_amigos' id='$idcampo[2]'></div>
$progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";
$campo[2] = constroe_dialogo($titulo_dialogo, $campo[2], $idcampo[1]);
$html = "
$campo[0]
$campo[1]
$campo[2]
";
return $html;
};
function constroe_imagem_perfil_miniatura_amizade($modo_medio, $modo_link, $modo, $uid){
global $variavel_campo;
$nome_usuario = retorne_nome_usuario($modo, $uid);
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
if($modo_medio == true){
		$url_host_miniatura = $dados_imagem[URL_HOST_MEDIO];
		$classe[0] = "classe_div_imagem_perfil_amigo_imagem_2";
}else{
		$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
		$classe[0] = "classe_div_imagem_perfil_amigo_imagem";
};
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
if($modo_link == true){
		$nome_link = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
}else{
		$nome_link = $nome_usuario;
};
if($modo == true){
		$campo[0] = "
	<div class='classe_div_imagem_perfil_amigo_nome_completo'>
	$nome_link
	</div>
	";
}else{
		$campo[0] = "
	<div class='classe_div_imagem_perfil_amigo_nome'>
	$nome_link
	</div>
	";
};
if($modo_link == true){
		$campo[1] = "
	<a href='$url_perfil_usuario' title='$nome_usuario'>
	<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
	</a>	
	";
}else{
		$campo[1] = "
	<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
	";	
};
$html = "
<div class='classe_div_imagem_perfil_amigo'>
<div class='$classe[0]'>
$campo[1]
</div>
$campo[0]
</div>
";
return $html;
};
function constroe_imagem_perfil_miniatura_topo($uid){
global $variavel_campo;
$nome_usuario = retorne_nome_usuario(false, $uid);
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$html = "
<div class='classe_div_imagem_perfil_topo'>
<div class='classe_div_imagem_perfil_imagem_topo'>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>
<div class='classe_div_imagem_perfil_topo_nome'>
$nome_usuario
</div>
</div>
";
return $html;
};
function constroe_opcoes_parametros_pesquisa_amigos($funcao_parametro, $idcampo_1){
global $idioma_sistema;
$array_opcoes = explode(",", $idioma_sistema[566]);
$contador = 0;
foreach($array_opcoes as $valor){
		if($valor != null){
				$funcao[0] = "altera_parametro_pesquisa_amigos(\"$contador\", \"$idcampo_1\")";
		$funcao[1] = $funcao_parametro[0];
				$evento[0] = "onclick='$funcao[0], $funcao[1];'";
				$campos[0] .= "
		<div class='classe_div_opcao_menu_suspense' $evento[0]>
		<span class='span_link'>$valor</span>
		</div>
		";
				$contador++;
	};
};
$campos[0] = "
<div class='classe_opcoes_parametros_pesquisa_amigos_titulo'>
$idioma_sistema[567]
</div>
$campos[0]
";
$campo[1] = constroe_menu_suspense(false, null, false, null, null, $campos[0]);
$html = "
<div class='classe_opcoes_parametros_pesquisa_amigos'>
$campo[1]
</div>
";
return $html;
};
function constroe_selecionador_amizade($evento_campo, $valor_atual, $titulo_campo, $idcampo_1, $idcampo_2, $relacao){
global $tabela_banco;
global $idioma_sistema;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];
$numero_amigos = retorne_numero_amigos($array_amizade);
$contador = 0;
$uid = retorne_idusuario_logado();
$relacionamento_serio = retorne_usuario_relacionamento_serio(null, $relacao);
for($contador == $contador; $contador <= $numero_amigos; $contador++){
		$dados = $array_amizade[$contador];
		$idusuario = retorne_idamigo_dados_amigo(true, $dados, $uid);
		if($idusuario != null){
				$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $idusuario));
				$array_options .= $nome_usuario.",";
				$array_valores .= $idusuario.",";
	};
};
if($relacao == NUMERO_RELACIONAMENTO_FILHOS){
		$valor_atual = null;
};
$evento[0] = "onclick='$evento_campo'";
$campo[0] .= carregar_relacionamento($relacao, 1);	
$campo[0] .= carregar_relacionamento($relacao, 0);
if($relacionamento_serio == false){
		$campo[1] = "
	<div class='classe_campo_selecionador_amizade_conteudo_separa_3'>
	<input type='button' value='$idioma_sistema[561]' $evento[0]>
	</div>
	";
};
$html = gerador_select_option_especial($array_options, $array_valores, $valor_atual, null, $idcampo_1, null);
$html = "
<div class='classe_campo_selecionador_amizade classe_cor_2'>
<div class='classe_campo_selecionador_amizade_titulo'>$titulo_campo</div>
<div class='classe_campo_selecionador_amizade_conteudo'>
<div class='classe_campo_selecionador_amizade_conteudo_separa_1'>$html</div>
$campo[1]
<div class='classe_campo_selecionador_amizade_conteudo_separa_2' id='$idcampo_2'>
$campo[0]
</div>
</div>
</div>
";
return $html;
};
function constroe_visualizador_amigos_perfil(){
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;
$uid = retorne_idusuario_request();
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];
$numero_amigos = retorne_numero_amigos($array_dados_amigos);
$lista_amigos = carregar_lista_amigos_perfil_basico($array_dados_amigos, $uid);
if($numero_amigos > 1){
        $numero_amigos = retorne_tamanho_resultado($numero_amigos).$idioma_sistema[58];
}else{
		$numero_amigos = $numero_amigos.$idioma_sistema[59];
};
$url_index_inicio = PAGINA_INDEX_INICIO;
$campo[0] = constroe_campo_visualizador_amigos_online();
$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=104";
$link[0] = "<a href='$url[0]' title='$numero_amigos'>$numero_amigos</a>";
$campo[1] = "
<div class='classe_div_visualizador_amigos_perfil'>
<div class='classe_div_visualizador_amigos_perfil_titulo classe_cor_29'>
$link[0]
$campo[0]
</div>
<div class='classe_div_visualizador_amigos_perfil_amigos'>
$lista_amigos
</div>
</div>
";
$html = "
$campo[1]
";
return $html;
};
function constroe_visualizar_amigos_usuario(){
$campo[0] = campo_visualizar_amigos_usuario();
return constroe_conteudo_padrao(true, $campo[0]["campo_conteudo"], null);
};
function erradicar_atualizacoes_amizades_usuario($uid){
global $tabela_banco;
$tabela = $tabela_banco[6];
$query = "select *from $tabela where uid='$uid' and nome is null;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				atualize_dados_amigo($uid, $uidamigo, true);
	};
};
};
function excluir_dados_amizade($uidamigo, $modo){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
foreach($tabela_banco as $tabela){
        switch($tabela){
		case $tabela_banco[0]: 		$tabela = null;
		break;
		case $tabela_banco[1]: 		$tabela = null;
		break;
		case $tabela_banco[2]: 		$tabela = null;
		break;
		case $tabela_banco[3]: 		$tabela = null;
		break;
		case $tabela_banco[4]: 		$tabela = null;
		break;
		case $tabela_banco[5]: 		$tabela = null;
		break;
		case $tabela_banco[10]: 		$tabela = null;
		break;
		case $tabela_banco[11]: 		$tabela = null;
		break;
		case $tabela_banco[12]: 		$tabela = null;
		break;
		case $tabela_banco[15]: 				if($modo == false){
			$tabela = null;
		};
		break;
		case $tabela_banco[16]: 		$tabela = null;
		break;
		case $tabela_banco[17]: 		$tabela = null;
		break;
		case $tabela_banco[18]: 		$tabela = null;
		break;
		case $tabela_banco[19]: 		$tabela = null;
		break;
		case $tabela_banco[20]: 		$tabela = null;
		break;
		case $tabela_banco[21]: 		$tabela = null;
		break;
	};
        if($tabela != null){
	    	    $query[0] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
        $query[1] = "delete from $tabela where uid='$uidamigo' and uidamigo='$idusuario';";
				plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);
	};
};
limpa_sessao_usuarios_abertos_chat($uidamigo);
};
function exibir_amigos_online(){
$uid = retorne_idusuario_request();
if(retorne_campo_formulario_request(20) == true){
		contador_avanco(retorne_campo_formulario_request(2), 2);
};
$contador = contador_avanco(retorne_campo_formulario_request(2), 3);
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);
$array_dados = retorne_array_amigos_online($uid);
for($contador == $contador; $contador <= $contador_final; $contador++){
		$uid = $array_dados[$contador];
		if($uid != null){
				$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uid);
				$classe[0] = "classe_div_separa_amigo_visualizar_perfil";
				$html .= "
		<div class='$classe[0]'>
		$imagem_perfil_usuario
		</div>
		";
	};
};
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = retorne_campo_formulario_request(20);
return json_encode($array_retorno);
};
function limpar_solicitacoes_amizade($modo){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
switch($modo){
    case 1: 	$query = "delete from $tabela_banco[6] where uid='$idusuario' and aceito='0';";
    break;
	case 2: 	$query = "delete from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0';";
	break;
};
plugin_executa_query($query);
};
function opcoes_solicitacoes_amizade($id_campo_conteudo){
global $idioma_sistema;
$idcampo = codifica_md5("select_option_opcoes_solicitacoes_amizade_".data_atual());
$modo_solicitacao = retorne_campo_formulario_request(14);
$numero_solicitacoes[0] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(1));
$numero_solicitacoes[1] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(2));
$array_options = "$idioma_sistema[123] - $numero_solicitacoes[0],$idioma_sistema[124] - $numero_solicitacoes[1]";
$array_valores = "1,2";
$html = gerador_select_option_especial($array_options, $array_valores, $modo_solicitacao, null, $idcampo, "alterar_modo_opcoes_solicitacao(\"$idcampo\", \"$id_campo_conteudo\");");
$html = "
<div class='classe_opcoes_solicitacoes_amizade'>
<div class='classe_opcoes_solicitacoes_amizade_titulo classe_cor_3'>$idioma_sistema[152]</div>
<div class='classe_opcoes_solicitacoes_amizade_campo_opcoes'>$html</div>
</div>
";
return $html;
};
function retorna_numero_amigos_online($idusuario){
global $tabela_banco;
$tabela = $tabela_banco[6];
$query = "select *from $tabela where uid='$idusuario' and aceito='1';";
$array_dados = plugin_executa_query($query);
$linhas = $array_dados["linhas"];
$contador[0] = 0;
$contador[1] = 0;
$numero_online = 0;
for($contador[0] == $contador[0]; $contador[0] <= $linhas; $contador[0]++){
		$dados = $array_dados["dados"][$contador[0]];
		$uid = retorne_idamigo_dados_amigo(true, $dados, $idusuario);
		if($uid != null){
				if(retorne_usuario_online($uid) == true){
						$numero_online++;
						$contador[1]++;
		};
	};
};
return $numero_online;
};
function retorne_array_amigos_online($idusuario){
global $tabela_banco;
$tabela = $tabela_banco[6];
$query = "select *from $tabela where uid='$idusuario' and aceito='1' order by id desc;";
$array_dados = plugin_executa_query($query);
$linhas = $array_dados["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $array_dados["dados"][$contador];
		$uid = retorne_idamigo_dados_amigo(true, $dados, $idusuario);
		if($uid != null and retorne_usuario_online($uid) == true){
				$array_retorno[] = $uid;
	};
};
return $array_retorno;
};
function retorne_array_amigos_separados(){
$array_amigos = retorne_array_amigos_usuario(null);
$contador = 0;
for($contador == $contador; $contador <= count($array_amigos); $contador++){
		$dados = $array_amigos[$contador];
		$retorno[] = $dados[0];
};
return $retorno;
};
function retorne_array_amigos_usuario($nome_pesquisa){
global $tabela_banco;
$nome_pesquisa = converte_minusculo($nome_pesquisa);
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];
if(is_array($array_amizade) == false){
        return null;
};
$array_amizade = inverte_array($array_amizade);
$numero_amigos = retorne_numero_amigos($array_amizade);
$idusuario = retorne_idusuario_logado();
$contador = 0;
for($contador == $contador; $contador <= $numero_amigos; $contador++){
		$dados = $array_amizade[$contador];
		$id = $dados["id"];
		if($id != null){
				$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $idusuario);
				$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $uidamigo));
				if($nome_pesquisa == null){
						$array_retorno[][0] = $uidamigo;
			$array_retorno[][1] = $nome_usuario;
		}else{
						if(retorna_palavra_chave_existe_string($nome_usuario, $nome_pesquisa) == true){
								$array_retorno[][0] = $uidamigo;
				$array_retorno[][1] = $nome_usuario;
			};
		};
	};
};
return $array_retorno;
};
function retorne_idamigo_dados_amigo($modo, $dados, $uid){
if($dados[ACEITO] == $modo){
		if($uid != $dados[UIDAMIGO]){
    					if($uid != $dados[UIDAMIGO]){
            			$idusuario = $dados[UIDAMIGO];
		};
	}else{
						$idusuario = $dados[UID];
    };
}else{
        return null;
};
return $idusuario;
};
function retorne_idamigo_request(){
global $variavel_campo;
return remove_html($_REQUEST[$variavel_campo[13]]);
};
function retorne_numero_amigos($array_dados_amigos){
if(count($array_dados_amigos) == 0){
	    return 0;
};
$contador = 0;
foreach($array_dados_amigos as $dados){
	    if($dados[ACEITO] == 1){
			    $contador++;
	};
};
return $contador;
};
function retorne_numero_solicitacoes_amizade($modo){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
switch($modo){
    case 1: 	$query = "select *from $tabela_banco[6] where uid='$idusuario' and aceito='0';";
    break;
	case 2: 	$query = "select *from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0' and uidenviou!='$idusuario';";
	break;
};
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_usuario_amigo($uid){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
if($uid == $idusuario or $uid == null){
		return false;
};
$tabela = $tabela_banco[6];
$query = "select *from $tabela where ((uid='$uid' and uidamigo='$idusuario') or (uid='$idusuario' and uidamigo='$uid')) and aceito='1';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"] == 2;
};
function retorne_zerar_contador_avanco_pesq_amigo_local($nome_pesquisa){
if($nome_pesquisa == null and $_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorna_token_pagina_requeste()] != null){
	    $_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorna_token_pagina_requeste()] = null;
		return true;
};
if($nome_pesquisa == null){
	    $_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorna_token_pagina_requeste()] = null;
	    return false;
};
if($_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorna_token_pagina_requeste()] == $nome_pesquisa){
    	return false;
}else{
        $_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorna_token_pagina_requeste()] = $nome_pesquisa;
		return true;
};
};
function campo_parabens_aniversario(){
global $idioma_sistema;
$uid = retorne_idusuario_logado();
$dados = retorne_dados_perfil_usuario($uid);
$data = $dados[NASCEU];
if(retorne_aniversario($data) == false){
		return null;
};
$idade = retorne_idade_usuario($data);
$nome_usuario = retorne_nome_usuario_logado();
$imagem_sistema[0] = retorne_imagem_sistema(44, null, false);
$html = "
<div class='classe_parabens_aniversario_texto'>
$idioma_sistema[334]$nome_usuario$idioma_sistema[335]$idade$idioma_sistema[336]
</div>
<div class='classe_parabens_aniversario_imagem'>
$imagem_sistema[0]
</div>
";
$html = mensagem_sucesso($html);
$html = "
<div class='classe_mensagem_parabens_aniversario'>$html</div>
";
return $html;
};
function carregar_aniversariantes(){
global $tabela_banco;
$tabela = $tabela_banco[25];
$uid = retorne_idusuario_logado();
if(retorne_campo_formulario_request(20) == 1){
		$limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);
}else{
		$limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);	
};
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";
$contador = 0;
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
				$html .= "
		<div class='classe_div_separa_amigo_visualizar_perfil'>$imagem_perfil_usuario</div>	
		";
	};
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_campo_aniversario(){
global $idioma_sistema;
$classe[0] = "classe_bloco_aniversariantes_perfil";
$numero_aniversariantes = retorne_numero_aniversariantes_usuario();
$campo_parabens = campo_parabens_aniversario();
if($numero_aniversariantes == 0 and $campo_parabens == null){
		return null;
};
$idcampo[0] = codifica_md5("id_dialogo_visualizar_aniversariantes_".data_atual());
$idcampo[1] = codifica_md5("id_campo_resultados_visualizar_aniversariantes_".data_atual());
$idcampo[2] = codifica_md5("id_barra_progresso_aniversariantes_".data_atual());
$funcao[0] = "carregar_aniversariantes(\"$idcampo[1]\", \"$idcampo[2]\", 1);";
$funcao[1] = "carregar_aniversariantes(\"$idcampo[1]\", \"$idcampo[2]\", 0);";
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\"), $funcao[0];'";
$evento[1] = "onclick='$funcao[1]'";
$evento[2] = "onscroll='$funcao[1]'";
$campo[0] = constroe_visualizar_aniversariantes_perfil_basico();
$barra_progresso[0] = campo_progresso_gif($idcampo[2]);
$campo[1] = "
<div class='classe_resultados_aniversariantes' id='$idcampo[1]' $evento[2]></div>
$barra_progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[1]>
$idioma_sistema[61]
</div>
";
$campo[1] = constroe_dialogo($idioma_sistema[331], $campo[1], $idcampo[0]);
$campo[2] = "
<div class='classe_abrir_aniversariantes classe_cor_3 classe_cor_5' $evento[0]>
<span class='span_link'>$idioma_sistema[332]</span>
</div>
";
if($numero_aniversariantes == 0){
		$campo[0] = null;
	$campo[1] = null;
	$campo[2] = null;
};
$html = "
<div class='$classe[0]'>
$campo_parabens
$campo[2]
$campo[0]
</div>
$campo[1]
";
return $html;
};
function constroe_visualizar_aniversariantes_perfil_basico(){
global $tabela_banco;
$tabela = $tabela_banco[25];
$uid = retorne_idusuario_logado();
$limit_query = "limit ".NUMERO_ANIVERSARIANTES_PERFIL;
$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
$contador = 0;
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
				$html .= "
		<div class='classe_div_separa_amigo_visualizar_perfil'>$imagem_perfil_usuario</div>	
		";
	};
};
return $html;
};
function erradicar_aniversarios_amigos(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela[0] = $tabela_banco[6];
$tabela[1] = $tabela_banco[25];
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];
$numero_amigos = retorne_numero_amigos($array_amizade);
$contador = 0;
$data = data_atual();
$query = "delete from $tabela[1] where uid='$uid';";
plugin_executa_query($query);
for($contador == $contador; $contador <= $numero_amigos; $contador++){
		$dados = $array_amizade[$contador];
		if($uid != null){
				$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $uid);
				$dados_perfil = retorne_dados_perfil_usuario($uidamigo);
				$nasceu = $dados_perfil[NASCEU];
				if(retorne_aniversario($nasceu) == true){
						$idade = retorne_idade_usuario($nasceu);
						$query = "insert into $tabela[1] values(null, '$uid', '$uidamigo', '$idade', '$data');";
						plugin_executa_query($query);
		};
	};
};
};
function retorne_aniversario($data){
global $codigos_especiais;
$dia_atual = date("d");
$mes_atual = date("m");
$data = explode($codigos_especiais[10], $data);
$dia = $data[0];
$mes = $data[1];
if($dia == null or $mes == null){
		return false;	
};
if($dia_atual == $dia and $mes_atual == $mes){
		return true;
}else{
		return false;
};
};
function retorne_idade_usuario($data){
global $codigos_especiais;
$dia_atual = date("d");
$mes_atual = date("m");
$ano_atual = date("Y");
$data = explode($codigos_especiais[10], $data);
$dia = $data[0];
$mes = $data[1];
$ano = $data[2];
if($dia == null or $mes == null or $ano == null or $ano == $ano_atual){
		return null;
};
$idade = $ano_atual - $data[2];
if($dia_atual < $dia or $mes_atual < $mes){
		$idade--;
};
return $idade;
};
function retorne_numero_aniversariantes_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[25];
$uid = retorne_idusuario_logado();
$query = "select *from $tabela where uid='$uid';";
$contador = 0;
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function constroe_apresentacao(){
global $frase_efeito;
$modo_mobile = retorne_modo_mobile();
if($modo_mobile == true){
		return null;
};
$dia_semana = retorne_numero_dia_semana();
switch($dia_semana){
	case 1:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(81, null, false);
	break;
	case 2:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(67, null, false);
	break;
	case 3:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(69, null, false);
	break;
	case 4:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(70, null, false);
	break;
	case 5:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(71, null, false);
	break;
	case 6;
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(72, null, false);
	break;
	case 7:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(73, null, false);
	break;
};
$campo[0] = $dados[URL_HOST_GRANDE];
$frase_dia = $frase_efeito[$dia_semana];
$campo[0] = "
<div class='classe_imagem_apresentacao'>
	$campo[0]
</div>
";
$campo[1] = "
<div class='classe_apresentacao_frase'>
	$frase_dia
</div>
";
$html = "
<div class='classe_apresentacao'>
	$campo[0]
	$campo[1]
</div>
";
return $html;
};
function criar_pasta($pasta){
global $idioma_sistema;
$pagina_inicial = PAGINA_INICIAL;
$html = "
<!DOCTYPE html>
<html>
	<head>
		<title>$idioma_sistema[210]</title>
		<meta charset='UTF-8'>
		<meta http-equiv='refresh' content='2; url=$pagina_inicial'/>
	</head>
	<body>
		$idioma_sistema[210]
	</body>
</html>
";
if($pasta != null or is_dir($pasta) == false){
        if(file_exists($pasta) == false){
                mkdir($pasta, 0777, true); 		
				$endereco_arquivo = $pasta."/index.html";
				salvar_arquivo($endereco_arquivo, $html);
    };
};
};
function excluir_pastas_subpastas($endereco_pasta_remover, $recriar){
if(is_dir($endereco_pasta_remover)){
	    $objects = scandir($endereco_pasta_remover);
	    foreach($objects as $object){
		        if($object != "." && $object != ".."){
			if(filetype($endereco_pasta_remover."/".$object) == "dir") excluir_pastas_subpastas($endereco_pasta_remover."/".$object, false); else unlink($endereco_pasta_remover."/".$object);
		};
	};
		reset($objects);
		rmdir($endereco_pasta_remover);
};
if($recriar == true){
		criar_pasta($endereco_pasta_remover);
};
};
function exclui_arquivo_unico($endereco_arquivo){
if($endereco_arquivo != null){
        @unlink($endereco_arquivo);
};
};
function ler_conteudo_arquivo($endereco_arquivo){
if($endereco_arquivo != null){
		return remove_comentarios_conteudo_arquivo(file_get_contents($endereco_arquivo));
}else{
		return null;
};
};
function plugin_listar_arquivos($endereco_pasta, $extensao, $auto_include){
$pasta_diretorio = new RecursiveDirectoryIterator($endereco_pasta);
$lista_arquivos = new RecursiveIteratorIterator($pasta_diretorio);
$arquivos_encontrados = array();
foreach($lista_arquivos as $informacao_arquivo){
		if($informacao_arquivo != null){
	            $extensao_arquivo = ".".pathinfo($informacao_arquivo, PATHINFO_EXTENSION);
	};
	    $endereco_arquivo = $informacao_arquivo->getPathname();
    $endereco_arquivo = str_ireplace("\\", "/", $endereco_arquivo);
		if($extensao_arquivo == $extensao){
				$arquivos_encontrados[] = $endereco_arquivo;
	};
		if($auto_include == true and $extensao_arquivo == $extensao){
	    	    include_once($endereco_arquivo);
	};
};
return $arquivos_encontrados;
};
function remove_comentarios_conteudo_arquivo($codigo_entrada){
$newStr  = '';
$commentTokens = array(T_COMMENT);
if (defined('T_DOC_COMMENT'))
$commentTokens[] = T_DOC_COMMENT; if (defined('T_ML_COMMENT'))
$commentTokens[] = T_ML_COMMENT;  $tokens = token_get_all($codigo_entrada);
foreach ($tokens as $token) {
if (is_array($token)) {
if (in_array($token[0], $commentTokens))
continue;
$token = $token[1];
};
$newStr .= $token;
};
$codigo_entrada = $newStr;
$codigo_entrada = preg_replace('!/\*.*?\*/!s', '', $codigo_entrada);
$codigo_entrada = preg_replace('#^\s*//.+$#m', "", $codigo_entrada);
$codigo_entrada = preg_replace('/\n\s*\n/', "\n", $codigo_entrada);
return $codigo_entrada; 
};
function salvar_arquivo($endereco, $conteudo){
$arquivo = fopen($endereco, "w+");
fwrite($arquivo, $conteudo);
fclose($arquivo);
};
function adicionar_ativar_usuario(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[30];
$data_hoje = retorne_data_dia_mes_ano();
$chave = codifica_md5($uid.$data_hoje.retorne_contador_iteracao());
$query[0] = "delete from $tabela where uid='$uid';";
$query[1] = "insert into $tabela values(null, '$uid', '$chave', 0, '$data_hoje');";
plugin_roda_query($query[0]);
plugin_roda_query($query[1]);
};
function campo_conta_ativada($uid){
global $idioma_sistema;
if(retorne_usuario_ativou_conta($uid) == false){
		return null;
};
if(retorne_usuario_dono_perfil($uid) == true){
		$tooltip = gera_tooltip("$idioma_sistema[618]$idioma_sistema[163]");
}else{
		$tooltip = gera_tooltip("$idioma_sistema[617]$idioma_sistema[163]");
};
$imagem_sistema[0] = retorne_imagem_sistema(134, null, false);
$html = "
<div class='classe_campo_conta_ativada' $tooltip>
	$imagem_sistema[0]
</div>
";
return $html;
};
function constroe_campo_mensagem_ativar_usuario(){
global $idioma_sistema;
global $variavel_campo;
if(retorne_usuario_logado() == false or ATIVADOR_HABILITADO == false){
		return null;
};
if(retorne_usuario_logado_ativou_conta() == true){
		return null;
};
$email = retorna_email_usuario_logado();
$mensagem[0] = retorne_nome_usuario_logado().$idioma_sistema[425];
$url_inicio = PAGINA_INDEX_INICIO;
$link[0] = "<a href='$url_inicio?$variavel_campo[2]=100' title='$idioma_sistema[426]'>$idioma_sistema[427]$email</a>";
$campo[0] = "
<div class='classe_mensagem_ativar_conta_usuario'>
$mensagem[0]
</div>
<div class='classe_mensagem_ativar_conta_usuario_link'>
$link[0]
</div>
";
$campo[0] = mensagem_informa($campo[0]);
$html = "
<div class='classe_campo_ativar_usuario'>
$campo[0]
</div>
";
return $html;
};
function reenviar_ativacao_usuario(){
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;
$url_inicio = PAGINA_INDEX_INICIO;
$nome_usuario = retorne_nome_usuario_logado();
if(retorne_usuario_logado_ativou_conta() == true){
		$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[429]);
	$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";
		return $html;
};
$uid = retorne_idusuario_logado();
$data_hoje = retorne_data_dia_mes_ano();
$tabela = $tabela_banco[30];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_roda_query($query);
$dados = $dados_query["dados"][0];
$id = $dados["id"];
$uid = $dados[UID];
$chave = $dados[CHAVE];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];
if($chave == retorna_chave_request()){
		$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();
		$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];
		$query = "delete from $tabela where uid='$uid' and chave='$chave';";
		plugin_roda_query($query);
		if(retorne_sexo_usuario($dados_perfil_logado) == true){
				$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[434]);
	}else{
        		$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[435]);	
	};
		$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";
		return $html;	
};
if($tentativas > NUMERO_REENVIAR_ATIVACAO_DIA and $data == $data_hoje){
		$mensagem[0] = mensagem_erro($nome_usuario.$idioma_sistema[428]);
	$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";
		return $html;
};
if($data == $data_hoje){
		$tentativas++;
}else{
		$tentativas = 0;
};
$query = "update $tabela set tentativas='$tentativas', data='$data_hoje' where uid='$uid';";
plugin_roda_query($query);
$url[0] = "<a href='$url_inicio?$variavel_campo[2]=100&$variavel_campo[3]=$chave' title='$idioma_sistema[426]'>$idioma_sistema[431]</a>";
$mensagem[0] = "
$nome_usuario$idioma_sistema[432]
<br>
<br>
$url[0]
";
$assunto_mensagem = $idioma_sistema[433].NOME_SISTEMA;
enviar_email(retorna_email_usuario_logado(), $assunto_mensagem, $mensagem[0]);
$mensagem[1] = mensagem_sucesso($nome_usuario.$idioma_sistema[430]);
$html = "
<div class='classe_campo_reenviar_ativador_usuario'>
$mensagem[1]
</div>	
";
return $html;
};
function retorne_usuario_ativou_conta($uid){
global $tabela_banco;
$tabela = $tabela_banco[30];
$query = "select *from $tabela where uid='$uid';";
$array_dados = plugin_roda_query($query);
if($array_dados["linhas"] == 0){
		return true;
}else{
		return false;
};
};
function retorne_usuario_logado_ativou_conta(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[30];
$query = "select *from $tabela where uid='$uid';";
$array_dados = plugin_roda_query($query);
if($array_dados["linhas"] == 0){
		return true;
}else{
		return false;
};
};
function constroe_balao_notifica($idcampo, $valor){
$html = "
<div class='balao_notifica' id='$idcampo'>$valor</div>
";
return $html;
};
function constroe_campos_tabela_banco($chave, $corpo){
if($chave == null or $corpo == null){
        return null;
};
$campos_tabela = explode(",", $corpo);
foreach($campos_tabela as $campo){
		if($campo != null){
				$campos_encontrados .= trata_campo_tabela($campo, true);
	};
};
return $chave.substr($campos_encontrados,0, -2);
};
function trata_campo_tabela($campo, $modo_instalar){
$campo = trim($campo);
$campo = converte_minusculo($campo);
$campo = str_ireplace("-", "_", $campo);
$campo = str_ireplace(" ", "_", $campo);
$campo = str_ireplace(":", "_", $campo);
if($modo_instalar == true){
	    $campo = "$campo text, ";
};
return $campo;
};
function retorna_conteudo_bloqueado($conteudo){
global $chave_improprio;
$uid = retorne_idusuario_logado();
$palavras_chave = retorna_configuracao_privacidade(3, $uid);
$bloqueia_pornografia = retorna_configuracao_privacidade(2, $uid);
if($palavras_chave != null){
		$bloqueio[0] = retorne_palavra_impropria($conteudo, $palavras_chave);
};
if($bloqueia_pornografia == true){
		$bloqueio[1] = retorne_palavra_impropria($conteudo, $chave_improprio);
};
if($bloqueio[0] == true or $bloqueio[1] == true){
		return true;
}else{
		return false;
};
};
function retorne_palavra_impropria($conteudo, $chave_parametro){
global $chave_improprio;
if($chave_parametro == null){
		$chave_parametro = $chave_improprio;
};
$palavras = explode(",", $chave_parametro);
$conteudo_array = explode(" ", $conteudo);
foreach($palavras as $palavra_chave){
		if($palavra_chave != null){
				if(retorna_palavra_chave_existe_string($conteudo, $palavra_chave) == true){
						return true;
		};
	};
};
return false;
};
function bloquear_usuario(){
global $tabela_banco;
$tabela[0] = $tabela_banco[10];
$tabela[1] = $tabela_banco[37];
$data = data_atual();
$uidamigo = retorne_idusuario_request();
if(retorne_pode_bloquear($uidamigo) == false){
		return null;
};
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela[0] where uid='$idusuario' and uidamigo='$uidamigo';";
$query[1] = "insert into $tabela[0] values(null, '$idusuario', '$uidamigo', '$idusuario', '$data');";
$query[2] = "insert into $tabela[0] values(null, '$uidamigo', '$idusuario', '$idusuario', '$data');";
$query[3] = "delete from $tabela[1] where uid='$idusuario' and uidamigo='$uidamigo';";
$dados_query = plugin_executa_query($query[0]);
excluir_dados_amizade($uidamigo, false);
if($dados_query["linhas"] == 0){
	    plugin_executa_query($query[1]);
    plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
};
limpa_sessao_usuarios_abertos_chat($uidamigo);
atualiza_retorna_dados_usuario_sessao(true, true);
remover_recomendacoes_usuario();
erradicar_recomendacoes();
$array_retorno["dados"] = null;
return json_encode($array_retorno);
};
function campo_bloquear_usuario($modo, $idusuario){
global $idioma_sistema;
if(retorne_usuario_dono_perfil($idusuario) == true or retorne_pode_bloquear($idusuario) == false){
        return null;	
};
$nome_usuario = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $idusuario);
$id_dialogo = codifica_md5("dialogo_bloq_desbloq_amigo_$idusuario".data_atual());
if(retorne_usuario_bloqueio($idusuario) == true){
	    $campo_bloquear = "
	<div class='classe_campo_texto_bloquear'>
    $nome_usuario$idioma_sistema[129]$nome_amigo$idioma_sistema[46]
	</div>
	<div class='classe_campo_botao_bloquear'>
    <input type='button' value='$idioma_sistema[32]' onclick='desbloquear_usuario(\"$idusuario\");'>
    </div>
	";
        $campo_bloquear_dialogo = constroe_dialogo($idioma_sistema[131].$nome_amigo, $campo_bloquear, $id_dialogo);
        $campo_bloquear = "
    <span class='botao_padrao' onclick='exibe_dialogo(\"$id_dialogo\");'>$idioma_sistema[130]</span>
    ";	
		$html = "
	<div class='classe_campo_desbloquear_usuario'>
	$campo_bloquear
	</div>
	";
}else{
        $campo_bloquear = "
	<div class='classe_campo_texto_bloquear'>
    $nome_usuario$idioma_sistema[100]$nome_amigo$idioma_sistema[46]
	</div>
	<div class='classe_campo_botao_bloquear'>
    <input type='button' value='$idioma_sistema[32]' onclick='bloquear_usuario(\"$idusuario\");'>
    </div>
	";
        $campo_bloquear_dialogo = constroe_dialogo($idioma_sistema[101].$nome_amigo, $campo_bloquear, $id_dialogo);
        $campo_bloquear = "
    <span class='span_link' onclick='exibe_dialogo(\"$id_dialogo\");'>$idioma_sistema[102]</span>
    ";	
		$html = "
	<div class='classe_campo_bloquear_usuario'>
	$campo_bloquear
	</div>
	";
};
if($modo == true){
		$array_retorno["html"] = $html;
	$array_retorno["dialogo"] = $campo_bloquear_dialogo;
		return $array_retorno;
}else{
		$html .= $campo_bloquear_dialogo;
		return $html;
};
};
function carrega_usuarios_bloqueados($modo){
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_bloqueio = $dados_compilados_usuario[$tabela_banco[10]];
$array_dados_bloqueio = inverte_array($array_dados_bloqueio);
if(is_array($array_dados_bloqueio) == false){
        return null;
};
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);
for($contador == $contador; $contador <= $contador_final; $contador++){
        if($array_dados_bloqueio[$contador][UIDAMIGO] != null){
                $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $array_dados_bloqueio[$contador][UIDAMIGO]);
				$campo_bloqueio = campo_bloquear_usuario(false, $array_dados_bloqueio[$contador][UIDAMIGO]);
				$html .= "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3'>
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		$campo_bloqueio
		</div>
		</div>
		";
	};
};
return $html;
};
function desbloquear_usuario(){
global $tabela_banco;
$uidamigo = retorne_idusuario_request();
$idusuario = retorne_idusuario_logado();
$query[0] = "delete from $tabela_banco[10] where uid='$idusuario' and uidamigo='$uidamigo' and uidbloqueou='$idusuario';";
$query[1] = "delete from $tabela_banco[10] where uid='$uidamigo' and uidamigo='$idusuario' and uidbloqueou='$idusuario';";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
$array_retorno["dados"] = null;
return json_encode($array_retorno);
};
function retorne_pode_bloquear($idusuario){
global $tabela_banco;
global $administradores_sistema;
$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];
foreach($administradores_sistema as $email_administrador){
		if($email_administrador != null and $email_administrador == $dados_perfil[E_MAIL]){
				return false;
	};
};
return true;
};
function retorne_usuario_bloqueio($idusuario){
global $tabela_banco;
if(retorne_usuario_dono_perfil($idusuario) == true){
	    return false;
};
$idusuario_logado = retorne_idusuario_logado();
$query = "select *from $tabela_banco[10] where uid='$idusuario_logado' and uidamigo='$idusuario';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"] != 0;
};
function constroe_caixa($modo, $conteudo){
if($conteudo == null){
		return null;
};
if($modo == true){
		$classe[0] = "classe_div_caixa_sistema_2 borda_div_5";
}else{
		$classe[0] = "classe_div_caixa_sistema";
};
$html = "
<div class='$classe[0]'>
<div class='classe_div_caixa_sistema_conteudo'>
$conteudo
</div>
</div>
";
return $html;
};
function constroe_caixa_descritiva($titulo, $conteudo, $imagem){
if($imagem != null){
		$campo[0] = "
	<div class='classe_caixa_descritiva_imagem'>$imagem</div>
	<div class='classe_caixa_descritiva_conteudo_imagem'>
	<div class='balao_esquerdo'>$conteudo</div>
	</div>
	";
}else{
		$campo[0] = "
	<div class='classe_caixa_descritiva_conteudo'>$conteudo</div>
	";
};
$html = "
<div class='classe_caixa_descritiva'>
<div class='classe_caixa_descritiva_titulo classe_cor_5 classe_cor_8'>
$titulo
</div>
$campo[0]
</div>
";
return $html;
};
function campo_reposicionar_capa($idcampo_1){
$imagem_sistema[1] = retorne_imagem_sistema(127, null, false);
$imagem_sistema[2] = retorne_imagem_sistema(128, null, false);
$evento[1] = "onclick='reposicionar_capa(1, \"$idcampo_1\");'";
$evento[2] = "onclick='reposicionar_capa(2, \"$idcampo_1\");'";
$campo[1] = "
<div class='classe_campo_reposicionar_capa_opcao_1' $evento[1]>
	$imagem_sistema[1]
</div>
";
$campo[2] = "
<div class='classe_campo_reposicionar_capa_opcao_2' $evento[2]>
	$imagem_sistema[2]
</div>
";
$html = "
<div class='classe_campo_reposicionar_capa'>
	$campo[1]
	$campo[2]
</div>
";
return $html;
};
function constroe_capa_perfil_usuario($uid){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[3];
if($uid == null){
		$uid = retorne_idusuario_request();
};
if(retorne_perfil_privado($uid) == true){
		return null;
};
if(retorne_usuario_logado() == false){
		return null;
};
$query = "select *from $tabela where uid='$uid';";
$dados = retorne_dados_query($query);
$usuario_dono = retorne_usuario_dono_perfil($uid);
$url_host_grande = $dados[URL_HOST_GRANDE];
$topo = $dados[TOPO]."px";
if($usuario_dono == false and $url_host_grande == null){
		return null;
};
if($usuario_dono == true and $url_host_grande == null){
		$url_host_grande = retorne_imagem_sistema(129, null, true);
};
if($url_host_grande != null){
		$classe_id[0] = retorne_idcampo_md5();
		$propriedade_css[0] = "
	background-image: url(\"$url_host_grande\");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 50% $topo;
	";
		$css[0] = constroe_css_manual(null, $classe_id[0], $propriedade_css[0]);
		$campo[1] = "
	<div class='classe_div_capa_usuario_imagem' id='$classe_id[0]' title='$idioma_sistema[19]'>
	</div>
	$css[0]
	";
};
if($usuario_dono == true){
		$campo[0] = constroe_opcoes_capa(false, $classe_id[0], $dados);
};
$html = "
<div class='classe_div_capa_usuario classe_cor_35'>
	$campo[0]
	$campo[1]
</div>
";
return $html;
};
function constroe_opcoes_capa($modo, $idcampo_1, $dados){
global $idioma_sistema;
$uid = retorne_idusuario_request();
if($modo == true){
		$pagina = retorne_idpagina_request();
		if(retorne_usuario_dono_pagina($uid, $pagina) == false){
				return null;
	};
		$classe[0] = "classe_div_opcoes_capa_pagina";
		$id = $dados["id"];
}else{
		if(retorne_usuario_dono_perfil($uid) == false){
				return null;
	};
		$classe[0] = "classe_div_opcoes_capa";
		$id = $dados[UID];
};
$funcao[0] = "excluir_capa($pagina)";
$evento[0] = "onclick='$funcao[0]'";
$campo[0] = "
<span class='span_link' $evento[0]>
	$idioma_sistema[476]
</span>
";
$campo[0] = "
<div class='classe_div_opcao_menu_suspense'>
	$campo[0]
</div>
";
$html = "
$campo[0]
";
$menu_suspense[0] = constroe_menu_suspense(false, null, false, 1, retorne_idcampo_md5(), $html);
if($modo == true){
		$campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_campo_upload_imagem_capa_perfil", "foto", 55, false, 1);
}else{
		$campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_campo_upload_imagem_capa_perfil", "foto", 5, false, 1);
};
$campo_adicionar_capa = "
<div class='classe_div_capa_usuario_campo_upload'>
	$campo_upload
</div>
";
if($id != null){
		$campo_reposicionar = campo_reposicionar_capa($idcampo_1);
};
$html = "
<div class='classe_div_capa_usuario_upload'>
	$campo_adicionar_capa
	$campo_reposicionar
	<div class='$classe[0]'>
		$menu_suspense[0]
	</div>
</div>
";
return $html;
};
function excluir_capa(){
global $tabela_banco;
$pagina = retorne_idpagina_request();
$uid = retorne_idusuario_logado();
if($pagina != null){
		if(retorne_usuario_logado_dono_pagina($pagina) == false){
				return null;
	};
		$tabela[0] = $tabela_banco[21];
	$tabela[1] = $tabela_banco[5];	
		excluir_pastas_subpastas(retorne_pasta_usuario($uid, 10, true), true);
		$query[0] = "delete from $tabela[0] where id='$pagina';";
	$query[1] = "delete from $tabela[1] where uid='$uid' and pagina='$pagina' and modo='2';";
}else{
		$tabela[0] = $tabela_banco[3];
	$tabela[1] = $tabela_banco[5];	
		excluir_pastas_subpastas(retorne_pasta_usuario($uid, 8, true), true);
		$query[0] = "delete from $tabela[0] where uid='$uid';";
	$query[1] = "delete from $tabela[1] where uid='$uid' and modo='2';";
};
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
};
function reposicionar_capa(){
global $tabela_banco;
$modo = retorne_campo_formulario_request(6);
$idcampo = retorne_campo_formulario_request(21);
$altura_capa = retorne_campo_formulario_request(59);
$uid = retorne_idusuario_logado();
$pagina = retorne_idpagina_request();
$modo_pagina = retorne_modo_pagina();
if($modo_pagina == true){
		if(retorne_usuario_dono_pagina($uid, $pagina) == false){
				return null;
	};
		$tabela = $tabela_banco[21];
		$query = "select *from $tabela where id='$pagina';";
}else{
		$tabela = $tabela_banco[3];
		$query = "select *from $tabela where uid='$uid';";
};
$dados = retorne_dados_query($query);
$topo = $dados[TOPO];
$url_root_grande = $dados[URL_ROOT_GRANDE];
list($largura, $altura) = getimagesize($url_root_grande);
switch($modo){
	case 1: 		$topo -= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA;
	break;
	case 2: 		$topo += NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA;
	break;
};
if($topo >= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA){
		$topo = 0;
};
$altura_1 = ($altura - $altura_capa);
$altura_2 = abs($topo);
if($altura_2 > $altura_1 and $modo == 1){
		return null;
};
if($topo <= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA_PARAR){
		return null;
};
if($modo_pagina == true){
		$query = "update $tabela set topo='$topo' where id='$pagina';";
}else{
		$query = "update $tabela set topo='$topo' where uid='$uid';";
};
retorne_dados_query($query);
$topo .= "px";
$array_retorno["dados"] = "
<script>
	document.getElementById(\"$idcampo\").style.backgroundPosition = '50% $topo';
</script>
";
return json_encode($array_retorno);
};
function retorne_usa_capa(){
global $tabela_banco;
if(retorne_modo_pagina() == true){
		$uid = retorne_idusuario_logado();
		$pagina = retorne_idpagina_request();
		if(retorne_usuario_dono_pagina($uid, $pagina) == true){
				return true;
	};
		$tabela = $tabela_banco[21];
		$query = "select url_host_grande from $tabela where id='$pagina';";
}else{
		$uid = retorne_idusuario_request();
		if(retorne_usuario_dono_perfil($uid) == true){
				return true;
	};
		$tabela = $tabela_banco[3];
		$query = "select url_host_grande from $tabela where uid='$uid';";
};
$dados = retorne_dados_query($query);
return $dados[URL_HOST_GRANDE] != null;
};
function adicionar_usuario_janela_usuarios_abertos_chat(){
global $idioma_sistema;
$uidamigo = retorne_campo_formulario_request(13);
atualiza_sessao_usuarios_abertos_chat($uidamigo, 1);
$idcampo[0] = codifica_md5("id_usuario_janela_usuarios_abertos_chat_".$uidamigo);
$idcampo[1] = retorna_id_janela_usuario_janela_usuarios_abertos_chat($uidamigo);
$evento[0] = "onclick='constroe_janela_chat(\"$uidamigo\", 1, \"$idcampo[1]\")';";
$imagem_perfil = constroe_imagem_perfil_miniatura_amizade(false, false, false, $uidamigo);
$html = "
<div class='classe_usuarios_abertos_chat classe_cor_2 classe_cor_5' id='$idcampo[1]' $evento[0]>
$imagem_perfil
</div>
";
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function aloca_mensagens_chat(){
global $tabela_banco;
$tabela = $tabela_banco[6];
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where uid='$idusuario' and aceito='1';";
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
$contador = 0;
$array_retorno = array();
$numero_abertos = retorne_numero_usuarios_abertos_chat();
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($dados["id"] != null){
				$id = $dados["id"];
        $uid = $dados[UID];
        $uidamigo = $dados[UIDAMIGO];
        $uidenviou = $dados[UIDENVIOU];
				if($uid != $idusuario){
						$uidamigo_tabela = $uid;
		};
				if($uidamigo != $idusuario){
						$uidamigo_tabela = $uidamigo;
		};
				$numero_novas_mensagens = retorne_numero_mensagens(2, $uidamigo_tabela);
				if($numero_novas_mensagens == 0){
						$numero_novas_mensagens = null;
		}else{
						$numero_novas_mensagens = retorne_tamanho_resultado($numero_novas_mensagens);
		};
				$array_retorno[$contador][0] = $uidamigo_tabela;
		$array_retorno[$contador][1] = retorne_numero_mensagens(4, $uidamigo_tabela);
		$array_retorno[$contador][2] = $numero_novas_mensagens;
		$array_retorno[$contador][3] = $numero_abertos;
	};
};
return $array_retorno;
};
function atualizador_chat_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[6];
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where uid='$idusuario' and aceito='1';";
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
$contador = 0;
$numero_online = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($dados["id"] != null){
				$id = $dados["id"];
        $uid = $dados[UID];
        $uidamigo = $dados[UIDAMIGO];
        $uidenviou = $dados[UIDENVIOU];
				if($uid != $idusuario){
						$uidamigo_tabela = $uid;
		};
				if($uidamigo != $idusuario){
						$uidamigo_tabela = $uidamigo;
		};
        		if(retorne_usuario_online($uidamigo_tabela) == true){
					    $imagem_sistema[0] = retorne_imagem_sistema(18, null, false);
		    		    $numero_online++;
		}else{
					    $imagem_sistema[0] = retorne_imagem_sistema(19, null, false);
		};
				$array_dados[$contador][0] = $uidamigo_tabela;
        $array_dados[$contador][1] = $imagem_sistema[0];
		$array_dados[$contador][2] = $numero_online;
	};
};
$array_retorno["dados"] = $array_dados;
$array_retorno["mensagens"] = aloca_mensagens_chat();
return json_encode($array_retorno);
};
function atualiza_sessao_usuarios_abertos_chat($uid, $modo){
switch($modo){
    case 1:
	$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid] = $uid;
    break;
	case 2:
	unset($_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid]);
	break;
	case 3:
	return $_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT];
	break;
	case 4:
	unset($_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT]);
	break;
};
};
function campo_opcoes_janela_troca_mensagens_chat($uidamigo){
global $idioma_sistema;
$imagem_sistema[0] = retorne_imagem_sistema(98, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(16, null, false);
$idcampo[0] = retorna_id_janela_usuario_janela_usuarios_abertos_chat($uidamigo);
$idcampo[1] = codifica_md5("id_menu_suspense_opcoes_janela_troca_mensagens_chat_".$uidamigo);
$idcampo[2] = PREFIXO_CHAT_USUARIO_ONLINE_5.$uidamigo;
$eventos[0] = "onclick='fechar_janela_chat(\"$uidamigo\", \"$idcampo[0]\");'";
$eventos[1] = "onclick='excluir_mensagem_usuario(null, null, \"$uidamigo\", \"1\"), exibe_elemento_oculto(\"$idcampo[1]\", null);'";
$campo[0] = "
<div class='classe_div_opcao_menu_suspense' id='$idcampo[2]' $eventos[1]>
<span class='span_link'>$idioma_sistema[268]</span>
</div>
";
$campo[0] = constroe_menu_suspense(false, null, false, 125, $idcampo[1], $campo[0]);
$campo[1] = "
<div class='classe_opcoes_janela_troca_mensagens_chat_div_3' id='$idcampo[2]'>
$imagem_sistema[1]
</div>
";
$html = "
<div class='classe_opcoes_janela_troca_mensagens_chat classe_cor_1'>
$campo[1]
<div class='classe_opcoes_janela_troca_mensagens_chat_div_1' $eventos[0]>
$imagem_sistema[0]
</div>
<div class='classe_opcoes_janela_troca_mensagens_chat_div_2'>
$campo[0]
</div>
</div>
";
return $html;
};
function carregar_mensagens_usuario_chat(){
global $tabela_banco;
$tabela = $tabela_banco[15];
$idusuario = retorne_idusuario_logado();
$uidamigo = retorne_idusuario_request();
$contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 3);
$numero_mensagens = retorne_numero_mensagens(4, $uidamigo);
$idcampo[0] = md5("NUMERO_MENSAGENS_".$uidamigo.retorna_token_pagina_requeste());
$idcampo[1] = md5("NUMERO_NOVAS_MENSAGENS_".$uidamigo.retorna_token_pagina_requeste());
if($_SESSION[$idcampo[0]] != $numero_mensagens){
		$numero_novas_mensagens = $numero_mensagens - $_SESSION[$idcampo[0]];
	    $_SESSION[$idcampo[0]] = $numero_mensagens;
}else{
		if($contador_avanco > 0){
				$array_retorno["dados"] = null;
				return json_encode($array_retorno);
	};
};
if($contador_avanco == 0){
			if($numero_mensagens >= NUMERO_VALOR_PAGINACAO){
				$numero_mensagens -= NUMERO_VALOR_PAGINACAO;
	}else{
				$numero_mensagens = 0;
	};
		$limit = "limit $numero_mensagens, ".NUMERO_VALOR_PAGINACAO;
		$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id asc $limit;";
}else{
		$numero_mensagens -= $numero_novas_mensagens;
		$limit = "limit $numero_mensagens, ".NUMERO_VALOR_PAGINACAO;
		$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id asc $limit;";
};
contador_avanco(retorne_tipo_acao_pagina(), 1);
seta_mensagem_visualizada($uidamigo);
$array_retorno["dados"] = constroe_mensagem_chat(plugin_executa_query($query), false);
return json_encode($array_retorno);
};
function constroe_chat_usuario(){
global $idioma_sistema;
if(retorne_pode_construir_chat() == false){
		return null;
};
$uid = retorne_idusuario_logado();
$modo_mobile = retorne_modo_mobile();
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_id_janela_principal_chat();
$idcampo[3] = PREFIXO_CHAT_USUARIO_ONLINE_4;
$idcampo[4] = PREFIXO_CHAT_USUARIO_ONLINE_6;
$idcampo[5] = retorne_idcampo_md5();
$idcampo[6] = retorne_idcampo_md5();
$funcao[0] = "pesquisar_amigos_chat(\"$idcampo[0]\", \"$idcampo[1]\");";
$funcao[1] = "pesquisar_amigos_chat(null, \"$idcampo[1]\");";
$funcao[2] = "paginar_amigos_chat(\"$idcampo[1]\");";
$funcao[3] = "minimizar_chat_usuario(\"$idcampo[2]\", \"$idcampo[5]\");";
$funcao[4] = constroe_lista_inicializar_chat();
$eventos[0] = "onkeyup='$funcao[0]'";
$eventos[1] = "onscroll='$funcao[1]'";
$eventos[2] = "onclick='$funcao[3]'";
if($modo_mobile == true){
		$eventos[2] = null;
};
$numero_amigos_online = retorne_tamanho_resultado(retorna_numero_amigos_online($uid));
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
$campo_topo = "
<div class='classe_chat_usuario_topo classe_cor_1' $eventos[2]>
<span>$idioma_sistema[229] - </span>
<span id='$idcampo[3]'>$numero_amigos_online</span>
</div>
";
$campo_usuarios = "
<div class='classe_chat_usuario_usuarios cor_borda_div' id='$idcampo[1]' $eventos[1]></div>
";
$campo_pesquisa = "
<div class='classe_chat_pesquisa_amigos' id='$idcampo[6]'>
<input type='text' placeholder='$idioma_sistema[230]' id='$idcampo[0]' $eventos[0]>
</div>
";
$janela_troca_mensagens = constroe_janela_troca_mensagens_chat();
$campo_atualizador[0] = "
\n
atualizador_chat_usuario();
\n
";
$campo_atualizador[0] = plugin_timer_sistema(3, $campo_atualizador[0]);
$campo_usuarios_abertos = janela_usuarios_abertos_chat();
if($modo_mobile == false){
		$classe[0] = "classe_chat_cor_1";
};
$imagem_perfil = constroe_imagem_perfil_miniatura_sem_nome($uid, true);
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
return $html;
};
function constroe_conteudo_janela_troca_mensagens_chat(){
global $idioma_sistema;
$imagem_sistema[0] = retorne_imagem_sistema(106, null, false);
$modo_mobile = retorne_modo_mobile();
$uidamigo = retorne_campo_formulario_request(13);
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = retorne_campo_formulario_request(13);
$imagem_perfil = constroe_imagem_perfil_miniatura(false, false, $uidamigo);
$idcampo[0] = codifica_md5("id_campo_entrada_envia_mensagem_chat_".data_atual().$uidamigo);
$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_2.$uidamigo;
$idcampo[2] = codifica_md5("id_formulario_upload_imagem_chat_".$uidamigo);
$funcao[0] = "ocultar_elementos_chat_digitar(\"0\", \"$idcampo[1]\")";
$funcao[1] = "ocultar_elementos_chat_digitar(\"1\", \"$idcampo[1]\")";
$funcao[2] = "enviar_mensagem_usuario(event.keyCode, \"$uidamigo\", \"$idcampo[0]\", null, null);";
$funcao[3] = "enviar_mensagem_usuario(13, \"$uidamigo\", \"$idcampo[0]\", null, null);";
$eventos[0] = "onkeydown='$funcao[2]'";
if($modo_mobile == true){
		$eventos[1] = "onfocus='$funcao[0]'";
	$eventos[2] = "onblur='$funcao[1]'";
};
$eventos[4] = "onclick='$funcao[3]'";
$campo_emoticons = constroe_visualizador_emoticons(true, true, true, $idcampo[0]);
$campo_emoticons = "
<div class='classe_novo_chat_usuario_emoticons'>
$campo_emoticons
</div>
";
$campo_enviar = "
<div class='classe_campo_enviar_mensagem_chat' $eventos[4]>
$imagem_sistema[0]
</div>
";
if($modo_mobile == true){
		$eventos[3] = "onkeypress='$funcao[0]'";
};
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, "$eventos[0] $eventos[1] $eventos[2] $eventos[3]", $idioma_sistema[231]);
$campo_opcoes = campo_opcoes_janela_troca_mensagens_chat($uidamigo);
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[2], "fotos[]", 51, true, 1, "");
$html = "
<div class='classe_novo_chat_usuario'>
$campo_opcoes
<div class='classe_novo_chat_usuario_topo borda_div_3'>
$imagem_perfil
</div>
<div class='classe_novo_chat_usuario_mensagens cor_borda_div classe_cor_22 borda_div_3' id='$idcampo[1]'></div>
<div class='classe_novo_chat_usuario_entrada'>
$campo_entrada
$campo_emoticons
$campo_enviar
</div>
<div class='classe_novo_chat_usuario_upload_imagem'>
$campo_upload_imagem
</div>
</div>
";
seta_mensagem_visualizada($uidamigo);
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = null;
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_imagem_perfil_miniatura_chat($uid){
global $variavel_campo;
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$html = "
<div class='classe_div_imagem_perfil_miniatura_div_img'>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>
<div class='classe_div_imagem_perfil_miniatura_div_nome_chat_troca_mensagens'>
$nome_link_usuario
</div>
";
$classe[0] = "classe_div_imagem_perfil_miniatura";
$html = "
<div class='$classe[0]' $evento[0]>
$html
</div>
";
return $html;
};
function constroe_janela_troca_mensagens_chat(){
$idcampo[0] = retorne_id_janela_chat_mensagens();
$imagem_sistema[0] = retorne_imagem_sistema(16, null, false);
$html = "
<div class='classe_janela_troca_mensagens classe_chat_cor_1' id='$idcampo[0]'>
<div class='classe_janela_troca_mensagens_barra_progresso'>
$imagem_sistema[0]
</div>
</div>
";
return $html;
};
function constroe_lista_inicializar_chat(){
if(retorne_pode_construir_chat() == false){
		return null;
};
$lista_usuarios = atualiza_sessao_usuarios_abertos_chat(null, 3);
if(is_array($lista_usuarios) == false){
		return null;
};
foreach($lista_usuarios as $uid){
		if($uid != null){
				$html .= "
		\n
		constroe_janela_chat(\"$uid\", 0, null);
		\n
		";
	};
};
return $html;
};
function constroe_mensagem_chat($dados_query, $modo){
global $idioma_sistema;
$contador = 0;
$numero_linhas = $dados_query["linhas"];
$idusuario = retorne_idusuario_logado();
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
    $uidenviou = $dados[UIDENVIOU];
    $data = $dados[DATA];
	$mensagem = $dados[MENSAGEM];
	$chave_imagem = $dados[CHAVE_IMAGEM];
		if($id != null){
	    	    if($uidenviou == $idusuario){
						$classe = "classe_mensagem_chat_1";
		}else{
						$classe = "classe_mensagem_chat_2";
		};
				if($chave_imagem == true){
						$classe = "classe_imagem_mensagem_chat";
		};
	    	    $data = converte_data_amigavel(true, $data);
				$mensagem = converter_urls(true, $mensagem);
	    	    $html .= "
	    <div class='classe_mensagem_chat' title='$data'>
		<div class='$classe'>$mensagem</div>
		</div>
	    ";
	};
};
return $html;
};
function excluir_imagens_chat($uidamigo){
global $tabela_banco;
$tabela = $tabela_banco[4];
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
$dados_query = plugin_executa_query($query[0]);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
    $url_root_grande = $dados[URL_ROOT_GRANDE];
    $url_root_miniatura = $dados[URL_ROOT_MINIATURA];
	$url_root_thumbnail = $dados[URL_ROOT_THUMBNAIL];
		if($id != null){
	    	    exclui_arquivo_unico($url_root_grande);
	    exclui_arquivo_unico($url_root_miniatura);
		exclui_arquivo_unico($url_root_thumbnail);
	};
};
$query[1] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
plugin_executa_query($query[1]);
};
function fechar_janela_chat(){
atualiza_sessao_usuarios_abertos_chat(retorne_campo_formulario_request(13), 2);
};
function janela_usuarios_abertos_chat(){
global $idioma_sistema;
$idcampo[0] = retorne_id_janela_usuarios_abertos_chat(1);
$idcampo[1] = PREFIXO_CHAT_ABERTOS_NUMERO_6;
$idcampo[2] = retorne_id_janela_usuarios_abertos_chat(0);
$campo_progresso[0] = campo_progresso_gif(null);
$html = "
<div class='classe_janela_usuarios_abertos_chat classe_chat_cor_1' id='$idcampo[2]'>
<div class='classe_janela_usuarios_abertos_chat_topo classe_cor_1'>
<span>$idioma_sistema[234]</span>
<span id='$idcampo[1]'>$campo_progresso[0]</span>
</div>
<div class='classe_janela_usuarios_abertos_chat_usuarios' id='$idcampo[0]'></div>
</div>
";
return $html;
};
function limpa_sessao_usuarios_abertos_chat($uid){
if($uid == null){
		$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT] = null;
}else{
		$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid] = null;
};
};
function retorna_id_janela_usuario_janela_usuarios_abertos_chat($uid){
return codifica_md5(PREFIXO_CHAT_ID_JANELA_USUARIO_ABERTO_LISTA.$uid);
};
function retorne_id_janela_chat_mensagens(){
return codifica_md5("id_janela_chat_mensagens_".retorne_idusuario_logado().data_atual());
};
function retorne_id_janela_principal_chat(){
return codifica_md5("janela_chat_".PREFIXO_JANELA_PRINCIPAL_CHAT);
};
function retorne_id_janela_usuarios_abertos_chat($modo){
switch($modo){
	case 0:
		return codifica_md5("janela_usuarios_abertos_chat_".retorne_idusuario_logado());
	break;
    case 1:
        return codifica_md5("lista_usuarios_abertos_chat_".retorne_idusuario_logado());
    break;
};
};
function retorne_novo_id_janela_chat_mensagens(){
return codifica_md5("novo_id_janela_chat_mensagens_".data_atual().retorne_idusuario_logado());
};
function retorne_numero_usuarios_abertos_chat(){
return retorne_tamanho_resultado(count(atualiza_sessao_usuarios_abertos_chat(null, 3)));
};
function retorne_pode_construir_chat(){
global $tabela_banco;
if(retorne_usuario_logado() == false or HABILITAR_MODULO_CHAT == false){
	    return false;
};
if(retorna_configuracao_privacidade(9, retorne_idusuario_logado()) == true){
	    return false;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];
if(retorne_numero_amigos($array_dados_amigos) > 0){
		return true;
}else{
		return false;
};
};
function retorna_chave_request(){
global $variavel_campo;
return remove_html($_REQUEST[$variavel_campo[3]]);
};
function retorna_seta_chave_publicacao($modo){
global $tabela_banco;
if($modo == true){
	    $chave = codifica_md5(retorne_idusuario_request().retorne_contador_iteracao().data_atual());
		$_SESSION[SESSAO_CHAVE_PUBLICACAO] = $chave;
	    return $_SESSION[SESSAO_CHAVE_PUBLICACAO];
}else{
	    return $_SESSION[SESSAO_CHAVE_PUBLICACAO];
};
};
function carregar_comentarios(){
global $tabela_banco;
global $idioma_sistema;
$id = retorne_campo_formulario_request(4);
$comentario = retorne_campo_formulario_request(9);
$tabela = retorne_tabela_comentario(retorne_campo_formulario_request(10));
$elemento_id = retorne_campo_formulario_request(12);
if(retorne_usuario_logado() == false or $tabela == null){
        return null;
};
$contador_final = contador_avanco_comentario(retorne_campo_formulario_request(2), 1, $id, $elemento_id) - NUMERO_VALOR_PAGINACAO;
$limit_query = "limit $contador_final, ".NUMERO_VALOR_PAGINACAO;
$contador_final += NUMERO_VALOR_PAGINACAO;
$numero_comentarios = retorne_numero_comentarios(retorne_campo_formulario_request(10), $id);
$query[0] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' order by id desc $limit_query;";
$query[1] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' limit $contador_final, $numero_comentarios;";
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);
$linhas[0] = $dados_query[0]["linhas"];
$linhas[1] = $dados_query[1]["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas[0]; $contador++){
		$dados = $dados_query[0]["dados"][$contador];
		$lista_comentarios .= constroe_comentario($dados);
};
$array_retorno["dados"] = $lista_comentarios;
$array_retorno["linhas"] = $linhas[0];
$nome_usuario = retorne_nome_usuario_logado();
if($linhas[1] > 1){
		$linhas[1] = retorne_tamanho_resultado($linhas[1]);
	    $campo_numero_resultados = "
    $nome_usuario$idioma_sistema[83]$linhas[1]$idioma_sistema[84]
    ";
}else{
	    $campo_numero_resultados = "
    $nome_usuario$idioma_sistema[85]$linhas[1]$idioma_sistema[86]
	";
};
if($linhas[1] == 0){
		$campo_numero_resultados = $nome_usuario.$idioma_sistema[82];
};
$array_retorno["linhas_faltam"] = $campo_numero_resultados;
return json_encode($array_retorno);
};
function constroe_campo_comentario($tabela_comentario, $tipo_campo, $id, $modo, $idusuario){
global $idioma_sistema;
global $tabela_banco;
$uid = retorne_idusuario_logado();
switch($tipo_campo){
	case 1:
		if(retorne_pode_interagir_social($id, false) == false){
				return null;
	};
	break;
	case 2:
		if(retorne_usuario_amigo($idusuario) == false and retorne_usuario_dono_perfil($idusuario) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
	case 3:
		if(retorne_pode_responder_comentario($id) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
};
if(retorne_idpagina_request() != null){
		if(retorne_configuracao_pagina(retorne_idpagina_request(), 0) == false){
				return null;
	};
};
$chave = codifica_md5("id_campo_comentario_".$tipo_campo.$id.$modo.$idusuario.data_atual());
$nome = retorne_nome_usuario_logado();
if(retorna_configuracao_privacidade(5, $idusuario) == true){
		return null;
};
switch($tipo_campo){
    case 1:
		$placeholder = $nome.$idioma_sistema[73];
		$classe[0] = "classe_div_campo_comentario_perfil";
	$classe[2] = "classe_div_campo_comentario_campo_entrada";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes";
	$classe[4] = null;
    break;
	case 2:
		$placeholder = $nome.$idioma_sistema[74];
		$classe[0] = "classe_div_campo_comentario_perfil_album";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_album";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_album";
	$classe[4] = "classe_visualizador_comentarios_scroll";
	break;
	case 3:
		$placeholder = $nome.$idioma_sistema[345];
		$classe[0] = "classe_div_campo_comentario_perfil_responde";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_responde";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_responde";
	$classe[4] = null;
		$modo_responder = true;
	break;
};
switch($tabela_comentario){
	case $tabela_banco[4]:
	$classe[0] = "classe_div_campo_comentario_perfil_responde_album";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_responde_album";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_responde_album";
	break;
};
$id_campo_entrada_comentario = codifica_md5("id_campo_entrada_comentario".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$id_visualizador_comentarios = codifica_md5("id_visualizador_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$id_campo_numero_comentarios = codifica_md5("id_campo_numero_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$id_campo_paginar_comentarios = codifica_md5("id_campo_paginar_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$idcampo[0] = codifica_md5("id_campo_responder_comentario_span_".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_campo_responder_comentario_".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$barra_progresso[0] = campo_progresso_gif($idcampo[4]);
$funcao[0] = "carregar_comentarios(\"$tipo_campo\", \"$id\", \"$id_visualizador_comentarios\", \"$id_campo_paginar_comentarios\", \"$idcampo[4]\")";
$funcao[1] = "exibir_responder_comentario(\"$idcampo[0]\", \"$idcampo[1]\")";
$funcao[2] = "exibe_elemento_oculto(\"$idcampo[2]\", 3)";
$funcao[3] = "postar_comentario(\"$id_campo_entrada_comentario\", \"$id_visualizador_comentarios\", \"$tipo_campo\", \"$id\", \"$id_campo_numero_comentarios\", \"$id_campo_paginar_comentarios\", \"$idusuario\", \"$idcampo[3]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[3]}'";
$evento[2] = "onclick='$funcao[0], $funcao[1]'";
$evento[3] = "onscroll='$funcao[0]'";
$evento[4] = "onclick='$funcao[0], $funcao[2]'";
$evento[5] = "onclick='$funcao[3]'";
$campo_responde_mobile = "
<div class='classe_responde_comentario_mobile'>
	<span class='span_link' $evento[5]>
		$idioma_sistema[611]
	</span>
</div>
";
$numero_comentarios = retorne_tamanho_resultado(retorne_numero_comentarios($tipo_campo, $id));
$campo_marcar = constroe_campo_marcar($id_campo_entrada_comentario, $chave, $id, $tabela_banco[7]);
$campo[1] = constroe_visualizador_emoticons(true, false, true, $id_campo_entrada_comentario);
$campo[1] = "
<div class='classe_separa_item_campo_comentario'>$campo[1]</div>
";
if($modo_responder == false){
		$campo_extra[0] = constroe_imagem_perfil_miniatura_publicacao(false, $uid);
		$campo_extra[0] = "
	<div class='$classe[0]'>
	$campo_extra[0]
	</div>
	";
};
$campo_entrada = constroe_campo_div_editavel(true, $id_campo_entrada_comentario, null, "classe_entrada_campo_comentario", $evento[1], $placeholder);
$campo_entrada = "
<div class='$classe[2]'>
$campo_entrada
</div>
";
$campo[2] = "
<div class='classe_div_comentar_numeros span_link' id='$id_campo_numero_comentarios' $evento[2]>
$idioma_sistema[75]$idioma_sistema[76]$numero_comentarios$idioma_sistema[77]
</div>
<div class='classe_div_campo_comentario'>
$campo_extra[0]
$campo_entrada
$campo_responde_mobile
<div class='$classe[3]'>
$campo[1]
$campo_marcar
</div>
</div>
<div class='classe_visualizador_comentarios $classe[4]' id='$id_visualizador_comentarios' $evento[3]></div>
$barra_progresso[0]
<span class='classe_campo_paginar_comentarios span_link' id='$id_campo_paginar_comentarios' $evento[0]>
$idioma_sistema[81]
</span>
";
if($tipo_campo == 3){
		$classe[1] = "classe_campo_comentario_entrada_2";
		$campo[2] = "
	<div class='classe_campo_responde_comentario_span' id='$idcampo[0]' $evento[2]>
	<span class='span_link'>$idioma_sistema[346] ($numero_comentarios)</span>
	</div>
	<div class='classe_campo_responde_comentario cor_borda_div classe_cor_4' id='$idcampo[1]'>
	$campo[2]
	</div>
	";
}else{
		$classe[1] = "classe_campo_comentario_entrada";
};
if($tipo_campo != 3){
		$imagem[0] = retorne_imagem_sistema(90, null, false);
		$campo[3] = "
	<div class='classe_campo_comentario classe_cor_4' $evento[4]>
	<span class='classe_campo_comentario_separa_1'>$imagem[0]</span>
	<span class='classe_campo_comentario_separa_2 span_link' id='$idcampo[3]'>
	$numero_comentarios
	</span>
	</div>
	";
};
$html = "
$campo[3]
<div class='$classe[1]' id='$idcampo[2]'>
$campo[2]
</div>
";
return $html;
};
function constroe_campo_gerencia_comentario($dados, $id_campo_texto_comentario, $id_comentario_usuario){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$id_post = $dados[ID_POST];
$comentario = $dados[COMENTARIO];
$tabela_comentario = $dados[TABELA_COMENTARIO];
$data = $dados[DATA];
if($id == null){
		return null;
};
$tabela_comentario = retorne_tabela_comentario($tabela_comentario);
$dados_publicacao = retorne_dados_publicacao($id_post);
$idusuario_logado = retorne_idusuario_logado();
if($dados_publicacao[UID] != $idusuario_logado and $uid != $idusuario_logado){
	    return null;
};
$nome_usuario_logado = retorne_nome_usuario_logado();
$id_campo_entrada[0] = codifica_md5("campo_entrada_atualiza_comentario_".$id.$idusuario_logado);
$id_dialogo_editar = codifica_md5("id_dialogo_editar".$id.$idusuario_logado);
$campo[0] = constroe_campo_div_editavel(true, $id_campo_entrada[0], html_entity_decode($comentario), null, null, $idioma_sistema[91]);
$campo_editar = "
<div class='classe_div_campo_edita_comentario_texto'>
$campo[0]
</div>
<div class='classe_div_campo_edita_comentario_salva'>
<input type='button' value='$idioma_sistema[12]' onclick='salvar_comentario_editado(\"$id_campo_entrada[0]\", \"$id\", \"$id_campo_texto_comentario\", \"$id_dialogo_editar\");'>
</div>
";
$campo_editar = constroe_dialogo($idioma_sistema[90], $campo_editar, $id_dialogo_editar);
$campo_editar = "
<div class='classe_div_opcoes_comentario_separa' onclick='exibe_dialogo(\"$id_dialogo_editar\");'>
<span class='span_link'>$idioma_sistema[87]</span>
</div>
$campo_editar
";
$id_dialogo_excluir = codifica_md5("id_dialogo_excluir_".$id.$idusuario_logado);
if(retorne_usuario_dono_comentario($uid) == true){
        $mensagem_dialogo_excluir = "$nome_usuario_logado$idioma_sistema[92]";
}else{
        $mensagem_dialogo_excluir = "$nome_usuario_logado$idioma_sistema[88]";
		$campo_editar = null;
};
$campo_excluir = "
<div class='classe_texto_caixa_dialogo'>
$mensagem_dialogo_excluir
</div>
<div class='classe_botao_caixa_dialogo'>
<input type='button' value='$idioma_sistema[29]' onclick='excluir_comentario(\"$id\", \"$uid\", \"$id_comentario_usuario\", \"$id_dialogo_excluir\", \"$tabela_comentario\", \"$id_post\");'>
</div>
";
$campo_excluir = constroe_dialogo($idioma_sistema[89], $campo_excluir, $id_dialogo_excluir);
$campo_excluir = "
<div class='classe_div_opcoes_comentario_separa' onclick='exibe_dialogo(\"$id_dialogo_excluir\");'>
<span class='span_link'>$idioma_sistema[29]</span>
</div>
$campo_excluir
";
$html = "
$campo_editar
$campo_excluir
";
$html = "
<div class='classe_div_opcoes_comentario'>
$html
</div>
";
return $html;
};
function constroe_comentario($dados){
global $idioma_sistema;
global $tabela_banco;
$id = $dados["id"];
$uid = $dados[UID];
$id_post = $dados[ID_POST];
$comentario = $dados[COMENTARIO];
$tabela_comentario = $dados[TABELA_COMENTARIO];
$data = $dados[DATA];
if($id == null){
		return null;
};
switch($tabela_comentario){
	case $tabela_banco[4]:
		$classe[0] = "classe_comentario_usuario_separa_4";
	break;
	default:
		$classe[0] = "classe_comentario_usuario_separa_2";
};
if(retorna_conteudo_bloqueado($comentario) == true){
		$comentario = converte_improprio($comentario);
};
$imagem_perfil = constroe_imagem_perfil_comentario($uid);
$data = converte_data_amigavel(true, $data);
$id_campo_texto_comentario = codifica_md5("id_campo_texto_comentario_".$id);
$id_comentario_usuario = codifica_md5("id_comentario_usuario_".$id);
$campo_gerenciar_comentario = constroe_campo_gerencia_comentario($dados, $id_campo_texto_comentario, $id_comentario_usuario);
$comentario = converter_urls(false, $comentario);
$comentario = converte_conteudo_hashtag($comentario);
$nome = retorne_nome_link_usuario(true, $uid);
$comentario = $nome.$comentario;
$campo_marcacao = constroe_marcacoes_usuarios($id, $tabela_banco[7]);
if(retorne_tabela_comentario($tabela_comentario) != 3){
		$campo[0] = constroe_campo_comentario($tabela_comentario, 3, $id, true, $uid);
		$campo[0] = "
	<div class='classe_comentario_usuario_responder'>$campo[0]</div>
	";
		$classe[1] = "classe_comentario_usuario_separa_1";
}else{
		$classe[0] = "classe_comentario_usuario_separa_3";
	$classe[1] = "classe_comentario_usuario_separa_5";
};
if($campo_marcacao == null){
		$campo[1] = "
	<div class='classe_comentario_usuario_conteudo_padrao' id='$id_campo_texto_comentario'>
	$comentario
	</div>
	";
}else{
		$campo[1] = "
	<div class='classe_comentario_usuario_conteudo' id='$id_campo_texto_comentario'>
	$campo_marcacao
	<div class='classe_comentario_usuario_conteudo_sub'>
	$comentario
	</div>
	</div>
	";
};
switch($tabela_comentario){
	case $tabela_banco[4]:
		$classe[1] = "classe_comentario_usuario_separa_5";
	break;
	case $tabela_banco[7]:
		$classe[1] = "classe_comentario_usuario_separa_6";
	$classe[0] = "classe_comentario_usuario_separa_7";
		if(retorne_tabela_comentario_comentario_principal($dados) == $tabela_banco[4]){
				$classe[0] = "classe_comentario_usuario_separa_8";
	};
	break;
};
$campo[2] = constroe_opcoes_comentario($dados);
$html = "
<div class='classe_comentario_usuario classe_cor_29' id='$id_comentario_usuario'>
$campo[2]
<div class='$classe[1]'>
$imagem_perfil
</div>
<div class='$classe[0]'>
$campo[1]
<div class='classe_comentario_usuario_data classe_cor_7'>
$data
</div>
$campo_gerenciar_comentario
$campo[0]
</div>
</div>
";
return $html;
};
function constroe_imagem_perfil_comentario($uid){
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$info_link[0] = constroe_campo_info_link(0, $uid);
$evento_info_link = $info_link[0][0];
$conteudo_info_link = $info_link[0][1];
$html = "
<div class='classe_div_imagem_perfil_miniatura_div_comentario' $evento_info_link>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>
$conteudo_info_link
";
return $html;
};
function constroe_opcoes_comentario($dados){
global $idioma_sistema;
global $variavel_campo;
$id = $dados['id'];
$url_index_inicio = PAGINA_INDEX_INICIO;
$url[0] = $url_index_inicio."?".$variavel_campo[9]."=$id";
$opcao[0] = "
<div class='classe_div_opcao_menu_suspense'>
<a href='$url[0]' title='$idioma_sistema[576]'>$idioma_sistema[576]</a>
</div>
";
$campo[0] = constroe_menu_suspense(false, null, false, null, null, $opcao[0]);
$campo[0] = "
<div class='classe_opcoes_comentario_separa'>
$campo[0]
</div>
";
$html = "
<div class='classe_opcoes_comentario'>
$campo[0]
</div>
";
return $html;
};
function excluir_comentario(){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
$uid = retorne_idusuario_request();
$id_post = retorne_campo_formulario_request(11);
$tabela_campo = retorne_tabela_comentario(retorne_campo_formulario_request(10));
$query[0] = "select *from $tabela_campo where id='$id_post';";
$dados_query = plugin_executa_query($query[0]);
$idusuario_dono = $dados_query["dados"][0][UID];
if($idusuario_dono != retorne_idusuario_logado() and $uid != retorne_idusuario_logado()){
        return null;
};
$query[1] = "delete from $tabela_banco[7] where id='$id';";
plugin_executa_query($query[1]);
$array_retorno["dados"] = null;
remove_marcacao_usuario($id, $tabela_banco[7]);
excluir_respostas_comentario($id);
remove_notifica($idusuario_dono, $id, $tabela_banco[7], true);
return json_encode($array_retorno);
};
function excluir_respostas_comentario($id_post){
global $tabela_banco;
$tabela = $tabela_banco[7];
$query[0] = "select *from $tabela where tabela_comentario='$tabela' and id_post='$id_post';";
$query[1] = "delete from $tabela where tabela_comentario='$tabela' and id_post='$id_post';";
$array_dados = plugin_executa_query($query[0]);
$contador = 0;
$linhas = $array_dados["linhas"];
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $array_dados["dados"][$contador];
		$id = $dados["id"];
		if($id != null){
				remove_notifica(null, $id, $tabela, true);
	};
};
plugin_executa_query($query[1]);
};
function excluir_todos_comentarios($id_post, $tabela_comentario){
global $tabela_banco;
$query[0] = "select *from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario';";
$query[1] = "delete from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario';";
$dados_query = plugin_executa_query($query[0]);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		remove_marcacao_usuario($dados["id"], $tabela_banco[7]);
		excluir_respostas_comentario($dados["id"]);
};
plugin_executa_query($query[1]);
};
function limpar_comentarios(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "delete from $tabela_banco[7] where uid='$idusuario' or uidamigo='$idusuario';";
plugin_executa_query($query);
};
function postar_comentario(){
global $tabela_banco;
global $idioma_sistema;
if(retorna_configuracao_privacidade(5, retorne_idamigo_request()) == true){
        return null;
};
$tipo_campo = retorne_campo_formulario_request(10);
$data = data_atual();
$id = retorne_campo_formulario_request(4);
$comentario = retorne_campo_formulario_request_htmlentites(9);
$tabela = retorne_tabela_comentario($tipo_campo);
if(retorne_id_existe($id, $tabela) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);
		return json_encode($array_retorno);
};
switch($tipo_campo){
	case 1:
		$uid = retorne_idusuario_dono_publicacao($id);
		if(retorne_pode_interagir_social($id, false) == false){
				return null;
	};
	break;
	case 2:
		$uid = retorne_uid_dono_imagem($id);
		if(retorne_usuario_amigo($uid) == false and retorne_usuario_dono_perfil($uid) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
	case 3:
		$uid = retorne_uid_dono_comentario($id);
		if(retorne_pode_responder_comentario($id) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
};
if(retorne_usuario_logado() == false or $comentario == null or $tabela == null){
        return null;
};
$idusuario = retorne_idusuario_logado();
$uidamigo = retorne_idamigo_request();
$query[0] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela';";
$query[1] = "insert into $tabela_banco[7] values(null, '$idusuario', '$uidamigo', '$id', '$comentario', '$tabela', '$data');";
$query[2] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' order by id desc limit 1;";
$array_dados = plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
atualiza_retorna_dados_usuario_sessao(true, true);
$numero_comentarios = retorne_tamanho_resultado(retorne_numero_comentarios($tipo_campo, $id));
$array_dados = plugin_executa_query($query[2]);
$dados = $array_dados["dados"][0];
$idcomentario = $dados["id"];
erradicar_marcacoes_usuarios($idcomentario);
$array_retorno["numero_comentarios"] = $idioma_sistema[75].$idioma_sistema[76].$numero_comentarios.$idioma_sistema[77];
$array_retorno["numero_comentarios_2"] = $numero_comentarios;
$array_retorno["dados"] = constroe_comentario($array_dados["dados"][0]);
$query[3] = "select DISTINCT uid, id_post from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela';";
$array_dados = plugin_executa_query($query[3]);
$contador = 0;
$linhas = $array_dados["linhas"];
if($linhas > 0 and $tabela == $tabela_banco[7]){
		remove_notifica_duplicados_comentario($id);
		for($contador == $contador; $contador <= $linhas; $contador++){
				$dados = $array_dados["dados"][$contador];
				$uid = $dados[UID];
		$id_post = $dados[ID_POST];
				if($id_post != null){
									adicionar_notifica($id, $uid, $tabela, $tabela_banco[7], $idcomentario);
		};
	};
};
adicionar_notifica($id, $uidamigo, $tabela, $tabela_banco[7], $idcomentario);
return json_encode($array_retorno);
};
function retorne_comentario_id($id){
global $tabela_banco;
global $idioma_sistema;
$query = "select *from $tabela_banco[7] where id='$id';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		$mensagem[0] = mensagem_erro(retorne_nome_usuario_logado().$idioma_sistema[464]);
		return constroe_conteudo_padrao(true, $mensagem[0], null);
}else{
		return constroe_comentario($dados_query["dados"][0]);
};
};
function retorne_idcomentario_requeste(){
return retorne_campo_formulario_request(9);
};
function retorne_link_comentario($id){
global $variavel_campo;
global $idioma_sistema;
$url_comentario = PAGINA_INICIAL."?$variavel_campo[9]=$id";
$html = "
<a href='$url_comentario' title='$idioma_sistema[349]'>$idioma_sistema[348]</a>
";
return $html;
};
function retorne_numero_comentarios($tipo_campo, $id_post){
global $tabela_banco;
$tabela = retorne_tabela_comentario($tipo_campo);
$query = "select *from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_pode_responder_comentario($id){
global $tabela_banco;
$query[0] = "select *from $tabela_banco[7] where id='$id';";
$dados_query = plugin_executa_query($query[0]);
$dados = $dados_query["dados"][0];
$uid = $dados[UID];
$id_post = $dados[ID_POST];
if(retorne_idpagina_postagem($id_post) != null){
		return true;
};
if(retorne_usuario_amigo($uid) == true or retorne_usuario_dono_perfil($uid) == true){
		return true;
}else{
		return false;
};
};
function retorne_tabela_comentario($numero_tabela){
global $tabela_banco;
switch($numero_tabela){
    case 1:	
    $retorno = $tabela_banco[5];
	break;
	case 2:	
    $retorno = $tabela_banco[4];
	break;
	case 3:
	$retorno = $tabela_banco[7];
	break;
};
if($retorno == null){
		$nome_tabela = $numero_tabela;
		switch($nome_tabela){
		case $tabela_banco[5]:
		$retorno = 1;
		break;
		case $tabela_banco[4]:
		$retorno = 2;
		break;
		case $tabela_banco[7]:
		$retorno = 3;
		break;
	};
};
return $retorno;
};
function retorne_tabela_comentario_comentario_principal($dados){
global $tabela_banco;
$tabela = $tabela_banco[7];
$id_post = $dados[ID_POST];
$query = "select *from $tabela where id='$id_post';";
$dados = retorne_dados_query($query);
return $dados[TABELA_COMENTARIO];
};
function retorne_uid_dono_comentario($id){
global $tabela_banco;
$query = "select *from $tabela_banco[7] where id='$id';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
return $dados[UID];
};
function retorne_usuario_dono_comentario($uid){
return $uid == retorne_idusuario_logado();
};
function salvar_comentario_editado(){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
$comentario = retorne_campo_formulario_request_htmlentites(9);
if($id == null or $comentario == null or retorne_usuario_logado() == false){
	    return null;
};
$nome = retorne_nome_link_usuario(true, retorne_uid_dono_comentario($id));
$idusuario = retorne_idusuario_logado();
$query = "update $tabela_banco[7] set comentario='$comentario' where id='$id' and uid='$idusuario';";
plugin_executa_query($query);
$array_retorno["dados"] = $nome.converter_urls(false, $comentario);
return json_encode($array_retorno);
};
function compartilhar(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[5];
$id = retorne_campo_formulario_request(11);
if(retorne_id_existe($id, $tabela) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);
	$array_retorno["linhas"] = 0;
		return json_encode($array_retorno);
};
$uid = retorne_idusuario_dono_publicacao($id);
if(retorne_pode_interagir_social($id, true) == false){
		return null;
};
if(retorna_configuracao_privacidade(10, $uid) == true){
		$nome = retorne_nome_usuario_logado();
		if(retorne_usuario_dono_perfil($uid) == true){
			    $html = constroe_caixa(false, $nome.$idioma_sistema[420]);
	}else{
			    $html = constroe_caixa(false, $nome.$idioma_sistema[421]);
	};
		$array_retorno["dados"] = $html;
		return json_encode($array_retorno);
};
if(retorne_usuario_logado_compartilhou($id) == true){
		$array_retorno["dados"] = "(".retorne_tamanho_resultado(retorne_numero_compartilhamentos($id)).")";
		return json_encode($array_retorno);
};
$array_publicacao[ID_COMPARTILHADO] = $id;
publicar_conteudo_usuario($array_publicacao, 4);
$imagem_sistema[0] = retorne_imagem_sistema(33, null, false);
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_compartilhamentos($id));
$array_retorno["compartilhado"] = $imagem_sistema[0];
return json_encode($array_retorno);
};
function constroe_campo_compartilhamentos($id, $tipo_campo, $uid){
global $idioma_sistema;
if(retorne_pode_interagir_social($id, true) == false){
		return null;
};
if(retorna_configuracao_privacidade(10, $uid) == true){
		return null;
};
if(retorna_usuario_logado_dono_publicacao($id) == true){
		return null;
};
$id_post = retorne_idcompartilhamento_id_post($id);
if(retorne_idcompartilhamento_id_post($id) == null){
		$numero_compartilhamentos = retorne_numero_compartilhamentos($id);
}else{
		$numero_compartilhamentos = retorne_numero_compartilhamentos($id_post);
};
if(retorne_usuario_logado_dono_compartilhamento($id_post) == true and $numero_compartilhamentos > 0){
		$html = "
	<span class='classe_mensagem_usuario_dono_compartilhamento_span'>
	$idioma_sistema[342]
	</span>
	";
		$html = retorne_nome_link_usuario(true, retorne_idusuario_logado()).$html;
		$html = "
	<div class='classe_mensagem_usuario_dono_compartilhamento'>$html</div>
	";
		return $html;
};
$numero_compartilhamentos = retorne_tamanho_resultado($numero_compartilhamentos);
if(retorne_usuario_logado_compartilhou($id) == true or retorne_usuario_logado_compartilhou($id_post) == true){
		$compartilhou = true;
}else{
		$compartilhou = false;	
};
if($compartilhou == true){
		$texto[0] = retorne_imagem_sistema(33, null, false);
}else{
		$texto[0] = retorne_imagem_sistema(89, null, false);
		$idcampo[0] = retorne_idcampo_md5();
	$idcampo[1] = retorne_idcampo_md5();
	$idcampo[2] = retorne_idcampo_md5();
	$idcampo[3] = retorne_idcampo_md5();
		$funcao[0] = "compartilhar(\"$idcampo[0]\", \"$id_post\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\")";
		$evento[0] = "onclick='$funcao[0];'";
		$dialogo[0] = constroe_dialogo($idioma_sistema[401], $idioma_sistema[402], $idcampo[1]);
};
$campo[0] = "
<div class='campo_compartilhamento_compartilhar classe_cor_4' id='$idcampo[3]'>
<span class='campo_compartilhamento_compartilhar_span_1' id='$idcampo[2]'>
$texto[0]
</span>
<span class='campo_compartilhamento_compartilhar_span_2 span_link' id='$idcampo[0]'>
$numero_compartilhamentos
</span>
</div>
";
$html = "
<div class='campo_compartilhamento' $evento[0]>
$campo[0]
</div>
$dialogo[0]
";
return $html;
};
function excluir_compartilhamentos($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
$query = "select *from $tabela where id_compartilhado='$id' and id!='$id';";
$contador = 0;
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($dados["id"] != null){
				excluir_publicacao_usuario($dados["id"], true);
	};
};
};
function retorne_idcompartilhamento_id_post($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
$query = "select *from $tabela where id='$id' limit 1;";
$dados_query = plugin_executa_query($query);
$id_compartilhado = $dados_query["dados"][0][ID_COMPARTILHADO];
if($id_compartilhado == null){
		return $id;
}else{
		return $id_compartilhado;
};
};
function retorne_idpost_compartilhamento($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
$query = "select *from $tabela where id_compartilhado='$id' limit 1;";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0]["id"];
};
function retorne_numero_compartilhamentos($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
if($id == null){
		return 0;
};
$query = "select *from $tabela where id_compartilhado='$id';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_usuario_logado_compartilhou($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
$uid = retorne_idusuario_logado();
$query = "select *from $tabela where id_compartilhado='$id' and uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"] >= 1;
};
function retorne_usuario_logado_dono_compartilhamento($id){
global $tabela_banco;
if(retorne_idusuario_dono_publicacao($id) == retorne_idusuario_logado()){
		return true;
}else{
		return false;
};
};
function atualizar_email(){
global $idioma_sistema;
global $tabela_banco;
if(retorne_usuario_logado() == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[400]);
		return json_encode($array_retorno);
};
if(retorne_pode_alterar_email() == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[441]);
		return json_encode($array_retorno);
};
$nome_usuario = retorne_nome_usuario_logado();
$uid = retorne_idusuario_logado();
$email[0] = converte_minusculo(retorne_campo_formulario_request(33));
$email[1] = converte_minusculo(retorna_email_usuario_logado());
if($email[0] == $email[1]){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[455]);
		return json_encode($array_retorno);	
};
if(retorne_email_cadastrado($email[0]) == true){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[456]);
		return json_encode($array_retorno);	
};
if($email[0] == null or $email[1] == null or verifica_se_email_valido($email[0]) == false){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[457]);
		return json_encode($array_retorno);	
};
$tabela = $tabela_banco[0];
$query = "update $tabela set e_mail='$email[0]' where e_mail='$email[1]' and uid='$uid';";
plugin_executa_query($query);
salva_sessao_usuario($email[0], retorna_senha_usuario_logado(), $uid);
atualiza_retorna_dados_usuario_sessao(true, true);
adicionar_ativar_usuario();
atualiza_numero_alterou_email_dia();
$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[458].$email[0].$idioma_sistema[163]);
return json_encode($array_retorno);
};
function atualiza_numero_alterou_email_dia(){
global $tabela_banco;
$tabela = $tabela_banco[32];
$uid = retorne_idusuario_logado();
$data_hoje = retorne_data_dia_mes_ano();
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];
if($data == $data_hoje){
		$tentativas++;
}else{
		$tentativas = 1;
};
$query = null;
if($dados_query["linhas"] > 0){
		$query[0] = "update $tabela set tentativas='$tentativas', data='$data_hoje' where uid='$uid';";
}else{
		$query[0] = "delete from $tabela where uid='$uid';";
	$query[1] = "insert into $tabela values(null, '$uid', '$tentativas', '$data_hoje');";
};
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
};
function configuracoes_perfil(){
global $idioma_sistema;
global $url_link_acao;
global $tabela_banco;
$modo = retorne_campo_formulario_request(6);
$id_campo_conteudo = retorna_idcampo_conteudo_geral();
$idcampo[0] = retorna_idcampo_progresso_gif_geral();
switch($modo){
    case 1:
	$titulo = $idioma_sistema[105];
	$conteudo_configuracao = formulario_altera_senha();
	break;
	case 2:
	$titulo = $idioma_sistema[106];
	$conteudo_configuracao = constroe_campo_privacidade();
	break;
	case 3:
	$titulo = $idioma_sistema[107];
	$evento[0] = "onclick='carrega_usuarios_bloqueados(\"$id_campo_conteudo\");'";
	break;
	case 4:
	$titulo = $idioma_sistema[108];
	$evento[0] = "onclick='carrega_visitas_perfil(\"$id_campo_conteudo\");'";
	break;
	case 5:
	$titulo = $idioma_sistema[109];
	$opcoes_adicionais = opcoes_solicitacoes_amizade($id_campo_conteudo);
	$evento[0] = "onclick='carrega_solicitacoes_amizade(\"$id_campo_conteudo\");'";
	remove_notifica(retorne_idusuario_logado(), null, $tabela_banco[6], null);
	break;
	case 6:
	$titulo = $idioma_sistema[110];
	$conteudo_configuracao = campo_limpar_perfil();
	break;
	case 7:
	$titulo = $idioma_sistema[154];
	$conteudo_configuracao = campo_excluir_conta();
	break;
	case 8:
	$titulo = $idioma_sistema[389];
	$conteudo_configuracao = constroe_campo_alterar_url_usuario(false);
	break;
	case 9:
	$titulo = $idioma_sistema[452];
	$conteudo_configuracao = constroe_campo_alterar_email();
	break;
    default:
	$titulo = $idioma_sistema[105];
	$conteudo_configuracao = formulario_altera_senha();
};
if($evento[0] != null){
		$progresso[0] = campo_progresso_gif($idcampo[0]);
	    $campo_paginar = "
	$progresso[0]
	<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
	$idioma_sistema[61]
	</div>
	";
};
$opcoes_configuracoes = constroe_opcoes_configuracoes($modo);
$html = "
<div class='classe_div_titulo_formulario_ed_perfil'>$titulo</div>
<div class='classe_div_campos_formulario_ed_perfil classe_cor_2'>
<div class='classe_opcoes_configuracoes_perfil cor_borda_div'>$opcoes_configuracoes</div>
$opcoes_adicionais
<div class='classe_conteudo_configuracoes_perfil' id='$id_campo_conteudo'>$conteudo_configuracao</div>
$campo_paginar
</div>
";
return constroe_conteudo_padrao(true, $html, null);
};
function constroe_campo_alterar_email(){
global $idioma_sistema;
if(retorne_pode_alterar_email() == false){
		return mensagem_erro($idioma_sistema[441]);
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$funcao[0] = "atualizar_email(\"$idcampo[0]\", \"$idcampo[1]\");";
$evento[0] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$evento[1] = "onclick='$funcao[0]'";
$campo[0] = mensagem_informa(retorne_nome_usuario_logado().$idioma_sistema[459]);
$html = "
<div class='classe_campo_alterar_email'>
<div class='classe_campo_alterar_email_mensagem' id='$idcampo[1]'>
$campo[0]
</div>
<div class='classe_campo_alterar_email_campo_1'>
<input type='text' placeholder='$idioma_sistema[453]' id='$idcampo[0]' $evento[0]>
</div>
<div class='classe_campo_alterar_email_campo_2'>
<input type='button' value='$idioma_sistema[454]' $evento[1]>
</div>
</div>
";
return $html;
};
function constroe_campo_editar_imagem_perfil(){
$uid = retorne_idusuario_logado();
$dados = retorne_dados_imagem_usuario(0, $uid);
$campo[0] = campo_recortar_imagem($dados, 0);
$html = "
<div class='classe_conteudo_centro_padrao'>
$campo[0]
</div>
";
return $html;
};
function constroe_opcoes_configuracoes($modo){
global $url_link_acao;
switch($modo){
	case 1:
	$url_atual = $url_link_acao[6];
	break;
	case 2:
	$url_atual = $url_link_acao[7];
	break;
	case 3:
	$url_atual = $url_link_acao[8];
	break;
	case 4:
	$url_atual = $url_link_acao[9];
	break;
	case 5:
	$url_atual = $url_link_acao[10];
	break;
	case 6:
	$url_atual = $url_link_acao[11];
	break;
	case 7:
	$url_atual = $url_link_acao[12];
	break;
	case 8:
	$url_atual = $url_link_acao[23];
	break;
	case 9:
	$url_atual = $url_link_acao[26];
	break;
	default:
	$url_atual = $url_link_acao[6];
};
$opcoes_disponiveis[] = $url_link_acao[6];
$opcoes_disponiveis[] = $url_link_acao[7];
$opcoes_disponiveis[] = $url_link_acao[8];
$opcoes_disponiveis[] = $url_link_acao[9];
$opcoes_disponiveis[] = $url_link_acao[10];
$opcoes_disponiveis[] = $url_link_acao[11];
$opcoes_disponiveis[] = $url_link_acao[12];
$opcoes_disponiveis[] = $url_link_acao[23];
$opcoes_disponiveis[] = $url_link_acao[26];
foreach($opcoes_disponiveis as $url){
		if($url == $url_atual){
				$html .= "
		<div class='classe_div_opcao_configuracao_selecionada classe_cor_3'>$url</div>
		";
	}else{
				$html .= "
		<div class='classe_div_opcao_configuracao_padrao'>$url</div>
		";
	};
};
return $html;
};
function retorne_pode_alterar_email(){
global $tabela_banco;
$tabela = $tabela_banco[32];
$uid = retorne_idusuario_logado();
$data_hoje = retorne_data_dia_mes_ano();
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];
if($tentativas > NUMERO_ALTERAR_EMAIL_DIA and $data == $data_hoje){
		return false;
}else{
		return true;
};
};
function adicionar_conteudo_url(){
$url = retorne_campo_formulario_request(48);
$chave = retorna_chave_request();
if(retorna_host_valido_dados_site($url) == false){
		$array_retorno["dados"] = null;
		return json_encode($array_retorno);
};
$dados = obter_informacoes_site($url);
$titulo = $dados[0];
$descricao = $dados[1];
$imagens = $dados[2];
$campo[0] = constroe_visualizar_imagens_conteudo_url($imagens);
$html = "
<div class='classe_exibe_informacoes_site'>
<div class='classe_exibe_informacoes_site_titulo classe_cor_2'>$titulo</div>
<div class='classe_exibe_informacoes_site_texto'>$descricao</div>
<div class='classe_exibe_informacoes_site_imagens'>$campo[0]</div>
</div>
";
$array_retorno["dados"][TITULO] = $titulo;
$array_retorno["dados"][DESCRICAO] = $descricao;
$array_retorno["dados"][IMAGENS] = $imagens;
$array_retorno["dados"][CONTEUDO] = $html;
$array_retorno["dados"][URL] = $url;
return json_encode($array_retorno);
};
function atualiza_publicado_conteudo_url($chave){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[29];
$query = "update $tabela set publicado='1' where chave='$chave' and uid='$uid';";
plugin_executa_query($query);
};
function constroe_adicionar_conteudo_url($idcampo_entrada, $idcampo_visualiza, $idcampo_resultados){
global $idioma_sistema;
$imagem[0] = retorne_imagem_sistema(43, null, false);
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$funcao[0] = "adicionar_conteudo_url(\"$idcampo[1]\", \"$idcampo_resultados\", \"$idcampo_visualiza\", \"$idcampo[2]\", \"$idcampo[3]\");";
$funcao[1] = "exibe_dialogo(\"$idcampo[0]\")";
$evento[0] = "onclick='$funcao[1];'";
$evento[1] = "onclick='$funcao[0]'";
$evento[2] = "onclick='$funcao[1], publicar_conteudo_url(\"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo_resultados\");'";
$evento[3] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$campo[0] = "
<div class='classe_add_conteudo_url' $evento[0]>$imagem[0]</div>
";
$progresso[0] = campo_progresso_gif($idcampo[2]);
$campo[1] = "
<div class='classe_add_conteudo_campos'>
<div class='classe_add_conteudo_campos_separa classe_cor_8'>
<div class='classe_add_conteudo_campos_separa_div_1'>
<input type='text' placeholder='$idioma_sistema[405]' id='$idcampo[1]' $evento[3]>
</div>
<div class='classe_add_conteudo_campos_separa_div_2'>
<input type='button' value='$idioma_sistema[406]' $evento[1]>
</div>
</div>
$progresso[0]
<div class='classe_add_conteudo_campos_separa' id='$idcampo_resultados'></div>
<div class='classe_add_conteudo_campos_separa_botao' id='$idcampo[3]'>
<input type='button' value='$idioma_sistema[410]' $evento[2]>
</div>
</div>
";
$campo[1] = constroe_dialogo($idioma_sistema[404], $campo[1], $idcampo[0]);
$html = "
$campo[0]
$campo[1]
";
return $html;
};
function constroe_conteudo_publicacao_conteudo_url($chave, $modo){
global $tabela_banco;
global $codigos_especiais;
$tabela = $tabela_banco[29];
$query = "select *from $tabela where chave='$chave';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
$id = $dados["id"];
$titulo = $dados[TITULO];
$descricao = $dados[DESCRICAO];
$imagens = $dados[IMAGENS];
$url = $dados[URL];
if($id == null){
		return null;
};
$array_imagens = explode($codigos_especiais[12], $imagens);
$numero_imagens = count($array_imagens) - 1;
$contador = 0;
foreach($array_imagens as $url_imagem){
		if($url_imagem != null){
				$imagem_convertida = converte_tag_imagem($url_imagem, true);
				if($numero_imagens > 1){
						if($contador >= 1){
								$imagens_publicacao[0] .= "
				$imagem_convertida
				";
								$contador = 0;
			}else{
								$imagens_publicacao[1] .= "
				$imagem_convertida				
				";
								$contador++;
			};
		}else{
						$imagens_publicacao[0] .= "
			$imagem_convertida
			";
		};
	};
};
if($numero_imagens > 1){
		$classe[0] = "classe_imagem_publicacao_conteudo_url_1";
		$lista_imagens = "
	<div class='$classe[0]'>
	$imagens_publicacao[0]
	</div>
	<div class='$classe[0]'>
	$imagens_publicacao[1]
	</div>
	";
}else{
		$classe[0] = "classe_imagem_publicacao_conteudo_url_2";	
		$lista_imagens = "
	<div class='$classe[0]'>
	$imagens_publicacao[0]
	</div>
	";
};
$descricao = converter_urls(false, $descricao);
$titulo = "<a href='$url' title='$titulo' target='_blank'>$titulo</a>";
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$campo[0] = constroe_opcoes_conteudo_url($chave, $idcampo[0], $modo, $idcampo[1]);
$html = "
<div class='classe_publicacao_conteudo_url' id='$idcampo[1]'>
$campo[0]
<div class='classe_publicacao_conteudo_url_titulo'>$titulo</div>
<div class='classe_publicacao_conteudo_url_conteudo'>$descricao</div>
<div class='classe_publicacao_conteudo_url_imagens'>$lista_imagens</div>
</div>
";
return $html;
};
function constroe_opcoes_conteudo_url($chave, $idcampo_1, $modo, $idcampo_2){
global $idioma_sistema;
if($modo == false){
		return null;
};
$idcampo[0] = retorne_idcampo_md5();
$imagem[0] = retorne_imagem_sistema(36, null, false);
$nome_usuario = retorne_nome_usuario_logado();
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='exclui_conteudo_url(\"$chave\", \"$idcampo_2\");'";
$campo[0] = "
<div class='classe_opcoes_conteudo_url_separa' $evento[0]>
$imagem[0]
</div>
";
$campo[1] = "
<div class='classe_opcoes_conteudo_url_separa_1'>
$nome_usuario$idioma_sistema[408]
</div>
<div class='classe_opcoes_conteudo_url_separa_2'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";
$campo[1] = constroe_dialogo($idioma_sistema[409], $campo[1], $idcampo[0]);
$html = "
<div class='classe_opcoes_conteudo_url'>
$campo[0]
</div>
$campo[1]
";
return $html;
};
function constroe_visualizar_imagens_conteudo_url($imagens){
global $codigos_especiais;
$imagens = explode($codigos_especiais[12], $imagens);
$contador = 0;
foreach($imagens as $url_imagem){
		if($url_imagem != null){
				$imagem[0] = retorne_imagem_sistema(36, null, false);
				$idcampo[0] = retorne_idcampo_md5();
				$eventos[0] = "onclick='excluir_imagem_conteudo_url(\"$idcampo[0]\", $contador);'";
				$campo[0] = "
		<script language='javascript'>
		v_array_conteudo_url_imagens[$contador] = \"$url_imagem\";
		</script>
		";
				$campo[1] = "
		<div class='classe_separa_imagem_visualizar_conteudo_url_gerencia'>
		<div class='classe_separa_imagem_visualizar_conteudo_url_gerencia_separa' $eventos[0]>
		$imagem[0]
		</div>
		</div>
		";
				$html .= "
		<div class='classe_separa_imagem_visualizar_conteudo_url classe_cor_3' id='$idcampo[0]'>
		$campo[1]
		<div class='classe_separa_imagem_visualizar_conteudo_url_imagem'>
		<img src='$url_imagem'>
		</div>
		</div>
		$campo[0]
		";
				$contador++;
	};
};
return $html;
};
function exclui_conteudo_url($chave){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[29];
$query = "delete from $tabela where chave='$chave' and uid='$uid';";
plugin_executa_query($query);
$array_retorno["dados"] = null;
return json_encode($array_retorno);
};
function publicar_conteudo_url(){
global $idioma_sistema;
global $tabela_banco;
$chave = retorna_chave_request();
$titulo = remove_html($_REQUEST[TITULO]);
$descricao = remove_html($_REQUEST[DESCRICAO]);
$imagens = remove_html($_REQUEST[IMAGENS]);
$url = remove_html($_REQUEST[URL]);
$data = data_atual();
if($chave == null and $titulo == null and $descricao == null and $imagens == null and $url == null){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[407]);
		return json_encode($array_retorno);
};
$imagens = str_ireplace("null", null, $imagens);
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[29];
$query[0] = "delete from $tabela where chave='$chave' and uid='$uid';";
$query[1] = "insert into $tabela values(null, '$chave', '$titulo', '$descricao', '$imagens', '$uid', '$url', '0', '$data');";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
$array_retorno["dados"] = constroe_conteudo_publicacao_conteudo_url($chave, true);
return json_encode($array_retorno);
};
function remove_conteudo_url_nao_publicado(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[29];
$query = "delete from $tabela where uid='$uid' and publicado='0';";
plugin_executa_query($query);
};
function retorne_id_conteudo_url($chave){
global $tabela_banco;
$tabela = $tabela_banco[29];
$query = "select *from $tabela where chave='$chave';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
return $dados["id"];
};
function constroe_campo_curtir($tipo_campo, $id, $modo, $idusuario){
global $idioma_sistema;
switch($tipo_campo){
	case 1:
		if(retorne_pode_interagir_social($id, false) == false){
				return null;
	};
	break;
	case 2:
		if(retorne_usuario_amigo($idusuario) == false and retorne_usuario_dono_perfil($idusuario) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
};
if(retorne_idpagina_request() != null){
		if(retorne_configuracao_pagina(retorne_idpagina_request(), 1) == false){
				return null;
	};
};
$nome = retorne_nome_usuario_logado();
if(retorna_configuracao_privacidade(6, $idusuario) == true){
		return null;
};
if($modo == false){
		$tipo_campo = retorne_tabela_comentario($tipo_campo);
};
if(retorne_usuario_curtiu($tipo_campo, $id) == true){
		$campo[0] = retorne_imagem_sistema(10, null, false);
		$imagem_sistema[0] = retorne_imagem_sistema(9, null, false);
}else{
		$campo[0] = retorne_imagem_sistema(9, null, false);
		$imagem_sistema[0] = retorne_imagem_sistema(10, null, false);
};
$numero_curtidas = retorne_tamanho_resultado(retorne_numero_curtidas($tipo_campo, $id));
$campo_curtir = "
<div class='classe_campo_curtir_separa classe_cor_4'>
<span class='classe_campo_curtir_separa_span_1'>$campo[0]</span>
<span class='classe_campo_curtir_separa_span_2 span_link'>$numero_curtidas</span>
</div>
";
if($modo == false){
        $array_retorno["dados"] = $campo_curtir;
		return $array_retorno;
};
$id_campo[0] = codifica_md5("campo_curtir_".$tipo_campo."_".$id.retorne_contador_iteracao());
$evento[0] = "onclick='curtir(\"$tipo_campo\", \"$id\", \"$id_campo[0]\", \"$idusuario\");'";
$html = "
<div class='classe_campo_curtir' id='$id_campo[0]' $evento[0]>
$campo_curtir
</div>
";
return $html;
};
function curtir(){
global $tabela_banco;
global $idioma_sistema;
$tipo_campo = retorne_campo_formulario_request(10);
$id = retorne_campo_formulario_request(4);
$tabela = retorne_tabela_comentario($tipo_campo);
if(retorne_id_existe($id, $tabela) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);
		return json_encode($array_retorno);
};
switch($tipo_campo){
	case 1:
		$uid = retorne_idusuario_dono_publicacao($id);
		if(retorne_pode_interagir_social($id, false) == false){
				return null;
	};
	break;
	case 2:
		$uid = retorne_uid_dono_imagem($id);
		if(retorne_usuario_amigo($uid) == false and retorne_usuario_dono_perfil($uid) == false and retorne_idpagina_request() == null){
				return null;
	};
	break;
};
if(retorna_configuracao_privacidade(6, retorne_idamigo_request()) == true){
        return null;
};
$idusuario = retorne_idusuario_logado();
$uidamigo = retorne_idamigo_request();
$data = data_atual();
$query[0] = "select *from $tabela_banco[9] where id_post='$id' and uid='$idusuario' and tabela_curtiu='$tabela';";
$query[1] = "delete from $tabela_banco[9] where id_post='$id' and uid='$idusuario' and tabela_curtiu='$tabela';";
$query[2] = "insert into $tabela_banco[9] values('null', '$idusuario', '$uidamigo', '$id', '$tabela', '$data');";
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] != 0){
		plugin_executa_query($query[1]);
}else{
		plugin_executa_query($query[2]);
};
adicionar_notifica($id, $uidamigo, $tabela, $tabela_banco[9], null);
return json_encode(constroe_campo_curtir($tabela, $id, false, $uidamigo));
};
function exclui_curtidas_publicacao($id_post, $tabela_curtiu){
global $tabela_banco;
$query = "delete from $tabela_banco[9] where id_post='$id_post' and tabela_curtiu='$tabela_curtiu';";
plugin_executa_query($query);
};
function limpar_curtidas(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "delete from $tabela_banco[9] where uid='$idusuario' or uidamigo='$idusuario';";
plugin_executa_query($query);
};
function retorne_numero_curtidas($tipo_campo, $id_post){
global $tabela_banco;
$tabela = retorne_tabela_comentario($tipo_campo);
$query = "select *from $tabela_banco[9] where tabela_curtiu='$tabela' and id_post='$id_post';";
$dados = plugin_executa_query($query);
return $dados["linhas"];
};
function retorne_usuario_curtiu($tipo_campo, $id_post){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$tabela = retorne_tabela_comentario($tipo_campo);
$query = "select *from $tabela_banco[9] where tabela_curtiu='$tabela' and id_post='$id_post' and uid='$idusuario';";
$dados = plugin_executa_query($query);
if($dados["linhas"] == 0){
	    return false;
}else{
		return true;
};
};
function completa_url_imagem($url_imagem, $url_site){
$dados_imagem = @parse_url($url_imagem);
if($dados_imagem["scheme"] == null){
		$dados_site = @parse_url($url_site);
		$host = $dados_site['host'];
		$url_imagem = "http://$host/".$url_imagem;
};
return $url_imagem;
};
function extrai_imagens_html($html, $url_site){
$array_imagens = array();
$array_retorno = array();
$contador = 0;
if(preg_match_all('/<img\s+.*?src=[\"\']?([^\"\' >]*)[\"\']?[^>]*>/i',$html,$matches,PREG_SET_ORDER)){
		foreach($matches as $match){
				array_push($array_imagens, array($match[1], $match[2]));
	};
};
foreach($array_imagens as $url){
		if(is_array($url) == true){
				foreach($url as $endereco_imagem){
						if($endereco_imagem != null){
								if($contador >= NUMERO_IMAGENS_CAMPO_CONTEUDO_URL){
										break;
				};
								$endereco_imagem = completa_url_imagem($endereco_imagem, $url_site);
								$array_retorno[] = $endereco_imagem;
								$contador++;
			};
		};
	};
};
return $array_retorno;
};
function extrai_urls_texto($texto){
preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $texto, $array_retorno);
return $array_retorno;
};
function obtem_data_url_site($url){
return @file_get_contents($url);
};
function obter_informacoes_site($url){
$dados_site = separa_dados_data_site(false, $url);
$titulo = $dados_site['titulo'];
$descricao = $dados_site['descricao'];
$keywords = $dados_site['keywords'];
$lista_imagens = $dados_site['lista_imagens'];
$array_retorno[0] = $titulo;
$array_retorno[1] = $descricao;
$array_retorno[2] = $lista_imagens;
$array_retorno[3] = $keywords;
$array_retorno[4] = $url;
return $array_retorno;
};
function retorna_host_valido_dados_site($url_site){
$url_site = strtolower($url_site);
$parse = @parse_url($url_site);
$host = $parse['host'];
if("http://".$host == URL_SERVIDOR){
		return false;
};
if(substr($url_site, 0, 4) == "www."){
		return true;
};
if($host == "www.youtube.com" or $host == null){
		return false;
}else{
		return true;
};
};
function separa_dados_data_site($modo, $url){
global $codigos_especiais;
$html = obtem_data_url_site($url);
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');
$title = $nodes->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
for($i = 0; $i < $metas->length; $i++){
		$meta = $metas->item($i);
	if($meta->getAttribute('name') == 'description')
	$description = $meta->getAttribute('content');
	if($meta->getAttribute('name') == 'keywords')
	$keywords = $meta->getAttribute('content');
};
$tags = $doc->getElementsByTagName('img');
$array_imagens = extrai_imagens_html($html, $url);
foreach($array_imagens as $url_imagem){
		if($url_imagem != null){
				$lista_imagens .= $url_imagem.$codigos_especiais[12];
	};
};
if($modo == true){
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $html, $match);
		foreach($match as $link){
				if($link != null){
						foreach($link as $url){
								if($url != null){
										$lista_links[] = $url;
				};
			};
		};
	};
};
if(converte_minusculo(mb_detect_encoding($description)) == converte_minusculo("UTF-8")){
		$description = utf8_decode($description);
	$title = utf8_decode($title);
	$keywords = utf8_decode($keywords);
	$lista_links = utf8_decode($lista_links);
};
$description = mb_convert_encoding($description, 'UTF-8', mb_detect_encoding($description, 'UTF-8, ISO-8859-1', true));
$title = mb_convert_encoding($title, 'UTF-8', mb_detect_encoding($title, 'UTF-8, ISO-8859-1', true));
$keywords = mb_convert_encoding($keywords, 'UTF-8', mb_detect_encoding($keywords, 'UTF-8, ISO-8859-1', true));
$lista_links = mb_convert_encoding($lista_links, 'UTF-8', mb_detect_encoding($lista_links, 'UTF-8, ISO-8859-1', true));
$array_retorno['titulo'] = $title;
$array_retorno['descricao'] = $description;
$array_retorno['keywords'] = $keywords;
$array_retorno['lista_imagens'] = $lista_imagens;
$array_retorno['lista_links'] = $lista_links;
return $array_retorno;
};
function campo_visualizar_depoimentos($modo){
global $idioma_sistema;
global $tabela_banco;
$uid = retorne_idusuario_request();
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$usuario_dono = retorne_usuario_dono_perfil($uid);
$dados_perfil_logado = $dados_compilados_usuario[$tabela_banco[1]];
$numero_depoimentos = retorne_numero_depoimentos($uid, true);
if($numero_depoimentos[0] > 1){
		$numero_depoimentos[0] = retorne_tamanho_resultado($numero_depoimentos[0]).$idioma_sistema[181];
}else{
		$numero_depoimentos[0] = $numero_depoimentos[0].$idioma_sistema[182];
};
if($numero_depoimentos[1] > 1){
		$numero_depoimentos[1] = retorne_tamanho_resultado($numero_depoimentos[1]).$idioma_sistema[181];
}else{
		$numero_depoimentos[1] = $numero_depoimentos[1].$idioma_sistema[182];
};
$idcampo[0] = codifica_md5("id_campo_visualizador_depoimentos".data_atual());
$idcampo[1] = codifica_md5("id_campo_paginador_depoimentos".data_atual());
if($modo == true){
        $idcampo[2] = codifica_md5("id_campo_depoimentos_usuario_perfil".data_atual());
}else{
		$idcampo[2] = retorne_campo_formulario_request(21);
};
if($usuario_dono == true){
	    $argumento[0] = 1;
    $argumento[1] = 0;
}else{
	    $argumento[0] = 0;
    $argumento[1] = 0;	
};
$idcampo[3] = retorne_idcampo_md5();
$evento[1] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", null, $argumento[1], \"$idcampo[3]\");'";
$evento[2] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 1, $argumento[0], \"$idcampo[3]\");'";
$evento[3] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 2, $argumento[0], \"$idcampo[3]\");'";
$evento[4] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 3, $argumento[1], \"$idcampo[3]\");'";
if($usuario_dono == true){
	    $campo_numero_depoimentos = "
	<div class='classe_depoimentos_perfil_basico_titulo'>
    <div class='classe_visualiza_depoimentos_usuario_modo'>
	<span class='span_link' $evento[2]>$idioma_sistema[192]$numero_depoimentos[0]</span>
	<span class='span_link' $evento[3]>$idioma_sistema[193]$numero_depoimentos[1]</span>
	</div>
	</div>";
}else{
    	    if(retorne_sexo_usuario($dados_perfil_logado) == true){
	    	    $texto_campo_numero_depoimentos = "$idioma_sistema[196] - $numero_depoimentos[1]";
    }else{
	    	    $texto_campo_numero_depoimentos = "$idioma_sistema[197] - $numero_depoimentos[1]";
    };
	    $campo_numero_depoimentos = "
	<div class='classe_depoimentos_perfil_basico_titulo'>
	<div class='classe_visualiza_depoimentos_usuario_modo' $evento[1]>
    <span class='span_link'>$texto_campo_numero_depoimentos</span>
	</div>
    </div>";
};
if($usuario_dono == true){
    	$evento_paginar = $evento[4];
}else{
    	$evento_paginar = $evento[3];
};
$progresso[0] = campo_progresso_gif($idcampo[3]);
$campos_depoimentos = "
$campo_numero_depoimentos
<div class='classe_visualiza_depoimentos_usuario_lista_depoimentos' id='$idcampo[0]'></div>
$progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' id='$idcampo[1]' $evento_paginar>
$idioma_sistema[61]
</div>
";
if($modo == false){
	    return $campos_depoimentos;
};
$html = "
<div class='classe_depoimentos_usuario_perfil' id='$idcampo[2]'>
$campos_depoimentos
</div>
";
return $html;
};
function carregar_depoimentos(){
global $tabela_banco;
global $idioma_sistema;
$modo = retorne_campo_formulario_request(6);
$modo_limpa_contador = retorne_campo_formulario_request(20);
$idusuario = retorne_idusuario_request();
$nome_usuario = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $idusuario);
$usuario_dono = retorne_usuario_dono_perfil($idusuario);
if(retorna_configuracao_privacidade(8, $idusuario) == true){
    	if($usuario_dono == true){
				$array_retorno["dados"] = constroe_caixa(false, $nome_usuario.$idioma_sistema[185]);
				return json_encode($array_retorno);
	}else{
				$array_retorno["dados"] = constroe_caixa(false, $nome_amigo.$idioma_sistema[186]);
				return json_encode($array_retorno);
	};
};
if(retorne_usuario_amigo($idusuario) == false and $usuario_dono == false){
		$array_retorno["dados"] = constroe_caixa(false, $nome_usuario.$idioma_sistema[194].$nome_amigo.$idioma_sistema[163]);
		return json_encode($array_retorno);
};
$tabela = $tabela_banco[13];
if($modo == null or $modo_limpa_contador == 1){
        $zerar_contador = true;
        $array_retorno["zerou_contador"] = 1;
        $contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 2);
}else{
        $zerar_contador = false;
        $array_retorno["zerou_contador"] = 0;
        $contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 1);
};
$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;
if($usuario_dono == true){
        $query[0] = "select *from $tabela where uidamigo='$idusuario' order by aceito asc, id desc $limit_query;";
    $query[1] = "select *from $tabela where uid='$idusuario' order by aceito asc, id desc $limit_query;";
}else{
        $query[0] = "select *from $tabela where uidamigo='$idusuario' and aceito='1' order by id desc $limit_query;";
    $query[1] = "select *from $tabela where uid='$idusuario' and aceito='1' order by id desc $limit_query;";
};
switch($modo){
    case 1:
    $query_executa = plugin_executa_query($query[0]);
    break;
    case 2:
    $query_executa = plugin_executa_query($query[1]);
    break;
	default:
		if($usuario_dono == true){
		        $query_executa = plugin_executa_query($query[0]);	
	}else{
				$query_executa = plugin_executa_query($query[1]);
	};
};
$dados = $query_executa["dados"];
$linhas = $query_executa["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados_array = $dados[$contador];
		$array_retorno["dados"] .= constroe_depoimento($dados_array, $modo, $usuario_dono);
};
return json_encode($array_retorno);
};
function constroe_campo_depoimentos_perfil(){
global $idioma_sistema;
$idusuario = retorne_idusuario_request();
$nome_usuario = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $idusuario);
$dono_perfil = retorne_usuario_dono_perfil($idusuario);
if(retorna_configuracao_privacidade(8, $idusuario) == true){
    	if($dono_perfil == true){
				return(constroe_caixa(false, $nome_usuario.$idioma_sistema[185]));
	}else{
				return(constroe_caixa(false, $nome_amigo.$idioma_sistema[186]));
	};
};
$campo_visualizar = campo_visualizar_depoimentos(true);
if($dono_perfil == true or retorne_usuario_amigo($idusuario) == false){
	    return $campo_visualizar;
};
$placeholder[0] = $nome_usuario.$idioma_sistema[183].$nome_amigo;
$idcampo[0] = codifica_md5("id_campo_textarea_escreve_depoimento".data_atual());
$idcampo[1] = codifica_md5("id_campo_mensagem_escreve_depoimento".data_atual());
$evento[0] = "onclick='escrever_depoimento(\"$idcampo[0]\", \"$idcampo[1]\", \"$idusuario\");'";
$campo[0] = constroe_visualizador_emoticons(true, false, true, $idcampo[0]);
$campo[0] = "
<div class='classe_depoimentos_perfil_basico_separador'>
$campo[0]
</div>
";
$campo[1] = constroe_campo_div_editavel(true, $idcampo[0], null, null, $evento, $placeholder[0]);
$html = "
<div class='classe_depoimentos_perfil_basico'>
$campo_visualizar
<div class='classe_depoimentos_perfil_basico_mensagem' id='$idcampo[1]'></div>
<div class='classe_depoimentos_perfil_basico_escreve'>
$campo[1]
</div>
<div class='classe_depoimentos_perfil_basico_envia'>
$campo[0]
<input type='button' value='$idioma_sistema[184]' $evento[0]>
</div>
</div>
";
return $html;
};
function constroe_depoimento($dados, $modo, $usuario_dono){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$depoimento = html_entity_decode($dados[DEPOIMENTO]);
$aceito = $dados[ACEITO];
$data = converte_data_amigavel(true, $dados[DATA]);
if($id == null){
	    return null;
};
switch($modo){
    case 1:	
    $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);
    break;
    case 2:	
    $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uidamigo);
    break;
    default:
		if($usuario_dono == true){
			   $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);
	}else{
				$perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uidamigo);
	};
};
if(retorna_conteudo_bloqueado($depoimento) == true){
		return constroe_caixa(false, retorne_nome_usuario_logado().$idioma_sistema[179]);
};
$depoimento = converter_urls(false, $depoimento);
$idcampo[0] = codifica_md5("id_campo_depoimento_$id".data_atual());
$opcoes_depoimento = constroe_opcoes_depoimento($dados, $idcampo[0], $usuario_dono);
$html = "
<div class='classe_depoimento_usuario classe_cor_3 cor_borda_div' id='$idcampo[0]'>
<div class='classe_depoimento_usuario_perfil'>$perfil_usuario</div>
<div class='classe_depoimento_usuario_texto'>$depoimento</div>
<div class='classe_depoimento_usuario_data classe_cor_7'>$data</div>
$opcoes_depoimento
</div>
";
return $html;
};
function constroe_depoimento_id($id){
global $tabela_banco;
$query = "select *from $tabela_banco[13] where id='$id';";
$dados_query = plugin_executa_query($query);
return constroe_depoimento($dados_query["dados"][0], 0, false);
};
function constroe_opcoes_depoimento($dados, $idcampo_depoimento, $usuario_dono){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$depoimento = $dados[DEPOIMENTO];
$aceito = $dados[ACEITO];
$data = converte_data_amigavel(true, $dados[DATA]);
if(retorne_pode_excluir_depoimento($dados) == false){
	    return null;
};
$nome_usuario = retorne_nome_usuario_logado();
$id_dialogo[0] = codifica_md5("id_dialogo_aceita_depoimento_$id".data_atual());
$idcampo[0] = codifica_md5("id_campo_opcao_depoimento_$id".data_atual());
$evento[0] = "onclick='excluir_aceitar_depoimento(\"$id\", \"$idcampo[0]\", \"$idcampo_depoimento\", \"1\");'";
$evento[1] = "onclick='excluir_aceitar_depoimento(\"$id\", \"$idcampo[0]\", \"$idcampo_depoimento\", \"2\");'";
if($aceito == 1){
		$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[198]
	</div>
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>
	";
		$campo_aceita = constroe_dialogo($idioma_sistema[199], $campo_aceita, $id_dialogo[0]);
		$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[29]</span>
	$campo_aceita
	";
}else{
		$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[201]
	</div>
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[1]>
	<input type='button' value='$idioma_sistema[53]' $evento[0]>
	</div>
	";
		$campo_aceita = constroe_dialogo($idioma_sistema[200], $campo_aceita, $id_dialogo[0]);
		$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[202]</span>
	$campo_aceita
	";	
};
if($uidamigo == retorne_idusuario_logado()){
		$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[198]
	</div>
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>
	";
		$campo_aceita = constroe_dialogo($idioma_sistema[199], $campo_aceita, $id_dialogo[0]);
		$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[29]</span>
	$campo_aceita
	";	
};
$html = "
<div class='classe_campo_opcao_depoimento' id='$idcampo[0]'>
$campo_aceita
</div>
";
return $html;
};
function escrever_depoimento(){
global $idioma_sistema;
global $tabela_banco;
$uidamigo = retorne_idusuario_request();
$idusuario = retorne_idusuario_logado();
$depoimento = retorne_campo_formulario_request_htmlentites(19);
if($uidamigo == null or $idusuario == null or $depoimento == null){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[190]);
		return json_encode($array_retorno);
};
if(retorna_configuracao_privacidade(8, $uidamigo) == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[187]);
		return json_encode($array_retorno);
};
$tabela = $tabela_banco[13];
$data = data_atual();
$query[0] = "insert into $tabela values(null, '$uidamigo', '$idusuario', '$depoimento', '0', '$data');";
$query[1] = "select *from $tabela where uidamigo='$idusuario' and uid='$uidamigo' order by id desc limit 1;";
plugin_executa_query($query[0]);
$nome_usuario = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $uidamigo);
$dados_query = plugin_executa_query($query[1]);
$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[188].$nome_amigo.$idioma_sistema[189]);
adicionar_notifica($dados_query["dados"][0]["id"], $uidamigo, $tabela_banco[13], $tabela_banco[13], null);
return json_encode($array_retorno);
};
function excluir_aceitar_depoimento(){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
$modo = retorne_campo_formulario_request(6);
$dados = retorne_dados_depoimento($id);
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
if(retorne_pode_excluir_depoimento($dados) == false){
	    return null;
};
$tabela = $tabela_banco[13];
switch($modo){
    case 1:
	$query = "delete from $tabela where id='$id';";
	$deletou = -1;
	break;
	case 2:
	$query = "update $tabela set aceito='1' where id='$id';";
	$deletou = 0;
	break;
};
plugin_executa_query($query);
$array_retorno["dados"] = campo_visualizar_depoimentos(false);
$array_retorno["deletou"] = $deletou;
return json_encode($array_retorno);
};
function retorne_dados_depoimento($id){
global $tabela_banco;
$tabela = $tabela_banco[13];
$query = "select *from $tabela where id='$id';";
$dados = plugin_executa_query($query);
$dados = $dados["dados"][0];
return $dados;
};
function retorne_numero_depoimentos($idusuario, $modo){
global $tabela_banco;
$tabela = $tabela_banco[13];
if($modo == true){
        $query[0] = "select *from $tabela where uidamigo='$idusuario';";
    $query[1] = "select *from $tabela where uid='$idusuario';";
}else{
        $query[0] = "select *from $tabela where uidamigo='$idusuario' and aceito='1';";
    $query[1] = "select *from $tabela where uid='$idusuario' and aceito='1';";
};
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);
$dados_retorno[0] = $dados_query[0]["linhas"];
$dados_retorno[1] = $dados_query[1]["linhas"];
return $dados_retorno;
};
function retorne_numero_novos_depoimentos($idusuario){
global $tabela_banco;
$tabela = $tabela_banco[13];
$query = "select *from $tabela where uid='$idusuario' and aceito='0';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_pode_excluir_depoimento($dados){
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$idusuario = retorne_idusuario_logado();
if($id == null){
	    return false;
};
if($uid == $idusuario or $uidamigo == $idusuario){
	    return true;
}else{
	    return false;
};
};
function constroe_dialogo($titulo_janela, $conteudo_dialogo, $dialogo_id){
$imagem[0] = retorne_imagem_sistema(80, null, false);
$classe[0] = "div_janela_mensagem_conteudo";
$botao_fechar = "
<span class='span_botao_fechar_mensagem_dialogo' onclick='exibe_dialogo(\"$dialogo_id\");'>
$imagem[0]
</span>
";
$html = "
<div id=\"$dialogo_id\" class='div_janela_principal_mensagem_dialogo'>
<div class='div_janela_mensagem_dialogo'>
<div class='div_janela_mensagem_dialogo_titulo classe_cor_1'>
$botao_fechar
$titulo_janela
</div>
<div class='$classe[0]'>
$conteudo_dialogo
</div>
</div>
</div>
";
return $html;
};
function constroe_dialogo_acao($titulo, $conteudo, $id_dialogo){
$evento[0] = "onclick='fechar_menu_suspense(\"$id_dialogo\");'";
$html = "
<div id='$id_dialogo' class='div_janela_mensagem_dialogo_acao classe_sombra_borda_1'>
<div class='div_janela_mensagem_dialogo_acao_fechar'>
<span $evento[0]>x</span>
</div>
<div class='div_janela_titulo_dialogo_acao'>
$titulo
</div>
<div class='div_janela_conteudo_dialogo_acao'>
$conteudo
</div>
</div>
";
return $html;
};
function constroe_dialogo_grande($conteudo, $id_dialogo, $idcampo_1, $modo_paginar_album, $id, $uid){
global $idioma_sistema;
$imagem[0] = retorne_imagem_sistema(98, null, false);
$botao_fechar = "
<span class='span_botao_fechar_mensagem_dialogo_grande classe_cor_6' onclick='exibe_dialogo(\"$id_dialogo\");'>
$imagem[0]
</span>
";
if($modo_paginar_album == true){
		$tabindex = retorne_contador_iteracao();
		$scripts[0] = "
	<script>
	$(\"#$id_dialogo\").hover(function(){
		this.focus();
	}, function(){
		this.blur();
	}).keydown(function(e){
		paginar_slide_album_teclado(\"$idcampo_1\", \"$uid\", e.keyCode);
	});
	</script>
	";
};
$html = "
<div id=\"$id_dialogo\" class='div_janela_principal_mensagem_dialogo_grande' tabindex='$tabindex'>
<div class='div_janela_mensagem_dialogo_grande'>
<div class='div_janela_mensagem_dialogo_grande_titulo'>
$botao_fechar
</div>
<div class='div_janela_mensagem_conteudo_grande' id='$idcampo_1'>
$conteudo
</div>
</div>
</div>
$scripts[0]
";
return $html;
};
function constroe_dialogo_medio($titulo_janela, $conteudo_dialogo, $dialogo_id){
$imagem[0] = retorne_imagem_sistema(80, null, false);
$botao_fechar = "
<span class='span_botao_fechar_mensagem_dialogo_medio' onclick='exibe_dialogo(\"$dialogo_id\");'>
$imagem[0]
</span>
";
$html = "
<div id=\"$dialogo_id\" class='div_janela_principal_mensagem_dialogo_medio'>
<div class='div_janela_mensagem_dialogo_medio'>
<div class='div_janela_mensagem_dialogo_titulo_medio classe_cor_1'>
$botao_fechar
$titulo_janela
</div>
<div class='div_janela_mensagem_conteudo_medio'>
$conteudo_dialogo
</div>
</div>
</div>
";
return $html;
};
function campo_visualiza_emoticon($id_campo_entrada){
global $idioma_sistema;
$idcampo[0] = retorne_idcampo_md5();
$funcao[0] = "carregar_emoticons(\"$idcampo[0]\", \"$id_campo_entrada\")";
$evento[0] = "onscroll='$funcao[0]'";
$html = "
<div class='classe_visualizador_emoticons'>
<div class='classe_visualizador_emoticons_lista' id='$idcampo[0]' $evento[0]></div>
</div>
";
$array_retorno["html"] = $html;
$array_retorno["funcao"] = $funcao[0];
return $array_retorno;
};
function carregar_emoticons(){
global $idioma_sistema;
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_emoticons = $dados_compilados_usuario[$tabela_banco[16]];
$classe[0] = "classe_emoticon_lista";
$array_dados_emoticons = inverte_array($array_dados_emoticons);
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 5);
$idcampo_entrada_emoticon = retorne_campo_formulario_request(23);
for($contador == $contador; $contador <= $contador_final; $contador++){
        $dados = $array_dados_emoticons[$contador];
        $id = $dados["id"];
    $url = $dados[URL];
    $codigo_conversao = $dados["codigo_conversao"];
        if($id != null){
                $evento[0] = "onclick='adicionar_emoticon_campo(\"$url\", \"$idcampo_entrada_emoticon\");'";
                $lista_emoticons .= "
        <div class='$classe[0]' $evento[0]>
        <img src='$url' title='$codigo_conversao' alt='$codigo_conversao'>
        </div>
        ";
    };
};
$array_retorno["dados"] = $lista_emoticons;
return json_encode($array_retorno);
};
function constroe_visualizador_emoticons($modo, $modo_topo, $modo_dialogo, $id_campo_entrada){
global $idioma_sistema;
$campo_visualiza = campo_visualiza_emoticon($id_campo_entrada);
$campo[0] = $campo_visualiza["html"];
$funcao[0] = $campo_visualiza["funcao"];
$funcao[1] = "atualiza_posicao_cursor_emoticon(\"$id_campo_entrada\")";
$imagem_sistema[0] = retorne_imagem_sistema(17, null, false);
$html = constroe_menu_suspense($modo_topo, $funcao[0].", $funcao[1]", $modo, 17, null, $campo[0]);
return $html;
};
function campo_excluir_conta(){
global $idioma_sistema;
global $tabela_banco;
$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();
$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];
$nome_usuario = retorne_nome_usuario_logado();
$imagem_sistema[0] = retorne_imagem_sistema(13, null, false);
if(retorne_sexo_usuario($dados_perfil_logado) == true){
        $mensagem_exibir = mensagem_erro($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[155]);
}else{
        $mensagem_exibir = mensagem_erro($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[156]);	
};
$idcampo[0] = codifica_md5("id_campo_senha_excluir_conta");
$idcampo[1] = codifica_md5("id_campo_mensagem_excluir_conta");
$idcampo[2] = retorne_idcampo_md5();
$eventos[0] = "onclick='excluir_conta_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\");'";
$html = "
<div class='classe_campo_excluir_conta' id='$idcampo[2]'>
<div class='classe_campo_excluir_conta_titulo classe_cor_3'>$idioma_sistema[154]</div>
<div class='classe_campo_excluir_conta_mensagem'>
$mensagem_exibir
</div>
<div class='classe_campo_excluir_conta_mensagem' id='$idcampo[1]'></div>
<div class='classe_campo_excluir_conta_campo_login'>
<input type='password' placeholder='$idioma_sistema[136]' id='$idcampo[0]'>
</div>
<div class='classe_campo_excluir_conta_campo_acao'>
<input type='button' value='$idioma_sistema[153]' $eventos[0]>
</div>
</div>
";
return $html;
};
function excluir_conta_usuario(){
global $idioma_sistema;
global $tabela_banco;
if(retorne_usuario_logado() == false){
        $array_retorno["dados"] = 1;
        return json_encode($array_retorno);
};
$senha_atual = codifica_md5(converte_minusculo(retorne_campo_formulario_request(15)));
$senha_usuario = retorna_senha_usuario_logado();
$nome_usuario = retorne_nome_usuario_logado();
if($senha_atual != $senha_usuario){
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[139]);
		return json_encode($array_retorno);
};
excluir_dados_usuario();
excluir_pastas_subpastas(retorne_pasta_usuario(retorne_idusuario_logado(), null, true), false);
logout_usuario();
$_SESSION[SESSAO_EMAIL] = null;
$array_retorno["dados"] = 1;
return json_encode($array_retorno);
};
function atualiza_novos_feeds_usuario($uidamigo){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[5];
$dados[0] = retorne_array_ids_ultimas_publicacoes_usuario($uid, true);
$dados[1] = retorne_array_ids_ultimas_publicacoes_usuario($uidamigo, true);
if(is_array($dados[0]) == false or is_array($dados[1]) == false){
		return null;
};
$data = data_atual();
$query[0] = "delete from $tabela_banco[8] where uidamigo='$uidamigo' and uid='$uid';";
$query[1] = "delete from $tabela_banco[8] where uidamigo='$uid' and uid='$uidamigo';";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
foreach($dados[0] as $id){
		if($id != null){
				$query[2] = "insert into $tabela_banco[8] values(null, '$uidamigo', '$uid', '$id', '$data');";
				plugin_executa_query($query[2]);
	};
};
foreach($dados[1] as $id){
		if($id != null){
				$query[3] = "insert into $tabela_banco[8] values(null, '$uid', '$uidamigo', '$id', '$data');";
				plugin_executa_query($query[3]);
	};
};
};
function carrega_feeds_usuario(){
global $tabela_banco;
$tabela[0] = $tabela_banco[8];
$tabela[1] = $tabela_banco[5];
$uid = retorne_idusuario_logado();
$limit_query = retorne_limit_query_iniciar(false, null);
$query = "select *from $tabela[0] where uid='$uid' order by id desc $limit_query;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id_post = $dados[ID_POST];
		$query = "select *from $tabela[1] where id='$id_post';";
		$dados_publicacao = plugin_executa_query($query);
		$html .= constroe_publicacao($dados_publicacao["dados"]);
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function erradicar_feeds_usuario($modo, $id_post, $uidamigo){
global $tabela_banco;
$dados = retorne_dados_publicacao($id_post);
if(($modo == false and $uidamigo == null and $dados["id"] == null) or $dados[PAGINA] != null){
		$query = "delete from $tabela_banco[8] where id_post='$id_post';";	
		plugin_executa_query($query);
		return null;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];
if(is_array($array_dados_amigos) == false){
        return null;
};
$contador = 0;
for($contador == $contador; $contador <= count($array_dados_amigos); $contador++){
	    $dados = $array_dados_amigos[$contador];
	    $idusuario = retorne_idamigo_dados_amigo(true, $dados, retorne_idusuario_logado());
		if($modo == true){
				$data = data_atual();
			    $query = "insert into $tabela_banco[8] values(null, '$idusuario', '$uidamigo', '$id_post', '$data');";
	}else{
				$query = "delete from $tabela_banco[8] where uid='$idusuario' and id_post='$id_post';";
	};
		if($idusuario != null){
	    	    plugin_executa_query($query);
	};
};
};
function excluir_feed_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[8];
$id = retorne_campo_formulario_request(4);
$uid = retorne_idusuario_logado();
$query = "delete from $tabela where uid='$uid' and id_post='$id';";
plugin_roda_query($query);
};
function limpar_feeds(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "delete from $tabela_banco[8] where uid='$idusuario';";
plugin_executa_query($query);
};
function retorna_publicacao_pertence_feed($id){
global $tabela_banco;
$tabela = $tabela_banco[8];
$uid = retorne_idusuario_logado();
$query = "select *from $tabela where uid='$uid' and id_post='$id';";
if(retorne_numero_linhas_query($query) == 0){
		return false;
}else{
		return true;
};
};
function constroe_formulario_barra_progresso($url_envio, $id_formulario, $nome_file, $tipo_pagina, $multiplo, $tipo_arquivo){
global $idioma_sistema;
global $variavel_campo;
global $extensao_formulario;
$numero_nome_funcao = $tipo_pagina.retorne_contador_iteracao();
switch($tipo_arquivo){
    case 1:
    $tipo_arquivo = $extensao_formulario[0];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(2, null, false);
    break;
    case 2:
    $tipo_arquivo = $extensao_formulario[1];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(34, null, false);
    break;
    case 3:
    $tipo_arquivo = $extensao_formulario[2];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(111, null, false);
    break;
};
switch($tipo_pagina){
	case 6:
	    $id = retorne_idpagina_request();
		$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	break;
	case 53:
	    $id = retorne_idpagina_request();
		$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	break;
	case 55:
	    $id = retorne_idpagina_request();
		$campos_extras .= "
	<input type='hidden' value='$id' name='$variavel_campo[25]'>
	";
	break;
	case 114:
		$chave = gera_chave_aleatoria();
		$campos_extras .= "
	<input type='hidden' value='$chave' name='$variavel_campo[3]'>
	";
	break;
};
$id_porcentagem = codifica_md5("porcentagem".$numero_nome_funcao);
$id_campo_file = codifica_md5("campo_file".$numero_nome_funcao);
$id_div_progresso = codifica_md5("campo_div_progresso".$numero_nome_funcao);
$id_div_botao_upload = codifica_md5("campo_botao_upload".$numero_nome_funcao);
if($multiplo == true){
	    $multiplo = "multiple";
};
$funcao[0] = "simula_clique_file_formulario_barra_progresso_".$numero_nome_funcao."()";
$funcao[1] = "simula_enviar_formulario_barra_progresso_".$numero_nome_funcao."()";
$evento[0] = "onclick='$funcao[0];'";
$evento[1] = "onchange='$funcao[1];'";
$campo_formulario = "
<div class='classe_div_formulario_progresso'>
<form action='$url_envio' method='post' enctype='multipart/form-data' id='$id_formulario'>
<input type='file' id='$id_campo_file' name='$nome_file' $evento[1] $tipo_arquivo $multiplo>
<div class='classe_exibe_barra_progresso_formulario' id='$id_div_progresso'>
<progress value='0' max='100'></progress>
<span id='$id_porcentagem' class='classe_barra_progresso_formulario_span'>0%</span>
<input type='hidden' name='$variavel_campo[2]' value='$tipo_pagina'>
$campos_extras
</div>
<div class='classe_div_botao_upload_formulario_progresso' id='$id_div_botao_upload'>
<div $evento[0]>$imagem_botao</div>
</div>
</form> 
</div>
";
$campo_script = "
<script language='javascript'>
$('#$id_formulario').ajaxForm({uploadProgress: function(event, position, total, percentComplete){
$('progress').attr('value',percentComplete);
$('#$id_porcentagem').html(percentComplete+'%');
}, success: function(data){
$('progress').attr('value','100');
$('#$id_porcentagem').html('100%');
$('pre').html(data);
location.reload();
}
});
function $funcao[0]{
$('#' + '$id_campo_file').click();
};
function $funcao[1]{
$('#$id_formulario').submit();
document.getElementById('$id_div_progresso').style.display = 'inline';
document.getElementById('$id_div_botao_upload').style.display = 'none';
};
</script>
";
$html = "
$campo_formulario
$campo_script
";
return $html;
};
function constroe_formulario_barra_progresso_postagem($url_envio, $id_formulario, $nome_file, $tipo_pagina, $multiplo, $tipo_arquivo, $funcoes_javascript){
global $idioma_sistema;
global $variavel_campo;
global $extensao_formulario;
$numero_nome_funcao = $tipo_pagina.retorne_contador_iteracao();
$id_porcentagem = codifica_md5("porcentagem".$numero_nome_funcao);
$id_campo_file = codifica_md5("campo_file".$numero_nome_funcao);
$id_div_progresso = codifica_md5("campo_div_progresso".$numero_nome_funcao);
$id_div_botao_upload = codifica_md5("campo_botao_upload".$numero_nome_funcao);
$chave = retorna_seta_chave_publicacao(false);
$uidamigo = $_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT];
if($uidamigo != null){
        $campo_uidamigo = "
    <input type='hidden' value='$uidamigo' name='$variavel_campo[5]'>
    ";
};
if(retorne_modo_pagina() == true){
		$pagina = retorne_idpagina_request();
		$campo_pagina[0] = "
	<input type='hidden' value='$pagina' name='$variavel_campo[25]'>
	";
};
switch($tipo_arquivo){
    case 1:
    $tipo_arquivo = $extensao_formulario[0];
    $campos_extras .= $campo_uidamigo;
	$imagem_botao = retorne_imagem_sistema(2, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_imagem";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;
    case 2:
    $tipo_arquivo = $extensao_formulario[1];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(34, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_musica";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;
    case 3:
    $tipo_arquivo = $extensao_formulario[2];
    $campos_extras = null;
	$imagem_botao = retorne_imagem_sistema(37, null, false);
	$idcampo_chave = "id_campo_chave_publicacao_video";
	$campo_chave_publicacao = "
	<input type='hidden' name='$variavel_campo[3]' value='$chave' id='$idcampo_chave'>
	";
    break;
};
if($multiplo == true){
	    $multiplo = "multiple";
};
$funcao[0] = "simula_clique_file_formulario_barra_progresso_".$numero_nome_funcao."()";
$funcao[1] = "simula_enviar_formulario_barra_progresso_".$numero_nome_funcao."()";
$evento[0] = "onclick='$funcao[0];'";
$evento[1] = "onchange='$funcao[1];'";
$campo_formulario = "
<div class='classe_div_formulario_progresso_publicacao'>
<form action='$url_envio' method='post' enctype='multipart/form-data' id='$id_formulario'>
<input type='file' id='$id_campo_file' name='$nome_file' $evento[1] $tipo_arquivo $multiplo>
<div class='classe_exibe_barra_progresso_formulario_publicacao' id='$id_div_progresso'>
<progress value='0' max='100'></progress>
<span id='$id_porcentagem' class='classe_barra_progresso_formulario_span_publicacao'>0%</span>
<input type='hidden' name='$variavel_campo[2]' value='$tipo_pagina'>
$campos_extras
$campo_pagina[0]
</div>
<div class='classe_div_botao_upload_formulario_progresso_publicacao' id='$id_div_botao_upload'>
$campo_chave_publicacao
<div $evento[0]>$imagem_botao</div>
</div>
</form> 
</div>
";
$campo_script = "
<script language='javascript'>
$('#$id_formulario').ajaxForm({uploadProgress: function(event, position, total, percentComplete){
$('progress').attr('value',percentComplete);
$('#$id_porcentagem').html(percentComplete+'%');
}, success: function(data){
$('progress').attr('value','100');
$('#$id_porcentagem').html('100%');
$('pre').html(data);
document.getElementById('$id_div_progresso').style.display = 'none';
$funcoes_javascript
}
});
function $funcao[0]{
$('#' + '$id_campo_file').click();
};
function $funcao[1]{
$('#$id_formulario').submit();
document.getElementById('$id_div_progresso').style.display = 'inline';
};
</script>
";
$html = "
$campo_formulario
$campo_script
";
return $html;
};
function formulario_altera_senha(){
global $idioma_sistema;
$chave = retorna_chave_request();
$id_campos[0] = codifica_md5("formulario_alterar_senha_0".data_atual());
$id_campos[1] = codifica_md5("formulario_alterar_senha_2".data_atual());
$id_campos[2] = codifica_md5("formulario_alterar_senha_3".data_atual());
$id_campos[3] = codifica_md5("formulario_alterar_senha_4".data_atual());
$funcao[0] = "alterar_senha(\"$id_campos[0]\", \"$id_campos[1]\", \"$id_campos[2]\", \"$id_campos[3]\");";
$funcao[1] = "nova_senha(\"$chave\", \"$id_campos[0]\", \"$id_campos[2]\", \"$id_campos[3]\");";
if(retorne_usuario_logado() == true){
		$eventos[0] = "onclick='$funcao[0]'";
	$eventos[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
		$campo[0] = "
	<div class='classe_separa_item_formulario_alterar_senha'>
	<input type='password' placeholder='$idioma_sistema[136]' id='$id_campos[1]' $eventos[1]>
	</div>	
	";
}else{
		$eventos[0] = "onclick='$funcao[1]'";
	$eventos[1] = "onkeydown='if(event.keyCode == 13){$funcao[1]}'";
};
$html = "
<div class='classe_formulario_alterar_senha'>
<div class='classe_titulo_formulario_alterar_senha classe_cor_3'>$idioma_sistema[112]</div>
<div class='classe_mensagem_formulario_alterar_senha' id='$id_campos[0]'></div>
$campo[0]
<div class='classe_separa_item_formulario_alterar_senha'>
<input type='password' placeholder='$idioma_sistema[137]' id='$id_campos[2]' $eventos[1]>
</div>
<div class='classe_separa_item_formulario_alterar_senha'>
<input type='password' placeholder='$idioma_sistema[138]' id='$id_campos[3]' $eventos[1]>
</div>
<div class='classe_separa_item_formulario_alterar_senha'>
<input type='button' value='$idioma_sistema[12]' $eventos[0]>
</div>
</div>
";
return $html;
};
function formulario_cadastro($modo){
global $idioma_sistema;
global $url_link_acao;
if($modo == true){
		$idcampo[0] = retorne_id_formulario_cadastro();
		$pagina_inicial = PAGINA_INICIAL;
		$link[0] = $url_link_acao[31];
		$html = "
	<div class='classe_formulario_cadastro_link_cadastro' id='$idcampo[0]'>
	$link[0]
	</div>
	";
		return $html;
};
$modo_mobile = retorne_modo_mobile();
$idcampo[0] = codifica_md5("id_campo_cadastro_nome");
$idcampo[1] = codifica_md5("id_campo_cadastro_sobrenome");
$idcampo[2] = codifica_md5("id_campo_cadastro_email");
$idcampo[3] = codifica_md5("id_campo_cadastro_senha");
$idcampo[4] = codifica_md5("id_campo_cadastro_senha_confirma");
$idcampo[5] = codifica_md5("id_campo_cadastro_mensagem_sucesso");
$idcampo[6] = codifica_md5("id_campo_cadastro_botao");
$idcampo[7] = codifica_md5("id_campo_cadastro_progresso");
$idcampo[8] = retorne_id_formulario_cadastro();
$campo_progresso[0] = campo_progresso_gif($idcampo[7]);
$funcao[0] = "cadastrar_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$idcampo[6]\", \"$idcampo[7]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$classe[0] = "classe_formulario_cadastro_topo";
$html = "
<div class='classe_formulario_cadastro' id='$idcampo[8]'>
<div class='$classe[0]'>
<div class='classe_formulario_cadastro_titulo'>
$idioma_sistema[577]
</div>
</div>
<div class='classe_formulario_cadastro_campo'>
<input type='text' id='$idcampo[0]' placeholder='$idioma_sistema[299]' $evento[1] required>
</div>
<div class='classe_formulario_cadastro_campo'>
<input type='text' id='$idcampo[1]' placeholder='$idioma_sistema[300]' $evento[1] required>
</div>
<div class='classe_formulario_cadastro_campo'>
<input type='email' id='$idcampo[2]' placeholder='$idioma_sistema[1]' $evento[1] required>
</div>
<div class='classe_formulario_cadastro_campo'>
<input type='password' id='$idcampo[3]' placeholder='$idioma_sistema[2]' $evento[1] required>
</div>
<div class='classe_formulario_cadastro_campo'>
<input type='password' id='$idcampo[4]' placeholder='$idioma_sistema[301]' $evento[1] required>
</div>
<div class='classe_formulario_login_div_mensagem' id='$idcampo[5]'></div>
$campo_progresso[0]
<div class='classe_formulario_cadastro_campo_botao' id='$idcampo[6]'>
<span class='botao_padrao' $evento[0]>$idioma_sistema[171]</span>
</div>
<div class='classe_formulario_cadastro_campo_termo'>
$url_link_acao[27]
</div>
</div>
";
return $html;
};
function formulario_edita_perfil(){
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){
        return null;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$array_campos = explode(",", $idioma_sistema[10]);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);
$contador = 0;
$funcao[0] = "auto_ajustar_campo_textarea(this);";
$evento[0] = "onkeyup='$funcao[0]'";
foreach($array_campos as $campo){
		$campo_especial = false;
		if($campo != null){
				$campo_tabela = $array_campos_tabela[$contador];
				$campo_tabela = trata_campo_tabela($campo_tabela, false);
				$campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
				$valor_campo = $dados_perfil[$campo_tabela];
	};
		if(($contador >= 15 and $contador <= 22 and $campo != null) or $contador == 29){
				$campos_html .= "
		<div class='classe_separa_campo_formulario_edita_perfil'>
		<span>$campo:</span>
		<textarea name='$campo_elemento_nome' $evento[0]>$valor_campo</textarea>
		</div>
		";
				$campo_especial = true;
	};
		if($campo != null){
				switch($contador){
			case 2:
			$campo_select_option = gerador_select_option_especial($idioma_sistema[36], $idioma_sistema[388], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			case 3:
			if(retorne_sexo_usuario($dados_perfil) == true){
				$campo_select_option = gerador_select_option($idioma_sistema[37], $valor_campo, $campo_elemento_nome, null, null);
			}else{
				$campo_select_option = gerador_select_option($idioma_sistema[38], $valor_campo, $campo_elemento_nome, null, null);
			};
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			case 6:
			$campo_select_option = gerador_select_option($idioma_sistema[39], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			case 26:
			$campo_select_option = gerador_select_option($idioma_sistema[40], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			case 27:
			$campo_select_option = gerador_select_option($idioma_sistema[41], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			case 4:
			$campo_select_option = campo_data($campo_elemento_nome, $valor_campo);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			default:
						if($campo_especial == false){
								$campos_html .= "
				<div class='classe_separa_campo_formulario_edita_perfil'>
				<span>$campo:</span>
				<input type='text' name='$campo_elemento_nome' value='$valor_campo'>
				</div>
				";
			};
	};
	    		$contador++;
	};
};
$url_pagina_acoes = PAGINA_ACOES;
$html = "
<form action='$url_pagina_acoes' method='POST'>
<input type='hidden' name='$variavel_campo[2]' value='3'>
<input type='hidden' name='$variavel_campo[6]' value='1'>
<div class='classe_div_campos_formulario_ed_perfil'>
$campos_html
</div>
<div class='classe_div_salvar_formulario_ed_perfil'>
<input type='submit' value='$idioma_sistema[12]'>
</form>
</div>
";
return $html;
};
function formulario_login_topo(){
global $idioma_sistema;
global $variavel_campo;
if(retorne_modo_mobile() == true or retorne_usuario_logado() == true){
		return null;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$idcampo[5] = retorne_idcampo_md5();
$idcampo[6] = retorne_idcampo_md5();
$progresso[0] = campo_progresso_gif($idcampo[0]);
$funcao[0] = "logar_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$idcampo[6]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$campo[0] = "
<div class='classe_barra_progresso_formulario_login_topo' id='$idcampo[4]'>
$progresso[0]
</div>
<div class='classe_formulario_topo_login_botao'>
	<span class='span_link_2' $evento[0]>$idioma_sistema[3]</span>
</div>
";
$campo[1] = constroe_campo_recupera_senha(false);
$campo[2] = "
<div class='classe_formulario_topo_login_div_mensagem' id='$idcampo[3]'></div>
";
$campo[2] = constroe_dialogo($idioma_sistema[595], $campo[2], $idcampo[6]);
$html = "
<div class='classe_formulario_topo_login' id='$idcampo[5]'>
<div class='classe_formulario_topo_login_div'>
<input type='email' id='$idcampo[1]' placeholder='$idioma_sistema[1]' $evento[1] required>
</div>
<div class='classe_formulario_topo_login_div'>
<input type='password' id='$idcampo[2]' placeholder='$idioma_sistema[2]' $evento[1] required>
</div>
$campo[0]
$campo[1]
</div>
$campo[2]
";
return $html;
};
function gerador_select_option($array_options, $valor_atual, $nome, $idcampo, $evento_campo){
$array_options = explode(",", $array_options);
foreach($array_options as $valor){
		$valor_original = trim($valor);
		$valor = trim(strtolower($valor));
	$valor_atual = trim(strtolower($valor_atual));
		if($valor == $valor_atual){
				$html .= "<option value='$valor_original' selected>$valor_original</option>";
	}else{
				$html .= "<option value='$valor_original'>$valor_original</option>";
	};
};
$html = "<select name='$nome' id='$idcampo' onchange='$evento_campo'>$html</select>";
return $html; 
};
function gerador_select_option_especial($array_options, $array_valores, $valor_atual, $nome, $idcampo, $evento_campo){
$array_options = explode(",", $array_options);
$array_valores = explode(",", $array_valores);
$contador = 0;
$valor_atual = trim(strtolower($valor_atual));
foreach($array_options as $valor){
		$valor_original = trim($valor);
		$valor_especial = trim(strtolower($array_valores[$contador]));
		$valor = trim(strtolower($valor));
		if($valor == $valor_atual or $valor_especial == $valor_atual){
				$html .= "<option value='$valor_especial' selected>$valor_original</option>";
	}else{
				$html .= "<option value='$valor_especial'>$valor_original</option>";
	};
		$contador++;
};
$html = "<select name='$nome' id='$idcampo' onchange='$evento_campo'>$html</select>";
return $html; 
};
function gera_chave_aleatoria(){
$_SESSION[SESSAO_CHAVE_ALEATORIA] += 1;
return codifica_md5("md5_chave_aleatoria_".$_SESSION[SESSAO_CHAVE_ALEATORIA].data_atual());
};
function plugin_formulario_login(){
global $idioma_sistema;
global $variavel_campo;
$modo_mobile = retorne_modo_mobile();
if(retorne_usuario_logado() == true){
		return null;
};
$campo[0] = constroe_campo_recupera_senha(false);
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$idcampo[5] = retorne_idcampo_md5();
$idcampo[6] = retorne_idcampo_md5();
$progresso[0] = campo_progresso_gif($idcampo[0]);
$funcao[0] = "logar_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$idcampo[6]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$campo[1] = "
<span id='$idcampo[4]' class='botao_padrao' $evento[0]>$idioma_sistema[3]</span>
";
if($modo_mobile == false){
		$campo[2] = "
	<div class='classe_formulario_login_titulo'>
	$idioma_sistema[472]
	</div>
	";
		$placeholder[0] = "placeholder='$idioma_sistema[1]'";
	$placeholder[1] = "placeholder='$idioma_sistema[2]'";
}else{
		$texto[0] = "<span class='span_descreve_formulario_login'>$idioma_sistema[492]</span>";
	$texto[1] = "<span class='span_descreve_formulario_login'>$idioma_sistema[493]</span>";
};
$campo[3] = "
<div class='classe_formulario_login_div_mensagem' id='$idcampo[3]'></div>
";
$campo[3] = constroe_dialogo($idioma_sistema[595], $campo[3], $idcampo[6]);
$html = "
<div class='classe_formulario_login' id='$idcampo[5]'>
$campo[2]
$texto[0]
<div class='classe_formulario_login_div'>
<input type='email' id='$idcampo[1]' $placeholder[0] $evento[1] required>
</div>
$texto[1]
<div class='classe_formulario_login_div'>
<input type='password' id='$idcampo[2]' $placeholder[1] $evento[1] required>
</div>
<div class='classe_formulario_login_botao'>
$campo[1]
$progresso[0]
</div>
$campo[0]
</div>
$campo[3]
";
return $html;
};
function remove_html($html){
$html = addslashes($html);
$html = strip_tags($html);
if(verifica_se_email_valido($html) == true){
        $html = converte_minusculo($html);
};
return $html;
};
function retorne_campo_formulario_request($modo){
global $variavel_campo;
return remove_html($_REQUEST[$variavel_campo[$modo]]);
};
function retorne_campo_formulario_request_htmlentites($modo){
global $variavel_campo;
return trata_html_requeste($_REQUEST[$variavel_campo[$modo]]);
};
function retorne_id_formulario_cadastro(){
return codifica_md5("id_formulario_cadastro_inicio");
};
function retorne_tipo_acao_pagina(){
$tipo_acao = retorne_campo_formulario_request(2);
if(retorne_idpagina_request() != null){
		switch(retorne_campo_formulario_request(2)){
		case 7:
				$tipo_acao = 7;
		break;
		default:
				$tipo_acao = 9;	
	};
};
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false and $tipo_acao == null){
        $tipo_acao = 9;
};
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == true and $tipo_acao == null){
	    $tipo_acao = 22;
};
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false and $tipo_acao == 22){
        $tipo_acao = 9;
};
if($tipo_acao == 25){
		switch(retorne_campo_formulario_request(6)){
		case 1: 		$tipo_acao = -1;
		break;
		case 3: 		$tipo_acao = 27;
		break;
		case 4: 		$tipo_acao = 29;
		break;
	};
};
return $tipo_acao;
};
function verifica_se_email_valido($email){
$email = converte_minusculo(trim($email));
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	    list($usuario, $dominio) = explode("@", $email);
		if(checkdnsrr($dominio, "MX")){
				return true;
	}else{
				return false;
	}
}else{
	    return false;
};
};
function constroe_campo_frase_efeito(){
global $idioma_sistema;
global $tabela_banco;
$uid = retorne_idusuario_request();
$usuario_dono = retorne_usuario_dono_perfil($uid);
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados = $dados_compilados_usuario[$tabela_banco[33]];
$conteudo[0] = $array_dados[CONTEUDO];
$conteudo[1] = $array_dados[CONTEUDO];
if($usuario_dono == true){
		$nome = retorne_nome_usuario_logado();
		if($conteudo[0] == null){
		$conteudo[0] = $nome.$idioma_sistema[469];
	};
		$idcampo[0] = retorne_idcampo_md5();
	$idcampo[1] = retorne_idcampo_md5();
	$idcampo[2] = retorne_idcampo_md5();
	$idcampo[3] = retorne_idcampo_md5();
	$idcampo[4] = retorne_idcampo_md5();
		$progresso[0] = campo_progresso_gif($idcampo[3]);
		$funcao[0] = "salvar_frase_efeito(\"$idcampo[0]\", \"$idcampo[3]\", \"$idcampo[4]\");";
	$funcao[1] = "exibe_itens_frase_efeito(\"$idcampo[1]\", \"$idcampo[2]\")";
	$funcao[2] = "oculta_itens_frase_efeito(\"$idcampo[1]\", \"$idcampo[2]\")";
		$evento[0] = "onclick='$funcao[0]'";
	$evento[1] = "onclick='$funcao[1]'";
	$evento[2] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
	$evento[3] = "ondblclick='$funcao[2]'";
		$campo[0] = "
	<div class='classe_campo_frase_efeito_entrada' id='$idcampo[1]'>
	<div class='classe_campo_frase_efeito_entrada_separa_1'>
	<input type='text' placeholder='$nome$idioma_sistema[467]' id='$idcampo[0]' value='$conteudo[1]' $evento[2]>
	</div>
	<div class='classe_campo_frase_efeito_entrada_separa_2'>
	<div class='classe_campo_frase_efeito_entrada_separa_progresso'>
	$progresso[0]
	</div>
	<span class='botao_padrao' $evento[0] id='$idcampo[4]'>
	$idioma_sistema[468]
	</span>
	</div>
	</div>
	";
		$conteudo[0] = converter_urls_basicas($conteudo[0]);
		$campo[1] = "
	<div class='classe_campo_frase_efeito_frase' id='$idcampo[2]'>
	$conteudo[0]
	</div>
	";
		$campo[0] = "
	$campo[1]
	$campo[0]
	";
}else{
		$conteudo[0] = converter_urls_basicas($conteudo[0]);
		$campo[0] = "
	<div class='classe_campo_frase_efeito_frase'>
	$conteudo[0]
	</div>
	";
};
if($conteudo[0] == null and $usuario_dono == false){
		return null;
};
$html = "
<div class='classe_campo_frase_efeito' $evento[1] $evento[3]>
$campo[0]
</div>
";
return $html;
};
function salvar_frase_efeito(){
global $tabela_banco;
$conteudo = retorne_campo_formulario_request(36);
$tabela = $tabela_banco[33];
$uid = retorne_idusuario_logado();
$data = data_atual();
$query[0] = "select *from $tabela where uid='$uid';";
$query[1] = "insert into $tabela values(null, '$uid', '$conteudo', '$data');";
$query[2] = "update $tabela set conteudo='$conteudo', data='$data' where uid='$uid';";
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] == 0){
		plugin_executa_query($query[1]);
}else{
		plugin_executa_query($query[2]);
};
atualiza_retorna_dados_usuario_sessao(true, true);
};
function adiciona_quebra_linha($conteudo){
global $codigos_especiais;
return str_ireplace("\n", $codigos_especiais[14], $conteudo);
};
function adiciona_quebra_linha_textarea($conteudo){
return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\r\r", $conteudo);
};
function atualizar_conexao_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[17];
$uid = retorne_idusuario_logado();
$data_conexao = retorne_data_atual_conexao();
$query[0] = "select *from $tabela where uid='$uid';";
$query[1] = "update $tabela set data_conexao='$data_conexao' where uid='$uid';";
$query[2] = "insert into $tabela values(null, '$uid', '$data_conexao');";
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] == 0){
		plugin_executa_query($query[2]);
}else{
		plugin_executa_query($query[1]);
};
};
function campo_data($campo_elemento_nome, $data){
global $idioma_sistema;
global $meses_ano;
global $variavel_campo;
global $codigos_especiais;
$ano_atual = Date("Y");
$contador = NUMERO_DATA_MAXIMA_ANO;
$data = explode($codigos_especiais[10], $data);
for($contador == $contador; $contador <= $ano_atual; $contador++){
		$lista_anos .= $contador.",";
};
$contador = 1;
for($contador == $contador; $contador <= NUMERO_DATA_MAXIMA_DIA; $contador++){
		$lista_dias .= $contador.",";
};
$contador = 1;
for($contador == $contador; $contador <= NUMERO_DATA_MAXIMA_MES; $contador++){
		$lista_meses .= $contador.",";
		$lista_meses_nomes .= $meses_ano[$contador - 1].",";
};
$campo[0] = gerador_select_option_especial($lista_dias, $lista_dias, $data[0], $variavel_campo[37], null, null);
$campo[1] = gerador_select_option_especial($lista_meses_nomes, $lista_meses, $data[1], $variavel_campo[38], null, null);
$campo[2] = gerador_select_option_especial($lista_anos, $lista_anos, $data[2], $variavel_campo[39], null, null);
$html = "
<input type='hidden' name='$campo_elemento_nome'>
$campo[0]
$campo[1]
$campo[2]
";
return $html;
};
function campo_progresso_gif($idcampo){
global $idioma_sistema;
$imagem_sistema[0] = retorne_imagem_sistema(16, null, false);
if($idcampo == null){
		return $imagem_sistema[0];
};
$html = "
<div class='classe_campo_progresso_gif' id='$idcampo'>
$imagem_sistema[0]
</div>
";
return $html;
};
function captular($conteudo){
$conteudo = trim($conteudo);
return ucfirst($conteudo);
};
function chama_acao_usuario($tipo_acao){
global $variavel_campo;
if($tipo_acao == null){
		$tipo_acao = retorne_tipo_acao_pagina();
};
if($tipo_acao == null){
		return chama_pagina_inicial();
};
$pagina_inicial = PAGINA_INICIAL."?".$variavel_campo[2]."=$tipo_acao";
header("Location: $pagina_inicial");
};
function chama_pagina_inicial(){
$pagina_inicial = PAGINA_INICIAL;
header("Location: $pagina_inicial");
};
function chama_pagina_url($url_pagina){
header("Location: $url_pagina");
};
function codifica_base64($conteudo){
return base64_encode($conteudo).LOGOTIPO_MD5;
};
function codifica_md5($conteudo){
return md5($conteudo).LOGOTIPO_MD5;
};
function constroe_campos_perfil_usuario_lateral(){
$html .= constroe_perfil_basico();
$html .= constroe_campo_opcoes_perfil(2);
$html .= constroe_campo_opcoes_perfil(5);
return $html;
};
function constroe_campo_desenvolvedor(){
global $administradores_sistema;
global $idioma_sistema;
if(retorne_usuario_logado() == true){
		$classe[0] = "classe_campo_desenvolvedor_2 classe_cor_8";
}else{
		$classe[0] = "classe_campo_desenvolvedor";	
};
$uid = retorne_idusuario_email($administradores_sistema[0]);
$link[0] = retorne_nome_link_usuario(true, $uid);
$campo[0] = "
<div class='classe_campo_desenvolvedor_separa'>
<div class='classe_campo_desenvolvedor_separa_titulo classe_cor_7'>
$idioma_sistema[314]
</div>
<div class='classe_campo_desenvolvedor_separa_conteudo'>
$link[0]
</div>
</div>
";
$campo[1] = constroe_alterar_idioma();
$campo[1] = "
<div class='classe_campo_desenvolvedor_separa_2'>
$campo[1]
</div>
";
$html = "
<div class='$classe[0]'>
$campo[0]
$campo[1]
</div>
";
return $html;
};
function constroe_campo_div_editavel($modo, $idcampo_1, $conteudo, $classe, $evento, $placeholder){
if($classe == null){
		$classe_padrao[0] = "classe_padrao_div_editavel";
};
if($modo == true){
		$classe_padrao[1] = " borda_div_5 classe_padrao_div_editavel_imagem";
}else{
		$classe_padrao[1] = " borda_div_2 classe_padrao_div_editavel_imagem";
};
$classe .= $classe_padrao[0].$classe_padrao[1];
$html = "
<div contenteditable class='$classe' id='$idcampo_1' placeholder='$placeholder' $evento>$conteudo</div>
";
return $html;
};
function constroe_campo_formulario($modo, $valor, $idcampo, $nome, $placeholder, $evento){
switch($modo){
	case 1:
	$html = "<input type='text' value='$valor' name='$nome' placeholder='$placeholder' id='$idcampo' $evento>";
	break;
	case 2:
	$html = "<input type='button' value='$valor' $evento>";
	break;
};
return $html;
};
function constroe_css_manual($classe, $id, $propriedades){
if($classe != null){
		$seletor = ".$classe";
};
if($id != null){
		$seletor = "#$id";
};
$html = "
<style>
$seletor{
	$propriedades
}
</style>
";
return $html;
};
function constroe_data_conteudo($data){
$data = converte_data_amigavel(true, $data);
$html = "
<div class='classe_campo_data_conteudo classe_cor_15'>
<span class='classe_campo_data_conteudo_span'>$data</span>
</div>
";
return $html;
};
function constroe_links_navegacao_lateral(){
global $idioma_sistema;
global $variavel_campo;
$uid = retorne_idusuario_logado();
$url_index[0] = PAGINA_INDEX_INICIO."?".$variavel_campo[5]."=$uid&".$variavel_campo[2];
$url_index[1] = PAGINA_INDEX_INICIO;
$urls[] = "$url_index[1]"; 
$urls[] = "$url_index[0]=2"; 
$urls[] = "$url_index[0]=25"; 
$urls[] = "$url_index[0]=3"; 
$urls[] = "$url_index[0]=9"; 
$urls[] = "$url_index[0]=22"; 
$urls[] = "$url_index[0]=104"; 
$urls[] = "$url_index[0]=90"; 
$urls[] = "$url_index[0]=7"; 
$urls[] = "$url_index[0]=78"; 
$urls[] = "$url_index[0]=82"; 
$urls[] = "$url_index[0]=107"; 
$urls[] = "$url_index[0]=111";
$array_titulos[] = $idioma_sistema[94];
$array_titulos[] = $idioma_sistema[603];
$array_titulos[] = $idioma_sistema[103];
$array_titulos[] = $idioma_sistema[473];
$array_titulos[] = $idioma_sistema[339];
$array_titulos[] = $idioma_sistema[93];
$array_titulos[] = $idioma_sistema[474];
$array_titulos[] = $idioma_sistema[475];
$array_titulos[] = $idioma_sistema[167];
$array_titulos[] = $idioma_sistema[368];
$array_titulos[] = $idioma_sistema[381];
$array_titulos[] = $idioma_sistema[321];
$array_titulos[] = $idioma_sistema[583];
$contador = 0;
foreach($urls as $url){
		if($url != null){
				$titulo = $array_titulos[$contador];
				$url = $urls[$contador];
				$lista .= "
		<div class='classe_link_atalho_navegacao_lateral'>
		<a href='$url' title='$titulo'>$titulo</a>
		</div>
		";
				$contador++;
	};
};
$html = "
<div class='classe_links_navegacao_lateral classe_cor_8'>
$lista
</div>
";
return $html;
};
function constroe_paginador_padrao($idcampo_1, $funcao){
global $idioma_sistema;
$idcampo[0] = retorne_idcampo_md5();
$progresso_gif = campo_progresso_gif($idcampo_1);
$evento[0] = "onclick='exibe_elemento_oculto(\"$idcampo_1\", 0), $funcao'";
$html = "
<div class='classe_paginador_padrao_progresso'>
$progresso_gif
</div>
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";
return $html;
};
function converter_urls($adiciona_link_imagem, $conteudo){
$conteudo = html_entity_decode($conteudo);
$conteudo = converte_tag_imagem($conteudo, $adiciona_link_imagem);
$conteudo = adiciona_quebra_linha($conteudo);
$conteudo = converte_url_video_youtube($conteudo);
$conteudo = converte_codigos_especiais($conteudo);
$conteudo = converte_conteudo_hashtag($conteudo);
$conteudo = converte_url_link($conteudo);
return $conteudo;
};
function converter_urls_basicas($conteudo){
$conteudo = converte_conteudo_hashtag($conteudo);
$conteudo = converte_url_link($conteudo);
return $conteudo;
};
function converte_codigos_especiais($conteudo){
global $codigos_especiais;
$conteudo = str_ireplace($codigos_especiais[0], $codigos_especiais[2], $conteudo);
$conteudo = str_ireplace($codigos_especiais[1], $codigos_especiais[3], $conteudo);
$conteudo = str_ireplace($codigos_especiais[4], $codigos_especiais[6], $conteudo);
$conteudo = str_ireplace($codigos_especiais[5], $codigos_especiais[7], $conteudo);
$conteudo = str_ireplace($codigos_especiais[8], $codigos_especiais[9], $conteudo);
$conteudo = str_ireplace("\n", "<br>", $conteudo);
$conteudo = stripslashes($conteudo);
return $conteudo;
};
function converte_data_amigavel($modo_hoje, $data){
global $semana_idioma;
global $mes_extenso_idioma;
global $idioma_sistema;
if($data == null){
        return null;
};
$diferenca = diferenca_data_conexao($data);
if($diferenca <= 30){
		return $idioma_sistema[500];
};
if($diferenca <= 60){
		return $idioma_sistema[504];
};
if($diferenca <= 3600){
		return $idioma_sistema[501];
};
if($diferenca <= 86400){
		return $idioma_sistema[502];
};
if($diferenca <= 172800){
		return $idioma_sistema[503];
};
$data_explode = explode("-", $data); 
if($data_explode[0] == null or $data_explode[1] == null or $data_explode[2] == null){
        return null;
};
$time = mktime(0, 0, 0, $data_explode[1]);
$nome_mes = strftime("%b", $time);
$numero_dia = $data_explode[0];
$mes = $nome_mes; $dia = $data_explode[0]; $ano = $data_explode[2]; 
if($dia == Date("d") and $modo_hoje == true){
        return $idioma_sistema[135];	
};
$ano = explode(":", $ano);
$ano = $ano[0];
$ano = explode(" ", $ano);
$ano = $ano[0];
$dia_semana = date('w', mktime(0,0,0, $data_explode[1], $data_explode[0], $data_explode[2]));
$data_completa = $semana_idioma[$dia_semana]." {$dia} $idioma_sistema[80] ".$mes_extenso_idioma[$mes]." $idioma_sistema[80] {$ano}";
return $data_completa;
};
function converte_improprio($conteudo){
global $chave_improprio;
$uid = retorne_idusuario_logado();
$palavras_chave = $chave_improprio.",".retorna_configuracao_privacidade(3, $uid);
$palavras = explode(",", $palavras_chave);
foreach($palavras as $palavra){
		if($palavra != null){
				$palavra = trim($palavra);
				$tooltip = "data-tooltip='$palavra'";
				$trunca_palavrao = TRUNCA_PALAVRAO;
				$palavra_chave = " <span class='classe_improprio span_link_3' $tooltip>$trunca_palavrao</span>";
				$palavra_1 = " ".$palavra;
		$palavra_2 = $palavra." ";
		$palavra_3 = " ".$palavra." ";
				$conteudo = str_ireplace($palavra_1, $palavra_chave, $conteudo);
		$conteudo = str_ireplace($palavra_2, $palavra_chave, $conteudo);
		$conteudo = str_ireplace($palavra_3, $palavra_chave, $conteudo);
				if(converte_minusculo(trim($conteudo)) == converte_minusculo($palavra)){
						$conteudo = str_ireplace($palavra, $palavra_chave, $conteudo);
		};
	};
};
return $conteudo;
};
function converte_minusculo($conteudo){
return mb_strtolower($conteudo, "UTF-8");
};
function converte_tag_imagem($conteudo, $modo){
if($modo == true){
		$conteudo = preg_replace('#(http://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<a href="$1.$2" target="_blank"><img src="$1.$2" alt="$1.$2" /></a>', $conteudo);
	$conteudo = preg_replace('#(https://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<a href="$1.$2" target="_blank"><img src="$1.$2" alt="$1.$2" /></a>', $conteudo);
}else{
		$conteudo = preg_replace('#(http://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" />', $conteudo);
	$conteudo = preg_replace('#(https://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" />', $conteudo);
};
return $conteudo;
};
function converte_url_link($conteudo){
$conteudo = preg_replace('$(\s|^)(https?://[a-z0-9_./?=&-]+)(?![^<>]*>)$i', ' <a href="$2" target="_blank">$2</a> ', $conteudo." ");
$conteudo = preg_replace('$(\s|^)(www\.[a-z0-9_./?=&-]+)(?![^<>]*>)$i', '<a target="_blank" href="http://$2"  target="_blank">$2</a> ', $conteudo." ");
return $conteudo;
};
function converte_url_video_youtube($conteudo){
$altura_player = ALTURA_PLAYER_YOUTUBE."px";
$conteudo = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"100%\" height=\"$altura_player\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $conteudo);
return $conteudo;
};
function copiar_arquivos($origem, $destino){
if(is_dir($origem)){
	    $dir_handle = opendir($origem);
	    while($file = readdir($dir_handle)){
				if($file != "." && $file != ".."){
			            if(is_dir($origem.SEPARADOR_PASTA.$file)){
				                if(!is_dir($destino.SEPARADOR_PASTA.$file)){
					                    mkdir($destino.SEPARADOR_PASTA.$file);
                };
				                copiar_arquivos($origem.SEPARADOR_PASTA.$file, $destino.SEPARADOR_PASTA.$file);
			}else{
				                copy($origem.SEPARADOR_PASTA.$file, $destino.SEPARADOR_PASTA.$file);
			};
        };
	};
	    closedir($dir_handle);
}else{
	    copy($origem, $destino);
};
};
function data_atual(){
$data_atual = Date("d-m-Y G:i:s");
return $data_atual;
};
function diferenca_data_conexao($data_comparar){
return strtotime(date('Y/m/d H:i:s')) - strtotime($data_comparar);
};
function encurta_texto($texto, $tamanho){
global $idioma_sistema;
if(strlen($texto) <= $tamanho or retorne_texto_contem_html($texto) == true){
		return $texto;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$sub_texto = substr($texto, 0, $tamanho)."...";
$evento[0] = "onclick='encurtar_texto(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", true);'";
$evento[1] = "onclick='encurtar_texto(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", false);'";
$html = "
<div class='classe_encurta_texto_original' id='$idcampo[1]'>
$texto
</div>
<div class='classe_encurta_texto_exibe_menos' id='$idcampo[2]'>
<span class='span_link' $evento[1]>$idioma_sistema[522]</span>
</div>
<div class='classe_encurta_texto' id='$idcampo[0]'>
<div class='classe_encurta_texto_parte'>
$sub_texto
</div>
<div class='classe_encurta_texto_exibe_mais'>
<span class='span_link' $evento[0]>$idioma_sistema[521]</span>
</div>
</div>
";
return $html;
};
function enviar_email($email_destino, $assunto_mensagem, $corpo_mensagem){
if($email_destino == null){
        return null;	
};
$nome_sistema = NOME_SISTEMA;
$cabecalho = "From: $nome_sistema"."\r\n"."Reply-To: $nome_sistema"."\r\n";
mail($email_destino, $assunto_mensagem , $corpo_mensagem, $cabecalho); 
};
function gera_tooltip($conteudo){
return "data-tooltip='$conteudo'";
};
function inverte_array($array_conteudo){
if(is_array($array_conteudo) == true){
		$array_conteudo = array_reverse($array_conteudo);
};
return $array_conteudo;
};
function paginar($item_per_page, $current_page, $total_records, $page_url){
   $total_pages = ceil($total_records / $item_per_page);
   $pagination = '';
	if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){         $pagination .= '<ul class="pagination">';
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3;         $next           = $current_page + 1;         $first_link     = true;         
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="'.$page_url.'=1">&laquo;</a></li>';             $pagination .= '<li><a href="'.$page_url.'='.$previous_link.'">&lt;</a></li>';                 for($i = ($current_page-2); $i < $current_page; $i++){                     if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'='.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false;         }
        if($first_link){             $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){             $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{             $pagination .= '<li class="active">'.$current_page.'</li>';
        }
        for($i = $current_page+1; $i < $right_links ; $i++){             if($i<=$total_pages){
                $pagination .= '<li><a href="'.$page_url.'='.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="'.$page_url.'='.$next_link.'" >&gt;</a></li>';                 $pagination .= '<li class="last"><a href="'.$page_url.'='.$total_pages.'">&raquo;</a></li>';         }
        $pagination .= '</ul>'; 
    }
    return $pagination; 	
};
function remove_acentos($texto){
$map = array(
    'á' => 'a',
    'à' => 'a',
    'ã' => 'a',
    'â' => 'a',
    'é' => 'e',
    'ê' => 'e',
    'í' => 'i',
    'ó' => 'o',
    'ô' => 'o',
    'õ' => 'o',
    'ú' => 'u',
    'ü' => 'u',
    'ç' => 'c',
    'Á' => 'A',
    'À' => 'A',
    'Ã' => 'A',
    'Â' => 'A',
    'É' => 'E',
    'Ê' => 'E',
    'Í' => 'I',
    'Ó' => 'O',
    'Ô' => 'O',
    'Õ' => 'O',
    'Ú' => 'U',
    'Ü' => 'U',
    'Ç' => 'C'
);
$texto = strtr($texto, $map);
return remove_parenteses($texto);
};
function remove_linhas_branco($conteudo){
return preg_replace('/\n\s*\n/', "\n", $conteudo);
};
function remove_parenteses($texto){
return preg_replace("/[^a-z0-9_\s-]/", "", $texto);
};
function remove_quebra_linha($conteudo){
global $codigos_especiais;
$conteudo = str_ireplace($codigos_especiais[14], "\n", $conteudo);
$conteudo = str_ireplace(trim($codigos_especiais[14]), "\n", $conteudo);
return $conteudo;
};
function retorna_extensao_imagem_valida($conteudo){
global $extensao_imagem;
if($conteudo == null){
		return false;
};
if($conteudo[0] != "."){
		$extensao = ".".$conteudo;
};
foreach($extensao_imagem as $extensao_atual){
		if($extensao_atual != null and $extensao != null){
				$extensao_atual = converte_minusculo($extensao_atual);
		$extensao = converte_minusculo($extensao);
				if($extensao_atual == $extensao){
						return true;
		};
	};
};
return false;
};
function retorna_e_url($conteudo){
$conteudo = converte_minusculo($conteudo);
$sub_conteudo = substr($conteudo, 0, 7);
switch($sub_conteudo){
	case "http://": 	return true;
	break;
};
};
function retorna_idcampo_conteudo_geral(){
$html = "id_div_publicacoes_usuario";
return $html;
};
function retorna_idcampo_progresso_gif_geral(){
$html = "id_campo_progresso_gif_paginar_publicacoes";
return $html;
};
function retorna_links($modo, $titulo){
global $variavel_campo;
global $idioma_sistema;
$uid = retorne_idusuario_request();
switch($modo){
	case 3: 	$titulo = $idioma_sistema[17];
	break;
};
$link = PAGINA_INDEX_INICIO."?$variavel_campo[5]=$uid&$variavel_campo[2]=$modo";
$link = "<a href='$link' title='$titulo'>$titulo</a>";
return $link;
};
function retorna_link_acao($conteudo, $tipo_acao, $idusuario){
global $variavel_campo;
global $idioma_sistema;
if($idusuario == null){
	    $idusuario = retorne_idusuario_logado();
};
$usuario_dono_perfil = retorne_usuario_dono_perfil($idusuario);
$url_perfil_usuario = retorne_url_amigavel_usuario($idusuario, 0, null);
$links[0] = "<a href='$url_perfil_usuario&$variavel_campo[2]=9'>$conteudo</a>";
$links[1] = "<a href='$url_perfil_usuario&$variavel_campo[2]=22'>$conteudo</a>";
$links[2] = "<a href='$url_perfil_usuario'>$conteudo</a>";
switch($tipo_acao){
    case 9: 	
		if($usuario_dono_perfil == true){
				$link_acao = $links[0];
	}else{
				$link_acao = $links[2];
	};
	break;
	case 22: 	
		if($usuario_dono_perfil == true){
				$link_acao = $links[1];
	}else{
				$link_acao = $links[0];	
	};
	break;
};
return $link_acao;
};
function retorna_palavra_chave_existe_string($conteudo, $palavra_chave){
$conteudo = trim(converte_minusculo($conteudo));
$palavra_chave = trim(converte_minusculo($palavra_chave));
if($conteudo == null or $palavra_chave == null){
		return false;
};
if($conteudo == $palavra_chave){
        return true;
};
$palavra_1 = " ".$palavra_chave;
$palavra_2 = $palavra_chave." ";
if(strpos($conteudo, $palavra_1) !== false or strpos($conteudo, $palavra_2) !== false){
        return true;
}else{
		return false;
};	
};
function retorna_permalink(){
return retorne_campo_formulario_request(29);
};
function retorne_array_pastas($endereco_pasta, $modo){
$pasta_analisar = scandir($endereco_pasta);
$array_retorno = array();
foreach($pasta_analisar as $pasta){
		if($pasta != null and $pasta != ".." and $pasta != "."){
				$endereco_completo = $endereco_pasta.$pasta;
				if(is_dir($endereco_completo) == true){
						if($modo == true){
								$array_retorno[] = $endereco_completo;
			}else{
								$array_retorno[] = $pasta;
			};
		};
	};
};
return $array_retorno;
};
function retorne_contador_iteracao(){
$_SESSION[SESSAO_CONTADOR_ITERACAO]++;
return $_SESSION[SESSAO_CONTADOR_ITERACAO];
};
function retorne_dados_chave($chave, $tabela){
if($chave == null or $tabela == null){
		return null;
};
$query = "select *from $tabela where chave='$chave';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_dados_id($id, $tabela){
if($id == null or $tabela == null){
		return null;
};
$query = "select *from $tabela where id='$id';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_data_atual_conexao(){
return date('Y/m/d H:i:s');
};
function retorne_data_dia_mes_ano(){
return date("d-m-Y");
};
function retorne_elemento_array_existe($array_pesquisa, $valor_pesquisa){
if($array_pesquisa == null or $valor_pesquisa == null or is_array($array_pesquisa) == false or count($array_pesquisa) == 0){
        return false;
};
foreach($array_pesquisa as $valor_array){
        if($valor_array == $valor_pesquisa){
				return true;
    };
};
return false;
};
function retorne_extensao_string($conteudo){
return substr($conteudo, strlen($conteudo) - 4, strlen($conteudo));
};
function retorne_idcampo_md5(){
$idcampo = codifica_md5(data_atual().retorne_contador_iteracao());
return LOGOTIPO_INICIO_MD5.$idcampo;
};
function retorne_id_existe($id, $tabela){
$query = "select *from $tabela where id='$id';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return false;
}else{
		return true;
};
};
function retorne_imagem_sistema($numero_imagem, $url_link, $modo_url){
global $extensao_arquivo;
global $idioma_sistema;
global $pasta_host_sistema;
global $semana_idioma;
$pasta_imagens = $pasta_host_sistema["imagens_sistema"];
$extensao_padrao = $extensao_arquivo["png"];
switch($numero_imagem){
    case 0:
	$url_link = PAGINA_INICIAL;
	break;
	case 1:
	$titulo_imagem = $idioma_sistema[20];
	break;
	case 2:
	$titulo_imagem = $idioma_sistema[13];
	break;
	case 3:
	$titulo_imagem = $idioma_sistema[29];
	break;
	case 4:
	$titulo_imagem = $idioma_sistema[30];
	break;
	case 9:
	$titulo_imagem = $idioma_sistema[95];
	break;
	case 10:
	$titulo_imagem = $idioma_sistema[96];
	break;
	case 11:
	$titulo_imagem = $idioma_sistema[98];
	break;
	case 12:
	$titulo_imagem = $idioma_sistema[151];
	break;
	case 13:
	$titulo_imagem = $idioma_sistema[157];
	break;
	case 14:
	$titulo_imagem = $idioma_sistema[203];
	break;
	case 15:
	$titulo_imagem = $idioma_sistema[206];
	break;
	case 16:
	$titulo_imagem = $idioma_sistema[210];
	$extensao_padrao = $extensao_arquivo["gif"];
	break;
	case 17:
	$titulo_imagem = $idioma_sistema[227];
	break;
	case 18:
	$titulo_imagem = $idioma_sistema[232];
	break;
	case 19:
	$titulo_imagem = $idioma_sistema[233];
	break;
	case 20:
	$titulo_imagem = $idioma_sistema[14];
	break;
	case 21:
	$titulo_imagem = $idioma_sistema[247];
	break;
	case 22:
	$titulo_imagem = $idioma_sistema[247];
	break;
	case 23:
	$titulo_imagem = $idioma_sistema[278];
	break;
	case 24:
	$titulo_imagem = $idioma_sistema[98];
	break;
	case 25:
	$titulo_imagem = $idioma_sistema[78];
	break;
	case 26:
	$titulo_imagem = $idioma_sistema[279];
	break;
	case 27:
	$titulo_imagem = $idioma_sistema[229];
	break;
	case 28:
	$titulo_imagem = $idioma_sistema[180];
	break;
	case 29:
	$titulo_imagem = $idioma_sistema[109];
	break;
	case 30:
	$titulo_imagem = $idioma_sistema[293];
	break;
	case 31:
	$titulo_imagem = $idioma_sistema[296];
	break;
	case 32:
	$titulo_imagem = $idioma_sistema[333];
	break;	
	case 33:
	$titulo_imagem = $idioma_sistema[340];
	break;	
	case 34:
	$titulo_imagem = $idioma_sistema[352];
	break;
	case 35:
	$titulo_imagem = $idioma_sistema[362];
	break;
	case 36:
	$titulo_imagem = $idioma_sistema[29];
	break;	
	case 37:
	$titulo_imagem = $idioma_sistema[373];
	break;
	case 38:
	$titulo_imagem = $idioma_sistema[374];
	break;
	case 41:
	$titulo_imagem = $idioma_sistema[218];	
	break;
	case 42:
	$titulo_imagem = $idioma_sistema[394];	
	break;
	case 43:
	$titulo_imagem = $idioma_sistema[404];	
	break;	
	case 44:
	$titulo_imagem = $idioma_sistema[411];
	break;
	case 45:
	$titulo_imagem = $idioma_sistema[419];
	break;
	case 46:
	$titulo_imagem = $idioma_sistema[165];
	break;
	case 47:
	$titulo_imagem = $idioma_sistema[423];
	break;
    case 48:
	$url_link = PAGINA_INICIAL;
	break;
	case 49:
	$titulo_imagem = $idioma_sistema[78];
	break;
	case 50:
	$titulo_imagem = $idioma_sistema[19];
	break;
	case 53:
	$titulo_imagem = $idioma_sistema[93];
	break;
	case 54:
	$titulo_imagem = $idioma_sistema[473];
	break;
	case 55:
	$titulo_imagem = $idioma_sistema[167];
	break;
	case 56:
	$titulo_imagem = $idioma_sistema[475];
	break;
	case 57:
	$titulo_imagem = $idioma_sistema[94];
	break;
	case 58:
	$titulo_imagem = $idioma_sistema[474];
	break;
	case 59:
	$titulo_imagem = $idioma_sistema[103];
	break;
	case 61:
	$titulo_imagem = $idioma_sistema[480];
	break;
	case 62:
	$titulo_imagem = $idioma_sistema[481];
	break;
	case 63:
	$titulo_imagem = $idioma_sistema[479];
	break;
	case 64:
	$titulo_imagem = $idioma_sistema[362];
	break;
	case 65:
	$titulo_imagem = $idioma_sistema[374];
	break;
	case 66:
	$titulo_imagem = $idioma_sistema[66];
	break;
	case 74:
	$titulo_imagem = $idioma_sistema[66];
	break;
	case 75:
	$titulo_imagem = $idioma_sistema[315];
	break;	
	case 77:
	$titulo_imagem = $idioma_sistema[220];
	break;
    case 78:
	$url_link = PAGINA_INICIAL;
	break;
	case 79:
	$titulo_imagem = $idioma_sistema[16];
	break;
	case 80:
	$titulo_imagem = $idioma_sistema[14];
	break;
	case 82:
	$titulo_imagem = $idioma_sistema[212];
	break;
	case 83:
	$titulo_imagem = $idioma_sistema[515];
	break;
	case 84:
	$titulo_imagem = $idioma_sistema[514];
	break;
	case 86:
	$titulo_imagem = $idioma_sistema[20];
	break;
	case 87:
	$titulo_imagem = $idioma_sistema[220];
	break;
	case 88:
	$titulo_imagem = $idioma_sistema[278];
	break;
	case 89:
	$titulo_imagem = $idioma_sistema[337];
	break;	
	case 90:
	$titulo_imagem = $idioma_sistema[78];
	break;
	case 94:
	$titulo_imagem = $idioma_sistema[510];
	break;
	case 95:
	$titulo_imagem = $idioma_sistema[29];
	break;
	case 96:
	$titulo_imagem = $idioma_sistema[321];
	break;
	case 97:
	$titulo_imagem = $idioma_sistema[310];
	break;
	case 98:
	$titulo_imagem = $idioma_sistema[14];
	break;
	case 100:
	$titulo_imagem = $idioma_sistema[539];
	break;
	case 101:
	$titulo_imagem = $idioma_sistema[562];	
	break;
    case 103:
	$url_link = PAGINA_INICIAL;
	break;
	case 106:
	$titulo_imagem = $idioma_sistema[215];
	break;
	case 107:
	$titulo_imagem = $idioma_sistema[232];
	break;
	case 108:
	$titulo_imagem = $idioma_sistema[583];
	break;
	case 109:
	$titulo_imagem = $idioma_sistema[587];
	break;
	case 111:
	$titulo_imagem = $idioma_sistema[479];
	break;
	case 116:
	$titulo_imagem = $idioma_sistema[599];
	break;
	case 117:
	$titulo_imagem = $idioma_sistema[203];
	break;
	case 118:
	$titulo_imagem = $idioma_sistema[505];
	break;
	case 119:
	$titulo_imagem = $idioma_sistema[511]; 	
	break;
	case 120:
	$titulo_imagem = $idioma_sistema[579];
	break;
	case 121:
	$titulo_imagem = $idioma_sistema[580];
	break;
	case 123:
	$titulo_imagem = $idioma_sistema[220];
	break;
	case 126:
	$url_link = PAGINA_INICIAL;
	break;
	case 127:
	$titulo_imagem = $idioma_sistema[614];
	break;
	case 128:
	$titulo_imagem = $idioma_sistema[615];
	break;
	case 129:
	$extensao_padrao = $extensao_arquivo["jpg"];
	break;
	case 130:
	$extensao_padrao = $extensao_arquivo["jpg"];
	break;
	case 131:
	$titulo_imagem = $idioma_sistema[613];
	break;
	case 132:
	$titulo_imagem = $idioma_sistema[496];
	break;
	case 133:
	$titulo_imagem = $idioma_sistema[497];
	break;
	case 134:
	$titulo_imagem = $idioma_sistema[616];
	break;
};
$url_imagem = $pasta_imagens.$numero_imagem.$extensao_padrao;
if($modo_url != null){
		return $url_imagem;
};
if($url_link != null){
		$html = "<a href='$url_link' title='$titulo_imagem'><img src='$url_imagem' title='$titulo_imagem' alt='$titulo_imagem'></a>";
}else{
		$html = "<img src='$url_imagem' title='$titulo_imagem' alt='$titulo_imagem'>";
};
$html = "
<div class='classe_div_imagem_sistema_geral'>
$html
</div>
";
return $html;
};
function retorne_modo_permalink(){
return retorne_campo_formulario_request(29) != null;
};
function retorne_numero_array_post_imagens(){
$contador = 0;
if(count($_FILES['fotos']) == 0){
	    return null;
};
foreach($_FILES['fotos']['tmp_name'] as $nome){
        if($nome != null){
        $contador++;
    };
};
return $contador;
};
function retorne_numero_dia_semana(){
switch(date("D")){
	case "Sun":
	return 1;
	break;
    case "Mon":
	return 2;
	break;
    case "Tue":
	return 3;
	break;
    case "Wed":
	return 4;
	break;
    case "Thu":
	return 5;
	break;
    case "Fri":
	return 6;
	break;
    case "Sat":
	return 7;
	break;
};
};
function retorne_numero_parametros_requeste(){
$geturl = explode('/', $_SERVER['REQUEST_URI']);
$contador = 0;
foreach($geturl as $url){
		if($url != null){
				$contador++;
	};
};
return $contador;
};
function retorne_tamanho_resultado($numero_resultados){
$tamanho_mil = 1000;
$tamanho_milhao = 1000000;
$tamanho_bilhao = 1000000000;
if($numero_resultados == null){
        $numero_resultados = 0;
};
if($numero_resultados == 0){
        return 0;
};
$retorno = $numero_resultados;
if($numero_resultados >= $tamanho_mil){
        $retorno = round($numero_resultados / $tamanho_mil, 2)."k";
};
if($numero_resultados >= $tamanho_milhao){
        $retorno = round($numero_resultados / $tamanho_milhao, 2)."mi";
};
if($numero_resultados >= $tamanho_bilhao){
        $retorno = round($numero_resultados / $tamanho_bilhao, 2)."bi";
};
return $retorno;
};
function retorne_texto_contem_html($texto){
return $texto != strip_tags($texto);
};
function retorne_titulo_pagina(){
global $idioma_sistema;
$numero_parametros_requeste = retorne_numero_parametros_requeste();
$usuario_logado = retorne_usuario_logado();
if($numero_parametros_requeste == 0 and $usuario_logado == false){
		return $idioma_sistema[534];
};
if(retorne_modo_pagina() == false){
		if($usuario_logado == true){
				$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());
	}else{
				$nome_usuario = null;
	};
}else{
		$dados = retorne_dados_perfil_pagina(retorne_idpagina_request());
		$nome_usuario = $dados[TITULO_DA_PAGINA];
};
if($nome_usuario != null){
        $titulo = $nome_usuario;
}else{
	    $titulo = NOME_SISTEMA;	
};
return $titulo;
};
function trata_html_requeste($conteudo){
$conteudo = trim($conteudo);
$conteudo = addslashes($conteudo);
$conteudo = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $conteudo);
$conteudo = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $conteudo);
$conteudo = preg_replace("/<\/?div[^>]*\>/i", "", $conteudo); 
$conteudo = preg_replace("/<\/?span[^>]*\>/i", "", $conteudo);
$conteudo = preg_replace("/<\/?br[^>]*\>/i", "", $conteudo); 
$conteudo = htmlentities($conteudo);
return $conteudo;
};
function atualiza_numero_hashtag(){
$hashtag = retorne_hashtag_requeste();
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_hashtags($hashtag));
return json_encode($array_retorno);
};
function carregar_hashtags(){
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;
$hashtag = retorne_hashtag_requeste();
if($hashtag == null){
		return null;
};
$tabela = $tabela_banco[5];
$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;
$limit = $contador_avanco;
$limit = "limit $limit, ".NUMERO_VALOR_PAGINACAO;
$query = "select *from $tabela where texto like '%$codigos_especiais[11]$hashtag%' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$dados[0] = $dados;
		if($dados["id"] != null){
				$html .= constroe_publicacao($dados);
	};
};
if($contador_avanco == 0){
		$idcampo[0] = codifica_md5("id_numero_campo_hashtag_".$hashtag.data_atual().retorne_contador_iteracao());
		$numero_hashtags = retorne_tamanho_resultado(retorne_numero_hashtags($hashtag));
		$funcao[0] = "
	atualiza_numero_hashtag(\"$idcampo[0]\", \"$hashtag\");
	";
		$campo[0] = "
	<div class='classe_numero_hashtags classe_cor_5'>
	<div class='classe_numero_hashtags_separa classe_cor_5'>$codigos_especiais[11]$hashtag</div>
	<div class='classe_numero_hashtags_separa classe_cor_5' id='$idcampo[0]'>$numero_hashtags</div>
	</div>	
	";
		$campo[0] .= plugin_timer_sistema(2, $funcao[0]);
		$campo[0] = constroe_caixa(false, $campo[0]);
		$html = "
	$campo[0]
	$html
	";
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function converte_conteudo_hashtag($conteudo){
global $codigos_especiais;
global $variavel_campo;
$url = PAGINA_INICIAL."?$variavel_campo[2]=74&$variavel_campo[40]";
$codigo = $codigos_especiais[11];
$conteudo = preg_replace("$codigo@(\w+)$codigo", "<a href=\"$url=$1\">$0</a>", $conteudo);
$conteudo = preg_replace("/$codigo(\w+)/", "<a href=\"$url=$1\">$0</a>", $conteudo);
return $conteudo;
};
function retorne_hashtag_requeste(){
return retorne_campo_formulario_request(40);
};
function retorne_modo_hashtag(){
return retorne_hashtag_requeste() != null;
};
function retorne_numero_hashtags($hashtag){
global $tabela_banco;
global $codigos_especiais;
$tabela = $tabela_banco[5];
$query = "select *from $tabela where texto like '%$codigos_especiais[11]$hashtag%';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function alterar_idioma(){
global $tabela_banco;
$usuario_logado = retorne_usuario_logado();
if(retorna_chave_request() == null and $usuario_logado == true){
		return null;
};
$tabela = $tabela_banco[34];
$modo = retorne_campo_formulario_request(6);
if($modo == null){
		return null;
};
if($usuario_logado == true){
		$uid = retorne_idusuario_logado();
		$query[0] = "select *from $tabela where uid='$uid';";
	$query[1] = "insert into $tabela values(null, '$uid', '$modo');";
	$query[2] = "update $tabela set modo='$modo' where uid='$uid';";
		$dados_query = plugin_executa_query($query[0]);
		if($dados_query["linhas"] == 0){
				plugin_executa_query($query[1]);
	}else{
				plugin_executa_query($query[2]);
	};
};
$_SESSION[SESSAO_IDIOMA] = $modo;
};
function aplica_idioma_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[34];
$dados_perfil_logado = retorne_dados_sessao_usuario_logado();
$dados_perfil_logado = $dados_perfil_logado[$tabela];
$modo = $dados_perfil_logado[MODO];
if($modo == null){
		$modo = 0;
};
$_SESSION[SESSAO_IDIOMA] = $modo;
};
function constroe_alterar_idioma(){
$classe[0] = "classe_opcao_idioma";
$classe[1] = "classe_campo_altera_idioma_conteudo";
$classe[2] = "classe_campo_altera_idioma";
$texto[0] = retorne_imagem_sistema(132, null, false);
$texto[1] = retorne_imagem_sistema(133, null, false);
$eventos[0] = "alterar_idioma(0);";
$eventos[1] = "alterar_idioma(1);";
$evento[0] = "onclick='$eventos[0]'";
$evento[1] = "onclick='$eventos[1]'";
$opcao[0] = "
<div class='$classe[0]' $evento[0]>
	<span class='span_link'>$texto[0]</span>
</div>
";
$opcao[1] = "
<div class='$classe[0]' $evento[1]>
	<span class='span_link'>$texto[1]</span>
</div>
";
$campo[0] = "
<div class='$classe[1]'>
	$opcao[0]
	$opcao[1]
</div>
";
$html = "
<div class='$classe[2]'>
	$campo[0]
</div>
";
return $html;
};
function constroe_campo_info_link($modo, $uid){
global $idioma_sistema;
$idcampo[0] = codifica_md5("id_menu_suspense_campo_info_link_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_informacoes_campo_info_link_".retorne_contador_iteracao());
$nome_funcao[0] = "a_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[1] = "b_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[2] = "c_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[3] = "d_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_variavel[0] = "d_".codifica_md5("nome_variavel_".retorne_contador_iteracao());
$nome_variavel[1] = "e_".codifica_md5("nome_variavel_".retorne_contador_iteracao());
$funcao[0] = "exibe_info_link(\"$modo\", \"$uid\", \"$idcampo[0]\", \"$idcampo[1]\", $nome_variavel[1])";
$funcao[1] = "fechar_menu_suspense(\"$idcampo[0]\");";
$funcao[2] = "$nome_funcao[0](this, 0)";
$funcao[3] = "$nome_funcao[0](this, 1)";
$evento[0] = "onmousemove='$funcao[2]'";
$evento[1] = "onmouseout='$funcao[3]'";
$campo[0] = "
<div class='classe_informacoes_info_link' id='$idcampo[1]'>
$idioma_sistema[210]
</div>
";
$tempo = TEMPO_TIMER_INFO_LINK;
$html .= constroe_dialogo_acao($idioma_sistema[403], $campo[0], $idcampo[0]);
$html .= $timer[0];
$html .= "
<script language='javascript'>
var $nome_variavel[0] = null;
var $nome_variavel[1] = null;
function $nome_funcao[1](){
$funcao[0]
};
function $nome_funcao[2](element){
$nome_variavel[1] = element;
};
function $nome_funcao[3](){
$funcao[1]	
};
function $nome_funcao[0](element, modo){
switch(modo){
	case 0:
	clearTimeout($nome_variavel[0]);
	$nome_funcao[2](element);
	$nome_variavel[0] = setTimeout($nome_funcao[1], $tempo);
	break;
	case 1:
	clearTimeout($nome_variavel[0]);
	$nome_funcao[2](element);
	$nome_variavel[0] = setTimeout($nome_funcao[3], $tempo);
	break;
};
};
</script>
";
$array_retorno[0] = $evento[0]." ".$evento[1];
$array_retorno[1] = $html;
return $array_retorno;
};
function exibe_info_link(){
$uid = retorne_idusuario_request();
$modo = retorne_campo_formulario_request(6);
switch($modo){
	case 0:
	$conteudo .= constroe_imagem_perfil_miniatura(false, true, $uid);
	break;
};
$array_retorno["dados"] = $conteudo;
return json_encode($array_retorno);
};
function campo_limpar_perfil(){
global $idioma_sistema;
$idcampo[0] = codifica_md5("campo_select_limpar_perfil_".data_atual());
$eventos[0] = "onclick='limpar_perfil();'";
$eventos[1] = "alterar_modo_limpar_perfil(\"$idcampo[0]\")";
$array_options = "
$idioma_sistema[144],
$idioma_sistema[145],
$idioma_sistema[146],
$idioma_sistema[147],
$idioma_sistema[148],
$idioma_sistema[149],
$idioma_sistema[226],
$idioma_sistema[289],
$idioma_sistema[564]
";
$array_valores = "1,2,3,4,5,6,7,8,9";
$campo_opcoes = gerador_select_option_especial($array_options, $array_valores, null, null, $idcampo[0], $eventos[1]);
$nome_usuario = retorne_nome_usuario_logado();
$imagem_sistema[0] = retorne_imagem_sistema(12, null, false);
$descricao = mensagem_sucesso($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[150]);
$html = "
<div class='classe_campo_limpar_perfil'>
<div class='classe_campo_limpar_perfil_descricao'>
$descricao
</div>
<div class='classe_campo_limpar_perfil_opcoes'>
$campo_opcoes
</div>
<div class='classe_campo_limpar_perfil_campo_acao'>
<input type='button' value='$idioma_sistema[143]' $eventos[0]>
</div>
</div>
";
return $html;
};
function limpar_perfil(){
switch(retorne_campo_formulario_request(18)){
    case 1:
	limpar_visitas_perfil();
	break;
	case 2:
	limpar_comentarios();
	break;
	case 3:
	limpar_curtidas();
	break;
	case 4:
	limpar_solicitacoes_amizade(1);
	break;
	case 5:
	limpar_solicitacoes_amizade(2);
	break;
	case 6:
	limpar_feeds();
	break;
	case 7:
	excluir_todas_mensagens();
	break;
	case 8:
	limpar_notificacoes();
	seta_todas_mensagens_visualizadas();
	break;
	case 9:
	limpar_solicitacoes_relacionamentos();
	break;
};
$dados_retorno["dados"] = null;
return json_encode($dados_retorno);
};
function constroe_campo_exibir_mapa_bing($modo){
$script[0] = "
<script>
obtem_geolocalizacao();
</script>
";
$html = "
$script[0]
";
$array_geolocalizacao = retorna_geolocalizacao();
$latitude = $array_geolocalizacao["latitude"];
$longitude = $array_geolocalizacao["longitude"];
$mapa_bing[0] = constroe_mapa_bing($latitude, $longitude, $modo);
$html .= "
$mapa_bing[0]
";
return $html;
};
function constroe_mapa_bing($latitude, $longitude, $modo){
global $idioma_sistema;
if($modo == true){
		$html = "
	<div class='classe_mapa_bing'>
	<iframe frameborder=\"0\" src=\"https://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=$latitude~$longitude&amp;lvl=11&amp;w=500&amp;h=400&amp;sty=r&amp;typ=d&amp;pp=&amp;ps=&amp;dir=0&amp;mkt=pt-br&amp;src=SHELL&amp;form=BMEMJS\" scrolling='no'></iframe>
	</div>
	";
}else{
		$html = "
	<div class='classe_mapa_bing'>
	<iframe frameborder=\"0\" src=\"https://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=$latitude~$longitude&amp;lvl=11&amp;w=500&amp;h=400&amp;sty=r&amp;typ=s&amp;pp=&amp;ps=55&amp;dir=0&amp;mkt=pt-br&amp;src=SHELL&amp;form=BMEMJS\" scrolling='no'></iframe>
	</div>
	";
};
if($latitude == null or $longitude == null){
		$mensagem[0] = mensagem_erro($idioma_sistema[582]);
		$html = "
	<div class='classe_mapa_bing'>
	$mensagem[0]
	</div>
	";
};
return $html;
};
function constroe_mapa($cidade, $estado){
$url_endereco_servidor_mapa = "https://www.google.com.br/maps?q=$cidade,+$estado&output=embed";
$html = "
<div class='classe_div_mapa classe_cor_29'>
<iframe src='$url_endereco_servidor_mapa'></iframe>
</div>
";
return $html;
};
function retorna_geolocalizacao(){
return $_SESSION[SESSAO_MAPA_BING];
};
function salva_geolocalizacao(){
$_SESSION[SESSAO_MAPA_BING]["latitude"] = retorne_campo_formulario_request(56);
$_SESSION[SESSAO_MAPA_BING]["longitude"] = retorne_campo_formulario_request(57);
};
function constroe_campo_marcador_usuario($uidamigo, $chave, $modo, $modo_pesquisa){
global $idioma_sistema;
$idcampo[0] = codifica_md5("idcampo_marcador_usuario_$uidamigo");
if($modo == true){
	    $modo_marcar = 2;
		$classe[0] = "elemento_visivel_table";
	$classe[1] = "span_link_3";
    	$texto_botao[0] = $idioma_sistema[208];
}else{
	    $modo_marcar = 1;
		$classe[0] = "elemento_oculto";
	$classe[1] = "span_link";
		$texto_botao[0] = $idioma_sistema[205];
};
$evento[0] = "onclick='marcar_usuario(\"$uidamigo\", \"$chave\", \"$modo_marcar\", \"$idcampo[0]\");'";
$html = "
<div class='classe_campo_marcar_usuario_adicionar_botao'>
<span class='$classe[1]' $evento[0]>
$texto_botao[0]
</span>
</div>
";
if($modo_pesquisa == true){
        $html = "
    <div class='classe_campo_marcar_usuario_adicionar' id='$idcampo[0]'>
    $html
    </div>
    ";
};
return $html;
};
function constroe_campo_marcar($idcampo_entrada, $chave, $id, $tabela){
global $idioma_sistema;
$idcampo[0] = $idcampo_entrada;
$idcampo[1] = codifica_md5("idcampo_exibe_resultados_campo_marcar".data_atual().$idcampo_entrada);
$idcampo[2] = codifica_md5("idcampo_entrada_pesquisa_campo_marcar".data_atual().$idcampo_entrada);
$idcampo[3] = codifica_md5("id_campo_balao_notifica_marcador_".data_atual().$idcampo_entrada);
$id_dialogo[0] = codifica_md5("id_menu_suspense_marcador_$idcampo[0]".data_atual().$idcampo_entrada);
$funcao[0] = "pesquisar_marcador(\"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\", \"$chave\", \"$id\", \"$tabela\");";
$eventos[0] = "onclick='exibe_dialogo(\"$id_dialogo[0]\");'";
$eventos[1] = "onkeyup='$funcao[0]'";
$eventos[2] = "onclick='marcacoes_concluidas(\"$chave\", \"$id_dialogo[0]\", 1);'";
$eventos[3] = "onclick='marcacoes_concluidas(\"$chave\", \"$id_dialogo[0]\", 2);'";
$eventos[4] = "onclick='exibir_amigos_marcados(\"$chave\", \"$idcampo[1]\");'";
$eventos[5] = "onscroll='$funcao[0]'";
$imagem[0] = retorne_imagem_sistema(82, null, false);
$html = "
<div class='classe_campo_marcar_entrada'>
<input type='text' placeholder='$idioma_sistema[204]' id='$idcampo[2]' $eventos[1]>
</div>
<div class='classe_campo_marcar_resultados' id='$idcampo[1]' $eventos[5]></div>
<div class='classe_campo_marcar_entrada_salvar'>
<span class='span_link' $eventos[2]>$idioma_sistema[207]</span>
<span class='span_link' $eventos[3]>$idioma_sistema[209]</span>
<span class='span_link' $eventos[4]>$idioma_sistema[211]</span>
</div>
";
$html = constroe_dialogo($idioma_sistema[203], $html, $id_dialogo[0]);
$balao_notifica[0] = constroe_balao_notifica($idcampo[3], null);
$html = "
<div class='classe_campo_marcar_abre_dialogo' $eventos[0]>
	$imagem[0]
</div>
<div class='classe_campo_marcar_balao_notifica'>
	$balao_notifica[0]
</div>
$html
";
return $html;
};
function constroe_marcacoes_usuarios($idpost, $tabela_referencia){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[14];
$query = "select *from $tabela where idpost='$idpost' and tabela_referencia='$tabela_referencia';";
$contador = 0;
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
if($numero_linhas == 0){
		return null;
};
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$nome_link = retorne_nome_link_usuario(true, $uidamigo);
				$lista_marcados .= "
		<div class='classe_usuario_marcado'>
		$nome_link
		</div>	
		";
	};
};
$html = "
<div class='classe_div_usuarios_marcados'>
<div class='classe_div_usuarios_marcados_titulo'>
$idioma_sistema[291]
</div>
$lista_marcados
</div>
";
return $html;
};
function constroe_uidamigo_marcado($uidamigo, $chave){
$perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
$campo_marcador = constroe_campo_marcador_usuario($uidamigo, $chave, sessao_marcador_usuario_seta_retorna(null, null, $chave, $uidamigo, 3), true);
$html = "
<div class='classe_campo_marcar_usuario classe_cor_8'>
<div class='classe_campo_marcar_usuario_perfil'>
$perfil_usuario
</div>
$campo_marcador
</div>
";
return $html;
};
function erradicar_marcacoes_usuarios($id){
global $tabela_banco;
$tabela = $tabela_banco[14];
$idusuario = retorne_idusuario_logado();
$chave = retorna_chave_request();
$data = data_atual();
$array_usuarios = sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 5);
if(is_array($array_usuarios) == false){
        return null;
};
foreach($array_usuarios as $uidamigo){
	    if($uidamigo != null){
    	if($id == null){
				$idpost = $_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0]; 
	}else{
				$idpost = $id;
	};
		$tabela_referencia = $_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1];
		$query = "insert into $tabela values(null, '$chave', '$tabela_referencia', '$idusuario', '$uidamigo', '0', '$idpost', '$data');";
			if(retorne_usuario_amigo($uidamigo) == true){
			    plugin_executa_query($query);
				adicionar_notifica($idpost, $uidamigo, $tabela, $tabela_referencia, $idpost);
	};
	};
};
sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 6);
};
function exibir_amigos_marcados(){
$chave = retorna_chave_request();
$array_amigos_marcados = sessao_marcador_usuario_seta_retorna(null, null, retorna_chave_request(), null, 5);
if(is_array($array_amigos_marcados) == false){
	    $array_retorno["dados"] = null;
        return json_encode($array_retorno);
};
foreach($array_amigos_marcados as $uidamigo){
		if($uidamigo != null){
				$array_retorno["dados"] .= constroe_uidamigo_marcado($uidamigo, $chave);
	};
};
return json_encode($array_retorno);
};
function marcacoes_concluidas(){
$chave = retorna_chave_request();
switch(retorne_campo_formulario_request(6)){
	case 2:
	sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 6);
	break;
};
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_usuarios_marcados($chave));
return json_encode($array_retorno);
};
function marcar_usuario(){
$id = retorne_campo_formulario_request(4);
$tabela = retorne_campo_formulario_request(10);
$chave = retorne_campo_formulario_request(3);
$uidamigo = retorne_idamigo_request(13);
$modo = retorne_campo_formulario_request(6);
sessao_marcador_usuario_seta_retorna($id, $tabela, $chave, $uidamigo, $modo);
$modo = sessao_marcador_usuario_seta_retorna(null, null, $chave, $uidamigo, 3);
$array_retorno["dados"] = constroe_campo_marcador_usuario($uidamigo, $chave, $modo, false);
return json_encode($array_retorno);
};
function pesquisar_marcador(){
global $tabela_banco;
global $idioma_sistema;
$nome_pesquisa = retorne_campo_formulario_request(7);
$chave = retorne_campo_formulario_request(3);
if($nome_pesquisa == null){
        return null;
};
$tabela[0] = $tabela_banco[6]; $tabela[1] = $tabela_banco[1]; 
$idusuario = retorne_idusuario_logado();
$nome_pesquisa = trim($nome_pesquisa);
$identificador_sessao = SESSAO_TERMO_PESQUISA_MARCADOR.retorna_chave_request();
$identificador_sessao_numero = SESSAO_PESQUISA_MARCADOR_NUMERO_ENCONTROU.retorna_chave_request();
$nome_usuario = retorne_nome_usuario_logado();
if($_SESSION[$identificador_sessao] != $nome_pesquisa){
		$_SESSION[$identificador_sessao] = $nome_pesquisa;
		contador_avanco(retorne_campo_formulario_request(2), 2);
		$_SESSION[$identificador_sessao_numero] = 0;
		$zerou_contador = 1;
}else{
		$zerou_contador = -1;
};
if(contador_avanco(retorne_campo_formulario_request(2), 3) == 0){
		$_SESSION[$identificador_sessao_numero] = 0;	
};
$limit = retorne_limit_query_iniciar(false, null);
if($nome_pesquisa == null){
		$query = "select *from $tabela[0] where uid='$idusuario' and aceito='1' $limit;";
}else{
		$query = "select *from $tabela[0] where (nome like '%$nome_pesquisa%' or sobrenome like '%$nome_pesquisa%') and uid='$idusuario' and aceito='1' $limit;";
};
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
        $uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$html .= constroe_uidamigo_marcado($uidamigo, $chave);
	};
};
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = $zerou_contador;
return json_encode($array_retorno);
};
function remove_marcacao_usuario($id, $tabela){
global $tabela_banco;
$query = "delete from $tabela_banco[14] where tabela_referencia='$tabela' and idpost='$id';";
plugin_executa_query($query);
remove_notifica(null, $id, $tabela, false);
};
function retorne_numero_usuarios_marcados($chave){
return count(sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 5));
};
function sessao_marcador_usuario_seta_retorna($id, $tabela, $chave, $uidamigo, $modo){
switch($modo){
	case 1: 	$_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo] = $uidamigo;
	$_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0] = $id;
	$_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1] = $tabela;
	break;
	case 2: 	unset($_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1]);
	break;
	case 3: 	if($_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo] != null){
				return true;
	}else{
				return false;
	};
	break;
	case 4: 	return $_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo];
	break;
	case 5: 	return $_SESSION[SESSAO_MARCADOR_USUARIO][$chave];
	break;
	case 6: 	unset($_SESSION[SESSAO_MARCADOR_USUARIO][$chave]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave]);
	break;
};
return null;
};
function constroe_amigos_mensageiro($array_idcampos){
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$idcampo[0] = $array_idcampos[0];
$idcampo[1] = $array_idcampos[1];
$idcampo[2] = $array_idcampos[2];
$funcao[0] = "carregar_amigos_mensageiro(\"$idcampo[0]\", \"$idcampo[2]\")";
$eventos[0] = "onkeyup='$funcao[0];'";
$eventos[1] = "onscroll='$funcao[0];'";
$timer[0] = plugin_timer_sistema(9, $funcao[0]);
$script[0] = "
<script>
$funcao[0]
</script>
";
$campo[0] = "
<div class='classe_pesquisa_amigos_mensasgeiro classe_cor_2'>
<input type='text' placeholder='$idioma_sistema[68]' id='$idcampo[2]' $eventos[0]>
</div>
";
if($modo_mobile == true and retorne_uidamigo_aberto_mensageiro() != null){
		$timer[0] = null;
		$script[0] = null;
		$campo[0] = null;
};
$campo[1] = "
<div class='classe_amigos_mensageiro' id='$idcampo[0]' $eventos[1]></div>
";
$html = "
$campo[0]
$campo[1]
$script[0]
$timer[0]
";
return $html;
};
function constroe_conteudo_janela_troca_mensagens_mensageiro(){
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$nome_usuario = retorne_nome_usuario_logado();
$uidamigo = retorne_campo_formulario_request(13);
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = retorne_campo_formulario_request(13);
$_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO] = retorne_campo_formulario_request(13);
$imagem_perfil = constroe_imagem_perfil_miniatura(false, false, $uidamigo);
$idcampo[0] = codifica_md5("id_campo_entrada_envia_mensagem_chat_".data_atual().$uidamigo);
$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_2.$uidamigo;
$idcampo[2] = codifica_md5("id_formulario_upload_imagem_chat_".$uidamigo);
$idcampo[3] = retorne_idcampo_md5();
$eventos[0] = "onkeydown='enviar_mensagem_usuario(event.keyCode, \"$uidamigo\", \"$idcampo[0]\", null, null);'";
$campo_emoticons = constroe_visualizador_emoticons(false, true, true, $idcampo[0]);
$campo_emoticons = "
<div class='classe_novo_chat_usuario_emoticons_mensageiro'>
$campo_emoticons
</div>
";
if($modo_mobile == true){
		$eventos[3] = "onkeypress='$funcao[0]'";
};
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, "$eventos[0] $eventos[3]", $idioma_sistema[231]);
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[2], "fotos[]", 51, true, 1, "");
if($modo_mobile == true){
		$imagem_sistema[0] = retorne_imagem_sistema(94, null, false);
	$imagem_sistema[1] = retorne_imagem_sistema(95, null, false);
		$eventos[1] = "onclick='resetar_amigos_mensageiro();'";
	$eventos[2] = "onclick='exibe_dialogo(\"$idcampo[3]\");'";
	$eventos[3] = "onclick='excluir_mensagem_usuario(null, null, \"$uidamigo\", \"1\"), exibe_elemento_oculto(\"$idcampo[3]\", null);'";
		$texto[0] = $nome_usuario.$idioma_sistema[528];
		$campo_excluir = "
	<div class='classe_texto_caixa_dialogo'>
	$texto[0]
	</div>
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' $eventos[3]>
	</div>
	";
		$campo_excluir = constroe_dialogo($idioma_sistema[268], $campo_excluir, $idcampo[3]);
		$campos[0] = "
	<div class='classe_novo_chat_usuario_mensageiro_acessa_amigos classe_cor_2'>
	<span $eventos[1]>$imagem_sistema[0]</span>
	<span $eventos[2]>$imagem_sistema[1]</span>
	</div>
	$campo_excluir
	";
};
$eventos[4] = "onclick='enviar_mensagem_usuario(13, \"$uidamigo\", \"$idcampo[0]\", null, null);'";
$campo_enviar = "
<div class='classe_campo_enviar_mensagem_mensageiro'>
<span class='botao_padrao' $eventos[4]>$idioma_sistema[439]</span>
</div>
";
$html = "
$campos[0]
<div class='classe_novo_chat_usuario_mensageiro_topo classe_cor_2'>
<div class='classe_novo_chat_usuario_mensageiro_topo_imagem_perfil'>
$imagem_perfil
</div>
</div>
<div class='classe_novo_chat_usuario_mensageiro_entrada_campos'>
<div class='classe_novo_chat_usuario_mensagens_mensageiro' id='$idcampo[1]'></div>
<div class='classe_novo_chat_usuario_entrada_mensageiro classe_cor_10'>
$campo_entrada
</div>
<div class='classe_campo_opcoes_mensagem_mensageiro'>
<div class='classe_novo_chat_usuario_upload_imagem_mensageiro'>
$campo_upload_imagem
</div>
$campo_emoticons
$campo_enviar
</div>
</div>
";
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = null;
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_mensageiro(){
global $idioma_sistema;
if(retorna_chave_request() != null or retorne_usuario_logado() == false){
		return null;
};
$modo_mobile = retorne_modo_mobile();
$uidamigo = $_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO];
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_geral_troca_mensagens_mensageiro();
$idcampo[2] = retorne_idcampo_md5();
$campo[0] = constroe_amigos_mensageiro($idcampo);
$funcao[0] = "carregar_amigos_mensageiro(\"$idcampo[0]\", \"$idcampo[2]\");";
$eventos[0] = "onkeyup='$funcao[0]'";
$campo_atualizador[0] = "
\n
atualizador_chat_usuario();
\n
";
$campo_atualizador[0] = plugin_timer_sistema(3, $campo_atualizador[0]);
if($uidamigo != null and retorne_usuario_amigo($uidamigo) == true){
		$funcao[0] = "constroe_campos_troca_mensagens_mensageiro(\"$uidamigo\", \"$idcampo[1]\");";
		$script[0] = "
	<script>
	$funcao[0]
	</script>
	";
};
$campo[1] = "
<div class='classe_div_mensageiro_mensagens cor_borda_div' id='$idcampo[1]'>
<div class='classe_div_mensageiro_mensagens_temporario classe_cor_7'>
$idioma_sistema[529]
</div>
</div>
";
if($modo_mobile == false){
		$campo[0] = "
	<div class='classe_div_mensageiro_amigos cor_borda_div'>
	$campo[0]
	</div>
	";
}else{
		$campo[0] = "
	<div class='classe_div_mensageiro_amigos cor_borda_div' id='$idcampo[1]'>
	$campo[0]
	</div>
	";
		$campo[1] = null;
};
$html = "
<div class='classe_div_mensageiro cor_borda_div'>
$campo[0]
$campo[1]
</div>
$campo_atualizador[0]
$script[0]
";
return $html;
};
function resetar_amigos_mensageiro(){
if(retorna_chave_request() != null){
		$_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO] = null;
};
};
function retorne_idcampo_geral_troca_mensagens_mensageiro(){
return md5("idcampo_geral_troca_mensagens_mensageiro".retorne_idusuario_logado());
};
function retorne_uidamigo_aberto_mensageiro(){
return $_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO];
};
function campo_envia_mensagem($uid){
global $idioma_sistema;
if($uid == retorne_idusuario_logado() or retorne_usuario_amigo($uid) == false){
		return null;
};
$dialogo_id[0] = codifica_md5("id_dialogo_enviar_mensagem_$uid".data_atual());
$dialogo_id[1] = codifica_md5("id_dialogo_enviou_sucesso_mensagem_$uid".data_atual());
$idcampo[0] = codifica_md5("id_campo_texto_mensagem_enviar_$uid".data_atual());
$funcao[0] = "mover_foco_elemento(\"$idcampo[0]\")";
$eventos[0] = "onclick='exibe_dialogo(\"$dialogo_id[0]\"), $funcao[0];'";
$eventos[1] = "onclick='enviar_mensagem_usuario(\"13\", \"$uid\", \"$idcampo[0]\", \"$dialogo_id[0]\", \"$dialogo_id[1]\");'";
$nome_usuario_logado = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $uid);
$html = "
$nome_usuario_logado$idioma_sistema[217]$nome_amigo$idioma_sistema[163]
";
$campo_dialogo[0] = constroe_dialogo($idioma_sistema[219], $html, $dialogo_id[1]);
$placeholder = "$nome_usuario_logado$idioma_sistema[214]$nome_amigo";
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, null, $placeholder);
$campo_entrada = "
<div class='classe_campo_entrada_envia_mensagem_texto'>
$campo_entrada
</div>
";
$campo_emoticons = constroe_visualizador_emoticons(true, false, true, $idcampo[0]);
$campo_emoticons = "
<div class='classe_seleciona_emoticons_envia_mensagem'>
$campo_emoticons
</div>
";
$html = "
$campo_entrada
$campo_emoticons
<div class='classe_campo_entrada_envia_mensagem_botao'>
<span class='botao_padrao' $eventos[1]>$idioma_sistema[215]</span>
</div>
";
$campo_dialogo[1] = constroe_dialogo_medio($idioma_sistema[216], $html, $dialogo_id[0]);
$imagem[0] = retorne_imagem_sistema(85, null, false);
$html = "
<div class='classe_campo_envia_mensagem'>
<div class='botao_enviar_mensagem botao_padrao' $eventos[0]>
<div class='botao_enviar_mensagem_imagem'>
$imagem[0]
</div>
<div class='botao_enviar_mensagem_texto'>
$idioma_sistema[215]
</div>
</div>
</div>
$campo_dialogo[0]
$campo_dialogo[1]
";
return $html;
};
function campo_gerencia_mensagem($dados, $idcampo_1, $modo){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$mensagem = $dados[MENSAGEM];
$uidenviou = $dados[UIDENVIOU];
$visualizado = $dados[VISUALIZADO];
$respondido = $dados[RESPONDIDO];
$data = $dados[DATA];
$nome_usuario = retorne_nome_usuario_logado();
$id_dialogo[0] = codifica_md5("id_dialogo_excluir_mensagem_$id");
$id_menu[0] = codifica_md5("id_menu_suspense_gerencia_mensagem_$id");
$eventos[0] = "onclick='exibe_dialogo(\"$id_dialogo[0]\");'";
$eventos[1] = "onclick='excluir_mensagem_usuario(\"$id\", \"$idcampo_1\", \"$uidamigo\", \"$modo\");'";
$campo_excluir = "
<div class='classe_separa_opcao_gerencia_mensagem'>
$nome_usuario$idioma_sistema[223]
</div>
<div class='classe_separa_opcao_gerencia_mensagem_botao'>
<input type='button' value='$idioma_sistema[32]' $eventos[1]>
</div>
";
$dialogo[0] = constroe_dialogo($idioma_sistema[222], $campo_excluir, $id_dialogo[0]);
$campo_excluir = "
<span class='classe_opcao_gerencia_mensagem span_link' $eventos[0]>$idioma_sistema[222]</span>
";
$html = "
$campo_excluir
";
$html = constroe_menu_suspense(false, null, false, null, $id_menu[0], $html);
$html = "
<div class='classe_opcoes_mensagem'>$html</div>
$dialogo[0]
";
return $html;
};
function carregar_amigos_enviaram_mensagem(){
global $tabela_banco;
$tabela = $tabela_banco[15];
$idusuario = retorne_idusuario_logado();
if(retorne_campo_formulario_request(20) == 1){
	    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);
		$zerou_contador = 1;	
}else{
        $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);
		$zerou_contador = 0;	
};
$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id desc limit 0,1;";
		        $mensagens .= constroe_mensagem(plugin_executa_query($query), true, true);
				seta_mensagem_visualizada($uidamigo);
	};
};
$array_retorno["dados"] = $mensagens;
$array_retorno["zerou_contador"] = $zerou_contador;
return json_encode($array_retorno);
};
function carregar_mensagens_usuario(){
switch(retorne_campo_formulario_request(6)){
	case 0:
	    return carregar_amigos_enviaram_mensagem();
	break;
	case 1:
		return pesquisar_troca_mensagem(retorne_campo_formulario_request(13));
	break;
};
};
function constroe_campo_paginador_mensagens($idcampo_resultados){
global $idioma_sistema;
$idcampo[0] = retorna_idcampo_progresso_gif_geral();
$eventos[0] = "onclick='paginar_mensagens(\"$idcampo[0]\", \"$idcampo_resultados\");'";
$campo_progresso = campo_progresso_gif($idcampo[0]);
$html = "
$campo_progresso
<div class='classe_paginador_padrao classe_cor_29 span_link' $eventos[0]>
$idioma_sistema[61]
</div>
";
return $html;
};
function constroe_gerenciador_mensagens(){
global $idioma_sistema;
$idcampo[0] = retorna_idcampo_conteudo_geral();
$campo_pesquisa = constroe_pesquisa_mensagem($idcampo[0]);
$campo_paginador = constroe_campo_paginador_mensagens($idcampo[0]);
$html = "
$campo_pesquisa
$campo_paginador
";
return constroe_conteudo_padrao(true, $html, null);
};
function constroe_imagem_perfil_mensagens($uid){
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
$nome_usuario = retorne_nome_usuario(true, $uid);
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_compilados_usuario($uid);
		$dados_perfil = $dados_perfil[$tabela_banco[1]];
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$html = "
<div class='classe_div_imagem_perfil_miniatura'>
<div class='classe_div_imagem_perfil_miniatura_div_img'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</div>
<div class='classe_div_imagem_perfil_miniatura_div_nome classe_cor_5'>
$nome_usuario
</div>
</div>
";
return $html;
};
function constroe_mensagem($dados_query, $modo, $modo_amigo){
global $idioma_sistema;
$contador = 0;
$numero_linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
    $uid = $dados[UID];
    $uidamigo = $dados[UIDAMIGO];
    $mensagem = $dados[MENSAGEM];
    $uidenviou = $dados[UIDENVIOU];
    $visualizado = $dados[VISUALIZADO];
    $respondido = $dados[RESPONDIDO];
    $data = $dados[DATA];
		if($id != null){
	    	    $data = converte_data_amigavel(true, $data);
		        $eventos[0] = "onclick='carregar_mensagens_usuario(null, null, $uidamigo);'";
				$idcampo[0] = codifica_md5("id_campo_mensagem_usuario_$id");
				if($modo_amigo == true){
						$campo_perfil = constroe_imagem_perfil_mensagens($uidamigo);
		}else{
						$campo_perfil = constroe_imagem_perfil_mensagens($uidenviou);
		};
				$campo_gerencia = campo_gerencia_mensagem($dados, $idcampo[0], $modo);
				$mensagem = converter_urls(false, $mensagem);
	    	    $html .= "
	    <div class='classe_mensagem_usuario classe_cor_2 classe_cor_31' id='$idcampo[0]'>
		$campo_gerencia
		<div class='classe_mensagem_usuario_separador' $eventos[0]>
		<div class='classe_mensagem_usuario_perfil'>
		$campo_perfil
		</div>
		<div class='classe_mensagem_usuario_mensagem'>
		$mensagem
		</div>
	    <div class='classe_mensagem_usuario_data classe_cor_7'>
		$data
		</div>
		</div>
		</div>
	    ";
	};
};
return $html;
};
function constroe_pesquisa_mensagem($idcampo_resultados){
global $idioma_sistema;
global $variavel_campo;
$idcampo[0] = codifica_md5("id_campo_entrada_pesquisa_mensagem".data_atual());
$idcampo[1] = $idcampo_resultados;
$evento[0] = "onkeyup='pesquisar_troca_mensagem(\"$idcampo[0]\", \"$idcampo[1]\");'";
$evento[1] = "onclick='pesquisar_troca_mensagem(\"$idcampo[0]\", \"$idcampo[1]\");'";
$campos[0] = constroe_campo_formulario(1, null, $idcampo[0], null, $idioma_sistema[221], $evento[0]);
$campos[1] = constroe_campo_formulario(2, $idioma_sistema[66], null, null, null, $evento[1]);
$numero_mensagens = retorne_numero_mensagens(1, null);
$pagina_inicial = PAGINA_INICIAL;
if($numero_mensagens > 1){
		$numero_mensagens = retorne_tamanho_resultado($numero_mensagens);
		$texto[0] = $numero_mensagens.$idioma_sistema[225];
}else{
		$texto[0] = $numero_mensagens.$idioma_sistema[224];
};
$link[0] = "<a href='$pagina_inicial?$variavel_campo[2]=42' title='$texto[0]'>$texto[0]</a>";
$campo_numero_mensagens = "
<div class='classe_campo_pesquisa_mensagem_numero'>
<div class='classe_campo_pesquisa_mensagem_numero_separa'>
$link[0]
</div>
</div>
";
$html = "
<div class='classe_campo_pesquisa_mensagem'>
<div class='classe_campo_pesquisa_mensagem_campos'>
<div class='classe_campo_pesquisa_mensagem_entrada'>$campos[0]</div>
<div class='classe_campo_pesquisa_mensagem_botao'>$campos[1]</div>
</div>
$campo_numero_mensagens
<div class='classe_campo_pesquisa_mensagem_resultados classe_cor_10' id='$idcampo[1]'></div>
</div>
";
return $html;
};
function enviar_mensagem_usuario($mensagem, $modo, $uid_envia, $chave_imagem){
global $tabela_banco;
$uidamigo = retorne_idusuario_request();
if(retorne_usuario_amigo($uidamigo) == false or retorne_usuario_dono_perfil($uidamigo) == true){
	    return null;
};
$idusuario = retorne_idusuario_logado();
$data = data_atual();
if($mensagem == null){
        $mensagem = trata_html_requeste($_REQUEST[MENSAGEM]);
}else{
		$mensagem = trata_html_requeste($mensagem);
};
if($mensagem == null){
        return null;
};
if($modo == true){
        $query[0] = "insert into $tabela_banco[15] values(null, '$uidamigo', '$idusuario', '$mensagem', '$idusuario', '0', '0', '$chave_imagem', '$data');";
    $query[1] = "insert into $tabela_banco[15] values(null, '$idusuario', '$uidamigo', '$mensagem', '$idusuario', '1', '1', '$chave_imagem', '$data');";
        plugin_executa_query($query[0]);
    plugin_executa_query($query[1]);
}else{
		if(retorne_usuario_dono_perfil($uid_envia) == true){
		        $query[0] = "insert into $tabela_banco[15] values(null, '$idusuario', '$uidamigo', '$mensagem', '$idusuario', '1', '1', '$chave_imagem', '$data');";	
	}else{
	    		$query[0] = "insert into $tabela_banco[15] values(null, '$uidamigo', '$idusuario', '$mensagem', '$idusuario', '0', '0', '$chave_imagem', '$data');";
	};
        plugin_executa_query($query[0]);	
};
$query[2] = "update $tabela_banco[15] set visualizado='1' where uid='$idusuario' and uidamigo='$uidamigo' and visualizado='0';";
plugin_executa_query($query[2]);
};
function excluir_mensagem_usuario(){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
$tabela = $tabela_banco[15];
$idusuario = retorne_idusuario_logado();
$modo = retorne_campo_formulario_request(6);
$uidamigo = retorne_campo_formulario_request(13);
switch($modo){
    case 1: 	    $query[0] = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
    $query[1] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
    break;
    case 2: 	    $query[0] = "select *from $tabela where id='$id' and uid='$idusuario';";
    $query[1] = "delete from $tabela where id='$id' and uid='$idusuario';";
    break;
};
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] >= 1){
        plugin_executa_query($query[1]);	
};
excluir_imagens_chat($uidamigo);
};
function excluir_todas_mensagens(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$tabela[0] = $tabela_banco[15];
$tabela[1] = $tabela_banco[4];
$query[0] = "delete from $tabela[0] where uid='$idusuario';";
$query[1] = "delete from $tabela[1] where uid='$idusuario' and modo_chat='1';";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
excluir_pastas_subpastas(retorne_pasta_usuario($idusuario, 4, true), false);
};
function pesquisar_troca_mensagem($uidamigo){
global $tabela_banco;
$termo_pesquisa = retorne_campo_formulario_request(22);
if(retorne_campo_formulario_request(20) == 1){
	    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);
		$zerou_contador = 1;	
}else{
        $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);
		$zerou_contador = 0;	
};
$tabela = $tabela_banco[15];
$idusuario = retorne_idusuario_logado();
if($termo_pesquisa != null){
		$query = "select *from $tabela where mensagem like '%$termo_pesquisa%' and uid='$idusuario' order by id desc $limit;";
}else{
		if($uidamigo == null){
        	    $query = "select *from $tabela where uid='$idusuario' order by id desc $limit;";
	}else{
        	    $query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id desc $limit;";
	};
};
$array_retorno["dados"] = constroe_mensagem(plugin_executa_query($query), false, false);
$array_retorno["zerou_contador"] = $zerou_contador;
return json_encode($array_retorno);
};
function retorne_numero_mensagens($modo, $uidamigo){
global $tabela_banco;
$tabela = $tabela_banco[15];
$idusuario = retorne_idusuario_logado();
switch($modo){
	case 1:
	$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario';";
	break;
	case 2:
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' and visualizado='0';";
	break;
	case 3:
	$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario' and visualizado='1';";
	break;
	case 4:
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
	break;
	case 5:
	$query = "select *from $tabela where uid='$idusuario' and visualizado='0';";
	break;
};
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function seta_mensagem_visualizada($uidamigo){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$query = "update $tabela_banco[15] set visualizado='1' where uid='$uid' and uidamigo='$uidamigo';";
plugin_executa_query($query);
};
function seta_todas_mensagens_visualizadas(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$query = "update $tabela_banco[15] set visualizado='1' where uid='$uid';";
plugin_executa_query($query);
};
function mensagem_conteudo_indisponivel(){
global $idioma_sistema;
$imagem_sistema[0] = retorne_imagem_sistema(115, false, false);	
if(retorne_usuario_logado() == true){
		$nome_usuario = retorne_nome_usuario_logado();
}else{
		$nome_usuario = $idioma_sistema[415];
};
$mensagem_exibir = $nome_usuario.$idioma_sistema[97];
$url_pagina_inicial = PAGINA_INICIAL;
$html = "
<div class='classe_mensagem_conteudo_indisponivel'>
<div class='classe_mensagem_conteudo_indisponivel_img'>
$imagem_sistema[0]
</div>
<div class='classe_mensagem_conteudo_indisponivel_div'>
$mensagem_exibir
</div>
<div class='classe_mensagem_conteudo_indisponivel_div'>
<a href='$url_pagina_inicial' title='$idioma_sistema[99]'>$idioma_sistema[99]</a>
</div>
</div>
";
return $html;
};
function mensagem_erro($mensagem){
$html = "
<div class='classe_div_mensagem_sistema'>
$mensagem
</div>
";
return $html;
};
function mensagem_informa($mensagem){
$html = "
<div class='classe_div_mensagem_sistema_informa'>
$mensagem
</div>
";
return $html;
};
function mensagem_privacidade_usuario(){
global $idioma_sistema;
$imagem_sistema[0] = retorne_imagem_sistema(46, null, false);
$nome_usuario_logado = retorne_nome_usuario_logado();
$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());
$html = "
<div class='mensagem_privacidade_usuario'>
<div class='mensagem_privacidade_usuario_texto'>
$nome_usuario_logado$idioma_sistema[164]$nome_usuario$idioma_sistema[163]
</div>
<div class='mensagem_privacidade_usuario_imagem'>
$imagem_sistema[0]
</div>
</div>
";
return constroe_caixa(false, $html);
};
function mensagem_sucesso($mensagem){
$sexo_usuario = retorne_sexo_usuario_logado();
if($sexo_usuario == true or $sexo_usuario == null){
		$classe[0] = "classe_div_mensagem_sistema_sucesso";
}else{
		$classe[0] = "classe_div_mensagem_sistema_sucesso_2";
};
$html = "
<div class='$classe[0]'>
$mensagem
</div>
";
return $html;
};
function constroe_menu_suspense($modo_topo, $funcoes_adicionais, $modo, $numero_imagem, $menu_id, $conteudo_menu){
global $idioma_sistema;
if($menu_id == null){
		$menu_id = retorne_idcampo_md5();
};
$modo_mobile = retorne_modo_mobile();
if($modo_mobile == true){
		$imagem_sistema[0] = retorne_imagem_sistema(1, null, false);
}else{
		$imagem_sistema[0] = retorne_imagem_sistema(76, null, false);
};
if($numero_imagem != null){
		$imagem_sistema[0] = retorne_imagem_sistema($numero_imagem, null, false);
};
$imagem_sistema[1] = retorne_imagem_sistema(36, null, false);
if($funcoes_adicionais == null){
		$funcao[0] = "abrir_menu_suspense(\"$modo_topo\", \"$menu_id\", this, \"$modo\");";
}else{
		$funcao[0] = "abrir_menu_suspense(\"$modo_topo\", \"$menu_id\", this, \"$modo\"), $funcoes_adicionais;";
};
$funcao[1] = "exibe_elemento_oculto(\"$menu_id\", null);";
$evento[0] = "onclick='$funcao[0];'";
$evento[1] = "onmouseleave='$funcao[1];'";
if($modo_mobile == false){
		$evento[2] = "onmousemove='$funcao[0]'";
};
if(retorne_modo_mobile() == true){
		$campo[0] = "
	<div class='classe_div_menu_suspense_fechar'>
	<span onclick='fechar_menu_suspense(\"$menu_id\");'>
	$imagem_sistema[1]
	</span>
	</div>
	";
};
$html = "
<div class='classe_menu_suspense_principal'>
<div class='classe_div_abre_menu_suspense' $evento[0] $evento[2]>
$imagem_sistema[0]
</div>
<div class='classe_div_menu_suspense cor_borda_div_4 elemento_efeito cor_borda_div_3' id='$menu_id' $evento[1]>
$campo[0]
<div class='classe_div_menu_suspense_conteudo'>
$conteudo_menu
</div>
</div>
</div>
";
return $html;
};
function define_modo_mobile(){
if(retorna_chave_request() == null){
		return null;
};
if(retorne_modo_mobile() == true){
		$_SESSION[SESSAO_MODO_MOBILE] = false;
}else{
		$_SESSION[SESSAO_MODO_MOBILE] = true;	
};
$array_retorno["dados"] = 1;
return json_encode($array_retorno);
};
function detecta_resolucao(){
$largura = retorne_campo_formulario_request(49);
$idcampo[0] = codifica_md5($largura.SESSAO_RESOLUCAO_DETECTA);
if($_SESSION[SESSAO_RESOLUCAO_DETECTA][$idcampo[0]] != $idcampo[0]){
		$_SESSION[SESSAO_RESOLUCAO_DETECTA][$idcampo[0]] = $idcampo[0];
		$retorno = 1;
}else{
		$retorno = null;
};
if($largura >= TAMANHO_MINIMO_RESOLUCAO_MOBILE){
		$retorno = null;
		$_SESSION[SESSAO_RESOLUCAO_RETORNA] = false;
}else{
		$_SESSION[SESSAO_RESOLUCAO_RETORNA] = true;
		$_SESSION[SESSAO_MODO_MOBILE_ATIVOU] = true;
};
$array_retorno["dados"] = $retorno;
return json_encode($array_retorno);
};
function informa_topo_modo_mobile(){
global $idioma_sistema;
if(retorne_usuario_logado() == false and retorne_modo_mobile() == true){
		$imagem_sistema[0] = retorne_imagem_sistema(109, null, false);
		$html = "
	<div class='classe_informa_modo_mobile_topo classe_cor_11 borda_div_3'>
	<div class='classe_informa_modo_mobile_topo_imagem'>
	$imagem_sistema[0] 
	</div>
	<div class='classe_informa_modo_mobile_topo_imagem_texto classe_cor_15'>
	$idioma_sistema[586]
	</div>
	</div>
	";
};
return $html;
};
function inicializar_campo_detecta_resolucao(){
$funcao[0] = "detecta_resolucao();";
$html = "
<script language='javascript'>$funcao[0]</script>
";
$html .= plugin_timer_sistema(6, $funcao[0]);
return $html;
};
function opcao_mobile_menu_topo(){
global $idioma_sistema;
if($_SESSION[SESSAO_MODO_MOBILE_ATIVOU] == true){
		return null;
};
$funcao[0] = "define_modo_mobile();";
$evento[0] = "onclick='$funcao[0];'";
if(retorne_modo_mobile() == true){
		$texto = $idioma_sistema[489];
}else{
		$texto = $idioma_sistema[488];	
};
$html = "
<div class='classe_div_opcao_menu_suspense' $evento[0]>
<span class='span_link'>$texto</span>
</div>
";
return $html;
};
function retorne_modo_mobile(){
if(SIMULA_MODO_MOBILE == true or $_SESSION[SESSAO_MODO_MOBILE] == true){
		return true;
};
return $_SESSION[SESSAO_RESOLUCAO_RETORNA];
};
function constroe_campos_perfil_usuario_lateral_direito($modo){
if(retorne_usuario_logado() == false){
		return plugin_formulario_login();
};
$campo[0] = constroe_campo_desenvolvedor();
$campo[1] = constroe_links_navegacao_lateral();
if($modo == true){
		$html = "
	<div class='classe_campos_perfil_usuario_lateral_direito_espacado'>
	$campo[1]
	$campo[0]
	</div>
	";	
}else{
		$html = "
	$campo[1]
	$campo[0]
	";
};
return $html;
};
function constroe_conteudo_deslogado(){
global $idioma_sistema;
$tipo_acao = retorne_campo_formulario_request(2);
switch($tipo_acao){
	case 102:
	$conteudo = constroe_recuperar_alterar_senha();
	break;
	case 112:
	$conteudo = formulario_cadastro(false);
	break;
	case 113:
	$conteudo = constroe_campo_recupera_senha(true);
	break;
	default:
	$conteudo = plugin_formulario_login();
};
$campo_idioma = constroe_alterar_idioma();
$conteudo = "
<div class='classe_conteudo_padrao_deslogado cor_borda_div_4'>
	$conteudo
	$campo_idioma
</div>
";
return $conteudo;
};
function constroe_conteudo_padrao($modo, $conteudo, $idcampo){
if($modo == true){
		$classe[0] = "classe_conteudo_centro_padrao";
}else{
		$classe[0] = "classe_conteudo_centro_padrao_2";	
};
$html = "
<div class='$classe[0]' id='$idcampo'>
$conteudo
</div>
";
return $html;
};
function constroe_conteudo_recomendado(){
global $idioma_sistema;
$uid = retorne_idusuario_logado();
if(retorna_configuracao_privacidade(11, $uid) == false){
		$array_titulos[] = retorne_imagem_sistema(119, null, false);
		$array_ids[] = retorne_idcampo_md5();
		$array_conteudos[] = campo_recomendar_noticias();
};
$array_titulos[] = retorne_imagem_sistema(118, null, false);
$array_titulos[] = retorne_imagem_sistema(121, null, false);
$array_titulos[] = retorne_imagem_sistema(120, null, false);
$array_ids[] = retorne_idcampo_md5();
$array_ids[] = retorne_idcampo_md5();
$array_ids[] = retorne_idcampo_md5();
$array_conteudos[] = carrega_recomendacoes_usuarios();
$array_conteudos[] = carrega_recomendacoes_paginas();
$array_conteudos[] = carrega_recomendacoes_musicas(true);
return constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
};
function constroe_conteudo_sub_topo(){
if(retorne_usuario_logado() == false){
		return null;
};
$campo[0] = constroe_campo_mensagem_ativar_usuario();
if($campo[0] == null){
		return null;
};
$html = "
<div class='classe_campo_subtopo classe_cor_23 classe_cor_8'>
$campo[0]
</div>
";
return $html;
};
function constroe_conteudo_topo_meio(){
global $idioma_sistema;
$uid = retorne_idusuario_request();
$idcampo[0] = codifica_md5("id_campo_visualiza_ultima_visualizacao_".retorne_contador_iteracao());
$funcao[0] = "executador_acao(null, 85, \"$idcampo[0]\")";
$timer[0] = plugin_timer_sistema(2, $funcao[0]);
$online = retorne_data_ultima_visualizacao_conexao($uid, false);
$campo[0] = "
<div class='classe_visualizado_pagina_topo_meio classe_cor_7' id='$idcampo[0]'>
$online
</div>
";
if(retorne_usuario_logado() == false){
		$timer[0] = null;
};
$html = "
<div class='classe_conteudo_topo_meio'>
$campo[0]
</div>
$timer[0]
";
return $html;
};
function constroe_topo_pagina(){
$modo_mobile = retorne_modo_mobile();
$usuario_logado = retorne_usuario_logado();
$sexo_usuario = retorne_sexo_usuario_logado();
$campo[0] = constroe_barra_pesquisa_topo();
if($usuario_logado == true){
		if($sexo_usuario == 1){
				$imagem_servidor[0] = retorne_imagem_sistema(48, null, false);
	}else{
				$imagem_servidor[0] = retorne_imagem_sistema(78, null, false);
	};
}else{
		$imagem_servidor[0] = retorne_imagem_sistema(126, null, false);
};
if($modo_mobile == true){
		$imagem_servidor[0] = retorne_imagem_sistema(0, null, false);
};
$campo_menu[0] = constroe_opcoes_menu_topo_usuario();
$campo[1] = constroe_campo_notifica();
$campo[3] = "
<div class='classe_div_logotipo_topo'>
	$imagem_servidor[0]
</div>
";
if($modo_mobile == false){
		$campo_logotipo = $campo[3];
}else{
		if($usuario_logado == true){
				$campo_logotipo = campo_navegacao_perfil_mobile();
	}else{
				$campo_logotipo = $campo[3];	
	};
};
$campo[2] = formulario_login_topo();
$html = "
<div class='classe_conteudo_div_topo_pagina'>
	$campo_logotipo
	$campo[1]
	$campo_menu[0]
	$campo[0]
	$campo[2]
</div>
";
return $html;
};
function eventos_mover_mouse_pagina(){
if(retorne_usuario_logado() == false){
		return null;
};
$evento[0] = "atualiza_modo_deslogar(event);";
$html = "
<script language='javascript'>
$(document).mousemove(function(event){
	$evento[0]
});
</script>
";
return $html;
};
function iniciar_apos_carregamento(){
$campo[0] = inicializar_campo_detecta_resolucao();
$html = "
$campo[0]
";
return $html;
};
function plugins_variaveis_javascript(){
global $variavel_campo;
global $pasta_host_sistema;
$uid = retorne_idusuario_logado();
$modo = retorne_campo_formulario_request(6);
$modo_mobile = retorne_modo_mobile();
$pagina_inicial = PAGINA_INICIAL;
$pagina_acoes = PAGINA_ACOES;
$chave = retorna_seta_chave_publicacao(false);
$idusuario = retorne_idusuario_request();
$tipo_acao = retorne_tipo_acao_pagina();
$idcampo_conteudo = retorna_idcampo_conteudo_geral();
$modo_opcoes_solicitacao_amizade = retorne_campo_formulario_request(14);
$idcampo_progresso_gif_geral = retorna_idcampo_progresso_gif_geral();
$id_janela_chat_mensagens = retorne_id_janela_chat_mensagens();
$tamanho_nova_janela_chat = TAMANHO_NOVA_JANELA_CHAT;
$id_nova_janela_chat = retorne_novo_id_janela_chat_mensagens();
if($modo_mobile == false){
		$numero_maximo_janelas_chat = NUMERO_MAXIMO_JANELAS_CHAT;
}else{
		$numero_maximo_janelas_chat = NUMERO_MAXIMO_JANELAS_CHAT_MOBILE;
};
$prefixo_chat[0] = PREFIXO_CHAT_USUARIO_ONLINE_0;
$prefixo_chat[1] = PREFIXO_CHAT_USUARIO_ONLINE_1;
$prefixo_chat[2] = PREFIXO_CHAT_USUARIO_ONLINE_2;
$prefixo_chat[3] = PREFIXO_CHAT_USUARIO_ONLINE_3;
$prefixo_chat[4] = PREFIXO_CHAT_USUARIO_ONLINE_4;
$prefixo_chat[5] = PREFIXO_CHAT_USUARIO_ONLINE_5;
$prefixo_chat[6] = PREFIXO_CHAT_NOVAS_MENSAGENS;
$prefixo_chat[7] = PREFIXO_CHAT_USUARIO_ONLINE_6;
$pasta_sons_sistema = $pasta_host_sistema["pasta_sons_sistema_host"];
$tamanho_desconto_primeira_janela_chat = TAMANHO_DESCONTO_PRIMEIRA_JANELA_CHAT;
$id_janela_usuarios_abertos_chat = retorne_id_janela_usuarios_abertos_chat(1);
$id_campo_numero_usuarios_abertos_chat = PREFIXO_CHAT_ABERTOS_NUMERO_6;
$id_lista_usuarios_abertos_chat = retorne_id_janela_usuarios_abertos_chat(0);
$pagina = retorne_idpagina_request();
$hashtag = retorne_hashtag_requeste();
$musica = retorne_campo_formulario_request(42);
$video = retorne_campo_formulario_request(44);
$idcampo_previsualiza_musicas = retorne_idcampo_previsualiza_musicas_publicacao();
$idcampo_previsualiza_videos = retorne_idcampo_previsualiza_videos_publicacao();
$token_pagina = gera_token_pagina();
$idcampo[0] = retorne_idcampo_textarea_publicar_postagem();
$id_formulario_cadastro = retorne_id_formulario_cadastro();
$id_janela_principal_chat = retorne_id_janela_principal_chat();
$modo_album = retorne_campo_formulario_request(58);
$titulo_pagina = retorne_titulo_pagina();
$permalink = retorna_permalink();
$campo[0] = "
<script language='javascript'>
var v_marcadores_usuario = [];
var v_usuarios_chat = [];
var v_janelas_chat_id = [];
var v_janelas_chat_posicoes = [];
var v_janelas_chat_uids = [];
var v_array_usuarios_ocultos_chat = [];
var v_array_usuarios_abertos_chat = [];
<!-- separadas -->
var v_variaveis_javascript = [];
v_variaveis_javascript['pcu_0'] = \"$prefixo_chat[0]\";
v_variaveis_javascript['pcu_1'] = \"$prefixo_chat[1]\";
v_variaveis_javascript['pcu_2'] = \"$prefixo_chat[2]\";
v_variaveis_javascript['pcu_3'] = \"$prefixo_chat[3]\";
v_variaveis_javascript['pcu_4'] = \"$prefixo_chat[4]\";
v_variaveis_javascript['pcu_5'] = \"$prefixo_chat[5]\";
v_variaveis_javascript['pcu_6'] = \"$prefixo_chat[6]\";
v_variaveis_javascript['pcu_7'] = \"$prefixo_chat[7]\";
v_variaveis_javascript['pagina_inicial'] = '$pagina_inicial';
v_variaveis_javascript['pagina_acoes'] = '$pagina_acoes';
v_variaveis_javascript['campo_email'] = '$variavel_campo[0]';
v_variaveis_javascript['campo_senha'] = '$variavel_campo[1]';
v_variaveis_javascript['tipo_acao'] = '$variavel_campo[2]';
v_variaveis_javascript['query_parametro'] = null;
v_variaveis_javascript['chave'] = '$chave';
v_variaveis_javascript['$variavel_campo[5]'] = '$idusuario';
v_variaveis_javascript['id_temp_publicacao_excluir'] = null;
v_variaveis_javascript['modo_temp_adicionar_amizade'] = null;
v_variaveis_javascript['nome_pesquisa_amigo_local'] = null;
v_variaveis_javascript['modo_pesquisa_geral'] = null;
v_variaveis_javascript['nome_pesquisa_geral'] = null;
v_variaveis_javascript['comentario_postar'] = null;
v_variaveis_javascript['comentario_idpostar'] = null;
v_variaveis_javascript['campo_numero_comentarios'] = null;
v_variaveis_javascript['campo_comentario_paginacao_atual'] = null;
v_variaveis_javascript['campo_temp_texto_coment_editado'] = null;
v_variaveis_javascript['comentario_idatualizar'] = null;
v_variaveis_javascript['id_post'] = null;
v_variaveis_javascript['tabela_campo'] = null;
v_variaveis_javascript['comentario_usuario_excluir_id'] = null;
v_variaveis_javascript['comentario_usuario_excluir_idusuario'] = null;
v_variaveis_javascript['uidamigo'] = null;
v_variaveis_javascript['modo_opcoes_solicitacao_amizade'] = \"$modo_opcoes_solicitacao_amizade\";
v_variaveis_javascript['campo_carrega_conteudo'] = '$idcampo_conteudo';
v_variaveis_javascript['tipo_acao_pagina'] = $tipo_acao;
v_variaveis_javascript['senha_atual'] = null;
v_variaveis_javascript['nova_senha'] = null;
v_variaveis_javascript['nova_senha_confirma'] = null;
v_variaveis_javascript['opcao_limpar_perfil'] = 1;
v_variaveis_javascript['campo_senha_excluir_conta'] = null;
v_variaveis_javascript['e_mail_campo_add_amizade'] = null;
v_variaveis_javascript['campo_mensagem_falha_add_amizade'] = null;
v_variaveis_javascript['uidamigo_depoimento'] = null;
v_variaveis_javascript['depoimento_escreveu'] = null;
v_variaveis_javascript['modo_carrega_depoimento'] = null;
v_variaveis_javascript['idcampo_paginador_depoimentos'] = null;
v_variaveis_javascript['modo_carrega_depoimento_limpa'] = null;
v_variaveis_javascript['id_depoimento_excluir'] = null;
v_variaveis_javascript['modo_aceita_exclui_depoimento'] = null;
v_variaveis_javascript['idcampo_depoimento_usuario'] = null;
v_variaveis_javascript['idcampo_visualizador_depoimentos'] = null;
v_variaveis_javascript['termo_pesquisa_marcador'] = null;
v_variaveis_javascript['idcampo_balao_notifica_marcador'] = null;
v_variaveis_javascript['idusuario_marcar'] = null;
v_variaveis_javascript['chave_marcar_usuario'] = null;
v_variaveis_javascript['marcar_usuario_modo'] = null;
v_variaveis_javascript['marcacoes_concluidas_modo'] = null;
v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados'] = null;
v_variaveis_javascript['id_campo_progresso_gif_geral'] = \"$idcampo_progresso_gif_geral\";
v_variaveis_javascript['id_publicacao_campo_marcar'] = null;
v_variaveis_javascript['tabela_campo_marcar'] = null;
v_variaveis_javascript['mensagem_enviar_usuario'] = null;
v_variaveis_javascript['uidamigo_envia_mensagem'] = null;
v_variaveis_javascript['termo_pesquisa_mensagem'] = null;
v_variaveis_javascript['id_mensagem_excluir'] = null;
v_variaveis_javascript['zera_contador_mensagens'] = 1;
v_variaveis_javascript['zera_contador_mensagens_chat'] = [];
v_variaveis_javascript['uidamigo_mensagem_abrir'] = null;
v_variaveis_javascript['modo_mensagens'] = 0;
v_variaveis_javascript['ultimo_uidamigo_mensagem'] = null;
v_variaveis_javascript['modo_excluir_mensagem'] = null;
v_variaveis_javascript['uidamigo_exclui_mensagem'] = null;
v_variaveis_javascript['id_campo_entrada_insere_emoticon'] = null;
v_variaveis_javascript['id_janela_chat_mensagens'] = \"$id_janela_chat_mensagens\";
v_variaveis_javascript['contador_nova_janela_chat'] = 0;
v_variaveis_javascript['tamanho_nova_janela_chat'] = $tamanho_nova_janela_chat;
v_variaveis_javascript['id_nova_janela_chat'] = \"$id_nova_janela_chat\";
v_variaveis_javascript['uid_usuario_novo_chat'] = null;
v_variaveis_javascript['numero_maximo_janelas_chat'] = $numero_maximo_janelas_chat;
v_variaveis_javascript['uidamigo_conversa_chat_temp'] = null;
v_variaveis_javascript['pasta_sons_sistema'] = \"$pasta_sons_sistema\";
v_variaveis_javascript['tamanho_desconto_primeira_janela_chat'] = $tamanho_desconto_primeira_janela_chat;
v_variaveis_javascript['id_janela_usuarios_abertos_chat'] = \"$id_janela_usuarios_abertos_chat\";
v_variaveis_javascript['contador_abrir_janela_chat'] = 1;
v_variaveis_javascript['uid_usuario_fecha_chat'] = null;
v_variaveis_javascript['id_campo_numero_usuarios_abertos_chat'] = \"$id_campo_numero_usuarios_abertos_chat\";
v_variaveis_javascript['contador_lista_janelas_chat_abertos'] = 0;
v_variaveis_javascript['id_lista_usuarios_abertos_chat'] = \"$id_lista_usuarios_abertos_chat\";
v_variaveis_javascript['id_pagina_visualizando'] = \"$pagina\";
v_variaveis_javascript['zera_contador_avanco_exibir_inscritos_pagina'] = 0;
v_variaveis_javascript['modo_visualiza_paginas_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'] = null;
v_variaveis_javascript['modo_visualiza_paginas_usuario_paginar'] = null;
v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] = null;
v_variaveis_javascript['valor_configuracao_pagina'] = null;
v_variaveis_javascript['numero_configuracao_pagina'] = null;
v_variaveis_javascript['id_pagina_salva_configuracao'] = null;
v_variaveis_javascript['id_pagina_excluir'] = null;
v_variaveis_javascript['termo_pesquisa_pagina'] = null;
v_variaveis_javascript['id_notifica_num_comentario'] = null;
v_variaveis_javascript['id_notifica_num_curtida'] = null;
v_variaveis_javascript['id_notifica_num_geral'] = null;
v_variaveis_javascript['id_notifica_num_mensagens'] = null;
v_variaveis_javascript['id_notifica_num_depoimentos'] = null;
v_variaveis_javascript['id_notifica_num_amizades_add'] = null;
v_variaveis_javascript['id_notifica_num_marcacoes'] = null;
v_variaveis_javascript['campo_cadastro_0'] = null;
v_variaveis_javascript['campo_cadastro_1'] = null;
v_variaveis_javascript['campo_cadastro_2'] = null;
v_variaveis_javascript['campo_cadastro_3'] = null;
v_variaveis_javascript['campo_cadastro_4'] = null;
v_variaveis_javascript['campo_cadastro_5'] = null;
v_variaveis_javascript['campo_cadastro_6'] = null;
v_variaveis_javascript['campo_cadastro_7'] = null;
v_variaveis_javascript['conteudo_atualiza_publicacao'] = null;
v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'] = null;
v_variaveis_javascript['zera_contador_aniversariantes'] = null;
v_variaveis_javascript['id_post_compartilha'] = null;
v_variaveis_javascript['hashtag'] = \"$hashtag\";
v_variaveis_javascript['uid_musicas_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_musicas_usuario'] = null;
v_variaveis_javascript['musica_pesquisa'] = \"$musica\";
v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'] = null;
v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes'] = null;
v_variaveis_javascript['id_musica_excluir'] = null;
v_variaveis_javascript['id_video_excluir'] = null;
v_variaveis_javascript['video_pesquisa'] = \"$video\";
v_variaveis_javascript['id_campo_progresso_pesquisa_videos'] = null;
v_variaveis_javascript['id_campo_pesquisa_videos_informacoes'] = null;
v_variaveis_javascript['uid_videos_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_videos_usuario'] = null;
v_variaveis_javascript['idcampo_previsualiza_musicas'] = \"$idcampo_previsualiza_musicas\";
v_variaveis_javascript['idcampo_previsualiza_videos'] = \"$idcampo_previsualiza_videos\";
v_variaveis_javascript['zera_contador_amigos_online'] = null;
v_variaveis_javascript['nome_pesquisa_amigo_local_chat'] = null;
v_variaveis_javascript['token_pagina'] = \"$token_pagina\";
v_variaveis_javascript['id_campo_textarea_publicar'] = \"$idcampo[0]\";
v_variaveis_javascript['modo_mobile'] = \"$modo_mobile\";
v_variaveis_javascript['elementos_ocultos_chat'] = null;
v_variaveis_javascript['deslogar_modo'] = 1;
v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'] = null;
v_variaveis_javascript['chat_minimizado'] = 1;
v_variaveis_javascript['id_formulario_cadastro'] = \"$id_formulario_cadastro\";
v_variaveis_javascript['cidade_pesquisa_geral'] = null;
v_variaveis_javascript['id_janela_principal_chat'] = \"$id_janela_principal_chat\";
v_variaveis_javascript['posicao_atual_cursor_emoticon'] = null;
v_variaveis_javascript['modo_pesquisa_pagina'] = \"$modo\";
v_variaveis_javascript['parametro_pesquisa_amigos'] = null;
v_variaveis_javascript['modo_album'] = \"$modo_album\";
v_variaveis_javascript['titulo_pagina'] = \"$titulo_pagina\";
v_variaveis_javascript['permalink'] = \"$permalink\";
</script>
";
$campo[1] = "
<script language='javascript'>
var v_array_conteudo_url = [];
var v_array_conteudo_url_imagens = [];
var v_array_ids_imagens_albuns = [];
var v_array_ids_imagens_albuns_abertos = [];
</script>
";
$html = "
$campo[0]
$campo[1]
";
return $html;
};
function plugin_conteudo_pagina(){
global $tabela_banco;
global $idioma_sistema;
$tipo_acao = retorne_campo_formulario_request(2);
$uid = retorne_idusuario_request();
$usuario_dono = retorne_usuario_dono_perfil($uid);
$idpost = retorne_idpublicacao_requeste();
if(retorne_conteudo_pagina_pode_exibir() == false){
		$conteudo_retorno[2] = mensagem_conteudo_indisponivel();
	$conteudo_retorno[1] = constroe_campos_perfil_usuario_lateral_direito(true);
		return $conteudo_retorno;
};
$modo_permalink = retorne_modo_permalink();
$modo_mobile = retorne_modo_mobile();
$usuario_logado = retorne_usuario_logado();
if($modo_mobile == true){
		$formulario[0] = formulario_cadastro(true);
};
if($usuario_logado == true){
		retorne_pode_retornar_dados_usuario_nova_consulta(1, $uid, null);
		atualiza_retorna_dados_usuario_sessao(true, false);
		retorna_seta_chave_publicacao(true);
		zera_dados_sessao();
		visitar_perfil();
		erradicar_aniversarios_amigos();
};
if(retorna_constroe_pagina() == true){
		return constroe_pagina_usuario();
};
if($usuario_logado == false){
		$campo[0] = constroe_perfil_basico_deslogado();
		if($modo_mobile == false){
				$conteudo_retorno[3] .= $campo[0];
				if($tipo_acao == null){
						$conteudo_retorno[3] .= formulario_cadastro(false);
			$conteudo_retorno[3] .= constroe_alterar_idioma();
			$conteudo_retorno[2] .= constroe_apresentacao();
		}else{
						$conteudo_retorno[2] = constroe_conteudo_deslogado();			
			$conteudo_retorno[3] = formulario_cadastro(false);
			$conteudo_retorno[3] .= constroe_alterar_idioma();
		};		
	}else{
				if($tipo_acao == null){
						$conteudo_retorno[2] .= $campo[0];
			$conteudo_retorno[2] .= constroe_conteudo_deslogado();
			$conteudo_retorno[2] .= $formulario[0];	
			$conteudo_retorno[2] .= constroe_apresentacao();
		}else{
						$conteudo_retorno[2] = constroe_conteudo_deslogado();
		};
	};
		if($idpost != null){
				$conteudo_retorno[2] = retorne_publicacao_id($idpost);
				$conteudo_especial = true;
	};
}else{
		$chat_usuario = constroe_chat_usuario();
		if($modo_mobile == false){
				$conteudo_retorno[1] .= constroe_campos_perfil_usuario_lateral();
		$conteudo_retorno[3] .= constroe_campos_perfil_usuario_lateral_direito(false);
				$conteudo_retorno[1] .= constroe_campo_aniversario();
	};
		switch($tipo_acao){
		case 1:
				logout_usuario();
				chama_pagina_inicial();
		break;
		case 2:
				$array_titulos[] = $idioma_sistema[11];
		$array_titulos[] = $idioma_sistema[539];
				$array_conteudos[] = formulario_edita_perfil();
		$array_conteudos[] = constroe_formulario_relacionamento(false);
				$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();
				$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		break;
		case 3:
				$array_titulos[] = $idioma_sistema[17];
		$array_titulos[] = $idioma_sistema[539];
				$array_conteudos[] = constroe_caixa(false, visualizar_perfil_usuario());
		$array_conteudos[] = constroe_formulario_relacionamento(true);
				$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();
				$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		break;
		case 7:
		$conteudo_retorno[2] = constroe_carregar_imagens();
		break;
		case 25:
		$conteudo_retorno[2] = constroe_caixa(false, configuracoes_perfil());
		break;
		case 42:
		$conteudo_retorno[2] = constroe_caixa(false, constroe_gerenciador_mensagens());
		break;
		case 62:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		case 63:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		case 65:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		case 68:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		case 78:
		$conteudo_retorno[2] = constroe_pesquisar_musicas();
		break;
		case 82:
		$conteudo_retorno[2] = constroe_pesquisar_videos();
		break;
		case 90:
		$conteudo_retorno[2] = constroe_carregar_paginas_usuario();
		break;
		case 98:
		return constroe_mensageiro();		
		break;
		case 99:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		case 100:
		$conteudo_retorno[2] = reenviar_ativacao_usuario();
		break;
		case 104:
		$conteudo_retorno[2] = constroe_visualizar_amigos_usuario();
		break;
		case 105:
		$conteudo_retorno[2] = constroe_campo_editar_imagem_perfil();
		break;
		case 106:
		$conteudo_retorno[2] = constroe_campo_pesquisa_geral();
		break;
		case 107:
		return constroe_mensageiro();
		break;
		case 108:
		$conteudo_retorno[2] = constroe_visualizador_paginas_usuario();
		break;
		case 109:
				$array_titulos[] = $idioma_sistema[539];
				$array_conteudos[] = constroe_formulario_relacionamento(false);
				$array_ids[] = retorne_idcampo_md5();
				$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		break;
		case 110:
				$conteudo_retorno[2] = campo_formulario_construir_pagina();
		break;
		case 111:
				$conteudo_retorno[2] = constroe_campo_exibir_mapa_bing(false);
		break;
		case 112:
		$conteudo_retorno[2] = carrega_recomendacoes_musicas(false);
		break;
		case 113:
		$conteudo_retorno[2] = abrir_media_player(true);
		break;
		case 114:
		$conteudo_retorno[2] = abrir_media_player(false);
		break;
		default:
				if($idpost != null){
						$conteudo_retorno[2] = retorne_publicacao_id($idpost);
						$conteudo_especial = true;
						break;
		};
				if(retorne_idcomentario_requeste() != null){
						$conteudo_retorno[2] = retorne_comentario_id(retorne_idcomentario_requeste());
						$conteudo_especial = true;
						break;
		};	
				if($modo_mobile == false){
						$array_titulos[] = $idioma_sistema[93];
						if($usuario_dono == true){
								$array_titulos[] = $idioma_sistema[606];
			};
						$array_titulos[] = $idioma_sistema[381];
			$array_titulos[] = $idioma_sistema[483];
			$array_titulos[] = $idioma_sistema[180];
						$array_ids[] = retorne_idcampo_md5();
						if($usuario_dono == true){
								$array_ids[] = retorne_idcampo_md5();
			};
						$array_ids[] = retorne_idcampo_md5();
			$array_ids[] = retorne_idcampo_md5();
			$array_ids[] = retorne_idcampo_md5();
						$array_conteudos[] = constroe_campo_publicar();
						if($usuario_dono == true){
								$array_conteudos[] = constroe_conteudo_recomendado();
			};
						$array_conteudos[] = constroe_visualizar_videos_perfil();
			$array_conteudos[] = constroe_visualizador_musicas_perfil();
			$array_conteudos[] = constroe_campo_depoimentos_perfil();
						if($usuario_dono == false){
								$array_titulos[0] = $idioma_sistema[519];
				$array_titulos[] = $idioma_sistema[403];
								$array_ids[] = retorne_idcampo_md5();
								$array_conteudos[] = visualizar_perfil_usuario();
			}else{
								$array_titulos[] = $idioma_sistema[531];
								$array_ids[] = retorne_idcampo_md5();
								$array_conteudos[] = constroe_campo_alterar_plano_fundo();
								if($tipo_acao == 9){
										$array_titulos[0] = $idioma_sistema[608];
				};
			};
						$conteudo_aba = constroe_aba(true, false, $array_titulos, $array_conteudos, $array_ids);
						$conteudo_retorno[2] .= $conteudo_aba;
						$conteudo_retorno[6] .= constroe_perfil_ultra_basico();
			$conteudo_retorno[6] .= constroe_campo_album_perfil_basico();
						$conteudo_retorno[7] = constroe_capa_perfil_usuario(null);
		}else{
						if($modo_mobile == false){
								$conteudo_retorno[2] .= constroe_caixa(false, constroe_perfil_basico());			
			}else{
								$conteudo_retorno[2] .= constroe_perfil_basico();
			};
						$conteudo_retorno[2] .= constroe_campo_publicar();
		};
	};
};
if(retorna_configuracao_privacidade(1, $uid) == true){
		$conteudo_retorno[2] = mensagem_privacidade_usuario();
};
if($conteudo_retorno[2] == null){
		$conteudo_retorno[2] = constroe_conteudo_padrao(true, null, retorna_idcampo_conteudo_geral());
};
if($modo_mobile == false){
		$conteudo_retorno[2] .= $chat_usuario;
};
$conteudo_retorno[4] = constroe_conteudo_rodape();
$conteudo_retorno[5] = constroe_conteudo_sub_topo();
if($conteudo_especial == true and $conteudo_retorno[2] != null){
		if($modo_permalink  == true){
				$conteudo_retorno[2] = constroe_conteudo_padrao(false, $conteudo_retorno[2], null);
	}else{
				$conteudo_retorno[2] = constroe_conteudo_padrao(true, $conteudo_retorno[2], null);
	};
};
return $conteudo_retorno;
};
function plugin_funcoes_timer_pagina(){
$campo_conexao = "
executador_acao(null, 45, null);
executador_acao(null, 83, null);
";
if(retorne_usuario_logado() == true){
        $campo_conexao = plugin_timer_sistema(1, $campo_conexao);
}else{
		$campo_conexao = null;
};
$html = "
$campo_conexao
";
return $html;
};
function plugin_monta_pagina($conteudo_parametro){
global $idioma_sistema;
global $arquivo_sistema_host;
$modo_mobile = retorne_modo_mobile();
$usuario_logado = retorne_usuario_logado();
$modo_plano_fundo = retorne_modo_plano_fundo();
$modo_permalink = retorne_modo_permalink();
$tipo_acao = retorne_tipo_acao_pagina();
$usa_capa = retorne_usa_capa();
if($usuario_logado == false){
		$usuario_logado = logar_usuario($_COOKIE[COOKIE_EMAIL], $_COOKIE[COOKIE_SENHA], false);
};
$modo_pagina = retorne_modo_pagina();
$arquivo_dependencia[0] = $arquivo_sistema_host["css"];
$arquivo_dependencia[1] = $arquivo_sistema_host["js"];
$arquivo_dependencia[2] = $arquivo_sistema_host["jquery"];
$arquivo_dependencia[3] = $arquivo_sistema_host["jquery_form"];
$arquivo_dependencia[4] = $arquivo_sistema_host["css_efeitos"];
$arquivo_dependencia[5] = $arquivo_sistema_host["paginas_css"];
$arquivo_dependencia[6] = $arquivo_sistema_host["paginas_js"];
$arquivo_dependencia[9] = $arquivo_sistema_host["tema_resolucao"];
$arquivo_dependencia[10] = $arquivo_sistema_host["tema_deslogado"];
$arquivo_dependencia[11] = $arquivo_sistema_host["tema_feminino"];
$arquivo_dependencia[12] = $arquivo_sistema_host["tema_plano_fundo"];
$dependencia_css[0] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[0]\">";
$dependencia_css[1] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[4]\">";
$dependencia_css[2] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[5]\">";
$dependencia_css[4] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[9]\">";
$dependencia_css[5] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[10]\">";
$dependencia_css[6] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[11]\">";
$dependencia_css[7] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[12]\">";
$dependencia_javascript[0] = "<script src=\"$arquivo_dependencia[2]\"></script>";
$dependencia_javascript[1] = "<script src=\"$arquivo_dependencia[1]\"></script>";
$dependencia_javascript[2] = "<script src=\"$arquivo_dependencia[3]\"></script>";
$dependencia_javascript[3] = "<script src=\"$arquivo_dependencia[6]\"></script>";
$meta_tag = "
<meta name='description' content='$idioma_sistema[308]'>
<meta name='keywords' content='$idioma_sistema[525]'>
";
if($modo_plano_fundo == false or $usuario_logado == false){
		$dependencia_css[7] = null;
};
$sub_classe[1] = "borda_div_5";
$sub_classe[3] = "classe_cor_8";
$sub_classe[4] = "fundo_transparente";
if($modo_permalink == true){
		$sub_classe[2] = "fundo_transparente";
};
if(($tipo_acao != 9 and $tipo_acao != 22 and $modo_permalink == false and retorne_modo_hashtag() == false)){
		$sub_classe[2] = "borda_div_5";
};
$conteudo_pagina = plugin_conteudo_pagina();
if(is_array($conteudo_pagina) == false){
		$conteudo_parametro = $conteudo_pagina;
		$conteudo_pagina = null;
		$classe_parametro[0] = "classe_cor_32";
	$classe_parametro[1] = "classe_div_principal_conteudo_parametro";
};
$conteudo_topo_pagina = constroe_topo_pagina();
if($usa_capa == false or $conteudo_pagina[7] == null){
		$classe_posicao[0] = "posicao_top";
};
if(retorne_sexo_usuario_logado() == 1){
		$dependencia_css[6] = null;
};
if($usuario_logado == true or $modo_mobile == true){
		$dependencia_css[5] = null;
};
if($modo_pagina == true and $usuario_logado == false){
		$classe_corpo[0] = "classe_div_principal_pagina_deslogada";
}else{
		if($classe_parametro[1] == null){
				$classe_corpo[0] = "classe_div_principal";	
	}else{
				$classe_corpo[0] = $classe_parametro[1];
	};
};
if($modo_pagina == true or $usuario_logado == false){
		$classe[0] = "classe_div_conteudo_4 $classe_posicao[0]";
	$classe[1] = "classe_div_conteudo_6 $sub_classe[2]";
	$classe[2] = "classe_div_conteudo_5 $sub_classe[4]";
		$campo[3] = "
	<div class='$classe[0]'>
	$conteudo_pagina[1]
	</div>	
	";
		$campo[1] = "
	<div class='$classe[2]'>
	$conteudo_pagina[3]
	</div>
	<div class='$classe[1]'>
	$conteudo_pagina[2]
	</div>	
	";
}else{
		$classe[0] = "classe_div_conteudo_1 $sub_classe[1]";
	$classe[1] = "classe_div_conteudo_2 $sub_classe[2]";
	$classe[2] = "classe_div_conteudo_3 $classe_posicao[0]";
	$classe[4] = "classe_div_conteudo_7 $sub_classe[3]";
		$campo[3] = "
	<div class='$classe[2]'>
	$conteudo_pagina[3]
	</div>	
	";
		if($conteudo_pagina[6] != null){
				$campo[6] = "
		<div class='$classe[4]'>
		$conteudo_pagina[6]
		</div>
		";
	};
		$campo[1] = "
	<div class='$classe[0]'>
	$conteudo_pagina[1]
	</div>
	$campo[6]
	<div class='$classe[1]'>
	$conteudo_pagina[2]
	</div>
	";
};
if($conteudo_parametro != null){
		$conteudo_parametro = "
	<div class='classe_conteudo_parametro_centro $classe_parametro[0]'>
	$conteudo_parametro
	</div>
	";
		$campo = null;
		$campo[1] = $conteudo_parametro;
};
if($conteudo_pagina[4] != null and $usuario_logado == false){
		$campo[2] = "
	<div class='classe_div_rodape classe_cor_29'>
	$conteudo_pagina[4]
	</div>
	";
};
$campo[4] = $conteudo_pagina[5];
if($conteudo_parametro != null){
		$campo[1] = $conteudo_parametro;
	$campo[4] = null;
		$conteudo_pagina[7] = null;
};
if(is_array($conteudo_pagina) == false){
		$campo[4] = null;
	$campo[3] = null;
	$campo[2] = null;
	$campo[1] = $conteudo_pagina;
		$classe[3] = "classe_div_centro_pagina_raiz_completa";
	$classe_corpo[0] = "classe_div_principal_completa";
}else{
		$classe[3] = "classe_div_centro_pagina_raiz";	
};
$campo[5] = informa_topo_modo_mobile();
$topo_pagina = "
<div class='classe_div_topo classe_cor_1'>
$conteudo_topo_pagina
</div>
";
if($conteudo_pagina[7] != null and $tipo_acao != 98){
		$campo[7] = $conteudo_pagina[7];
		$campo[7] = "
	<div class='classe_div_conteudo_8'>
		$campo[7]
	</div>
	";
};
$corpo_pagina = "
$topo_pagina
$campo[5]
$informa_topo_modo_mobile
$campo[4]
<div class='$classe[3]'>
	$campo[7]
	<div class='$classe_corpo[0]'>
		$campo[1]
	</div>
	$campo[3]
</div>
$campo[2]
";
$variaveis_javascript = plugins_variaveis_javascript();
$paginadores_javascript = constroe_paginadores_javascript();
$titulo_pagina = retorne_titulo_pagina();
$funcoes_timer = plugin_funcoes_timer_pagina();
$iniciar_apos_carregamento = iniciar_apos_carregamento();
$funcoes_mover_mouse_pagina = eventos_mover_mouse_pagina();
if($modo_mobile == true){
		$metas_site[0] = "<meta name='viewport' content='width=device-width'/>";
}else{
		$dependencia_css[4] = null;
};
$plano_fundo_head = constroe_plano_fundo_usuario();
$html = "
<!DOCTYPE html>
<!-- documento html -->
<html>
\n
<head>
\n
<!-- plano de fundo -->
\n
$plano_fundo_head
\n
<!-- fim de plano de fundo -->
<!-- dependencia css -->
$dependencia_css[0]
\n
$dependencia_css[1]
\n
$dependencia_css[2]
\n
$dependencia_css[5]
\n
$dependencia_css[4]
\n
$dependencia_css[6]
\n
$dependencia_css[7]
\n
<!-- fim de css -->
<!-- titulo da pagina -->
<title>$titulo_pagina</title>
\n
<!-- fim de titulo -->
<!-- metas do site -->
$metas_site[0]
\n
<!-- fim de metas do site -->
<!-- meta tags -->
$meta_tag
<!-- fim de meta tags -->
<!-- jquery -->
$dependencia_javascript[0]
\n
<!-- fim de jquery -->
<!-- jquery de formulario -->
$dependencia_javascript[2]
\n
<!-- fim de formulario -->
<!-- dependencia javascript -->
$dependencia_javascript[1]
\n
$dependencia_javascript[3]
\n
<!-- fim de dependencia javascript -->
<!-- variaveis javascript -->
$variaveis_javascript
\n
<!-- fim de variaveis javascript -->
<!-- paginadores javascript -->
\n
$paginadores_javascript
\n
<!-- fim de paginadores javascript -->
<!-- funcoes de timer -->
\n
$funcoes_timer
\n
<!-- fim de funcoes de timer -->
</head>
\n
<!-- inicio do corpo da pagina -->
<body>
\n
$corpo_pagina
\n
</body>
<!-- fim do corpo da pagina -->
\n
<!-- funcoes pos carregamento -->
$iniciar_apos_carregamento
\n
<!-- fim de pos carregamento -->
<!-- funcoes mover mouse sobre a pagina -->
$funcoes_mover_mouse_pagina
\n
<!--  fim de mover mouse sobre a pagina -->
</html>
<!-- fim de pagiana html -->
";
return remove_linhas_branco($html);
};
function retorne_conteudo_pagina_pode_exibir(){
if(retorne_campo_formulario_request(2) == 1){
		return true;
};
if(retorne_idpagina_request() != null and retorne_pagina_existe(retorne_idpagina_request()) == false){
		return false;
};
if(retorne_usuario_logado() == false){
    	return true;
};
if(retorna_perfil_usuario_existe(true, retorne_idusuario_request()) == false){
        return false;	
};
if(retorne_usuario_bloqueio(retorne_idusuario_request()) == true){
		return false;
}else{
		return true;
};
return true;
};
function carrega_recomendacoes_musicas($modo_recomendar){
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;
$tipo_acao = retorne_tipo_acao_pagina();
$tabela[0] = $tabela_banco[26];
$uid = retorne_idusuario_logado();
$url_pagina_inicial = PAGINA_INICIAL;
if($tipo_acao == 112 and $modo_recomendar == true){
		return null;
};
if($modo_recomendar == true){
		$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;
}else{
		$limit = retorne_limit_query_iniciar(true, $tipo_acao);
};
$lista_query = retorne_completa_recomendar_musicas();
$query = "select *from $tabela[0] where ($lista_query) and uid!='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$html = constroe_link_media($dados_query, $modo_recomendar, false);
$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=112' title='$idioma_sistema[607]'>$idioma_sistema[607]</a>";
if($modo_recomendar == true){
		$campo[0] = "
	<div class='classe_titulo_recomendar_musica classe_cor_29 span_link'>
	$link[0]
	</div>
	";
		$classe[0] = "classe_conteudo_recomendar_musica";
}else{
		$classe[0] = "classe_conteudo_recomendar_musica_2";	
};
$html = "
<div class='$classe[0]'>
$html
</div>
$campo[0]
";
if($modo_recomendar == false){
		return constroe_conteudo_padrao(true, $html, null);
};
return $html;
};
function constroe_campo_anexar_musica($modo, $menu_id){
global $idioma_sistema;
global $variavel_campo;
$nome_usuario = retorne_nome_usuario_logado();
$idcampo[0] = codifica_md5("id_formulario_upload_musica_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_dialogo_upload_musica".retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_previsualiza_musicas_publicacao();
$imagem_usuario = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());
$funcao[0] = "exibe_dialogo(\"$idcampo[1]\")";
$funcao[1] = "fechar_menu_suspense(\"$menu_id\")";
$funcao[2] = "previsualiza_musicas_publicacao(\"$idcampo[2]\")";
$funcao[3] = "exibe_elemento_oculto(\"$idcampo[2]\", 0);";
$evento[0] = "onclick='$funcao[0];'";
if($modo == true){
		$formulario_upload = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[0], $variavel_campo[41], 76, false, 2, "$funcao[0], $funcao[1], $funcao[2], $funcao[3]");
}else{
		$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], $variavel_campo[41], 76, false, 2);
};
$formulario_upload = "
<div class='classe_div_campo_upload_musica'>
$formulario_upload
</div>
";
$campo_upload[0] = constroe_caixa_descritiva($idioma_sistema[354], $nome_usuario.$idioma_sistema[353], $imagem_usuario);
$campo_upload[0] .= $formulario_upload;
$campo_upload[0] = constroe_dialogo($idioma_sistema[351], $campo_upload[0], $idcampo[1]);
if($modo == true){
		$texto[0] = $idioma_sistema[351];
		$campo[0] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $evento[0]>$texto[0]</span>
	</div>
	";
}else{
		$texto[0] = retorne_imagem_sistema(63, null, false);
		$campo[0] = "
	<span class='classe_visualizador_musicas_perfil_basico_add_span' $evento[0]>
	$texto[0]
	</span>
	";
};
$array_retorno["html"] = $campo[0];
$array_retorno["dialogo"] = $campo_upload[0];
return $array_retorno;
};
function constroe_campo_previsualizar_musicas_publicacao(){
$idcampo[0] = retorne_idcampo_previsualiza_musicas_publicacao();
$html = "
<div class='classe_campo_previsualizar_musicas_publicacao' id='$idcampo[0]'></div>
";
return $html;
};
function constroe_musicas_publicacao($chave){
global $tabela_banco;
$tabela = $tabela_banco[26];
$query = "select *from $tabela where chave='$chave';";
if(retorne_numero_linhas_query($query) > 1){
		$html = constroe_player_playlist(false, plugin_executa_query($query));
}else{
		$html = constroe_player(false, plugin_executa_query($query));
};
if($html == null){
		return null;
};
$html = "
<div class='classe_player_musica'>$html</div>
";
return $html;
};
function constroe_musicas_usuario($uid, $modo, $modo_link){
global $tabela_banco;
$tabela = $tabela_banco[26];
if($modo == true){
		$limit_query = "limit ".NUMERO_MUSICAS_PERFIL_BASICO;
		$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
}else{
		$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;
		$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;
		$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
};
return constroe_player_playlist(false, plugin_executa_query($query));
};
function constroe_opcoes_musica($dados, $idcampo_1){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
if($uid != retorne_idusuario_logado()){
		return constroe_link_abrir_media($dados);
};
if($idcampo_1 == null){
		$idcampo_1 = retorne_idcampo_md5();
};
$idcampo[0] = codifica_md5("id_dialogo_excluir_musica_usuario_".$uid.$id.retorne_contador_iteracao());
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='excluir_musica_usuario(\"$id\", \"$idcampo_1\", \"$idcampo[0]\");'";
$nome_usuario = retorne_nome_usuario_logado();
$imagem_sistema[0] = retorne_imagem_sistema(36, null, false);
$campo[0] = "
<div class='separa_opcao_player_musica_pergunta'>
$nome_usuario$idioma_sistema[369]
</div>
<div class='separa_opcao_player_musica_resposta'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";
$campo[0] = constroe_dialogo($idioma_sistema[370], $campo[0], $idcampo[0]);
$campo[1] = "
<div class='classe_div_opcao_menu_suspense' $evento[0]>
<div class='separa_opcao_player_musica'>
$imagem_sistema[0]
</div>
<span class='separa_opcao_player_musica_titulo span_link'>
$idioma_sistema[370]
</span>
</div>
";
$campo[1] = constroe_menu_suspense(false, null, retorne_modo_mobile(), null, null, $campo[1]);
$campo[2] = constroe_link_abrir_media($dados);
$html = "
$campo[2]
<div class='classe_separa_player_media_opcoes' id='$idcampo_1'>
$campo[1]
</div>
$campo[0]
";
return $html;
};
function constroe_pesquisar_musicas(){
global $idioma_sistema;
global $url_link_acao;
global $pagina_inicial;
global $variavel_campo;
$uid = retorne_idusuario_request();
$idcampo[0] = codifica_md5("id_campo_pesquisa_musica_entrada_".retorne_contador_iteracao());
$idcampo[1] = retorna_idcampo_conteudo_geral();
$idcampo[2] = codifica_md5("id_campo_pesquisa_musica_progresso_".retorne_contador_iteracao());
$idcampo[3] = codifica_md5("id_campo_pesquisa_musica_informacoes_".retorne_contador_iteracao());
$barra_progresso[0] = campo_progresso_gif($idcampo[2]);
$funcao[0] = "pesquisar_musicas_usuarios(\"$idcampo[0]\", \"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\");";
$evento[0] = "onkeyup='$funcao[0]'";
$evento[1] = "onclick='$funcao[0]'";
$script[0] = "
<script>
$funcao[0]
</script>
";
$musica = retorne_campo_formulario_request(42);
$campo_musica = constroe_campo_anexar_musica(false, null);
$campo_musica_html = $campo_musica["html"];
$campo_musica_dialogo = $campo_musica["dialogo"];
$numero_musicas = retorne_tamanho_resultado(retorne_numero_musicas_usuario(retorne_idusuario_request()));
$link[0] = "<a href='$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=78' title='$idioma_sistema[368]'>$idioma_sistema[368] - $numero_musicas</a>";
$campo[0] = "
<div class='classe_pesquisa_musicas_entrada'>
<div class='classe_pesquisa_musicas_div_entrada_caixa_texto'>
<input type='text' placeholder='$idioma_sistema[363]' id='$idcampo[0]' value='$musica' $evento[0]>
</div>
<div class='classe_pesquisa_musicas_div_entrada_botao'>
<input type='button' value='$idioma_sistema[66]' $evento[1]>
</div>
</div>
";
$campo[1] = "
<div class='classe_resultados_pesquisa_musicas' id='$idcampo[1]'></div>
";
$campo[2] = "
<div class='classe_resultados_pesquisa_progresso'>$barra_progresso[0]</div>
";
$campo[3] = "
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[1]>
$idioma_sistema[61]
</div>
";
$campo[4] = "
<div class='classe_pesquisa_musicas_informacoes classe_cor_5' id='$idcampo[3]'></div>
";
$campo[5] = "
<div class='classe_pesquisa_musicas_links_1'>
<div class='classe_pesquisa_musicas_links_separa'>
$link[0]
</div>
</div>
<div class='classe_pesquisa_musicas_links_2'>
$campo_musica_html
</div>
$campo_musica_dialogo
";
$html = "
<div class='classe_pesquisa_musicas'>
$campo[0]
$campo[5]
$campo[1]
$campo[2]
$campo[4]
$campo[3]
</div>
$script[0]
";
return constroe_conteudo_padrao(true, $html, null);
};
function constroe_visualizador_musicas_perfil(){
global $idioma_sistema;
global $variavel_campo;
$url_pagina_inicial = PAGINA_INICIAL;
$uid = retorne_idusuario_request();
$numero_musicas = retorne_tamanho_resultado(retorne_numero_musicas_usuario($uid));
$campo[0] = constroe_musicas_usuario($uid, true, true);
$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=78' title='$idioma_sistema[356]$numero_musicas'>$idioma_sistema[356]$numero_musicas</a>";
$html = "
<div class='classe_visualizador_musicas_perfil_basico'>
<div class='classe_visualizador_musicas_perfil_basico_topo'>
<div class='classe_visualizador_musicas_perfil_basico_titulo' $evento[2]>
$link[0]
</div>
</div>
<div class='classe_visualizador_musicas_perfil_basico_conteudo'>
$campo[0]
</div>
</div>
";
return $html;
};
function excluir_musica_usuario($id, $chave){
global $tabela_banco;
if(retorne_usuario_logado() == false){
		return null;
};
$idusuario = retorne_idusuario_logado();
$tabela = $tabela_banco[26];
if($chave != null){
		$query = "select *from $tabela where (id='$id' or chave='$chave') and uid='$idusuario';";
}else{
		$query = "select *from $tabela where id='$id' and uid='$idusuario';";
};
$dados_query = plugin_executa_query($query);
$contador = 0;
$linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$url_root_musica = $dados[URL_ROOT_MUSICA];
		if($id != null and $uid == $idusuario){
				$query = "delete from $tabela where id='$id' and uid='$idusuario';";
				plugin_executa_query($query);
				exclui_arquivo_unico($url_root_musica);
	};
};
};
function pesquisar_musicas_usuarios(){
global $tabela_banco;
global $idioma_sistema;
if(retorna_chave_request() == null){
		return null;
};
$tabela = $tabela_banco[26];
$musica = retorne_campo_formulario_request(42);
$identificador_sessao = SESSAO_TERMO_PESQUISA_MARCADOR.retorna_chave_request();
$identificador_sessao_numero = SESSAO_PESQUISA_MARCADOR_NUMERO_ENCONTROU.retorna_chave_request();
$nome_usuario = retorne_nome_usuario_logado();
if($_SESSION[$identificador_sessao] != $musica){
		$_SESSION[$identificador_sessao] = $musica;
		contador_avanco(retorne_campo_formulario_request(2), 2);
		$_SESSION[$identificador_sessao_numero] = 0;
		$zerou_contador = 1;
}else{
		$zerou_contador = -1;
};
if(contador_avanco(retorne_campo_formulario_request(2), 3) == 0){
		$_SESSION[$identificador_sessao_numero] = 0;	
};
$limit = retorne_limit_query_iniciar(false, null);
if($musica == null){
		$uid = retorne_idusuario_request();
		$query[0] = "select *from $tabela where uid='$uid' order by id desc $limit;";
	$query[1] = "select *from $tabela where uid='$uid' order by id desc;";
}else{
		$query[0] = "select *from $tabela where titulo_musica like '%$musica%' order by id desc $limit;";
	$query[1] = "select *from $tabela where titulo_musica like '%$musica%' order by id desc;";
};
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);
$numero_linhas[0] = $dados_query[1]["linhas"];
$numero_linhas[1] = $dados_query[0]["linhas"];
$_SESSION[$identificador_sessao_numero] += $numero_linhas[1];
if($numero_linhas[1] == 0){
		contador_avanco(retorne_campo_formulario_request(2), 4);
		$array_retorno["dados"] = null;
	$array_retorno["zerou_contador"] = $zerou_contador;
	$array_retorno["informacoes"] = null;
		return json_encode($array_retorno);
};
if($numero_linhas[0] == 0){
		$html = $nome_usuario.$idioma_sistema[365];
};
if($numero_linhas[0] == 1){
		$html = $nome_usuario.$idioma_sistema[364];
};
if($numero_linhas[0] > 1){
		$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 3);
		$numero_linhas[0] = retorne_tamanho_resultado($numero_linhas[0]);
		$html = $numero_linhas[0].$idioma_sistema[366].$_SESSION[$identificador_sessao_numero].$idioma_sistema[367];
};
$array_retorno["dados"] = constroe_player(false, $dados_query[0]);
$array_retorno["zerou_contador"] = $zerou_contador;
$array_retorno["informacoes"] = $html;
return json_encode($array_retorno);
};
function previsualiza_musicas_publicacao($chave){
$array_retorno["dados"] = constroe_musicas_publicacao($chave);
return json_encode($array_retorno);
};
function retorne_completa_recomendar_musicas(){
$dados = retorne_dados_perfil_usuario_logado();
$musicas = $dados[MUSICAS];
if($musicas == null){
		return null;
};
$musicas = explode(",", $musicas);
$contador = 0;
foreach($musicas as $musica){
		if($musica != null){
				$musica = trim($musica);
				if($contador > 0){
						$completa = "or";
		};
				$lista_query .= " $completa titulo_musica like '%$musica%' ";
				$contador++;
	};
};
return $lista_query;
};
function retorne_idcampo_previsualiza_musicas_publicacao(){
return codifica_md5("idcampo_previsualiza_musicas_publicacao_".retorne_idusuario_logado());
};
function retorne_numero_musicas_usuario($uid){
global $tabela_banco;
$tabela = $tabela_banco[26];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function plugin_conexao($conectar = true){
$nome_conexao = CONEXAO_MYSQLI;
$conectado = $_SESSION[$nome_conexao] != null;
if($conectar == false and $conectado == true){
		mysqli_close($_SESSION[$nome_conexao]);
		$_SESSION[$nome_conexao] = null;
		return null;
};
if($conectar == true and $conectado == true){
		return null;
};
if($conectar == true and $conectado == false){
        $_SESSION[$nome_conexao] = mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, SENHA_MYSQL);
		mysqli_select_db($_SESSION[$nome_conexao], NOME_BANCO_DADOS);
		mysqli_query($_SESSION[$nome_conexao], "SET NAMES 'utf8'");
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_connection=utf8');
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_client=utf8');
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_results=utf8');
};
};
function plugin_executa_query($query){
if(retorne_pode_executar_query($query) == false){
		return null;
};
return plugin_roda_query($query);
};
function plugin_executa_varias_query($querys){
foreach($querys as $query){
		if($query != null){
				if(retorne_pode_executar_query($query) == true){
						plugin_roda_query($query);
		};
	};
};
};
function plugin_roda_query($query){
if($query == null){
		return null;
};
plugin_conexao(true);
$contador = 0;
$array_retorno = array();
$array_dados = array();
$comando = mysqli_query($_SESSION[CONEXAO_MYSQLI], $query);
$array_retorno["comando"] = $comando;
$numero_linhas = @mysqli_num_rows($comando);
for($contador == $contador; $contador <= $numero_linhas; $contador++){
        $dados = @mysqli_fetch_array($comando, MYSQLI_ASSOC);
        $array_dados[] = $dados;
};
$array_retorno["linhas"] = $numero_linhas;
$array_retorno["dados"] = $array_dados;
return $array_retorno;
};
function retorna_erro_mysql($conexao){
return mysqli_error($conexao);
};
function retorne_dados_comando($comando){
$dados = mysqli_fetch_array($comando, MYSQLI_ASSOC);
return $dados;
};
function retorne_dados_query($query){
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_limit_query($tipo_acao, $zerar){
if($zerar == true){
	    return "limit ".contador_avanco($tipo_acao, 2).", ".NUMERO_VALOR_PAGINACAO;
}else{
	    return "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;
};
};
function retorne_limit_query_iniciar($modo_limpar, $tipo_acao){
if($tipo_acao == null and is_numeric($tipo_acao) == false){
		$tipo_acao = retorne_campo_formulario_request(2);
};
$contador = contador_avanco($tipo_acao, 3);
if($modo_limpar == true){
		contador_avanco($tipo_acao, 2);
		$contador = contador_avanco($tipo_acao, 3);
}else{
		contador_avanco($tipo_acao, 1);
};
return "limit $contador, ".NUMERO_VALOR_PAGINACAO;
};
function retorne_numero_linhas_query($query){
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_pode_executar_query($query){
global $permite_query;
$retorno = true;
if($permite_query == true){
		return $retorno;
};
$query = converte_minusculo($query);
$query = explode(" ", $query);
$query = trim($query[0]);
$usuario_logado = retorne_usuario_logado();
$array_comum[] = "insert";
$array_comum[] = "delete";
$array_comum[] = "update";
$query_proibida[] = "create";
$query_proibida[] = "drop";
$query_proibida[] = "alter";
foreach($array_comum as $comando_analisa){
		if(retorna_palavra_chave_existe_string($query, $comando_analisa) == true and $usuario_logado == false){
				$retorno = false;
				break;
	};
};
foreach($query_proibida as $comando_analisa){
		if(retorna_palavra_chave_existe_string($query, $comando_analisa) == true and $usuario_logado == false){
				$retorno = false;
				break;
	};
};
return $retorno;
};
function cadastra_noticia($titulo, $link, $conteudo, $data){
global $tabela_banco;
if($link == null){
		return null;
};
$titulo = htmlentities($titulo);
$link = htmlentities($link);
$conteudo = htmlentities($conteudo);
$data_noticia = htmlentities($data);
$titulo = remove_html($titulo);
$link = remove_html($link);
$conteudo = remove_html($conteudo);
$data_noticia = remove_html($data);
$tabela = $tabela_banco[35];
$uid = retorne_idusuario_logado();
$data = data_atual();
$query = "insert into $tabela values(null, '$uid', '$titulo', '$link', '$conteudo', '$data_noticia', '$data');";
plugin_executa_query($query);
};
function campo_carregar_noticias(){
$tipo_acao = retorne_campo_formulario_request(2);
$modo = retorne_campo_formulario_request(6);
$campo[0] = constroe_campo_opcoes_noticias();
$campo[1] = carregar_noticias_aba();
$campo[2] = links_paginacao_noticias();
$html = "
<div class='classe_noticias_aba'>
$campo[0]
$campo[1]
$campo[2]
</div>
";
return $html;
};
function campo_recomendar_noticias(){
global $idioma_sistema;
$uid = retorne_idusuario_logado();
$configuracao[0] = retorna_configuracao_privacidade(11, $uid);
$estado_noticia = retorne_estado_noticia_usuario();
if($configuracao[0] == true or $estado_noticia == null){
		return null;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$progresso[0] = campo_progresso_gif($idcampo[0]);
$funcoes[0] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", null);";
$funcoes[1] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", 1);";
$funcoes[2] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", 2);";
$imagem[0] = retorne_imagem_sistema(83, null, false);
$imagem[1] = retorne_imagem_sistema(84, null, false);
$evento[0] = "onclick='$funcoes[1]'";
$evento[1] = "onclick='$funcoes[2]'";
$campo_paginar = "
<div class='classe_campo_paginar_noticia_1'>
<span $evento[0]>$imagem[0]</span>
</div>
<div class='classe_campo_paginar_noticia_2'>
<span $evento[1]>$imagem[1]</span>
</div>
";
$campo[0] = "
<div class='classe_noticias_recomendadas_topo'>
$campo_paginar
</div>
";
$campo[1] = "
<div class='classe_noticias_recomendadas_conteudo' id='$idcampo[1]'>
</div>
";
$campo[2] = plugin_timer_sistema(8, $funcoes[0]);
$campo[3] = "
<script>
$funcoes[0]
</script>
";
$html = "
<div class='classe_noticias_recomendadas'>
$campo[0]
$progresso[0]
$campo[1]
</div>
$campo[2]
$campo[3]
";
return $html;
};
function carregar_noticias(){
global $url_feed;
$tipo_acao = retorne_tipo_acao_pagina();
$dados = retorne_noticias_banco_dados(false);
$conteudo = $dados[CONTEUDO];
$ultima_data = $dados["ultima_data"];
if($dados["linhas"] == 0 and contador_avanco($tipo_acao, 3) > NUMERO_VALOR_PAGINACAO){
		contador_avanco($tipo_acao, 7);
		$dados = retorne_noticias_banco_dados(false);
		$conteudo = $dados[CONTEUDO];
		$ultima_data = $dados["ultima_data"];
};
if($ultima_data != null){
		$diferenca = diferenca_data_conexao($ultima_data);
		$diferenca = round($diferenca / 60);
		if($diferenca < 0){
				$diferenca = 0;
	};
}else{
		$diferenca = 0;
};
if($diferenca <= NUMERO_MINUTOS_RSS_ATUALIZAR_INICIO_GLOBAL and $diferenca >= 0 and $conteudo != null){
		$array_retorno["dados"] = $conteudo;
		return json_encode($array_retorno);
};
$url_feeds = $url_feed;
$url_feeds[] = retorne_estado_noticia_usuario();
$url_feeds = array_reverse($url_feeds);
limpa_noticias_antigas();
contador_avanco($tipo_acao, 2);
foreach($url_feeds as $url){
		if($url != null){
				$conteudo = leitor_noticia_rss($url, NUMERO_RSS_INICIO, true);
				if($conteudo !=  null){
						$html .= $conteudo;
		};
	};
};
$html = "
<div class='classe_noticias_filtradas_recomendar'>
$html
</div>
";
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function carregar_noticias_aba(){
$dados = retorne_noticias_banco_dados(true);
$conteudo = $dados[CONTEUDO];
return $conteudo;
};
function constroe_campo_opcoes_noticias(){
global $idioma_sistema;
global $variavel_campo;
$url_inicio = PAGINA_INICIAL;
$nome_pesquisa = retorne_campo_formulario_request(7);
$imagem_sistema[0] = retorne_imagem_sistema(74, null, false);
$campo[0] = "
<div class='classe_campo_opcoes_noticias_entrada classe_cor_2'>
<form action='$url_inicio' method='GET'>
$imagem_sistema[0]
<input type='text' name='$variavel_campo[7]' placeholder='$idioma_sistema[520]' value='$nome_pesquisa'>
<input type='hidden' name='$variavel_campo[2]' value='108'>
</form>
</div>
";
$html = "
<div class='classe_campo_opcoes_noticias'>
$campo[0]
</div>
";
return $html;
};
function constroe_noticia_url($dados_site, $url){
if($dados_site == null){
		return null;
};
$titulo = $dados_site['titulo'];
$descricao = $dados_site['descricao'];
$html = "
<div class='classe_noticia_sugerida'>
<div class='classe_noticia_sugerida_titulo'>
<a href='$url' target='_blank'>$titulo</a>
</div>
<div class='classe_noticia_sugerida_conteudo'>
<a href='$url' target='_blank'>$descricao</a>
</div>
</div>
";
return $html;
};
function leitor_noticia_rss($url, $numero_feeds, $cadastrar){
$rss = new DOMDocument();
$rss->load($url);
$feed = array();
foreach($rss->getElementsByTagName('item') as $node){
		$item = array(
	'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
	'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
	'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
	'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
	);
		array_push($feed, $item);
};
$contador = 0;
$contador_feeds = 0;
for($contador == $contador; $contador <= count($feed); $contador++){
		$title = str_ireplace(' & ', ' &amp; ', $feed[$contador]['title']);
	$link = $feed[$contador]['link'];
	$description = $feed[$contador]['desc'];
	$date = date('l F d, Y', strtotime($feed[$contador]['date']));
		if($link != null){
				if($cadastrar == true){
						cadastra_noticia($title, $link, $description, $date);
		};
				if($contador_feeds < $numero_feeds){
						$html .= monta_noticia($link, $title, $description, $date);
						$contador_feeds++;
		};
	};
};
return $html;
};
function leitor_noticia_xml($numero_feeds, $cadastrar){
global $url_feed_html;
$contador_feeds = 0;
foreach($url_feed_html as $url_feed){
		if($url_feed != null){
				$news = simplexml_load_file($url_feed);
				$feeds = array();
				foreach ($news->channel->item as $item){
						preg_match('@src="([^"]+)"@', $item->description, $match);
						$parts = explode('<font size="-1">', $item->description);
						$titulo = (string) $item->title;
			$link = (string) $item->link;
			$imagem = $match[1];
			$site_title = strip_tags($parts[1]);
			$conteudo = strip_tags($parts[2]);
			$date = (string) $item->pubDate;
						$imagem = str_ireplace("//", "http://", $imagem);
						$imagem = "<img src='$imagem'>";
						$conteudo .= $imagem;
						if($cadastrar == true){
								cadastra_noticia($titulo, $link, $conteudo, $date);
			};
						if($contador_feeds < $numero_feeds){
								$html .= monta_noticia($link, $titulo, $conteudo, $date);
								$contador_feeds++;
			};
		};
	};
};
return $html;
};
function limpa_noticias_antigas(){
global $tabela_banco;
$tabela = $tabela_banco[35];
$uid = retorne_idusuario_logado();
$query = "delete from $tabela where uid='$uid';";
plugin_executa_query($query);
};
function links_paginacao_noticias(){
global $tabela_banco;
global $variavel_campo;
$tabela = $tabela_banco[35];
$uid = retorne_idusuario_logado();
$query = retorne_query_pesquisa_noticias(null);
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$url_pagina_inicial = PAGINA_INICIAL;
$url_pagina_inicial = "?$variavel_campo[2]=108&$variavel_campo[52]";
$paginador = retorne_campo_formulario_request(52);
$html = paginar(NUMERO_VALOR_PAGINACAO, $paginador, $linhas, $url_pagina_inicial);
$html = "
<div class='campo_paginacao_noticias_aba'>
$html
</div>
";
return $html;
};
function monta_noticia($link, $title, $description, $date){
$html .= "
<div class='classe_noticia_sugerida'>
<div class='classe_noticia_sugerida_titulo'>
<a href='$link' title='$title' target='_blank'>$title</a>
</div>
<div class='classe_noticia_sugerida_conteudo'>
$description
</div>
<div class='classe_noticia_sugerida_data'>
$date
</div>
</div>
";
return $html;
};
function retorne_estado_noticia_usuario(){
global $url_feed_estado;
return $url_feed_estado[retorne_numero_estado_usuario_logado()];
};
function retorne_noticias_banco_dados($modo){
global $tabela_banco;
$tabela = $tabela_banco[35];
$uid = retorne_idusuario_logado();
$tipo_acao = retorne_tipo_acao_pagina();
if($modo == false){
		switch(retorne_campo_formulario_request(6)){
		case 1:
				$limit_query = "limit ".contador_avanco($tipo_acao, 4).", ".NUMERO_VALOR_PAGINACAO;
		break;
		case 2:
				$limit_query = "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;
		break;
		default:
				$limit_query = retorne_limit_query_iniciar(false, null);
	};
}else{
		$paginador = retorne_campo_formulario_request(52);
		if($paginador == null){
				$paginador = 0;
	};
		$paginador *= NUMERO_VALOR_PAGINACAO;
		$limit_query = "limit $paginador, ".NUMERO_VALOR_PAGINACAO;
};
$query = retorne_query_pesquisa_noticias($limit_query);
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
$contador = 0;
if($numero_linhas == 0){
		return null;
};
$ultima_data = null;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$titulo = $dados[TITULO];
	$link = $dados[LINK];
	$descricao = $dados[DESCRICAO];
	$data_noticia = $dados[DATA_NOTICIA];
	$data = $dados[DATA];
		if($id != null){
				$descricao = html_entity_decode($descricao);
				$html .= monta_noticia($link, $titulo, $descricao, $data_noticia);
				if($ultima_data == null and $data != null){
						$ultima_data = $data;
		};
	};
};
$dados_retorno[CONTEUDO] = $html;
$dados_retorno["ultima_data"] = $ultima_data;
$dados_retorno["linhas"] = $numero_linhas;
return $dados_retorno;
};
function retorne_query_pesquisa_noticias($limit_query){
global $tabela_banco;
$tabela = $tabela_banco[35];
$uid = retorne_idusuario_logado();
$nome_pesquisa = retorne_campo_formulario_request(7);
if($nome_pesquisa != null){
		$completa_query[0] = " and (titulo like '%$nome_pesquisa%' or descricao like '%$nome_pesquisa%')";
	$completa_query[1] = "where titulo like '%$nome_pesquisa%' or descricao like '%$nome_pesquisa%'";
};
if(retorne_usuario_logado() == true){
		$query = "select *from $tabela where uid='$uid' $completa_query[0] order by id desc $limit_query;";
}else{
		if($_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO] == null){
				$query = "select *from $tabela $completa_query[1] order by id desc $limit_query;";
				$dados_query = plugin_executa_query($query);
				$linhas = $dados_query["linhas"];
				$contador = 0;
				for($contador == $contador; $contador <= $linhas; $contador++){
						$dados = $dados_query["dados"][$contador];
						$uid = $dados[UID];
						if($uid != null){
								$_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO] = $uid;
								break;
			};
		};
	}else{
				$uid = $_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO];
	};
		$query = "select *from $tabela where uid='$uid' $completa_query[0] order by id desc $limit_query;";
};
return $query;
};
function adicionar_notifica($id, $uidamigo, $tabela_notifica, $tabela_acao, $idcomentario){
global $tabela_banco;
if(retorne_usuario_logado() == false or retorne_usuario_dono_perfil($uidamigo) == true){
		return null;
};
$data = data_atual();
$uid = retorne_idusuario_logado();
$tabela[0] = $tabela_banco[24];
$query[0] = "insert into $tabela[0] values(null, '$id', '$tabela_notifica', '$tabela_acao', '$uid', '$uidamigo', '0', '$idcomentario', '$data');";
$query[1] = "select *from $tabela[0] where uidamigo='$uidamigo' and idpost='$id' and tabela_acao='$tabela_acao';";
$dados_query[1] = plugin_executa_query($query[1]);
switch($tabela_acao){
	case $tabela_banco[7]: 	$dados_query[1]["linhas"] = 0;
	break;
	case $tabela_banco[13]: 	$dados_query[1]["linhas"] = 0;
	break;
	case $tabela_banco[6]; 	$dados_query[1]["linhas"] = 0;
	break;
};
if($dados_query[1]["linhas"] == 0){
		plugin_executa_query($query[0]);
}else{
		remove_notifica($uidamigo, $id, $tabela_acao, false);
};
};
function atualiza_notifica_timer(){
global $idioma_sistema;
global $url_link_acao;
$numero_mensagens = retorne_numero_mensagens(5, retorne_idusuario_logado());
$numero_total = retorne_numero_notifica(0) + $numero_mensagens;
$dados[0] = retorne_tamanho_resultado($numero_total);
$dados[1] = retorne_tamanho_resultado(retorne_numero_notifica(1));
$dados[2] = retorne_tamanho_resultado(retorne_numero_notifica(2));
$dados[3] = retorne_tamanho_resultado($numero_mensagens);
$dados[4] = retorne_tamanho_resultado(retorne_numero_novos_depoimentos(retorne_idusuario_logado()));
$dados[5] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(2));
$dados[6] = retorne_tamanho_resultado(retorne_numero_notifica(5));
$dados[7] = retorne_tamanho_resultado(retorne_numero_notifica(6));
$dados[8] = retorne_tamanho_resultado($numero_mensagens);
$dados[9] = $numero_total;
$dados[1] = "<a href='$url_link_acao[14]' title='$idioma_sistema[78]'>$idioma_sistema[78] - $dados[1]</a>";
$dados[2] = "<a href='$url_link_acao[15]' title='$idioma_sistema[279]'>$idioma_sistema[279] - $dados[2]</a>";
$dados[3] = "<a href='$url_link_acao[16]' title='$idioma_sistema[220]'>$idioma_sistema[220] - $dados[3]</a>";
$dados[4] = "<a href='$url_link_acao[17]' title='$idioma_sistema[180]'>$idioma_sistema[180] - $dados[4]</a>";
$dados[5] = "<a href='$url_link_acao[18]' title='$idioma_sistema[109]'>$idioma_sistema[109] - $dados[5]</a>";
$dados[6] = "<a href='$url_link_acao[19]' title='$idioma_sistema[293]'>$idioma_sistema[293] - $dados[6]</a>";
$dados[7] = "<a href='$url_link_acao[25]' title='$idioma_sistema[423]'>$idioma_sistema[423] - $dados[7]</a>";
$array_retorno["dados"] = $dados;
return json_encode($array_retorno);
};
function carrega_notificacoes($tabela_notifica, $tabela_acao, $modo){
global $tabela_banco;
global $idioma_sistema;
$tipo_acao = retorne_campo_formulario_request(2);
$tabela[0] = $tabela_banco[24];
$limit = contador_avanco($tipo_acao, 1) - NUMERO_VALOR_PAGINACAO;
$limit = "limit $limit, ".NUMERO_VALOR_PAGINACAO;
$uid = retorne_idusuario_logado();
if($tabela_notifica != null and $tabela_acao == null){
		$query[0] = "select *from $tabela[0] where tabela_notifica='-1' and uidamigo='$uid' order by id desc $limit;";
	$query[1] = "update $tabela[0] set visualizado='1' where tabela_notifica='-1' and uidamigo='$uid';";
}else{
		switch($tabela_acao){
		case $tabela_banco[14]: 				$query[0] = "select *from $tabela[0] where tabela_notifica='$tabela_acao' and uidamigo='$uid' order by id desc $limit;";
		$query[1] = "update $tabela[0] set visualizado='1' where tabela_notifica='$tabela_acao' and uidamigo='$uid';";
		break;
		default: 				$query[0] = "select *from $tabela[0] where tabela_acao='$tabela_acao' and uidamigo='$uid' order by id desc $limit;";
		$query[1] = "update $tabela[0] set visualizado='1' where tabela_acao='$tabela_acao' and uidamigo='$uid';";
	};	
};
$contador = 0;
$dados_query = plugin_executa_query($query[0]);
$numero_linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$html .= constroe_notificacao_usuario($dados);
};
plugin_executa_query($query[1]);
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_campo_exibe_notifica(){
global $idioma_sistema;
$tipo_acao = retorne_campo_formulario_request(2);
$idcampo[0] = retorna_idcampo_conteudo_geral();
$idcampo[1] = retorna_idcampo_progresso_gif_geral();
$evento[0] = "onclick='executador_acao(null, \"$tipo_acao\", \"$idcampo[0]\");'";
$barra_progresso[0] = campo_progresso_gif($idcampo[1]);
$nome_usuario = retorne_nome_usuario_logado();
$imagem[0] = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());
$campo[0] = "
<div class='classe_exibe_notificacoes_usuario_usuario classe_cor_2'>
<div class='classe_exibe_notificacoes_usuario_usuario_imagem'>
$imagem[0]
</div>
<div class='classe_exibe_notificacoes_usuario_usuario_texto'>
$idioma_sistema[281]$nome_usuario$idioma_sistema[282]
</div>
</div>
";
$html = "
<div class='classe_exibe_notificacoes_usuario'>
$campo[0]
<div class='classe_lista_notifica_usuario' id='$idcampo[0]'></div>
<div class='classe_exibe_notificacoes_usuario_progresso'>
$barra_progresso[0]
</div>
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
</div>
";
return $html;
};
function constroe_campo_notifica(){
global $idioma_sistema;
global $url_link_acao;
if(retorne_usuario_logado() == false or HABILITAR_MODO_NOTIFICA == false){
	    return null;
};
$modo_mobile = retorne_modo_mobile();
$uid = retorne_idusuario_logado();
$modo_plano_fundo = retorne_modo_plano_fundo();
if($modo_mobile == true){
		$imagem[8] = retorne_imagem_sistema(87, null, false);
}else{
		if($modo_plano_fundo == true){
				$imagem[8] = retorne_imagem_sistema(51, null, false);
	}else{
				$imagem[8] = retorne_imagem_sistema(77, null, false);
	};
};
$idcampo[1] = codifica_md5("id_campo_notifica_curtidas_".data_atual());
$idcampo[2] = codifica_md5("id_campo_notifica_comentarios_".data_atual());
$idcampo[3] = codifica_md5("id_campo_notifica_mensagens_".data_atual());
$idcampo[4] = codifica_md5("id_campo_numero_notificacoes_gerais_".data_atual());
$idcampo[5] = codifica_md5("id_campo_notifica_depoimentos_".data_atual());
$idcampo[6] = codifica_md5("id_campo_notifica_amizades_".data_atual());
$idcampo[7] = codifica_md5("id_campo_notifica_marcacoes_".data_atual());
$idcampo[8] = codifica_md5("id_campo_notifica_amizades_aceitas_".data_atual());
$idcampo[9] = codifica_md5("id_campo_notifica_mensagens_usuario_topo_".data_atual());
$campo_timer[0] = "
atualiza_notifica_timer(\"$idcampo[4]\", \"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo[5]\", \"$idcampo[6]\", \"$idcampo[7]\", \"$idcampo[8]\", \"$idcampo[9]\");
";
$script[0] = "
<script>
$campo_timer[0]
</script>
";
$campo_timer[0] = plugin_timer_sistema(2, $campo_timer[0]);
$links[1] = "<a href='$url_link_acao[14]' title='$idioma_sistema[78]'></a>";
$links[2] = "<a href='$url_link_acao[15]' title='$idioma_sistema[279]'></a>";
$links[3] = "<a href='$url_link_acao[16]' title='$idioma_sistema[220]'></a>";
$links[4] = "<a href='$url_link_acao[17]' title='$idioma_sistema[180]'></a>";
$links[5] = "<a href='$url_link_acao[18]' title='$idioma_sistema[109]'></a>";
$links[6] = "<a href='$url_link_acao[19]' title='$idioma_sistema[293]'></a>";
$links[7] = "<a href='$url_link_acao[25]' title='$idioma_sistema[423]'></a>";
$links[8] = "<a href='$url_link_acao[30]' title='$idioma_sistema[220]'>$imagem[8]</a>";
$campo_relacionamento = constroe_campo_notifica_relacionamento();
$campo[0] = "
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[1]'>
		$links[1]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[2]'>
		$links[2]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[3]'>
		$links[3]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[5]'>
		$links[4]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[6]'>
		$links[5]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[7]'>
		$links[6]
	</span>
</div>
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[8]'>
		$links[7]
	</span>
</div>
$campo_relacionamento
";
if($modo_plano_fundo == true){
		$campo[0] = constroe_menu_suspense(false, null, true, 50, null, $campo[0]);
}else{
		$campo[0] = constroe_menu_suspense(false, null, true, 23, null, $campo[0]);
};
if(retorne_sexo_usuario_logado() == 1){
		$classe[0] = "classe_campo_notifica_numero";
}else{
		$classe[0] = "classe_campo_notifica_numero_2";
};
$campo_notifica[0] = "
<div class='classe_campo_notifica'>
	<div class='classe_campo_notifica_imagem'>
		$campo[0]
	</div>
	<span class='$classe[0]' id='$idcampo[4]'></span>
</div>
";
$campo_notifica[1] = "
<div class='classe_campo_notifica'>
	<div class='classe_campo_notifica_imagem'>
		$links[8]
	</div>
	<span class='$classe[0]' id='$idcampo[9]'></span>
</div>
";
$html = "
$campo_notifica[0]
$campo_notifica[1]
$campo_timer[0]
$script[0]
";
return $html;
};
function constroe_notificacao_usuario($dados){
global $tabela_banco;
global $idioma_sistema;
$id = $dados["id"];
$idpost = $dados[IDPOST];
$tabela_notifica = $dados[TABELA_NOTIFICA];
$tabela_acao = $dados[TABELA_ACAO];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$visualizado = $dados[VISUALIZADO];
$data = $dados[DATA];
$idcomentario = $dados[IDCOMENTARIO];
if($id == null){
		return null;
};
if($tabela_notifica == -1 and $tabela_acao == $tabela_banco[6]){
		$tabela_notifica = $tabela_banco[6];
};
switch($tabela_notifica){
	case $tabela_banco[4]: 	
				switch($tabela_acao){
			case $tabela_banco[7]: 			
						$comentario = retorne_comentario_id($idcomentario);
						$campo[0] = constroe_imagem_id($idpost);
						if($campo[0] == null){
								break;
			};
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[283]."</span>";
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
			case $tabela_banco[9]: 			
						$campo[0] = constroe_imagem_id($idpost);
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[287]."</span>";
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
	case $tabela_banco[5]: 	
				switch($tabela_acao){
			case $tabela_banco[7]: 			
						$comentario = retorne_comentario_id($idcomentario);
						$campo[0] = retorna_link_referencia_publicacao_id($idpost, $idioma_sistema[462]);
						if($campo[0] == null){
								break;
			};
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[284].$campo[0]."</span>";
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
			case $tabela_banco[9]: 
						$campo[0] = retorna_link_referencia_publicacao_id($idpost, $idioma_sistema[462]);
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[288].$campo[0]."</span>";
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
	case $tabela_banco[13]: 
						$campo[0] = constroe_depoimento_id($idpost);
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[290]."</span>";
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
	case $tabela_banco[14]: 	
				switch($tabela_acao){
			case $tabela_banco[5]: 			
						$campo[0] = retorna_link_publicacao_id($idpost);
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[294]."</span>";
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
			case $tabela_banco[7]: 
						$comentario = retorne_comentario_id($idcomentario);
						$perfil[0] = retorne_nome_link_usuario(true, $uid);
						$link[0] = retorne_link_comentario($idcomentario);
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[295].$link[0]."</span>";
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
	case $tabela_banco[7]: 
				$comentario = retorne_comentario_id($idcomentario);
				$perfil[0] = retorne_nome_link_usuario(true, $uid);
				$link[0] = retorne_link_comentario($idpost);
				$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[347].$link[0]."</span>";
				switch($tabela_acao){
			case $tabela_banco[7]:
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[463].$link[0]."</span>";
			break;
		};
				$campo_responde = constroe_campo_comentario(null, 3, $idpost, true, $uidamigo);
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
				$perfil[0] = retorne_nome_link_usuario(true, $uid);
				$data = converte_data_amigavel(true, $data);
				$sexo[0] = retorne_sexo_usuario(retorne_dados_perfil_usuario($uidamigo));
		$sexo[1] = retorne_sexo_usuario(retorne_dados_perfil_usuario($uid));
				if($sexo[0] == false and $sexo[1] == false){
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[424]."</span>";
		}else{
						$mensagem[0] = $perfil[0]."<span class='classe_link_perfil_amigavel_span'>".$idioma_sistema[422]."</span>";
		};
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
$html = "
$campo[0]
";
return $html;
};
function limpar_notificacoes(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$query = "delete from $tabela_banco[24] where uidamigo='$uid';";
plugin_executa_query($query);
};
function remove_notifica($uidamigo, $idpost, $tabela_acao, $modo){
global $tabela_banco;
$tabela[0] = $tabela_banco[24];
switch($tabela_acao){
	case $tabela_banco[7]:
		if($uidamigo != null){
				$query = "delete from $tabela[0] where uidamigo='$uidamigo' and idcomentario='$idpost' and tabela_acao='$tabela_acao';";
	}else{
				$query = "delete from $tabela[0] where idcomentario='$idpost' and tabela_acao='$tabela_acao';";		
	};
	break;
	case $tabela_banco[6]:
		$query = "delete from $tabela[0] where uidamigo='$uidamigo';";
		plugin_executa_query($query);
		return null;
	break;
	default:
		if($uidamigo == null){
				$query = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_acao';";
	}else{
				$query = "delete from $tabela[0] where uidamigo='$uidamigo' and idpost='$idpost' and tabela_acao='$tabela_acao';";
	};
};
plugin_executa_query($query);
if($modo == true and ($tabela_acao == $tabela_banco[4] or $tabela_acao == $tabela_banco[5])){
		$query = null;
	$query[0] = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_banco[7]';";
	$query[1] = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_banco[9]';";
		plugin_executa_query($query[0]);
	plugin_executa_query($query[1]);
};
};
function remove_notifica_duplicados_comentario($id){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query[0] = "delete from $tabela_banco[24] where uid='$idusuario' and idpost='$id' and tabela_acao='$tabela_banco[7]';";
$query[1] = "delete from $tabela_banco[24] where uidamigo!='$idusuario' and idpost='$id' and tabela_acao='$tabela_banco[7]';";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
};
function retorne_numero_notifica($modo){
global $tabela_banco;
$tabela[0] = $tabela_banco[24];
$tabela[1] = $tabela_banco[39];
$uid = retorne_idusuario_logado();
switch($modo){
    case 0:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0';";
	$query[] = "select *from $tabela[1] where uid='$uid' and aceito='0' and visualizado='0';";
	break;
	case 1:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica!='$tabela_banco[14]' and tabela_acao='$tabela_banco[7]';";
	break;
	case 2:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_acao='$tabela_banco[9]';";
	break;
	case 3:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]' and tabela_acao='$tabela_banco[7]';";
	break;
	case 4:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]' and tabela_acao='$tabela_banco[5]';";
	break;
	case 5:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]';";
	break;
	case 6:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica=-1 and tabela_acao='$tabela_banco[6]';";
	break;
};
$numero_notifica = 0;
foreach($query as $query_executar){
		if($query_executar != null){
				$numero_notifica += retorne_numero_linhas_query($query_executar);
	};
};
return $numero_notifica;
};
function constroe_campo_paginar($titulo){
global $idioma_sistema;
if($titulo == null){
		$titulo = $idioma_sistema[61];
};
$idcampo[0] = retorna_idcampo_progresso_gif_geral();
$idcampo[1] = retorna_idcampo_conteudo_geral();
$progresso[0] = campo_progresso_gif($idcampo[0]);
$tipo_acao = retorne_tipo_acao_pagina();
$eventos[0] = "exibe_elemento_oculto(\"$idcampo[0]\", 0)";
$eventos[1] = "executador_acao(null, $tipo_acao, \"$idcampo[1]\")";
$eventos[0] = "onclick='$eventos[0], $eventos[1];'";
$html = "
<div class='classe_paginador_geral'>
$progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' $eventos[0]>
$titulo
</div>
</div>
";
return $html;
};
function constroe_paginadores_javascript(){
$funcoes_paginacao[0] = "executador_acao(null, v_variaveis_javascript['tipo_acao_pagina'], v_variaveis_javascript['campo_carrega_conteudo']);";
switch(retorne_campo_formulario_request(2)){
	default:     	$html = "
	<!-- pagina ao carregar a pagina -->
	<script language='javascript'>
	$(document).ready(function(){
        $funcoes_paginacao[0]
    });
	</script>
    <!-- fim de comentario -->
	<!-- evento ao atingir o bottom da pagina -->
	<script language='javascript'>
    $(window).scroll(function(){
	if($(window).scrollTop() + $(window).height() == $(document).height()) {
        $funcoes_paginacao[0]
    };
    });
    <!-- fim de comentario -->
	</script>
	";
};
return $html;
};
function contador_avanco($tipo_acao, $modo){
$identificador = retorne_identificador_md5_contador_avanco($tipo_acao);
if($_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] == null){
	    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;	
};
switch($modo){
	case 1:
	    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_VALOR_PAGINACAO;
	break;
	case 2:
		$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;
	break;
	case 4:
	    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO;
	break;
	case 5:
		$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_VALOR_PAGINACAO_EMOTICONS;
	break;
	case 6:
		$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO_EMOTICONS;
	break;
	case 7:
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO;
	break;
	case 8:
		$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_RECOMENDACOES_INICIO;
	break;
	case 9:
		$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_RECOMENDACOES_INICIO;
	break;
};
if($_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] < 0 and $modo != 7){
        $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;	
};
if($modo == null){
        $_SESSION[SESSAO_CONTADOR_AVANCO] = null;	
};
return $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador];
};
function contador_avanco_comentario($tipo_acao, $modo, $id, $elemento_id){
$identificador = codifica_md5($tipo_acao.$id.retorne_idusuario_request().SESSAO_CONTADOR_AVANCO_COMENTARIOS.$elemento_id);
switch($modo){
	case 1:
	    $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador] += NUMERO_VALOR_PAGINACAO;
	break;
	case 2:
		$_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador] = 0;
	break;
};
if($id == null){
        $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS] = null;
};
return $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador];
};
function retorne_identificador_md5_contador_avanco($tipo_acao){
$texto_codificar = $tipo_acao.retorne_idusuario_request().retorne_campo_formulario_request(23).SESSAO_CONTADOR_AVANCO.retorna_token_pagina_requeste();
return codifica_md5($texto_codificar.retorna_token_pagina_requeste());
};
function seta_valor_contador($tipo_acao, $valor){
$identificador = retorne_identificador_md5_contador_avanco($tipo_acao);
$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = $valor;
return "limit $valor, ".NUMERO_VALOR_PAGINACAO;
};
function zera_contador_iteracao(){
$_SESSION[SESSAO_CONTADOR_ITERACAO] = null;
};
function zera_dados_sessao(){
$_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorne_idusuario_request()] = null;
$_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = null;
};
function atualiza_perfil_usuario(){
global $variavel_campo;
global $tabela_banco;
global $pagina_inicial;
global $codigos_especiais;
$url_abrir = "$pagina_inicial?$variavel_campo[2]=2";
if(retorne_campo_formulario_request(6) != true){
		return chama_pagina_url($url_abrir);
};
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);
$contador = 0;
foreach($array_campos_tabela as $campo_tabela){
		if($campo_tabela != null){
        	    $campo_tabela = $array_campos_tabela[$contador];
	    	    $campo_tabela = trata_campo_tabela($campo_tabela, false);
	    	    $campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
				$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);
				if($contador == 4){
						$dia = retorne_campo_formulario_request(37);
			$mes = retorne_campo_formulario_request(38);
			$ano = retorne_campo_formulario_request(39);
						$valor_requeste = $dia.$codigos_especiais[10].$mes.$codigos_especiais[10].$ano;
		};
				if($contador <= 1 and $valor_requeste == null){
						return chama_pagina_url($url_abrir);
		};
				$campos_atualizar .= $campo_tabela."=\"$valor_requeste\", ";
				$campos_adicionar .= "\"$valor_requeste\", ";
				$contador++;
	};
};
$campos_atualizar = substr($campos_atualizar, 0, -2);
$campos_adicionar = substr($campos_adicionar, 0, -2);
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela_banco[1] where uid=\"$idusuario\";";
$query[1] = "update $tabela_banco[1] set $campos_atualizar where uid=\"$idusuario\";";
$query[2] = "insert into $tabela_banco[1] values($idusuario, $campos_adicionar);";
$array_dados = plugin_executa_query($query[0]);
if($array_dados["linhas"] == 0){
		plugin_executa_query($query[2]);
}else{
		plugin_executa_query($query[1]);
};
adicionar_publicacao_atualizar_perfil();
atualiza_retorna_dados_usuario_sessao(true, true);
atualize_dados_amigo(null, null, false);
return chama_pagina_url($url_abrir);
};
function atualiza_perfil_usuario_cadastrar($dados){
global $tabela_banco;
global $variavel_campo;
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);
$contador = 0;
foreach($array_campos_tabela as $campo_tabela){
		if($campo_tabela != null){
				$valor_campo = $dados[$contador + 1];
				$valor_campo = html_entity_decode($valor_campo);
				$campos_adicionar .= "\"$valor_campo\", ";
				$contador++;
	};
};
$idusuario = $dados[0];
$campos_adicionar = substr($campos_adicionar, 0, -2);
$query = "insert into $tabela_banco[1] values($idusuario, $campos_adicionar);";
plugin_executa_query($query);
};
function campo_navegacao_perfil_mobile(){
global $variavel_campo;
global $idioma_sistema;
$uid = retorne_idusuario_request();
$pagina_inicial[0] = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]";
$pagina_inicial[1] = PAGINA_INICIAL;
$classe[0] = "classe_perfil_basico_navega_perfil classe_cor_2";
$link[0] = "<a href='$pagina_inicial[0]=7' title='$idioma_sistema[167]'>$idioma_sistema[167]</a>";
$link[1] = "<a href='$pagina_inicial[0]=82' title='$idioma_sistema[381]'>$idioma_sistema[381]</a>";
$link[2] = "<a href='$pagina_inicial[0]=78' title='$idioma_sistema[483]'>$idioma_sistema[483]</a>";
$link[3] = "<a href='$pagina_inicial[0]=104' title='$idioma_sistema[474]'>$idioma_sistema[474]</a>";
$link[4] = "<a href='$pagina_inicial[0]=9' title='$idioma_sistema[494]'>$idioma_sistema[494]</a>";
$link[5] = "<a href='$pagina_inicial[0]=98' title='$idioma_sistema[321]'>$idioma_sistema[321]</a>";
$link[6] = "<a href='$pagina_inicial[1]' title='$idioma_sistema[94]'>$idioma_sistema[94]</a>";
$link[7] = "<a href='$pagina_inicial[0]=108' title='$idioma_sistema[247]'>$idioma_sistema[247]</a>";
$campo_idioma = constroe_alterar_idioma();
$html = "
<div class='classe_perfil_basico_miniatura_campos_separa'>
<div class='$classe[0]'>$link[6]</div>
<div class='$classe[0]'>$link[0]</div>
<div class='$classe[0]'>$link[1]</div>
<div class='$classe[0]'>$link[2]</div>
<div class='$classe[0]'>$link[3]</div>
<div class='$classe[0]'>$link[4]</div>
<div class='$classe[0]'>$link[7]</div>
<div class='$classe[0]'>$link[5]</div>
<div class='$classe[0]'>$campo_idioma</div>
</div>
";
$html = constroe_menu_suspense(false, null, true, 86, null, $html);
$html = "
<div class='campo_opcoes_navegacao_perfil_mobile'>
$html
</div>
";
return $html;
};
function constroe_campo_editar_perfil(){
global $idioma_sistema;
global $variavel_campo;
$pagina_inicial = PAGINA_INICIAL."?$variavel_campo[2]";
$url_link[0] = "$pagina_inicial=2";
$imagem[0] = retorne_imagem_sistema(79, null, false);
$html = "
<div class='classe_campo_editar_perfil'>
<a href='$url_link[0]'>$imagem[0]</a>
</div>
";
return $html;
};
function constroe_campo_excluir_imagem_perfil(){
$imagem_sistema[0] = retorne_imagem_sistema(62, null, false);
$funcao[0] = "excluir_imagem_perfil();";
$eventos[0] = "onclick='$funcao[0]'";
$html = "
<div class='classe_campo_excluir_imagem_perfil' $eventos[0]>
$imagem_sistema[0]
</div>
";
return $html;
};
function constroe_campo_opcoes_perfil($modo){
$uid = retorne_idusuario_request();
if(retorna_configuracao_privacidade(1, $uid) == true){
		return null;
};
$classe[0] = "classe_separa_opcao_perfil_usuario classe_cor_13";
switch($modo){
	case 2: 	$html .= constroe_visualizador_amigos_perfil();
	break;
	case 3: 	$html .= campo_bloquear_usuario(false, $uid);
	break;
	case 4: 	$html .= campo_envia_mensagem($uid);
	$classe[0] = "classe_separa_opcao_perfil_usuario_2";
	break;
	case 5: 	$html .= constroe_paginas_perfil_basico();
	break;
	case 6: 	$html .= constroe_visualizador_musicas_perfil();
	break;
};
if($html == null){
		return null;
};
$html = "
<div class='$classe[0]'>
$html
</div>
";
return $html;
};
function constroe_campo_reposicionar_imagem_perfil(){
global $variavel_campo;
global $idioma_sistema;
$pagina_inicial = PAGINA_INICIAL;
$url_link[0] = "$pagina_inicial?$variavel_campo[2]=105";
$imagem_sistema[0] = retorne_imagem_sistema(61, null, false);
$html = "
<div class='classe_campo_reposicionar_imagem_perfil'>
<a href='$url_link[0]' title='$idioma_sistema[480]'>
$imagem_sistema[0]
</a>
</div>
";
return $html;
};
function constroe_imagem_perfil_medio($uid){
global $variavel_campo;
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_medio = $dados_imagem[URL_HOST_MEDIO];
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
$dados_perfil = retorne_dados_perfil_usuario($uid);
if($url_host_medio == null){
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_medio = retorne_imagem_sistema(11, false, true);
	}else{
				$url_host_medio = retorne_imagem_sistema(24, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_medio = retorne_imagem_sistema(99, false, true);
	};
};
$imagem_link_usuario = "
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_medio' title='$nome_usuario' alt='$nome_usuario'>
</a>
";
$cidade = $dados_perfil[CIDADE];
$estado = $dados_perfil[ESTADO];
$pais = $dados_perfil[PAIS];
$trabalha = $dados_perfil[TRABALHA];
$estuda = $dados_perfil[ESTUDA];
$site = $dados_perfil[SITE];
$idiomas = $dados_perfil[IDIOMAS];
if($cidade != null and $estado != null and $pais != null){
		$campo_info[0] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$cidade - $estado - $pais
	</span>
	";
}
if($trabalha != null){
		$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$trabalha
	</span>
	";
};
if($estuda != null){
		$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$estuda
	</span>
	";
};
if($site != null){
		$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$site
	</span>
	";
};
if($idiomas != null){
		$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$idiomas
	</span>
	";
};
$campo_info[2] = campo_adicionar_pessoa(false, false, $uid);
$campo_info[2] = "
<div class='classe_campo_add_amizade_perfil_medio'>
$campo_info[2]
</div>
";
$campo[0] = "
<div class='classe_informacoes_perfil_medio_usuario'>
$campo_info[0]
$campo_info[1]
$campo_info[2]
</div>
";
$html = "
<div class='classe_imagem_perfil_medio'>
$imagem_link_usuario
</div>	
<div class='classe_nome_usuario_perfil_medio classe_cor_5'>
$nome_link_usuario
</div>
$campo[0]
";
$html = "
<div class='classe_perfil_medio_usuario'>
$html
</div>
";
return $html;
};
function constroe_imagem_perfil_miniatura($usar_evento, $modo, $uid){
global $variavel_campo;
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
$tipo_acao = retorne_campo_formulario_request(2);
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
switch($modo){
    case true: 
	    $html = "
	<div class='classe_div_imagem_perfil_miniatura_div_img'>
	<a href='$url_perfil_usuario' title='$nome_usuario'>
    <img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
    </a>
    </div>
    <div class='classe_div_imagem_perfil_miniatura_div_nome'>
    $nome_link_usuario
    </div>
	";
		$classe[0] = "classe_div_imagem_perfil_miniatura";
    break;
	case false: 	
		if($usar_evento == true){
				switch($tipo_acao){
			case 111:
						$idcampo_mensageiro[0] = retorne_idcampo_geral_troca_mensagens_mensageiro();
						$evento[0] = "onclick='constroe_campos_troca_mensagens_mensageiro(\"$uid\", \"$idcampo_mensageiro[0]\");'";
			break;
			default:
						$evento[0] = "onclick='constroe_janela_chat(\"$uid\", 0, null);'";
		};
	};
		switch($tipo_acao){
		case 111:
				$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_mensageiro";
		break;
		case 112:
				$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_mensageiro_topo";
		break;
		default:
				$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_chat";
	};
		$idcampo[0] = PREFIXO_CHAT_USUARIO_ONLINE_0.$uid;
	$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_1.$uid;
	$idcampo[2] = PREFIXO_CHAT_NOVAS_MENSAGENS.$uid;
		$campo_online = "
	<div class='classe_imagem_online_offline_chat' id='$idcampo[0]'></div>
	";
		$campo_numero_mensagens = "
	<span class='classe_numero_novas_mensagens_chat' id='$idcampo[2]'></span>
	";
		$html = "
	<div class='classe_div_imagem_perfil_miniatura_div_img_chat'>
    <img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
    </div>	
	<div class='$classe[1] classe_span_1' id='$idcampo[1]'>
    $nome_usuario   
	</div>
	$campo_online
	$campo_numero_mensagens
	";
		$classe[0] = "classe_div_imagem_perfil_miniatura_chat";
	break;
};
$html = "
<div class='$classe[0]' $evento[0]>
$html
</div>
";
return $html;
};
function constroe_imagem_perfil_miniatura_publicacao($modo, $uid){
global $variavel_campo;
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
if($modo == true){
		$classe[0] = "classe_div_imagem_perfil_miniatura";
		$campo[0] = "
	<div class='classe_div_imagem_perfil_miniatura_div_nome_publicacao'>
	$nome_link_usuario
	</div>
	";
}else{
		$classe[0] = "classe_div_imagem_perfil_miniatura_basico";
};
$html = "
<div class='classe_div_imagem_perfil_miniatura_div_img'>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>
$campo[0]
";
$html = "
<div class='$classe[0]' $evento[0]>
$html
</div>
";
return $html;
};
function constroe_opcoes_imagem_perfil(){
$uid = retorne_idusuario_request();
$modo_mobile = retorne_modo_mobile();
$usuario_dono = retorne_usuario_dono_perfil($uid);
if($usuario_dono == true){
		$campo[0] = constroe_formulario_barra_progresso(PAGINA_ACOES, "if_formulario_upload_img_perfil", "foto", 4, false, 1);
}else{
		return null;
};
$campo[0] = "
<div class='campo_editar_imagem_perfil_upload'>
$campo[0]
</div>
";
$campo[1] = constroe_campo_reposicionar_imagem_perfil();
$campo[2] = constroe_campo_excluir_imagem_perfil();
$campo[4] = constroe_campo_editar_perfil();
if($modo_mobile == false){
		$html = "
	$campo[1]
	$campo[2]
	$campo[4]
	";
}else{
		$html = "
	$campo[1]
	$campo[2]
	";
};
$html = constroe_menu_suspense(false, null, false, null, retorne_idcampo_md5(), $html);
$html = "
$campo[3]
<div class='classe_opcoes_imagem_perfil'>
<div class='classe_opcoes_imagem_perfil_separa'>
$html
</div>
$campo[0]
</div>
";
return $html;
};
function constroe_perfil_basico(){
global $tabela_banco;
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$dados_imagem = $dados_compilados_usuario[$tabela_banco[2]];
$url_host_grande = $dados_imagem[URL_HOST_GRANDE];
$url_host_mobile = $dados_imagem[URL_HOST_MOBILE];
if($modo_mobile == true){
		$url_host_grande = $url_host_mobile;
};
if($url_host_grande == null){
		$url_host_grande = retorne_imagem_sexo_usuario(true, $dados_perfil, $uid);
};
$nome = captular($dados_perfil[NOME]." ".$dados_perfil[SOBRENOME]);
$uid = $dados_perfil[UID];
$usuario_amigo = retorne_usuario_amigo($uid);
$usuario_dono = retorne_usuario_dono_perfil($uid);
$campo_opcoes_imagem_perfil = constroe_opcoes_imagem_perfil();
$campo_imagem_perfil = "
<div class='classe_div_imagem_perfil_grande'>
<img src='$url_host_grande' title='$nome' alt='$nome'>
</div>
";
if($modo_mobile == false){
		$campo_imagem_perfil = retorna_link_acao($campo_imagem_perfil, 9, $uid);
};
$campo_conta_ativada = campo_conta_ativada($uid);
if($modo_mobile == false){
		$nome_usuario = retorne_nome_usuario(true, $uid);
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
		$campo[0] = campo_redimensionar_imagem($campo[0], 0);
};
if($modo_mobile == true){
		$data_ultima_visualizacao = retorne_data_ultima_visualizacao_conexao($uid, false);
		$campo_envia_mensagem = campo_envia_mensagem($uid);
		if($campo_envia_mensagem != null){
				$campo_envia_mensagem = "
		<div class='classe_perfil_basico_miniatura_campos_separa_mensagem'>
		$campo_envia_mensagem
		</div>
		";
	};
		if($dados_perfil[NASCEU] != null){
				$idade_usuario = retorne_idade_usuario($dados_perfil[NASCEU]);
				if($idade_usuario != null){
						$campo_idade_usuario = "
			<div class='classe_perfil_basico_miniatura_campos_separa'>
			$idade_usuario$idioma_sistema[336]
			</div>
			";
		};
	};
		$cidade = $dados_perfil[CIDADE];
	$estado = $dados_perfil[ESTADO];
		if($cidade != null and $estado != null){
				$campo_mora = "
		<div class='classe_perfil_basico_miniatura_campos_separa'>
		$idioma_sistema[482]$cidade, $estado
		</div>
		";
	};
		$campo_amizade = campo_adicionar_pessoa(true, false, $uid);
		if($campo_amizade != null){
				$campo_amizade = "
		<div class='classe_perfil_basico_miniatura_campos_separa'>
		$campo_amizade
		</div>
		";
	};
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
if($modo_mobile == true){
		$campo[2] = $campo_opcoes_imagem_perfil;
		$campo_opcoes_imagem_perfil = null;
		$campo[3] = constroe_campo_album_perfil_basico();
}else{
		$array_amizade = campo_adicionar_pessoa(true, true, $uid);
		$array_bloquear = campo_bloquear_usuario(true, $uid);
		if($usuario_amigo == true){
				$dialogos .= $array_amizade["dialogo"];
		$dialogos .= $array_bloquear["dialogo"];
				$opcoes_perfil .= "<div class='classe_div_opcao_menu_suspense'>".$array_amizade["html"]."</div>";
		$opcoes_perfil .= "<div class='classe_div_opcao_menu_suspense'>".$array_bloquear["html"]."</div>";
	}else{
				$campo_amizade = "<div class='classe_separa_opcao_perfil_usuario_3'>".$array_amizade["html"]."</div>".$array_amizade["dialogo"];
		$campo_bloqueio = "<div class='classe_separa_opcao_perfil_usuario_3'>".$array_bloquear["html"]."</div>".$array_bloquear["dialogo"];
	};
		if($usuario_amigo == true){
				$opcoes_perfil = constroe_menu_suspense(false, null, false, null, null, $opcoes_perfil);
				$opcoes_perfil = "
		<div class='classe_div_opcoes_perfil_basico_menu classe_cor_4'>
		$opcoes_perfil
		</div>
		";		
	};
		$opcoes_perfil .= $campo_amizade;
	$opcoes_perfil .= $campo_bloqueio;
	$opcoes_perfil .= constroe_campo_opcoes_perfil(4);
};
$campos_mobile = "
$campo[1]
$campo[2]
$campo[3]
";
$html = "
<div class='classe_perfil_basico_usuario'>
$campos_mobile
$campo[0]
$campo_opcoes_imagem_perfil
$opcoes_perfil
</div>
$dialogos
";
return $html;
};
function constroe_perfil_basico_deslogado(){
global $tabela_banco;
global $idioma_sistema;
$uid = retorne_idusuario_request();
if($uid == null or retorne_idusuario_existe($uid) == false){
		return null;
};
$nome_usuario = retorne_nome_usuario(true, $uid);
$tabela = $tabela_banco[2];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
$url_host_grande = $dados[URL_HOST_GRANDE];
if($url_host_grande == null){
		$url_host_grande = retorne_imagem_sexo_usuario(false, null, $uid);
		$campo[0] = "
	<div class='imagem_perfil_usuario_deslogado'>
	$url_host_grande
	</div>
	";
}else{
		$campo[0] = "
	<div class='imagem_perfil_usuario_deslogado'>
	<img src='$url_host_grande' title='$nome_usuario'>
	</div>
	";
};
$campo[1] = "
<div class='nome_usuario_perfil_deslogado'>
$nome_usuario
</div>
";
$texto[0] = "
$idioma_sistema[414]$nome_usuario$idioma_sistema[163]
";
$texto[0] = mensagem_informa($texto[0]);
$campo[2] = "
<div class='classe_informa_visitante_perfil_deslogado'>
$texto[0]
</div>
";
$html = "
<div class='classe_perfil_usuario_deslogado classe_cor_8'>
$campo[0]
$campo[1]
$campo[2]
</div>
";
return $html;
};
function constroe_perfil_ultra_basico(){
global $tabela_banco;
if(retorne_modo_pagina() == true or retorne_usuario_logado() == false){
		return null;
};
switch(retorne_tipo_acao_pagina()){
	case 98:
	return null;
	break;
};
$uid = retorne_idusuario_request();
$usuario_dono_perfil = retorne_usuario_dono_perfil($uid);
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$apelido = $dados_perfil[APELIDO];
if($apelido != null){
		$apelido = captular($dados_perfil[APELIDO]);
		$nome = "
	<span class='classe_nome_topo_perfil_basico_usuario_apelido'>
	$apelido
	</span>	
	";
};
$campo[0] = "
<div class='classe_nome_topo_perfil_basico_usuario'>
$nome
</div>
";
$campo[1] = constroe_conteudo_topo_meio();
$campo[2] = constroe_campo_frase_efeito();
$html = "
<div class='classe_div_perfil_ultra_basico'>
<div class='classe_div_perfil_ultra_basico_sub_topo'>
$campo[0]
</div>
$campo[1]
$campo[2]
</div>
";
return $html;
};
function excluir_imagem_perfil(){
global $tabela_banco;
$modo = retorne_campo_formulario_request(6);
if($modo != 1){
		$array_retorno["dados"] = 0;
		return json_encode($array_retorno);
};
$uid = retorne_idusuario_logado();
excluir_pastas_subpastas(retorne_pasta_usuario($uid, 1, true), true);
$tabela = $tabela_banco[2];
$query = "delete from $tabela where uid='$uid';";
plugin_executa_query($query);
$array_retorno["dados"] = 1;
return json_encode($array_retorno);
};
function retorna_perfil_usuario_existe($modo, $idusuario){
global $tabela_banco;
if($modo == false){
	    $dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
	    $dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];
}else{
		$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);
	    $dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];
};
return $dados_perfil[UID] != null;
};
function retorne_dados_perfil_usuario($uid){
global $tabela_banco;
$tabela = $tabela_banco[1];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_nome_usuario_logado(){
global $tabela_banco;
$dados_compilados_usuario = $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
return $dados_perfil[NOME];
};
function retorne_usuario_dono_perfil($uid){
return $uid == retorne_idusuario_logado();
};
function visualizar_perfil_usuario(){
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$array_campos = explode(",", $idioma_sistema[10]);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);
$contador = 0;
$uid = retorne_idusuario_request();
$tipo_acao = retorne_tipo_acao_pagina();
$estado_usuario = $dados_perfil[ESTADO];
$cidade_usuario = $dados_perfil[CIDADE];
foreach($array_campos as $campo){
	    if($campo != null){
	    	    $campo_tabela = $array_campos_tabela[$contador];
	    	    $campo_tabela = trata_campo_tabela($campo_tabela, false);
	    	    $valor_campo = $dados_perfil[$campo_tabela];
		$valor_campo_original = $dados_perfil[$campo_tabela];
				switch($contador){
			case 2:
			$valor_campo = retorne_sexo_texto_usuario($dados_perfil);
			break;
		};
	    	    $valor_campo = constroe_link_pesquisa($valor_campo, $campo_tabela, $valor_campo_original);
	    	    $campos_perfil .= "
	    <div class='classe_div_perfil_completo_usuario_separa'>
	    <div class='classe_div_perfil_completo_usuario_descricao'>$campo -</div>
	    <div class='classe_div_perfil_completo_usuario_valor'>$valor_campo</div>
	    </div>
	    ";
	    	    $contador++;
};
};
$campo = null;
if($tipo_acao != 3){
		$pagina_inicial = PAGINA_INICIAL;
		$campo[0] = "
	<div class='classe_div_perfil_completo_usuario_visualizar_completo classe_cor_8'>
	<a href='$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=3' title='$idioma_sistema[565]'>$idioma_sistema[565]</a>
	</div>
	";
};
if($cidade_usuario != null and $estado_usuario != null){
		$mapa[0] = constroe_mapa($cidade_usuario, $estado_usuario);
};
$html = "
<div class='classe_div_perfil_completo_usuario classe_cor_2'>
$campo[0]
$campos_perfil
$mapa[0]
</div>
";
return $html;
};
function constroe_barra_pesquisa_topo(){
global $idioma_sistema;
global $variavel_campo;
if(retorne_usuario_logado() == false){
		return null;
};
$pagina_inicial = PAGINA_INICIAL."?$variavel_campo[2]=106&$variavel_campo[8]=$idioma_sistema[299]";
$modo_mobile = retorne_modo_mobile();
if($modo_mobile == true){
		$imagem_sistema[0] = retorne_imagem_sistema(68, null, false);
		$html = "
	<div class='classe_pesquisa_topo_mobile'>
	<a href='$pagina_inicial'>
	$imagem_sistema[0]
	</a>
	</div>
	";
		return $html;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$link[0] = "<a href='$pagina_inicial' title='$idioma_sistema[485]'>$idioma_sistema[485]</a>";
$funcao[0] = "carregar_visualizador_pesquisa_geral(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"\", \"\", 1);";
$funcao[1] = "exibe_visualizador_pesquisa_geral(\"classe_div_menu_suspense\", \"$idcampo[3]\", true)";
$funcao[2] = "exibe_visualizador_pesquisa_geral(\"classe_div_menu_suspense\", \"$idcampo[3]\", false)";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";
$progresso[0] = campo_progresso_gif($idcampo[1]);
$imagem_sistema[0] = retorne_imagem_sistema(74, null, false);
$script[0] = "
<script>
$(document).click(function() {
	$funcao[2]
});
$('#$idcampo[4]').click(function(event) {
	$funcao[1]
    event.stopPropagation();
});
</script>
";
$campo[0] = "
<div class='classe_barra_pesquisa_topo_entrada'>
$imagem_sistema[0]
<input type='text' placeholder='$idioma_sistema[484]' id='$idcampo[2]' onkeyup='$funcao[0]' $evento[1]>
</div>
$script[0]
";
$campo[1] = "
<div class='classe_barra_pesquisa_topo_resultados cor_borda_div_4' id='$idcampo[3]'>
<div class='classe_barra_pesquisa_topo_resultados_opcoes classe_cor_3 classe_cor_8'>
<div class='classe_barra_pesquisa_topo_resultados_opcoes_progresso'>
$progresso[0]
</div>
<div class='classe_barra_pesquisa_topo_resultados_opcoes_links'>
$link[0]
</div>
</div>
<div class='classe_barra_pesquisa_topo_resultados_usuarios' id='$idcampo[0]'></div>
<span class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</span>
</div>
";
$html = "
<div class='classe_barra_pesquisa_topo' id='$idcampo[4]'>
$campo[0]
$campo[1]
</div>
";
return $html;
};
function constroe_campo_pesquisa(){
global $idioma_sistema;
if(retorne_usuario_logado() == false and PERMITIR_PESQUISAS_DESLOGADO == false){
        return null;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$funcao[0] = "carregar_visualizador_pesquisa_geral(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", 0);";
$opcoes_pesquisa = constroe_opcoes_pesquisa_geral($idcampo[0], $funcao[0], $idcampo[2], $idcampo[3], $idcampo[4]);
$campo[0] = "
<script>$funcao[0]</script>
";
$progresso[0] = campo_progresso_gif($idcampo[1]);
$html = "
<div class='classe_div_campo_pesquisa_geral'>
$opcoes_pesquisa
<div class='classe_div_campo_visualizar_resultados_pesquisa' id='$idcampo[0]'>
$campo[0]
</div>
$progresso[0]
<div class='classe_paginador_padrao classe_cor_29 span_link' onclick='$funcao[0]'>
$idioma_sistema[61]
</div>
</div>
";
return $html;
};
function constroe_campo_pesquisa_geral(){
$campo[0] = constroe_campo_pesquisa();
$html = "
<div class='classe_conteudo_centro_padrao'>
$campo[0]
</div>
";
return $html;
};
function constroe_imagem_perfil_miniatura_pesquisa($uid){
global $variavel_campo;
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
$nome_usuario = retorne_nome_usuario(true, $uid);
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$imagem_link_usuario = "
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
";
$html = "
<div class='classe_div_imagem_perfil_miniatura_div_img_pesquisa'>
$imagem_link_usuario
</div>	
<div class='classe_div_imagem_perfil_miniatura_div_nome_pesquisa classe_nome_pesquisa classe_cor_5'>
$nome_link_usuario
</div>
";
$html = "
<div class='classe_div_imagem_perfil_miniatura_pesquisa'>
$html
</div>
";
return $html;
};
function constroe_link_pesquisa($valor_campo, $campo_tabela, $valor_campo_original){
global $variavel_campo;
if($valor_campo == null or $campo_tabela == null){
        return null;    
};
if(retorna_host_valido_dados_site($valor_campo) == true){
		return converte_url_link($valor_campo);
};
$link[0] = PAGINA_INICIAL."?$variavel_campo[2]=106&$variavel_campo[7]=$valor_campo&$variavel_campo[8]=$campo_tabela&$variavel_campo[6]=0";
$html = "
<span class='span_classe_link_pesquisa classe_cor_5'>
<a href='$link[0]' title='$valor_campo'>$valor_campo</a>
</span>
";
return $html;
};
function constroe_opcoes_pesquisa_geral($idcampo, $funcao_1, $idcampo_2, $idcampo_3, $idcampo_4){
global $idioma_sistema;
$nome_pesquisa = retorne_campo_formulario_request(7);
$modo_pesquisa = retorne_campo_formulario_request(8);
$evento[0] = "executador_acao(null, 17, null), $funcao_1";
$evento[1] = "onkeyup='$funcao_1'";
$campo_opcoes = gerador_select_option_especial(CAMPO_TABELA_PERFIL_CAMPOS_2, trata_campo_tabela(CAMPO_TABELA_PERFIL_CAMPOS_3, false), $modo_pesquisa, null, "$idcampo_3", $evento[0]);
$imagem_sistema[0] = retorne_imagem_sistema(66, null, false);
$html = "
<div class='classe_div_campo_pesquisa_geral_entrada_pesquisa'>
<div class='classe_div_campo_pesquisa_geral_entrada_pesquisa_topo'>
$idioma_sistema[66]
</div>
<div class='classe_div_campo_pesquisa_geral_entrada_imagem'>
$imagem_sistema[0]
</div>
<div class='classe_div_opcoes_visualizador_resultados_pesquisa_1'>
<input type='text' placeholder='$idioma_sistema[68]' value='$nome_pesquisa' id='$idcampo_2' $evento[1]'>
</div>
<div class='classe_div_opcoes_visualizador_resultados_pesquisa_2'>
$campo_opcoes
</div>
<div class='classe_div_opcoes_visualizador_resultados_pesquisa_4'>
<input type='text' placeholder='$idioma_sistema[486]' id='$idcampo_4' $evento[1]'>
</div>
</div>
";
return $html;
};
function pesquisa_geral(){
global $idioma_sistema;
global $tabela_banco;
$nome_pesquisa[0] = converte_minusculo(retorne_campo_formulario_request(7));
$cidade = converte_minusculo(retorne_campo_formulario_request(50));
$modo_pesquisa = trata_campo_tabela(converte_minusculo(retorne_campo_formulario_request(8)), false);
$tipo_acao = retorne_campo_formulario_request(2);
$modo_limpa_contador = retorne_campo_formulario_request(20);
$modo_usuarios = retorne_campo_formulario_request(51);
$array_modo[0] = explode(",", CAMPO_TABELA_PERFIL_CAMPOS_3);
$array_modo[1] = explode(",", CAMPO_TABELA_PERFIL_CAMPOS);
if($modo_pesquisa == converte_minusculo($array_modo[0][0])){
		$modo_pagina = true;
}else{
		$modo_pagina = false;
};
if($nome_pesquisa[0] == null){
		$array_retorno["dados"] = null;
		return json_encode($array_retorno);
};
if($modo_pesquisa == null){
		$modo_pesquisa = $array_modo[1][0];
		$sobrenome_pesquisa = $array_modo[1][1];
};
switch(converte_campo_perfil_numero_texto($modo_pesquisa)){
	case 2:
				if(is_numeric($nome_pesquisa[0]) == false){
						$nome_pesquisa[0] = retorne_modo_sexo_usuario($nome_pesquisa[0]);
		};
	break;
};
if($modo_limpa_contador == true){
		$limit_query = retorne_limit_query($tipo_acao, true);
		$limpar_dados_antigos = 1;
}else{
		$limit_query = retorne_limit_query($tipo_acao, false);
		$limpar_dados_antigos = 0;
};
if($cidade != null){
		$completa_query[0] = "and cidade like '%$cidade%'";
};
if($modo_pagina == true){
		$query = "select *from $tabela_banco[19] where titulo_da_pagina like '%$nome_pesquisa[0]%' order by id desc $limit_query;";
}else{
		if($sobrenome_pesquisa == null){
				$query = "select *from $tabela_banco[1] where $modo_pesquisa like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";
	}else{
				$query = "select *from $tabela_banco[1] where $modo_pesquisa like '%$nome_pesquisa[0]%' or $sobrenome_pesquisa like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";
	};
};
if(verifica_se_email_valido($nome_pesquisa[0]) == true){
		$query = "select *from $tabela_banco[0] where e_mail like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";	
};
$array_dados = plugin_executa_query($query);
$numero_linhas = $array_dados["linhas"];
$array_dados_usuario = $array_dados["dados"];
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $array_dados["dados"][$contador];
        $uid = $array_dados_usuario[$contador][UID];	
		if($modo_pagina == true){
				if($dados["id"] != null){
						$html .= constroe_pagina_miniatura($dados, $dados, true, true);
		};
	}else{
				if($uid != null){
						if($modo_usuarios == true){
								$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uid);
			}else{
								$imagem_perfil_usuario = constroe_imagem_perfil_medio($uid);
			};
						$html .= "
			<div class='classe_div_separa_amigo_visualizar_perfil_chat classe_cor_2'>
			$imagem_perfil_usuario
			</div>
			";
		};		
	};
};
$array_retorno["dados"] = $html;
$array_retorno["limpar_dados_antigos"] = $limpar_dados_antigos;
return json_encode($array_retorno);
};
function retorne_zerar_contador_avanco_pesq_geral($nome_pesquisa){
if($nome_pesquisa == null){
	    $_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = null;
	    return false;
};
if($_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] == $nome_pesquisa){
    	return false;
}else{
        $_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = $nome_pesquisa;
		return true;
};
};
function constroe_campo_alterar_plano_fundo(){
$uid = retorne_idusuario_request();
if(retorne_usuario_dono_perfil($uid) == false){
		return null;
};
$idcampo[0] = retorne_idcampo_md5();
$campo[0] = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], "foto", 114, false, 1);
$campo[1] = constroe_gerenciar_plano_fundo();
$html = "
<div class='classe_campo_plano_fundo'>
$campo[0]
$campo[1]
</div>
";
return $html;
};
function constroe_gerenciar_plano_fundo(){
global $idioma_sistema;
$idcampo[0] = retorne_idcampo_md5();
$funcao[0] = "exibe_dialogo(\"$idcampo[0]\");";
$funcao[1] = "remover_plano_fundo_usuario();";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";
$nome_usuario = retorne_nome_usuario_logado();
$dados = retorne_dados_plano_fundo();
$url_host_miniatura = $dados[URL_HOST_MINIATURA];
if($url_host_miniatura == null){
		return null;
};
$campo[0] = "
<div class='classe_imagem_apresenta_plano_fundo'>
<img src='$url_host_miniatura'>
</div>
";
$imagem_sistema[0] = retorne_imagem_sistema(95, null, false);
$campo[1] = "
<div class='classe_mensagem_dialogo_remover_plano_fundo_texto'>
$nome_usuario$idioma_sistema[532]
</div>
<div class='classe_mensagem_dialogo_remover_plano_fundo_botao'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";
$dialogo[0] = constroe_dialogo($idioma_sistema[533], $campo[1], $idcampo[0]);
$campo[1] = "
<div class='classe_opcao_gerenciar_plano_fundo' $evento[0]>
$imagem_sistema[0]
</div>
";
$campo[1] = "
<div class='classe_gerencia_plano_fundo_separa'>
$campo[1]
</div>
";
$html = "
<div class='classe_gerencia_plano_fundo'>
$campo[0]
$campo[1]
</div>
$dialogo[0]
";
return $html;
};
function constroe_plano_fundo_usuario(){
if(retorne_modo_pagina() == true or retorne_modo_mobile() == true){
		return null;
};
$dados = retorne_dados_plano_fundo();
$url_host_grande = $dados[URL_HOST_GRANDE];
if($url_host_grande == null){
		return null;
};
$html = "
<style type='text/css'>
body{
	background-image: url('$url_host_grande');
}
</style>
";
return $html;
};
function remover_plano_fundo_usuario(){
global $tabela_banco;
if(retorne_usuario_logado() == false){
		return null;
};
$idusuario = retorne_idusuario_logado();
$tabela = $tabela_banco[38];
$numero_pasta = 5;
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
excluir_pastas_subpastas($pasta_upload_root, false);
$query = "delete from $tabela where uid='$idusuario';";
plugin_executa_query($query);
atualiza_retorna_dados_usuario_sessao(true, true);
};
function retorne_dados_plano_fundo(){
global $tabela_banco;
$tabela = $tabela_banco[38];
$uid = retorne_idusuario_request();
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_modo_plano_fundo(){
if(retorne_modo_pagina() == true or retorne_modo_mobile() == true){
		return false;
};
$dados = retorne_dados_plano_fundo();
$url_host_grande = $dados[URL_HOST_GRANDE];
if($url_host_grande != null){
		return true;
}else{
		return false;
};
};
function abrir_media_player($modo){
global $tabela_banco;
$id = retorne_campo_formulario_request(4);
if($id == null){
		return null;
};
if($modo == true){
		$tabela = $tabela_banco[26];
}else{
		$tabela = $tabela_banco[27];	
};
if(retorne_id_existe($id, $tabela) == false){
		return mensagem_conteudo_indisponivel();
};
$query = "select *from $tabela where id='$id';";
$campo[0] = constroe_player(false, plugin_executa_query($query));
return constroe_conteudo_padrao(true, $campo[0], null);
};
function carrega_links_medias(){
global $tabela_banco;
$tabela[0] = $tabela_banco[26];
$uid = retorne_idusuario_logado();
$tipo_acao = retorne_tipo_acao_pagina();
if(contador_avanco($tipo_acao, 3) == 0){
		$limit = "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;
}else{
		$limit = retorne_limit_query($tipo_acao, false);
};
$lista_query = retorne_completa_recomendar_musicas();
$query = "select *from $tabela[0] where ($lista_query) and uid!='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$html = constroe_link_media($dados_query, false, true);
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_link_abrir_media($dados){
global $variavel_campo;
$id = $dados["id"];
$titulo_musica = $dados[TITULO_MUSICA];
$titulo_video = $dados[TITULO_VIDEO];
$uid = $dados[UID];
if($id == null){
		return null;
};
if($uid == retorne_idusuario_logado()){
		$classe[0] = "classe_link_abrir_media";
}else{
		$classe[0] = "classe_link_abrir_media_2";
};
$url_pagina_inicial = PAGINA_INICIAL;
if($titulo_musica != null){
		$url[0] = "$url_pagina_inicial?$variavel_campo[2]=113&$variavel_campo[4]=$id";
		$link[0] = "
	<a href='$url[0]' title='$titulo_musica'>$titulo_musica</a>	
	";
}else{
		$url[0] = "$url_pagina_inicial?$variavel_campo[2]=114&$variavel_campo[4]=$id";
		$link[0] = "
	<a href='$url[0]' title='$titulo_video'>$titulo_video</a>	
	";
};
$html = "
<div class='$classe[0]'>
$link[0]
</div>
";
return $html;
};
function constroe_link_media($dados_query, $modo_recomendar, $modo_json){
global $variavel_campo;
$contador = 0;
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$url_pagina_inicial = PAGINA_INICIAL;
$imagem_sistema[0] = retorne_imagem_sistema(35, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(38, null, false);
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
if($modo_recomendar == true){
		$classe[0] = "classe_link_media_link_recomendar";
	$classe[1] = "classe_link_media_imagem_recomendar";
	$classe[2] = "classe_lista_recomendacoes_medias_recomendar";
}else{
		$classe[0] = "classe_link_media_link";	
	$classe[1] = "classe_link_media_imagem";
	$classe[2] = "classe_lista_recomendacoes_medias";
		$funcao[0] = "carrega_links_medias(\"$idcampo[0]\", \"$idcampo[1]\");";
		$campo_paginar = constroe_paginador_padrao($idcampo[1], $funcao[0]);
		$script[0] = "
	<script>
	$funcao[0]
	</script>
	";
};
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$titulo_musica = $dados[TITULO_MUSICA];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_musica = $dados[URL_HOST_MUSICA];
	$url_host_video = $dados[URL_HOST_VIDEO];
		if($url_host_musica != null){
				$imagem_player = $imagem_sistema[0];
				$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=78&$variavel_campo[42]=$titulo_musica' title='$titulo_musica'>$titulo_musica</a>";
	}else{
				$imagem_player = $imagem_sistema[1];
				$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=82&$variavel_campo[44]=$titulo_video' title='$titulo_video'>$titulo_video</a>";
	};
		if($id != null){
				$html .= "
		<div class='classe_link_media'>
		<div class='$classe[1]'>
		$imagem_player
		</div>
		<div class='$classe[0]'>
		$link[0]
		</div>
		</div>
		";	
	};
};
if($modo_json == true){
		return $html;
};
$html = "
<div class='$classe[2]' id='$idcampo[0]'>
$html
</div>
$campo_paginar
$script[0]
";
return $html;
};
function constroe_player($modo_link, $dados_query){
global $variavel_campo;
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$largura_player = "100%";
$contador = 0;
$html = recurso_medias();
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$titulo_musica = $dados[TITULO_MUSICA];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_musica = $dados[URL_HOST_MUSICA];
	$url_host_video = $dados[URL_HOST_VIDEO];
	$chave = $dados[CHAVE];
	$data = $dados[DATA];
		if($id != null){
				if($url_host_musica != null){
						$source_musica = "
			<source src=\"$url_host_musica\" title='$titulo_musica'></Source>
			";
						if($modo_mobile == true){
								$altura_player = TAMANHO_PLAYER_AUDIO_MOBILE;		
			}else{
								$altura_player = TAMANHO_PLAYER_AUDIO;
			};
						$campo[0] = constroe_opcoes_musica($dados, null);
						if($campo[0] != null){
								$campo_gerenciar = "
				<div class='classe_gerenciar_midia_player'>
				$campo[0]
				</div>
				";
			};
						$html .= "
			<div class='classe_separa_player_musica'>
			$campo_gerenciar
			<div class='classe_separa_player_musica_player'>
			<audio type='audio/mp3' controls='controls' width='$largura_player' height='$altura_player'>
			$source_musica
			</audio>
			</div>
			</div>
			";
		}else{
						$source_video = "
			<source src=\"$url_host_video\" title='$titulo_video'></Source>			
			";
						$campo[0] = constroe_opcoes_video($dados, null);
						if($campo[0] != null){
								$campo_gerenciar = "
				<div class='classe_gerenciar_midia_player'>
				$campo[0]
				</div>
				";
			};
						if($modo_mobile == true){
								$altura_player = TAMANHO_PLAYER_VIDEO_MOBILE;			
			}else{
								$altura_player = TAMANHO_PLAYER_VIDEO;
			};
						$html .= "
			<div class='classe_separa_player_video'>
			$campo_gerenciar
			<div class='classe_separa_player_video_player'>
			<video src='$url_midia' type='video/mp4' controls='controls' width='$largura_player' height='$altura_player'>
			$source_video
			</video>
			</div>
			</div>
			";
		};
	};
};
return $html;
};
function constroe_player_playlist($modo_link, $dados_query){
global $variavel_campo;
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$largura_player = "100%";
$contador = 0;
$html = recurso_medias_playlist();
$idcampo[0] = "mejs";
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$titulo_musica = $dados[TITULO_MUSICA];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_musica = $dados[URL_HOST_MUSICA];
	$url_host_video = $dados[URL_HOST_VIDEO];
	$chave = $dados[CHAVE];
	$data = $dados[DATA];
		if($id != null){
				if($url_host_musica != null){
						$modo_musica = true;
						$playlist_musicas .= "
			<Source src=\"$url_host_musica\" title='$titulo_musica'></Source>
			";
		}else{
						$modo_musica = false;			
						$playlist_videos .= "
			<Source src=\"$url_host_video\" title='$titulo_video'></Source>			
			";
		};
	};
};
if($modo_musica == true){
		if($modo_mobile == true){
				$altura_player = TAMANHO_PLAYER_AUDIO_MOBILE;		
	}else{
				$altura_player = TAMANHO_PLAYER_AUDIO;
	};
		$campo_player = "
	<audio id='$idcampo[0]' type='audio/mp3' controls='controls' width='$largura_player' height='$altura_player'>
	$playlist_musicas
	</audio>
	";
}else{
		if($modo_mobile == true){
				$altura_player = TAMANHO_PLAYER_VIDEO_MOBILE;			
	}else{
				$altura_player = TAMANHO_PLAYER_VIDEO;
	};
		$campo_player = "
	<video id='$idcampo[0]' src='$url_midia' type='video/mp4' controls='controls' width='$largura_player' height='$altura_player'>
	$playlist_videos
	</video>
	";
};
$html .= "
<div class='classe_playlist_usuario'>
$campo_player
</div>
";
return $html;
};
function recurso_medias(){
global $pasta_host_sistema;
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."player_media/";
$script[0] = $pasta_recurso."mediaelementplayer.css";
$script[1] = $pasta_recurso."mediaelement-and-player.min.js";
$campo_script = "
<script>
$(function(){
    $('audio,video').mediaelementplayer({
        loop: false,
        audioHeight: 30,
    });
});
</script>
";
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css'>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
$campo_script
\n
";
return $html;
};
function recurso_medias_playlist(){
global $pasta_host_sistema;
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."player_media/";
$script[0] = $pasta_recurso."mediaelementplayer.css";
$script[1] = $pasta_recurso."mediaelement-and-player.min.js";
$script[2] = $pasta_recurso."mep-feature-playlist.js";
$script[3] = $pasta_recurso."mep-feature-playlist.css";
$campo_script = "
<script>
$(function(){
    $('audio,video').mediaelementplayer({
        loop: false,
        shuffle: true,
        playlist: true,
        audioHeight: 30,
        playlistposition: 'bottom',
        features: ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'playlist', 'current', 'progress', 'duration', 'volume', 'fullscreen'],
    });
});
</script>
";
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
<script type='text/javascript' src='$script[2]'></script>
\n
<link rel='stylesheet' href='$script[3]' type='text/css' media='screen'/>
\n
\n
$campo_script
\n
";
return $html;
};
function atualiza_privacidade_usuario(){
global $variavel_campo;
global $tabela_banco;
global $pagina_inicial;
$array_campos_tabela = explode(",", CAMPO_TABELA_PRIVACIDADE_CORPO);
$contador = 0;
foreach($array_campos_tabela as $campo_tabela){
		if($campo_tabela != null){
        	    $campo_tabela = $array_campos_tabela[$contador];
	    	    $campo_tabela = trata_campo_tabela($campo_tabela, false);
	    	    $campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
				$contador++;
				$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);
				$valor_requeste = converte_minusculo($valor_requeste);
				$valor_requeste = trim($valor_requeste);
		        $campos_atualizar .= $campo_tabela."=\"$valor_requeste\", ";
				$campos_adicionar .= "\"$valor_requeste\", ";
	};
};
$campos_atualizar = substr($campos_atualizar, 0, -2);
$campos_adicionar = substr($campos_adicionar, 0, -2);
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela_banco[12] where uid=\"$idusuario\";";
$query[1] = "update $tabela_banco[12] set $campos_atualizar where uid=\"$idusuario\";";
$query[2] = "insert into $tabela_banco[12] values($idusuario, $campos_adicionar);";
$array_dados = plugin_executa_query($query[0]);
if($array_dados["linhas"] == 0){
		plugin_executa_query($query[2]);
}else{
		plugin_executa_query($query[1]);
};
atualiza_retorna_dados_usuario_sessao(true, true);
chama_pagina_url("$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=2");
};
function constroe_campo_privacidade(){
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){
        return null;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[12]];
$array_campos = explode(",", $idioma_sistema[158]);
$array_campos_tabela = explode(",", CAMPO_TABELA_PRIVACIDADE_CORPO);
$contador = 0;
foreach($array_campos as $campo){
if($campo != null){
		$campo_tabela = $array_campos_tabela[$contador];
		$campo_tabela = trata_campo_tabela($campo_tabela, false);
		$campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
		$valor_campo = $dados_perfil[$campo_tabela];
		$contador++;
		$campo = trata_campo_tabela($campo, false);
		$descricao = $array_campos[$contador - 1];
		if($contador == 11 and $valor_campo == null){
				$valor_campo = true;
	};
		switch($contador){
		case 4:
		$campos_html .= "
		<div class='classe_separa_campo_formulario_edita_privacidade'>
			<textarea cols='10' rows='10' placeholder='$descricao' name='$campo_elemento_nome'>$valor_campo</textarea>
		</div>
		";
		break;
		default: 		$icampo[0] = codifica_md5($campo_elemento_nome.data_atual());
		$icampo[1] = codifica_md5(data_atual().$campo_elemento_nome);
				if($valor_campo == true){
					    $setado = "checked";
		}else{
						$setado = null;
		};
				$eventos[0] = "onchange='seta_valor_checkbox_campo_privacidade(\"$icampo[0]\", \"$icampo[1]\");'";
				$campos_html .= "
		<input type='hidden' name='$campo_elemento_nome' id='$icampo[0]' value='$valor_campo'>
			<div class='classe_separa_campo_formulario_edita_privacidade'>
				<div class='classe_separa_campo_formulario_edita_privacidade_switch'>
					<label class='switch'>
						<input type='checkbox' id='$icampo[1]' $setado $eventos[0]>
						<div class='slider round'></div>
					</label>
				</div>
			<span>
				$descricao
			</span>
		</div>
		";
	};
	};
};
$url_pagina_acoes = PAGINA_ACOES;
$html = "
<div class='classe_edita_perfil_privacidade_titulo classe_cor_3'>$idioma_sistema[159]</div>
	<form action='$url_pagina_acoes' method='POST'>
		<input type='hidden' name='$variavel_campo[2]' value='33'>
		<div class='classe_div_campos_formulario_ed_perfil classe_cor_2'>
			$campos_html
		</div>
		<div class='classe_div_salvar_formulario_ed_perfil cor_borda_div'>
		<input type='submit' value='$idioma_sistema[12]' onclick='executador_acao(null, 3, null);'>
	</form>
</div>
";
return $html;
};
function retorna_configuracao_privacidade($modo, $uid){
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;
if(retorne_usuario_logado() == false){
		return false;
};
if($uid != null){
		$usuario_dono = retorne_usuario_dono_perfil($uid);
}else{
		$usuario_dono = retorne_usuario_dono_perfil(retorne_idusuario_logado());
};
if($uid == null){
        $dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
}else{
		$dados_compilados_usuario = retorne_dados_compilados_usuario($uid);
};
$dados_privacidade = $dados_compilados_usuario[$tabela_banco[12]];
switch($modo){
	case 0: 	$resposta = $dados_privacidade[SOLICITA_EMAIL_ADICIONAR];
	break;
	case 1: 	if(retorne_usuario_amigo($uid) == false and $dados_privacidade[PERFIL_PRIVADO] == true){
				if($usuario_dono == true){
						$resposta = false;
		}else{
						$resposta = true;
		};
	}else{
				$resposta = false;
	};
	break;
	case 2: 	$resposta = $dados_privacidade[BLOQUEIA_PORNOGRAFIA];
	break;
	case 3: 	return $dados_privacidade[BLOQUEIA_PALAVRAS_CHAVE];
	break;
	case 4: 	$resposta = $dados_privacidade[DESLOGAR_AUTOMATICO];
	break;
	case 5: 	$resposta = $dados_privacidade[DESABILITAR_COMENTARIOS];
	break;
	case 6: 	$resposta = $dados_privacidade[DESABILITAR_CURTIDAS];
	break;
	case 7: 	$resposta = null;
	break;
	case 8: 	$resposta = $dados_privacidade[DESABILITAR_DEPOIMENTOS];
	break;
	case 9: 	$resposta = $dados_privacidade[DESABILITAR_CHAT];
	break;
	case 10: 	$resposta = $dados_privacidade[DESABILITAR_COMPARTILHAMENTOS];
	break;
	case 11: 	
		$resposta = $dados_privacidade[DESABILITAR_NOTICIAS];
		if($resposta == null){
				$resposta = true;
	};
	break;
	case 12: 	$resposta = $dados_privacidade[DESABILITAR_NOVIDADES];
	break;
	case 13: 	$resposta = $dados_privacidade["ocultar_barra_atalhos"];
	break;
};
if($resposta == null or $resposta == false){
		return false;
}else{
		return true;
};
};
function retorne_perfil_privado($uid){
if($uid == null){
		if(retorne_modo_pagina() == true){
				return false;
	}else{
				$uid = retorne_idusuario_request();
	};
};
if($uid == null){
		return false;
};
return retorna_configuracao_privacidade(1, $uid) == true;
};
function adicionar_publicacao_atualizar_perfil(){
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;
global $codigos_especiais;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$array_campos = explode(",", $idioma_sistema[10]);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);
$contador = 0;
$dados_novos = false;
foreach($array_campos as $campo){
		if($campo != null){
				$campo_tabela = $array_campos_tabela[$contador];
				$campo_tabela = trata_campo_tabela($campo_tabela, false);
				$campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
				$valor_campo = $dados_perfil[$campo_tabela];
				$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);
				switch(converte_campo_perfil_numero_texto($campo)){
			case 2:
						$valor_requeste = retorne_modo_sexo_usuario($valor_requeste);
			break;
		};
				if($contador == 4){
						$dia = retorne_campo_formulario_request(37);
			$mes = retorne_campo_formulario_request(38);
			$ano = retorne_campo_formulario_request(39);
						$valor_requeste = $dia.$codigos_especiais[10].$mes.$codigos_especiais[10].$ano;
		};
				if($valor_campo != $valor_requeste){
						$lista .= $codigos_especiais[0].$codigos_especiais[4].$campo.$codigos_especiais[5].$idioma_sistema[325].$valor_requeste.$codigos_especiais[1];
						$dados_novos = true;
		};
				$contador++;
	};
};
if($dados_novos == true){
		$array_publicacao[TEXTO] = $codigos_especiais[8].retorne_nome_usuario_logado().$idioma_sistema[324].$codigos_especiais[1].$lista;
};
publicar_conteudo_usuario($array_publicacao, 3);
};
function atualizar_publicacao(){
global $tabela_banco;
$tabela = $tabela_banco[5];
$uid = retorne_idusuario_logado();
$id = retorne_campo_formulario_request(4);
$texto = retorne_campo_formulario_request_htmlentites(36);
if(retorna_usuario_logado_dono_publicacao($id) == false){
		return null;
};
$query = "update $tabela set texto='$texto' where id='$id' and uid='$uid';";
plugin_executa_query($query);
$texto = converter_urls(false, $texto);
$array_retorno["dados"] = $texto;
return json_encode($array_retorno);
};
function campo_gerencia_publicacao($dados, $identificador_publicacao, $idcampo_1){
global $idioma_sistema;
global $tabela_banco;
$array_dados = $dados[0];
$id = $array_dados["id"];
$uid = $array_dados[UID];
$chave = $array_dados[CHAVE];
$texto = $array_dados[TEXTO];
$id_compartilhado = $array_dados[ID_COMPARTILHADO];
$modo = $array_dados[MODO];
$data = $array_dados[DATA];
if($id == null){
    	return null;
};
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$dados_perfil[1] = $dados_compilados_usuario[$tabela_banco[1]];
$nome_usuario = $dados_perfil[1][NOME];
$dialogo_id[0] = codifica_md5("id_dialogo_excluir_publicacao_$id");
$dialogo_id[1] = codifica_md5("id_dialogo_excluir_feed_$id");
$dialogo_excluir_publicacao = "
<div class='classe_texto_caixa_dialogo'>
$nome_usuario$idioma_sistema[35]
</div>
<div class='classe_botao_caixa_dialogo'>
<input type='button' value='$idioma_sistema[32]' onclick='excluir_publicacao_usuario(\"$id\", \"$identificador_publicacao\");'>
</div>
";
if($id_compartilhado == null){
		$link[0] = retorna_link_publicacao_id($id);
}else{
		$link[0] = retorna_link_publicacao_id($id_compartilhado);
};
$dialogo_excluir_publicacao = constroe_dialogo($idioma_sistema[34], $dialogo_excluir_publicacao, $dialogo_id[0]);
if($uid == retorne_idusuario_logado()){
		$campo[0] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_opcao_gerencia_publicacao span_link' onclick='exibe_dialogo(\"$dialogo_id[0]\");'>$idioma_sistema[29]</span>
	</div>
	";
};
$campo[1] = "
<div class='classe_div_opcao_menu_suspense'>
$link[0]
</div>
";
$campo[2] = constroe_campo_edita_publicacao($dados, $idcampo_1);
$campo_editar[0] = $campo[2][0];
$campo_editar[1] = $campo[2][1];
if(retorna_publicacao_pertence_feed($id) == true){
		$campo[3] = "
	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[530]
	</div>
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' onclick='excluir_feed_usuario(\"$id\", \"$identificador_publicacao\");'>
	</div>
	";
		$dialogo_excluir_feed = constroe_dialogo($idioma_sistema[323], $campo[3], $dialogo_id[1]);
		$funcao[0] = "exibe_dialogo(\"$dialogo_id[1]\");";
		$eventos[0] = "onclick='$funcao[0];'";
		$campo[3] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $eventos[0]>$idioma_sistema[323]</span>
	</div>
	";
};
$campo_menu = "
$campo_editar[1]
$campo[0]
$campo[1]
$campo[3]
";
$campo_menu = constroe_menu_suspense(false, null, false, null, "id_menu_gerencia_publicacao_$id", $campo_menu);
$html = "
<div class='classe_div_campo_gerencia_publicacao'>
<div class='classe_div_campo_gerencia_publicacao_menu_suspense'>
$campo_menu
</div>
</div>
$dialogo_excluir_publicacao
$dialogo_excluir_feed
$campo_editar[0]
";
return $html;
};
function carrega_publicacoes_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[5];
$uid = retorne_idusuario_request();
$limit_query = retorne_limit_query_iniciar(false, null);
$pagina = retorne_idpagina_request();
if(retorne_usuario_logado() == false and retorne_modo_pagina() == false){
		return null;
};
if($pagina == null){
		$query = "select *from $tabela where uid='$uid' and pagina='' order by id desc $limit_query;";
}else{
		$query = "select *from $tabela where pagina='$pagina' order by id desc $limit_query;";
};
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$array_dados[0] = $dados;
		$html .= constroe_publicacao($array_dados);
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_campo_anexar_publicacao(){
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$idcampo[0] = codifica_md5("id_menu_suspense_anexar_midia_".retorne_contador_iteracao());
$campo_musica = constroe_campo_anexar_musica(true, $idcampo[0]);
$campo_video = constroe_campo_anexar_videos(true, $idcampo[0]);
$html .= $campo_musica["html"];
$html .= $campo_video["html"];
if($modo_mobile == true){
		$html = constroe_menu_suspense(false, null, true, 122, $idcampo[0], $html);
}else{
		$html = constroe_menu_suspense(false, null, true, 122, $idcampo[0], $html);
};
$html .= $campo_musica["dialogo"];
$html .= $campo_video["dialogo"];
return $html;
};
function constroe_campo_edita_publicacao($dados, $idcampo_1){
global $idioma_sistema;
$array_dados = $dados[0];
$id = $array_dados["id"];
$texto = html_entity_decode($array_dados[TEXTO]);
$modo = $array_dados[MODO];
if($id == null or $modo != 0){
    	return null;
};
if(retorna_usuario_logado_dono_publicacao($id) == false){
		return null;
};
$idcampo[0] = codifica_md5("id_dialogo_editar_publicacao_".$id);
$idcampo[1] = codifica_md5("id_textarea_editar_publicacao_".$id);
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='atualizar_publicacao(\"$id\", \"$idcampo_1\", \"$idcampo[1]\", \"$idcampo[0]\");'";
$campo[0] = "
<span class='span_link' $evento[0]>$idioma_sistema[318]</span>
";
$placeholder[0] = retorne_nome_usuario_logado().$idioma_sistema[319];
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[1], $texto, null, null, $placeholder[0]);
$campo[1] = "
<div class='classe_campo_edita_atualiza_publicacao_texto'>
$campo_entrada
</div>
<div class='classe_campo_edita_atualiza_publicacao_botao'>
<input type='button' value='$idioma_sistema[12]' $evento[1]>
</div>
";
$campo[1] = constroe_dialogo($idioma_sistema[318], $campo[1], $idcampo[0]);
$campo[2] = "
<div class='classe_div_opcao_menu_suspense'>
$campo[0]
</div>
";
$array_retorno[0] = $campo[1];
$array_retorno[1] = $campo[2];
return $array_retorno;
};
function constroe_campo_exibe_publicacoes($idcampo_1){
global $idioma_sistema;
$id_campos[0] = retorna_idcampo_conteudo_geral();
$id_campos[3] = $idcampo_1;
$id_campos[6] = retorna_idcampo_progresso_gif_geral();
$campo_progresso_gif[1] = campo_progresso_gif($id_campos[6]);
$uid = retorne_idusuario_request();
$pagina = retorne_idpagina_request();
if(retorne_modo_pagina() == true){
		if(retorne_numero_publicacoes_pagina($pagina) == 0 and retorne_usuario_dono_pagina($uid, $pagina) == false){
				$nome_pagina = retorne_titulo_pagina_id($pagina);
				$texto[0] = $idioma_sistema[326].$nome_pagina.$idioma_sistema[584];
				$texto[0] = mensagem_sucesso($texto[0]);
	};
}else{
		if(retorne_numero_publicacoes(null) == 0 and retorne_usuario_dono_perfil($uid) == false){
				$nome_usuario = retorne_nome_usuario(true, $uid);
				$texto[0] = $nome_usuario.$idioma_sistema[584];
				$texto[0] = mensagem_sucesso($texto[0]);
	};
};
$html = "
<div class='classe_div_publicacoes_usuario_novas' id='$id_campos[3]'></div>
<div class='classe_div_publicacoes_usuario' id='$id_campos[0]'>
$texto[0]
</div>
$campo_progresso_gif[1]
";
return $html;
};
function constroe_campo_publicar(){
global $idioma_sistema;
global $tabela_banco;
$pagina = retorne_idpagina_request();
$uid = retorne_idusuario_logado();
$campo_publicacoes = constroe_campo_exibe_publicacoes(retorne_idcampo_geral_novas_publicacoes());
if(retorne_pode_exibir_campo_publicar() == false){
		return $campo_publicacoes;
};
$modo_mobile = retorne_modo_mobile();
if($pagina != null){
		$classe[0] = "borda_div_5";
};
$idcampo[1] = retorne_idcampo_textarea_publicar_postagem();
$idcampo[2] = "id_campo_numero_publicacoes";
$idcampo[3] = retorne_idcampo_geral_novas_publicacoes();
$idcampo[4] = "id_div_campo_publicacao_usuario";
$idcampo[5] = "id_campo_progresso_gif_publicacao";
$idcampo[6] = retorne_idcampo_md5();
$idcampo[7] = retorne_idcampo_md5();
$funcao[0] = "publicar_conteudo(\"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$pagina\", \"$idcampo[6]\", \"$idcampo[7]\");";
$evento[0] = "onclick='$funcao[0]'";
$campo_progresso_gif[0] = campo_progresso_gif($idcampo[5]);
if($pagina == null){
		$numero_publicacoes = retorne_numero_publicacoes($uid);
}else{
		$numero_publicacoes = retorne_numero_publicacoes_pagina($pagina);
};
if($numero_publicacoes > 1){
		$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
}else{
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
};
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, "id_formulario_upload_publicacao", "fotos[]", 124, true, 1, "executador_acao(null, 10, \"id_div_exibe_imagens_upload_publicacao\");");
$campo_marcar = constroe_campo_marcar($idcampo[1], retorna_seta_chave_publicacao(false), null, $tabela_banco[5]);
$campo_emoticons = constroe_visualizador_emoticons(true, false, true, $idcampo[1]);
$campo_anexar = constroe_campo_anexar_publicacao();
$campo_previsualizar_musicas = constroe_campo_previsualizar_musicas_publicacao();
$campo_previsualizar_videos = constroe_campo_previsualizar_videos_publicacao();
$campo_addlink = constroe_adicionar_conteudo_url($idcampo[1], $idcampo[6], $idcampo[7]);
$campo_previsualizar_conteudo_url = "
<div class='classe_previsualizar_conteudo_url' id='$idcampo[6]'></div>
";
if(retorne_modo_pagina() == false){
		$campo[0] = constroe_imagem_perfil_miniatura_publicacao(false, $uid);
}else{
		$campo[0] = constroe_imagem_perfil_miniatura_pagina($pagina);
};
$campo[0] = "
<div class='campo_imagem_perfil_campo_publicar'>
$campo[0]
</div>
";
$classe[1] = "classe_div_campo_publicar_separa";
$campo[1] = "
<div class='$classe[1]'>
$campo_anexar
</div>
<div class='$classe[1]'>
$campo_emoticons
</div>
<div class='$classe[1]'>
$campo_addlink
</div>
<div class='$classe[1]'>
$campo_marcar
</div>
";
$campo[2] = "
<div class='classe_div_numero_publicacoes' id='$idcampo[2]'>
$numero_publicacoes
</div>
";
if($modo_mobile == false){
		$campo[3] = "
	<div class='classe_div_campo_opcoes_publicar_perfil'>
	$campo[0]
	$campo[2]
	</div>
	";
};
$campo[4] = constroe_campo_div_editavel($modo_mobile, $idcampo[1], null, "classe_div_campo_publicar_texto_entrada", null, $idioma_sistema[25]);
$campo[4] = "
<div class='classe_div_campo_publicar_texto'>
$campo[4]
</div>
";
$campo[5] = "
<div class='classe_div_campo_publicar_postar'>
<span class='botao_padrao' $evento[0]>
$idioma_sistema[26]
</span>
</div>
";
$campo[6] = "
<div class='classe_div_campo_publicar_opcoes_postagem'>
<div class='classe_div_exibe_imagens_upload_publicacao' id='id_div_exibe_imagens_upload_publicacao'>
</div>
$campo_previsualizar_musicas
$campo_previsualizar_videos
$campo_previsualizar_conteudo_url
<div class='classe_div_campo_opcoes_publicar'>
<div class='classe_div_campo_publicar_imagens'>
$campo_upload_imagem
</div>
</div>
$campo[5]
</div>
";
$campo_publicar = "
<div class='classe_div_campo_publicar $classe[0]' id='$idcampo[4]'>
$campo[3]
<div class='classe_div_campo_opcoes_publicar_centro'>
$campo[1]
$campo[4]
$campo[6]
</div>
</div>
";
$html = "
$campo_publicar
$campo_progresso_gif[0]
$campo_publicacoes
";
return $html;
};
function constroe_imagens_publicacao($chave, $modo, $uid){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[4];
$query = "select *from $tabela where uid='$uid' and chave='$chave' order by id desc;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$contador[0] = 0;
$contador[1] = 0;
switch($modo){
	case 0:
		$classe[0] = "classe_separa_imagem_publicacao_previsualiza";
	break;
	case 1:
	if($linhas > 1){
				$classe[0] = "classe_separa_imagem_publicacao";
	}else{
				$classe[0] = "classe_separa_imagem_publicacao_unica";
	};
	break;
};
for($contador[0] == $contador[0]; $contador[0] <= $linhas; $contador[0]++){
		$dados = $dados_query["dados"][$contador[0]];
	    $id = $dados["id"];
		if($id != null){
				$html = constroe_imagem_album_dados($dados, $modo, null);
				if($linhas == 1){
						$bloco[0][$contador[0]] = $html;
		}else{
						switch($contador[1]){
				case 0:
								$bloco[0][$contador[0]] = $html;
								$contador[1]++;
				break;
				case 1:
								$bloco[1][$contador[0]] = $html;
								$contador[1] = 0;
				break;
			};
		};
	};
};
$html = null;
if($linhas == 1){
		foreach($bloco[0] as $campo){
				$html[0] .= $campo;
	};
}else{
		foreach($bloco[0] as $campo){
				$html[0] .= $campo;
	};
		foreach($bloco[1] as $campo){
				$html[1] .= $campo;
	};	
};
switch($modo){
	case 0:
		$html = "
	<div class='$classe[0]'>
	$html[0]
	$html[1]
	</div>
	";	
	break;
	case 1:
		$html = "
	<div class='$classe[0]'>$html[0]</div>
	<div class='$classe[0]'>$html[1]</div>
	";	
	break;
};
return $html;
};
function constroe_publicacao($dados){
global $idioma_sistema;
global $tabela_banco;
$usuario_logado = retorne_usuario_logado();
$array_dados = $dados[0];
$id_compartilhado = $array_dados[ID_COMPARTILHADO];
$id_post = $array_dados["id"];
$uid = $array_dados[UID];
if($id_compartilhado != null){
		$pagina = retorne_idpagina_postagem($id_compartilhado);
		if($pagina == null){
				$uid = retorne_idusuario_dono_publicacao($id_compartilhado);
	};
		$idusuario = $array_dados[UID];
		$nome_link = retorne_nome_link_usuario(true, $uid);
		$id = $array_dados["id"];
		$array_dados = retorne_dados_publicacao($id_compartilhado);
		$array_dados["id"] = $id;
		$imagem_sistema[0] = retorne_imagem_sistema(33, null, false);
		$campo[0] = "
	<div class='classe_informa_publicacao_compartilhada'>
	<div class='classe_informa_publicacao_compartilhada_imagem'>
	$imagem_sistema[0]
	</div>
	<div class='classe_informa_publicacao_compartilhada_nome_link'>
	$nome_link 
	</div>
	</div>
	";
};
$id = $array_dados["id"];
$uid = $array_dados[UID];
$pagina = $array_dados[PAGINA];
$chave = $array_dados[CHAVE];
$texto = $array_dados[TEXTO];
$data = $array_dados[DATA];
$id_compartilhado = $array_dados[ID_COMPARTILHADO];
if($id == null){
    	return null;
};
adiciona_visualizado($id, $tabela_banco[5]);
if($usuario_logado == false and $pagina == ''){
		return mensagem_erro($idioma_sistema[524]);
};
if(retorna_conteudo_bloqueado($texto) == true){
		$texto = converte_improprio($texto);
};
$modo_mobile = retorne_modo_mobile();
$identificador_publicacao = codifica_md5("identificador_publicacao".$id.$uid);
$idcampo[0] = codifica_md5("id_conteudo_publicacao_".$id.$uid);
$campo_imagens = constroe_imagens_publicacao($chave, 1, $uid);
if($pagina == null){
		if($idusuario != null){
				$imagem_perfil = constroe_imagem_perfil_miniatura_publicacao(false, $idusuario);
				$nome_link = retorne_nome_link_usuario(true, $idusuario);
	}else{
				$imagem_perfil = constroe_imagem_perfil_miniatura_publicacao(false, $uid);
				$nome_link = retorne_nome_link_usuario(true, $uid);
	};
}else{
        $imagem_perfil = constroe_imagem_perfil_miniatura_pagina($pagina);
		$nome_link = retorne_nome_link_pagina($pagina);
};
$campo_gerencia_publicacao = campo_gerencia_publicacao($dados, $identificador_publicacao, $idcampo[0]);
$texto = converter_urls(false, $texto);
$campo_social = constroe_campo_social(1, $id_post, true, $uid);
$campo_marcacao = constroe_marcacoes_usuarios($id_post, $tabela_banco[5]);
$campo_data = constroe_data_conteudo($data);
$campo_musicas = constroe_musicas_publicacao($chave);
$campo_videos = constroe_videos_publicacao($chave);
$campo_conteudo_url = constroe_conteudo_publicacao_conteudo_url($chave, false);
$texto = encurta_texto($texto, NUMERO_CARACTERES_OCULTAR_TEXTO_POST);
$campo_data = "
<div class='classe_div_publicacao_data'>
$campo_data
</div>
";
if($modo_mobile == true){
		$campo[2] = $campo_data;
}else{
		$campo[1] = $campo_data;
};
$html = "
<div class='classe_div_publicacao borda_div_5' id='$identificador_publicacao'>
$campo[1]
<div class='classe_div_publicacao_topo'>
<div class='classe_div_publicacao_topo_perfil'>
$imagem_perfil
</div>
<div class='classe_div_publicacao_topo_nome'>
$nome_link
</div>
</div>
$campo[2]
<div class='classe_campo_meio_publicacao'>
$campo[0]
<div class='classe_div_publicacao_topo_gerencia'>$campo_gerencia_publicacao</div>
$campo_marcacao
<div class='classe_div_publicacao_texto' id='$idcampo[0]'>
$texto
$campo_conteudo_url
</div>
<div class='classe_div_publicacao_imagem'>$campo_imagens</div>
$campo_musicas
$campo_videos
$campo_social
</div>
</div>
";
return $html;
};
function excluir_publicacao_modo($id, $modo){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela_banco[5] where id!='$id' and uid='$idusuario' and modo='$modo';";
$contador = 0;
$dados_query = plugin_executa_query($query);
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
		if($id != null){
				excluir_publicacao_usuario($id, false);	
	};
};
};
function excluir_publicacao_usuario($id, $modo){
global $tabela_banco;
global $idioma_sistema;
if($modo == true){
		$idusuario = retorne_idusuario_dono_publicacao($id);
}else{
		$idusuario = retorne_idusuario_logado();	
};
if(retorne_usuario_logado() == false){
	    return null;
};
$pagina = retorne_idpagina_request();
$query[0] = "select *from $tabela_banco[5] where id='$id' and uid='$idusuario';";
$query[1] = "delete from $tabela_banco[5] where id='$id' and uid='$idusuario';";
if($pagina == null){
		$query[2] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='';";
}else{
		$query[2] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='$pagina';";
};
$dados_publicacao = plugin_executa_query($query[0]);
exclui_imagens_chave($dados_publicacao["dados"][0][CHAVE]);
excluir_todos_comentarios($id, $tabela_banco[5]);
exclui_curtidas_publicacao($id, $tabela_banco[5]);
plugin_executa_query($query[1]);
atualiza_retorna_dados_usuario_sessao(true, true);
erradicar_feeds_usuario(false, $id, null);
remove_marcacao_usuario($id, $tabela_banco[5]);
excluir_musica_usuario($id, $dados_publicacao["dados"][0][CHAVE]);
excluir_video_usuario($id, $dados_publicacao["dados"][0][CHAVE]);
exclui_conteudo_url($dados_publicacao["dados"][0][CHAVE]);
remove_visualizado($id, $tabela_banco[5]);
$dados_publicacao = plugin_executa_query($query[2]);
$numero_publicacoes = $dados_publicacao["linhas"];
if($numero_publicacoes > 1){
		$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
}else{
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
};
$array_retorno["linhas"] = $numero_publicacoes;
remove_notifica(null, $id, $tabela_banco[5], true);
return json_encode($array_retorno);
};
function publicar_conteudo_usuario($array_publicacao, $modo){
global $idioma_sistema;
global $tabela_banco;
if(retorne_usuario_logado() == false){
	    return null;
};
$id_compartilhado = $array_publicacao[ID_COMPARTILHADO];
$idusuario = retorne_idusuario_logado();
$pagina = retorne_idpagina_request();
if($pagina != null and retorne_usuario_dono_pagina($idusuario, $pagina) == false){
		if($modo == 4){
				$pagina = null;
	}else{
				return null;
	};
};
upload_imagem_album(9);
if(is_array($array_publicacao) == true){
		$texto = trata_html_requeste($array_publicacao[TEXTO]);
		$chave = retorna_seta_chave_publicacao(true);	
}else{
		$texto = trata_html_requeste($_REQUEST["campo_texto"]);
		$chave = retorna_chave_request();	
};
if($array_publicacao == -1){
		$texto = null;
		$chave = null;
};
if(($texto == null and $id_compartilhado == null and retorne_id_conteudo_url($chave) == null and retorne_numero_imagens_album_chave($chave) == 0) or $chave == null){
		$numero_publicacoes = retorne_numero_publicacoes(null);
		if($numero_publicacoes > 1){
				$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
				$numero_publicacoes = "
		<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
		<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
		";
	}else{
				$numero_publicacoes = "
		<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
		<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
		";
	};
		$array_retorno["linhas"] = $numero_publicacoes;
		return json_encode($array_retorno);
};
$data = data_atual();
$query[0] = "insert into $tabela_banco[5] values(null, '$idusuario', '$pagina', '$chave', '$texto', '$id_compartilhado', '$modo', '$data');";
if($pagina == null){
		$query[1] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='' order by id desc;";
}else{
		$query[1] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='$pagina' order by id desc;";
};
plugin_executa_query($query[0]);
$array_publicacao = plugin_executa_query($query[1]);
$idpost = $array_publicacao["dados"][0]["id"];
$numero_publicacoes = $array_publicacao["linhas"];
if($numero_publicacoes > 1){
		$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
}else{
		$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
};
if($modo != 0 and $modo != 4){
		excluir_publicacao_modo($idpost, $modo);
};
erradicar_feeds_usuario(true, $array_publicacao["dados"][0]["id"], $idusuario);
erradicar_feeds_pagina_usuario(true, $array_publicacao["dados"][0]["id"], $idusuario, $pagina);
erradicar_marcacoes_usuarios($idpost);
atualiza_publicado_conteudo_url($chave);
atualiza_retorna_dados_usuario_sessao(true, true);
$array_retorno["dados"] = constroe_publicacao($array_publicacao["dados"]);
$array_retorno["linhas"] = $numero_publicacoes;
$array_retorno[CHAVE] = retorna_seta_chave_publicacao(true);
return json_encode($array_retorno);
};
function retorna_link_publicacao_id($id){
global $variavel_campo;
global $idioma_sistema;
$link = PAGINA_INICIAL."?$variavel_campo[29]=$id";
$link = "<a href='$link' title='$idioma_sistema[285]'>$idioma_sistema[285]</a>";
return $link;
};
function retorna_link_referencia_publicacao_id($id, $conteudo){
global $variavel_campo;
$link = PAGINA_INICIAL."?$variavel_campo[29]=$id";
$link = "<a href='$link' title='$conteudo'>$conteudo</a>";
return $link;
};
function retorna_usuario_logado_dono_publicacao($id){
global $tabela_banco;
$tabela = $tabela_banco[5];
$uid = retorne_idusuario_logado();
$query = "select *from $tabela where id='$id' and uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"] == 1;
};
function retorne_array_ids_ultimas_publicacoes_usuario($uid, $modo){
global $tabela_banco;
$tabela = $tabela_banco[5];
if($modo == true){
		$limit_query = "limit ".NUMERO_LIMITE_ULTIMAS_PUBLICACOES_USUARIO;
};
$query = "select *from $tabela where uid='$uid' order by id asc $limit_query;";
$dados_query = plugin_executa_query($query);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$pagina = $dados[PAGINA];
		if($id != null and $pagina == null){
				$array_retorno[] = $id;
	};
};
return $array_retorno;
};
function retorne_dados_publicacao($id_post){
global $tabela_banco;
$query = "select *from $tabela_banco[5] where id='$id_post';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_idcampo_geral_novas_publicacoes(){
return codifica_md5("id_div_novas_publicacoes_usuario");
};
function retorne_idcampo_textarea_publicar_postagem(){
return "id_textarea_texto_publicacao";
};
function retorne_idpublicacao_requeste(){
global $variavel_campo;
return $_REQUEST[$variavel_campo[29]];
};
function retorne_idusuario_dono_publicacao($id){
$dados = retorne_dados_publicacao($id);
return $dados[UID];
};
function retorne_numero_publicacoes($uid){
global $tabela_banco;
if($uid == null){
		$uid = retorne_idusuario_request();
};
if($uid == null){
		return 0;
};
$tabela = $tabela_banco[5];
$query = "select *from $tabela where uid='$uid' and pagina='';";
return retorne_numero_linhas_query($query);
};
function retorne_pode_exibir_campo_publicar(){
$pagina = retorne_idpagina_request();
if(retorne_usuario_logado() == false){
    	return false;
};
if($pagina != null and retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false){
    	return false;
};
if($pagina == null and retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){
    	return false;
};
return true;
};
function retorne_publicacao_id($id){
global $tabela_banco;
$query = "select *from $tabela_banco[5] where id='$id' or id_compartilhado='$id';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return mensagem_conteudo_indisponivel();
};
return constroe_publicacao($dados_query["dados"]);
};
function carrega_recomendacoes_usuarios(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[37];
$uid = retorne_idusuario_logado();
$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$campo[0] = constroe_imagem_perfil_medio($uidamigo);
				$campo[0] = "
		<div class='classe_separa_usuario_recomendado'>
		$campo[0]
		</div>
		";
				$html .= $campo[0];
	};
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$imagem_sistema[0] = retorne_imagem_sistema(83, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(84, null, false);
$funcao[0] = "paginar_recomendacoes_usuario(0, \"$idcampo[0]\", \"$idcampo[1]\");";
$funcao[1] = "paginar_recomendacoes_usuario(1, \"$idcampo[0]\", \"$idcampo[1]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";
$progresso[0] = campo_progresso_gif($idcampo[1]);
$campo[0] = "
<div class='classe_paginar_recomendacoes_usuarios_progresso'>
$progresso[0]
</div>
<div class='classe_paginar_recomendacoes_usuarios classe_cor_29'>
<div class='classe_paginar_recomendacoes_usuarios_separa' $evento[0]>
$imagem_sistema[0]
</div>
<div class='classe_paginar_recomendacoes_usuarios_separa' $evento[1]>
$imagem_sistema[1]
</div>
</div>
";
$html = "
<div class='classe_recomendacoes_novos_amigos'>
<div class='classe_usuarios_recomendar_usuario' id='$idcampo[0]'>
$html
</div>
$campo[0]
</div>
";
return $html;
};
function erradicar_recomendacoes(){
global $tabela_banco;
$array_amigos = array();
$data = data_atual();
$tabela[0] = $tabela_banco[1];
$tabela[1] = $tabela_banco[37];
$tabela[2] = $tabela_banco[6];
$dados_perfil = retorne_dados_perfil_usuario_logado();
$cidade = $dados_perfil[CIDADE];
$estado = $dados_perfil[ESTADO];
if($cidade == null or $estado == null){
		return null;
};
$uid = retorne_idusuario_logado();
$query = "select *from $tabela[1] where uid='$uid' limit 1;";
$dados_query = plugin_executa_query($query);
$dados_query = $dados_query["dados"][0];
$contador[0] = $dados_query[CONTADOR];
if($contador[0] == null){
		$contador[0] = 0;
};
$limit = "limit $contador[0], ".NUMERO_RECOMENDACOES_ERRADICAR_USUARIOS;
$contador[0] += NUMERO_RECOMENDACOES_ERRADICAR_USUARIOS;
$query = "select *from $tabela[2] where uid='$uid' or uidamigo='$uid' order by uid desc $limit;";
$contador[1] = 0;
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
for($contador[1] == $contador[1]; $contador[1] <= $linhas; $contador[1]++){
		$dados = $dados_query["dados"][$contador[1]];
		if($dados["id"] != null){
				$uidamigo = retorne_idamigo_dados_amigo(false, $dados, $uid);
				if($uidamigo == null){
						$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $uid);
		};
				if($uidamigo != null){
						$array_amigos[] = $uidamigo;
		};
	};
};
$query = "select *from $tabela[0] where (cidade like '%$cidade%' and estado like '%$estado%' and uid!='$uid') order by uid desc $limit;";
$contador[1] = 0;
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
for($contador[1] == $contador[1]; $contador[1] <= $linhas; $contador[1]++){
		$dados = $dados_query["dados"][$contador[1]];
		if($dados[UID] != null){
				$uid_tabela = $dados[UID];
				if(retorne_elemento_array_existe($array_amigos, $uid_tabela) == false){
						$query = "select *from $tabela[1] where uid='$uid' and uidamigo='$uid_tabela';";
						if(retorne_numero_linhas_query($query) == 0 and retorne_usuario_bloqueio($uid_tabela) == false){
								$query = "insert into $tabela[1] values(null, '$uid', '$uid_tabela', '0', '$contador[0]', '$data');";
								plugin_executa_query($query);
			};
		};
	};
};
if($linhas > 0){
		$query = "update $tabela[1] set contador='$contador[0]' where uid='$uid';";
		plugin_executa_query($query);
};
};
function paginar_recomendacoes_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[37];
$modo = retorne_campo_formulario_request(6);
$tipo_acao = retorne_tipo_acao_pagina();
$uid = retorne_idusuario_logado();
if($modo == true){
		$limit = "limit ".contador_avanco($tipo_acao, 8).", ".NUMERO_RECOMENDACOES_INICIO;
}else{
		$limit = "limit ".contador_avanco($tipo_acao, 9).", ".NUMERO_RECOMENDACOES_INICIO;
};
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		contador_avanco($tipo_acao, 9);
		$array_retorno["limpar_dados_antigos"] = 0;
		return json_encode($array_retorno);
};
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
				$campo[0] = constroe_imagem_perfil_medio($uidamigo);
				$campo[0] = "
		<div class='classe_separa_usuario_recomendado'>
		$campo[0]
		</div>
		";
				$html .= $campo[0];
	};
};
$array_retorno["dados"] = $html;
$array_retorno["limpar_dados_antigos"] = 1;
return json_encode($array_retorno);
};
function remover_recomendacoes_usuario(){
global $tabela_banco;
$tabela = $tabela_banco[37];
$uid = retorne_idusuario_logado();
$query = "delete from $tabela where uid='$uid';";
plugin_executa_query($query);
};
function constroe_campo_recupera_senha($modo){
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
if(retorne_usuario_logado() == true){
		return null;
};
$modo_mobile = retorne_modo_mobile();
$url[0] = $pagina_inicial."?$variavel_campo[2]=113";
if($modo_mobile == true){
		$classe[0] = "span_link";
}else{
		$classe[0] = "span_link_2";	
};
if($modo == false){
		$html = "
	<div class='classe_campo_recupera_senha_link'>
	<a href='$url[0]' title='$titulo_link' class='$classe[0]'>$idioma_sistema[444]</a>
	</div>
	";	
		return $html;
};
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$funcao[0] = "envia_redefinir_senha(\"$idcampo[0]\", \"$idcampo[1]\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$campo[0] = "
<div class='classe_campo_recupera_senha_campos'>
<div class='classe_campo_recupera_senha_campos_descreve'>
$idioma_sistema[440]
</div>
<div class='classe_campo_recupera_senha_campos_mensagem' id='$idcampo[1]'></div>
<div class='classe_campo_recupera_senha_campos_separa_1'>
<input type='email' placeholder='$idioma_sistema[438]' id='$idcampo[0]' $evento[1]>
</div>
<div class='classe_campo_recupera_senha_campos_separa_2'>
<input type='button' value='$idioma_sistema[439]' $evento[0]>
</div>
</div>
";
$html = "
<div class='classe_campo_recupera_senha'>
$campo[0]
</div>
";
return constroe_caixa_descritiva($idioma_sistema[444], $html, null);
};
function constroe_recuperar_alterar_senha(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[31];
$chave = retorna_chave_request();
$query = "select *from $tabela where chave='$chave';";
$dados_query = plugin_executa_query($query);
$classe[0] = "classe_conteudo_centro_padrao";
if($dados_query["linhas"] == 0){
		$mensagem[0] = mensagem_erro($idioma_sistema[449]);
		$html = "
	<div class='$classe[0]'>
	$mensagem[0]
	</div>
	";
		return $html;
};
$campo[0] = formulario_altera_senha();
$html = "
<div class='$classe[0]'>
$campo[0]
</div>
";
return $html;
};
function envia_redefinir_senha(){
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;
$email = retorne_campo_formulario_request(33);
$email = trim($email);
if(verifica_se_email_valido($email) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
		return json_encode($array_retorno);
};
if(retorne_email_cadastrado($email) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[447].$email.$idioma_sistema[448]);
		return json_encode($array_retorno);	
};
$tabela = $tabela_banco[31];
$url_inicio = PAGINA_INDEX_INICIO;
if(retorne_usuario_logado() == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[446]);
		return json_encode($array_retorno);
};
$data_hoje = retorne_data_dia_mes_ano();
$query = "select *from $tabela where email='$email';";
$dados_query = plugin_roda_query($query);
$dados = $dados_query["dados"][0];
$id = $dados["id"];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];
$chave = $dados[CHAVE];
if($tentativas >= NUMERO_REENVIAR_RECUPERA_SENHA_DIA and $data == $data_hoje){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[441]);
		return json_encode($array_retorno);	
};
$chave = codifica_md5($data.retorne_contador_iteracao());
if($data == $data_hoje){
		$tentativas++;
}else{
		$tentativas = 1;
};
if($dados_query["linhas"] == 0){
		$query = "insert into $tabela values(null, '$email', '$chave', '$tentativas', '$data_hoje');";
}else{
		$query = "update $tabela set tentativas='$tentativas', data='$data_hoje' where email='$email';";
};
plugin_roda_query($query);
$url[0] = "$url_inicio?$variavel_campo[2]=102&$variavel_campo[3]=$chave";
$mensagem[0] = "
$idioma_sistema[445]
<br>
<br>
$url[0]
";
$assunto_mensagem = $idioma_sistema[437].NOME_SISTEMA;
enviar_email($email, $assunto_mensagem, $mensagem[0]);
$array_retorno["dados"] = mensagem_sucesso($idioma_sistema[442].$email.$idioma_sistema[443]);
return json_encode($array_retorno);
};
function nova_senha(){
global $idioma_sistema;
global $tabela_banco;
$chave_requeste = retorna_chave_request();
$nova_senha = converte_minusculo(retorne_campo_formulario_request(16));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(17));
$dados = retorne_dados_chave($chave_requeste, $tabela_banco[31]);
$email = $dados[EMAIL];
$data = data_atual();
if($nova_senha != $nova_senha_confirma){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[450]);
		return json_encode($array_retorno);
};
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[451].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
		return json_encode($array_retorno);
};
$nova_senha = codifica_md5($nova_senha);
$idusuario = retorne_idusuario_email($email);
$query[0] = "update $tabela_banco[0] set senha='$nova_senha', data='$data' where uid='$idusuario' and e_mail='$email';";
$query[1] = "delete from $tabela_banco[31] where email='$email';";
plugin_roda_query($query[0]);
plugin_roda_query($query[1]);
$array_retorno["dados"] = 1;
salva_sessao_usuario($email, $nova_senha, $idusuario);
return json_encode($array_retorno);
};
function remove_recuperar_senha_logar(){
global $tabela_banco;
$tabela = $tabela_banco[31];
$data_hoje = retorne_data_dia_mes_ano();
$email = retorna_email_usuario_logado();
$query = "select *from $tabela where email='$email';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
$data = $dados[DATA];
if($data != $data_hoje){
		$query = "delete from $tabela where email='$email';";
		plugin_executa_query($query);
};
};
function campo_recortar_imagem($dados, $modo){
global $idioma_sistema;
global $variavel_campo;
$url_host_grande = $dados[URL_HOST_GRANDE];
if($url_host_grande == null){
		return null;
};
$url_pagina = PAGINA_ACOES;
$pagina_acao = 70;
$recurso[0] = jcrop();
$id_pagina = retorne_idpagina_request();
if($id_pagina != null and retorne_usuario_logado_dono_pagina($id_pagina) == false){
		return null;
};
$html = "
$recurso[0]
<div class='classe_painel_recortar_imagem'>
<div class='classe_painel_recortar_imagem_imagem'>
<img src='$url_host_grande' id='cropbox'>
</div>
<div class='classe_painel_recortar_imagem_formulario'>
<form action='$url_pagina' method='post' enctype='multipart/form-data' onsubmit='return checkCoords();'>
<input type='hidden' id='x' name='x'>
<input type='hidden' id='y' name='y'>
<input type='hidden' id='w' name='w'>
<input type='hidden' id='h' name='h'>
<input type='hidden' name='$variavel_campo[2]' value='$pagina_acao'>
<input type='hidden' name='$variavel_campo[25]' value='$id_pagina'>
<input type='hidden' name='$variavel_campo[6]' value='$modo'>
<input type='submit' value='$idioma_sistema[297]'>
</form>
</div>
</div>
";
return $html;
};
function campo_redimensionar_imagem($conteudo, $modo){
global $idioma_sistema;
global $variavel_campo;
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){
		return $conteudo;
};
$idcampo[0] = codifica_md5("id_campo_redimensiona_imagem_".$modo.retorne_contador_iteracao().data_atual());
$evento[0] = "onmousemove='opacidade_elemento(\"$idcampo[0]\", 0);'";
$evento[1] = "onmouseout='opacidade_elemento(\"$idcampo[0]\", 1);'";
$imagem[0] = retorne_imagem_sistema(31, null, false);
$campo[0] = "
<div class='classe_campo_redimensionar_imagem_conteudo'>
$conteudo
</div>
";
switch($modo){
	case 0:
		$url_link[0] = PAGINA_INICIAL."?".$variavel_campo[2]."=105";
		$campo_opcao[0] = "
	<span class='opcao_campo_redimensionar_imagem_opcoes_imagem'>
	<a href='$url_link[0]'>$imagem[0]</a>
	</span>
	<span class='opcao_campo_redimensionar_imagem_opcoes_descreve'>
	<a href='$url_link[0]'>$idioma_sistema[296]</a>
	</span>	
	";
	break;
	case 1:
		$url_link[0] = PAGINA_INICIAL."?".$variavel_campo[25]."=".retorne_idpagina_request()."&".$variavel_campo[6]."=".MODO_RECORTAR_IMAGEM_PAGINA;
		$campo_opcao[0] = "
	<span class='opcao_campo_redimensionar_imagem_opcoes_imagem'>
	<a href='$url_link[0]'>$imagem[0]</a>
	</span>
	<span class='opcao_campo_redimensionar_imagem_opcoes_descreve'>
	<a href='$url_link[0]'>$idioma_sistema[296]</a>
	</span>	
	";
	break;
};
$campo[1] = "
<div class='classe_campo_redimensionar_imagem_opcoes' id='$idcampo[0]'>
$campo_opcao[0]
</div>
";
$html = "
<div class='classe_campo_redimensionar_imagem' $evento[0] $evento[1]>
$campo[0]
$campo[1]
</div>
";
return $html;
};
function constroe_imagem_redimensionar($modo){
switch($modo){
	case 0:
	$dados = retorne_dados_imagem_usuario($modo, retorne_idusuario_logado());
	break;
	case 1:
	$dados = retorne_dados_imagem_usuario($modo, retorne_idpagina_request());
	break;
};
$html = campo_recortar_imagem($dados, $modo);
if($modo == 1){
		return $html;
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function jcrop(){
global $pasta_host_sistema;
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."jcrop/";
$script[0] = $pasta_recurso."jquery.Jcrop.min.css";
$script[1] = $pasta_recurso."jquery.color.js";
$script[2] = $pasta_recurso."jquery.Jcrop.min.js";
$campo_script = "
<script language='javascript'>
$(function(){
$('#cropbox').Jcrop({aspectRatio: 0.75, onSelect: updateCoords, boxWidth: 310, boxHeight: 310});
});
function updateCoords(c){
$('#x').val(c.x);
$('#y').val(c.y);
$('#w').val(c.w);
$('#h').val(c.h);
};
function checkCoords(){
if(document.getElementById('w').value.length == 0){
return false;
};
};
</script>
";
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
<script type='text/javascript' src='$script[2]'></script>
\n
$campo_script
\n
";
return $html;
};
function recorta_imagem(){
$modo = retorne_campo_formulario_request(6);
switch($modo){
	case 0:
		$id = retorne_idusuario_logado();
	break;
	case 1:
		$id = retorne_idpagina_request();
		if(retorne_usuario_logado_dono_pagina($id) == false){
				chama_pagina_usuario($id);
				return null;
	};
	break;
};
$dados_imagem = retorne_dados_imagem_usuario($modo, $id);
$url_root_grande = $dados_imagem['url_root_grande'];
$url_root_miniatura = $dados_imagem['url_root_miniatura'];
$url_root_normal = $dados_imagem['url_root_normal'];
$url_root_medio = $dados_imagem['url_root_medio'];
$url_root_mobile = $dados_imagem['url_root_mobile'];
$dados_dimensao[0] = retorne_dimensoes_imagem($url_root_normal);
$dados_dimensao[1] = retorne_dimensoes_imagem($url_root_grande);
$dados_dimensao[2] = retorne_dimensoes_imagem($url_root_medio);
$dados_dimensao[3] = retorne_dimensoes_imagem($url_root_mobile);
$altura[0] = $dados_dimensao[0]["altura"];
$largura[0] = $dados_dimensao[0]["largura"];
$altura[1] = $dados_dimensao[1]["altura"];
$largura[1] = $dados_dimensao[1]["largura"];
$altura[2] = $dados_dimensao[2]["altura"];
$largura[2] = $dados_dimensao[2]["largura"];
$altura[3] = $dados_dimensao[3]["altura"];
$largura[3] = $dados_dimensao[3]["largura"];
$altura_mapa = $_POST['h']; $largura_mapa = $_POST['w']; 
$largura_nova = ($altura[0] * $altura_mapa) / $altura[1];
$altura_nova = ($largura[0] * $largura_mapa) / $largura[1];
$targ_w[0] = $altura_nova;
$targ_h[0] = $largura_nova;
exclui_arquivo_unico($url_root_grande);
exclui_arquivo_unico($url_root_miniatura);
exclui_arquivo_unico($url_root_medio);
exclui_arquivo_unico($url_root_mobile);
copy($url_root_normal, $url_root_grande);
copy($url_root_normal, $url_root_miniatura);
copy($url_root_normal, $url_root_medio);
copy($url_root_normal, $url_root_mobile);
$porcentagem = ($altura[0] * 100) / $altura[1];
$_POST['x'] *= $porcentagem / 100;
$_POST['y'] *= $porcentagem / 100;
$_POST['w'] *= $porcentagem / 100;
$_POST['h'] *= $porcentagem / 100;
$src[0] = $url_root_normal;
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);
imagejpeg($dst_r[0], $url_root_grande);
imagejpeg($dst_r[0], $url_root_miniatura);
imagejpeg($dst_r[0], $url_root_normal);
imagejpeg($dst_r[0], $url_root_medio);
imagejpeg($dst_r[0], $url_root_mobile);
resize_imagem(TAMANHO_IMAGEM_PERFIL_NORMAL, $url_root_grande, $url_root_grande);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MINIATURA, $url_root_miniatura, $url_root_miniatura);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MEDIO, $url_root_medio, $url_root_medio);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MOBILE, $url_root_mobile, $url_root_mobile);
switch($modo){
	case 0:
	chama_pagina_inicial();
	break;
	case 1:
	chama_pagina_usuario($id);
	break;
};
};
function resize_imagem($largura, $imagem, $imagem_salvar){
$dados_imagem = getimagesize($imagem);
switch($dados_imagem['mime']){
    case 'image/jpeg':
    $image_create_func = 'imagecreatefromjpeg';
	$imagem_salvar_func = 'imagejpeg';
    break;
    case 'image/png':
    $image_create_func = 'imagecreatefrompng';
	$imagem_salvar_func = 'imagepng';
    break;
    case 'image/gif':
    $image_create_func = 'imagecreatefromgif';
	$imagem_salvar_func = 'imagegif';
    break;
	default:
	$image_create_func = 'imagecreatefromjpeg';
	$imagem_salvar_func = 'imagejpeg';
};
$imagem_original = $image_create_func($imagem);
imageinterlace($imagem_original, true);
list($largura_antiga, $altura_antiga) = getimagesize($imagem);
$altura = ($altura_antiga / $largura_antiga) * $largura;
$imagem_tmp = imagecreatetruecolor($largura, $altura);
imagecopyresampled($imagem_tmp, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_antiga, $altura_antiga);
$resultado = $imagem_salvar_func($imagem_tmp, $imagem_salvar, 100);
imagedestroy($imagem_original);
imagedestroy($imagem_tmp);
};
function retorne_dimensoes_imagem($root_imagem){
list($width, $height) = getimagesize($root_imagem);
$dados["largura"] = $width;
$dados["altura"] = $height;
return $dados;
};
function retorne_extensao_imagem_mime($imagem){
$dados_imagem = getimagesize($imagem);
$dados = explode("/", $dados_imagem["mime"]);
if($dados[0] != "image"){
		return null;
}else{
		return ".".$dados[1];
};
};
function aceita_relacionamento(){
global $tabela_banco;
$uidamigo = retorne_campo_formulario_request(13);
$relacao = retorne_campo_formulario_request(53);
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);
if(retorne_usuario_amigo($uidamigo) == false or $uidamigo == null or $relacao == null){
		return null;
};
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[39];
$query[] = "update $tabela set aceito='1' where uid='$uid' and uidamigo='$uidamigo' and relacao='$relacao_2';";
$query[] = "update $tabela set aceito='1' where uid='$uidamigo' and uidamigo='$uid' and relacao='$relacao_2';";
$uidamigo_2 = retorne_idusuario_relacionamento($uidamigo, $relacao_1);
plugin_executa_varias_query($query);
switch($relacao_1){
	case 0:
		$query[] = "delete from $tabela where uid='$uid' and aceito='0' and relacao='$relacao_1';";
	$query[] = "delete from $tabela where uidamigo='$uidamigo' and aceito='0' and relacao='$relacao_1';";
		$query[] = "delete from $tabela where uid='$uidamigo_2' and aceito='1' and relacao='$relacao_1';";
	$query[] = "delete from $tabela where uidamigo='$uidamigo_2' and aceito='1' and relacao='$relacao_1';";
	break;
};
plugin_executa_varias_query($query);
};
function alterar_relacionamento(){
global $idioma_sistema;
global $tabela_banco;
$uidamigo = retorne_campo_formulario_request(13);
$uid = retorne_idusuario_logado();
$relacao = retorne_campo_formulario_request(53);
$nome_usuario = retorne_nome_usuario(true, $uidamigo);
if(retorne_usuario_relacionamento_serio($uidamigo, $relacao) == true){
		if(retorne_relacionamento_usuario($relacao, null) == $uidamigo){
				$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[556]);
	}else{
				$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[555]);
	};
		return json_encode($array_retorno);
};
$tabela = $tabela_banco[39];
$data = data_atual();
$numero_relacionamento_filhos = NUMERO_RELACIONAMENTO_FILHOS;
$numero_relacionamento_netos = NUMERO_RELACIONAMENTO_NETOS;
if($uid == $uidamigo){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[549]);
		return json_encode($array_retorno);	
};
if($uidamigo != null){
		if(retorne_usuario_amigo($uidamigo) == false){
				if(retorne_sexo_usuario(retorne_dados_perfil_usuario($uidamigo)) == true){
						$mensagem = $nome_usuario.$idioma_sistema[547];
		}else{
						$mensagem = $nome_usuario.$idioma_sistema[548];		
		};
				$array_retorno["dados"] = mensagem_erro($mensagem);
				return json_encode($array_retorno);
	};
};
if(retorne_permite_carregar_multiplos_relacionamentos($relacao) == true){
		$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid';";	
}else{
		$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao!=$numero_relacionamento_filhos;";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao!=$numero_relacionamento_filhos;";
	$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao=$numero_relacionamento_netos;";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao=$numero_relacionamento_netos;";
};
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);
if($uid != null and $uidamigo != null){
		$query[] = "insert into $tabela values(null, '$uid', '$uidamigo', '$relacao_1', '0', '1', '$uid', '$data');";
	$query[] = "insert into $tabela values(null, '$uidamigo', '$uid', '$relacao_2', '0', '0', '$uid', '$data');";
};
foreach($query as $query_executar){
		if($query_executar != null){
				plugin_executa_query($query_executar);
	};
};
if($uid != null and $uidamigo != null){
		$nome_usuario = retorne_nome_link_usuario(false, $uidamigo);
		$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[550]);
}else{
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[551]);
};
return json_encode($array_retorno);
};
function atualiza_notifica_relacionamento(){
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
$url_inicio = $pagina_inicial."?$variavel_campo[2]=109";
$numero_aceitar = retorne_tamanho_resultado(retorne_numero_relacionamentos_aceitar());
$link[0] = "<a href='$url_inicio' title='$idioma_sistema[539]'>$idioma_sistema[539] - $numero_aceitar</a>";
$array_retorno["dados"] = $link[0];
return json_encode($array_retorno);
};
function carregar_relacionamento($relacao, $aceito){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[39];
$uid = retorne_idusuario_logado();
if(retorne_permite_carregar_multiplos_relacionamentos($relacao) == false){
		$limit_query = "limit 1";
};
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='$aceito' order by id desc $limit_query;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$uidamigo = $dados[UIDAMIGO];
	$relacao = $dados[RELACAO];
	$aceito = $dados[ACEITO];
	$visualizado = $dados[VISUALIZADO];
	$uidenviou = $dados[UIDENVIOU];
	$data = $dados[DATA];
		if($id != null){
				$idcampo[0] = retorne_idcampo_md5();
				$perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uidamigo);
				$classe[0] = "classe_separa_usuario_aceita_relacionamento_separa";
		$classe[1] = "classe_separa_usuario_aceita_relacionamento_separa_botao";
		$classe[2] = "classe_separa_usuario_aceita_relacionamento_separa_span";
		$classe[3] = "classe_separa_usuario_aceita_relacionamento_separa_span_2";
				$funcao[0] = "excluir_relacionamento(\"$uidamigo\", \"$relacao\");";
		$funcao[1] = "aceita_relacionamento(\"$uidamigo\", \"$relacao\");";
				$eventos[0] = "onclick='$funcao[0]'";
		$eventos[1] = "onclick='$funcao[1]'";
		$eventos[2] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
				$campo[0] = "
		<div class='classe_texto_caixa_dialogo'>
		$idioma_sistema[594]
		</div>
		<div class='classe_botao_caixa_dialogo'>
		<input type='button' value='$idioma_sistema[32]' $eventos[0]>
		</div>
		";
				$campo[0] = constroe_dialogo($idioma_sistema[557], $campo[0], $idcampo[0]);
				if($aceito == false){
						if($uidenviou == $uid){
								$campo[0] = "
				<div class='$classe[0]'>
				<div class='$classe[2]'>
				<span class='span_link_3' $eventos[2]>$idioma_sistema[558]</span>
				</div>
				</div>
				$campo[0]
				";
			}else{
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
						$campo[0] = "
			<div class='$classe[0]'>
			<div class='$classe[2]'>
			<span class='span_link_3' $eventos[2]>$idioma_sistema[557]</span>
			</div>
			</div>
			$campo[0]
			";			
		};
				$html .= "
		<div class='classe_separa_usuario_aceita_relacionamento'>
		$perfil_usuario
		$campo[0]
		</div>
		";
	};
};
return $html;
};
function constroe_campo_notifica_relacionamento(){
global $pagina_inicial;
global $variavel_campo;
$url_inicio = $pagina_inicial."?$variavel_campo[2]=109";
$numero_aceitar = retorne_tamanho_resultado(retorne_numero_relacionamentos_aceitar());
$link[0] = "<a href='$url_inicio' title='$idioma_sistema[539]'>$numero_aceitar</a>";
$idcampo[0] = retorne_idcampo_md5();
$funcao[0] = "atualiza_notifica_relacionamento(\"$idcampo[0]\");";
$timer[0] = plugin_timer_sistema(2, $funcao[0]);
$script[0] = "
<script>
	$funcao[0]
</script>
";
$html = "
<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[0]'>
		$link[0]
	</span>
</div>
$script[0]
$timer[0]
";
return $html;
};
function constroe_formulario_relacionamento($modo){
global $idioma_sistema;
$idusuario = retorne_idusuario_request();
if($modo == false and retorne_usuario_dono_perfil($idusuario) == false){
		return null;
};
setar_relacionamentos_visualizados();
$contador = 0;
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
$contador_final = count($array_titulos) - 1;
$uid = retorne_idusuario_logado();
for($contador == $contador; $contador <= $contador_final; $contador++){
		$uidamigo = retorne_relacionamento_usuario($contador, $idusuario);
		if($contador == 0){
				if(retorne_usuario_relacionamento_serio($uid, $contador) == true){
						$titulo = retorne_texto_relacionamento($uidamigo);
		}else{
						$titulo = $array_titulos[$contador];
		}
	}else{
				$titulo = $array_titulos[$contador];
	};
		if($modo == true){
				if($uidamigo != null){
						$perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uidamigo);
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
				$idcampo[0] = retorne_idcampo_md5();
		$idcampo[1] = retorne_idcampo_md5();
				$evento = "alterar_relacionamento(\"$contador\", \"$idcampo[0]\", \"$idcampo[1]\");";
				$campos .= constroe_selecionador_amizade($evento, $uidamigo, $titulo, $idcampo[0], $idcampo[1], $contador);
	};
};
$html = "
<div class='classe_formulario_relacionamento'>
$campos
</div>
";
return $html;
};
function excluir_relacionamento(){
global $tabela_banco;
$uidamigo = retorne_campo_formulario_request(13);
$relacao = retorne_campo_formulario_request(53);
if($uidamigo == null or $relacao == null){
		return null;
};
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[39];
$query[0] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao='$relacao_1';";
$query[1] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao='$relacao_2';";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
};
function limpar_solicitacoes_relacionamentos(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[39];
$query = "delete from $tabela where (uid='$uid' or uidamigo='$uid') and aceito='0';";
plugin_executa_query($query);
};
function retorne_idusuario_relacionamento($uid, $relacao){
global $tabela_banco;
$tabela = $tabela_banco[39];
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";
$dados_query = retorne_dados_query($query);
return $dados_query[UIDAMIGO];
};
function retorne_numero_compativel_relacao($relacao){
$sexo_usuario = retorne_sexo_usuario_logado();
switch($relacao){
	case 0:
	return $relacao;
	break;
	case 1:
	return 6;
	break;
	case 2:
	return 6;
	break;
	case 3:
	return 5;
	break;
	case 4:
	return 5;
	break;
	case 5:
		if($sexo_usuario == true){
				return 4;
	}else{
				return 3;
	};
	break;
	case 6:
		if($sexo_usuario == true){
				return 2;
	}else{
				return 1;
	};
	break;
	case 7:
		if($sexo_usuario == true){
				return 7;
	}else{
				return 8;
	};
	break;
	case 8:
		if($sexo_usuario == true){
				return 7;
	}else{
				return 8;
	};
	break;	
	case 9:
		if($sexo_usuario == true){
				return 9;
	}else{
				return 10;
	};
	break;
	case 10:
		if($sexo_usuario == true){
				return 9;
	}else{
				return 10;
	};
	break;
};
};
function retorne_numero_relacionamentos_aceitar(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[39];
$query = "select *from $tabela where uid='$uid' and aceito='0' and visualizado='0';";
return retorne_numero_linhas_query($query);
};
function retorne_permite_carregar_multiplos_relacionamentos($relacao){
switch($relacao){
	case NUMERO_RELACIONAMENTO_FILHOS:
	return true;
	break;
	case NUMERO_RELACIONAMENTO_NETOS:
	return true;
	break;
	case NUMERO_RELACIONAMENTO_IRMAO:
	return true;
	break;
	case NUMERO_RELACIONAMENTO_IRMA:
	return true;
	break;
	case NUMERO_RELACIONAMENTO_PRIMO:
	return true;
	break;	
	case NUMERO_RELACIONAMENTO_PRIMA:
	return true;
	break;	
	case NUMERO_RELACIONAMENTO_AVO_H:
	return true;
	break;
	case NUMERO_RELACIONAMENTO_AVO_M:
	return true;
	break;
	default:
	return false;
};
};
function retorne_relacionamento_usuario($relacao, $uid){
global $tabela_banco;
$tabela = $tabela_banco[39];
if($uid == null){
		$uid = retorne_idusuario_logado();
};
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";
$dados_query = retorne_dados_query($query);
return $dados_query[UIDAMIGO];
};
function retorne_texto_relacionamento($uid){
global $idioma_sistema;
$nome_usuario = retorne_nome_usuario(true, $uid);
$imagem_sistema[0] = retorne_imagem_sistema(101, null, false);
$dados_perfil = retorne_dados_perfil_usuario($uid);
$relacionamento = $dados_perfil[RELACIONAMENTO];
$idusuario = $dados_perfil[UID];
if($relacionamento == null){
		$html = "
	<div class='classe_atencao_relacionamento'>
	<div class='classe_atencao_relacionamento_imagem'>
	$imagem_sistema[0]
	</div>
	<div class='classe_atencao_relacionamento_texto span_link_3'>
	$nome_usuario$idioma_sistema[563]
	</div>
	</div>
	";
		return $html;
};
$sexo_usuario = retorne_sexo_idusuario($uid);
if($sexo_usuario == false){
		$texto[0] = $idioma_sistema[38];
	$texto[1] = $idioma_sistema[543];
}else{
		$texto[0] = $idioma_sistema[37];	
	$texto[1] = $idioma_sistema[544];
};
$relacoes = explode(",", $texto[0]);
$opcoes = explode(",", $texto[1]);
$contador = 0;
for($contador == $contador; $contador <= count($relacoes); $contador++){
		$relacionamento = trim(strtolower($relacionamento));
		$relacao = trim(strtolower($relacoes[$contador]));
		if($relacionamento == $relacao){
				$sub_contador = $contador - 1;
				switch($sub_contador){
			case 1:
			return $opcoes[0];
			break;
			case 2:
			return $opcoes[1];
			break;
			case 3:
			return $opcoes[2];
			break;
			case 7:
			return $opcoes[3];
			break;
			case 8:
			return $opcoes[4];
			break;
		};
	}else{
				if(count($relacoes) == $contador){
						$relacionamento = captular($relacionamento);
						$html = "
			<div class='classe_atencao_relacionamento'>
			<div class='classe_atencao_relacionamento_imagem'>
			$imagem_sistema[0]
			</div>
			<div class='classe_atencao_relacionamento_texto span_link_3'>
			$relacionamento
			</div>
			</div>
			";
						return $html;
		};
	};
};
};
function retorne_usuario_relacionamento_serio($uid, $relacao){
global $tabela_banco;
if($uid == null){
		$uid = retorne_idusuario_logado();
};
switch($relacao){
	case 0:
	$permite_varios = false;
	break;
	default:
	$permite_varios = true;
};
$tabela = $tabela_banco[39];
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";
$linhas = retorne_numero_linhas_query($query);
if($linhas == 0){
		return false;
};
if($linhas > 0 and $permite_varios == true){
		return false;
};
if($linhas > 0 and $permite_varios == false){
		return true;
};
};
function setar_relacionamentos_visualizados(){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$tabela = $tabela_banco[39];
$query = "update $tabela set visualizado='1' where uid='$uid';";
plugin_executa_query($query);
};
function constroe_conteudo_rodape(){
global $copyright;
global $administradores_sistema;
global $idioma_sistema;
global $url_link_acao;
$usuario_logado = retorne_usuario_logado();
$nome_link = retorne_nome_link_usuario(true, retorne_idusuario_email($administradores_sistema[0]));
$data = date("Y");
$nome_sistema = NOME_SISTEMA;
$url_pagina_inicial = PAGINA_INICIAL;
$classe[0] = "classe_copyright_separa_principal";
$classe[1] = "classe_copyright_separa_link";
$classe[2] = "classe_copyright_separa_sub_link";
$campo[0] = "
<div class='$classe[0]'>
<div class='$classe[1]'>
<div class='$classe[2]'>
$copyright[0]
</div>
<div class='$classe[2]'>
$nome_link
</div>
</div>
</div>
";
$campo[1] = "
<div class='$classe[0]'>
<div class='$classe[1]'>
$url_link_acao[28]
</div>
<div class='$classe[1]'>
$idioma_sistema[604]
</div>
<div class='$classe[1]'>
$url_link_acao[27]
</div>
</div>
";
$campo[2] = "
<div class='$classe[0]'>
<div class='$classe[1]'>
<a href='$url_pagina_inicial' title='$nome_sistema'>$nome_sistema</a> $idioma_sistema[465] $data
</div>
</div>
";
$html = "
$campo[2]
$campo[1]
$campo[0]
";
if($modo == true and $usuario_logado == true){
		$html = null;
}else{
		$html = "
	<div class='classe_conteudo_rodape_deslogado'>
	$html
	</div>
	";
};
return $html;
};
function rotacionar_imagem($jpgFile, $thumbFile, $width) {
$dados_imagem = getimagesize($jpgFile);
switch($dados_imagem['mime']){
    case 'image/jpeg':
    $image_create_func = 'imagecreatefromjpeg';
    break;
    case 'image/png':
    $image_create_func = 'imagecreatefrompng';
    break;
    case 'image/gif':
    $image_create_func = 'imagecreatefromgif';
    break;
	default:
	$image_create_func = 'imagecreatefromjpeg';
};
$exif = exif_read_data($jpgFile);
list($width_orig, $height_orig) = getimagesize($jpgFile);
$height = (int)(($width / $width_orig) * $height_orig);
$image_p = imagecreatetruecolor($width, $height);
$image = $image_create_func($jpgFile);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
switch($exif['Orientation']){
    case 3:
        $image_p = imagerotate($image_p, 180, 0);
        break;
    case 6:
        $image_p = imagerotate($image_p, -90, 0);
        break;
    case 8:
        $image_p = imagerotate($image_p, 90, 0);
        break;
};
imagejpeg($image_p, $thumbFile, 100);
};
function constroe_campo_social($tipo_campo, $id, $modo, $idusuario){
global $tabela_banco;
if(retorne_usuario_logado() == false){
		return null;
};
switch($tipo_campo){
	case 1:
	$uid_dono = retorne_idusuario_dono_publicacao($id);
	$usuario_amigo = retorne_usuario_amigo($uid_dono);
	$pagina = retorne_idpagina_postagem($id);
	$campo_visualizado = constroe_visualizado($id, $tabela_banco[5]);
	break;
	case 2:
	$uid_dono = retorne_uid_dono_imagem($id);
	$usuario_amigo = retorne_usuario_amigo($uid_dono);
	$pagina = retorne_idpagina_request();
	break;
};
if($usuario_amigo == false and $pagina == null and retorne_usuario_dono_perfil($uid_dono) == false){
		return null;
};
$campo_curtida = constroe_campo_curtir($tipo_campo, $id, $modo, $idusuario);
$campo_comentario = constroe_campo_comentario(null, $tipo_campo, $id, $modo, $idusuario);
if($tipo_campo == 1){
		$campo_compartilhar = constroe_campo_compartilhamentos($id, $tipo_campo, $idusuario);
};
$html = "
<div class='classe_div_campo_social'>
	$campo_compartilhar
	$campo_curtida
	$campo_visualizado
	$campo_comentario
</div>
";
return $html;
};
function retorne_pode_interagir_social($id, $modo){
if(retorne_idpagina_postagem($id) != null){
		return true;
};
if($modo == true){
		$id_post = retorne_idcompartilhamento_id_post($id);
}else{
		$id_post = $id;
};
$uid_dono = retorne_idusuario_dono_publicacao($id_post);
if(retorne_usuario_dono_perfil($uid_dono) == true){
		return true;
};
return retorne_usuario_amigo($uid_dono);
};
function plugin_timer_sistema($modo, $funcoes_inicializar){
switch($modo){
	case 1:
		$tempo_timer_sistema = TEMPO_TIMER_CONEXAO;
	break;
	case 2:
		$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_GERAIS;
	break;
	case 3:
		$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_CHAT;
	break;
	case 4:
		$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_GERAIS;
	break;	
	case 5:
		$tempo_timer_sistema = TEMPO_TIMER_INFO_LINK;
	break;
	case 6:
		$tempo_timer_sistema = TIMER_ATUALIZADOR_RESOLUCAO;
	break;
	case 7:
		$tempo_timer_sistema = TEMPO_TIMER_COMUM;
	break;
	case 8:
		$tempo_timer_sistema = TIMER_ATUALIZADOR_NOTICIA;
	break;
	case 9:
		$tempo_timer_sistema = TIMER_ATUALIZADOR_ONLINE_MENSAGEIRO;
	break;
};
$contador_iteracao = retorne_contador_iteracao();
$nome_variavel = "variavel_timer".codifica_md5($modo."variavel_timer".$contador_iteracao);
$nome_funcao = "funcao_timer_".codifica_md5("funcao_timer_".$modo.$contador_iteracao);
$nome_timer_carregar_funcoes = "funcoes_carregar_timer_".codifica_md5("funcoes_carregar_timer_".$contador_iteracao.$modo);
$html = "
\n
var $nome_variavel = setInterval(function(){ $nome_funcao() }, $tempo_timer_sistema);
\n
function $nome_funcao() {
\n
$nome_timer_carregar_funcoes();
\n
};
\n
";
$html .= "
function $nome_timer_carregar_funcoes(){
$funcoes_inicializar
};
";
$html = "
<script language='javascript'>$html</script>
";
return $html;
};
function gera_token_pagina(){
$_SESSION[SESSAO_ITERACAO_TOKEN_PAGINA] += 1;
$token = md5(data_atual().$_SESSION[SESSAO_ITERACAO_TOKEN_PAGINA]);
$_SESSION[SESSAO_TOKEN_PAGINA][$token] = $token;
return $_SESSION[SESSAO_TOKEN_PAGINA][$token];
};
function retorna_token_pagina_requeste(){
return retorne_campo_formulario_request(45);
};
function upload_imagem($fotos, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, $upload_thumbnail, $upload_original, $pasta_upload, $tamanho_thumbnail, $tamanho_mobile, $tamanho_medio){
if($fotos == null){
		$fotos = $_FILES["foto"];
};
$endereco_imagem_temporaria = $fotos["tmp_name"];
$nome_real_imagem = $fotos["name"];
$extensao_imagem = retorne_extensao_imagem_mime($endereco_imagem_temporaria);
if($extensao_imagem == null){
		return false;
};
$novo_nome_imagem[0] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[1] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[2] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[3] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[4] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[5] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$endereco_root_final_arquivo[0] = $pasta_upload_root.$novo_nome_imagem[0];
$endereco_root_final_arquivo[1] = $pasta_upload_root.$novo_nome_imagem[1];
$endereco_root_final_arquivo[2] = $pasta_upload_root.$novo_nome_imagem[2];
$endereco_root_final_arquivo[3] = $pasta_upload_root.$novo_nome_imagem[3];
$endereco_root_final_arquivo[4] = $pasta_upload_root.$novo_nome_imagem[4];
$endereco_root_final_arquivo[5] = $pasta_upload_root.$novo_nome_imagem[5];
$endereco_host_final_arquivo[0] = $pasta_upload.$novo_nome_imagem[0];
$endereco_host_final_arquivo[1] = $pasta_upload.$novo_nome_imagem[1];
$endereco_host_final_arquivo[2] = $pasta_upload.$novo_nome_imagem[2];
$endereco_host_final_arquivo[3] = $pasta_upload.$novo_nome_imagem[3];
$endereco_host_final_arquivo[4] = $pasta_upload.$novo_nome_imagem[4];
$endereco_host_final_arquivo[5] = $pasta_upload.$novo_nome_imagem[5];
move_uploaded_file($endereco_imagem_temporaria, $endereco_root_final_arquivo[0]);
list($largura_padrao, $altura_padrao) = getimagesize($endereco_root_final_arquivo[0]);
rotacionar_imagem($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[0], $largura_padrao);
if(file_exists($endereco_root_final_arquivo[0]) == false){
		$retorno["host_normal"] = retorne_imagem_sistema(60, null, true);
	$retorno["host_miniatura"] = retorne_imagem_sistema(40, null, true);
	$retorno[URL_HOST_NORMAL] = retorne_imagem_sistema(39, null, true);
	$retorno[URL_HOST_THUMBNAIL] = retorne_imagem_sistema(60, null, true);
	$retorno[URL_HOST_MOBILE] = retorne_imagem_sistema(40, null, true);
	$retorno[URL_HOST_MEDIO] = retorne_imagem_sistema(99, null, true);
		$retorno["root_normal"] = null;
	$retorno["root_miniatura"] = null;
	$retorno[URL_ROOT_NORMAL] = null;
	$retorno[URL_ROOT_THUMBNAIL] = null;
	$retorno[URL_ROOT_MOBILE] = null;
	$retorno[URL_ROOT_MEDIO] = null;
		return $retorno;
};
$image_info = getimagesize($endereco_root_final_arquivo[0]);
$largura_imagem = $image_info[0];
$altura_imagem = $image_info[1];
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[1]);
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[4]);
if($upload_original == true){
		copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[2]);
};
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[3]);
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[5]);
if($tamanho_normal != null){
		if($largura_imagem > $tamanho_normal){
				resize_imagem($tamanho_normal, $endereco_root_final_arquivo[0], $endereco_root_final_arquivo[0]);
	};
}else{
		unlink($endereco_root_final_arquivo[0]);
};
if($tamanho_miniatura != null){
		resize_imagem($tamanho_miniatura, $endereco_root_final_arquivo[1], $endereco_root_final_arquivo[1]);
}else{
		unlink($endereco_root_final_arquivo[1]);
};
if($largura_imagem > TAMANHO_IMAGEM_ALBUM_NORMAL and $upload_original == true){
		resize_imagem(TAMANHO_IMAGEM_ALBUM_NORMAL, $endereco_root_final_arquivo[2], $endereco_root_final_arquivo[2]);
};
if($tamanho_thumbnail == null){
		$tamanho_thumbnail = TAMANHO_IMAGEM_ALBUM_THUMBNAIL;
};
if($upload_thumbnail == true){
		resize_imagem($tamanho_thumbnail, $endereco_root_final_arquivo[3], $endereco_root_final_arquivo[3]);
}else{
		unlink($endereco_root_final_arquivo[3]);
};
if($tamanho_mobile != null){
		resize_imagem($tamanho_mobile, $endereco_root_final_arquivo[4], $endereco_root_final_arquivo[4]);
}else{
		unlink($endereco_root_final_arquivo[4]);
};
if($tamanho_medio != null){
		resize_imagem($tamanho_medio, $endereco_root_final_arquivo[5], $endereco_root_final_arquivo[5]);
}else{
		unlink($endereco_root_final_arquivo[5]);
};
$retorno["host_normal"] = $endereco_host_final_arquivo[0];
$retorno["host_miniatura"] = $endereco_host_final_arquivo[1];
$retorno[URL_HOST_NORMAL] = $endereco_host_final_arquivo[2];
$retorno[URL_HOST_THUMBNAIL] = $endereco_host_final_arquivo[3];
$retorno[URL_HOST_MOBILE] = $endereco_host_final_arquivo[4];
$retorno[URL_HOST_MEDIO] = $endereco_host_final_arquivo[5];
$retorno["root_normal"] = $endereco_root_final_arquivo[0];
$retorno["root_miniatura"] = $endereco_root_final_arquivo[1];
$retorno[URL_ROOT_NORMAL] = $endereco_root_final_arquivo[2];
$retorno[URL_ROOT_THUMBNAIL] = $endereco_root_final_arquivo[3];
$retorno[URL_ROOT_MOBILE] = $endereco_root_final_arquivo[4];
$retorno[URL_ROOT_MEDIO] = $endereco_root_final_arquivo[5];
return $retorno;
};
function upload_imagem_album($numero_pasta){
global $tabela_banco;
global $idioma_sistema;
if(retorne_modo_pagina() == true){
		$pagina = retorne_idpagina_request();
		if(retorne_usuario_logado_dono_pagina($pagina) == false){
				$pagina = null;
	};
};
$idusuario = retorne_idusuario_logado();
$fotos = $_FILES['fotos'];
$extensao_imagem = converte_minusculo(pathinfo($foto["name"], PATHINFO_EXTENSION));
$numero_imagens = retorne_numero_array_post_imagens();
$contador = 0;
$data = data_atual();
$modo_chat = 0;
switch($numero_pasta){
	case 4: 	$modo_chat = 1;
	$chave = codifica_md5(PREFIXO_CHAT_IMAGEM_ALBUM_CHAVE.retorne_contador_iteracao());
	$uidamigo = retorne_idusuario_request();
	break;
	case 9:     $chave = retorna_chave_request();
    break;
	default: 	$chave = null;
};
for($contador == $contador; $contador <= $numero_imagens; $contador++){
		$nome_imagem = $fotos['tmp_name'][$contador];
	$nome_imagem_real = $fotos['name'][$contador]; 
		if($nome_imagem != null){
				$foto["tmp_name"] = $nome_imagem;
		$foto["name"] = $nome_imagem_real;
				if($modo_chat != 1){
						$pasta_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
			$pasta_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
						$dados_imagem = upload_imagem_unica_album($foto, $pasta_root, TAMANHO_IMAGEM_ALBUM_NORMAL, TAMANHO_IMAGEM_ALBUM_MINIATURA, $pasta_host, true, null);
						$url_host_grande[0] = $dados_imagem[URL_HOST_GRANDE];
			$url_host_miniatura[0] = $dados_imagem[URL_HOST_MINIATURA];
			$url_root_grande[0] = $dados_imagem[URL_ROOT_GRANDE];
			$url_root_miniatura[0] = $dados_imagem[URL_ROOT_MINIATURA];
			$url_root_thumbnail[0] = $dados_imagem[URL_ROOT_THUMBNAIL];
			$url_host_thumbnail[0] = $dados_imagem[URL_HOST_THUMBNAIL];
						$query[0] = "insert into $tabela_banco[4] values(null, '$idusuario', '$chave', '$modo_chat', '$pagina', '$uidamigo', '$url_host_grande[0]', '$url_host_miniatura[0]', '$url_root_grande[0]', '$url_root_miniatura[0]', '$url_host_thumbnail[0]', '$url_root_thumbnail[0]', '', '$data');";
						if($url_host_grande[0] != null){
								plugin_executa_query($query[0]);
			};
		}else{
						$pagina = null;
						$pasta_root = retorne_pasta_usuario($uidamigo, $numero_pasta, true);
			$pasta_host = retorne_pasta_usuario($uidamigo, $numero_pasta, false);
						$dados_imagem = upload_imagem_unica_album($foto, $pasta_root, TAMANHO_GRANDE_IMAGEM_MENSAGEM_CHAT, TAMANHO_IMAGEM_MINIATURA_UPLOAD_CHAT, $pasta_host, true, null);
						$url_host_grande[0] = $dados_imagem[URL_HOST_GRANDE];
			$url_host_miniatura[0] = $dados_imagem[URL_HOST_MINIATURA];
			$url_host_thumbnail[0] = $dados_imagem[URL_HOST_THUMBNAIL];
						$url_root_grande[0] = $dados_imagem[URL_ROOT_GRANDE];
			$url_root_miniatura[0] = $dados_imagem[URL_ROOT_MINIATURA];
			$url_root_thumbnail[0] = $dados_imagem[URL_ROOT_THUMBNAIL];
						if($url_host_grande[0] != null){
								$pasta_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
				$pasta_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
								$nome_arquivo[0] = basename($url_root_grande[0]);
				$nome_arquivo[1] = basename($url_root_miniatura[0]);
				$nome_arquivo[2] = basename($url_root_thumbnail[0]);
								copy($url_root_grande[0], $pasta_root.$nome_arquivo[0]);
				copy($url_root_miniatura[0], $pasta_root.$nome_arquivo[1]);
				copy($url_root_thumbnail[0], $pasta_root.$nome_arquivo[2]);
								$url_host_grande[1] = $pasta_host.$nome_arquivo[0];
				$url_host_miniatura[1] = $pasta_host.$nome_arquivo[1];
				$url_host_thumbnail[1] = $pasta_host.$nome_arquivo[2];
				$url_root_grande[1] = $pasta_root.$nome_arquivo[0];
				$url_root_miniatura[1] = $pasta_root.$nome_arquivo[1];
				$url_root_thumbnail[1] = $pasta_root.$nome_arquivo[2];
								$query[0] = "insert into $tabela_banco[4] values(null, '$uidamigo', '$chave', '$modo_chat', '$pagina', '$idusuario', '$url_host_grande[0]', '$url_host_miniatura[0]', '$url_root_grande[0]', '$url_root_miniatura[0]', '$url_host_thumbnail[0]', '$url_root_thumbnail[0]', '', '$data');";
				$query[1] = "insert into $tabela_banco[4] values(null, '$idusuario', '$chave', '$modo_chat', '$pagina', '$uidamigo', '$url_host_grande[1]', '$url_host_miniatura[1]', '$url_root_grande[1]', '$url_root_miniatura[1]', '$url_host_thumbnail[1]', '$url_root_thumbnail[1]', '', '$data');";
								plugin_executa_query($query[0]);
				plugin_executa_query($query[1]);
								$mensagem[0] = "
				$url_host_grande[0]
				";
								$mensagem[1] = "
				$url_host_grande[1]
				";		
								enviar_mensagem_usuario($mensagem[0], false, $uidamigo, $chave);
				enviar_mensagem_usuario($mensagem[1], false, $idusuario, $chave);
			};
		};
	};
};
atualiza_retorna_dados_usuario_sessao(true, true);
};
function upload_imagem_capa(){
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;
if($_FILES['foto']['tmp_name'] == null){
        return null;
};
$fotos = $_FILES["foto"];
$nome_real_imagem = $fotos["name"];
$extensao_imagem = converte_minusculo(pathinfo($nome_real_imagem, PATHINFO_EXTENSION));
if(retorna_extensao_imagem_valida($extensao_imagem) == false){
		return false;
};
$idusuario = retorne_idusuario_logado();
switch(retorne_campo_formulario_request(2)){
	case 55:
	$tabela = $tabela_banco[21];
	$numero_pasta = 10;
    $id = retorne_idpagina_request();
	$modo_pagina = true;
	$novo_tamanho = TAMANHO_IMAGEM_CAPA_NORMAL_PAGINA;
		if(retorne_usuario_dono_pagina($idusuario, $id) == false){
				return null;
	};
	break;
	default:
    $tabela = $tabela_banco[3];
	$numero_pasta = 8;
	$modo_pagina = false;
	$novo_tamanho = TAMANHO_IMAGEM_CAPA_NORMAL;
};
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
excluir_pastas_subpastas($pasta_upload_root, true);
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
$array_enderecos = upload_imagem(null, $pasta_upload_root, $novo_tamanho, null, false, false, $pasta_upload_host, null, null, null);
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];
$root_normal = $array_enderecos['root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];
$url_normal = $array_enderecos['url_normal'];
$url_host_normal = $array_enderecos['url_host_normal'];
$url_root_normal = $array_enderecos['url_root_normal'];
if($modo_pagina == true){
        $query[0] = "delete from $tabela where id='$id';";
    $query[1] = "insert into $tabela values('$id', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '0');";	
}else{
        $query[0] = "delete from $tabela where uid='$idusuario';";
    $query[1] = "insert into $tabela values('$idusuario', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '0');";
};
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
$imagem_publicacao = "
$host_normal
";
if($modo_pagina == false){
		$texto = $codigos_especiais[0].$codigos_especiais[4].retorne_nome_usuario_logado().$codigos_especiais[5].$idioma_sistema[322].$codigos_especiais[1].$imagem_publicacao;
};
if($modo_pagina == true){
		$titulo_pagina = retorne_titulo_pagina_id($id);
		$texto = $codigos_especiais[0].$idioma_sistema[326].$titulo_pagina.$idioma_sistema[328].$codigos_especiais[1].$imagem_publicacao;
};
$array_publicacao[TEXTO] = $texto;
publicar_conteudo_usuario($array_publicacao, 2);
atualiza_retorna_dados_usuario_sessao(true, true);
};
function upload_imagem_perfil(){
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;
if($_FILES['foto']['tmp_name'] == null){
        return null;
};
$fotos = $_FILES["foto"];
$nome_real_imagem = $fotos["name"];
$extensao_imagem = converte_minusculo(pathinfo($nome_real_imagem, PATHINFO_EXTENSION));
if(retorna_extensao_imagem_valida($extensao_imagem) == false){
		return false;
};
$idusuario = retorne_idusuario_logado();
switch(retorne_campo_formulario_request(2)){
    case 53:
	$tabela = $tabela_banco[20];
	$numero_pasta = 7;
    $id = retorne_idpagina_request();
	$modo_pagina = true;
		if(retorne_usuario_dono_pagina($idusuario, $id) == false){
				return null;
	};
    break;
	default:
    $tabela = $tabela_banco[2];
	$numero_pasta = 1;
	$modo_pagina = false;
};
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
excluir_pastas_subpastas($pasta_upload_root, true);
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
$array_enderecos = upload_imagem(null, $pasta_upload_root, TAMANHO_IMAGEM_PERFIL_NORMAL, TAMANHO_IMAGEM_PERFIL_MINIATURA, true, true, $pasta_upload_host, TAMANHO_IMAGEM_ALBUM_MINIATURA, TAMANHO_IMAGEM_PERFIL_MOBILE, TAMANHO_IMAGEM_PERFIL_MEDIO);
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];
$url_host_normal = $array_enderecos['url_host_normal'];
$url_normal = $array_enderecos['url_normal'];
$url_host_thumbnail = $array_enderecos['url_host_thumbnail'];
$url_host_mobile = $array_enderecos['url_host_mobile'];
$url_host_medio = $array_enderecos['url_host_medio'];
$url_root_normal = $array_enderecos['url_root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];
$root_normal = $array_enderecos['root_normal'];
$url_root_thumbnail = $array_enderecos['url_root_thumbnail'];
$url_root_mobile = $array_enderecos['url_root_mobile'];
$url_root_medio = $array_enderecos['url_root_medio'];
if($modo_pagina == true){
        $query[0] = "delete from $tabela where id='$id';";
    $query[1] = "insert into $tabela values('$id', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '$url_host_mobile');";
}else{
        $query[0] = "delete from $tabela where uid='$idusuario';";
    $query[1] = "insert into $tabela values('$idusuario', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '$url_host_mobile', '$url_host_medio', '$url_root_medio', '$url_root_mobile');";
};
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
$dados_perfil_logado = retorne_dados_sessao_usuario_logado();
$dados_perfil_logado = $dados_perfil_logado[$tabela_banco[1]];
if($modo_pagina == false){
		$titulo = retorne_nome_usuario_logado();
		$imagem_publicacao = "
	$url_host_thumbnail
	";
		$texto = $codigos_especiais[0].$titulo.$idioma_sistema[320].$codigos_especiais[1].$imagem_publicacao;
};
if($modo_pagina == true){
		$imagem_publicacao = "
	$url_host_thumbnail
	";
		$titulo = retorne_titulo_pagina_id($id);
		$texto = $codigos_especiais[0].$idioma_sistema[326].$titulo.$idioma_sistema[327].$codigos_especiais[1].$imagem_publicacao;
};
$array_publicacao[TEXTO] = $texto;
publicar_conteudo_usuario($array_publicacao, 1);
atualiza_retorna_dados_usuario_sessao(true, true);
};
function upload_imagem_plano_fundo(){
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;
if(retorna_chave_request() == null){
		return null;
};
if($_FILES['foto']['tmp_name'] == null){
        return null;
};
$fotos = $_FILES["foto"];
$nome_real_imagem = $fotos["name"];
$extensao_imagem = converte_minusculo(pathinfo($nome_real_imagem, PATHINFO_EXTENSION));
if(retorna_extensao_imagem_valida($extensao_imagem) == false){
		return false;
};
$idusuario = retorne_idusuario_logado();
$tabela = $tabela_banco[38];
$numero_pasta = 5;
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
excluir_pastas_subpastas($pasta_upload_root, true);
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
$array_enderecos = upload_imagem(null, $pasta_upload_root, TAMANHO_GRANDE_IMAGEM_FUNDO, TAMANHO_MINIATURA_IMAGEM_FUNDO, false, false, $pasta_upload_host, null, null, null);
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];
$url_root_normal = $array_enderecos['url_root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];
$query = "select *from $tabela where uid='$idusuario';";
if(retorne_numero_linhas_query($query) == 0){
		$query = "insert into $tabela values(null, '$idusuario', '$host_normal', '$host_miniatura', '$url_root_normal', '$root_miniatura');";
		plugin_executa_query($query);
}else{
		$query = "update $tabela set url_host_grande='$host_normal', url_host_miniatura='$host_miniatura', url_root_grande='$url_root_normal', url_root_miniatura='$root_miniatura' where uid='$idusuario';";
		plugin_executa_query($query);
};
atualiza_retorna_dados_usuario_sessao(true, true);
};
function upload_imagem_unica_album($foto, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, $host_retorno, $upload_miniatura, $tamanho_thumbnail){
$array_enderecos = upload_imagem($foto, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, true, false, $host_retorno, $tamanho_thumbnail, null, null);
$retorno[URL_HOST_GRANDE] = $array_enderecos["host_normal"];
$retorno[URL_HOST_MINIATURA] = $array_enderecos["host_miniatura"];
$retorno[URL_HOST_THUMBNAIL] = $array_enderecos[URL_HOST_THUMBNAIL];
$retorno[URL_ROOT_GRANDE] = $array_enderecos["root_normal"];
$retorno[URL_ROOT_MINIATURA] = $array_enderecos["root_miniatura"];
$retorno[URL_ROOT_THUMBNAIL] = $array_enderecos[URL_ROOT_THUMBNAIL];
return $retorno;
};
function upload_musica_usuario(){
global $variavel_campo;
global $tabela_banco;
global $extensao_arquivo;
$uid = retorne_idusuario_logado();
$pasta_root = retorne_pasta_usuario($uid, 3, true);
$pasta_host = retorne_pasta_usuario($uid, 3, false);
$nome_file = $variavel_campo[41];
$nome_temporario = $_FILES[$nome_file]['tmp_name'];
$nome_real_arquivo = $_FILES[$nome_file]['name'];
$tamanho_arquivo = $_FILES[$nome_file]['size'];
$extensao = ".".converte_minusculo(pathinfo($nome_real_arquivo, PATHINFO_EXTENSION));
if($extensao != $extensao_arquivo["mp3"]){
		return null;
};
$nome_arquivo_codificado = codifica_md5($nome_real_arquivo.data_atual().retorne_contador_iteracao()).$extensao;
$endereco_root = $pasta_root."/".$nome_arquivo_codificado;
$endereco_host = $pasta_host."/".$nome_arquivo_codificado;
move_uploaded_file($nome_temporario, $endereco_root);
$chave = retorna_chave_request();
$tabela = $tabela_banco[26];
$data = data_atual();
$titulo_musica = converte_minusculo(remove_html(str_ireplace($extensao, null, $nome_real_arquivo)));
$query = "insert into $tabela values(null, '$uid', '$titulo_musica', '$endereco_root', '$endereco_host', '$chave', '$data');";
plugin_executa_query($query);
return $chave;
};
function upload_video_usuario(){
global $variavel_campo;
global $tabela_banco;
global $extensao_arquivo;
$uid = retorne_idusuario_logado();
$pasta_root = retorne_pasta_usuario($uid, 6, true);
$pasta_host = retorne_pasta_usuario($uid, 6, false);
$nome_file = $variavel_campo[43];
$nome_temporario = $_FILES[$nome_file]['tmp_name'];
$nome_real_arquivo = $_FILES[$nome_file]['name'];
$tamanho_arquivo = $_FILES[$nome_file]['size'];
$extensao = ".".converte_minusculo(pathinfo($nome_real_arquivo, PATHINFO_EXTENSION));
if($extensao != $extensao_arquivo["mp4"]){
		return null;
};
$nome_arquivo_codificado = codifica_md5($nome_real_arquivo.data_atual().retorne_contador_iteracao()).$extensao;
$endereco_root = $pasta_root."/".$nome_arquivo_codificado;
$endereco_host = $pasta_host."/".$nome_arquivo_codificado;
move_uploaded_file($nome_temporario, $endereco_root);
$chave = retorna_chave_request();
$tabela = $tabela_banco[27];
$data = data_atual();
$titulo_musica = converte_minusculo(remove_html(str_ireplace($extensao, null, $nome_real_arquivo)));
$query = "insert into $tabela values(null, '$uid', '$titulo_musica', '$endereco_root', '$endereco_host', '$chave', '$data');";
plugin_executa_query($query);
return $chave;
};
function adiciona_nome_amigavel_cadastrar($nome, $sobrenome){
global $tabela_banco;
$nome .= "_".$sobrenome;
$tabela = $tabela_banco[28];
$uid = retorne_idusuario_logado();
$nome = retorne_nome_amigavel($nome)."_".$uid;
if(retorne_nome_url_amigavel_existe($nome, 0) == true){
		return null;
};
$query = "insert into $tabela values(null, '$uid', '$nome', '0', null);";
plugin_executa_query($query);
};
function constroe_campo_alterar_url_usuario($modo){
global $idioma_sistema;
$modo_pagina = retorne_modo_pagina();
$uid = retorne_idusuario_logado();
$url_amigavel = retorne_somente_nome_amigavel_idusuario($uid, $modo, retorne_idpagina_request());
$idcampo[0] = codifica_md5("id_entrada_campo_url_amigavel_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_resposta_campo_url_amigavel_".retorne_contador_iteracao());
if($modo == true){
		$modo = 1;
}else{
		$modo = 0;
};
$funcao[0] = "salvar_url_amigavel_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$modo\");";
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$tamanho_campo[0] = TAMANHO_URL_AMIGAVEL;
if($modo_pagina == true){
		$placeholder[0] = $idioma_sistema[612];
}else{
		$placeholder[0] = $idioma_sistema[390];	
};
$campo[0] = "
<div class='classe_campo_entrada_url_amigavel'>
<div class='classe_campo_entrada_url_amigavel_separa'>
<input type='text' id='$idcampo[0]' value='$url_amigavel' placeholder='$placeholder[0]' maxlength='$tamanho_campo[0]' $evento[1]>
</div>
<div class='classe_campo_entrada_url_amigavel_separa' id='$idcampo[1]'></div>
</div>
";
$campo[1] = "
<div class='classe_campo_verificar_url_amigavel'>
<input type='button' value='$idioma_sistema[391]' $evento[0]>
</div>
";
$html = "
<div class='classe_campo_alterar_url_usuario'>
$campo[0]
$campo[1]
</div>
";
return $html;
};
function retorne_idpagina_amigavel_nome($nome_amigavel){
global $tabela_banco;
$tabela = $tabela_banco[28];
$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='1';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0][PAGINA];
};
function retorne_idusuario_amigavel($nome_amigavel, $modo, $pagina){
global $tabela_banco;
$tabela = $tabela_banco[28];
if($modo == 0){
		$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='$modo';";
}else{
		$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='$modo' and pagina='$pagina';";
};
$dados_query = plugin_executa_query($query);
if($modo == 0){
		return $dados_query["dados"][0][UID];
}else{
		return $dados_query["dados"][0][PAGINA];
};
};
function retorne_idusuario_amigavel_requeste($modo){
$geturl = explode('/', $_SERVER['REQUEST_URI']);
$nome_usuario = $geturl[1];
$nome_pagina = $geturl[2];
if($modo == 0){
		return retorne_idusuario_amigavel($nome_usuario, $modo, null);
}else{
		return retorne_idpagina_amigavel_nome($nome_pagina);
};
};
function retorne_link_perfil_amigavel_idusuario($modo_espaco, $modo, $uid, $conteudo){
if($uid == null){
		return HOST_SERVIDOR;
};
$url = retorne_url_amigavel_usuario($uid, 0, null);
$nome = retorne_nome_usuario(true, $uid);
if(retorne_usuario_logado() == true and $modo == true){
		$info_link = constroe_campo_info_link(0, $uid);
		$evento_info_link = $info_link[0];
		$conteudo_info_link = $info_link[1];
};
if($conteudo == null){
		$conteudo = $nome;
};
if($modo_espaco == true){
		$classe[0] = "classe_link_perfil_amigavel";
}else{
		$classe[0] = "classe_link_perfil_amigavel_2";
};
$html = "
<span class='$classe[0]' $evento_info_link>
	<a href='$url' title='$nome'>$conteudo</a>
</span>
$conteudo_info_link
";
return $html;
};
function retorne_nome_amigavel($nome){
$nome = converte_minusculo($nome);
$nome = str_ireplace(" ", "_", $nome);
$nome = str_ireplace("-", null, $nome);
$nome = remove_acentos($nome);
$nome = str_ireplace("__", "_", $nome);
return $nome;
};
function retorne_nome_url_amigavel_existe($nome, $modo){
global $tabela_banco;
$tabela = $tabela_banco[28];
$nome = retorne_nome_amigavel($nome);
$query = "select *from $tabela where nome_amigavel='$nome' and modo='$modo';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"] > 0;
};
function retorne_somente_nome_amigavel_idusuario($uid, $modo, $pagina){
global $tabela_banco;
$tabela = $tabela_banco[28];
if($modo == 0){
		$query = "select *from $tabela where uid='$uid' and modo='$modo';";
}else{
		$query = "select *from $tabela where modo='$modo' and pagina='$pagina';";
};
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0][NOME_AMIGAVEL];
};
function retorne_url_amigavel_usuario($uid, $modo, $pagina){
global $tabela_banco;
global $variavel_campo;
$tabela = $tabela_banco[28];
if($modo == 0){
		$query = "select *from $tabela where uid='$uid' and modo='$modo';";
}else{
		$query = "select *from $tabela where modo='$modo' and pagina='$pagina';";
};
$dados_query = plugin_executa_query($query);
$nome_amigavel = $dados_query["dados"][0][NOME_AMIGAVEL];
if($nome_amigavel == null){
		$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid";
}else{
		if($modo == 0){
				$url = HOST_SERVIDOR."/$nome_amigavel";
	}else{
				$url = HOST_SERVIDOR."/$variavel_campo[47]/$nome_amigavel";
	};
};
return $url;
};
function salvar_url_amigavel_usuario(){
global $idioma_sistema;
global $tabela_banco;
$nome = retorne_campo_formulario_request(31);
$modo = retorne_campo_formulario_request(6);
$imagem_sistema[0] = retorne_imagem_sistema(41, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(42, null, false);
$idpagina = retorne_idpagina_request();
if($idpagina != null and $modo == 1 and retorne_usuario_logado_dono_pagina($idpagina) == false){
		$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[399]</div>
	</div>
	";
		$array_retorno["dados"] = mensagem_erro($mensagem[0]);
		return json_encode($array_retorno);
};
if($modo == null){
		$modo = 0;
};
$uid = retorne_idusuario_logado();
if(strlen($nome) > TAMANHO_URL_AMIGAVEL or $nome == null or is_numeric($nome) == true){
		$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[393]</div>
	</div>
	";
		$array_retorno["dados"] = mensagem_erro($mensagem[0]);
		return json_encode($array_retorno);
};
if(retorne_nome_url_amigavel_existe($nome, $modo) == true){
		if(retorne_nome_amigavel($nome) == retorne_somente_nome_amigavel_idusuario($uid, $modo, retorne_idpagina_request())){
				$mensagem[0] = $idioma_sistema[396];
	}else{
				$mensagem[0] = $idioma_sistema[392];
	};
		$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$mensagem[0]</div>
	</div>
	";
		$array_retorno["dados"] = mensagem_erro($mensagem[0]);
		return json_encode($array_retorno);
};
$nome = retorne_nome_amigavel($nome);
$tabela = $tabela_banco[28];
if($modo == 0){
		$query[0] = "delete from $tabela where uid='$uid' and modo='$modo';";
}else{
		$query[0] = "delete from $tabela where uid='$uid' and modo='$modo' and pagina='$idpagina';";
};
$query[1] = "insert into $tabela values(null, '$uid', '$nome', '$modo', '$idpagina');";
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
$url_amigavel = retorne_url_amigavel_usuario($uid, $modo, $idpagina);
$mensagem[0] = "
<div class='classe_mensagem_salvar_url_amigavel'>
<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[0]</div>
<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[395]</div>
<div class='classe_mensagem_salvar_url_amigavel_2'>
<span class='classe_span_2'>$url_amigavel</span>
</div>
</div>
";
$array_retorno["dados"] = mensagem_sucesso($mensagem[0]);
return json_encode($array_retorno);
};
function atualiza_retorna_dados_usuario_logado_sessao(){
return $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];
};
function atualiza_retorna_dados_usuario_sessao($modo, $limpa_direto){
if($limpa_direto == true){
		retorne_pode_retornar_dados_usuario_nova_consulta(1, retorne_idusuario_request(), null);
	retorne_pode_retornar_dados_usuario_nova_consulta(1, retorne_idusuario_logado(), null);
};
if($modo == true){
	    $_SESSION[SESSAO_DADOS_USUARIO][retorne_idusuario_request()] = retorne_dados_compilados_usuario(retorne_idusuario_request());
	$_SESSION[SESSAO_DADOS_USUARIO_LOGADO] = retorne_dados_compilados_usuario(retorne_idusuario_logado());
}else{
		return $_SESSION[SESSAO_DADOS_USUARIO][retorne_idusuario_request()];
};
};
function cadastrar_usuario(){
global $idioma_sistema;
global $tabela_banco;
$nome = converte_minusculo(retorne_campo_formulario_request(31));
$sobrenome = converte_minusculo(retorne_campo_formulario_request(32));
$email = converte_minusculo(retorne_campo_formulario_request(33));
$nova_senha = converte_minusculo(retorne_campo_formulario_request(34));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(35));
$nome = captular($nome);
$sobrenome = captular($sobrenome);
$email = trim($email);
if($nome == null or $sobrenome == null or $email == null or $nova_senha == null or $nova_senha_confirma == null){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[355]);
		return json_encode($array_retorno);	
};
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[305].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
		return json_encode($array_retorno);		
};
if(is_numeric($nome) == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[303]);
		return json_encode($array_retorno);	
};
if(is_numeric($sobrenome) == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[304]);
		return json_encode($array_retorno);	
};
if($nova_senha != $nova_senha_confirma){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[302]);
		return json_encode($array_retorno);
};
if(verifica_se_email_valido($email) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
		return json_encode($array_retorno);
};
if(retorna_palavra_chave_existe_string($nome, "@") == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[516]);
		return json_encode($array_retorno);	
};
if(retorna_palavra_chave_existe_string($sobrenome, "@") == true){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[517]);
		return json_encode($array_retorno);	
};
$data_atual = data_atual();
if(retorne_email_cadastrado($email) == false){
		$nova_senha = codifica_md5($nova_senha);
    	$query[0] = "select *from $tabela_banco[0] where e_mail='$email';";
	$query[1] = "insert into $tabela_banco[0] values(null, '$email', '$nova_senha', '$data_atual');";
		plugin_roda_query($query[1]);
		$array_dados = plugin_roda_query($query[0]);	
		$idusuario = $array_dados["dados"][0][UID];
		$array_dados_perfil[] = $idusuario;
	$array_dados_perfil[] = $nome;
	$array_dados_perfil[] = $sobrenome;
	    salva_sessao_usuario($email, $nova_senha, $idusuario);
		$array_retorno["dados"] = -1;
		atualiza_perfil_usuario_cadastrar($array_dados_perfil);
		adicionar_ativar_usuario();
		adiciona_nome_amigavel_cadastrar($nome, $sobrenome);
		return json_encode($array_retorno);
}else{
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[7]);
		return json_encode($array_retorno);
};
};
function constroe_imagem_perfil_miniatura_sem_nome($uid, $modo_medio){
$nome_usuario = retorne_nome_usuario(true, $uid);
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);
if($modo_medio == true){
		$url_host_miniatura = $dados_imagem[URL_HOST_MEDIO];
}else{
		$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];
};
if($url_host_miniatura == null){
		$dados_perfil = retorne_dados_perfil_usuario($uid);
		if(retorne_sexo_usuario($dados_perfil) == true){
				$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	}else{
				$url_host_miniatura = retorne_imagem_sistema(8, false, true);
	};
		if($dados_perfil[SEXO] == null){
				$url_host_miniatura = retorne_imagem_sistema(40, false, true);
	};
};
$campo[1] = "
<div class='classe_div_imagem_perfil_amigo_imagem_2'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</div>
";
$html = "
<div class='classe_div_imagem_perfil_amigo' id='$idcampo[0]'>
$campo[1]
</div>
";
return $html;
};
function constroe_opcoes_menu_topo_usuario(){
global $url_link_acao;
if(retorne_usuario_logado() == false){
        return null;	
};
$modo_mobile = retorne_modo_mobile();
$modo_plano_fundo = retorne_modo_plano_fundo();
$link[0] = retorna_links(3, null);
$campo_menu[0] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[0]</div>
";
if($url_link_acao[1] != null){
        $campo_menu[1] = "
	<div class='classe_div_opcao_menu_suspense'>$url_link_acao[1]</div>
    ";	
};
$campo_menu[2] = "
<div class='classe_div_opcao_menu_suspense'>$link[0]</div>
";
$campo_menu[3] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[5]</div>
";
$campo_menu[4] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[28]</div>
";
$campo_menu[5] = opcao_mobile_menu_topo();
$corpo_menu_suspense = "
$campo_menu[4]
$campo_menu[0]
$campo_menu[1]
$campo_menu[3]
$campo_menu[5]
$campo_menu[2]
";
if($modo_plano_fundo == true){
		$menu_suspense[0] = constroe_menu_suspense(false, null, false, 52, "menu_suspense_opcoes_topo", $corpo_menu_suspense);
}else{
		$menu_suspense[0] = constroe_menu_suspense(false, null, false, null, "menu_suspense_opcoes_topo", $corpo_menu_suspense);
};
if($modo_mobile == false){
	$imagem_usuario = constroe_imagem_perfil_miniatura_topo(retorne_idusuario_logado());
		$campo[0] = "
	$imagem_usuario
	";
};
$html = "
<div class='classe_div_opcoes_topo'>
$menu_suspense[0]
</div>
<div class='classe_div_opcoes_topo_imagem_usuario'>
$campo[0]
</div>
";
return $html;
};
function converte_campo_perfil_numero_texto($conteudo){
global $idioma_sistema;
global $codigos_especiais;
$conteudo = trim(converte_minusculo($conteudo));
$conteudos_disponiveis = explode($codigos_especiais[12], trim(converte_minusculo($idioma_sistema[10])));
if(is_numeric($conteudo) == true){
		return $conteudos_disponiveis[$conteudo];
};
$contador = 0;
foreach($conteudos_disponiveis as $valor){
		if($valor != null){
				if($valor == $conteudo){
						return $contador;
		};
				$contador++;
	};
};
return null;
};
function excluir_dados_usuario(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
foreach($tabela_banco as $tabela){
        if($tabela != null){
	    	    $query[0] = "delete from $tabela where uid='$idusuario';";
		$query[1] = "delete from $tabela where uidamigo='$idusuario';";
				plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);
	};
};
};
function executar_antes_logout(){
remove_conteudo_url_nao_publicado();
remover_recomendacoes_usuario();
};
function logar_usuario($email, $senha, $modo_json){
global $idioma_sistema;
global $tabela_banco;
$email_parametro = $email;
$senha_parametro = $senha;
if($email_parametro == null or $senha_parametro == null){
		$email = converte_minusculo(retorne_campo_formulario_request(0));
	$senha = converte_minusculo(retorne_campo_formulario_request(1));
}else{
		$email = $email_parametro;
	$senha = $senha_parametro;
};
$uid = retorne_idusuario_amigavel($email, 0, null);
if(verifica_se_email_valido($email) == false and $uid == null){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
		if($modo_json == true){
				return json_encode($array_retorno);
	}else{
				return false;
	};
};
if($modo_json == true){
		$senha = codifica_md5($senha);
};
if($uid == null){
		$query = "select *from $tabela_banco[0] where e_mail='$email' and senha='$senha';";
}else{
		$query = "select *from $tabela_banco[0] where uid='$uid' and senha='$senha';";
};
$array_dados = plugin_executa_query($query);
$dados = retorne_dados_comando($array_dados["comando"]);
$idusuario = $array_dados["dados"][0][UID];
$linhas = $array_dados["linhas"];
if($linhas == 0){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[6]);
		if($modo_json == true){
				return json_encode($array_retorno);
	}else{
				return false;
	};
};
salva_sessao_usuario($email, $senha, $idusuario);
atualiza_retorna_dados_usuario_sessao(true, true);
remove_recuperar_senha_logar();
aplica_idioma_usuario();
erradicar_recomendacoes();
$array_retorno["dados"] = -1;
if($modo_json == true){
		return json_encode($array_retorno);
}else{
		return true;
};
};
function logout_usuario(){
executar_antes_logout();
session_unset();
salva_sessao_usuario(null, null, null);
};
function retorna_email_usuario_logado(){
global $tabela_banco;
$dados_compilados_usuario = $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];
$dados_login = $dados_compilados_usuario[$tabela_banco[0]];
return $dados_login[E_MAIL];
};
function retorna_senha_usuario_logado(){
global $tabela_banco;
$dados_compilados_usuario = $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];
$dados_login = $dados_compilados_usuario[$tabela_banco[0]];
return $dados_login[SENHA];
};
function retorne_dados_compilados_usuario($idusuario){
global $tabela_banco;
$dados_usuario = retorne_dados_usuario($idusuario);
$contador = 0;
foreach($tabela_banco as $tabela){
		if($tabela != null){
				$nome_campo = $tabela_banco[$contador];
				$array_dados_tabela[$nome_campo] = $dados_usuario[$contador][0];
				$array_todos_dados[$nome_campo] = $dados_usuario[$contador];
				switch($tabela){
			case $tabela_banco[4]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[5]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[6]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[8]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[10]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[11]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[13]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[16]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[18]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[19]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[20]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[21]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			case $tabela_banco[22]: 						$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
		};
				$contador++;
	};
};
$array_dados_tabela = seta_dados_compilados_padrao($array_dados_tabela);
return $array_dados_tabela;
};
function retorne_dados_imagem_usuario($modo, $uid){
global $tabela_banco;
switch($modo){
	case 0:
		$tabela = $tabela_banco[2];
		$query = "select *from $tabela where uid='$uid';";
	break;
	case 1:
		$tabela = $tabela_banco[20];
		$query = "select *from $tabela where id='$uid';";
	break;
};
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_dados_perfil_usuario_logado(){
global $tabela_banco;
$dados = atualiza_retorna_dados_usuario_logado_sessao();
return $dados[$tabela_banco[1]];
};
function retorne_dados_sessao_usuario_logado(){
return $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];
};
function retorne_dados_usuario($idusuario){
global $tabela_banco;
if(retorne_pode_retornar_dados_usuario_nova_consulta(2, $idusuario, null) == false){
		return retorne_pode_retornar_dados_usuario_nova_consulta(3, $idusuario, null);
};
$array_retorno = array();
$pagina = retorne_idpagina_request();
foreach($tabela_banco as $tabela){
		if($tabela != null){
        		switch($tabela){
			case $tabela_banco[4]: 					    if($pagina == null){
								$query = "select *from $tabela where uid='$idusuario' and modo_chat='0' and pagina='';";
			}else{
								$query = "select *from $tabela where modo_chat='0' and pagina='$pagina';";
			};			
			break;
			case $tabela_banco[5]: 			$query = null;
			break;
		    case $tabela_banco[6]: 			$query = "select *from $tabela where uid='$idusuario' order by id asc;";
			break;
			case $tabela_banco[7]: 			$query = null;
			break;
			case $tabela_banco[8]: 			$query = null;
			break;
			case $tabela_banco[10]: 			$query = "select *from $tabela where uid='$idusuario' and uidbloqueou='$idusuario';";
			break;
			case $tabela_banco[15]: 			$query = null;
			break;
			case $tabela_banco[16]: 			$query = "select *from $tabela order by id asc;";
			break;
			case $tabela_banco[20]: 			$query = "select *from $tabela where id='$pagina';";
			break;	
			case $tabela_banco[21]: 			$query = "select *from $tabela where id='$pagina';";
			break;		
			case $tabela_banco[22]: 			$query = "select *from $tabela where uidamigo='$idusuario';";
			break;
			case $tabela_banco[23]: 			$query = null;
			break;
			case $tabela_banco[24]: 			$query = null;
			break;
			case $tabela_banco[25]: 			$query = null;
			break;
			case $tabela_banco[26]: 			$query = null;
			break;
			case $tabela_banco[27]: 			$query = null;
			break;			
			case $tabela_banco[28]: 			$query = null;
			break;	
			case $tabela_banco[29]: 			$query = null;
			break;
			case $tabela_banco[30]: 			$query = null;
			break;
			case $tabela_banco[35]: 			$query = null;
			break;
			case $tabela_banco[37]: 			$query = null;
			break;
			case $tabela_banco[38]: 			$query = null;
			break;
			case $tabela_banco[39]: 			$query = null;
			break;
			default:
            $query = "select *from $tabela where uid='$idusuario';";
			break;
		};
		        $array_dados = plugin_executa_query($query);
				$array_retorno[] = $array_dados["dados"];
	};
};
retorne_pode_retornar_dados_usuario_nova_consulta(0, $idusuario, $array_retorno);
return $array_retorno;
};
function retorne_data_texto_ultima_visualizacao_conexao($uid, $modo_json){
global $tabela_banco;
if($uid == null){
        $uid = retorne_idusuario_logado();
};
$tabela = $tabela_banco[17];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
$data = $dados_query["dados"][0][DATA_CONEXAO];
if($data == null){
		return null;
};
$data = converte_data_amigavel(true, $data);
return $data;
};
function retorne_data_ultima_visualizacao_conexao($uid, $modo_json){
if($uid == null){
        $uid = retorne_idusuario_logado();
};
if(retorne_usuario_online($uid) == true){
		$imagem[0] = retorne_imagem_sistema(107, null, false);
		$html = "
	<span>$imagem[0]</span>
	";
}else{
		$html = retorne_data_texto_ultima_visualizacao_conexao($uid, $modo_json);
};
if($modo_json == true){
		$array_retorno["dados"] = $html;
		return json_encode($array_retorno);
}else{
		return $html;
};
};
function retorne_email_cadastrado($email){
global $tabela_banco;
$query[0] = "select *from $tabela_banco[0] where e_mail='$email';";
$array_dados = plugin_executa_query($query[0]);
return $array_dados["linhas"] == 1;
};
function retorne_idusuario_email($email){
global $tabela_banco;
$query[0] = "select *from $tabela_banco[0] where e_mail='$email';";
$array_dados = plugin_executa_query($query[0]);
return $array_dados["dados"][0][UID];
};
function retorne_idusuario_existe($uid){
global $tabela_banco;
$tabela = $tabela_banco[0];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return false;
}else{
		return true;
};
};
function retorne_idusuario_logado(){
return $_SESSION[SESSAO_IDUSUARIO];
};
function retorne_idusuario_request(){
global $variavel_campo;
$idusuario = remove_html($_REQUEST[$variavel_campo[5]]);
$pagina = retorne_idpagina_request();
if($idusuario == null){
		$idusuario = retorne_idusuario_amigavel_requeste(0);
};
if($idusuario == null){
		$idusuario = retorne_idusuario_logado();
};
if(retorne_modo_pagina() == true and $idusuario == null){
		$idusuario = retorne_idusuario_dono_pagina($pagina);
};
return $idusuario;
};
function retorne_imagem_sexo_usuario($modo, $dados_perfil, $uid){
global $tabela_banco;
$modo_mobile = retorne_modo_mobile();
if($dados_perfil == null){
		$dados_perfil = retorne_dados_compilados_usuario($uid);
		$dados_perfil = $dados_perfil[$tabela_banco[1]];
};
if($dados_perfil[SEXO] == null){
		if($modo_mobile == true){
				return retorne_imagem_sistema(93, false, $modo);		
	}else{
				return retorne_imagem_sistema(39, false, $modo);
	};
};
if(retorne_sexo_usuario($dados_perfil) == true){
		if($modo_mobile == true){
				return retorne_imagem_sistema(91, false, $modo);
	}else{
				return retorne_imagem_sistema(11, false, $modo);	
	};
}else{
		if($modo_mobile == true){
				return retorne_imagem_sistema(92, false, $modo);		
	}else{
				return retorne_imagem_sistema(24, false, $modo);
	};
};
};
function retorne_modo_sexo_usuario($conteudo){
global $idioma_sistema;
global $codigos_especiais;
$conteudo = trim(converte_minusculo($conteudo));
$conteudos_disponiveis = explode($codigos_especiais[12], trim(converte_minusculo($idioma_sistema[36])));
if(is_numeric($conteudo) == true){
		switch($conteudo){
		case 1:
		return $conteudos_disponiveis[1];
		break;
		case 2:
		return $conteudos_disponiveis[2];
		break;
		default:
		return null;
	};
};
if($conteudo == $conteudos_disponiveis[1]){
		return 1;
};
if($conteudo == $conteudos_disponiveis[2]){
		return 2;
};
return null;
};
function retorne_nome_link_usuario($modo_espaco, $uid){
return retorne_link_perfil_amigavel_idusuario($modo_espaco, true, $uid, null);
};
function retorne_nome_usuario($modo, $uid){
global $tabela_banco;
global $idioma_sistema;
$dados_compilados_usuario = retorne_dados_compilados_usuario($uid);
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
if($modo == true){
		$nome = $dados_perfil[NOME]." ".$dados_perfil[SOBRENOME];
}else{
		$nome = $dados_perfil[NOME];
};
if($dados_perfil[NOME] == null){
		$nome = $idioma_sistema[415];
};
return $nome;
};
function retorne_numero_estado_usuario_logado(){
global $idioma_sistema;
$estados = explode(",", $idioma_sistema[39]);
$dados_perfil = retorne_dados_perfil_usuario_logado();
$estado_usuario = $dados_perfil[ESTADO];
$contador = 0;
foreach($estados as $estado){
		if($estado != null){
				$estado = converte_minusculo($estado);
		$estado_usuario = converte_minusculo($estado_usuario);
				if($estado == $estado_usuario){
						return $contador - 1;
		};
				$contador++;
	};
};
return -1;
};
function retorne_pasta_usuario($idusuario, $tipo_pasta, $modo){
global $pasta_root_sistema;
global $pasta_host_sistema;
$pasta_usuario_root = $pasta_root_sistema["arquivos_usuarios"].codifica_md5($idusuario)."/";
$pasta_usuario_servidor = $pasta_host_sistema["arquivos_usuarios"].codifica_md5($idusuario)."/";
$pagina = retorne_idpagina_request();
switch($tipo_pasta){
    case 1:
    $sub_pasta = "imagem_perfil";
    break;
    case 2:
    $sub_pasta = "album_imagens";
    break;
    case 3:
    $sub_pasta = "album_musicas";
    break;
    case 4:
    $sub_pasta = "imagens_chat";
    break;
    case 5:
    $sub_pasta = "wallpaper_usuario";
    break;
    case 6:
    $sub_pasta = "album_videos";
    break;
    case 7:
    $sub_pasta = "imagens_paginas";
    break;
	case 8:
	$sub_pasta = "imagem_capa_usuario";
	break;
	case 9:
	$sub_pasta = "imagens_publicacoes";
	break;
	case 10:
	$sub_pasta = "imagem_capa_pagina_usuario";
	break;
    default:
    return $pasta_usuario_root;
};
if($pagina == null){
        $pasta_usuario_root .= $sub_pasta."/";
    $pasta_usuario_servidor .= $sub_pasta."/";
}else{
        $pasta_usuario_root .= $sub_pasta."/".$pagina."/";
    $pasta_usuario_servidor .= $sub_pasta."/".$pagina."/";	
};
criar_pasta($pasta_usuario_root);
if($modo == true){
        return $pasta_usuario_root;
}else{
        return $pasta_usuario_servidor;
};
};
function retorne_pode_retornar_dados_usuario_nova_consulta($modo, $idusuario, $array_dados){
switch($modo){
	case 0: 	$_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] = $array_dados;
	break;
	case 1: 	$_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] = null;
	break;
	case 2: 	if($_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] == null){
				return true;
	}else{
				return false;
	};
	break;
	case 3: 	return $_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario];
	break;
};
};
function retorne_sexo_idusuario($uid){
return retorne_sexo_usuario(retorne_dados_perfil_usuario($uid));
};
function retorne_sexo_texto_usuario($dados_perfil){
global $idioma_sistema;
if($dados_perfil[SEXO] == null){
		return null;
};
$array_campos_sexo = explode(",", $idioma_sistema[36]);
if(retorne_sexo_usuario($dados_perfil) == true){
		return $array_campos_sexo[1];
}else{
		return $array_campos_sexo[2];
};
};
function retorne_sexo_usuario($dados_perfil){
global $idioma_sistema;
if($dados_perfil[UID] == null){
		return 1;
};
$array_campos_sexo = explode(",", $idioma_sistema[388]);
if($dados_perfil[SEXO] == null){
		return 1;
};
return $dados_perfil[SEXO] == $array_campos_sexo[1];
};
function retorne_sexo_usuario_logado(){
return retorne_sexo_usuario(retorne_dados_perfil_usuario(retorne_idusuario_logado()));
};
function retorne_sexo_usuario_perfil(){
return retorne_sexo_usuario(retorne_dados_perfil_usuario(retorne_idusuario_request()));
};
function retorne_usuario_logado(){
if(DESLOGAR_TODOS_USUARIOS == true){
		return false;
};
return $_SESSION[SESSAO_LOGADO];
};
function retorne_usuario_online($uid){
global $tabela_banco;
$tabela = $tabela_banco[17];
if($uid == null){
        $uid = retorne_idusuario_logado();
};
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
if($dados_query["dados"][0][DATA_CONEXAO] == null){
        return false;
};
$tempo_diferenca = diferenca_data_conexao($dados_query["dados"][0][DATA_CONEXAO]);
if($tempo_diferenca <= TEMPO_FICAR_OFFLINE){
        return true;
}else{
        return false;
};
};
function salva_sessao_usuario($email, $senha, $idusuario){
$tempo_vida = time() + (COOKIES_DIAS * 24 * 3600);
$_SESSION[SESSAO_EMAIL] = $email;
$_SESSION[SESSAO_SENHA] = $senha;
$_SESSION[SESSAO_IDUSUARIO] = $idusuario;
if($email != null and $senha != null){
	    $_SESSION[SESSAO_LOGADO] = true;
}else{
		$_SESSION[SESSAO_LOGADO] = false;
};
setcookie(COOKIE_EMAIL, $email, $tempo_vida, "/");
setcookie(COOKIE_SENHA, $senha, $tempo_vida, "/");
};
function seta_dados_compilados_padrao($array_dados_tabela){
global $tabela_banco;
global $idioma_sistema;
$dados_perfil = $array_dados_tabela[$tabela_banco[1]];
$dados_imagem = $array_dados_tabela[$tabela_banco[2]];
$imagem_sistema[0] = retorne_imagem_sistema(5, null, true);
$imagem_sistema[1] = retorne_imagem_sistema(6, null, true);
$imagem_sistema[2] = retorne_imagem_sistema(7, null, true);
$imagem_sistema[3] = retorne_imagem_sistema(8, null, true);
$imagem_sistema[4] = retorne_imagem_sistema(39, null, true);
$imagem_sistema[5] = retorne_imagem_sistema(40, null, true);
if($dados_imagem[UID] == null){
		$array_campos = explode(",", $idioma_sistema[388]);
		if($dados_perfil[SEXO] == $array_campos[1]){
			    $array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[0];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[2];
	}else{
				$array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[1];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[3];
	};
		if($dados_perfil[SEXO] == null){
			    $array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[4];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[5];
	};
};
return $array_dados_tabela;
};
function verificador_usuario_logado(){
$incremento = TEMPO_TIMER_CONEXAO / 1000;
$modo = retorne_campo_formulario_request(6);
if($incremento == 0){
		$incremento = 1;
};
$identificador[0] = SESSAO_DESLOGAR_AUTOMATICO;
$identificador[1] = codifica_md5(SESSAO_DESLOGAR_AUTOMATICO.retorne_idusuario_logado());
$token = retorna_token_pagina_requeste();
$contador = 0;
foreach($_SESSION[$identificador[1]] as $valor){
		if($modo == $valor){
				$contador++;
	};
};
$_SESSION[$identificador[1]][$token] = $modo;
if($contador == 0){
		$_SESSION[$identificador[0]] = 0;	
};
if($_SESSION[$identificador[0]] >= NUMERO_SEGUNDOS_DESLOGAR_AUTOMATICO){
		$_SESSION[$identificador[0]] = 0;
		if(retorna_configuracao_privacidade(4, retorne_idusuario_logado()) == true){
				logout_usuario();
	};
}else{
		$_SESSION[$identificador[0]] += $incremento;
};
$array_retorno["dados"] = retorne_usuario_logado();
$array_retorno[MODO] = $modo;
return json_encode($array_retorno);
};
function constroe_campo_anexar_videos($modo, $menu_id){
global $idioma_sistema;
global $variavel_campo;
$nome_usuario = retorne_nome_usuario_logado();
$idcampo[0] = codifica_md5("id_formulario_upload_video_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_dialogo_upload_video_".retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_previsualiza_videos_publicacao();
$imagem_usuario = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());
$funcao[0] = "exibe_dialogo(\"$idcampo[1]\")";
$funcao[1] = "previsualiza_videos_publicacao(\"$idcampo[2]\")";
$funcao[2] = "fechar_menu_suspense(\"$menu_id\")";
$evento[0] = "onclick='$funcao[0];'";
if($modo == true){
		$formulario_upload = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[0], $variavel_campo[43], 80, false, 3, "$funcao[0], $funcao[2], $funcao[1];");
}else{
		$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], $variavel_campo[43], 80, false, 3);
};
$formulario_upload = "
<div class='classe_div_campo_upload_video'>
$formulario_upload
</div>
";
$campo_upload[0] = constroe_caixa_descritiva($idioma_sistema[354], $nome_usuario.$idioma_sistema[372], $imagem_usuario);
$campo_upload[0] .= $formulario_upload;
$campo_upload[0] = constroe_dialogo($idioma_sistema[371], $campo_upload[0], $idcampo[1]);
if($modo == true){
		$texto[0] = $idioma_sistema[371];
		$campo[0] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $evento[0]>$texto[0]</span>
	</div>
	";
}else{
		$texto[0] = retorne_imagem_sistema(111, null, false);
		$campo[0] = "
	<span class='classe_visualizador_videos_perfil_basico_add_span span_link' $evento[0]>
	$texto[0]
	</span>
	";
};
$array_retorno["html"] = $campo[0];
$array_retorno["dialogo"] = $campo_upload[0];
return $array_retorno;
};
function constroe_campo_previsualizar_videos_publicacao(){
$idcampo[0] = retorne_idcampo_previsualiza_videos_publicacao();
$html = "
<div class='classe_campo_previsualizar_videos_publicacao' id='$idcampo[0]'></div>
";
return $html;
};
function constroe_opcoes_video($dados, $idcampo_1){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
if($uid != retorne_idusuario_logado()){
		return constroe_link_abrir_media($dados);
};
if($idcampo_1 == null){
		$idcampo_1 = retorne_idcampo_md5();
};
$idcampo[0] = codifica_md5("id_dialogo_excluir_video_usuario_".$uid.$id.retorne_contador_iteracao());
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='excluir_video_usuario(\"$id\", \"$idcampo_1\", \"$idcampo[0]\");'";
$nome_usuario = retorne_nome_usuario_logado();
$imagem_sistema[0] = retorne_imagem_sistema(36, null, false);
$campo[0] = "
<div class='separa_opcao_player_video_pergunta'>
$nome_usuario$idioma_sistema[593]
</div>
<div class='separa_opcao_player_video_resposta'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>
";
$campo[0] = constroe_dialogo($idioma_sistema[588], $campo[0], $idcampo[0]);
$campo[1] = "
<div class='classe_div_opcao_menu_suspense' $evento[0]>
<div class='separa_opcao_player_video'>
$imagem_sistema[0]
</div>
<span class='separa_opcao_player_video_titulo span_link'>
$idioma_sistema[592]
</span>
</div>
";
$campo[1] = constroe_menu_suspense(false, null, retorne_modo_mobile(), null, null, $campo[1]);
$campo[2] = constroe_link_abrir_media($dados);
$html = "
$campo[2]
<div class='classe_separa_player_media_opcoes' id='$idcampo_1'>
$campo[1]
</div>
$campo[0]
";
return $html;
};
function constroe_pesquisar_videos(){
global $idioma_sistema;
global $url_link_acao;
global $pagina_inicial;
global $variavel_campo;
$uid = retorne_idusuario_request();
$idcampo[0] = codifica_md5("id_campo_pesquisa_video_entrada_".retorne_contador_iteracao());
$idcampo[1] = retorna_idcampo_conteudo_geral();
$idcampo[2] = codifica_md5("id_campo_pesquisa_video_progresso_".retorne_contador_iteracao());
$idcampo[3] = codifica_md5("id_campo_pesquisa_video_informacoes_".retorne_contador_iteracao());
$barra_progresso[0] = campo_progresso_gif($idcampo[2]);
$funcao[0] = "pesquisar_videos_usuarios(\"$idcampo[0]\", \"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\");";
$evento[0] = "onkeyup='$funcao[0]'";
$evento[1] = "onclick='$funcao[0]'";
$script[0] = "
<script>
$funcao[0]
</script>
";
$video = retorne_campo_formulario_request(44);
$campo_upload_videos = constroe_campo_anexar_videos(false, null);
$campo_upload_videos_html = $campo_upload_videos["html"];
$campo_upload_videos_dialogo = $campo_upload_videos["dialogo"];
$numero_videos = retorne_tamanho_resultado(retorne_numero_videos_usuario(retorne_idusuario_request()));
$link[0] = "<a href='$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=82' title='$idioma_sistema[375]'>$idioma_sistema[375] - $numero_videos</a>";
$campo[0] = "
<div class='classe_pesquisa_videos_entrada'>
<div class='classe_pesquisa_videos_div_entrada_caixa_texto'>
<input type='text' placeholder='$idioma_sistema[376]' id='$idcampo[0]' value='$video' $evento[0]>
</div>
<div class='classe_pesquisa_videos_div_entrada_botao'>
<input type='button' value='$idioma_sistema[66]' $evento[1]>
</div>
</div>
";
$campo[1] = "
<div class='classe_resultados_pesquisa_videos' id='$idcampo[1]'></div>
";
$campo[2] = "
<div class='classe_resultados_pesquisa_progresso'>$barra_progresso[0]</div>
";
$campo[3] = "
<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[1]>
$idioma_sistema[61]
</div>
";
$campo[4] = "
<div class='classe_pesquisa_videos_informacoes classe_cor_5' id='$idcampo[3]'></div>
";
$campo[5] = "
<div class='classe_pesquisa_videos_links_1'>
<div class='classe_pesquisa_videos_links_separa'>
$link[0]
</div>
</div>
<div class='classe_pesquisa_videos_links_2'>
$campo_upload_videos_html
</div>
$campo_upload_videos_dialogo
";
$html = "
<div class='classe_pesquisa_videos'>
$campo[0]
$campo[5]
$campo[2]
$campo[1]
$campo[4]
$campo[3]
</div>
$script[0]
";
return constroe_conteudo_padrao(true, $html, null);
};
function constroe_player_video_perfil($dados_query){
global $variavel_campo;
$contador = 0;
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$url_pagina_inicial = PAGINA_INICIAL;
$html .= recurso_medias();
$imagem_sistema[0] = retorne_imagem_sistema(35, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(38, null, false);
$tamanho_player = TAMANHO_PLAYER_VIDEO_PERFIL;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_video = $dados[URL_HOST_VIDEO];
	$chave = $dados[CHAVE];
	$data = $dados[DATA];
		$url_midia = $url_host_video;
		$modo_musica = false;
		if($id != null and $url_midia != null){
				$idcampo[0] = retorne_idcampo_md5();
		$idcampo[1] = retorne_idcampo_md5();
		$idcampo[2] = retorne_idcampo_md5();
				$campo_player = "<video id='$idcampo[0]' src='$url_midia' type='video/mp4' controls='controls' width='$tamanho_player' height='$tamanho_player'></video>";
				$html .= "
		<div class='classe_separa_player_perfil' id='$idcampo[1]'>
		<div class='classe_separa_player_media' id='$idcampo[2]'>
		<div class='classe_separa_player_media_player'>
		$campo_player	
		</div>
		</div>
		</div>
		";
	};
};
$html .= recurso_medias();
return $html;
};
function constroe_videos_publicacao($chave){
global $tabela_banco;
$tabela = $tabela_banco[27];
$query = "select *from $tabela where chave='$chave';";
if(retorne_numero_linhas_query($query) > 1){
		$html = constroe_player_playlist(false, plugin_executa_query($query));
}else{
		$html = constroe_player(false, plugin_executa_query($query));
};
if($html == null){
		return null;
};
$html = "
<div class='classe_player_video'>$html</div>
";
return $html;
};
function constroe_visualizar_videos_perfil(){
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
$uid = retorne_idusuario_request();
$numero_videos = retorne_tamanho_resultado(retorne_numero_videos_usuario($uid));
$tabela = $tabela_banco[27];
$limit = "limit ".NUMERO_VIDEOS_CAMPO_PERFIL;
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$link[0] = "$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=82";
$link[0] = "
<a href='$link[0]' title='$numero_videos'>
$idioma_sistema[591]$numero_videos
</a>";
$campo[0] = "
<div class='classe_visualizador_video_perfil_basico_titulo'>
$link[0]
</div>
";
$campo[1] = constroe_player_playlist(false, $dados_query);
$html = "
<div class='classe_videos_miniatura_perfil_usuario'>
<div class='classe_videos_miniatura_perfil_usuario'>
<div class='classe_numero_videos_perfil_usuario_topo'>
$campo[0]
</div>
</div>
<div class='classe_videos_miniatura_perfil_usuario_videos'>
$campo[1]
</div>
</div>
";
return $html;
};
function excluir_video_usuario($id, $chave){
global $tabela_banco;
if(retorne_usuario_logado() == false){
		return null;
};
$idusuario = retorne_idusuario_logado();
$tabela = $tabela_banco[27];
if($chave != null){
		$query = "select *from $tabela where (id='$id' or chave='$chave') and uid='$idusuario';";
}else{
		$query = "select *from $tabela where id='$id' and uid='$idusuario';";
};
$dados_query = plugin_executa_query($query);
$contador = 0;
$linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$uid = $dados[UID];
	$url_root_video = $dados[URL_ROOT_VIDEO];
		if($id != null and $uid == $idusuario){
				$query = "delete from $tabela where id='$id' and uid='$idusuario';";
				plugin_executa_query($query);
				exclui_arquivo_unico($url_root_video);
	};
};
};
function pesquisar_videos_usuarios(){
global $tabela_banco;
global $idioma_sistema;
if(retorna_chave_request() == null){
		return null;
};
$tabela = $tabela_banco[27];
$video = retorne_campo_formulario_request(44);
$identificador_sessao = SESSAO_TERMO_PESQUISA_VIDEO.retorna_chave_request();
$identificador_sessao_numero = SESSAO_PESQUISA_VIDEO_NUMERO_ENCONTROU.retorna_chave_request();
$nome_usuario = retorne_nome_usuario_logado();
if($_SESSION[$identificador_sessao] != $video){
		$_SESSION[$identificador_sessao] = $video;
		contador_avanco(retorne_campo_formulario_request(2), 2);
		$_SESSION[$identificador_sessao_numero] = 0;
		$zerou_contador = 1;
}else{
		$zerou_contador = -1;
};
if(contador_avanco(retorne_campo_formulario_request(2), 3) == 0){
		$_SESSION[$identificador_sessao_numero] = 0;	
};
$limit = retorne_limit_query_iniciar(false, null);
if($video == null){
		$uid = retorne_idusuario_request();
		$query[0] = "select *from $tabela where uid='$uid' order by id desc $limit;";
	$query[1] = "select *from $tabela where uid='$uid' order by id desc;";
}else{
		$query[0] = "select *from $tabela where titulo_video like '%$video%' order by id desc $limit;";
	$query[1] = "select *from $tabela where titulo_video like '%$video%' order by id desc;";
};
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);
$numero_linhas[0] = $dados_query[1]["linhas"];
$numero_linhas[1] = $dados_query[0]["linhas"];
$_SESSION[$identificador_sessao_numero] += $numero_linhas[1];
if($numero_linhas[1] == 0){
		contador_avanco(retorne_campo_formulario_request(2), 4);
		$array_retorno["dados"] = null;
	$array_retorno["zerou_contador"] = $zerou_contador;
	$array_retorno["informacoes"] = null;
		return json_encode($array_retorno);
};
if($numero_linhas[0] == 0){
		$html = $nome_usuario.$idioma_sistema[377];
};
if($numero_linhas[0] == 1){
		$html = $nome_usuario.$idioma_sistema[378];
};
if($numero_linhas[0] > 1){
		$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 3);
		$numero_linhas[0] = retorne_tamanho_resultado($numero_linhas[0]);
		$html = $numero_linhas[0].$idioma_sistema[379].$_SESSION[$identificador_sessao_numero].$idioma_sistema[380];
};
$array_retorno["dados"] = constroe_player(false, $dados_query[0]);
$array_retorno["zerou_contador"] = $zerou_contador;
$array_retorno["informacoes"] = $html;
return json_encode($array_retorno);
};
function previsualiza_videos_publicacao($chave){
$array_retorno["dados"] = constroe_videos_publicacao($chave);
return json_encode($array_retorno);
};
function retorne_idcampo_previsualiza_videos_publicacao(){
return codifica_md5("idcampo_previsualiza_videos_publicacao_".retorne_idusuario_logado());
};
function retorne_numero_videos_usuario($uid){
global $tabela_banco;
$tabela = $tabela_banco[27];
$query = "select *from $tabela where uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function carrega_visitas_perfil(){
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
$array_dados_visitas = $dados_compilados_usuario[$tabela_banco[11]];
$array_dados_visitas = inverte_array($array_dados_visitas);
if(is_array($array_dados_visitas) == false){
        return null;
};
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);
for($contador == $contador; $contador <= $contador_final; $contador++){
        if($array_dados_visitas[$contador][UIDAMIGO] != null){
                $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $array_dados_visitas[$contador][UIDAMIGO]);
	    $campo_visitas = retorne_numero_visitas($array_dados_visitas[$contador][UIDAMIGO], true);
				$data = converte_data_amigavel(true, $array_dados_visitas[$contador][DATA]);
				$html .= "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3' title='$data'>
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		<div class='classe_div_perfil_usuario_configuracao_opcoes_separa span_link'>$campo_visitas</div>
		<div class='classe_div_perfil_usuario_configuracao_opcoes_separa span_link'>$data</div>
		</div>
		</div>
		";
	};
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function limpar_visitas_perfil(){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "delete from $tabela_banco[11] where uid='$idusuario';";
plugin_executa_query($query);
};
function retorne_numero_visitas($idusuario, $modo){
global $tabela_banco;
global $idioma_sistema;
$idusuario_logado = retorne_idusuario_logado();
$query = "select *from $tabela_banco[11] where uid='$idusuario_logado' and uidamigo='$idusuario';";
$dados_query = plugin_executa_query($query);
$numero_visitas = $dados_query["dados"][0][NUMERO_VISITAS];
if($modo == true){
        if($numero_visitas > 1){
	    	    $numero_visitas = retorne_tamanho_resultado($numero_visitas).$idioma_sistema[132];
	}else{
	    	    $numero_visitas = $idioma_sistema[133].$numero_visitas.$idioma_sistema[134];
	};
};
return $numero_visitas;
};
function visitar_perfil(){
global $tabela_banco;
$idusuario = retorne_idusuario_request();
if(retorne_usuario_dono_perfil($idusuario) == true){
        return null;
};
$idusuario_logado = retorne_idusuario_logado();
if(retorne_pode_bloquear($idusuario_logado) == false){
		return null;
};
$data = data_atual();
$query[0] = "select *from $tabela_banco[11] where uid='$idusuario' and uidamigo='$idusuario_logado';";
$query[1] = "insert into $tabela_banco[11] values(null, '$idusuario', '$idusuario_logado', '1', '$data');";
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] == 0){
		plugin_executa_query($query[1]);
}else{
		$data_visitou = $dados_query["dados"][0][DATA];
		if($data != $data_visitou){
				$numero_visitas = ($dados_query["dados"][0][NUMERO_VISITAS] + 1);
				$query[2] = "delete from $tabela_banco[11] where uid='$idusuario' and uidamigo='$idusuario_logado';";
				$query[3] = "insert into $tabela_banco[11] values(null, '$idusuario', '$idusuario_logado', '$numero_visitas', '$data');";
				plugin_executa_query($query[2]);
		plugin_executa_query($query[3]);
	};
};
};
function adiciona_visualizado($id, $tabela_campo){
global $tabela_banco;
if($id == null or $tabela_banco == null){
		return null;
};
$data = data_atual();
$tabela = $tabela_banco[40];
$uid = retorne_idusuario_logado();
$query[0] = "select id from $tabela_campo;";
$query[1] = "select id from $tabela where id_post='$id' and uid='$uid';";
$query[2] = "insert into $tabela values(null, '$uid', '$id', '$tabela_campo', '$data');";
if(retorne_numero_linhas_query($query[0]) == 0){
		return null;
};
if(retorne_numero_linhas_query($query[1]) != 0){
		return null;
};
plugin_executa_query($query[2]);
};
function constroe_visualizado($id, $tabela_campo){
global $tabela_banco;
if($id == null or $tabela_banco == null){
		return null;
};
$tabela = $tabela_banco[40];
$query = "select id from $tabela where id_post='$id' and tabela_campo='$tabela_campo';";
$visualizacoes = retorne_tamanho_resultado(retorne_numero_linhas_query($query));
$imagem_sistema[0] = retorne_imagem_sistema(131, null, false);
$html = "
<div class='campo_visualizado classe_cor_4'>
	<span class='classe_campo_visualizado_separa_span_1'>
		$imagem_sistema[0]
	</span>
	<span class='classe_campo_visualizado_separa_span_2 span_link'>
		$visualizacoes
	</span>
</div>
";
return $html;
};
function remove_visualizado($id, $tabela_campo){
global $tabela_banco;
if($id == null or $tabela_banco == null){
		return null;
};
$tabela = $tabela_banco[40];
$query = "delete from $tabela where id_post='$id' and tabela_campo='$tabela_campo';";
plugin_executa_query($query);
};
?>
