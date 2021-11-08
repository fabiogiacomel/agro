<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



include "alunoClass.php";

$a = Aluno::getInstance();

$pagina = "?pagina=imprimir";

$modalidades = array(null => "Modalidade não informada", 1 => "Integrado", 2 => "Subsequente");
$cursos = array(
    null => "Curso não informado",
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
    12 => "CELEM ALEMÃO",
    13 => "CELEM ESPANHOL",
    14 => "CELEM INGLÊS",
    15 => "CELEM ITELIANO",
    16 => "CELEM MANDARIN",
    17 => "TÉCNICO EM AGRONEGÓCIOS",
    18 => "TÉCNICO AGRÍCOLA",
    19 => "DESENVOLVIMENTO DE SISTEMAS",
);
$modalidades = array(null => "Modalidade não informada", 1 => "Integrado", 2 => "Subsequente");
$periodos = array(null => "Periodo não informado", 1 => "Matutino", 2 => "Vespertino", 3 => "Noturno");

$ensino_medio = array(
    null => "Ensino Médio não informado",
    1 => "Integralmente em rede pública ou bolsista integral da rede particular",
    2 => "Parcial na Rede Pública (Máximo 1 ano Rede Particular)",
    3 => "Parcial na Rede Pública (Máximo 2 ano Rede Particular)",
    //4 => "Opção inválida",
    //5 => "Opção inválida",
);

$ensino_fundamental = array(
    null => "Ensino Fundamental não informado",
    1 => "Integralmente em rede pública ou bolsista integral da rede particular",
    2 => "Parcial na Rede Pública (Máximo 1 ano Rede Particular)",
    3 => "Parcial na Rede Pública (Máximo 2 anos Rede Particular)",
    4 => "Parcial na Rede Pública (Máximo 3 anos Rede Particular)",
);

$rendas = array(
    null => "Renda não informada",
    1 => "R$ 0,00 até meio (um) Salário Mínimos",
    2 => "Acima de 1/2 (meio) até 1 (um) Salários Mínimos",
    3 => "Acima de 1 (um) até 2 (dois) Salários Mínimos",
    4 => "Acima de 2 (dois) Salários Mínimos",
);
$comprovantes_renda = array(
    null => "Comprovante não informado",
    1 => "Holerite",
    2 => "Carteira de trabalho",
    3 => "Declaração de IR",
    4 => "Declaração de Autônomo",
    5 => "Autodeclaração",
);

$trabalha_area = array(
    null => "Trabalha na área não informado",
    1 => "Não",
    2 => "Sim (Obrigatório apresentar declaração da empresa no ato da matrícula)",
);

$necessidade_especiais =
    array(
        0 => "Nenhuma",
        1 => "Autismo clássico",
        2 => "Síndrome de Rett",
        3 => "Síndrome de Down",
        4 => "Cegueira",
        5 => "Surdez",
        6 => "Deficiência Física",
        7 => "Altas habilidades/Superdotação",
        8 => "Síndrome de Asperger",
        9 => "Transtorno Deficit de Atenção e hiperatividade",
        10 => "Baixa visão",
        11 => "Deficiência auditiva",
        12 => "Deficiência mútipla",
        13 => "Distúrbios de aprendizagem",
        14 => "Condutas típicas",
        15 => "Transtornos Mentais e de Comportamento",
        16 => "Deficiência intelectual",
        17 => "Surdoceguira",
        18 => "Condutas típicas",
        19 => "Transtorno desintegrativo da infância(Psicose/Esquizofrenia)",
    );
// $rendas = array(null =>"Renda não informada",1 => "R$ 0,00 até 1 (um) Salário Mínimos",
//                                     2 => "Acima de 1 (um) até 2 (dois) Salários Mínimos",
//                                           3 => "Acima de 2 (dois) Salários Mínimos"
//                                  );

$abandonos = array(
    null => "Abandono não informado", 1 => "Não",
    2 => "Sim",
);

