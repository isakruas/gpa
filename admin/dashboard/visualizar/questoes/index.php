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
    <body id="body">
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
                  document.getElementById('info').innerHTML = '<h2>VISUALIZAR - QUESTÃO(ÕES)</h2>';
                </script>
 
                <div id="questoes">
                  
                </div>
 
 
 
  </div>
</div>
 
 
            </div>
        </div>
 
      </div>
 
    </body>
    </html>
 
 <script type="text/javascript">

System.Ajax.Get({
    url: "../../../api.php",
    data: "x=buscar_questoes",
      success:function(json){

        var rtn = JSON.parse(json);
        console.log(rtn);

        var html = "";
        for (var i = rtn.length - 1; i >= 0; i--) {



if (rtn[i]['imagem'] !=='null') {
  html = html +  '<div class="main-auto-row-auto"><div class="profile-footer-ul"><div class="main-row-columns profile-footer-li" ><div class="main-row-columns-one" style="overflow-x: auto; padding: 1cm; max-width: 93vw"><center><img style="width: 10cm" src="../../../../media/?l='+rtn[i]['imagem']+'"><br /><br /><br /></center><h3>Pergunta:</h3><br /><p style="text-align: justify; max-width: 93vw; height: 100%;">'+rtn[i]['pergunta']+' <br /><br />  <h3>Detalhes:</h3><br /><p style="text-align: justify; max-width: 93vw; height: 100%;"> Curso:'+rtn[i]['curso']+'; Prova:'+rtn[i]['prova']+'; Número:'+rtn[i]['numero']+';  </p></div><div class="main-two-columns-two"><br /><svg   onclick="System.Redirect('+"'./editar/?id="+rtn[i]['id']+"'"+')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <svg    onclick="System.Redirect('+"'./excluir/?id="+rtn[i]['id']+"'"+')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/></svg><br /><br /></div></div></div></div>';  



    var math = document.getElementById("body");
    MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);


} else {

 

          html = html +  '<div class="main-auto-row-auto"><div class="profile-footer-ul"><div class="main-row-columns profile-footer-li" ><div class="main-row-columns-one" style="overflow-x: auto; padding: 1cm; max-width: 93vw"><h3>Pergunta:</h3><br /><p style="text-align: justify; max-width: 93vw; height: 100%;">'+rtn[i]['pergunta']+'</p>    <br /><br />  <h3>Detalhes:</h3><br /><p style="text-align: justify; max-width: 93vw; height: 100%;"> Curso:'+rtn[i]['curso']+'; Prova:'+rtn[i]['prova']+'; Número:'+rtn[i]['numero']+';</p>            </div><div class="main-two-columns-two"><br /><svg   onclick="System.Redirect('+"'./editar/?id="+rtn[i]['id']+"'"+')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <svg    onclick="System.Redirect('+"'./excluir/?id="+rtn[i]['id']+"'"+')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/></svg><br /><br /></div></div></div></div>';


      var math = document.getElementById("body");
      MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);

  }



        }
     
         document.getElementById('questoes').innerHTML = html;

      } 
});




 </script>

