<?php 
 class Users{
     private $db;
     private $idMaster = 1;
    public function __construct($db){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['user'])){
            $_SESSION['user']=array();
        }
        $this->db=$db;
    }
    function onDelete($item, $table){
        $req = $this->db->prepare("DELETE FROM $table WHERE id = $item");
        try {
            $req->execute();
            return array("status" => 200, "message" => "successfuly deleted !");
        } catch (\Throwable $th) {
            return array("status" => 500, "message" => "erreur serveur");
        }
    }
    // --------------------------- Fonction login ---------- 
    function onSignin($_email, $_motpasse, $table){
        $req = $this->db->prepare("SELECT * FROM $table WHERE _email = ? AND _motpasse = ? LIMIT 1");
        try {
            $req->execute([$_email, $_motpasse]);
            $req = $req->fetchAll();
            if(!empty($req)){
                $this->login($req[0]);
                // var_dump($req);
                return array("status" => 200, "message" => $req);
            }else return array("status"=> 405, "message" => "uknown user"); 
        } catch (\Throwable $th) {
           return array("status" => 500, "message" => "erreur serveur");
        }
    }
    public function login($id_user){
            
                // $select = $this->db->prepare("SELECT * FROM users WHERE id=:id");
                // $select->execute(array('id'=>$id_user));
                // $result =$select->fetch(PDO::FETCH_OBJ);
            if (is_array($id_user)) {
                $result = $id_user;
                // var_dump($result);
                $_SESSION['user']['user_id'] = $result['_id'];
                $_SESSION['user']['user_nom'] = $result['_nom'];
                $_SESSION['user']['user_email'] = $result['_email'];
                $_SESSION['user']['user_password'] = $result['_motpasse'];
                $_SESSION['user']['niveau'] = $result['_idrole'];
                $_SESSION['user']['security'] = true;
            }

    }
    //------------------------fin fonction-------------------------------

    public function logout()
    {
        session_destroy();
    }
    //----------------------Recuperation images des utilisateurs------------------
    public function _onRetrieveSingleLineById($id, $table){
        $clause = "WHERE fk = $id";
        $req = $this->db->prepare("SELECT * FROM $table $clause");
        try {
            $req->execute();
            $req = $req->fetchAll();
            if(!empty($req)){
                if(count($req) > 0){
                    return array("status" => 200, "message" => "ok", "content" => $req);
                }else return array("status" => 405, "message" => "no record");
            }else return array("status" => 405, "message" => "no record");
        } catch (PDOException $e) {
           return array("status" => 555, "message" => "erreur serveur", "content" => $e);
        }
    }
    public function onRetrieveSingleLineById($role, $id, $table){
        $clause = (int) $role === $this->idMaster ? "" : "WHERE id = $id";
        $req = $this->db->prepare("SELECT * FROM $table $clause");
        try {
            $req->execute();
            $req = $req->fetchAll();
            if(!empty($req)){
                if(count($req) > 0){
                    return array("status" => 200, "message" => "ok", "content" => $req);
                }else return array("status" => 405, "message" => "no record");
            }else return array("status" => 405, "message" => "no record");
        } catch (PDOException $e) {
           return array("status" => 555, "message" => "erreur serveur", "content" => $e);
        }
    }
}
// ---------------------------Fin Recuperation----------------------------------------------
//----------------------------Function count Users-----------------------------------
function comptUsers($db){
    $re = $db->prepare('SELECT COUNT(*) FROM _admin');
    $re->execute();
    $re = $re->fetchColumn();
    return (int)$re;
}
//-----------------------Fin Function----------------------------------------------------

function comptcour($db){
    $re = $db->prepare('SELECT COUNT(*) FROM cour');
    $re->execute();
    $re = $re->fetchColumn();
    return (int)$re;
}
function comptfomateur($db){
    $re = $db->prepare('SELECT COUNT(*) FROM fomateur');
    $re->execute();
    $re = $re->fetchColumn();
    return (int)$re;
}
//----------------------------Fin Function count Salles-----------------------------------

function onRetrieveEvent($db, $idsession, $userrole){
    try {  
         $tabOption = [];
    $re = ($userrole === 2) ? $db->prepare('SELECT * FROM _evenement') : $db->prepare('SELECT * FROM _evenement WHERE _idusers = ?');
    $re->execute([$idsession]);
    $re = $re->fetchAll();
    if(empty($re)) return array();
    for($i = 0; $i < count($re); $i++){
       array_push($tabOption, array(($re[$i]['_id'])=>($re[$i]['_nom']))); 
    }
    return $tabOption;
    
} catch(Exception $e) {
    exit('Probleme du fonction onRetrieveEvent');
}  
}



function  GetTitle()
{
    $re = $db->prepare('SELECT * FROM _opportunites');
    return $_titre; 
}
// function comptEvenemnt($db, $idsession, $userrole){
//     $re = ($userrole === 2) ? $db->prepare('SELECT COUNT(*) FROM _evenement') : $db->prepare('SELECT COUNT(*) FROM _evenement WHERE _idusers = ?');
//     $re->execute([$idsession]);
//     $re = $re->fetchColumn();
//     return (int)$re;
// }


function compt_Opp($db){
    $re = $db->prepare('SELECT COUNT(*) FROM _opportunites');
    $re->execute();
    $re = $re->fetchColumn();
    return (int)$re;
}
function compt_Oeuvre($db){
    $re = $db->prepare('SELECT COUNT(*) FROM _file');
    $re->execute();
    $re = $re->fetchColumn();
    return (int)$re;
}


function count_formation($db){
    $re=$db->prepare('SELECT COUNT(*) from _formation');
    $re->execute();
    $re=$re->fetchColumn();
    return(int)$re;
}


function compt_client($db){
    $re=$db->prepare('SELECT COUNT(*) from _client');
    $re->execute();
    $re=$re->fetchColumn();
    return(int)$re;
}
function comptelcoaching($db){
    $re=$db->prepare('SELECT COUNT(*) from _coaching');
    $re->execute();
    $re=$re->fetchColumn();
    return(int)$re;
}
function comptVisitor($db){
    $re = $db->prepare('SELECT _idUser FROM _visitor GROUP BY _idUser');
    $re->execute();
    $re = $re->fetchAll();
    return (int)(count($re));
}
function _addVisitedPage($cokkie,$page,$db){
    $re = $db->prepare('INSERT INTO _visitor (_idUser, _page) VALUES (?,?)');
    $re->execute([$cokkie,$page]);
}

function mt_random_float($min, $max) {
    $float_part = mt_rand(0, mt_getrandmax())/mt_getrandmax();
    $integer_part = mt_rand($min, $max - 1);
    return $integer_part + $float_part;
}
function comptcomentaire($db,$id){
    $re = $db->prepare('SELECT COUNT(*) FROM _evenement WHERE _idusers=:id');
    $re->execute(array(
        'id'=>$id
    ));
    $re = $re->fetchColumn();
    return (int)$re;
}

if (isset($_POST['logout'])) {
    Users::logout();
    header('Location:index.php');
}

function isAuthenticated()
{
    return (isset($_SESSION['user']) && $_SESSION['user'])
        || (isset($_SESSION['uservisiteur']) && $_SESSION['uservisiteur']);
}

if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false && !isAuthenticated()) {
    if (strpos($_SERVER['REQUEST_URI'], 'login') === false) {
        header('Location: login.php');
    }
}
?>



