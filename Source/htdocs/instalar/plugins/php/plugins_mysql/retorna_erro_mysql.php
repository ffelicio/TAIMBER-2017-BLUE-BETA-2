<?php

// retorna erro de mysql
function retorna_erro_mysql($conexao){

// retorno
return mysqli_error($conexao);

};

?>