$cpf = "";
if (isset($_GET['cpf'])) {
    // GeraLog::getInstance()->log("get cpf");
    $cpf = $_GET['cpf'];
    $a->__set('cpf', $cpf);
}

//GeraLog::getInstance()->log("CPF: " . $cpf);

//Estava usando o carregar da tabela antiga agora
//carrega na antiga e depois na nova.
if ($a->__get('curso') < 12) {
    $a->carregar();
} else {
   // $a->carregarCelem();
}

$pontuacao = 0;
$pontuacao_curso2 = 0;

if ($a->__get('bolsa_familia') == 1) {
    $pontuacao = $pontuacao + 15; //3; mudou em 26/09/17
    $pontuacao_curso2 = $pontuacao_curso2 + 15;
}
/*
if ($a->__get('renda') == 1) {
    $pontuacao = $pontuacao + 30;
}

if ($a->__get('renda') == 2) {
    $pontuacao = $pontuacao + 25;
}

if ($a->__get('renda') == 3) {
    $pontuacao = $pontuacao + 20;
}

if ($a->__get('renda') == 4) {
    $pontuacao = $pontuacao + 10;
}*/
/* ============================================================
    SISTEMA DE PONTUAÇÃO USADO EM 2020 
    DESATIVADO EM 07/11/2021 - FABIO GIACOMEL
   ============================================================*/

/*    if ($a->__get('serial') == 1) { //integrado
    $pontuacao = $pontuacao + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
    $pontuacao_curso2 = $pontuacao_curso2 + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
}
if ($a->__get('serial') == 2) { //subsequente
    if ($a->__get('curso') == 4) { //enfermagem
        $pontuacao = $pontuacao + (($a->__get('media_quimica') +
            $a->__get('media_biologia') +
            $a->__get('media_portugues') +
            $a->__get('media_matematica')) / 4);
    } else {
        $pontuacao = $pontuacao + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
    }

    if ($a->__get('curso2') == 4) { //enfermagem
        $pontuacao_curso2 = $pontuacao_curso2 + (($a->__get('media_quimica') +
            $a->__get('media_biologia') +
            $a->__get('media_portugues') +
            $a->__get('media_matematica')) / 4);
    } else {
        $pontuacao_curso2 = $pontuacao_curso2 + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
    }
}
 */
/* ============================================================
    SISTEMA DE PONTUAÇÃO USADO EM 2021 
    ATIVADO EM 07/11/2021 - FABIO GIACOMEL
    Alterações importantes: Media de enfermagem leva em 
    consideração as disciplinas de ciencia e quimica
   ============================================================*/


if ($a->__get('serial') == 1) { //integrado
    $pontuacao = $pontuacao + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
    $pontuacao_curso2 = $pontuacao_curso2 + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
}
if ($a->__get('serial') == 2) { //subsequente
    if ($a->__get('curso') == 4) { //enfermagem
        $pontuacao = $pontuacao +
            (($a->__get('media_quimica') +
                $a->__get('media_biologia')) / 2);
    } else {
        $pontuacao = $pontuacao + (($a->__get('media_portugues') + $a->__get('media_matematica')) / 2);
}
}


/* $pontuacao = $pontuacao +
(($a->__get('media_portugues') +
$a->__get('media_matematica') +
$a->__get('media_quimica') +
$a->__get('media_biologia'))); */

if ($a->__get('ensinomedio') == 1) {
    $pontuacao = $pontuacao + 85; //4; pontuacao mudou em 06/07/15
    $pontuacao_curso2 = $pontuacao_curso2  + 85;
}

if ($a->__get('ensinomedio') == 2) {
    $pontuacao = $pontuacao + 65; //1;
    $pontuacao_curso2 = $pontuacao_curso2 + 65;
}

if ($a->__get('ensinomedio') == 3) {
    $pontuacao = $pontuacao + 50; //3;
    $pontuacao_curso2 = $pontuacao_curso2 + 50;
}

if ($a->__get('ensinomedio') == 5) {
    $pontuacao = $pontuacao + 50; //3;
    $pontuacao_curso2 = $pontuacao_curso2 + 50;
}

