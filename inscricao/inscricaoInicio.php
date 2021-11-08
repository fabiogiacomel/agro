<?php

date_default_timezone_set('America/Sao_Paulo');

$data1 = Date("Y-m-d"); //'2013-05-21' hoje;
// $data2 = '2017-12-04';//data de fim das inscrições

if (strtotime($data1) > strtotime($data2)) {
  //echo "<h2 style='color:red'>Vagas remanescentes/cadastro de reserva</h2>";
  // header('Location:inscricaoEncerrada.php');
}
?>
<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <title>Inscrição CEEP</title>
  <!-- <link href="form.css" rel="stylesheet" type="text/css" /> -->
  <style>
    .callout {
      padding: 20px;
      margin: 20px 0;
      border: 1px solid #eee;
      border-left-width: 5px;
      border-radius: 3px;
    }

    .callout h4 {
      margin-top: 0;
      margin-bottom: 5px;
    }

    .callout p:last-child {
      margin-bottom: 0;
    }

    .callout code {
      border-radius: 3px;
    }

    .callout+.bs-callout {
      margin-top: -5px;
    }

    .callout-default {
      border-left-color: #777;
    }

    .callout-default h4 {
      color: #777;
    }

    .callout-primary {
      border-left-color: #428bca;
    }

    .callout-primary h4 {
      color: #428bca;
    }

    .callout-success {
      border-left-color: #5cb85c;
    }

    .callout-success h4 {
      color: #5cb85c;
    }

    .callout-danger {
      border-left-color: #d9534f;
    }

    .callout-danger h4 {
      color: #d9534f;
    }

    .callout-warning {
      border-left-color: #f0ad4e;
    }

    .callout-warning h4 {
      color: #f0ad4e;
    }

    .callout-info {
      border-left-color: #5bc0de;
    }

    .callout-info h4 {
      color: #5bc0de;
    }

    .callout-bdc {
      border-left-color: #29527a;
    }

    .callout-bdc h4 {
      color: #29527a;
    }
  </style>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!--   <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
 -->  <script type="text/javascript" src="js/jquery.mask.js"></script>

  <script>
    $(function() {
      $(".dialog-confirm").dialog({
        resizable: false,
        height: 300,
        width: 600,
        modal: true,
        buttons: {
          "Continuar": function() {
            $(this).dialog("close");
          }

        }
      });
    });
  </script>


  <script type="text/javascript">
    $(document).ready(function() {
        $("#cpf").mask('000.000.000-00', {reverse: true});
    });

    function inicializar() {
      document.form1.periodo.selectedIndex = 0;
      document.form1.serial.selectedIndex = 0;
      document.form1.curso.selectedIndex = 0;
      valida_curso();
      valida_curso2();
    }

    function validar() {
      //verificando o curso periodo e modalidade
      var periodo = document.form1.periodo[document.form1.periodo.selectedIndex].value;
      var serial = document.form1.serial[document.form1.serial.selectedIndex].value;
      var curso = document.form1.curso[document.form1.curso.selectedIndex].value;
      var cpf = document.form1.cpf.value;

      if (serial == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione a Modalidade</div>";
        return false;
      }

      if (periodo == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione o Período</div>";
        return false;
      }

      if (curso == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione o Curso</div>";
        return false;
      }

      cpf = cpf.replace(/[^\d]+/g, '');

      if (cpf == '') {
        document.getElementById('msg_erro').innerHTML = "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
        return false;
      }


      // Elimina CPFs invalidos conhecidos
      if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
        document.getElementById('msg_erro').innerHTML = "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
        return false;
      }

      // Valida 1o digito
      add = 0;
      for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);

      rev = 11 - (add % 11);

      if (rev == 10 || rev == 11) rev = 0;
      if (rev != parseInt(cpf.charAt(9))) {
        document.getElementById('msg_erro').innerHTML = "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
        return false;
      }
      // Valida 2o digito
      add = 0;
      for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
      rev = 11 - (add % 11);

      if (rev == 10 || rev == 11) rev = 0;

      if (rev != parseInt(cpf.charAt(10))) {
        document.getElementById('msg_erro').innerHTML = "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
        return false;
      }
      return true;
    }


    function valida_curso() {
      var periodo = document.form1.periodo[document.form1.periodo.selectedIndex].value;
      var serial = document.form1.serial[document.form1.serial.selectedIndex].value;
      //  cpf_cgm(serial);
      if ((periodo == 0) || (serial == 0)) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        document.getElementById('curso').options.add(new Option("Selecione um Curso", "0"));
      }

      //integrado manhÄ‚Â£
      if (serial == 1 && periodo == 1) {
        document.getElementById('curso').length = 0;
        //document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        document.getElementById('curso').options.length = 0;
        document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso').options.add(new Option("Administração  ", "1"));
        document.getElementById('curso').options.add(new Option("Edificações  ", "9"));
        document.getElementById('curso').options.add(new Option("Eletrônica  ", "2"));
        document.getElementById('curso').options.add(new Option("Eletromecânica  ", "3"));
        document.getElementById('curso').options.add(new Option("Desenvolvimento de Sistemas  ", "19"));
        document.getElementById('curso').options.add(new Option("Meio Ambiente  ", "6"));
        //document.getElementById('curso').options.add(new Option("TÉCNICO EM AGRONEGÓCIOS  ", "17"));
        //document.getElementById('curso').options.add(new Option("TÉCNICO AGRÍCOLA  ", "18"));
      }

      //Integrado tarde
      if (serial == 1 && periodo == 2) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso').options.add(new Option("Administração  ", "1"));
        document.getElementById('curso').options.add(new Option("Edificações  ", "9"));
        document.getElementById('curso').options.add(new Option("Eletrônica  ", "2"));
        document.getElementById('curso').options.add(new Option("Eletromecânica  ", "3"));
        document.getElementById('curso').options.add(new Option("Desenvolvimento de Sistemas  ", "19"));
        document.getElementById('curso').options.add(new Option("Meio Ambiente  ", "6"));
      }


      //Integrado noite
      if (serial == 1 && periodo == 3) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
      }

      // sub manha
      if (serial == 2 && periodo == 1) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        //document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
        // document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));

      }

      //sub tarde
      if (periodo == 2 && serial == 2) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        //document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        // document.getElementById('curso').options.add(new Option("CELEM ALEMÃO", "12"));
        // document.getElementById('curso').options.add(new Option("CELEM ESPANHOL", "13"));
        // document.getElementById('curso').options.add(new Option("CELEM INGLÊS", "14"));
        // document.getElementById('curso').options.add(new Option("CELEM ITALIANO", "15"));
        // document.getElementById('curso').options.add(new Option("CELEM MANDARIN", "16"));
      }

      // sub noite
      if (periodo == 3 && serial == 2) {
        document.getElementById('curso').length = 0;
        document.getElementById('curso').options.length = 0;
        /*     document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
         */
        document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso').options.add(new Option("Administração", "1"));
        document.getElementById('curso').options.add(new Option("Edificações", "9"));
        //document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
        document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
        document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
        // document.getElementById('curso').options.add(new Option("Especialização Técnica em Enfermagem do Trabalho", "10"));
        //document.getElementById('curso').options.add(new Option("Informática", "5"));
        //document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
        document.getElementById('curso').options.add(new Option("Segurança do Trabalho", "7"));
        //document.getElementById('curso').options.add(new Option("Móveis", "11"));
      }
    }

    function valida_curso2() {
      var periodo = document.form1.periodo2[document.form1.periodo2.selectedIndex].value;
      var serial = document.form1.serial[document.form1.serial.selectedIndex].value;
      //  cpf_cgm(serial);
      if ((periodo == 0) || (serial == 0)) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        document.getElementById('curso2').options.add(new Option("Selecione um Curso", "0"));
      }

      //integrado manhÄ‚Â£
      if (serial == 1 && periodo == 1) {
        document.getElementById('curso2').length = 0;
        //document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        /*document.getElementById('curso2').options.length = 0;
        document.getElementById('curso2').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso2').options.add(new Option("Administração  ", "1"));
        document.getElementById('curso2').options.add(new Option("Edificações  ", "9"));
        document.getElementById('curso2').options.add(new Option("Eletrônica  ", "2"));
        document.getElementById('curso2').options.add(new Option("Eletromecânica  ", "3"));
        document.getElementById('curso2').options.add(new Option("Informática  ", "5"));
        document.getElementById('curso2').options.add(new Option("Meio Ambiente  ", "6"));*/

        //document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
        //document.getElementById('curso').options.add(new Option("Guia de Turismo Regional", "8"));*/
      }

      //Integrado tarde
      if (serial == 1 && periodo == 2) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        document.getElementById('curso2').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso2').options.add(new Option("Administração  ", "1"));
        document.getElementById('curso2').options.add(new Option("Edificações  ", "9"));
        document.getElementById('curso2').options.add(new Option("Eletrônica  ", "2"));
        document.getElementById('curso2').options.add(new Option("Eletromecânica  ", "3"));
        document.getElementById('curso2').options.add(new Option("Desenvolvimento de Sistemas  ", "19"));
        document.getElementById('curso2').options.add(new Option("Meio Ambiente  ", "6"));
      }


      //Integrado noite
      if (serial == 1 && periodo == 3) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        document.getElementById('curso2').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
      }

      // sub manha
      if (serial == 2 && periodo == 1) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        //document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        //document.getElementById('curso2').options.add(new Option("Selecione um curso", "0"));
        //document.getElementById('curso2').options.add(new Option("Enfermagem", "4"));
        // document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));

      }

      //sub tarde
      if (periodo == 2 && serial == 2) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        document.getElementById('curso2').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
        //document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
        // document.getElementById('curso').options.add(new Option("CELEM ALEMÃO", "12"));
        // document.getElementById('curso').options.add(new Option("CELEM ESPANHOL", "13"));
        // document.getElementById('curso').options.add(new Option("CELEM INGLÊS", "14"));
        // document.getElementById('curso').options.add(new Option("CELEM ITALIANO", "15"));
        // document.getElementById('curso').options.add(new Option("CELEM MANDARIN", "16"));
      }

      // sub noite
      if (periodo == 3 && serial == 2) {
        document.getElementById('curso2').length = 0;
        document.getElementById('curso2').options.length = 0;
        /*     document.getElementById('curso').options.add(new Option("Nenhum curso para esta Modalidade e Período", "0"));
         */
        document.getElementById('curso2').options.add(new Option("Selecione um curso", "0"));
        document.getElementById('curso2').options.add(new Option("Administração", "1"));
        document.getElementById('curso2').options.add(new Option("Edificações", "9"));
        //document.getElementById('curso2').options.add(new Option("Eletrônica", "2"));
        document.getElementById('curso2').options.add(new Option("Eletromecânica", "3"));
        document.getElementById('curso2').options.add(new Option("Enfermagem", "4"));
        // document.getElementById('curso').options.add(new Option("Especialização Técnica em Enfermagem do Trabalho", "10"));
        //document.getElementById('curso2').options.add(new Option("Informática", "5"));
        //document.getElementById('curso2').options.add(new Option("Meio Ambiente", "6"));
        document.getElementById('curso2').options.add(new Option("Segurança do Trabalho", "7"));
        //document.getElementById('curso').options.add(new Option("Móveis", "11"));
      }
    }
  </script>

