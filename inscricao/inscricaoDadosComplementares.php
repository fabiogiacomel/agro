<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include "alunoClass.php";

$a = Aluno::getInstance();

$pagina = "?pagina=dadosComplementares&";

$resposta = null;

$cpf = "";
if (isset($_GET['cpf'])) {
  $cpf = $_GET['cpf'];
  $a->__set('cpf', $cpf);
  $a->carregar();
}

// $serial = "";
// if(isset($_POST['serial'])){
//   $serial = $_POST['serial'];
// }

$acao = "incluir";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $a->__set('cpf', preg_replace("/[^0-9]/", "", $_POST['cpf']));
  $a->__set('ensinomedio', @$_POST['ensinomedio']);
  $a->__set('ensinofundamental', @$_POST['ensinofundamental']);
  // $a->__set('renda', $_POST['renda']); 05/11/2021
  // $a->__set('comprovante_renda', $_POST['comprovante_renda']); //25/05/18 desativado 05/11/2021
  $a->__set('abandono', $_POST['abandono']);

  $a->__set('media_portugues', $_POST['maiorport']);
  $a->__set('media_ciencias', $_POST['maiorciencias']);
  //echo "O curso é ". $_POST['curso'];
  if ($_POST['curso'] == 10) { //se curso especialização seta 0 (maiorport)
    $a->__set('media_matematica', 0);
  } else {
    $a->__set('media_matematica', $_POST['maiormat']);
  }
  $a->__set('bolsa_familia', $_POST['bolsa_familia']);
  if ($_POST['bolsa_familia'] == 1) {
    $a->__set('nis', $_POST['nis']);
  }

  //if ($_POST['curso']==4){//se curso enfermagem
  //$a->__set('media_biologia', @$_POST['maiorbio']);
  //$a->__set('media_quimica', @$_POST['maiorqui']);
  //$a->__set('media_ciencias', @$_POST['maiorciencias']);

  if ($a->__get('serial') == 1) { //Integrado
    $a->__set('matematica_n1', $_POST['mat6']);
    $a->__set('matematica_n2', $_POST['mat7']);
    $a->__set('matematica_n3', $_POST['mat8']);
    $a->__set('matematica_n4', $_POST['mat9']);

    $a->__set('portugues_n1', $_POST['port6']);
    $a->__set('portugues_n2', $_POST['port7']);
    $a->__set('portugues_n3', $_POST['port8']);
    $a->__set('portugues_n4', $_POST['port9']);
  }

  if ($a->__get('serial') == 2) { //Apenas para o subsequente)
    $a->__set('matematica_n1', $_POST['mat1']);
    $a->__set('matematica_n2', $_POST['mat2']);
    $a->__set('matematica_n3', $_POST['mat3']);

    $a->__set('portugues_n1', $_POST['pot1']);
    $a->__set('portugues_n2', $_POST['pot2']);
    $a->__set('portugues_n3', $_POST['pot3']);

    if ($curso == 4 || $curso2 == 4) { //Enfermagem
      $a->__set('quimica_n1', $_POST['qui1']);
      $a->__set('quimica_n2', $_POST['qui2']);
      $a->__set('quimica_n3', $_POST['qui3']);

      $a->__set('biologia_n1', $_POST['bio1']);
      $a->__set('biologia_n2', $_POST['bio2']);
      $a->__set('biologia_n3', $_POST['bio3']);
    }
  }

  //}
  echo "Notas qui" . @$_POST['maiorqui'];
  echo "NOtas bio" . @$_POST['maiorbio'];

  if (isset($_POST['instituicao_formacao'])) {
    $a->__set('instituicao_formacao', $_POST['instituicao_formacao']);
  } else {
    $a->__set('instituicao_formacao', 0);
  }

  //if($a->__get('serial')==2){ //Apenas para o subsequente
  // Desativado em 05/11/2021 $a->__set('trabalha_area', @$_POST['trabalha_area']);
  //}else{
  //  $a->__set('trabalha_area','1');
  //}
  $a->__set('tipo_necessidade', $_POST['tipo_necessidade']);

  if ($_GET['acao'] == 'incluir') {
    $resposta = $a->salvarDadosComplementares();
    if ($resposta) {
      //echo "erro so que nao";
      header("Location:?pagina=inscricaoImprime.php&cpf=" . $_POST['cpf']);
    } else {
      echo "Erro ao salvar dados complementares";
    }
  }
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

    function mensagem() {

      // var curso  = document.form1.curso.value;

      // if (curso==1 || curso==5){
      //     alert('Palestra esclarecedora sobre currículo e perfil profissional no dia 09/11/2017. Para os cursos de Administração e Informática');
      // }
      // if (curso==2 || curso==3){
      //   alert('Palestra esclarecedora sobre currículo e perfil profissional no dia 10/11/2017. Para os cursos de Eletromecânica e Eletrônica');
      // }

      // if (curso==6 || curso==9){
      //     alert('Palestra esclarecedora sobre currículo e perfil profissional no dia 11/11/2017. Para os cursos de Edificações e Meio Ambiente');
      // }

      // if (curso==4 || curso==7){
      //     alert('Palestra esclarecedora sobre currículo e perfil profissional no dia 12/11/2017. Para os cursos de Enfermagem e Segurança do Trabalho');
      // }

      //alert('A abertura de turmas e a efetivação da matrícula, estão vinculadas ao número de 35 (trinta e cinco) interessados ao final deste processo classificador (conforme Resolução n° 4527/2011 - GS/SEED).');
    }
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
    function validar2() {
      alert('1');
      return false;

    }

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
          "<div id='erro' class='alert alert-danger'>Erro: Informe o número do benefício NIS</div>";
        // document.form1.ensinomedio.focus;
        return false;
      }

      if (tipo_ensino_medio == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione como realizou o Ensino Médio</div>";
        // document.form1.ensinomedio.focus;
        return false;
      }

      if (tipo_ensino_fundamental == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione como realizou o Ensino Fundamental</div>";
        // document.form1.ensinofundamental.focus;
        return false;
      }
      /* Retirando a Renda Familiar 05/11/2021
            if (renda_familiar == 0) {
              document.getElementById('msg_erro').innerHTML =
                "<div id='erro' class='alert alert-danger'>Erro: Selecione sua Renda Familiar</div>";
              document.form1.renda.focus;
              return false;
            }
      
      if (abandono_curso == 0) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Selecione a informação sobre abandono de curso</div>";
        document.form1.abandono.focus;
        return false;
      }

*/
      if (isNaN(parseFloat(document.getElementById('maiormat').value)) ||
        (parseFloat(document.getElementById('maiormat').value) < 50)) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Informe todas as notas de matemática com valor maior que 50</div>";

        // document.form1.mat6.focus;
        return false;
      }
      if (isNaN(parseFloat(document.getElementById('maiorport').value)) ||
        (parseFloat(document.getElementById('maiorport').value) < 50)) {

        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Informe todas as notas de português com valor maior que 50</div>";

        // document.form1.port6.focus;
        return false;
      }
      if (!document.form1.concordo.checked) {
        document.getElementById('msg_erro').innerHTML =
          "<div id='erro' class='alert alert-danger'>Erro: Você precisa marcar o campo concordo com os termos</div>";

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
        media = (
           parseFloat(document.form1.mat6.value) +
           parseFloat(document.form1.mat7.value) +
           parseFloat(document.form1.mat8.value) +
           parseFloat(document.form1.mat9.value)) / 4;//agora so soma */
        //media = (parseFloat(document.form1.mat9.value)); //agora so soma
      }

      if (serial == 2) { //Subsequente
        // media = (
        // parseFloat(document.form1.mat6.value)+
        // parseFloat(document.form1.mat7.value)+
        // parseFloat(document.form1.mat8.value)+
        // parseFloat(document.form1.mat9.value)+

        //Se for do especialização pega media simples das materias do curso técnico
        if (curso == 10) {
          media = parseFloat(document.form1.mat1.value);
        } else {
          /*media = (
            parseFloat(document.form1.mat1.value) +
            parseFloat(document.form1.mat2.value) +
            parseFloat(document.form1.mat3.value)) / 3;//Somente soma*/
          media = (parseFloat(document.form1.mat3.value)); //Somente soma
        }
      }


      if (media > 0) {
        document.getElementById('maiormat').value = media.toFixed(2);
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
           parseFloat(document.form1.ciencias9.value)) / 4;//agora so soma */
        
      }

     if (media > 0) {
        document.getElementById('maiorciencias').value = media.toFixed(2);
      }
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

        //Se for do especialização pega media simples das materias do curso técnico
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

