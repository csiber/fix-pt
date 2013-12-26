<?php

class ConcelhoController extends BaseController {

    public function getQuery($query, $district=Null)
    {
        $concelhos = Concelho::getAll();
        $result = array();

        foreach($concelhos as $concelho) {
            if($district != Null) {
                if(strtolower($district) == strtolower($concelho->district->name)) {
                    $pos = strpos(strtolower($concelho['name']), strtolower($query));
                    if($pos !== false) {
                        array_push($result, ucfirst(strtolower($concelho['name'])));
                    }
                }
            } else {
                $pos = strpos(strtolower($concelho['name']), strtolower($query));
                if($pos !== false) {
                    array_push($result, ucfirst(strtolower($concelho['name'])));
                }
            }
        }

        return Response::json($result);
    }
}