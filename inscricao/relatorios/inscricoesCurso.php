<!doctype html>
<html>
    <head>
        <title>Gráfico de inscrições por curso</title>
        <script src="../js/Chart.Core.js"></script>
        <script src="../js/Chart.Doughnut.js"></script>
        <style>
            body{
                padding: 0;
                margin: 0;
            }
            #canvas-holder{
                width:30%;
            }
        </style>
    </head>
    <body>
        <div id="canvas-holder">
            <canvas id="chart-area" width="500" height="500"/>
        </div>


    <script>

        var doughnutData = [


    <?php
    require_once("alunoClass.php");

    //Criando e Instanciando o objeto
    $i = Inscricao::getInstance();
    $result = $i->consultarInscricaoCurso();

        $count = 0;
        $cursos  = array(
                                null => "Erro: sem curso",
                                    1 => "Administração",
                                2 => "Eletrônica",
                                3 => "Eletromecânica",
                                4 => "Enfermagem",
                                5 => "Informática",
                                6 => "Meio Ambiente",
                                7 => "Segurança do Trabalho",
                                // 8 => "Guia de Turismo Regional",Espólio
                                9 => "Edificações",
                                10=> "Especialização Técnica em Enfermagem do Trabalho",
                                // 11=> "Móveis",
                                );

    foreach ($result as $inscricao) {

            echo "{value:".$inscricao->total.",";
            echo "color:'blue' ,";
            echo "highlight: '#000000',";
            echo "label:".$cursos[$inscricao->curso].",";
            echo "},";
    }
    ?>
            ];

            window.onload = function(){
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
            };
    </script>
    </body>
</html>