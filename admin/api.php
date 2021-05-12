<?php

session_start();

require_once('../assets/php/rest.php');

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
 
    public function entrar(){
        if($this->get_request_method() != "GET") $this->response('',406);
 
            $email = $_GET["email"];
            $senha = $_GET["senha"];
            
            $query="SELECT * FROM admin WHERE senha='$senha' AND email='$email' LIMIT 1";
            $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
            if($r->num_rows > 0) {
                $result = $r->fetch_assoc();
                $_SESSION['admin'] = $result['id'];
                $_SESSION['admin_email'] = $result['email'];
                $_SESSION['admin_senha'] = $result['senha'];
                $this->response('{"return":"true"}',200);
            } else {
                $this->response('{"return":"false"}',200);
            }
    }
 
    
    public function buscar_cursos(){
        
        if (!isset($_SESSION['admin'])) $this->response('',401); 

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

    public function buscar_curso_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $query="SELECT * FROM `curso` WHERE id  = '$id' LIMIT 1";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }


    public function buscar_cabecalho_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $query_usuario1 = "SELECT usuario FROM `prova_gerada` WHERE id  = '$id' LIMIT 1";
        $r = $this->mysqli->query($query_usuario1) or die($this->mysqli->error.__LINE__);

        if($r->num_rows > 0){
            $usuario = $r->fetch_assoc();
            $usuario_id = $usuario['usuario']; 

            $query_usuario2 = "SELECT nome FROM `usuario` WHERE id  = '$usuario_id' LIMIT 1";
            $r2 = $this->mysqli->query($query_usuario2) or die($this->mysqli->error.__LINE__);

            if($r2->num_rows > 0){
                $usuario2 = $r2->fetch_assoc();
                $usuario_nome = $usuario2['nome'];
            }

            $query_usuario2 = "SELECT nome FROM `usuario` WHERE id  = '$usuario_id' LIMIT 1";
            $r2 = $this->mysqli->query($query_usuario2) or die($this->mysqli->error.__LINE__);

            if($r2->num_rows > 0){
                $usuario2 = $r2->fetch_assoc();
                $usuario_nome = $usuario2['nome'];
            }
 




            $this->response(json_encode($usuario_nome, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }



    public function buscar_usuario_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $query="SELECT * FROM `usuario` WHERE id  = '$id' LIMIT 1";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }



    public function atualizar_usuario_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $curso = $_GET['curso'];

        $query= "UPDATE `usuario` SET `nome` = '$nome', `email` = '$email',`curso` = '$curso' WHERE `usuario`.`id` = $id;";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }


    public function atualizar_curso_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $nome = $_GET['nome'];

        $query= "UPDATE `curso` SET `nome` = '$nome' WHERE `curso`.`id` = $id;";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }
 



    public function buscar_provas(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
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

    public function buscar_provas_gerada(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $query="SELECT `prova_gerada`.`id`, `prova_gerada`.`usuario`, `prova_gerada`.`prova`, `prova_gerada`.`questao` FROM `prova`, `prova_gerada` WHERE (`prova`.`id`= `prova_gerada`.`prova`) AND (`prova`.`status`=2) ORDER BY `id`  DESC";

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

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
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

    public function atualizar_prova_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $status = $_GET['status'];

        $query= "UPDATE `prova` SET `nome` = '$nome', `status` = '$status' WHERE `prova`.`id` = $id;";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }


    public function adicionar_curso(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
    
        $nome = $_GET["nome"];

        $query = "INSERT INTO `curso` (`id`, `nome`) VALUES (NULL, ' ".$_GET['nome']."')";

        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }



    public function adicionar_prova(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
    
        $nome = $_GET["nome"];
        $curso = $_GET["curso"];
        $status = $_GET["status"];

        $query = "INSERT INTO `prova` (`id`, `nome`, `curso`, `status`) VALUES (NULL, '$nome', '$curso', ' $status')";
 
        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }

    public function adicionar_questao(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
    
        $prova = $_GET["prova"];

        $imagem = strval($_GET["imagem"]);

        $pergunta = base64_encode($_GET["pergunta"]); 
        $curso = $_GET["curso"];
        $numero = $_GET["numero"];

        $query = "INSERT INTO `questao` ( `id`,`curso`,`prova`,`numero`,`imagem`,`pergunta` ) VALUES (NULL, '$curso', '$prova', '$numero', '$imagem', '$pergunta')";
 
        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }



    public function atualizar_questao(){
    
        if (!isset($_SESSION['admin'])) $this->response('',401); 
     
        $prova = $_GET["prova"];

        $imagem = strval($_GET["imagem"]);

        $pergunta = base64_encode($_GET["pergunta"]); 
        $curso = $_GET["curso"];
        $numero = $_GET["numero"];



        $id = $_GET["id"];
 
         $query= "UPDATE `questao` SET `pergunta` = '$pergunta', `curso` = '$curso',`numero` = '$numero',  `prova` = '$prova',  `imagem` = '$imagem'  WHERE `questao`.`id` = $id;";
 
        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
    }




    public function buscar_questoes(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $query="SELECT * FROM `questao` WHERE 1 ";

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

    public function buscar_questao_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
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






    public function excluir_questao_id(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
 
        $id = $_GET['id'];
        $query= "DELETE FROM `questao` WHERE `questao`.`id` = '$id'";


        if ($this->mysqli->query($query)) {
            $this->response('{"return":"true"}',200);
        } else {
            $this->response('{"return":"false"}',200);
        }
 
    }








    public function buscar_usuarios(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 
  
       $query="SELECT `id`, `email`, `nome`, `curso`  FROM  `usuario` WHERE 1";

        $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        if($r->num_rows > 0){
            $result = array();
            while($row = $r->fetch_assoc()){
                $result[] = $row;
            }

            $this->response(json_encode($result, JSON_NUMERIC_CHECK), 200); // send user details
        }
    }




    public function sair(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 

        session_destroy();
        $this->response('{"return":"true"}',200);
    }

    public function upload_imagem(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 


        if (isset($_FILES["imagem"])) {

            $date = date("Y-m-d H:i:s");
            $nome_final_do_arquivo = sha1($date);

            $local_final_do_arquivo  = "../media/";

            $tamanho_maximo_do_arquivo = 47185920; //45mb
            $tipo_de_arquivo_permitido = array(
                'jpg',
                'jpeg',
                'JPG',
                'JPEG'
            ); 

            $tamanho_do_arquivo = $_FILES['imagem']['size'];

            if ($tamanho_do_arquivo > $tamanho_maximo_do_arquivo) {
                $this->response('{"return":"false"}',200);
                //arquivo muito grande
            } else {

                $detalhes_do_arquivo = pathinfo($_FILES['imagem']['name']);
                $tipo_de_arquivo = $detalhes_do_arquivo['extension'];

                if (in_array($tipo_de_arquivo, $tipo_de_arquivo_permitido) === false) {
                    $this->response('{"return":"false"}',200);
                    //tipo de arquivo não permmitido
                } else {

                  if (file_exists($local_final_do_arquivo . "/" . $nome_final_do_arquivo . "." . $tipo_de_arquivo)){
                    $this->response('{"return":"false"}',200);
                    //o arquivo já existe no servidor
                  } else {

                    $nome_inicial_do_arquivo = $_FILES['imagem']['name'];
                    $local_temporario_do_arquivo = $_FILES['imagem']['tmp_name'];

                    $i = explode(".", $nome_inicial_do_arquivo);
                    $tipo_de_arquivo = $i[count($i) - 1];

                    if (move_uploaded_file($local_temporario_do_arquivo, $local_final_do_arquivo . "/" . $nome_final_do_arquivo . "." . $tipo_de_arquivo)) {
                        $this->response('{"return":"'.$nome_final_do_arquivo.'"}',200);
                        //arquivo salvo no  servidor

                    } else {
                        $this->response('{"return":"false"}',200);
                        //não foi possivel salvar o arquivo
                    }
                  }
                }
            }
        }
    }





    public function buscar_prova_gerada(){

        if (!isset($_SESSION['admin'])) $this->response('',401); 

        $prova = $_GET['prova'];
        $query="SELECT * FROM `prova_gerada` WHERE id='$prova' LIMIT 1"; 

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



}

// Initiiate Library
$api = new API;
$api->processApi();

?>
