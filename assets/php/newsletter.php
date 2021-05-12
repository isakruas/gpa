<?php
/**
 * Astrofotografia Brasil
 * ======================
 *
 * Astrofotografia Brasil  é uma  plataforma para  divulgação de  astrofotografias  feitas  por 
 * profissionais e/ou amadores no território brasileiro, nesta perspectiva, objetiva incentivar
 * a  participação  da  comunidade  brasileira em observações e registros de corpos  celestes e 
 * fenômenos astronômicos.
 *
 * @author      Isak Ruas <isakruas@gmail.com>
 *
 * @license    	Esta plataforma é disponibilizada sobre a Licença Pública Geral (GNU) V3.0
 *              Mais detalhes em: https://github.com/isakruas/astrofotografiabrasil/blob/master/LICENSE
 *
 * @link        Homepage:     http://astrofotografia.nrolabs.com/
 *              GitHub Repo:  https://github.com/isakruas/astrofotografiabrasil/
 *              README:       https://github.com/isakruas/astrofotografiabrasil/blob/master/README.md
 *
 * @version     1.0.00
 */
 
 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 

class Newsletter extends Util {

    private $db = NULL;
    private $mysqli = NULL;

    public function __construct(){
        parent::__construct();
        $this->dbConnect();
    }

    private function dbConnect(){
        $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB);
        $this->mysqli->query('SET CHARACTER SET utf8');
    }

    private function check_newsletter_usuario_uid ($uid) {
		$query_check_newsletter="SELECT unewsletter FROM usuario WHERE uid=".$uid;
		$r_check_newsletter = $this->mysqli->query($query_check_newsletter);
	 
		if($r_check_newsletter->num_rows > 0) {
			$check_newsletter = $r_check_newsletter->fetch_assoc();
			return $check_newsletter['unewsletter'];
		} else {
			return false;
		} 

    }

    #Recebemos sua captura! Em breve analisaremos se está de acordo com nossa política editorial, caso tudo certo, será encaminhada para os avaliadores. Você poderá acompanhar o progresso deste processo em seu painel.

    public function recebemos_sua_captura ($uid, $uemail) {
		if ($this->check_newsletter_usuario_uid($uid)) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				$mail->addAddress($uemail);
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Recebemos sua captura!';
				$mail->Body = 'Recebemos sua captura! Em breve analisaremos se está de acordo com nossa política editorial, caso tudo certo, será encaminhada para os avaliadores. Você poderá acompanhar o progresso deste processo em seu painel.';
				$mail->AltBody = 'Recebemos sua captura! Em breve analisaremos se está de acordo com nossa política editorial, caso tudo certo, será encaminhada para os avaliadores. Você poderá acompanhar o progresso deste processo em seu painel.';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}

		}
    }
    #Capturas encaminhadas aos avaliadores para processo de análise
    public function captura_encaminhada_aos_avaliadores($uid, $uemail) {
		if ($this->check_newsletter_usuario_uid($uid)) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				$mail->addAddress($uemail);
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Capturas encaminhadas aos avaliadores!';
				$mail->Body = 'Algumas de suas capturas foram encaminhadas aos avaliadores para processo de análise.';
				$mail->AltBody = 'Algumas de suas capturas foram encaminhadas aos avaliadores para processo de análise.';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}

		}
    }
	#Capturas já analisadas pelos avaliadores, aguardando a publicação do editor.
    public function captura_ja_analisadas_pelos_avaliadores ($uid, $uemail) {
		if ($this->check_newsletter_usuario_uid($uid)) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				$mail->addAddress($uemail);
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Captura ja analisada pelos avaliadores!';
				$mail->Body = 'Algumas de suas capturas já foram analisadas pelos avaliadores e estão aguardando a publicação do editor.';
				$mail->AltBody = 'Algumas de suas capturas já foram analisadas pelos avaliadores e estão aguardando a publicação do editor.';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}

		}
    }

    #Capturas não publicadas por não terem atingido a média de 6 pontos.
    public function capturas_nao_publicadas_por_media ($uid, $uemail) {
		if ($this->check_newsletter_usuario_uid($uid)) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				$mail->addAddress($uemail);
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Capturas nao publicada :( ';
				$mail->Body = 'Algumas de suas capturas não foram publicadas por não terem atingido a média de 6 pontos :( ! .. Não desanime, subeta uma nova captura para ser publicada em nosso portal, lhe aguardamos, abs!';
				$mail->AltBody = 'Algumas de suas capturas não foram publicadas por não terem atingido a média de 6 pontos :( ! .. Não desanime, subeta uma nova captura para ser publicada em nosso portal, lhe aguardamos, abs!';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}

		}
    }
    #Capturas publicadas.
    public function capturas_publicada ($uid, $uemail) {
		if ($this->check_newsletter_usuario_uid($uid)) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				$mail->addAddress($uemail);
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Captura publicada!';
				$mail->Body = 'Algumas de suas capturas foram publicadas  em nossa plataforma! Parabéns!';
				$mail->AltBody = 'Algumas de suas capturas foram publicadas  em nossa plataforma! Parabéns!';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}

		}
    }

	public function all_newsletter_usuario (){
		$query_captura="SELECT uemail FROM usuario WHERE unewsletter=1";
		$r_captura = $this->mysqli->query($query_captura);
	 
		if($r_captura->num_rows > 0) {
			while($row = $r_captura->fetch_assoc()){
				$result[] = $row;
			}
			return $result;
		} else {
			return false;
		} 
	}


    #Capturas publicadas.
    public function new_captura () {

		$all_newsletter = $this->all_newsletter_usuario();

		if ($all_newsletter > 0) {
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
				for ($i=0; $i < count($all_newsletter); $i++) {
					$mail->addAddress($all_newsletter[$i]['uemail']);
				}
				$mail->isHTML(true);
				$mail->Subject = 'Astrofotografia Brasil - Newsletter - Novo Post!';
				$mail->Body = 'Olá, tudo bem? <br /> Estamos passando para lhe avisar que acabamos de publicar mais um belo registro em nossa plataforma, não deixe de conferir :) ..';
				$mail->AltBody = 'Olá, tudo bem? Estamos passando para lhe avisar que acabamos de publicar mais um belo registro em nossa plataforma, não deixe de conferir :) ..';
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}
		}
    }



    public function new_acc ($code, $email) {
    		$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->Host = 'nrolabs.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'astrofotografia@nrolabs.com';
				$mail->Password = '9j0{,kN0tF0@';
				$mail->Port = 465; // or 587
			 	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->setFrom('astrofotografia@nrolabs.com');
			 
				 $mail->addAddress($email);
 
				$mail->isHTML(true);
				$mail->Subject = ' Astrofotografia Brasil - Código de verificação';
				$mail->Body = "<html><head><title>Astrofotografia Brasil</title><style type='text/css'>* {margin: 0px;padding: 0px;}body {color: #a0a0a1;font-family: 'Source Sans Pro', Helvetica, sans-serif;font-size: 15pt; font-weight: 300; letter-spacing: 0.025em;line-height: 1.65;background: #242629; text-align: center; -webkit-overflow-scrolling: touch; overflow-x: auto; }table { margin: 0 0 2em 0; width: 100%; } table tbody tr { border: solid 1px rgba(210, 215, 217, 0.75); border-left: 0; border-right: 0; } table tbody tr:nth-child(2n + 1) { background-color: rgba(230, 235, 237, 0.25); } table td { padding: 0.75em 0.75em; } table th { color: #3d4449; font-size: 0.9em; font-weight: 600; padding: 0 0.75em 0.75em 0.75em; text-align: left; } table thead { border-bottom: solid 2px rgba(210, 215, 217, 0.75); } table tfoot { border-top: solid 2px rgba(210, 215, 217, 0.75); } table.alt { border-collapse: separate; } table.alt tbody tr td { border: solid 1px rgba(210, 215, 217, 0.75); border-left-width: 0; border-top-width: 0; } table.alt tbody tr td:first-child { border-left-width: 1px; } table.alt tbody tr:first-child td { border-top-width: 1px; } table.alt thead { border-bottom: 0; } table.alt tfoot { border-top: 0; }.box { border-radius: 0.375em; border: solid 1px rgba(210, 215, 217, 0.75); margin-bottom: 2em; padding: 1.5em; } .box > :last-child, .box > :last-child > :last-child, .box > :last-child > :last-child > :last-child { margin-bottom: 0; } .box.alt { border: 0; border-radius: 0; padding: 0; }</style></head><body><br><div class='box' style='text-align: justify; width: 30vw ;position:fixed; left:50%; margin-left:-15vw; top:50%; margin-top:-64px;'><p>Olá, este é seu código de verificação para prosseguir no processo de cadastro na plataforma <strong>Astrofotografia Brasil</strong>. Caso não tenha solicitado este código, basta ignorá esta mensagem.</p></div><table><thead><tr><th></th><th></th><th></th></tr></thead><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td style='height:128px; text-align: center; font-size: 20pt'>".$code."</td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody><tfoot><tr><td colspan='3'></td></tr></tfoot></table> <p style='position:fixed; left:50%; width:10cm; margin-left:-5cm; font-size:10pt; bottom:1cm;'>© 2020 Astrofotografia Brasil.</p> </body></html>";



				$mail->AltBody = $code."    ----- Olá, este é seu código de verificação para prosseguir no processo de cadastro na plataforma Astrofotografia Brasil. Caso não tenha solicitado este código, basta ignorá esta mensagem.";
				if($mail->send()) {
					#echo 'Email enviado com sucesso';
					return true;
				} else {
					#echo 'Email nao enviado';
					return false;
				}
			} catch (Exception $e) {
				#echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
				return false;
			}
    }


}