/* if ($a->__get('ensinomedio') == 4) {
    $pontuacao = $pontuacao + 15; //2;
    $pontuacao_curso2 = $pontuacao_curso2 +15;
}

if ($a->__get('ensinomedio') == 5) {
    $pontuacao = $pontuacao + 70; //4; modou em 06/07/15
    $pontuacao_curso2 = $pontuacao_curso2  +70;
} */

if ($a->__get('ensinofundamental') == 1) {
    $pontuacao = $pontuacao + 85; //3;
    $pontuacao_curso2 = $pontuacao_curso2 + 85;
}

if ($a->__get('ensinofundamental') == 2) {
    $pontuacao = $pontuacao + 65; //1;
    $pontuacao_curso2 = $pontuacao_curso2 + 65;
}

if ($a->__get('ensinofundamental') == 3) {
    $pontuacao = $pontuacao + 50; //2;
    $pontuacao_curso2 = $pontuacao_curso2 + 50;
}

if ($a->__get('ensinofundamental') == 4) {
    $pontuacao = $pontuacao + 30; //3;
    $pontuacao_curso2 = $pontuacao_curso2 + 30;
}

/* if ($a->__get('ensinofundamental') == 5) {
    $pontuacao = $pontuacao + 30; //3;
    $pontuacao_curso2 = $pontuacao_curso2 +30;
} */

// if ($a->__get('abandono')==2){  Retirado em 03/06/17 a pedido de Jorge
// $pontuacao = $pontuacao - 2;
// }

//Adicionado em 20/10/2015 para favorecer quem trabalha na area
//a pedido de Rudy Just
// if ($a->__get('serial')==2 && $a->__get('trabalha_area')==2){
//         $pontuacao = $pontuacao + 0.5;
//     }

// //Adicionado em 07/07/2015 para favorecer alunos do CEEP no esp. em enfermagem a pedido de Rudy Just
// if ($a->__get('instituicao_formacao')==1){
//         $pontuacao = $pontuacao + 1;
//     }

