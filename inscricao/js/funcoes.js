function Calc_Med_Pt(){
//document.getElementById('$portugues').value=document.getElementById('$portugues').value + 1;

var media = 0.00;
per = document.forminscricoes.serial[document.forminscricoes.serial.selectedIndex].value;

if (per == 2){
media = (parseInt(document.getElementById('virtport1').value)+
parseInt(document.forminscricoes.virtport2.value)+
parseInt(document.forminscricoes.virtport3.value)+
//parseInt(document.forminscricoes.virtport5.value)+
parseInt(document.forminscricoes.virtport6.value)+
parseInt(document.forminscricoes.virtport7.value)+
parseInt(document.forminscricoes.virtport8.value)+
parseInt(document.forminscricoes.virtport0.value))/7;
}

if (per == 1){
media = (
parseInt(document.forminscricoes.virtport6.value)+
parseInt(document.forminscricoes.virtport7.value)+
parseInt(document.forminscricoes.virtport8.value)+
parseInt(document.forminscricoes.virtport0.value))/4;
}

if (media > 0) {
document.getElementById('maiorport').value=media.toFixed(2);//document.getElementById('port1').value;
}
}

function Calc_Med_Mt(){

var media=0,
per = document.forminscricoes.serial[document.forminscricoes.serial.selectedIndex].value;


if (per == 2){
media =
(parseInt(document.getElementById('virtmat1').value)+parseInt(document.forminscricoes.virtmat2.value)+parseInt(document.forminscricoes.virtmat3.value)
+parseInt(document.forminscricoes.virtmat6.value)+parseInt(document.forminscricoes.virtmat7.value)+
parseInt(document.forminscricoes.virtmat8.value)+parseInt(document.forminscricoes.virtmat0.value))/7;
}
if (per == 1){
media = (parseInt(document.forminscricoes.virtmat6.value)+
parseInt(document.forminscricoes.virtmat7.value)+parseInt(document.forminscricoes.virtmat8.value)+
parseInt(document.forminscricoes.virtmat0.value))/4;
}

if (media > 0) {
document.getElementById('maiormat').value=media.toFixed(2);
}
}

function valida_periodo(){
var serial = document.forminscricoes.serial[document.forminscricoes.serial.selectedIndex].value;

if (serial == 1) { //integrado
document.getElementById('periodo').length=0;
document.getElementById('periodo').options.length=0;
document.getElementById('periodo').options.add(new Option("Selecione um PerÄ‚Â­odo", "0"));
document.getElementById('periodo').options.add(new Option("ManhĂ„Æ’", "1"));
document.getElementById('periodo').options.add(new Option("Tarde", "2"));
//document.getElementById("notaportu").disabled= true;
//document.getElementById('virtmat1').setAttribute('disabled','disabled');
document.getElementById('virtmat1').disabled = true;
document.getElementById('virtmat2').setAttribute('disabled','disabled');
document.getElementById('virtmat3').setAttribute('disabled','disabled');
document.getElementById('virtport1').disabled = true;
document.getElementById('virtport2').disabled = true;
document.getElementById('virtport3').disabled = true;



}
if (serial == 2) { //subsequente
document.getElementById('periodo').length=0;
document.getElementById('periodo').options.length=0;
document.getElementById('periodo').options.add(new Option("Selecione um Turno", "0"));
// document.getElementById('periodo').options.add(new Option("ManhĂ„Æ’", "1"));
// document.getElementById('periodo').options.add(new Option("Tarde", "2"));
document.getElementById('periodo').options.add(new Option("Noite", "3"));
//document.getElementById('virtmat1').setAttribute('enable','true');
document.getElementById('virtmat1').disabled = false;
document.getElementById('virtmat2').disabled = false;

document.getElementById('virtmat3').disabled = false;

document.getElementById('virtport1').disabled = false;
document.getElementById('virtport2').disabled = false;
document.getElementById('virtport3').disabled = false;

// document.getElementById("frase").= Subsequente: Veja as maiores notas da lingua portuguesa e matematica'));



}

if (serial == 0) {
document.getElementById('periodo').length=0;
document.getElementById('periodo').options.add(new Option("Selecione um Turno", "0"));

}

}

function valida_curso(){
var periodo = document.forminscricoes.periodo[document.forminscricoes.periodo.selectedIndex].value;
var serial = document.forminscricoes.serial[document.forminscricoes.serial.selectedIndex].value;

if ( periodo == 0){
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um Curso", "0"));


}
if ( periodo == 1 && serial == 1){//integrado manhÄ‚Â£
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
// document.getElementById('curso').options.add(new Option("TÄ‚Â©cnico em EdificaÄ‚Â§Ă†Â¡es", "9"));
// document.getElementById('curso').options.add(new Option("AdministraÄ‚Â§Ă„Æ’o", "1"));
// document.getElementById('curso').options.add(new Option("EletromecÄ‚Â¢nica", "3"));
// document.getElementById('curso').options.add(new Option("InformÄ‚Â¡tica", "5"));
// document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
document.getElementById('curso').options.add(new Option("EletrÄ‚Â´nica", "2"));
// document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
/* document.getElementById('curso').options.add(new Option("Guia de Turismo Regional", "8"));*/
}
if (periodo == 2 && serial == 1){//Integrado tarde
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));

