<?php
// session_start();
include "alunoClass.php";
// include("inscricaoClass.php");

$a = Aluno::getInstance();

// $i = Inscricao::getInstance();
$pagina = "?pagina=dadosBasicos&";

$cpf = "";
$resposta = null;
$confirma_mudou_curso = false;

if (isset($_GET['mudou_curso'])) {
    $confirma_mudou_curso = $_GET['mudou_curso'];
}

if (isset($_POST['serial'])) {
    $serial = $_POST['serial'];
    $a->__set('serial', $serial);
} else {
    echo "Erro não veio com modalidade";
    GeraLog::getInstance()->log("Erro nao veio com modalidade");
    // GeraLog::getInstance()->inserirLog("Erro nao veio com modalidade - voltando ao inicio");
    header("Location:index.php");
}

if (isset($_POST['periodo'])) {
    $periodo = $_POST['periodo'];
   // $periodo2 = $_POST['periodo2'];
    $a->__set('periodo', $periodo);
   // $a->__set('periodo2', $periodo2);
} else {
    echo "Erro não veio com período";
    //GeraLog::getInstance()->log("Erro nao veio com período");
    //GeraLog::getInstance()->inserirLog("Erro nao veio com período");
}

if (isset($_POST['curso'])) {
    $curso = $_POST['curso'];
    //$curso2 = $_POST['curso2'];
    $a->__set('curso', $curso);
    //$a->__set('curso2', $curso2);
} else {
    echo "Erro não veio com curso";
    //GeraLog::getInstance()->log("Erro nao veio com curso");
    //GeraLog::getInstance()->inserirLog("Erro nao veio com curso");

}

//   setcookie("curso",$_POST['curso']);
//   setcookie("periodo",$_POST['periodo']);
//   setcookie("serial",$_POST['serial']);
// }

if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    //setcookie("cpf",$_POST['cpf']);
    $a->__set('cpf', preg_replace("/[^0-9]/", "", $cpf));
}

/*if(isset($_POST['cgm'])){
$cgm = $_POST['cgm'];
setcookie("cgm",$_POST['cgm']);
$a->__set('cgm',preg_replace("/[^0-9]/", "",$cgm));
} */

$a->carregar();

$acao = "incluir";
if ($a->__get('achou_tabela_nova')) {
    //$acao = "atualizar"; Desabilitado para somente incluir novos
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['nome'])) {
    $request = md5(implode($_POST));

    if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request) {
        GeraLog::getInstance()->log('refresh no DadosBasicos');
        $a->__set('cgm', $_POST['cgm']);
        $a->__set('nome', $_POST['nome']);
        $a->__set('rg', $_POST['rg']);
        $a->__set('rg_data_expedicao', $_POST['rg_data_expedicao']);
        $a->__set('nome_mae', $_POST['nome_mae']);
        $a->__set('escola_origem', $_POST['escola_origem']);
        $a->__set('escola_origem_cidade', $_POST['escola_origem_cidade']);
        $a->__set('escola_origem_estado', $_POST['escola_origem_estado']);
        $a->__set('cpf', preg_replace("/[^0-9]/", "", $_POST['cpf']));
        $a->__set('datanasc', $_POST['datanasc']);
        $a->__set('email', $_POST['email']);
        $a->__set('fone_casa', $_POST['fone_casa']);
        $a->__set('cidade', $_POST['cidade']);
        $a->__set('fone_celular', $_POST['fone_celular']);
        $a->__set('bairro', $_POST['bairro']);
        $a->__set('rua', $_POST['rua']);
        $a->__set('numero', $_POST['numero']);
        $a->__set('curso', $_POST['curso']);
        $a->__set('periodo', $_POST['periodo']);
        //$a->__set('curso2', $_POST['curso2']);
        //$a->__set('periodo2', $_POST['periodo2']);
        $a->__set('serial', $_POST['serial']);

        $resposta = $a->atualizar();
        if ($resposta) {
            header("Location:?pagina=inscricaoDadosComplementares.php&cpf=" . $_POST['cpf'] . "");
        } else {
            echo "ERRO no método atualizar";
        }
        //echo 'refresh';
    } else {
        $_SESSION['last_request'] = $request;
        //echo 'post';
        //GeraLog::getInstance()->log('salvarDadosBasicoaComplementares iniciando update');

        $a->__set('cgm', $_POST['cgm']);
        $a->__set('nome', $_POST['nome']);
        $a->__set('rg', $_POST['rg']);
        $a->__set('rg_data_expedicao', $_POST['rg_data_expedicao']);
        $a->__set('nome_mae', $_POST['nome_mae']);
        $a->__set('escola_origem', $_POST['escola_origem']);
        $a->__set('escola_origem_cidade', $_POST['escola_origem_cidade']);
        $a->__set('escola_origem_estado', $_POST['escola_origem_estado']);
        $a->__set('cpf', preg_replace("/[^0-9]/", "", $_POST['cpf']));
        $a->__set('datanasc', $_POST['datanasc']);
        $a->__set('email', $_POST['email']);
        $a->__set('fone_casa', $_POST['fone_casa']);
        $a->__set('cidade', $_POST['cidade']);
        $a->__set('fone_celular', $_POST['fone_celular']);
        $a->__set('bairro', $_POST['bairro']);
        $a->__set('rua', $_POST['rua']);
        $a->__set('numero', $_POST['numero']);
        $a->__set('curso', $_POST['curso']);
        $a->__set('periodo', $_POST['periodo']);
        //$a->__set('curso2', $_POST['curso2']);
        //$a->__set('periodo2', $_POST['periodo2']);

        $a->__set('serial', $_POST['serial']);

        if ($_GET['acao'] == 'incluir') {
            $resposta = $a->salvar();
            if ($resposta) {
                header("Location:?pagina=inscricaoDadosComplementares.php&cpf=" . $_POST['cpf'] . "");
            } else {
                echo "ERRO no método salvar";
            }
        }

        if ($_GET['acao'] == 'atualizar') {
            $resposta = $a->atualizar();
            if ($resposta) {
                header("Location:?pagina=inscricaoDadosComplementares.php&cpf=" . $_POST['cpf'] . "");
            } else {
                echo "ERRO no método atualizar";
            }
        }
    }
}
?>

