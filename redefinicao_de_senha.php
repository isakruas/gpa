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
          <div class="nav-three-row">
          <div class="nav-three-row-one">

          </div>
          <div class="nav-three-row-two">
            <svg onclick = "location.href='index.php'"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
  document.getElementById('info').innerHTML = '<h2>REDEFINIÇÃO DE SENHA</h2>';
</script>
 
<script type="text/javascript">

  function set(el, va){
    document.getElementById(el).value = va;
  }

</script>


<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './assets/php/PHPMailer/Exception.php';
require './assets/php/PHPMailer/PHPMailer.php';
require './assets/php/PHPMailer/SMTP.php';



$nup = date('siHmdHis') . (substr(round(microtime(true) * 100), (strlen(round(microtime(true) * 100)) - 2), strlen(round(microtime(true) * 100))));

function s1()
{
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randstring = '';
    for ($i = 0; $i < 27; $i++) {
        $randstring = $characters[rand(0, (strlen($characters) - 1))];
    }
    return $randstring;
    unset($randstring);
}

function s2()
{
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randstring = '';
    for ($i = 0; $i < 27; $i++) {
        $randstring = $characters[rand(0, (strlen($characters) - 1))];
    }
    return $randstring;
    unset($randstring);
}


if (isset($_POST['email'])) {


  $nova_senha = $nup . s1() . s2();

   $email = $_POST['email'];

if (!empty($email)) {
 

  $ch = curl_init();
 
  #curl_setopt($ch, CURLOPT_URL, "http://gpas.nrolabs.com/gpg/api.php?x=buscar_provas");
  #curl_setopt($ch, CURLOPT_URL, "http://nrolabs1.hospedagemdesites.ws/gpas/gpg/api.php?x=check_email&email=".$email."&senha=".$nova_senha);

  curl_setopt($ch, CURLOPT_URL, "http://localhost/gpas/gpg/api.php?x=check_email&email=".$email."&senha=".$nova_senha);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $rtn = curl_exec($ch);

  curl_close($ch);


  if ($rtn == 'true') {


    echo "A nova senha foi enviada por email:  ". $nova_senha;
 
      $mail = new PHPMailer();
      try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'nrolabs1.hospedagemdesites.ws';
        $mail->SMTPAuth = true;
        $mail->Username = 'mail@nrolabs1.hospedagemdesites.ws';
        $mail->Password = 'Lz2apUD5qfJyL@';
        $mail->Port = 465; // or 587
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->setFrom('gpas@nrolabs.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Nova senha  - GPAS';
        $mail->Body = 'Se você está recebendo este email é porque solicitou uma nova senha no GPAS, sua nova senha é: '. $nova_senha;
        $mail->AltBody = 'Se você está recebendo este email é porque solicitou uma nova senha no GPAS, sua nova senha é: '. $nova_senha;
        if($mail->send()) {
          #echo 'Email enviado com sucesso';
          
        } else {
          #echo 'Email nao enviado';
          
        }
      } catch (Exception $e) {
        #echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
         
      }

  } else {

    echo "Email invalido";
  }
 
               
  }

}


?>






      <div class="main-auto-row-auto">
          <p class="forms"  style="margin-bottom: 0cm;">Email</p>

          <form method="post" class="forms" >
            <input class="a b" type="email" id="email" name="email">
            <button class="a b" type="submit">Redefinir</button>
          </form> 
      </div>
 

        <script type="text/javascript">
          var errorlist = document.getElementsByClassName("errorlist");
          if (errorlist[0]) {
            document.getElementById("email").style.border = "0.05cm solid red";
          }
        </script>
            <!-- endblock main -->
            </div>
        </div>
      </div>
 

    </body>
    </html>
