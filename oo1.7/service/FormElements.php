<?php

class FormElements
{

   public function MakeSelect( $fkey, City $value,  $data )

    {
        $val = $value->getLand();

        $select = "<select id=$fkey name=$fkey value=$val>";
        $select .= "<option value='0'></option>";

        foreach ($data as $country){
            if ( $country->getId() == $val ) $selected = " selected ";

            else $selected = "";

            $select .= "<option $selected value=" . $country->getId() . ">" . $country->getName() . "</option>";

        }

        $select .= "</select>";

        return $select;
    }


}