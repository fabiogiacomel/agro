<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de tarefas a realizar</title>

	<!-- <link href="css/tablesorter.css" rel="stylesheet"> -->
	<link href="../css/form.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-latest.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript">
	$(document).ready(function()
    {
        $(".tablesorter").tablesorter();
    }
);
</script>
</head>

<body>
	<h3>Clique no título da coluna para ordenar</h3>
<?php

//$_SESSION['destino'] = "UsuarioRel.php";
require_once "../alunoClass.php";

//Criando e Instanciando o objeto
$a = Aluno::getInstance();
$resposta = null;
?>
	<table  border="1" id="myTable" class="tablesorter">
	<thead>
	<tr>
	  <th >Curso</th><th >Modalidade</th><th >Período</th><th >Número de inscritos</th><th >Situação</th>
	</tr>
	</thead>
	<tbody>
	<?php
$result = $a->consultaInscricoesCondensado();

$count = 0;
$cursos = array(
    null => "Erro: sem curso",
    1 => "Administração",
    2 => "Eletrônica",
    3 => "Eletromecânica",
    4 => "Enfermagem",
    5 => "Informática",
    6 => "Meio Ambiente",
    7 => "Segurança do Trabalho",
    // 8 => "Guia de Turismo Regional",Espólio
    9 => "Edificações",
    10 => "Especialização Técnica em Enfermagem do Trabalho",
    // 11=> "Móveis",
);
$modalidades = array(null => "Erro: sem modalidade", 1 => "Integrado", 2 => "Subsequente");
$periodos = array(null => "Erro: sem periodo", 1 => "Matutino", 2 => "Vespertino", 3 => "Noturno");

$total = 0;
foreach ($result as $inscricao) {
    $total += $inscricao->total;
    if ($count == 0) {
        echo "<tr class='normal'>";
        $count = 1;
    } else {
        echo "<tr class='diferente'>";
        $count = 0;
    }
    echo "<td>" . $cursos[$inscricao->curso] . "</td><td>" . $modalidades[$inscricao->serial] . "</td><td>" . $periodos[$inscricao->periodo] . "</td><td align='center'>" . $inscricao->total . "</td>";

    if ($inscricao->total > 35) {
        echo "<td align='center'><img src='../images/ok.png' alt='ok' width='30'> </td>";
    } else {
        echo "<td> </td>";
    }
    echo "</tr>";
}
echo "</tbody>
		</table>";
echo "<h3>Total de inscrições concluídas: " . $total . "</h3>";
?>

		</body>
		</html>

