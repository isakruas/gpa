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

            <link rel="stylesheet" type="text/css" href="../../../../../static/css/fonts.css">
            <link rel="stylesheet" type="text/css" href="../../../../../static/css/reset.css">
            <link rel="stylesheet" type="text/css" href="../../../../../static/css/stylesheet.css">
 
            <script type="text/javascript" src="../../../../../static/js/script.js"></script>




            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML-full"></script>
            <script type="text/x-mathjax-config">
            MathJax.Hub.Config({showProcessingMessages: false, tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] } });
            </script>
  
   

            <script type="text/javascript" src="../../../../../static/js/editor.js"></script>









   
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
              <svg onclick = "System.Redirect('../')"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
                  document.getElementById('info').innerHTML = '<h2>VISUALIZAR - QUESTÃO(ÕES) - EXCLUIR</h2>';
                </script>
 
<div class="main-one-columns">
  <div class="main-one-columns-one">
 

     <p  class="a b" >Atenção! você está prestes a excluir esta questão, esta ação não poderá ser desfeita. Caso realmente queira excluir esta questão clique no botão abaixo.</p>
     <button class="a b" onclick="excluir()"  type="submit">Confirmar exclusão</button>

 
 
  </div>
</div>
 
 
            </div>
        </div>
 
      </div>
  
<script type="text/javascript">

var query = location.search.slice(1);
  var partes = query.split('&');
  var data = {};
  partes.forEach(function (parte) {
    var chaveValor = parte.split('=');
    var chave = chaveValor[0];
    var valor = chaveValor[1];
    data[chave] = valor;
  });


function excluir() {
  System.Ajax.Get({
    url:"../../../../api.php", 
    data:"x=excluir_questao_id&id="+data.id,
    success:function(json){

      var obj = JSON.parse(json);
      if (obj.return == true || obj.return == "true") {
        console.log(obj.return);
        location.href = "../";
      } else {
        alert('não foi possivel processar sua solicitação');
        location.href = "../";
      }
    } 
  });
 
}


</script>

</body>
</html>
  