<!doctype html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <title>Inscrição on-line</title>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <!--  <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script> -->
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script>
        $(function () {
            $(".dialog-confirm").dialog({
                resizable: false,
                height: 300,
                width: 600,
                modal: true,
                buttons: {
                    "Continuar": function () {
                        $(this).dialog("close");
                    },
                    Voltar: function () {
                        history.back();
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        jQuery(function ($) {
            $("#cpf").mask('000.000.000-00', {reverse: true});
            $("#fone_casa").mask('(00) Z0000-0000', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                }
            });
            $("#fone_celular").mask('(00) 00000-0000');
            $("#data_nasc").mask('00/00/0000');
        });

        function idade(nascimento, hoje) {
            var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
            if (new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) <
                new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()))
                diferencaAnos--;
            return diferencaAnos;
        }

        function validar() {
            //verificando o curso periodo e modalidade
            var cpf = document.form1.cpf.value;
            var cgm = document.form1.cgm.value;
            var nome = document.form1.nome.value;
            var rg = document.form1.rg.value;
            var rg_data_expedicao = document.form1.rg_data_expedicao.value;
            var datanasc = document.form1.datanasc.value;
            var email = document.form1.email.value;
            var curso = document.form1.curso.value;
            var curso2 = document.form1.curso2.value;
            var serial = document.form1.serial.value; //1-integrado 2sub
            var whatsapp = document.form1.fone_celular.value;
            var telefone = document.form1.fone_casa.value;


           // var idadealuno = idade(new Date(datanasc), new Date());
            // alert (idadealuno);

            //Aluno maior de 18 no integrado

            // if (idadealuno > 18  && serial==1){
            //  list = [1,2,3,5,6,8,9];

            //  alert('teste'+curso);
            // switch(curso) {
            //  case 1:
            //  case 2:
            //  case 3:
            //  case 5:
            //  case 6:
            //  case 8:
            //  case 9:
            //alert('Error');
            // window.location.href = "inscricao_next.php";
            // return false;
            // }

            if (whatsapp == '') {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: É necessário informar um número de celular/whatsapp</div>";
                return false;
            }

            if (telefone == '') {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: É necessário informar um número de telefone</div>";
                return false;
            }

            if ((curso == 7 || curso2 == 7) && idadealuno < 18) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Para realizar este curso você precisa ter mais de 18 anos</div>";
                return false;
            }

            if ((curso == 4 || curso2 == 4)  && idadealuno < 18) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Para realizar este curso você precisa ter mais de 18 anos</div>";
                return false;
            }

            if ((curso == 10 || curso2 == 10) && idadealuno < 18) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Para realizar este curso você precisa ter mais de 18 anos</div>";
                return false;
            }

            cpf = cpf.replace(/[^\d]+/g, '');

            if (cpf == '') {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
                return false;
            }

            // Valida 1o digito
            add = 0;
            for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);

            rev = 11 - (add % 11);

            if (rev == 10 || rev == 11) rev = 0;
            if (rev != parseInt(cpf.charAt(9))) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
                return false;
            }
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);

            if (rev == 10 || rev == 11) rev = 0;

            if (rev != parseInt(cpf.charAt(10))) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: CPF Inválido</div>";
                return false;
            }