</head>

<body onload="inicializar()">

  <div class="row justify-content-center mt-5">
    <div class="col-xl-8 col-12">
      <div class="card px-2">
        <div class="card-header">
          <h2 class="form-section text-center"><img class="img-fluid" src="../inscricao/images/pageheader.png" alt="Inscrições"></h2>
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
                          <h2>Selecione qual sua instituição de formação.</h2>
                          <label class="col-sm-2">Instituição de formação</label>
                          <div class="col-sm-10">
                            <select class="form-control" class="form-control" name="instituicao_formacao" required onChange="">
                              <option value="0" selected="1">Selecione</option>
                              <option value="1">CEEP - Centro Estadual de Educação Profissional</option>
                              <!-- <option value="2">Universidade / Faculdade</option> -->
                              <option value="3">Outras instituições de ensino</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>

                    <!-- Fim adição 07/07/2015 -->

                    <h2>Beneficiário de programas federais de trasferência de renda:</h2>
                    <label>Beneficiário:</label>
                    <select class="tfield form-control form-control" name="bolsa_familia" required onChange="validar_beneficio()">">
                      <option value="0" selected="1">Selecione</option>
                      <option value="1">Sim - Obrigatório informar número do NIS</option>
                      <option value="2">Não</option>
                    </select><br />
                    <div id="numero_nis">
                      <label>Informe o número do benefício NIS:</label>
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
      <option value="1">Integralmente em rede pública ou bolsista integral da rede particular</option>
      <option value="2">Parcial na Rede Pública (Máximo 1 ano Rede Particular)</option>
      <option value="3">Parcial na Rede Pública (Máximo 2 anos Rede Particular)</option>
      <option value="4">Parcial na Rede Pública (Máximo 3 anos Rede Particular)</option>
    </select><br />';
                    } ?>

                    <!-- Adicionado o campo hidden para esconder os elementos 05/11/2021 -->
                    <h2 hidden>Some a renda total da casa e divida pelo número de pessoas</h2>
                    <label hidden>Renda Média Familiar:</label>
                    <select hidden class="tfield form-control" name="renda" required onChange="">
                      <option value="0">Selecione uma opção</option>
                      <option value="1">R$ 0,00 até meio Salário Mínimo</option>
                      <option value="2">De meio a 1 (um) Salário Mínimos</option>
                      <option value="3">Acima de 1 (um) até 2 (dois) Salários Mínimos</option>
                      <option value="4">Acima de 2 (dois) Salários Mínimos</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->
                    <h2 hidden>Informe o documento comprobatório de renda</h2>
                    <label hidden>Comprovante de renda:</label>
                    <select hidden class="tfield form-control" name="comprovante_renda" onChange="">
                      <option value="0">Selecione uma opção</option>
                      <option value="1">Holerite</option>
                      <option value="2">Carteira de trabalho</option>
                      <option value="3">Declaração de Imposto de Renda</option>
                      <option value="4">Declaração de autonômo</option>
                      <option value="5">Autodeclaração</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->
                    <h2 hidden>Já desistiu de algum curso nesta Instituição?</h2>
                    <label hidden>Abandono de Curso:</label>
                    <select hidden class="tfield form-control" name="abandono" onChange="">
                      <option value="0" selected="1">Responda</option>
                      <option value="1">Não</option>
                      <option value="2">Sim</option>
                      <!-- </select><br /> -->
                    </select> <!-- sem br -->

                    <h2>Possui alguma Necessidade Educacional Especial?</h2>
                    <label>Necessidade Especial:</label>
                    <select class="tfield form-control" name="necessidade" onChange="validar_necessidade_especial()">
                      <option value="0" selected="1">Responda</option>
                      <option value="1">Não</option>
                      <option value="2">Sim</option>
                    </select><br />
                    <div id="tipo_necessidade">
                      <h2>Qual é a sua necessidade especial?</h2>
                      <label>Tipo de necessidade:</label>
                      <select class="tfield form-control" name="tipo_necessidade" id="necessidade_especial">
                        <option value="0" selected="1">Responda</option>
                        <option value="1">Autismo clássico</option>
                        <option value="2">Síndrome de Rett</option>
                        <option value="3">Síndrome de Down</option>
                        <option value="4">Cegueira</option>
                        <option value="5">Surdez</option>
                        <option value="6">Deficiência Física</option>
                        <option value="7">Altas habilidades/Superdotação</option>
                        <option value="8">Síndrome de Asperger</option>
                        <option value="9">Transtorno Deficit de Atenção e hiperatividade</option>
                        <option value="10">Baixa visão</option>
                        <option value="11">Deficiência auditiva</option>
                        <option value="12">Deficiência mútipla</option>
                        <option value="13">Distúrbios de aprendizagem</option>
                        <option value="14">Condutas típicas</option>
                        <option value="15">Transtornos Mentais e de Comportamento</option>
                        <option value="16">Deficiência intelectual</option>
                        <option value="17">Surdoceguira</option>
                        <option value="18">Condutas típicas</option>
                        <option value="19">Transtorno desintegrativo da infância(Psicose/Esquizofrenia)</option>
                      </select><br />
                    </div>
                    <div id='aviso' class="alert alert-warning">
                      <!--                       SUBSEQUENTE = Se você está cursando ou terminou o Ensino Médio (antigo 2º Grau) digite as notas de
                      Língua Portuguesa e Matemática do Histórico Escolar a partir da 5a série até a 3a série do Ensino
                      Médio, caso não concluiu ainda a 3a série
                      do Ensino Médio, solicite suas notas no Colégio em que está cursando.
                      Caso você concluiu o Ensino Fundamental e/ou Médio na modalidade EJA/SUPLETIVO
                      e no seu histórico escolar não constar a quantidade de notas solicitadas para os campos no ato da
                      inscrição, favor
                      repetir a nota em todos os campos. -->

                      <!-- S U B S E Q U E N T E -->
                      <strong>Ensino fundamental:</strong> Se você está cursando ou terminou o Ensino fundamental digite a média das notas de
                      Língua Portuguesa e Matemática do Histórico Escolar do 9° ano, caso não concluiu ainda o 9° ano, solicite suas notas no Colégio em que está cursando.<br />
                      <!-- I N T E G R A D O -->

                      <!-- INTEGRADO = Se você está cursando ou terminou o Ensino Médio (antigo 2º Grau) digite as notas de
                      Língua Portuguesa e Matemática do Histórico Escolar a partir da 5a série até a 3a série do Ensino
                      Médio, caso não concluiu ainda a 3a série
                      do Ensino Médio, solicite suas notas no Colégio em que está cursando.
                      Caso você concluiu o Ensino Fundamental e/ou Médio na modalidade EJA/SUPLETIVO
                      e no seu histórico escolar não constar a quantidade de notas solicitadas para os campos no ato da
                      inscrição, favor
                      repetir a nota em todos os campos. -->
                    </div>

                    <br />
                    <?php

                    echo "<h2>Informe a média de suas notas de Português</h2>";
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
                        <label>Média em Língua Portuguesa:</label>
                        <input class="tfield form-control_disabled form-control" maxlength="4" id="maiorport" name="maiorport" value="" type="text" required readonly="1">
                      </div>
                    </div>
                    <br>
                    <br>
                    <hr />
                    <?php
                    if ($a->__get('serial') == 1) {
                      echo "<h2>Informe a média de suas notas de Matemática</h2>";
                    } else {
                      echo "<h2>Informe a média de suas notas de Matemática da 3ª série do Ensino Médio Regular ou a média de suas notas da 4ª série do Ensino Técnico</h2>";
                    }
                    ?>
                    <h4>Informe as notas em uma escala de 0 a 100.</h4>
                <?php


                    // echo "O serial é: ".$a->__get('serial');
                    if ($a->__get('serial') == 1) { //integrado
                      campos_matematica_integrado();
                      // echo "campos_matematica_integrado";
                    }

                ?>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Média em Matemática:</label>
                        <input class="tfield form-control_disabled form-control" maxlength="4" id="maiormat" name="maiormat" value="" type="text" required readonly="1">
                      </div>
                    </div>
                    <br>
                <?php

                    if ($curso == 18) {
                ?>
                      <hr />

                      <h2>Informe a média de suas notas de Ciências</h2>
                      <h3>Informe as notas em uma escala de 0 a 100.</h3>
                  <?php
                      campos_ciencias_integrado()
                  ?>
                      <div class="row">
                        <div class="col-md-4">
                          <label>Média em Ciências:</label>
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
                      <label class="form-check-label" for="inlineCheckbox1">Li e concordo com o edital de abertura das inscrições</label>
                    </div>
                    <!--  <input class="tfield form-control" id="concordo" required name="concordo" type="checkbox" onchange="mensagem()">
                    Li e concordo com o edital de abertura das inscrições<br /> -->
                    <br>
                    <h5>Todos os campos deste formulário são obrigatórios</h5>
                    <input type="submit" value="Avançar" />
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
              <label>6° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat6" name="mat6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>7° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat7" name="mat7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>8° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat8" name="mat8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label>9° ano </label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100"  onChange="Calc_Med_Mt()" id="virtmat0" name="mat9" value="" type="text" OnKeyPress="">
              <p>Para os alunos que estão cursando o 9º ano: Considerar as notas do 1º e 2º Trimestre somadas e divididas por 2 
              (n1 + n2)/2</p>
              </div>
          </div>';
}

