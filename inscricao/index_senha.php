<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_erros', 1);
 error_reporting(E_ALL); 
	session_start();
	if(@$_POST['senha']=='12ceep34'){
		$_SESSION['logado']="true";
		header("Location:inscricao.php");	
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Inscrição on line</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="../inscricao2020/css/steps.css">
    <style>
        body{
            background-image: url('../img/bg1.jpg');
        }

    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<form action="" method="post">
		<h1>Inscrições em breve...</h1>
		<p>As inscrições para as turmas de julho devem ser abertas em alguns dias aguarde...</p>
		<label for="">Informe a senha</label>
		<input type="password" name="senha">
		<input type="submit" name="Entrar" value="Entrar">
	</form>
</body>
</html>
