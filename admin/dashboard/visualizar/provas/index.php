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
                  document.getElementById('info').innerHTML = '<h2>VISUALIZAR - PROVA(S)</h2>';
                </script>
                 



<div class="main-one-columns">
    <div class="main-one-columns-one">
 
        <div class="main-auto-row-auto">
            <div class="profile-footer-ul">
                <div class="main-four-columns profile-footer-li">
                    <div class="main-four-columns-one" style="height: 1cm">
          

                        <p style="position: relative ; width: auto; top: 30%; text-align: center;font-weight: bold;">
                            Prova (nome)
                        </p>


                    </div>

                     <div class="main-four-columns-two" style="min-width: 1cm; border-left: 0.05cm solid #002907;"  >
                        <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">
                            Prova (id)
                        </p>
                    </div>


                     <div class="main-four-columns-three" style="min-width: 1cm; border-left: 0.05cm solid #002907;"  >
                        <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">
                            Prova (status)
                        </p>
                    </div>


                    <div class="main-four-columns-four" style="min-width: 1cm; border-left: 0.05cm solid #002907;" onclick="System.Redirect('cadastrar/{{el.etapa}}/')">
                        <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">
                            Editar
                        </p>
                    </div>
                </div>
            </div>
        </div>



<script type="text/javascript">
    System.Ajax.Get({
      url:"../../../api.php", 
      data:"x=buscar_provas",
      success:function(json){

        var rtn = JSON.parse(json);
        console.log(rtn);

        var html = "";
        for (var i = rtn.length - 1; i >= 0; i--) {
          html = html + '<div class="main-auto-row-auto"><div class="profile-footer-ul"><div class="main-four-columns profile-footer-li"><div class="main-four-columns-one" style="height: 1cm"><p style="position: relative ; width: auto; top: 30%; text-align: center; ">'+rtn[i]['nome']+'</p></div><div class="main-four-columns-two" style="min-width: 1cm; border-left: 0.05cm solid #002907;"><p style="position: relative ; width: auto; top: 30%; text-align: center;">'+rtn[i]['id']+'</p></div><div class="main-four-columns-three" style="min-width: 1cm; border-left: 0.05cm solid #002907;"><p style="position: relative ; width: auto; top: 30%; text-align: center;">'+rtn[i]['status']+'</p></div><div class="main-four-columns-four" style="min-width: 1cm; border-left: 0.05cm solid #002907;" onclick="System.Redirect('+"'./editar/?id="+rtn[i]['id']+"'"+')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg></div></div></div></div>';
        }
     




         document.getElementById('provas').innerHTML = html;

      } 
    });


 

 
</script>


          <div id="provas">
 
          </div>
 
     
    </div>
</div>
 


            </div>
        </div>
      </div>
 
    </body>
    </html>
 