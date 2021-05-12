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
                  document.getElementById('info').innerHTML = '<h2>VISUALIZAR - USUÁRIO(S) - EDITAR</h2>';
                </script>


                <div class="main-one-columns">
                  <div class="main-one-columns-one">
                 
                        <p  class="a b" style="margin-bottom: 0cm;">Usuário (nome):</p>
                   
                        <input   class="a b" type="text"  id="usuario_nome" >
                        <br>

                        <p  class="a b" style="margin-bottom: 0cm;">Usuário (curso):</p>
                   
                        <div id="cursos"></div>
                        <br>

                        <p  class="a b" style="margin-bottom: 0cm;">Usuário (email):</p>
                   
                        <input   class="a b" type="text"  id="usuario_email" >
                        <br>

                 
                          <ul style=" visibility: hidden;display: none;">
                 
                          </ul>
                          <button class="a b" onclick="atualizar_usuario()" type="submit">Salvar alteração</button>
                 
                    </div>
                </div>








            </div>
        </div>
 
      </div>
 
    </body>
    </html>



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
      url:"../../../../api.php", 
      data:"x=buscar_usuario_id&id="+data.id,
      success:function(json){

        var rtn = JSON.parse(json);
 
        document.getElementById('usuario_nome').value = rtn[0]['nome'];
        document.getElementById('usuario_email').value = rtn[0]['email'];
 
      } 
    });

    System.Ajax.Get({
       url:"../../../../../api.php", 
      data:"x=buscar_cursos",
      success:function(json){

        var rtn2 = JSON.parse(json);
 
        var html = "";

        for (var i = rtn2.length - 1; i >= 0; i--) {

          html =  html + '<input  class="a b" style="float:left; left:0cm"  type="checkbox" id="curso'+rtn2[i]['id']+'" name="curso'+rtn2[i]['id']+'" value="'+rtn2[i]['id']+'"><label style="position:relative; float:left; left=30%!important; margin-left:-15%" for="curso'+rtn2[i]['id']+'">'+rtn2[i]['nome'] +' - Curso ('+rtn2[i]['id']+')</label><br>';
        }

        document.getElementById('cursos').innerHTML = html;

        var js = "";

        for (var i = rtn2.length - 1; i >= 0; i--) {
          js = js + 'if(document.getElementById("curso'+rtn2[i]['id']+'").checked) {if (curso == "") {curso = document.getElementById("curso'+rtn2[i]['id']+'").value;} else {curso = curso + "." + document.getElementById("curso'+rtn2[i]['id']+'").value;}}';
        }


        var script = document.createElement("script");
 
        script.innerHTML = "function atualizar_usuario() {var curso = '';"+js+"var nome = document.getElementById('usuario_nome').value;var email = document.getElementById('usuario_email').value;System.Ajax.Get({url:'../../../../api.php',data:'x=atualizar_usuario_id&id='+data.id+'&nome='+encodeURIComponent(nome)+'&email='+email+'&curso='+curso,success:function(rtn){var obj = JSON.parse(rtn);if (obj.return == true || obj.return == 'true') {console.log(obj.return);location.href = '../';}}});}";
        

        document.body.appendChild(script);


      }
    })
 

 

 
</script>
 