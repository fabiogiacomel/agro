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
	<link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../css/formsad.css"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style>
  /*label{width: 150px; display: inline-block;}*/
  /*label.clear{width: auto;}*/
  .aviso{background-color: yellow;}
  label.umquarto{width: 150px;}
  /*input[type="text"]{width: 500px;}*/
  /*select{width: 503px;}*/

  /*input[type="text"].meio  {width: 245px;}*/
  input[type="text"].umquarto{width: 170px; margin-right: 5px;}
  select.umquarto{width: 180px; margin-right: 5px;}
  input[type="submit"]{width: 170px; margin-left: 10px;}

	h2{text-align: center;}
  td{font-size: 0.8em;}
  th{font-size: 0.8em;}

</style>

<script type="text/javascript">



function valida_curso(){
	var periodo = document.form1.periodo[document.form1.periodo.selectedIndex].value;
  var serial  = document.form1.serial[document.form1.serial.selectedIndex].value;
  if (( periodo == "")||( serial == "")){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add("Selecione um Curso", "");
  }

  //integrado manhÄ‚Â£
  if (serial == 1 && periodo == 1  ){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um curso", ""));
    document.getElementById('curso').options.add(new Option("Administração", "1"));
    document.getElementById('curso').options.add(new Option("Edificações", "9"));
    document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
    document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
    document.getElementById('curso').options.add(new Option("Informática", "5"));
    document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));

    /*document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
    document.getElementById('curso').options.add(new Option("Guia de Turismo Regional", "8"));*/
  }

  //Integrado tarde
  if (serial == 1 &&  periodo == 2 ){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um curso", ""));

    document.getElementById('curso').options.add(new Option("Administração", "1"));
    document.getElementById('curso').options.add(new Option("Edificações", "9"));
    document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
    document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
    document.getElementById('curso').options.add(new Option("Informática", "5"));
    document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
    //document.getElementById('curso').options.add(new Option("Enfermagem", "4"));

    //document.getElementById('curso').options.add(new Option("Segurança do Trabalho", "7"));
    /*document.getElementById('curso').options.add(new Option("Guia de Turismo Regional", "8"));*/
  }


    //Integrado noite
  if (serial == 1 &&  periodo == 3 ){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um Curso", ""));
     }

  // sub manha
  if (serial == 2 && periodo == 1 ){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um curso", ""));
    document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
  }

  //sub tarde
  if (periodo == 2 && serial == 2){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um Curso", ""));

  }

  // sub noite
  if (periodo == 3 && serial == 2){
    document.getElementById('curso').length=0;
    document.getElementById('curso').options.length=0;
    document.getElementById('curso').options.add(new Option("Selecione um curso", ""));
    document.getElementById('curso').options.add(new Option("Administração", "1"));
    document.getElementById('curso').options.add(new Option("Edificações", "9"));
    document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
    document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
    document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
    document.getElementById('curso').options.add(new Option("Informática", "5"));
    document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
    document.getElementById('curso').options.add(new Option("Segurança do Trabalho", "7"));
    document.getElementById('curso').options.add(new Option("Especialização Técnica em Enfermagem do Trabalho", "10"));
    // document.getElementById('curso').options.add(new Option("Móveis", "11"));
  }

  <?php if(isset($_POST['curso'])) 
    echo "document.getElementById('curso').value = '".$_POST['curso']."'";
  ?>
}
 </script>

</head>
<!-- <body onload="valida_curso();">
 -->
 <body onload="valida_curso()">
<?php
include "../alunoClass.php";

//Criando e Instanciando o objeto
$a = Aluno::getInstance();
$resposta = null;
$result = null;
$total = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a->__set('serial', $_POST['serial']);
    $a->__set('periodo', $_POST['periodo']);
    $a->__set('curso', $_POST['curso']);

    $result = $a->consultaByCurso();
}

?>
  <form class="jumbotron d-print-none" style="padding: 1rem" name="form1" method="post" action="<?php $SELF_PHP;?>">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label>Modalidade:</label>
      <select class="form-control" name="serial"  onChange="valida_curso();" required>
        <option value="" selected="1">Selecione uma opção</option>
        <option value="1" <?php if(isset($_POST['serial']) && $_POST['serial']=='1') echo "selected" ?>>Integrado</option>
        <option value="2" <?php if(isset($_POST['serial']) && $_POST['serial']=='2') echo "selected" ?>>Subsequente</option>
      </select> 
    </div>
    <div class="form-group col-md-3">
      <label>Período:</label>
      <select class="form-control" id="periodo" name="periodo" onChange="valida_curso();" required>
        <option value="" selected="1">Selecione um Período</option>
        <option value="1" <?php if(isset($_POST['periodo']) && $_POST['periodo']=='1') echo "selected" ?>>Matutino</option>
        <option value="2" <?php if(isset($_POST['periodo']) && $_POST['periodo']=='2') echo "selected" ?>>Vespertino</option>
        <option value="3" <?php if(isset($_POST['periodo']) && $_POST['periodo']=='3') echo "selected" ?>>Noturno</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label>Curso:</label>
      <select class="form-control" id="curso" name="curso" required>
        <option value="">Selecione o curso</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label>&nbsp;</label>
      <button type="submit" class="btn btn-primary form-control">Consultar</button>
    </div>
  </div>
	</form>


	<?php

