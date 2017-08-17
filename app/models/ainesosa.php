<?php

class Ainesosa extends BaseModel{

    public $id, $aine;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_pituus','validate_numerot');
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Ainesosa');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row){
            $ainesosat[] = new Ainesosa(array(
                'id' => $row['id'],
                'aine' => $row['aine']
            ));
        }

        return $ainesosat;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Ainesosa 
                                            WHERE id = :id 
                                            LIMIT 1');
        $query->execute(array(
                            'id' => $id));
        
        $row = $query->fetch();

        if($row){
            $ainesosa = new Ainesosa(array(
                                        'id' => $row['id'],
                                        'aine' => $row['aine']));
            return $ainesosa;
        }

        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Ainesosa (aine) 
                                            VALUES (:aine) 
                                            RETURNING id');
        $query->execute(array(
                            'aine' => $this->aine));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update($aine){
        $query = DB::connection()->prepare('UPDATE Ainesosa 
                                            SET aine = :aine 
                                            WHERE id = :id 
                                            RETURNING id');
        $query->execute(array(
                            'aine' => $aine,
                            'id' => $this->id));
       
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Ainesosa 
                                            WHERE id = :id');
        $query->execute(array(
                            'id' => $this->id));
    }



    public function validate_pituus() {
        return parent::validate_string_length($this->aine, 5);  
    }

     public function validate_numerot() {
        return parent::validate_string_numerics($this->aine);  
    }


}