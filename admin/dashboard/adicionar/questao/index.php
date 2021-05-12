<?php
session_start();

if (!  isset($_SESSION['admin']) ) {
  header("Location: ../");
}
?>
    <!doctype html>
    <html lang="pt-br">
        <head>

            <meta charset="utf-8">
            <title>GPAS: GERAÇÃO DE PROVAS ATRAVÉS DE SORTEIO</title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
 
            <meta name="description" content="Aplique avaliações de maneira dinâmica, com questões escolhidas de maneira aleatória por um algoritmo. Plataforma desenvolvida por Isak Ruas <isakruas@gmail.com>.">
            <meta name="keywords" content="Geração de provas, Sorteio aleatório">
            <meta name="author" content="Isak Paulo de Andrade Ruas">

            <link rel="stylesheet" type="text/css" href="../../../../static/css/fonts.css">
            <link rel="stylesheet" type="text/css" href="../../../../static/css/reset.css">
            <link rel="stylesheet" type="text/css" href="../../../../static/css/stylesheet.css">
 
            <script type="text/javascript" src="../../../../static/js/script.js"></script>




            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML-full"></script>
            <script type="text/x-mathjax-config">
            MathJax.Hub.Config({showProcessingMessages: false, tex2jax: { inlineMath: [['\\(','\\)']] } });
            </script>
  
  
   

            <script type="text/javascript" src="../../../../static/js/editor.js"></script>









   
  <style type="text/css">
    .paragraph {
        padding-top: 12pt;
        padding-bottom: 12pt;
        line-height: 1.2;
        orphans: 2;
        widows: 2;
        text-align: justify
    }

    .paragraph-padding-left {
        border-right-style: solid;
        padding-top: 0pt;
        border-top-width: 0pt;
        border-bottom-color: null;
        border-right-width: 0pt;
        padding-left: 22.5pt;
        border-left-color: null;
        padding-bottom: 0pt;
        line-height: 1.2;
        border-right-color: null;
        border-left-width: 0pt;
        border-top-style: solid;
        border-left-style: solid;
        border-bottom-width: 0pt;
        border-top-color: null;
        border-bottom-style: solid;
        orphans: 2;
        widows: 2;
        text-align: justify;
        padding-right: 0pt
    }
  .a{
    position: relative;
    width: 100%;
    padding: 0.25cm;
    margin:0.5cm;
    overflow-x: hidden;
    cursor: pointer;
  }
  .b {
    width: 70%;
    left: 15%;
  }
  </style>
    </head>
    <body>
      <div class="header">
            <a href="#"><p>GPAS: GERAÇÃO DE PROVAS ATRAVÉS DE SORTEIO</p></a>
      </div>
      <div class="nav">
         <div class="nav-three-row">
          <div class="nav-three-row-one">
           </div>
          <div class="nav-three-row-two">
              <svg onclick = "System.Redirect('../../')"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.222 18.917c5.666-5.905-.629-10.828-5.011-7.706l1.789 1.789h-6v-6l1.832 1.832c7.846-6.07 16.212 4.479 7.39 10.085z" />
              </svg>
          </div>
          <div class="nav-three-row-three">
     
          </div>
        </div>
      </div>
      <div class="main">
        <div class="main-l">
            <div class="main-i" id="info"></div>
            <div class="main-m">
                <script type="text/javascript">
                  document.getElementById('info').innerHTML = '<h2>ADICIONAR - QUESTÃO</h2>';
                </script>
 