$cursos = array(
    1 => "Administração",
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

    echo "<h3 class='text-center'>" .
        $cursos[$_POST['curso']] . " - " .
        $modalidades[$_POST['serial']] . " - " .
        $periodos[$_POST['periodo']]. " <input class='d-print-none btn btn-primary' type='button' value='Imprimir' onClick='window.print()'/></h3>";
}

?>

	<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col  d-print-none">Protocolo</th>
        <th scope="col">Data inscr.</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Fone Resid.</th>
        <th scope="col">Fone Celuar</th>
       <!--  <th scope="col">E-Mail</th> -->
        <th scope="col">Cidade</th>
        <th scope="col">CGM</th>
        <th scope="col">Média Matemática</th>
        <th scope="col">Média Português</th>
        <?php
          if (@$_POST['curso'] == 4) {
            echo "<th scope='col'>Média Química</th>
            <th scope='col'>Média Biologia</th>";
          }
        ?>
        <th scope="col">Beneficiario</th>
        <th scope="col">Escola pública</th>
        <th scope="col">Email</th>
        <th scope="col">Pontuação</th>
      </tr>
    </thead>
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

//echo "<td>".$cursos[$inscricao->curso]."</td><td>".$modalidades[$inscricao->serial]."</td><td>".$periodos[$inscricao->periodo]."</td><td align='center'>nada</td></tr>";

if ($result != null) {
    foreach ($result as $inscricao) {
        $total++;
        echo "<tr><td>" . $total .
        "</td><td>202002" . $inscricao->id .
        "</td><td>" . inverteData($inscricao->datainsc) .
        "</td><td>" . strtoupper($inscricao->nome);
        if ($inscricao->curso == $_POST['curso']){
          echo " <sup>1</sup>";
        }elseif ($inscricao->curso2 == $_POST['curso']){
          echo " <sup>2</sup>";
        }
        echo "</td><td>" . $inscricao->cpf .
        "</td><td>" . $inscricao->fonecasa .
        "</td><td>" . $inscricao->fonecelular .
/*         "</td><td>" . $inscricao->email .*/
        "</td><td>" . strtoupper($inscricao->cidade) .
        //"</td><td>".$inscricao->datanasc.
        "</td><td>" . $inscricao->cgm .
        "</td><td>" . $inscricao->maiormat .
        "</td><td>" . $inscricao->maiorport;
        if (@$_POST['curso']==4) {
            echo "</td><td>" . $inscricao->maiorqui;
            echo "</td><td>" . $inscricao->maiorbio;
        }
        if ($inscricao->bolsa_familia == 1) {
          echo "</td><td>30";
        }else{
          echo "</td><td>0";
        }


        if ($inscricao->serial == 2) { //Apenas para o subsequente)
         if ($inscricao->ensinomedio == 1) {
              echo "</td><td> 85"; //3; //Todo em rede pública
          }
  
          if ($inscricao->ensinomedio  == 2) {
              echo "</td><td>65"; //3; //Todo em rede particular
          }
  
          if ($inscricao->ensinomedio  == 3) {
              echo "</td><td>50"; //3; //No máximo 1 ano em rede particular
          }
  
          if ($inscricao->ensinomedio  == 4) {
              echo "</td><td>0"; //3; //No máximo 2 ano em rede particular
          }
  
          if ($inscricao->ensinomedio  == 5) {
              echo "</td><td>0"; //3; //Bolsista integral
          }
          if ($inscricao->ensinomedio==NUll || $inscricao->ensinomedio < 1 || $inscricao->ensinomedio > 5) {
            echo "</td><td>0"; //3;
          }
          
      } else {
        if ($inscricao->ensinofundamental == 1) {
              echo "</td><td>85"; //3;
          }
  
          if ($inscricao->ensinofundamental == 2) {
              echo "</td><td>65"; //1;
          }
  
          if ($inscricao->ensinofundamental == 3) {
              echo "</td><td>50"; //2;
          }
  
          if ($inscricao->ensinofundamental == 4) {
              echo "</td><td>30"; //3;
          }
  
          if ($inscricao->ensinofundamental == 5) {
              echo "</td><td>0"; //3;
          }
          if ($inscricao->ensinofundamental==NUll || $inscricao->ensinofundamental < 1 || $inscricao->ensinofundamental > 5) {
            echo "</td><td>0"; //3;
          }
          
      }
      echo "</td><td>" . $inscricao->email;

        if ($inscricao->curso == $_POST['curso']) {
          echo "</td><td>" . $inscricao->pontuacao . "</td></tr>";
        }elseif ($inscricao->curso2 == $_POST['curso']) {
          if($inscricao->pontuacao_curso2 > 0){
            echo "</td><td>" . $inscricao->pontuacao_curso2 . "</td></tr>";
          }else{
            echo "</td><td>" . $inscricao->pontuacao . "</td></tr>";
          }
        }
    }
}

echo "<tr class='normal'><td colspan='13' align='left'>Número total de inscritos na turma: " . $total . "</td></tr></table>";
?>