// document.getElementById('curso').options.add(new Option("AdministraÄ‚Â§Ă„Æ’o", "1"));
document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
document.getElementById('curso').options.add(new Option("Informática", "5"));
document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
// document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
//document.getElementById('curso').options.add(new Option("TÄ‚Â©cnico em EdificaÄ‚Â§Ă†Â¡es", "9"));
/*document.getElementById('curso').options.add(new Option("SeguranÄ‚Â§a do Trabalho", "7"));
document.getElementById('curso').options.add(new Option("Guia de Turismo Regional", "8"));*/

}

if (periodo == 1 && serial == 2){ // sub manha
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
// document.getElementById('curso').options.add(new Option("EletrÄ‚Â´nica - 2sem", "22"));
// document.getElementById('curso').options.add(new Option("Enfermagem - 1sem", "4"));
// document.getElementById('curso').options.add(new Option("InformÄ‚Â¡tica - 2sem", "52"));
//document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
document.getElementById('curso').options.add(new Option("TÄ‚Â©cnico em EdificaÄ‚Â§Ă†Â¡es", "9"));
}

if (periodo == 2 && serial == 2){ //sub tarde
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um Curso", "0"));
// document.getElementById('curso').options.add(new Option("Enfermagem - 1sem", "4"));
//document.getElementById('curso').options.add(new Option("Enfermagem - 2sem", "42"));
document.getElementById('curso').options.add(new Option("TÄ‚Â©cnico em EdificaÄ‚Â§Ă†Â¡es", "9"));
//document.getElementById('curso').options.add(new Option("SeguranÄ‚Â§a do Trabalho - 1sem", "7"));
//document.getElementById('curso').options.add(new Option("SeguranÄ‚Â§a do Trabalho - 2sem", "72"));
}

if (periodo == 3 && serial == 2){ // sub noite
document.getElementById('curso').length=0;
document.getElementById('curso').options.length=0;
document.getElementById('curso').options.add(new Option("Selecione um curso", "0"));
/* document.getElementById('curso').options.add(new Option("AdministraÄ‚Â§Ă„Æ’o - 2sem", "12"));
document.getElementById('curso').options.add(new Option("EletrÄ‚Â´nica - 2sem", "22"));
document.getElementById('curso').options.add(new Option("EletromecÄ‚Â¢nica - 2sem", "32"));
document.getElementById('curso').options.add(new Option("Enfermagem - 2sem", "42"));
document.getElementById('curso').options.add(new Option("InformÄ‚Â¡tica - 2sem", "52"));
document.getElementById('curso').options.add(new Option("Meio Ambiente - 2sem", "62"));
document.getElementById('curso').options.add(new Option("SeguranÄ‚Â§a do Trabalho - 2sem", "72"));*/
document.getElementById('curso').options.add(new Option("Administração", "1"));
document.getElementById('curso').options.add(new Option("Edificações", "9"));
document.getElementById('curso').options.add(new Option("Eletrônica", "2"));
document.getElementById('curso').options.add(new Option("Eletromecânica", "3"));
document.getElementById('curso').options.add(new Option("Enfermagem", "4"));
document.getElementById('curso').options.add(new Option("Informática", "5"));
//document.getElementById('curso').options.add(new Option("Meio Ambiente", "6"));
document.getElementById('curso').options.add(new Option("Segurança do Trabalho", "7"));







}
}


function enfermagem(){

var opcao = document.forminscricoes.curso[document.forminscricoes.curso.selectedIndex].value

if (opcao == 2) {
document.getElementById("auxiliarenf").disabled = false;
document.getElementById("auxiliarenf").options[0] = new Option("Fez auxiliar de Enfermagem", "0");
document.getElementById("auxiliarenf").options[1] = new Option("Sim", "1");
document.getElementById("auxiliarenf").options[2] = new Option("Não", "2");
}else
{
document.getElementById("auxiliarenf").disabled = true;

}

}

