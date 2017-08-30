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
                                                    lo.ainesosa,
                                                    lo.vahvuus,
                                                    ao.id AS ainesosa_id,
                                                    ao.aine AS ainesosa_aine
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
                'ainesosa'      => $row['ainesosa'],
                'vahvuus'       => $row['vahvuus'],
                'ainesosa_id'   => $row['ainesosa_id'],
                'ainesosa_aine' => $row['ainesosa_aine']
            ));
        }
        return $laakkeenosat;
    }

//ei toimi vielä
    // public static function find_by_trade_name($trade_name) {
    //     $query = DB::connection()->prepare('SELECT * FROM Laakkeenosa 
    //                                         WHERE laake = :trade_name');
        
    //     $query->execute(array(
    //                         'trade_name' => $trade_name));
    //     $row = $query->fetch();
        
    //      foreach($rows as $row) {
    //         $laakkeenosat[] = new Laakkeenosa(array(
    //             'id' => $row['id'],
    //             'laake' => $row['laake'],
    //             'ainesosa' => $row['ainesosa'],
    //             'vahvuus' => $row['vahvuus']
    //         ));
    //     }
    //     return $laakkeenosat;
    // }



    public static function find_by_substance_name($substance) {
        $query = DB::connection()->prepare('SELECT * FROM Laakkeenosa 
                                            WHERE ainesosa = :substance');
        
        $query->execute(array(
                            'substance' => $substance));
        $row = $query->fetch();
        
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