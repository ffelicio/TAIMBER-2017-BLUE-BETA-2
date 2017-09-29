<?php

// monta a noticia
function monta_noticia($link, $title, $description, $date){

// html
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

// retorno
return $html;

};

?>