</head>

<body onload="inicializar();">
<!--        
      <div class="dialog-confirm" title="Atenção!">
        <h4 style="font-weight:lighter; text-align:justify;">A abertura de turmas e a efetivação da matrícula, estão
          vinculadas ao número mínimo de 35 (trinta e cinco) interessados ao final deste processo classificador (conforme
          Resolução n° 4527/2011 - GS/SEED).</h4>
        <h4 style="font-weight:lighter; text-align:justify;">Você está se candidatando no cadastro de reserva será chamado apenas caso exista desistência de inscritos no primero processo.</h4>
      </div>
  -->
  
  <div class="row justify-content-center mt-5">
    <div class="col-xl-8 col-12">
      <div class="card px-2">
        <div class="card-header">
          <h2 class="form-section text-center"><img class="img-fluid" src="../inscricao/images/pageheader.png" alt="Inscrições"></h2>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <form id="form" name="form1" method="post" action="?pagina=dadosBasicos" onsubmit="return validar()">
              <div class="form-body">

                <div class='step-container'>
                  <div class='step active' data-step='1'>
                    1
                  </div>
                  <div class='step-separator' data-step='1'></div>
                  <div class='step  ' data-step='2'>
                    2
                  </div>
                  <div class='step-separator' data-step='2'></div>
                  <div class='step' data-step='3'>
                    3
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <div class="col-md-12">
                      <div class="alert alert-danger"><strong>Atenção:</strong> Inscrições para cadastro de reserva. Esta inscrição não garante a vaga</div>
                  </div>
                </div> -->

                <div class="form-group row">
                  <div class="col-md-12">
                     <p> Alunos que estão cursando o 9º ano devem escolher integrado. 
                      Alunos que estão cursando a 3ª Serie do ensino médio ou concluíram o mesmo devem escolher subseqüente. </p>
                      </br>
                      <label> <p> Modalidade:</p></label>
                    <select name="serial" onChange="valida_curso();valida_curso2();" class="form-control" required>
                      <option value="0" selected="1">Selecione uma opção</option> 
                      <option value="1">Integrado</option>
                      <option value="2">Subsequente</option> 
                    </select>
                  </div>
                </div>

                <div class="callout callout-success">
                  <h5 id="caveat-with-anchors">Escolha a opção de curso</h5>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label>Período:</label>
                      <select id="periodo" name="periodo" onChange="valida_curso()" class="form-control" required>
                        <option value="0" selected="1">Selecione um Período</option>
                        <option value="1">Matutino</option> 
                        <option value="2">Vespertino</option>
                        <option value="3">Noturno</option> 
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label>Curso Técnico em:</label>
                      <select id="curso" name="curso" class="form-control" required>
                        <option value="0">Selecione o curso</option>
                      </select>
                    </div>
                  </div>
                </div>


                <!-- <div class="callout callout-info">
                  <h5 id="caveat-with-anchors">Escolha a segunda opção de curso</h5>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label>Período:</label>
                      <select id="periodo2" name="periodo2" onChange="valida_curso2()" class="form-control" required>
                        <option value="0" selected="1">Selecione um Período</option>
                        <option value="1">Matutino</option> 
                        <option value="2">Vespertino</option>
                         <option value="3">Noturno</option>                  
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label>Curso Técnico em:</label>
                      <select id="curso2" name="curso2" class="form-control" required>
                        <option value="0">Selecione o curso</option>
                      </select>
                    </div>
                  </div>
                </div> -->

                <div class="form-group row">
                  <div class="col-md-12">
                    <label>CPF:</label>
                    <input type='text' id='cpf' name='cpf' class="form-control" required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    </br>
                    <p> A abertura de turmas e a efetivação da matrícula, estão vinculadas ao número mínimo de 35 (trinta e cinco) 
                        interessados ao final deste processo classificador (conforme Resolução n° 4527/2011 - GS/SEED). </p>
                    </br>
                    <input type="submit" class="btn btn-success" value="Avançar" />
                    <!-- <input type="reset" class="btn btn-secondary" value="Apagar dados" /> -->
                    <!-- <a href="orientacao.pdf" class="float-right">Orientação Conjunta 10/2020</a> -->
                    <a href="Edital.pdf" class="float-right">Edital 01/2021</a>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <div id="msg_erro">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>