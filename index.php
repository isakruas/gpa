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
    </head>
    <body>
      <div class="header">
      </div>
      <div class="nav">
        <!-- block nav -->
 
        <!-- endblock nav -->
      </div>
      <div class="main">
        <div class="main-l">
            <div class="main-i" id="info">
              
            </div>
            <div class="main-m">
            <!-- block main -->
            <script type="text/javascript">
              document.getElementById('info').innerHTML = '<h2>INÍCIO</h2>';
            </script>
            <div class="main-three-row">
              <div class="main-three-row-one">
                <div class="main-three-columns">
                  <div class="main-three-columns-one">
                  </div>
                  <div class="main-three-columns-two">
                  </div>
                  <div class="main-three-columns-three">
                  </div>
                </div>
              </div>
              <div class="main-three-row-two">
                <div class="main-three-columns">
                  <div class="main-three-columns-one" style="padding-bottom:1cm">
                    <center>
                      <a href="criar_conta/" rel="noopener">

                      &nbsp;&nbsp;&nbsp;<svg style="width: 64px"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor"  d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>

             
                      <br /><br />
                        <h4 style="text-align: center;" >Criar conta</h4>
                      </a>
                    </center>
                  </div>
                  <div class="main-three-columns-two" style="padding-bottom:1cm">
                    <center>
                      <a href="entrar/" rel="noopener">
                      <svg style="width: 64px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><path fill="currentColor" d="M 416 448 L 332 448 C 325.398438 448 320 442.601562 320 436 L 320 396 C 320 389.398438 325.398438 384 332 384 L 416 384 C 433.699219 384 448 369.699219 448 352 L 448 160 C 448 142.300781 433.699219 128 416 128 L 332 128 C 325.398438 128 320 122.601562 320 116 L 320 76 C 320 69.398438 325.398438 64 332 64 L 416 64 C 469 64 512 107 512 160 L 512 352 C 512 405 469 448 416 448 Z M 369 247 L 201 79 C 186 64 160 74.5 160 96 L 160 192 L 24 192 C 10.699219 192 0 202.699219 0 216 L 0 312 C 0 325.300781 10.699219 336 24 336 L 160 336 L 160 432 C 160 453.5 186 464 201 449 L 369 281 C 378.300781 271.601562 378.300781 256.398438 369 247 Z M 369 247 "/></svg>
                      <br /><br />

                        <h4 style="text-align: center;">Entrar</h4>
                      </a>
                    </center>
                  </div>
                  <div class="main-three-columns-three"  >
                    <center>
                      <a href="redefinicao_de_senha.php" rel="noopener">
                      <svg style="width: 64px"xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path  fill="currentColor"  d="M184.561 261.903c3.232 13.997-12.123 24.635-24.068 17.168l-40.736-25.455-50.867 81.402C55.606 356.273 70.96 384 96.012 384H148c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12H96.115c-75.334 0-121.302-83.048-81.408-146.88l50.822-81.388-40.725-25.448c-12.081-7.547-8.966-25.961 4.879-29.158l110.237-25.45c8.611-1.988 17.201 3.381 19.189 11.99l25.452 110.237zm98.561-182.915l41.289 66.076-40.74 25.457c-12.051 7.528-9 25.953 4.879 29.158l110.237 25.45c8.672 1.999 17.215-3.438 19.189-11.99l25.45-110.237c3.197-13.844-11.99-24.719-24.068-17.168l-40.687 25.424-41.263-66.082c-37.521-60.033-125.209-60.171-162.816 0l-17.963 28.766c-3.51 5.62-1.8 13.021 3.82 16.533l33.919 21.195c5.62 3.512 13.024 1.803 16.536-3.817l17.961-28.743c12.712-20.341 41.973-19.676 54.257-.022zM497.288 301.12l-27.515-44.065c-3.511-5.623-10.916-7.334-16.538-3.821l-33.861 21.159c-5.62 3.512-7.33 10.915-3.818 16.536l27.564 44.112c13.257 21.211-2.057 48.96-27.136 48.96H320V336.02c0-14.213-17.242-21.383-27.313-11.313l-80 79.981c-6.249 6.248-6.249 16.379 0 22.627l80 79.989C302.689 517.308 320 510.3 320 495.989V448h95.88c75.274 0 121.335-82.997 81.408-146.88z"/></svg>
             
                      <br /><br />
                        <h4 style="text-align: center;">Redefinição de senha</h4>
                      </a>
                    </center>
                  </div>
                </div>
              </div>
              <div class="main-three-row-three">
                <div class="main-three-columns">
                  <div class="main-three-columns-one">
                  </div>
                  <div class="main-three-columns-two">
                  </div>
                  <div class="main-three-columns-three">
                  </div>
                </div>
              </div>
            </div>
            <!-- endblock main -->
            </div>
        </div>
      </div>
 

    </body>
    </html>
