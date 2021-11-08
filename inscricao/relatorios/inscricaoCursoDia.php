<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de inscritos por dia</title>
	<link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../css/form.css"/>

	<style>
    .aviso{background-color: yellow;}
    label.umquarto{width: 150px;}
    input[type="text"]{width: 170px; margin:0 5px;}
    input{width: 200px; margin: 5px 0;}
    select.umquarto{width: 180px; margin-right: 5px;}
    input[type="submit"]{width: 170px; margin-left: 10px;}
	  h2{text-align: center;}
  </style>
</head>
<body>
<?php
require_once "../alunoClass.php";

//Criando e Instanciando o objeto
$a = Aluno::getInstance();
$resposta = null;
$result = null;
$result_reserva = null;
$total = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a->__set('datainsc', $_POST['datainsc']);

    $result = $a->consultaByCursoDia();
}
?>
	<form name="form1" method="post" action="<?php $SELF_PHP;?>">
    <label class="umquarto">Data:</label>
	  <input type="date" name="datainsc" required>

    <input type="submit" value="consultar" />
	</form>
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

    echo "<h2>Relatório de Alunos por Dia </h2> ";
}
?>
	<table class="table" border="0">
	<tr>
    <th width="10%">Protocolo</th>
	  <th width="10%">Data inscr.</th>
    <th width="20%">Nome</th>
	  <th width="10%">CPF</th>
	  <th width="10%">Fone Resid.</th>
	  <th width="10%">Fone Celuar</th>
	  <th width="10%">E-Mail</th>
	  <th width="10%">Cidade</th>
    <th width="10%">CGM</th>
    <th width="10%">Média Matemática</th>
	  <th width="10%">Média Português</th>
	  <th width="5%">Pontuação</th>
	</tr>
	<?php
function inverteData($data)
{
    if (count(explode("/", $data)) > 1) {
        return implode("-", array_reverse(explode("/", $data)));
    } elseif (count(explode("-", $data)) > 1) {
        return implode("/", array_reverse(explode("-", $data)));
    }
}
$count = 0;

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

        echo "<td>" . Date("Y") . "01" . $inscricao->id .
        "</td><td>" . inverteData($inscricao->datainsc) .
        "</td><td>" . strtoupper($inscricao->nome) .
        "</td><td>" . $inscricao->cpf .
        "</td><td>" . $inscricao->fonecasa .
        "</td><td>" . $inscricao->fonecelular .
        "</td><td>" . $inscricao->email .
        "</td><td>" . strtoupper($inscricao->cidade) .
        "</td><td>" . $inscricao->cgm .
        "</td><td>" . $inscricao->maiormat .
        "</td><td>" . $inscricao->maiorport .
        "</td><td>" . $inscricao->pontuacao . "</td></tr>";
    }
}

echo "<tr class='normal'><td colspan='12' align='left'>Número total de inscritos na turma: " . $total . "</td></tr></table>";
?>
