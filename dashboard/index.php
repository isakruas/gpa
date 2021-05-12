<?php
session_start();

if (!  isset($_SESSION['id']) ) {
  header("Location: ../entrar");
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

            <link rel="stylesheet" type="text/css" href="../static/css/fonts.css">
            <link rel="stylesheet" type="text/css" href="../static/css/reset.css">
            <link rel="stylesheet" type="text/css" href="../static/css/stylesheet.css">
 
            <script type="text/javascript" src="../static/js/script.js"></script>
   

<script type="text/javascript">
  
  function sair() {
          System.Ajax.Get({
              url: "../api.php",
              data: "x=sair",
              success: function(rtn) {
                var obj = JSON.parse(rtn);
                if (obj.return == true || obj.return == "true") {
                  console.log(obj.return);
                  location.href = "../entrar";
                }
              },
          });
  }
</script>












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
   <div class="nav-two-row">
        <div class="nav-two-row-one">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path  fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z"/></svg>
        </div>
        <div class="nav-two-row-two">
            <svg  onclick = "sair()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7 14h-14v-4h14v4z" />
            </svg>
        </div>
 
    </div>
      </div>
      <div class="main">
        <div class="main-l">
            <div class="main-i" id="info"></div>
            <div class="main-m">
 





<script type="text/javascript">
  document.getElementById('info').innerHTML = '<h2 style="white-space: nowrap">DASHBOARD</h2>';
</script>

<div class="main-one-columns">
    <div class="main-one-columns-one">
        <div class="main-auto-row-auto">
          <div class="profile-footer-ul">
            <div class="main-three-columns profile-footer-li">
              <div class="main-three-columns-one" style="height: 1cm">
                <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">Provas</p>
              </div>
              <div class="main-three-columns-two" style="min-width: 1cm; border-left: 0.05cm solid #002907;">
                <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">
                Visualizar
                </p>
              </div>
              <div class="main-three-columns-three" style="min-width: 1cm; border-left: 0.05cm solid #002907;">
                <p style="position: relative ; width: auto; top: 30%; text-align: center; font-weight: bold;">
                 Gerar
               </p>
              </div>
            </div>
          </div>
        </div>


<?php

  $cursos =  explode('.', $_SESSION['curso']);//json_encode(, JSON_NUMERIC_CHECK);

  $ch = curl_init();
 
  curl_setopt($ch, CURLOPT_URL, "https://gpas.nrolabs.com/gpg/api.php?x=buscar_provas");
  //curl_setopt($ch, CURLOPT_URL, "http://localhost/gpasa/api.php?x=buscar_provas");

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $provas = json_decode(curl_exec($ch));

  curl_close($ch);

 
  $filtro = array();
  for ($i=0; $i < count($cursos); $i++) { 
    for ($k=0; $k < count($provas); $k++) { 
      if (intval($provas[$k]->status) == 1) {
        if (intval($provas[$k]->curso) == intval($cursos[$i])) {
          $filtro[] = $provas[$k];
        }
      }
    }
  }

  $_SESSION['provas'] = $filtro;

  for ($i=0; $i < count($_SESSION['provas']); $i++) { 
?>
 
        <div class="main-auto-row-auto">
            <div class="profile-footer-ul">
                <div class="main-three-columns profile-footer-li">
                    <div class="main-three-columns-one" style="height: 1cm">
                        <p style="position: relative ; top: 30%; text-align: center;">
                           <?php echo $filtro[$i]->nome ?>
                        </p>
                    </div>
                    <div class="main-three-columns-two" onclick="System.Redirect('visualizar/?prova=<?php echo $filtro[$i]->id ?>')" style="border-left: 0.05cm solid #002907; min-width: 1cm;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"/>
                        </svg>
                    </div>
                    <div class="main-three-columns-three" style="min-width: 1cm; border-left: 0.05cm solid #002907;" onclick="System.Redirect('gerar/?prova=<?php echo $filtro[$i]->id ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"  d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-32 252c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92H92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

<?php 

  }

?>

     
    </div>
</div>
 
            </div>
        </div>
      </div>
 
    </body>
    </html>
 
 
