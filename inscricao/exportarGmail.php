<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Exportar para o GMail</title>
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
    //document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));     
    document.getElementById('curso').options.add(new Option("Segurança do Trabalho", "7"));     
    //document.getElementById('curso').options.add(new Option("Especialização Técnica em Enfermagem do Trabalho", "10"));     
    // document.getElementById('curso').options.add(new Option("Móveis", "11"));     
  }
}
 </script>

</head>
<body onload="valida_curso();">

  <?php     
  require_once("alunoClass.php");
  
   $numero_processo = date("m") < 7 ? "02" : "01";
   $ano_processo = date("m") < 7 ? Date("Y") : Date("Y")+1;

   $processo = $ano_processo.$numero_processo;
  //Criando e Instanciando o objeto
    $a = Aluno::getInstance();
    $resposta = null;
    $result   = null;       
    $result_reserva   = null;       
    $total = 0;     

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $a->__set('serial',$_POST['serial']);
      $a->__set('periodo',$_POST['periodo']);
      $a->__set('curso',$_POST['curso']);

      $result = $a->consultaByCurso();  
      //$result_reserva = $a->consultaReservaByCurso(); 
    }  
?>
<div class="container">
  <hr>
<form name="form1" method="post" class="form-inline">

  <label class="sr-only">Modalidade:</label>
  <select class="form-control mb-2 mr-sm-2" name="serial"  onChange="valida_curso();" required>
    <!-- <option value="" selected="1">Selecione uma opção</option> -->
    <!-- <option value="1">Integrado</option> -->
    <option value="2">Subsequente</option>
  </select>

    <label class="sr-only">Período:</label>
    <select class="form-control mb-2 mr-sm-2" id="periodo" name="periodo" onChange="valida_curso();" required>
      <!-- <option value="" selected="1">Selecione um Período</option> -->
      <!-- <option value="1">Matutino</option> -->
      <!-- <option value="2">Vespertino</option> -->
      <option value="3" selected="selected">Noturno</option>
    </select>
    
    <label class="sr-only">Curso:</label>
    <select class="form-control mb-2 mr-sm-2" id="curso" name="curso" required>
      <option value="">Selecione o curso</option>
    </select>
    <button type="submit"  class="btn btn-primary mb-2" value="exportar">
      Exportar
    </button>
</form>














	


	<?php 

		$cursos  = array(1 => "Administração", 
  								2 => "Eletrônica",
  								3 => "Eletromecânica",
  								4 => "Enfermagem",
  								5 => "Informática",
  								6 => "Meio Ambiente",
  								7 => "Segurança do Trabalho",
  								// 8 => "Guia de Turismo Regional",
                  9 => "Edificações",
                  10=> "Especialização Técnica em Enfermagem do Trabalho",
  								// 11=> "Móveis",
  								);
  	$modalidades = array(1 => "Integrado", 2 => "Subsequente");
 		$periodos = array(1 => "Matutino", 2 => "Vespertino", 3 => "Noturno");
	


    require("csv.php");
    $csv = new CSV();
	?>


  <!-- 

  Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Group Membership,E-mail 1 - Type,E-mail 1 - Value,E-mail 2 - Type,E-mail 2 - Value,Phone  1 - Type,Phone 1 - Value
  
  -->
<?php
   if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "<hr>";
    echo "<h4 class='text-center'>Contatos". $cursos[$_POST['curso']].$processo."&nbsp; <a href='".$cursos[$_POST['curso']].$processo.".csv' class='btn btn-primary'>Donwload</a></h4><hr>";
  }
?>

<table class="table table-sm">
  <thead class="">
    <tr>
     <!--  <th scope="col">Protocolo</th>
      <th scope="col">Data</th> -->
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Celular</th>
      <th scope="col">Email</th>


    </tr>
  </thead>
  

	
	<?php
		
  function inverteData($data){
      if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
      }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
      }
    }

		$count = 0;


//echo "<td>".$cursos[$inscricao->curso]."</td><td>".$modalidades[$inscricao->serial]."</td><td>".$periodos[$inscricao->periodo]."</td><td align='center'>nada</td></tr>";
      $csv->addLine( 
      new CSVLine( 'Name','Given Name','Additional Name','Family Name','Yomi Name','Given Name Yomi','Additional Name Yomi','Family Name Yomi','Name Prefix','Name Suffix','Initials','Nickname','Short Name','Maiden Name','Birthday','Gender','Location','Billing Information','Directory Server','Mileage','Occupation','Hobby','Sensitivity','Priority','Subject','Notes','Group Membership','E-mail 1 - Type','E-mail 1 - Value','E-mail 2 - Type','E-mail 2 - Value','Phone  1 - Type','Phone 1 - Value' ));

 		if($result != null){
		foreach ($result as $inscricao) {
	 		
			$total++;
			// if ($count==0){
			// 	echo "<tr class='normal'>";
			// 	$count = 1; 
			// }else{
			// 	echo "<tr class='diferente'>";
			// 	$count = 0;
			// }
			echo "<tbody><tr>";
    
     

			echo "<td>".strtoupper($inscricao->nome).
					 "</td><td>".$inscricao->cpf.
					 "</td><td>".$inscricao->fonecelular.	
					 "</td><td>".$inscricao->email;
           // "</td><td>".$cursos[$_POST['curso']].$ano_processo.$numero_processo."</td>";	
      echo "</tr>";  
      $csv->addLine( 
      new CSVLine( $inscricao->nome,'','','','','','','','','','','','','',$inscricao->datanasc,'','','','','','','','','','','',$cursos[$_POST['curso']].$processo,'* Work',$inscricao->email,'','','Mobile', $inscricao->fonecelular));

		}
    echo "<tr class='normal'><th colspan='12' align='left'>Número total de inscritos na turma: ".$total."</th></tr></table>";
    $csv->save( $cursos[$_POST['curso']].$processo.".csv" );   
    }
		?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>