<?php

// funcao para criar pasta
function criar_pasta($pasta){

// globals
global $idioma_sistema;

// url da pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// codigo html
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

// cria pastas e subpastas
if($pasta != null or is_dir($pasta) == false){

    // se o arquivo nao existir entao criar a pasta
    if(file_exists($pasta) == false){

        // cria pasta e subpastas
        mkdir($pasta, 0777, true); // criando pasta
		
		// endereco do arquivo
		$endereco_arquivo = $pasta."/index.html";
		
		// cria um arquivo html e redireciona para o index
		salvar_arquivo($endereco_arquivo, $html);

    };

};

};

?>
