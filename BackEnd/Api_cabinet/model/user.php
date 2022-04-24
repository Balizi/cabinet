<?php


class User{

    private $con;
    public $ref;
    public $nom;
    public $prenom;
    public $datenaissance;
    public $dayy;
    public $id;


    public function __construct($db)
    {
        $this->con=$db;
    }

    public function getAll()
    {
        // $req='SELECT * FROM creneau WHERE ref=?';
        $req='SELECT * FROM creneau c inner join times t on c.id_time=t.id_time WHERE ref=?';
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $this->ref);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function edit()
    {
        // $req='SELECT * FROM creneau c INNER JOIN times t on c.id_time=t.id_time WHERE ref =? and c.id=?';
        $req='SELECT * FROM creneau c INNER JOIN times t on c.id_time=t.id_time where id=?';
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $this->id);
        // $stmt->bindParam(2, $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add()
    {
        $req='INSERT INTO creneau(dayy,ref,id_time) VALUES(:dayy,:ref,:id_time)';
        $stmt=$this->con->prepare($req);

        // $this->dayy=htmlspecialchars(strip_tags($this->dayy));
        // $this->ordeer=htmlspecialchars(strip_tags($this->ordeer));
        // $this->ref=htmlspecialchars(strip_tags($this->ref));


        $stmt->bindParam(':dayy',$this->dayy);
        $stmt->bindParam(':ref',$this->ref);
        $stmt->bindParam(':id_time',$this->id_time);

        if($stmt->execute())
        {
            return true;
        }
        return false;
    }
    public function signUp()
    {
        $req="INSERT INTO user(ref,nom,prenom,datenaissance) VALUES(:ref,:nom,:prenom,:datenaissance)";
        $stmt=$this->con->prepare($req);

        $stmt->bindParam('ref',$this->ref);
        $stmt->bindParam('nom',$this->nom);
        $stmt->bindParam('prenom',$this->prenom);
        $stmt->bindParam('datenaissance',$this->datenaissance);

        if($stmt->execute())
        {
            return true;
        }
        return false;
    }


    public function Search()
    {
        $req="SELECT * FROM `times` WHERE id_time NOT LIKE ?";
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $this->id_time);
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function login()
    {
        $req="SELECT * FROM user WHERE ref=?";
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1,$this->ref);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt;
    }


}