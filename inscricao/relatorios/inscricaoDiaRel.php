<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de tarefas a realizar</title>
	<link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../css/form.css"/>
		<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.tablesorter.min.js"></script>
		<script>

$(function(){
	// Parser para configurar a data para o formato do Brasil
	$.tablesorter.addParser({
		id: 'datetime',
		is: function(s) {
			return false;
		},
		format: function(s,table) {
			s = s.replace(/\-/g,"/");
			s = s.replace(/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/, "$3/$2/$1");
			return $.tablesorter.formatFloat(new Date(s).getTime());
		},
		type: 'numeric'
	});

	$('.tablesorter').tablesorter({
        // Envia os cabeçalhos
        headers: {
            // A sgunda coluna (começa do zero)

			0: {
                // Ativa o parser de data na coluna 4 (começa do 0)
                sorter: 'datetime'
			}
        },
		// Formato de data
		dateFormat: 'dd/mm/yyyy'
	});
});


	</script>
</head>

<body>
<?php

//$_SESSION['destino'] = "UsuarioRel.php";
require_once "../alunoClass.php";

//Criando e Instanciando o objeto
$a = Aluno::getInstance();
$resposta = null;
?>
	<table  border="1" id="myTable" class="tablesorter">
		<thead><tr>
	  <th width="50%">Dia</th><th width="40%" >Quantidade</th>
	</tr>	</thead><tbody>
	<?php
$result = $a->consultaInscricoesDia();

$count = 0;
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

$total = 0;
foreach ($result as $inscricao) {
    if ($count == 0) {
        echo "<tr class='normal'>";
        $count = 1;
    } else {
        echo "<tr class='diferente'>";
        $count = 0;
    }
    $total += $inscricao->total;
    echo "<td>" . date_format(date_create($inscricao->data), 'd/m/Y') . "</td><td align='center'>" . $inscricao->total . "</td></tr>";
}

?>
		</tbody>
		</table>
		<?php
echo "<h3>Total de inscrições concluídas: " . $total . " </h3>";
?>