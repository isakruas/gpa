<?php

session_start();

require_once('./assets/php/rest.php');

class API extends REST {

    public $data = "";
    const demo_version = false;


    const DB_SERVER = "";
    const DB_USER = "";
    const DB_PASSWORD = "";
    const DB = "";

    private $db = NULL;
    private $mysqli = NULL;
    public function __construct(){
        parent::__construct();
        $this->dbConnect();
    }

    /* Connect to Database */
    private function dbConnect(){
        $this->mysqli = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB);
        $this->mysqli->query('SET CHARACTER SET utf8');
    }

    /* Dynmically call the method based on the query string */
    public function processApi(){
        $func = strtolower(trim(str_replace("/","",$_REQUEST['x'])));
        if((int)method_exists($this,$func) > 0) {
            $this->$func();
        } else {
            $this->response('API v1.0.0',404); // If the method not exist with in this class "Page not found".
        }
    }
    
    /* Api Checker */
    private function checkResponse(){
        if (mysqli_ping($this->mysqli)){
            echo "Conexão de banco de dados: sucesso";
        }else {
            echo "Conexão de banco de dados: erro";
        }
    }


    public function check_email(){

        $email = $_GET["email"];
        $senha = $_GET["senha"];

        $query="SELECT email FROM usuario WHERE email='".$email."'";
         
        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

        if($r->num_rows > 0) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "http://localhost/gpas/gpg/api.php?x=nova_senha&email=".$email."&senha=".$senha);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $rtn = curl_exec($ch);

            curl_close($ch);



            echo 'true';
        } else {
            echo 'false';
        }
    }

 
    public function nova_senha(){
 
        $email = $_GET['email'];
        $senha = $_GET['senha'];

        $query= "UPDATE usuario SET senha = '".sha1($senha)."'  WHERE `email` = '".$email."'";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }

    public function entrar(){
        if($this->get_request_method() != "GET") $this->response('',406);
 
            $email = $_GET["email"];
            $senha = sha1($_GET["senha"]);
            
            $query="SELECT * FROM usuario WHERE senha='$senha' AND email='$email' LIMIT 1";
            $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
            if($r->num_rows > 0) {
                $result = $r->fetch_assoc();
                $_SESSION['id'] = $result['id'];
                $_SESSION['curso'] = $result['curso'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['senha'] = $result['senha'];
                $this->response('{"return":"true"}',200);
            } else {
                $this->response('{"return":"false"}',200);
            }
    }
 
    public function checar_email() {

        if($this->get_request_method() != "GET") $this->response('',406);
        $email = $_GET["email"];
        $query="SELECT * FROM usuario WHERE email  = '$email'";
        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }
 
    public function nova_conta(){

    
        $email = $_GET["email"];
        $curso = $_GET["curso"];
        $senha = sha1($_GET["senha"]);

        $nome = $_GET["nome"];

        $query = "INSERT INTO `usuario` (`id`, `curso`, `email`, `senha`, `nome`) VALUES (NULL, '$curso', '$email', '$senha', '$nome')";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }
 
    public function buscar_cursos(){
 
        $query="SELECT * FROM `curso` WHERE 1 ";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }


    public function buscar_provas(){
 
        $query="SELECT * FROM `prova` WHERE 1 ";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }



    public function buscar_prova_id(){
 
        $id = $_GET['id'];
        $query="SELECT * FROM `prova` WHERE id  = '$id' LIMIT 1";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }


    public function gerar_prova(){
 
        $curso = $_GET['curso'];
        $prova = $_GET['prova'];
        $query="SELECT * FROM `questao` WHERE curso = '$curso' AND prova = '$prova'";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $numero_das_questoes = array();
            for ($i=0; $i < count($result); $i++) {
                if (!in_array($result[$i]['numero'], $numero_das_questoes)) {
                    array_push($numero_das_questoes, $result[$i]['numero']);
                } 
                
            }

            $id_das_questoes = array();
            for ($i=0; $i < count($numero_das_questoes); $i++) { 
                $id_das_questoes[$i] = array();
                for ($j=0; $j < count($result); $j++) { 
                   if($result[$j]['numero'] == $numero_das_questoes[$i]) {
                        array_push($id_das_questoes[$i], $result[$j]['id']);
                   }
                }
            }


            $lista = array();
            for ($i=0; $i < count($numero_das_questoes); $i++) { 
                $lista[$i] = array(
                    'numero' => $numero_das_questoes[$i],
                    'ids' => $id_das_questoes[$i]
                );
            }

            $rand_keys = array_rand($id_das_questoes, 1);
             //$this->response(count($result), 200);


           $this->response(json_encode($lista, JSON_NUMERIC_CHECK), 200); // send user details
        } else {
            $this->response('{"return":"false"}',200);
        }
    }

    public function buscar_prova_gerada(){

        $usuario = $_SESSION['id'];
        $prova = $_GET['prova'];
        $query="SELECT * FROM `prova_gerada` WHERE usuario  = '$usuario' AND prova='$prova' LIMIT 1"; 

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        } else {
            $this->response('{"return":"false"}',200);
        }
    }

    public function nova_prova_gerada(){

        if (isset($_SESSION['id'])) {


            $usuario = $_SESSION['id'];
            $questao = $_GET['questao'];
            $prova = $_GET['prova'];

            $query = "INSERT INTO `prova_gerada` (`id`, `usuario`, `prova`, `questao`) VALUES (NULL, '$usuario', '$prova', '$questao')";

            if ($this->mysqli->query($query)) {
                $this->response('{"return":"true"}',200);
            } else {
                $this->response('{"return":"false"}',200);
            }
        }

    }



    public function buscar_questao(){
        
        $id = $_GET['id'];

        $query="SELECT * FROM `questao` WHERE id  = '$id' LIMIT 1"; 

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $filtro = array();
            for ($i=0; $i < count($result); $i++) {
               $filtro[] = array(
                    'id' => $result[$i]['id'],
                    'curso' => $result[$i]['curso'],
                    'prova' => $result[$i]['prova'],
                    'numero' => $result[$i]['numero'],
                    'imagem' => $result[$i]['imagem'],
                    'pergunta' => base64_decode($result[$i]['pergunta']),

                );
                
            }



            $this->response(json_encode($filtro, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }



    public function sair(){

        session_destroy();
        $this->response('{"return":"true"}',200);
    }


}

// Initiiate Library
$api = new API;
$api->processApi();

?>
