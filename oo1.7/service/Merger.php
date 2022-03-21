<?php

class Merger
{


    public function MergeViewWithObjectData( $template, $data )
    {
        $output  = "";

        foreach ( $data as $immo )
        {
            $output .= $template;
            $output =  str_replace( "@path@", $immo->getFotos()[0]->getPath() ,  $output );
            $output  = str_replace( "@immo_title@", $immo->getTitle() , $output );
            $output  = str_replace( "@immo_prijs@", $immo->getPrijs() , $output );
            $output  = str_replace( "@immo_id@", $immo->getid() , $output );


        }

        return $output;
    }




  public function MergeViewWithData( $template, $data )
    {
        $returnvalue = "";



        foreach ( $data as $row )
        {
            $output = $template;

            foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
            {
                $output = str_replace( "@$field@", $row["$field"], $output );
            }

            $returnvalue .= $output;
        }

        if ( $data == [] )
        {
            $returnvalue = $template;
        }


        return $returnvalue;
    }




    public function MergeViewWithExtraElements( $template, $elements )
    {
        foreach ( $elements as $key => $element )
        {
            $template = str_replace( "@$key@", $element, $template );
        }
        return $template;
    }

    public function MergeViewWithErrors( $template, $errors )
    {
        if ( $errors  )
        {
            foreach ( $errors as $key => $error )
            {

                $template = str_replace( "@$key" . "_error@", "<p style='color:red'>$error</p>", $template );

            }
        }

        return $template;
    }

    public function RemoveEmptyErrorTags( $template, $data )
    {
        foreach ( $data as $row )
        {
            foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
            {
                //  $template = str_replace( "@$field" . "_error@", "", $template );
                $template = str_replace( "@$field" . "_error@", "", $template );
            }
        }

        return $template;
    }




}