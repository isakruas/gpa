
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
 
      </div>
      <div class="main">
        <div class="main-l">
            <div class="main-i" id="info"></div>
            <div class="main-m">
<script type="text/javascript">
  document.getElementById('info').innerHTML = '<h2>ENTRAR</h2>';
</script>
 
      <div class="main-auto-row-auto">
 
          <p class="a b"  style="margin-bottom: 0cm;">Email</p>
          <input class="a b" type="email" id="email" class="a">
          <br />
 
          <p class="a b" style="margin-bottom: 0cm;">Senha</p>
          <input class="a b" type="password" id="senha"  >
          <br />
 
          <button class="a b" onclick="validar()" >Entrar</button>

      </div>
            </div>
        </div>
      </div>
 
    </body>
    </html>
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
              url: "api.php",
              data: "x=entrar&email=" + email + "&senha=" + senha,
              success: function(rtn) {
                var obj = JSON.parse(rtn);
                if (obj.return == true || obj.return == "true") {
                  console.log(obj.return);
                  location.href = "./dashboard";
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
 