/*
            if (serial == 1) {//integrado
                if (cgm.length == 0 || cgm == "0") {
                //if (cgm.length == 0 || cgm == "0" || cgm == "" || cgm == " ") {
                    document.getElementById('msg_erro').innerHTML =
                        "<div id='erro' class='alert alert-danger'>Erro: CGM Inválido</div>";
                    return false;
                }
            }
*/
            //   if (cgm.length == 0 || cgm == "0" || cgm == "" || cgm == " "){
            //   document.getElementById('msg_erro').innerHTML = "<div id='erro' class='alert alert-danger'>Erro: CGM Inválido</div>";
            //   return false;
            // }

            if (nome.length == 0 || nome == "") {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Nome Inválido</div>";
                return false;
            }

            if (rg.length == 0 || rg == "") {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: RG Inválido</div>";
                return false;
            }

            if (rg_data_expedicao.length == 0 || rg_data_expedicao == "") {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Data de expedição do RG é obrigatória</div>";
                return false;
            }

            //Aqui estou verificando se o campo data foi prrenchido
/*             if (datanasc == "dd/mm/aaaa") {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: Data Inválida.</div>";
                return false;
            }
 */

            if (email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
                document.getElementById('msg_erro').innerHTML =
                    "<div id='erro' class='alert alert-danger'>Erro: E-Mail Inválido</div>";
                return false;
            }

            return true;
        }
    </script>

    <style>
        .tooltipTrigger .tooltip {
            display: none;
            background: rgba(0, 0, 0, 0.9);
            padding: 10px;
            color: white;
            width: 500px;
        }

        .tooltipTrigger:hover {
            cursor: pointer;
        }

        .tooltipTrigger:hover .tooltip {
            display: block;
            position: relative;
            left: 10px;
            border: 1px solid #ccc;
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php
if ($curso != $a->__get('curso')) {
    ?>
    <div class="dialog-confirm" title="Pergunta?">
        <h4 style="font-weight:lighter; text-align:justify;">Você já possui uma inscrição para um curso
            diferente do que escolheu agora, caso continue a inscrição anterior será eliminada
            e você ficará inscrito apenas no curso atual.

        </h4>
    </div>
    <?php
}
?>
    <?php
if ($curso == 10) {
    ?>
    <div class="dialog-confirm" title="Pergunta?">
        <h4 style="font-weight:lighter; text-align:justify;">O curso de Especialização Técnica em Enfermagem do
            Trabalho é exclusivamente para quem já concluiu o curso de Técnico em Enfermagem. Apenas continue se você
            se enquadra neste pré-requisito.
        </h4>
    </div>
    <?php
}
?>

    <div class="row justify-content-center mt-5">
        <div class="col-xl-8 col-12">
            <div class="card px-2">
                <div class="card-header">
                    <h2 class="form-section text-center"><img class="img-fluid" src="../inscricao/images/pageheader.png" alt="Inscrições"></h2>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form id="form" name="form1" method="post"
                            action="<?php $SELF_PHP; echo $pagina; echo " acao=" . $acao;?>" onsubmit="return validar()">
                            <div class="form-body">

                                <div class='step-container'>
                                    <div class='step active' data-step='1'>
                                        1
                                    </div>
                                    <div class='step-separator active' data-step='1'></div>
                                    <div class='step  active' data-step='2'>
                                        2
                                    </div>
                                    <div class='step-separator' data-step='2'></div>
                                    <div class='step' data-step='3'>
                                        3
                                    </div>
                                </div>
                                <input type="hidden" name="serial" value="<?php echo $serial ?>" readonly required />
                                <input type="hidden" name="periodo" value="<?php echo $periodo ?>" readonly required />
                                <input type="hidden" name="curso" value="<?php echo $curso ?>" readonly required />
                                <input type="hidden" name="periodo2" value="<?php echo $periodo2 ?>" readonly required />
                                <input type="hidden" name="curso2" value="<?php echo $curso2 ?>" readonly required />

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>CPF. *</label>
                                        <input type="text" id="cpf" name="cpf" class="form-control"
                                            value="<?php echo $a->__get('cpf'); ?>" readonly required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                        <label>CGM:
                                            <span class="tooltipTrigger">
                                                <a>O que é CGM?</a><span class="tooltip">CGM significa: Código Geral de
                                                    Matrícula e todo estudante matriculado em escola
                                                    que pertença ao Sistema Estadual de Registro Escolar- SERE, possui
                                                    um número de CGM. O número pode ser encontrado em documentos
                                                    da escola como por exemplo o boletim escolar, caso o aluno não tenha
                                                    este número deverá entrar em contato com a escola onde está
                                                    matriculado.
                                                </span>
                                            </span>
                                        </label>
                                        <input type="number" name="cgm" class="form-control"
                                            value="<?php echo $a->__get('cgm'); ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Nome *</label>
                                        <input type="text" name="nome" class="form-control"
                                            value="<?php echo $a->__get('nome') ?>" required
                                            title="Informe seu nome e sobrenome" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label>RG *</label>
                                        <input type="text" name="rg" class="form-control"
                                            value="<?php echo $a->__get('rg'); ?>" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label>Data de expedição RG *</label>
                                        <input type="date" name="rg_data_expedicao" class="form-control"
                                            value="<?php echo $a->__get('rg_data_expedicao'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Nome da Mãe*</label>
                                        <input type="text" name="nome_mae" class="form-control"
                                            value="<?php echo $a->__get('nome_mae'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Nome da escola onde estudou*</label>
                                        <input type="text" name="escola_origem" class="form-control"
                                            value="<?php echo $a->__get('escola_origem'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Cidade da escola onde estudou*</label>
                                        <input type="text" name="escola_origem_cidade" class="form-control"
                                            value="<?php echo $a->__get('escola_origem_cidade'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Estado da escola onde estudou*</label>
                                        <!-- <input type="text" name="escola_origem_estado" value="<?php echo $a->__get('escola_origem_estado'); ?>" required/> -->

                                        <select name="escola_origem_estado" class="form-control" required>
                                            <option value="">Selecione</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espirito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR" selected="selected">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Data de nascimento *</label>
                                        <input type="text" id="datanasc" class="form-control" name="datanasc"
                                            value="<?php echo $a->__get('datanasc'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Email *</label>
                                        <input type="mail" name="email" class="form-control"
                                            value="<?php echo $a->__get('email'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Whatsapp *</label>
                                        <input type="text" id="fone_celular" class="form-control" name="fone_celular"
                                            value="<?php echo $a->__get('fone_celular'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Telefone *</label>
                                        <input type="text" id="fone_casa" class="form-control" name="fone_casa"
                                            value="<?php echo $a->__get('fone_casa'); ?>" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Cidade</label>
                                        <input type="text" name="cidade" class="form-control"
                                            value="<?php echo $a->__get('cidade'); ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Bairro</label>
                                        <input type="text" name="bairro" class="form-control"
                                            value="<?php echo $a->__get('bairro'); ?>" />
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Rua</label>
                                        <input type="text" name="rua" class="form-control"
                                            value="<?php echo $a->__get('rua'); ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Número</label>
                                        <input type="number" name="numero" class="form-control"
                                            value="<?php echo $a->__get('numero'); ?>" />
                                    </div>
                                </div>

                                <h5>*Campos obrigatórios</h5>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success" value="Avançar" name="etapa2" />
                                        <!-- <input type="reset" value="Apagar dados" /> -->
                                        <?php
                                            echo $resposta;
                                        ?>
                                        <div id="msg_erro">
                                            <!--Aqui aparece a mensagem de erro-->
                                        </div>
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>
<?php ob_end_flush();?>
