<?php
namespace ResaBike\Library\Mvc;

class Model{
    /*public function delete($table, $field, $id){
        $query = 'DELETE FROM ';
    }*/

    public function save($table, $array, $id = null, $idKey = 'id') {
        if($id == null)
        {
            //insert
            $keys = array();
            $values = array();

            foreach($array as $key => $value)
            {
                $keys[] = $key;
                $values[] = $value;
            }
            /*
            $result = Dbs::insert($table)
                ->fieldArray($keys)
                ->valueArray($values)
                ->run();
            */
            return $result;
        }
        else
        {
            //update
            $keys = array();
            $values = array();

            foreach($array as $key => $value)
            {
                $keys[] = $key;
                $values[] = $value;
            }
            /*
            $result = Dbs::update($table)
                ->fieldArray($keys)
                ->valueArray($values)
                ->where($idKey, '=', Dbs::prepareInt($id))
                ->run();
                */
            return $result;
        }
    }
}