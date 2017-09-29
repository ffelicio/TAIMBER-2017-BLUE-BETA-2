<?php

// retorna a imagem do sistema
function retorne_imagem_sistema($numero_imagem, $url_link, $modo_url){

// globals
global $extensao_arquivo;
global $idioma_sistema;
global $pasta_host_sistema;
global $semana_idioma;

// pasta com imagens
$pasta_imagens = $pasta_host_sistema["imagens_sistema"];

// extensao padrao
$extensao_padrao = $extensao_arquivo["png"];

// configuracoes extras
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

// url da imagem
$url_imagem = $pasta_imagens.$numero_imagem.$extensao_padrao;

// valida modo url de retorno
if($modo_url != null){
    
	// retorno
	return $url_imagem;
	
};

// valida aplicar link
if($url_link != null){
	
	// html
	$html = "<a href='$url_link' title='$titulo_imagem'><img src='$url_imagem' title='$titulo_imagem' alt='$titulo_imagem'></a>";
	
}else{
	
	// html
	$html = "<img src='$url_imagem' title='$titulo_imagem' alt='$titulo_imagem'>";
	
};

// adiciona div
$html = "
<div class='classe_div_imagem_sistema_geral'>
$html
</div>
";

// retorno
return $html;

};

?>
