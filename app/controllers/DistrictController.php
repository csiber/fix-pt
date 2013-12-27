<?php

class DistrictController extends BaseController {

    public function getQuery($query)
    {
        $districts = District::getDistricts();
        $result = array();

        foreach($districts as $district) {
            $pos = strpos(strtolower($district['name']), strtolower($query));
            if($pos !== false) {
                array_push($result, ucfirst(strtolower($district['name'])));
            }
        }

        return Response::json($result);
    }
}