
    <!doctype html>
    <html lang="pt-br">
        <head>

            <meta charset="utf-8">
            <title>GPAS: GERAÇÃO DE PROVAS ATRAVÉS DE SORTEIO</title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
 
            <meta name="description" content="Aplique avaliações de maneira dinâmica, com questões escolhidas de maneira aleatória por um algoritmo. Plataforma desenvolvida por Isak Ruas <isakruas@gmail.com>.">
            <meta name="keywords" content="Geração de provas, Sorteio aleatório">
            <meta name="author" content="Isak Paulo de Andrade Ruas">

            <link rel="stylesheet" type="text/css" href="../../static/css/fonts.css">
            <link rel="stylesheet" type="text/css" href="../../static/css/reset.css">
            <link rel="stylesheet" type="text/css" href="../../static/css/stylesheet.css">
 <script data-ad-client="ca-pub-3896720377619154" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<meta name="google-site-verification" content="l74csg9oLPF-nk1-QyG0jevkfM94w2D1tOjDBl3wBBs" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2VH59EJWFB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2VH59EJWFB');
</script>
            <script type="text/javascript" src="../../static/js/script.js"></script>
   
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
   
  var query = location.search.slice(1);
  var partes = query.split('&');
  var data = {};
  partes.forEach(function (parte) {
    var chaveValor = parte.split('=');
    var chave = chaveValor[0];
    var valor = chaveValor[1];
    data[chave] = valor;
  });

  System.Ajax.Get({
      url: "../../api.php",
      data: "x=buscar_prova_gerada&prova="+data.prova,
      success: function(rtn) {
        var obj = JSON.parse(rtn);

        if (obj.return) {
          console.log('prova não gerada');

          html ='<p  class="a b" >Observações: 1) as questões da prova são escolhidas de maneira aleatória através de um algoritmo de sorteio, executado do lado do servidor 2); não é possível apagar uma prova depois que esta é gerada e 3) só é possível gerar uma prova uma única vez.</p><button class="a b" onclick="gerar()"  type="submit">Gerar</button>';
            document.getElementById('q').innerHTML = html;

        } else {

          console.log('prova já gerada');

          html ='<p  class="a b" >Você já gerou esta prova</p>';
            document.getElementById('q').innerHTML = html;

        } 
      }
  });

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

  function gerar() {
    System.Ajax.Get({
        url: "../../api.php",
        data: "x=buscar_prova_id&id="+data.prova,
        success: function(rtn) {
          var ob = JSON.parse(rtn);
          var obj = ob[0];
          
          console.log(obj.curso);


          System.Ajax.Get({
              url: "../../api.php",
              data: "x=gerar_prova&curso="+obj.curso+"&prova="+data.prova,
              success: function(rtn) {
                var obj = JSON.parse(rtn);

            if (obj.return) {
              console.log('ainda não há questoes cadastradas para esta prova');
            } else {



                var lista = [];
                for (var i = obj.length - 1; i >= 0; i--) {
                   lista[i] = {
                    'numero': obj[i]['numero'],
                    'ids': shuffle(obj[i]['ids'])
                  }; 
                }

                var questoes= ""
                for (var i = lista.length - 1; i >= 0; i--) {
                  if (questoes == "") {
                    questoes = lista[i]['ids'][0];
                  } else {
                    questoes = questoes + "." + lista[i]['ids'][0];
                  }
                }

                console.log('prova='+data.prova+'&questao='+questoes);
                    System.Ajax.Get({
                        url: "../../api.php",
                        data: "x=nova_prova_gerada&prova="+data.prova+"&questao="+questoes,
                        success: function(rtn) {
                            var obj = JSON.parse(rtn);
                            if (obj.return == true || obj.return == "true") {
                              console.log(obj.return);
                              location.href = "../visualizar/?prova="+data.prova;
                            } 
                        }
                    });                 
              }

            }
          });
        }
    });
  }
</script>

 
<script type="text/javascript">
  document.getElementById('info').innerHTML = '<h2 style="white-space: nowrap">DASHBOARD > GERAR PROVA</h2>';
</script>

<div class="main-one-columns">
  <div class="main-one-columns-one">

    <div id="q">

    </div>



 
  </div>
</div>


            </div>
        </div>
      </div>
 
    </body>
    </html>

 
 