<div class="main-one-columns">
  <div class="main-one-columns-one">
 

    <button class="a b" type="submit" onclick="adicionar_questao()" style="margin: 0cm; padding:0.5cm">Cadastrar questão</button>
    <br>

    <p  class="a b" style="margin-bottom: 0cm;">Curso (nome):</p>
    <select  class="a b" id="curso_id"></select>
    <br>

    <p  class="a b" style="margin-bottom: 0cm;">Prova (nome):</p>
    <select  class="a b" id="prova_id"></select>
    <br>

      <p class="a b"  style="margin-bottom: 0cm;">Numero da questão </p>
      <br>
      <input class="a b" type="number" id="numero">
      <br>

      <p class="a b"  style="margin-bottom: 0cm;">Codigo da imagem, caso haja. Se não houver digitar <span style="color: red">null</span>. Para realizar upload de uma imagem clique  <span style="color: red" onclick="upload_imagem()">aqui</span></p>
      <br>
      <input class="a b" type="text" id="imagem_id" value="null">
      <br>


      <p class="a b"  style="margin-bottom: 0cm;" >Pergunta</p>
      <br>
      <textarea class="a b" id="pergunta" cols="60" rows="10" onkeyup="Preview.Update()" style="resize: none;margin-top:5px; border: 0.05cm solid #0b2639"></textarea>
      <br>


      <p class="a b"  style="margin-bottom: 0cm;" >Preview pergunta</p>
      <br>
      <div class="a b"id="pergunta_buffer" style="border:1px solid; padding: 3px;"></div>
      <br>
 
      <div class="a" id="pergunta_preview"><div>

 
 
  </div>
</div>
 
 
            </div>
        </div>
 
      </div>
 
<div class="alert" id="upload_imagem">
    <div class="alert-box">
        <div class="alert-two-row">

            <form id="form"  name="form" action="javascript:void(0);" enctype="multipart/form-data">

            <div class="alert-two-row-one" style="overflow-y: auto; padding:0.5cm; text-align: justify;">
               Selecione uma imagem com formato jpg ou jpeg;
                <br /><br />

                <input type="file" style="display: none !important;" name="imagem" id="imagem" value="" required/>
                <label  style="background: #fff; height: 100%;text-align: center;padding-top: 1.7%; cursor: pointer;border-radius: 0.375em;" for='imagem' id="label_imagem">SELECIONAR ARQUIVO</label>
                         <br />

            </div>
            <div class="alert-two-row-two">

        
                <!--div class="alert-one-columns">
                    <div class="alert-one-columns-one" onclick=" document.getElementById('alert').style.visibility = 'hidden'" >
                        <p>Ok</p>
                    </div>
                </div-->

                <div class="alert-two-columns">
                    <div class="alert-two-columns-one" onclick="document.getElementById('upload_imagem').style.visibility = 'hidden';   document.getElementById('form').style.visibility = 'hidden';document.getElementById('form').style.display = 'nome';">
                        <p>Cancelar</p>
                    </div>
                    <div class="alert-two-columns-two">
                        <input type="submit" value="Enviar" style="color: #0b2639;font-family: 'Roboto', sans-serif;font-style: normal; cursor: pointer; font-size: 14pt; border: none; width: 100%; height: 100%" class="primary" />
                    </div>
                </div>
                 
            </div>
            </form>





            <div id="progressBar" style="display: none;visibility: hidden;" >
              
            <div class="alert-two-row-one" >

            </div>
            <div class="alert-two-row-two">

        
                <div class="alert-one-columns">
                    <div class="alert-one-columns-one" id="progress" style="background: red">
                        
                    </div>
                </div>

 
                 
            </div>
 
            </div>





            <div id="divReturn" style="display: none;visibility: hidden;" >
              
            <div class="alert-two-row-one" id="divReturn_msg" style="overflow-y: auto; padding:0.5cm; text-align: justify;">

            </div>
            <div class="alert-two-row-two" id="divReturn_menu">

        
               

 
                 
            </div>
 
            </div>








        </div>
    </div>
</div>
            <script type="text/javascript">
var form, divReturn, progressBar;

form = document.getElementById('form');
progressBar = document.getElementById('progressBar');
divReturn = document.getElementById('divReturn');
progress = document.getElementById('progress');

form.addEventListener('submit', sendForm, false);

