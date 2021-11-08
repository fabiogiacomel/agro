<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de alunos antigos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"/>
	<link rel="stylesheet" type="text/css" href="form.css"/>

<!--  -->



</head>
<body>
<?php
require_once "../alunoClass.php";

//Criando e Instanciando o objeto
$a = Aluno::getInstance();
$resposta = null;
$result = null;
$total = 0;

//$result = $a->consultaAlunosAntigos();

?>



	<?php

$cursos = array(1 => "Administração",
    2 => "Eletrônica",
    3 => "Eletromecânica",
    4 => "Enfermagem",
    5 => "Informática",
    6 => "Meio Ambiente",
    7 => "Segurança do Trabalho",
    // 8 => "Guia de Turismo Regional",
    9 => "Edificações",
    10 => "Especialização Técnica em Enfermagem do Trabalho",
    // 11=> "Móveis",
);
$modalidades = array(1 => "Integrado", 2 => "Subsequente");
$periodos = array(1 => "Matutino", 2 => "Vespertino", 3 => "Noturno");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "<h2>Relatório de alunos por curso - " .
        $cursos[$_POST['curso']] . " - " .
        $modalidades[$_POST['serial']] . " - " .
        $periodos[$_POST['periodo']];
}

?>

	<table class="table" border="1">
	<tr>
    <th width="40%">Nome</th>
    <!-- <th width="10%">RG</th> -->
	  <!-- <th width="10%">CPF</th> -->
	  <th width="10%">Fone Resid.</th>
	  <th width="10%">Fone Celuar</th>
	  <th width="10%">E-Mail</th>
	  <th width="10%">Cidade</th>
    <th width="10%">Bairro</th>
    <th width="10%">Rua</th>
  </tr>
	<?php

$count = 0;

//echo "<td>".$cursos[$inscricao->curso]."</td><td>".$modalidades[$inscricao->serial]."</td><td>".$periodos[$inscricao->periodo]."</td><td align='center'>nada</td></tr>";

if ($result != null) {
    foreach ($result as $inscricao) {

        $total++;
        if ($count == 0) {
            echo "<tr class='normal'>";
            $count = 1;
        } else {
            echo "<tr class='diferente'>";
            $count = 0;
        }

        echo "<td>" . strtoupper($inscricao->nome) .
        // "</td><td>".$inscricao->rg.
        // "</td><td>".$inscricao->cpf.
        "</td><td>" . $inscricao->fonecasa .
        "</td><td>" . $inscricao->fonecelular .
        "</td><td>" . $inscricao->email .
        "</td><td>" . strtoupper($inscricao->cidade) .
        "</td><td>" . strtoupper($inscricao->bairro) .
        "</td><td>" . strtoupper($inscricao->rua) . "</td></tr>";
    }
}

echo "</table>";
?>