function somentedecimal(objeto){
var digits="0123456789,";
var campo_temp;
campo = eval (objeto);
for (var i=0;i<campo.value.length;i++) { campo_temp=campo.value.substring(i,i+1) if (digits.indexOf(campo_temp)==-1){
        campo.value=campo.value.substring(0,i); } } } function somentenumero(objeto,origem){ var digits="0123456789" ;
        var campo_temp; campo=eval (objeto); /*for(var i=0; i < objeto.attributes.length; i++){
        if(objeto.attributes[i].specified) document.write( + Ă¢â‚¬Â Ă¢â‚¬â€œ Ă¢â‚¬Â + objeto.attributes[i].nodeValue
        + Ă¢â‚¬Å“<br>Ă¢â‚¬Â);
        }*/


        if (origem == 1) {
        document.forminscricoes.maiormat.value=0;
        }

        if (origem == 2){
        document.forminscricoes.maiorport.value=0;
        }

        if(campo.value>100) {
        campo.value = '';
        }

        for (var i=0;i<campo.value.length;i++) { campo_temp=campo.value.substring(i,i+1) if (digits.indexOf(campo_temp)==-1){
                campo.value=campo.value.substring(0,i); } } } function numerocpf(objeto){ var digits="0123456789" ; var
                campo_temp; campo=eval (objeto); for (var i=0;i<campo.value.length;i++){ campo_temp=campo.value.substring(i,i+1)
                if (digits.indexOf(campo_temp)==-1){ campo.value=campo.value.substring(0,i); } } }
                /*---------------------------------------------------------------------------------------------------
                FunÄ‚Â§Ă„Æ’o para a formataÄ‚Â§Ă„Æ’o do Telefone forma de chamar $fone->OnKeyPress('mascarafone(event,
                this)');
                -----------------------------------------------------------------------------------------------------*/

                function mascarafone(evento, objeto){
                var keypress=(window.event)?event.keyCode:evento.which;
                campo = eval (objeto);
                if (campo.value == '0000-0000')
                {
                campo.value=""
                }

                caracteres = '0123456789';
                separacao1 = '-';
                separacao2 = ') ';
                separacao3 = '';
                separacao4 = '-';
                conjunto1 = 4;
                conjunto2 = 10;
                conjunto3 = 10;
                conjunto4 = 10;
                conjunto5 = 10;
                if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (9)) { if
                        (campo.value.length==conjunto1 ) campo.value=campo.value + separacao1; else if
                        (campo.value.length==conjunto2) campo.value=campo.value + separacao2; else if
                        (campo.value.length==conjunto3) campo.value=campo.value + separacao3; else if
                        (campo.value.length==conjunto4) campo.value=campo.value + separacao4; else if
                        (campo.value.length==conjunto5) campo.value=campo.value + separacao3; } else event.returnValue=false;
                        } function mascaranasc(evento, objeto){ var keypress=(window.event)?event.keyCode:evento.which;
                        campo=eval (objeto); if (campo.value=='00/00/0000' ) { campo.value="" } caracteres='0123456789'
                        ; separacao1='/' ; conjunto1=2; conjunto2=5; if ((caracteres.search(String.fromCharCode
                        (keypress))!=-1) && campo.value.length < (10)) { if (campo.value.length==conjunto1 )
                        campo.value=campo.value + separacao1; else if (campo.value.length==conjunto2) campo.value=campo.value
                        + separacao1; } else event.returnValue=false; }
                        /*---------------------------------------------------------------------------------------------------
                        FunÄ‚Â§Ă„Æ’o para a formataÄ‚Â§Ă„Æ’o do RG forma de chamar $rg->OnKeyPress('mascara(event,
                        this)');
                        -----------------------------------------------------------------------------------------------------*/

                        function mascara(evento, objeto){
                        var keypress=(window.event)?event.keyCode:evento.which;
                        campo = eval (objeto);
                        if (campo.value == '0.000.000-0')
                        {
                        campo.value=""
                        }

                        caracteres = '0123456789';
                        separacao1 = '.';
                        separacao2 = '.';
                        separacao3 = '-';
                        conjunto1 = 1;
                        conjunto2 = 5;
                        conjunto3 = 9;
                        conjunto4 = 13;
                        conjunto5 = 16;
                        if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (11)) { if
                                (campo.value.length==conjunto1 ) campo.value=campo.value + separacao1; else if
                                (campo.value.length==conjunto2) campo.value=campo.value + separacao2; else if
                                (campo.value.length==conjunto3) campo.value=campo.value + separacao3; else if
                                (campo.value.length==conjunto4) campo.value=campo.value + separacao3; else if
                                (campo.value.length==conjunto5) campo.value=campo.value + separacao3; } else
                                event.returnValue=false; } function valida_concorda(){ // alert(1); var concorda=document.forminscricoes.concordo.checked;
                                if (concorda){ //alert('concordou'); document.getElementById('action2').disabled=false;
                                document.getElementById('action2').style.color='buttontext' }else{ //alert('n
                                concordou'); document.getElementById('action2').disabled=true;
                                document.getElementById('action2').style.color='#a0a0a0' ; } } </script> <style type='text/css'
                                media='screen'>
                                .tfield
                                {
                                border: solid;
                                border-color: #a0a0a0;
                                border-width: 1px;
                                z-index: 1;
                                }
                                </style>
                                <style type='text/css' media='screen'>
                                        .tfield_disabled {
                                                border: solid;
                                                border-color: #a0a0a0;
                                                border-width: 1px;
                                                background-color: #e0e0e0;
                                                color: #a0a0a0;
                                        }
                                </style>
                                <script type="text/javascript">
                                        function Imprimir() {
                                                document.getElementById("button").style.visibility = "hidden";
                                                window.print();
                                        }
                                </script>