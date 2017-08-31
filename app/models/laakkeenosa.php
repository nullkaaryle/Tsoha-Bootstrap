<?php

class Laakkeenosa extends BaseModel {

    public $id, $laake, $ainesosa, $vahvuus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }


    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Laakkeenosa');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row) {
            $laakkeenosat[] = new Laakkeenosa(array(
                'id' => $row['id'],
                'laake' => $row['laake'],
                'ainesosa' => $row['ainesosa'],
                'vahvuus' => $row['vahvuus']
            ));
        }
        return $laakkeenosat;
    }


    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Laakkeenosa 
                                            WHERE id = :id 
                                            LIMIT 1');
        $query->execute(array(
                            'id' => $id));
        $row = $query->fetch();
        
        if ($row){
            $laakkeenosa = new Laakkeenosa(array(
                                        'id' => $row['id'],
                                        'laake' => $row['laake'],
                                        'ainesosa' => $row['ainesosa'],
                                        'vahvuus' => $row['vahvuus']
                                        ));

            return $laakkeenosa;
        }

        return null;
    }


    public static function find_by_product_id($product_id) {

        $query = DB::connection()->prepare('SELECT  lo.id,
                                                    lo.laake,
                                                    ao.aine AS ainesosa_aine,
                                                    lo.vahvuus
                                            FROM Laakkeenosa lo
                                            INNER JOIN Ainesosa ao ON lo.ainesosa = ao.id
                                            WHERE lo.laake = :product_id');
        
        $query->execute(array(
                            'product_id' => $product_id));
        
        $rows = $query->fetchAll();
        $laakkeenosat = array();

        foreach($rows as $row) {
            $laakkeenosat[] = new Laakkeenosa(array(
                'id'            => $row['id'],
                'laake'         => $row['laake'],
                'ainesosa'      => $row['ainesosa_aine'],
                'vahvuus'       => $row['vahvuus']
            ));
        }
        return $laakkeenosat;
    }


    public static function find_by_substance_id($substance_id) {
        $query = DB::connection()->prepare('SELECT * 
                                            FROM Laakkeenosa 
                                            WHERE ainesosa = :substance_id');
        
        $query->execute(array(
                            'substance_id' => $substance_id));
        $rows = $query->fetchAll();
        $laakkeenosat = array();
        
        foreach($rows as $row) {
            $laakkeenosat[] = new Laakkeenosa(array(
                'id' => $row['id'],
                'laake' => $row['laake'],
                'ainesosa' => $row['ainesosa'],
                'vahvuus' => $row['vahvuus']
            ));
        }
        return $laakkeenosat;
    }

}