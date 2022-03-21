<?php

class Template {

    private $template;


    public function __construct($template)
    {

            $this->template = $template;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return file_get_contents($this->template);
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }




}