function sendForm(evt) {

    var formData, ajax, pct;

    formData = new FormData(evt.target);

    ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {

        if (ajax.readyState == 4) {
            //oculta barra de stats
            progressBar.style.display = "none";
            progressBar.style.visibility = "hidden";
 
            form.reset();


            var response = JSON.parse(ajax.response);

            if (response.return == false || response.return == "false") {


                document.getElementById('divReturn_msg').innerHTML = "Houve um problema ao carregar a sua imagem, isto pode ocorrer por diversos fatores, por favor, tente novamente.";
                document.getElementById('divReturn_menu').innerHTML = '<div class="alert-one-columns"><div class="alert-one-columns-one" onclick="document.getElementById(' + "'divReturn' " + ').style.visibility = ' + " 'hidden'" + '; document.getElementById(' + "'divReturn' " + ').style.display = ' + "'none'" + '; document.getElementById(' + "'form' " + ').style.visibility = ' + "'visible'" + '; document.getElementById(' + "'form' " + ').style.display = ' + "'block'" + ';" ><p>Ok</p></div></div>';

                //não recebeu
                console.log(ajax.response);
 
                divReturn.style.display = "block";
                divReturn.style.visibility = "visible";

            } else {

                document.getElementById('imagem_id').value = response.return;

                            //esconde formulário
  
                progressBar.style.display = "none";
                progressBar.style.visibility = "hidden";

                divReturn.style.display = "none";
                divReturn.style.visibility = "hidden";

 
                document.getElementById('upload_imagem').style.visibility = 'hidden';


            }


        } else {
            //exibe rarra de status
            progressBar.style.display = "block";
            progressBar.style.visibility = "visible";

            //esconde formulário
            form.style.display = "none";
            form.style.visibility = "hidden";

        }
    }

    ajax.upload.addEventListener('progress', function(evt) {

        pct = Math.floor((evt.loaded * 100) / evt.total);
        progress.style.width = pct + '%';

    }, false);

    ajax.open('POST', '../../../api.php?x=upload_imagem');
    ajax.send(formData);

}
            </script>





    </body>
    </html>
 
 <script type="text/javascript">

setInterval(function(){

  if (document.getElementById('imagem').value=='') {
    document.getElementById('label_imagem').innerHTML ='SELECIONAR ARQUIVO';
  } else {
    document.getElementById('label_imagem').innerHTML ='ARQUIVO SELECIONADO';
  }

}, 3000);





function upload_imagem (){

  console.log('upload_imagem');

  document.getElementById('upload_imagem').style.visibility = 'visible';

  document.getElementById('form').style.visibility = 'visible';
  document.getElementById('form').style.display = 'block';

}


System.Ajax.Get({
    url: "../../../api.php",
    data: "x=buscar_cursos",
      success:function(json){

        var rtn = JSON.parse(json);
        console.log(rtn);

        var html = "";
        for (var i = rtn.length - 1; i >= 0; i--) {
          html = html + '<option value="'+rtn[i]['id']+'">'+rtn[i]['nome']+'</option>';
        }
     
         document.getElementById('curso_id').innerHTML = html;

      } 
});



System.Ajax.Get({
    url: "../../../api.php",
    data: "x=buscar_provas",
      success:function(json){

        var rtn = JSON.parse(json);
        console.log(rtn);

        var html = "";
        for (var i = rtn.length - 1; i >= 0; i--) {
          html = html + '<option value="'+rtn[i]['id']+'">'+rtn[i]['nome']+'</option>';
        }
     
         document.getElementById('prova_id').innerHTML = html;

      } 
});







  function adicionar_questao() {




    var pergunta = document.getElementById('pergunta').value;
    var numero = document.getElementById('numero').value;
    var imagem_id = document.getElementById('imagem_id').value;


    
    if (pergunta !== "") {

      document.getElementById("pergunta").style.border = "0.05cm solid #0b2639";

      var select = document.getElementById('curso_id');
      var curso_id = select.options[select.selectedIndex].value;

      var select2 = document.getElementById('prova_id');
      var prova_id = select2.options[select2.selectedIndex].value;
 

     if (numero >= 1) {
        document.getElementById("numero").style.border = "0.05cm solid #0b2639";

        console.log(pergunta);
        console.log(curso_id);
        console.log(numero);


      System.Ajax.Get({
          url: "../../../api.php",
          data: "x=adicionar_questao&pergunta="+encodeURIComponent(pergunta)+"&curso="+curso_id+"&numero="+numero+"&prova="+prova_id+"&imagem="+imagem_id,
          success: function(rtn) {
            var obj = JSON.parse(rtn);
            if (obj.return == true || obj.return == "true") {
              console.log(obj.return);
              location.href = "../../visualizar/questoes";
            } 
          },
      });

     } else {
        document.getElementById("numero").style.border = "0.05cm solid red";
     }
    } else {

       document.getElementById("pergunta").style.border = "0.05cm solid red";
    }
  }



      Preview.Init();
 </script>