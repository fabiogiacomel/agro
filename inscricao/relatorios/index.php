<?php
// echo $_SERVER['REQUEST_METHOD'];
// echo $_POST['senha'];
if (($_SERVER['REQUEST_METHOD'] === 'POST') &&
    ($_POST['senha'] == '12ceep34')) {
    ?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<meta charset="UTF-8">
	<title>Incrições do CEEP</title>
	<style type="text/css">
		a{color:#515151;text-decoration: none;}
	</style>
</head>
<body>

<br><br><br><br><br><br>
<table width="100%">
	<tr>
		<td align="center">
			<a href="inscricaoCursoRel.php">
			<img src="../images/relatorio2.jpg"  width="125px" alt="Inscrições concluídas"/>
			<h4>Inscrições por curso<!-- concluídas  por curso até 10/07/2016--></h4>
			</a>
		</td>
		<!--<td align="center">
			<a href="editalClassificacao.php">
			<img src="../images/relatorio2.jpg"  width="125px" alt="Classificação"/>
			<h4>Edital de classificação por curso</h4>
			</a>
		</td>
		<td align="center">
			<a href="inscricaoPorOpcao.php">
			<img src="../images/relatorio2.jpg"  width="125px" alt="Classificação"/>
			<h4>Classificação Geral A-Z</h4>
			</a>
		</td>
	 	<td align="center">
			<a href="inscricaoCursoDia.php">
			<img src="../images/relatorio2.jpg"  width="125px" alt="Inscrições por dia"/>
			<h4>Inscrições por Dia</h4>
			</a>
		</td>

		<td align="center">
			<a href="../exportarGmail.php">
			<img src="../images/gmail.png"  width="125px" alt="Exportar"/>
			<h4>Exportar para GMail</h4>
			</a>
		</td> 
	 	<td align="center">
			<a href="../inscricaoReservaRel.php">
			<img src="../images/reserva.png"  width="125px" alt="Reservas"/>
			<h4>Cadastro de reserva</h4>
			</a>
		</td>
	
	 <td align="center">
			<a href="inscricaoCursoRel2.php">
			<img src="../images/relatorio2.jpg"  width="125px" alt=""/>
			<h4>Cadastro de reserva por curso (após 03/11/2019)</h4>
			</a>
		</td>
 		<td align="center">
			<a href="index.php?pagina=inscricaoIncompleta.php">
			<img src="../images/relatorio3.jpg"  width="125px" alt="Inscrições pendentes"/>
			<h4>Inscrições pendentes</h4>
			</a>
		</td> 

	 	<td align="center">
			<a href="../index.php?pagina=condensadoTotal">
			<img src="../images/relatorio4.jpg"  width="125px" alt="Inscrições iniciadas"/>
			<h4>Total de inscrições inciadas</h4>
			</a>
		</td> -->

		<td align="center">
			<a href="inscricaoCondensadoRel.php">
			<img src="../images/relatorio5.jpg"  width="125px" alt="Condensada"/>
			<h4>Total de inscrições</h4>
			</a>
		</td>
		<td align="center">
			<a href="../exportarGmail.php">
			<img src="../images/gmail.png"  width="125px" alt="Exportar"/>
			<h4>Exportar para GMail</h4>
			</a>
		</td> 
     <!--   <td align="center">
			<a href="inscricaoCondensadoRel2.php">
			<img src="../images/relatorio5.jpg"  width="125px" alt="Condensada"/>
			<h4>Cadastro de reserva (totais)</h4>
			</a>
		</td>-->

		<td align="center">
			<a href="inscricaoDiaRel.php">
			<img src="../images/relatorio.jpg"  width="125px" height="125px" alt="Incrições dia"/>
			<h4>Relatório incrições por dia</h4>
			</a>
		</td>

		<td align="center">
			<a href="inscricaoReimprimir.php">
			<img src="../images/imprimir.png"  width="125px" height="125px" alt="Incrições dia"/>
			<h4>Reimpressão da incrições</h4>
			</a>
		</td>
		<!-- <td align="center">
			<a href="../inscricaoRecalcular.php">
			<img src="../images/calculadora.png"  width="125px" height="125px" alt="Recalcular Notas"/>
			<h4>Recalcular Notas</h4>
			</a>
		</td> -->
	</tr>
</table>

</body>
</html>
<?php

} else {
    ?>
<!DOCTYPE html>
<html>
<head>
  <title>Clientes</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
  <div class="container">
  	<br><br><br><br><br>
  <div class="row">
<form class="col-md-8 offset-2" method="post" action="">
      <label for="inputPassword">Informe a senha para acessar os relatórios</label>
      <input name="senha" type="password" class="form-control" id="inputPassword" placeholder="Password"><br>
  <button type="submit" class="btn btn-primary">Entrar</button>
</form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>
