<?php
// session_start();
$pagina = "../inscricaoImprime.php";
?>
<!doctype html>
<html lang="pt_BR">
<head>
<meta charset="utf-8">
<title>Inscrição on line</title>
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<!-- <script src="../js/jquery.maskedinput.min.js" type="text/javascript"></script>-->
 <script src="../js/jquery.mask.js" type="text/javascript"></script>



<script type="text/javascript">

  jQuery(function($){
    $("#cpf").mask('000.000.000-00', {reverse: true});
  });
  function validar() {
  //validando cpf;
  cpf = document.form1.cpf.value;

  cpf = cpf.replace(/[^\d]+/g,'');
  if(cpf == ''){
    document.getElementById('msg_erro').innerHTML = "<div id='erro' class='MSG_ERRO'>Erro: CPF ou CGM Inválido</div>";
    return false;
  }

 // Elimina CPFs invalidos conhecidos
  if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
    document.getElementById('msg_erro').innerHTML = "<div id='erro' class='MSG_ERRO'>Erro: CPF Inválido</div>";
    return false;
  }

  // Valida 1o digito
  add = 0;
  for (i=0; i < 9; i ++) add += parseInt(cpf.charAt(i)) * (10 - i);

  rev = 11 - (add % 11);

  if (rev == 10 || rev == 11) rev = 0;
  if (rev != parseInt(cpf.charAt(9))){
    document.getElementById('msg_erro').innerHTML = "<div id='erro' class='MSG_ERRO'>Erro: CPF Inválido</div>";
    return false;
   }
  // Valida 2o digito
  add = 0;
  for (i = 0; i < 10; i ++) add += parseInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);

  if (rev == 10 || rev == 11)     rev = 0;

  if (rev != parseInt(cpf.charAt(10))) {
    document.getElementById('msg_erro').innerHTML = "<div id='erro' class='MSG_ERRO'>Erro: CPF Inválido</div>";
    return false;
 }
 return true();
}
 </script>

</head>
<body>

<form id="form" name="form1" novalidate  method="get" action="<?php echo $pagina; ?>" onsubmit="return validar()">
  <div>
  <h1>Reimpressão de comprovante</h1>

  <label>CPF: </label>
  <input type="text" name="cpf" id="cpf" ><input type="submit" value="Avançar"/>
  <div id="msg_erro">
  <?php

// echo $mensagem;

?>
  </div>
</form>
</body>
</html>