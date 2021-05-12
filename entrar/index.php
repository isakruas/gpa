    <!doctype html>
    <html lang="pt-br">
        <head>

            <meta charset="utf-8">
            <title>GPAS - GERAÇÃO DE PROVAS ATRAVÉS DE SORTEIO</title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Aplique avaliações de maneira dinâmica, com questões escolhidas de maneira aleatória por um algoritmo. Plataforma desenvolvida por Isak Ruas <isakruas@gmail.com>.">
            <meta name="keywords" content="Geração de provas, Sorteio aleatório">
            <meta name="author" content="Isak Paulo de Andrade Ruas">


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

            <link rel="stylesheet" type="text/css" href="https://bq.mat.br/static/css/fonts.css">
            <link rel="stylesheet" type="text/css" href="https://bq.mat.br/static/css/reset.css">
            <link rel="stylesheet" type="text/css" href="https://bq.mat.br/static/css/stylesheet.css">
            <script type="text/javascript" src="../static/js/script.js"></script>

            <style type="text/css">
              
              a{
                : 
              }
            </style>
    </head>
    <body>
      <div class="header">
      </div>
      <div class="nav">
        <!-- block nav -->
           <div class="nav-three-row">
          <div class="nav-three-row-one">

          </div>
          <div class="nav-three-row-two">
            <svg onclick = "location.href='../'"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.222 18.917c5.666-5.905-.629-10.828-5.011-7.706l1.789 1.789h-6v-6l1.832 1.832c7.846-6.07 16.212 4.479 7.39 10.085z" />
            </svg>
          </div>
          <div class="nav-three-row-three">

          </div>
        </div>
        <!-- endblock nav -->
      </div>
      <div class="main">
        <div class="main-l">
            <div class="main-i" id="info">
              
            </div>
            <div class="main-m">
            <!-- block main -->
<script type="text/javascript">
  document.getElementById('info').innerHTML = '<h2>ENTRAR</h2>';
</script>
 
      <div class="main-auto-row-auto">
          <div class="forms">
            <p  style="margin-bottom: 0cm;">Email</p>
            <input type="email" id="email" class="a">
            <br />
   
            <p  style="margin-bottom: 0cm;">Senha</p>
            <input type="password" id="senha"  >
            <br />
   
            <button  onclick="validar()" >Entrar</button>
          </div>


      </div>

  <script type="text/javascript">
  function validar() {
    var email  = document.getElementById('email').value;
 
    var senha  = document.getElementById('senha').value;
    if (email == "") {
       document.getElementById("email").style.border = "0.05cm solid red";
    } else {
       document.getElementById("email").style.border = "0.05cm solid #0b2639";
       if (senha == "") {
        document.getElementById("senha").style.border = "0.05cm solid red";
        } else {
          document.getElementById("senha").style.border = "0.05cm solid #0b2639";
          System.Ajax.Get({
              url: "../api.php",
              data: "x=entrar&email=" + email + "&senha=" + senha,
              success: function(rtn) {
                var obj = JSON.parse(rtn);
                if (obj.return == true || obj.return == "true") {
                  console.log(obj.return);
                  location.href = "../dashboard";
                } else {
                  document.getElementById("senha").style.border = "0.05cm solid red";
                  document.getElementById("email").style.border = "0.05cm solid red";
                }
              },
          });
        }
    }
    console.log(email, senha)
  }
</script>
            <!-- endblock main -->
            </div>
        </div>
      </div>
 

    </body>
    </html>