$a->__set('pontuacao', $pontuacao);
$a->__set('pontuacao_curso2', $pontuacao_curso2);
$a->salvarPontuacao();
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <title>Comprovante de inscrição</title>
    <link rel="stylesheet" href="../inscricao/css/inscricao.css" media="screen">
    <link rel="stylesheet" href="../inscricao/css/inscricao_print.css" media="print">
    <style type="text/css">
        body {
            width: 595pt;
            /*height: 800pt;*/
            overflow: none;
            display: block;
            border: solid 1px #c1c1c1;
            /*box-shadow: 0px 0px 3px 3px #353535;*/
            margin: 0 auto;
            font-size: 0.85em;
            background-image: none;
        }

        ul {
            margin: 0;
            padding: 0;
            margin-left: 20px;
        }

        tr {
            width: 595pt;
            margin: 0;
        }

        td {
            width: 445pt;
            border: solid 1px #c0c0c0;
        }

        .label {
            width: 150pt;
            background-color: #f0f0f0;

        }

        h2,
        h4 {
            text-align: center;
        }

        h4 {
            margin: 0;
            padding: 0;
        }

        /*div#logo{display: none;}*/
        /*CSS para impressão*/
        @media print {
            img {
                display: none;
            }

            div#logo {
                display: block;
            }
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_GET['pagina'])) {
        echo "<center><img src='../inscricao/images/pageheader.png' alt='Inscrições'></center>";
    }
    ?>
    <div id="comprovante">
        <div id="logo">
            <h2>CEEP - CENTRO ESTADUAL DE EDUCAÇÃO PROFISSIONAL</h2>
        </div>
        <!-- <h4>CADASTRO DE RESERVA</h4>
 -->
        <h4>Sua inscrição foi realizada com sucesso.
            <?php
            $dataHora = date("d/m/Y h:i:s");
            echo $dataHora;
            ?>
        </h4>
        <table><?php
                echo "<tr><td class='label'>Protocolo:</td><td>";

                //if($a->__get('dataalteracao') < '2019-06-24' )
                echo "202002";
                //else
                //    echo "RESERVA-";

                echo $a->__get('id') . "</td>";
                echo "<td class='label'>CGM:</td><td>" . $a->__get('cgm') . "</td></tr>";
                echo "<tr><td class='label' >Nome:</td><td>" . $a->__get('nome') . "</td>";
                echo "<td class='label' >Nome da mãe:</td><td>" . $a->__get('nome_mae') . "</td></tr>";
                //echo "<tr><td class='label'>Data de Nascimento:</td><td>" . date_format(date_create($a->__get('datanasc')), 'd/m/Y') . "</td>";
                echo "<tr><td class='label'>Data de Nascimento:</td><td>" . $a->__get('datanasc'). "</td>";
                echo "<td class='label'>CPF:</td><td>" . $a->__get('cpf') . "</td></tr>";
                echo "<tr><td class='label'>RG:</td><td>" . $a->__get('rg') . "</td><td class='label'>Expedição:</td><td> " . date_format(date_create($a->__get('rg_data_expedicao')), 'd/m/Y') . "</td></tr>";
                echo "<tr>";


                //if ($a->__get('curso') < 12) {
                //echo "<tr><td class='label'>Cidade:</td><td>" . $a->__get('cidade')."</td>";
                //echo "<td class='label'>Bairro:</td><td>" . $a->__get('bairro')."</td></tr>";
                //echo "<tr><td class='label' colspan='2'>Endereço:</td><td colspan='2'>" . $a->__get('rua')."</td></tr>";

                echo "<tr><td class='label' colspan='2'>Escola de origem:</td><td colspan='2'>" . $a->__get('escola_origem') . "-" . $a->__get('escola_origem_cidade') . "-" . $a->__get('escola_origem_estado') . "</td></tr>";

                echo "<tr><td class='label'>Modalidade:</td><td>" . $modalidades[$a->__get('serial')] . "</td></tr>";

                echo "<tr><td class='label'>Curso:</td><td>" . $cursos[$a->__get('curso')] . "</td>";
                echo "<td class='label'>Período:</td><td>" . $periodos[$a->__get('periodo')] . "</td></tr>";

                /* echo "<tr><td class='label'>Curso Opção 2:</td><td>" . $cursos[$a->__get('curso2')] . "</td>";
echo "<td class='label'>Período Opção 2:</td><td>" . $periodos[$a->__get('periodo2')] . "</td></tr>"; */

                echo "<tr><td class='label'>E-mail:</td><td colspan='3'>" . $a->__get('email') . "</td></tr>";
                echo "<tr><td class='label'>Telefone:</td><td>" . $a->__get('fone_casa') . "</td>";
                echo "<td class='label'>Whatsapp:</td><td>" . $a->__get('fone_celular') . "</td></tr>";



                echo "<tr><td class='label' colspan='2'>Beneficiário de programas federais de trasferência de renda:</td><td colspan='2'>";
                if ($a->__get('bolsa_familia') == 1) {

                    echo "Sim (15 Pontos) NIS: " . $a->__get('nis') . "</td></tr>";
                } else {
                    echo "Não (0 Pontos)</td></tr>";
                }

                if ($a->__get('curso') < 20) { // Se der erro voltar para 12
                    if ($a->__get('curso') == 10) {
                        echo "<tr><td class='label' colspan='2'>Pontos das notas:</td><td colspan='2'>" . $a->__get('media_portugues') . "</td></tr>";
                    } else {
                        echo "<tr><td class='label'>Português:</td><td> " . $a->__get('media_portugues') . " </td>";
                        echo "<td class='label'>Matemática:</td><td> " . $a->__get('media_matematica') . " </td></tr>";
                    }

                    if ($a->__get('curso') == 4 || $a->__get('curso2') == 4) {
                        echo "<tr><td class='label'>Química:</td><td> " . $a->__get('media_quimica') . " </td>";
                        echo "<td class='label'>Biologia:</td><td> " . $a->__get('media_biologia') . "  </td></tr>";
                    }

                    if ($a->__get('serial') == 2) { //Apenas para o subsequente)
                        // echo "<tr><td class='label' colspan='2'>Pontos das notas:</td><td colspan='2'>" . $a->__get('media_portugues')."</td></tr>";
                        echo "<tr><td class='label'>Ensino Médio:</td><td colspan='3'>" . $ensino_medio[$a->__get('ensinomedio')];
                        if ($a->__get('ensinomedio') == 1) {
                            echo "(85 Pontos)"; //3; //Todo em rede pública
                        }

                        if ($a->__get('ensinomedio') == 2) {
                            echo "(65 Pontos)"; //3; //Todo em rede particular
                        }

                        if ($a->__get('ensinomedio') == 3) {
                            echo "(50 Pontos)"; //3; //No máximo 1 ano em rede particular
                        }

                        /*  if ($a->__get('ensinomedio') == 4) {
            echo "(15 Pontos)"; //3; //No máximo 2 ano em rede particular
        }

        if ($a->__get('ensinomedio') == 5) {
            echo "(70 Pontos)"; //3; //Bolsista integral
        } */

                        echo "</td></tr>";
                    } else {
                        echo "<tr><td class='label' colspan='2'>Ensino Fundamental:</td><td colspan='2'>" . $ensino_fundamental[$a->__get('ensinofundamental')];
                        if ($a->__get('ensinofundamental') == 1) {
                            echo "(85 Pontos)"; //3;
                        }

                        if ($a->__get('ensinofundamental') == 2) {
                            echo "(65 Pontos)"; //1;
                        }

                        if ($a->__get('ensinofundamental') == 3) {
                            echo "(50 Pontos)"; //2;
                        }

                        if ($a->__get('ensinofundamental') == 4) {
                            echo "(30 Pontos)"; //3;
                        }

                        /*   if ($a->__get('ensinofundamental') == 5) {
            echo "(30 Pontos)"; //3;
        } */
                        echo "</td></tr>";
                    }

                    /*echo "<tr><td class='label' colspan='1'>Renda Média:</td><td colspan='3'>" . $rendas[$a->__get('renda')];*/

                    /*if ($a->__get('renda') == 1) {
        echo "(30 Pontos)";
    }

    if ($a->__get('renda') == 2) {
        echo "(25 Pontos)";
    }

    if ($a->__get('renda') == 3) {
        echo "(20 Pontos)";
    }

    if ($a->__get('renda') == 4) {
        echo "(10 Pontos)";
    }*/
                    /*echo "</td></tr>";
    echo "<tr><td class='label' colspan='2'>Comprovante de renda:</td><td colspan='2'>" . $comprovantes_renda[$a->__get('comprovante_renda')] . "</td></tr>";
*/
                    if ($a->__get('serial') == 2) { //Apenas para o subsequente
                        /// echo "<tr><td class='label'>Trabalha na Área:</td><td>" . $trabalha_area[$a->__get('trabalha_area')] . "</td>";
                        // echo "<td class='label' >Abandono de curso:</td><td >" . $abandonos[$a->__get('abandono')] . "</td></tr>";
                    }

                    echo "<tr><td class='label' colspan='2'>Necessidade Especial:</td><td colspan='2'>" . $necessidade_especiais[$a->__get('tipo_necessidade')] . "</td></tr>";

                    // echo "<tr><td class='label' colspan='2'>Para salvar sua inscrição clique no botão Confirmar Inscrição.</td></tr>";

                    echo "<tr><td class='label'><strong>Pontuação:</strong></td><td><strong>" . number_format($pontuacao, 2) . "</strong></td>";
                    echo "<td class='label'><strong><!--Curso 2:--></strong></td><td><strong><!--" . number_format($pontuacao_curso2, 2) . "--></strong></td></tr>";
                }
                echo "<tr><td colspan='4'>Decreto-Lei n2.848 - Código penal-Falsidade ideológica - Art. 299 Omitir, em documento público ou particular declaração que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa de que devia ser escrita, com o fim de prejudicar direito, criar obrigações ou ou alterar a verdade sobre fato juridicamente relevante. Pena reclusão de um a cinco anos, e multa, se o documento é público, e reclusão de um a tres anos, e multa de quinhentos mil réis e cinco conto de réis, se o documento é particular</td></tr>";
                if ($a->__get('curso') < 12) {
                ?>
                <tr>
                    <td colspan='4'>
                        <strong>
                            Atenção: Após publicação do resultado final será programado uma data para a palestra esclarecedora no Auditório do CEEP.
                        </strong>
                        O estágio curricular é obrigatório a ser cumprido no contra turno para os cursos (Edificações, Eletromecânica, Eletrônica, Enfermagem, Meio Ambiente, Segurança do Trabalho e Especialização Técnica em Enfermagem do Trabalho).
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Data/Publicação do Resultado: 30/11/2021.</strong><br> -->
                        <!--Data das matrículas de 01 a 04 de julho de 2019.<br>-->
                        Cópia e Original de Documentos a Apresentar no Ato da Matrícula:<br>
                        * RG; * CPF(Todos); * Tit. de Eleitor (Para Maiores); <br>
                        * Certidão de Nascimento/Casamento;<br>
                        * Declaração emitida pela Instituição de Ensino para aluno bolsista;<br>
                        * Comprovante de Residência/COPEL; <br>
                        * Taxa de Contribuição APPAF: R$ 30,00 (Trinta reais);<br>
                        <?php
                        if ($a->__get('serial') == 1) {
                            echo "* Histórico Escolar Fundamental ou Declaração de Notas;<br>";
                        } else {
                            echo "* Histórico Escolar do Ensino Médio ou Declaração de Notas.<br>";
                        }
                        ?>
                        * Comprovante de inscrição.<br>
                    </td>
                    <td colspan="2">

                        <h4>ORIENTAÇÃO CONJUNTA</h4>
                        <h4>N° 13/2021 - DEDUC/DPGE</h4>

                        <p class='carimbo'>A abertura de turmas e a efetivação da matricula estão vinculadas ao número mínimo de 35 (trinta e cinco) interessados ao final desse processo classificador (Conforme resolução n°4527/2011-GS/SEED), bem como a regularidade de Atos Legais da instituição de Ensino e a Análise pela SEED dos índices de abandono das turmas nos 4 períodos letivos já encerrados.</p>
                    </td>
                </tr>
            <?php
                }
                echo "<tr><td colspan='4' class='text-justify'><strong>Declaro verdadeiras as informações acima e estar ciente que, em caso de classificação para o curso
