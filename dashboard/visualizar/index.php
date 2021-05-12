<?php
session_start();

if (!isset($_SESSION['id']) ) {
  header("Location: ../../entrar");
}

if (!isset($_GET['prova']) ) {
  header("Location: ../../entrar");
}

?>


		<!DOCTYPE html>
		<html>
		<head>
			<title>GPAS: GERAÇÃO DE PROVAS ATRAVÉS DE SORTEIO</title>
            <script type="text/javascript" src="../../static/js/script.js"></script>
			<link href="favicon.ico" rel="Shortcut Icon" />
			<meta charset="utf-8">
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
            <meta name="description" content="Aplique avaliações de maneira dinâmica, com questões escolhidas de maneira aleatória por um algoritmo. Plataforma desenvolvida por Isak Ruas <isakruas@gmail.com>.">
            <meta name="keywords" content="Geração de provas, Sorteio aleatório">
            <meta name="author" content="Isak Paulo de Andrade Ruas">
			
			<meta name="viewport" content="initial-scale=1, maximum-scale=1">


            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML-full"></script>
            <script type="text/x-mathjax-config">
            MathJax.Hub.Config({showProcessingMessages: false, tex2jax: { inlineMath: [['\\(','\\)']] } });
            </script>

			<style type="text/css">
				* {
					margin: 0cm;
					padding: 0cm;
				}
				body {
					background: rgb(204,204,204); 
					font-size: 12pt;
					font-family: "Times New Roman", Times, serif;
				}
				page {
					background: white;
					display: block;
					margin: 0 auto;
					margin-bottom: 0.5cm;
					box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
					height: auto;
				}
				page[size="A4"] {  
					width: 21cm;
					height:auto;  /*/(5*29.7) cm; */
				}
				@media print {
					body, page {
						margin: 0;
						padding: 0;
						box-shadow: 0;
					}
				}
				
				img,div {
 
					margin-top: -1cm;
				}
				p {
					position: absolute;
				}

			</style>

		</head>
		<body id="body">
			<page size="A4"> 
				<br/><br/>


				<?php 

					$filtro = array();
 
				    for ($k=0; $k < count($_SESSION['provas']); $k++) { 
				      if (intval($_SESSION['provas'][$k]->id) == intval($_GET['prova'])) {
				        $filtro[] = $_SESSION['provas'][$k];
				      }
				    }

					if (count($filtro) == 0) {
							//prova não faz parte do curso
							// usuario sem permição para acessar esta prova
				?>
							<div>
						 
							    <p style="text-align: justify; max-width: 93vw; position: relative;  height: 100%; padding: 1.5cm">
							    	Não é possivel localizar a prova em que procura, isto ocorre pelos seguintes morivos 
							    	1) Voce não tem permição para acessar esta prova
							    	2) Voce ainda não gerou esta prova


							    </p>
			 
							</div>
				<?php 
					} else {
				?>
 

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

        	html ='<p style="text-align: justify; max-width: 93vw; position: relative;  height: 100%; padding: 1.5cm">Não é possivel localizar a prova em que procura, isto ocorre pelos seguintes morivos 1) Voce ainda não gerou esta prova</p><br /><br />';
			document.getElementById('q').innerHTML = html;


        } else {
			console.log(obj[0].questao);
 
			var questao = obj[0].questao.split(".");

			questao.sort();

			for (var i = 0; i < questao.length; i++) {

				console.log(questao[i]);

				  System.Ajax.Get({
				      url: "../../api.php",
				      data: "x=buscar_questao&id="+questao[i],
				      success: function(rtn2) {
				        var obj = JSON.parse(rtn2);
				 			html = document.getElementById('q').innerHTML;




				        if (obj[0].imagem !=="null") {

 							console.log(obj[0].imagem);

				        	html = html + '<p style="text-align: justify; max-width: 93vw; position: relative;  height: 100%; padding: 1cm; margin-top:0cm"> '+obj[0].numero+") "+ ' </p><center><img style="width: 7cm"src="../../media/?l='+obj[0].imagem+'"></center><br /><p style="text-align: justify; max-width: 93vw; position: relative;  height: 100%; padding: 1.5cm; margin-top:0cm">' + obj[0].pergunta+'</p>';

				        } else {
							html = html + '<p style="text-align: justify; max-width: 93vw; position: relative;  height: 100%; padding: 1cm; margin-top:0cm"> '+obj[0].numero+") "+ obj[0].pergunta+'</p>';

				        }





						document.getElementById('q').innerHTML = html;
						var math = document.getElementById("body");
						MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);




				      },
				  });
			}
        }






      }
  });

setInterval(function(){
	var math = document.getElementById("body");
	MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);
}, 3000);

</script>



				<?php
					}

				?>
				<div id="q">
					
				</div>
				<br/><br/>
			</page>
		</body>
		</html>
 