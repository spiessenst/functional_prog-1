<?php

class HtmlElements
{

  public function PrintHead()
    {
        $head = file_get_contents("templates/head.html");
        print $head;
    }

    public function PrintJumbo( $title = "", $subtitle = "" )
    {
        $jumbo = file_get_contents("templates/jumbo.html");

        $jumbo = str_replace( "@jumbo_title@", $title, $jumbo );
        $jumbo = str_replace( "@jumbo_subtitle@", $subtitle, $jumbo );

        print $jumbo;
    }

    public function PrintNavbar( )
    {

        $navbar = file_get_contents("templates/navbar.html");
        $navbar =  str_replace( "@logname@", $_SESSION['user']->getFullName(), $navbar );

        print $navbar;
    }


}