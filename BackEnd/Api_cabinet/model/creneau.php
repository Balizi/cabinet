<?php


class Rendezvous
{
    private $con;
    public $id;
    public $dayy;
    public $ref;
    public $id_time;
    public $val;

    public function __construct($db)
    {
        $this->con=$db;
    }

    public function afficher()
    {
        $req="SELECT * FROM creneau WHERE ref LIKE ?";
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $this->ref);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt;
    }

    public function All()
    {
        $req="SELECT * FROM times";
        $stmt=$this->con->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CheckDate($day)
    {
        $req="SELECT id_time FROM creneau WHERE dayy =?";
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $day);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Search()
    {
        $req="SELECT * FROM `times` WHERE id_time NOT LIKE ?";
        $stmt=$this->con->prepare($req);
        $stmt->bindParam(1, $this->id_time);
        $stmt->execute();
        return $stmt;
    }

    public function Delete()
    {
        $query='DELETE FROM creneau WHERE id=?';
        $stmt=$this->con->prepare($query);
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()) return true;

        return false;
    }

}


?>