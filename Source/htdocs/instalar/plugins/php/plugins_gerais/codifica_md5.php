<?php

// codifica em md5
function codifica_md5($conteudo){

// esta funcao não deve ser alterada, porque as senhas funcionam em cima dela
// qualquer alteração nesta funcao e os logins não irão funcionar!

// retorno
return md5($conteudo).LOGOTIPO_MD5;

};

?>