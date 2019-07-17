<?php

//Classe responsável de monitorar uma classe
class UsuarioObserver
{
    public function update(Usuario $new)
    {
        echo date("H:i") . " ALERTA: Usuário alterado: " . $new->getName();
        echo "<hr>";
    }
}

class Usuario
{
    private $userOld;
    private $name;
    private $observers = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attach(UsuarioObserver $obs)
    {
        $this->observers[] = $obs;
    }

    public function detach(UsuarioObserver $obs)
    {
        foreach ($this->observers as $key => $o) {
            if ($o == $obs) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $o) {
            $o->update($this);
        }
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->notify();
    }
}