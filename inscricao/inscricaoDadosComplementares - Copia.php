<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include "alunoClass.php";

$a = Aluno::getInstance();

$pagina = "?pagina=dadosComplementares&";

$resposta = null;

$cpf = "";
if (isset($_GET['cpf'])) 
{
  $cpf = $_GET['cpf'];
  $a->__set('cpf', $cpf);
  $a->carregar();
}

$acao = "incluir";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  $a->__set('cpf', preg_replace("/[^0-9]/", "", $_POST['cpf']));
  $a->__set('ensinomedio', @$_POST['ensinomedio']);
  $a->__set('ensinofundamental', @$_POST['ensinofundamental']);
  $a->__set('abandono', $_POST['abandono']);
  $a->__set('media_portugues', $_POST['maiorport']);
  $a->__set('bolsa_familia', $_POST['bolsa_familia']);
  if ($_POST['bolsa_familia'] == 1) {
    $a->__set('nis', $_POST['nis']);
  }

}

if ($a->__get('serial') == 1) 
{ //Integrado
    $a->__set('matematica_n1', $_POST['mat6']);
    $a->__set('matematica_n2', $_POST['mat7']);
    $a->__set('matematica_n3', $_POST['mat8']);
    $a->__set('matematica_n4', $_POST['mat9']);

    $a->__set('portugues_n1', $_POST['port6']);
    $a->__set('portugues_n2', $_POST['port7']);
    $a->__set('portugues_n3', $_POST['port8']);
    $a->__set('portugues_n4', $_POST['port9']);
}

  $a->__set('tipo_necessidade', $_POST['tipo_necessidade']);

  if ($_GET['acao'] == 'incluir') {
    $resposta = $a->salvarDadosComplementares();
    if ($resposta) {
      //echo "erro so que nao";
      header("Location:?pagina=inscricaoImprime.php&cpf=" . $_POST['cpf']);
    } else {
      echo "Erro ao salvar dados complementares";
    }
?>

<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <title>Cadastro de dados complementares</title>
  <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

  <style>
    h2 {
      font-size: 1.0em;
      font-weight: bold;
    }
  </style>
  <script>
    // $(function() {
    //   $(".dialog-confirm").dialog({
    //     resizable: false,
    //     height:300,
    //     width:600,
    //     modal: true,
    //     buttons: {
    //       "Continuar": function() {
    //         $( this ).dialog( "close" );
    //       },
    //       Voltar: function() {
    //         history.back();
    //       }
    //     }
    //   });
    // });

  </script>
  <style>
    /*label{width: 150px; display: inline-block;}*/
    /*label.clear{width: auto;}*/
    .aviso {
      background-color: yellow;
    }

    label.umquarto {
      width: 184px;
    }

    #numero_nis {
      display: none;
    }

    /*input[type="text"]{width: 500px;}*/
    /*select{width: 503px;}*/

    /*input[type="text"].meio  {width: 245px;}*/
    input[type="text"].umquarto {
      width: 180px;
      margin-right: 5px;
    }

    /*input[type="text"].tresquarto{width: 370px;}*/
  </style>


  <script type="text/javascript">

    function inicializar() {
      document.getElementById('tipo_necessidade').style.display = 'none';
    }


    function validar_necessidade_especial() {
      //verificando se possui necessidade especial
      var necessidade_especial = document.form1.necessidade[document.form1.necessidade.selectedIndex].value;

      if (necessidade_especial == 2) {
        document.getElementById('tipo_necessidade').style.display = 'block';
      } else {
        document.getElementById('tipo_necessidade').style.display = 'none';
        document.getElementById('necessidade_especial').selectedIndex = "0";
      }
    }

    function validar_beneficio() {
      //verificando se possui necessidade especial
      var bolsa_familia = document.form1.bolsa_familia[document.form1.bolsa_familia.selectedIndex].value;

      if (bolsa_familia == 1) { //sim
        document.getElementById('numero_nis').style.display = 'block';
      } else {
        document.getElementById('numero_nis').style.display = 'none';
        document.getElementById('nis').value = "";
      }
    }

    function validar() {

      //verificando o curso periodo e modalidade
      var tipo_ensino_medio = -1;
      if (document.getElementsByName('ensinomedio').length > 0) {
        tipo_ensino_medio = document.form1.ensinomedio[document.form1.ensinomedio.selectedIndex].value;
      }

      var tipo_ensino_fundamental = -1;
      if (document.getElementsByName('ensinofundamental').length > 0) {
        tipo_ensino_fundamental = document.form1.ensinofundamental[document.form1.ensinofundamental.selectedIndex].value;
      }

      var renda_familiar = document.form1.renda[document.form1.renda.selectedIndex].value;

      var abandono_curso = document.form1.abandono[document.form1.abandono.selectedIndex].value;

      var bolsa_familia = document.form1.bolsa_familia[document.form1.bolsa_familia.selectedIndex].value;
      var nis = document.form1.nis.value;

      if (bolsa_familia == 1 && nis == '') {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Informe o n??mero do benef??cio NIS</div>";
        // document.form1.ensinomedio.focus;
        return false;
      }

      if (tipo_ensino_medio == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione como realizou o Ensino M??dio</div>";
        // document.form1.ensinomedio.focus;
        return false;
      }

      if (tipo_ensino_fundamental == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione como realizou o Ensino Fundamental</div>";
        // document.form1.ensinofundamental.focus;
        return false;
      }

      if (isNaN(parseFloat(document.getElementById('maiormat').value)) ||
        (parseFloat(document.getElementById('maiormat').value) < 50)) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Informe todas as notas de matem??tica com valor maior que 50</div>";

        // document.form1.mat6.focus;
        return false;
      }
      if (isNaN(parseFloat(document.getElementById('maiorport').value)) ||
        (parseFloat(document.getElementById('maiorport').value) < 50)) {

        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Informe todas as notas de portugu??s com valor maior que 50</div>";

        // document.form1.port6.focus;
        return false;
      }
      if (!document.form1.concordo.checked) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Voc?? precisa marcar o campo concordo com os termos</div>";

        document.form1.concordo.focus;
        return false;
      }
      return true;
    }

    function Calc_Med_Mt() {
      //document.getElementById('$portugues').value=document.getElementById('$portugues').value + 1;

      var media = 0.00;
      var serial = document.form1.serial.value;
      var curso = document.form1.curso.value;

      if (serial == 1) { //integrado
        /*  media = (
           parseFloat(document.form1.mat6.value) +
           parseFloat(document.form1.mat7.value) +
           parseFloat(document.form1.mat8.value) +
           parseFloat(document.form1.mat9.value)) / 4;//agora so soma */
        media = (parseFloat(document.form1.mat9.value)); //agora so soma
      }
      if (media > 0) {
        document.getElementById('maiormat').value = media.toFixed(2);
      }
    }


    function Calc_Med_Bio() {
      var media = 0.00;
      var serial = document.form1.serial.value;
      var curso = document.form1.curso.value;
      var curso2 = document.form1.curso2.value;

      if (serial == 1) { //integrado
      }

      if (serial == 2) { //Subsequente
        if (curso == 4 || curso2 == 4) { //Enfermagem
          /*  media = (
             parseFloat(document.form1.bio1.value) +
             parseFloat(document.form1.bio2.value) +
             parseFloat(document.form1.bio3.value)) / 3; */
          media = (parseFloat(document.form1.bio3.value));
        }
      }


      if (media > 0) {
        document.getElementById('maiorbio').value = media.toFixed(2);
      }
    }

    function Calc_Med_Qui() {
      var media = 0.00;
      var serial = document.form1.serial.value;
      var curso = document.form1.curso.value;
      var curso2 = document.form1.curso2.value;

      if (serial == 1) { //integrado
      }

      if (serial == 2) { //Subsequente
        if (curso == 4 || curso2 == 4) { //Enfermagem
          /* media = (
            parseFloat(document.form1.qui1.value) +
            parseFloat(document.form1.qui2.value) +
            parseFloat(document.form1.qui3.value)) / 3; */
          media = (parseFloat(document.form1.qui3.value));
        }
      }


      if (media > 0) {
        document.getElementById('maiorqui').value = media.toFixed(2);
      }
    }



    function Calc_Med_Ciencias() {
      //document.getElementById('$portugues').value=document.getElementById('$portugues').value + 1;

      var media = 0.00;
      var serial = document.form1.serial.value;
      var curso = document.form1.curso.value;

      if (serial == 1) { //integrado
        media = (
          parseFloat(document.form1.ciencias6.value) +
          parseFloat(document.form1.ciencias7.value) +
          parseFloat(document.form1.ciencias8.value) +
          parseFloat(document.form1.ciencias9.value)) / 4;
        //media = (parseFloat(document.form1.port9.value));
      }




    function Calc_Med_Pt() {
      //document.getElementById('$portugues').value=document.getElementById('$portugues').value + 1;

      var media = 0.00;
      var serial = document.form1.serial.value;
      var curso = document.form1.curso.value;

      if (serial == 1) { //integrado
        media = (
          parseFloat(document.form1.port6.value) +
          parseFloat(document.form1.port7.value) +
          parseFloat(document.form1.port8.value) +
          parseFloat(document.form1.port9.value)) / 4;
        //media = (parseFloat(document.form1.port9.value));
      }

      if (serial == 2) { //Subsequente
        // media = (
        // parseFloat(document.form1.port6.value)+
        // parseFloat(document.form1.port7.value)+
        // parseFloat(document.form1.port8.value)+
        // parseFloat(document.form1.port9.value)+

        //Se for do especializa????o pega media simples das materias do curso t??cnico
        if (curso == 10) {
          media = parseFloat(document.form1.port1.value);
        } else {
          /*  media = (
             parseFloat(document.form1.port1.value) +
             parseFloat(document.form1.port2.value) +
             parseFloat(document.form1.port3.value)) / 3; */
          media = (parseFloat(document.form1.port3.value));
        }
      }

      if (media > 0) {
        document.getElementById('maiorport').value = media.toFixed(2);
      }
    }
  </script>
</head>

<body onload="inicializar()">

  <div class="row justify-content-center mt-5">
    <div class="col-xl-8 col-12">
      <div class="card px-2">
        <div class="card-header">
          <h2 class="form-section text-center"><img class="img-fluid" src="../inscricao/images/pageheader.png" alt="Inscri????es"></h2>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <form id="form" name="form1" method="post" action="<?php $SELF_PHP;
                                                                echo $pagina;
                                                                echo "acao=" . $acao; ?>" onsubmit="return validar()">
              <div class="form-body">

                <div class='step-container'>
                  <div class='step active' data-step='1'>
                    1
                  </div>
                  <div class='step-separator  active' data-step='1'></div>
                  <div class='step  active' data-step='2'>
                    2
                  </div>
                  <div class='step-separator  active' data-step='2'></div>
                  <div class='step active' data-step='3'>
                    3
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <?php
                    $curso = $a->__get('curso');
                    $curso2 = $a->__get('curso2');
                    if ($curso == 10) {
                    ?>
                      <div class="form-group row">
                        <div class="col-md-12">
                          <h2>Selecione qual sua institui????o de forma????o.</h2>
                          <label class="col-sm-2">Institui????o de forma????o</label>
                          <div class="col-sm-10">
                            <select class="form-control" class="form-control" name="instituicao_formacao" required onChange="">
                              <option value="0" selected="1">Selecione</option>
                              <option value="1">CEEP - Centro Estadual de Educa????o Profissional</option>
                              <!-- <option value="2">Universidade / Faculdade</option> -->
                              <option value="3">Outras institui????es de ensino</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>

                    <!-- Fim adi????o 07/07/2015 -->

                    <h2>Benefici??rio de programas federais de trasfer??ncia de renda:</h2>
                    <label>Benefici??rio:</label>
                    <select class="tfield form-control form-control" name="bolsa_familia" required onChange="validar_beneficio()">">
                      <option value="0" selected="1">Selecione</option>
                      <option value="1">Sim - Obrigat??rio informar n??mero do NIS</option>
                      <option value="2">N??o</option>
                    </select><br />
                    <div id="numero_nis">
                      <label>Informe o n??mero do benef??cio NIS:</label>
                      <input class="tfield form-control" maxlength="13" id="nis" name="nis" value="" type="text">
                    </div>
                    <br />
                    <h2>Em qual rede de ensino cursou:</h2>

                        <?php
                    if ($a->__get('serial') == 1) {
                      echo '
    <label>Ensino Fundamental:</label>
    <select class="tfield form-control" name="ensinofundamental" required onChange="">
      <option value="0" selected="1">Selecione</option>
      <option value="1">Integralmente em rede p??blica ou bolsista integral da rede particular</option>
      <option value="2">Parcial na Rede P??blica (M??ximo 1 ano Rede Particular)</option>
      <option value="3">Parcial na Rede P??blica (M??ximo 2 anos Rede Particular)</option>
      <option value="4">Parcial na Rede P??blica (M??ximo 3 anos Rede Particular)</option>
    </select><br />';
                    } ?>

                    <!-- Adicionado o campo hidden para esconder os elementos 05/11/2021 -->
                    <h2 hidden>Some a renda total da casa e divida pelo n??mero de pessoas</h2>
                    <label hidden>Renda M??dia Familiar:</label>
                    <select hidden class="tfield form-control" name="renda" required onChange="">
                      <option value="0">Selecione uma op????o</option>
                      <option value="1">R$ 0,00 at?? meio Sal??rio M??nimo</option>
                      <option value="2">De meio a 1 (um) Sal??rio M??nimos</option>
                      <option value="3">Acima de 1 (um) at?? 2 (dois) Sal??rios M??nimos</option>
                      <option value="4">Acima de 2 (dois) Sal??rios M??nimos</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->
                    <h2 hidden>Informe o documento comprobat??rio de renda</h2>
                    <label hidden>Comprovante de renda:</label>
                    <select hidden class="tfield form-control" name="comprovante_renda" onChange="">
                      <option value="0">Selecione uma op????o</option>
                      <option value="1">Holerite</option>
                      <option value="2">Carteira de trabalho</option>
                      <option value="3">Declara????o de Imposto de Renda</option>
                      <option value="4">Declara????o de auton??mo</option>
                      <option value="5">Autodeclara????o</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->
                    <h2 hidden>J?? desistiu de algum curso nesta Institui????o?</h2>
                    <label hidden>Abandono de Curso:</label>
                    <select hidden class="tfield form-control" name="abandono" onChange="">
                      <option value="0" selected="1">Responda</option>
                      <option value="1">N??o</option>
                      <option value="2">Sim</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->

                    <h2>Possui alguma Necessidade Educacional Especial?</h2>
                    <label>Necessidade Especial:</label>
                    <select class="tfield form-control" name="necessidade" onChange="validar_necessidade_especial()">
                      <option value="0" selected="1">Responda</option>
                      <option value="1">N??o</option>
                      <option value="2">Sim</option>
                    </select><br />
                    <div id="tipo_necessidade">
                      <h2>Qual ?? a sua necessidade especial?</h2>
                      <label>Tipo de necessidade:</label>
                      <select class="tfield form-control" name="tipo_necessidade" id="necessidade_especial">
                        <option value="0" selected="1">Responda</option>
                        <option value="1">Autismo cl??ssico</option>
                        <option value="2">S??ndrome de Rett</option>
                        <option value="3">S??ndrome de Down</option>
                        <option value="4">Cegueira</option>
                        <option value="5">Surdez</option>
                        <option value="6">Defici??ncia F??sica</option>
                        <option value="7">Altas habilidades/Superdota????o</option>
                        <option value="8">S??ndrome de Asperger</option>
                        <option value="9">Transtorno Deficit de Aten????o e hiperatividade</option>
                        <option value="10">Baixa vis??o</option>
                        <option value="11">Defici??ncia auditiva</option>
                        <option value="12">Defici??ncia m??tipla</option>
                        <option value="13">Dist??rbios de aprendizagem</option>
                        <option value="14">Condutas t??picas</option>
                        <option value="15">Transtornos Mentais e de Comportamento</option>
                        <option value="16">Defici??ncia intelectual</option>
                        <option value="17">Surdoceguira</option>
                        <option value="18">Condutas t??picas</option>
                        <option value="19">Transtorno desintegrativo da inf??ncia(Psicose/Esquizofrenia)</option>
                      </select><br />
                    </div>
                    <div id='aviso' class="alert alert-warning">
                      <!--                       SUBSEQUENTE = Se voc?? est?? cursando ou terminou o Ensino M??dio (antigo 2?? Grau) digite as notas de
                      L??ngua Portuguesa e Matem??tica do Hist??rico Escolar a partir da 5a s??rie at?? a 3a s??rie do Ensino
                      M??dio, caso n??o concluiu ainda a 3a s??rie
                      do Ensino M??dio, solicite suas notas no Col??gio em que est?? cursando.
                      Caso voc?? concluiu o Ensino Fundamental e/ou M??dio na modalidade EJA/SUPLETIVO
                      e no seu hist??rico escolar n??o constar a quantidade de notas solicitadas para os campos no ato da
                      inscri????o, favor
                      repetir a nota em todos os campos. -->

                      <!-- S U B S E Q U E N T E -->
                      <strong>Ensino fundamental:</strong> Se voc?? est?? cursando ou terminou o Ensino fundamental digite a m??dia das notas de
                      L??ngua Portuguesa e Matem??tica do Hist??rico Escolar do 9?? ano, caso n??o concluiu ainda o 9?? ano, solicite suas notas no Col??gio em que est?? cursando.<br />
                      <strong>Ensino m??dio:</strong> Se voc?? est?? cursando ou terminou o Ensino M??dio (antigo 2?? Grau) digite a m??dia das notas de
                      L??ngua Portuguesa e Matem??tica do Hist??rico Escolar da 3a s??rie se ensino regular ou da 4a s??rie se ensino t??cnico de 4 anos
                      , caso n??o concluiu ainda a 3a s??rie do Ensino M??dio, solicite suas notas no Col??gio em que est?? cursando.<br />
                      <strong>ENEM:</strong> Caso voc?? deseje utilizar a nota do ENEM ?? necess??rio comparecer na secretaria para fazer a inscri????o<br />
                      <strong>EJA/ENCCEJA:</strong> Caso voc?? concluiu o Ensino M??dio na modalidade EJA/ENCCEJA/SUPLETIVO ?? necess??rio comparecer na secretaria e fazer a inscri????o
                      presencialmente.<br />
                      <strong>CEEBJA: </strong>Caso tenha conclu??do o Ensino M??dio na modalidade CEEBJA, repetir as notas de cada disciplina nos tr??s campos.<br />
                      <strong>Ensino m??dio de 4 anos: </strong>Calcule a m??dia das 4 notas e repita nos 3 campos.<br />
                      <!-- I N T E G R A D O -->

                      <!-- INTEGRADO = Se voc?? est?? cursando ou terminou o Ensino M??dio (antigo 2?? Grau) digite as notas de
                      L??ngua Portuguesa e Matem??tica do Hist??rico Escolar a partir da 5a s??rie at?? a 3a s??rie do Ensino
                      M??dio, caso n??o concluiu ainda a 3a s??rie
                      do Ensino M??dio, solicite suas notas no Col??gio em que est?? cursando.
                      Caso voc?? concluiu o Ensino Fundamental e/ou M??dio na modalidade EJA/SUPLETIVO
                      e no seu hist??rico escolar n??o constar a quantidade de notas solicitadas para os campos no ato da
                      inscri????o, favor
                      repetir a nota em todos os campos. -->
                    </div>

                    <br />
                    <?php
                      
                    echo "<h2>Informe a m??dia de suas notas de Portugu??s</h2>";
                    echo "<h4>Informe as notas em uma escala de 0 a 100.</h4>";
                    
                    echo "<input type='hidden' name='cpf' value='" . $a->__get('cpf') . "' readonly/>";
                    echo "<input type='hidden' name='serial' value='" . $a->__get('serial') . "' readonly/>";
                    echo "<input type='hidden' name='curso' value='" . $a->__get('curso') . "' readonly/>";
                    ?>
                    <?php
                    if ($a->__get('serial') == 1) {
                      campos_portugues_integrado();
                    }

                    ?>
                      <br>

                      <div class="row">
                        <div class="col-md-4">
                          <label>M??dia em L??ngua Portuguesa:</label>
                          <input class="tfield form-control_disabled form-control" maxlength="4" id="maiorport" name="maiorport" value="" type="text" required readonly="1">
                        </div>
                      </div>
                      <br>
                      <br>
                      <hr />
                      <?php
                      if ($a->__get('serial') == 1) {
                        echo "<h2>Informe a m??dia de suas notas de Matem??tica</h2>";
                      } else {
                        echo "<h2>Informe a m??dia de suas notas de Matem??tica da 3?? s??rie do Ensino M??dio Regular ou a m??dia de suas notas da 4?? s??rie do Ensino T??cnico</h2>";
                      }
                      ?>
                      <h4>Informe as notas em uma escala de 0 a 100.</h4>
                    <?php
                    

                    // echo "O serial ??: ".$a->__get('serial');
                    if ($a->__get('serial') == 1) { //integrado
                      campos_matematica_integrado();
                      // echo "campos_matematica_integrado";
                    }

                    ?> <div class="row">
                      <div class="col-md-4">
                        <label>M??dia em Matem??tica:</label>
                        <input class="tfield form-control_disabled form-control" maxlength="4" id="maiormat" name="maiormat" value="" type="text" required readonly="1">
                      </div>
                    </div>
                    <br>
                    <?php

                    if ($curso == 18) {
                    ?>
                      <hr />

                      <h2>Informe a m??dia de suas notas de Ci??ncias</h2>
                      <h3>Informe as notas em uma escala de 0 a 100.</h3>
                      <?php
                      campos_ciencias_integrado()
                      ?>
                      <div class="row">
                        <div class="col-md-4">
                          <label>Soma de Ci??ncias:</label>
                          <input class="tfield form-control_disabled form-control" maxlength="4" id="maiorciencias" name="maiorciencias" value="" type="text" required readonly="1">
                        </div>
                      </div>
                      <br>
                      <hr />
                    <?php

                    }

                    ?>

                    <div class="form-check form-check-inline">
                      <input value="1" class="form-check-input" id="concordo" required name="concordo" type="checkbox" onchange="mensagem()">
                      <label class="form-check-label" for="inlineCheckbox1">Li e concordo com o edital de abertura das inscri????es</label>
                    </div>
                    <!--  <input class="tfield form-control" id="concordo" required name="concordo" type="checkbox" onchange="mensagem()">
                    Li e concordo com o edital de abertura das inscri????es<br /> -->
                    <br>
                    <h5>Todos os campos deste formul??rio s??o obrigat??rios</h5>
                    <input type="submit" value="Avan??ar" />
                    <!-- <input type="reset" value="Apagar dados"/> -->

                    <div id="msg_erro">
                      <!--Aqui aparece a mensagem de erro-->

                    </div>
                    <?php
                    echo $resposta;
                    ?>

            </form>
          </div>
        </div>
      </div>
    </div>
</body>

</html>

<?php

function campos_matematica_integrado()
{
  echo '<div class="row">
            <div class="col-md-3">
              <label>6?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat6" name="mat6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>7?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat7" name="mat7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>8?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat8" name="mat8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>9?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat0" name="mat9" value="" type="text" OnKeyPress="">
            </div>
          </div>';
}

function campos_portugues_integrado()
{
  echo '<div class="row">
            <div class="col-md-3">
              <label> 6?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport6" name="port6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 7?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport7" name="port7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 8?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport8" name="port8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 9?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport0" name="port9" value="" type="text" OnKeyPress="">
            </div>
          </div>';
}

function campos_ciencias_integrado()
{
  echo '<div class="row">
            <div class="col-md-3">
              <label> 6?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias6" name="ciencias6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 7?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias7" name="ciencias7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 8?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias8" name="ciencias8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 9?? Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 d??gitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias9" name="ciencias9" value="" type="text" OnKeyPress="">
            </div>
          </div>';
}
?>