e efetivação de matrícula, o não comparecimento nas aulas nos primeiros cinco dias úteis do início
do curso implicará na exclusão automática da matrícula, sendo necessário participar de novo
processo seletivo para ingresso no curso pretendido.<strong><br></td></tr>";


                echo "<tr><td colspan='4' class='text-center'><br><strong>____________________________, ______ de ___________________________20____.<strong></td></tr>";


                echo "<tr><td colspan='4' class='text-center'><br><br><strong>_________________________________________________<strong></td></tr>";
                echo "<tr><td colspan='4' class='text-center'><strong>Assinatura<strong></td></tr>";

                echo "<tr class='no-print hidden_print'><td colspan='4' class='hidden_print no-print'><strong>Confira sua pontuação final e caso esteja de acordo com a pontuação obtida imprima o comprovante para confirmar sua inscrição<strong></td></tr>";
                echo "<tr class='hidden_print no-print'><td calss='label hidden_print'  colspan='2'><input class='hidden_print' type='button' name='imprimir' value='Concordar com a pontuação e Imprimir' onclick='window.print();'></td>";
                echo "<td class='label botao hidden_print no-print'  colspan='2'><a href='?pagina=inicio'><input type='button' name='new' value='Nova inscrição'></a></td></tr>";

            ?>
        </table>
    </div>
</body>

</html>