function campos_portugues_integrado()
{
  echo '<div class="row">
            <div class="col-md-3">
              <label> 6° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport6" name="port6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 7° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport7" name="port7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 8° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport8" name="port8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 9° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Pt()" id="virtport0" name="port9" value="" type="text" OnKeyPress="">
              <p>Para os alunos que estão cursando o 9º ano: Considerar as notas do 1º e 2º Trimestre somadas e divididas por 2 
              (n1 + n2)/2</p>

              </div>
          </div>';
}

function campos_ciencias_integrado()
{
  echo '<div class="row">
            <div class="col-md-3">
              <label> 6° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias6" name="ciencias6" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 7° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias7" name="ciencias7" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 8° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias8" name="ciencias8" value="" type="text" OnKeyPress="">
            </div>
            <div class="col-md-3">
              <label> 9° Ano</label>
              <input type="text" placeholder="Exemplo: 60" class="tfield form-control  nota" maxlength="3" pattern="[0-9]{2}|[1][0]{2}" title="Informe a nota com 2 dígitos de 00 a 100" onChange="Calc_Med_Ciencias()" id="virtciencias9" name="ciencias9" value="" type="text" OnKeyPress="">
              <p>Para os alunos que estão cursando o 9º ano: Considerar as notas do 1º e 2º Trimestre somadas e divididas por 2 
              (n1 + n2)/2</p>

              </div>
          </div>';
}
?>