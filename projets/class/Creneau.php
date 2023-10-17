<?php

class Creneau {

    public $debut;

    public $fin;

    //  on crée une méthode à l'intérieur de notre class elle est utilisé à chaque fois que l'on fait une instensation new Creneau
    public function __construct(int $debut, int $fin)
    {
        // pour récupérer l'instance courrente on fait un $this
        // on récupère la propriété debut
        // et je veux que tu définisses le paramètre debut et tu utilise le paramètre que tu as reçu au niveau de cette function
        $this->debut = $debut;
        $this->fin = $fin;

    }
    
}