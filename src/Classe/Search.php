<?php

namespace App\Classe;

use App\Entity\Category;

//Création d'un objet search afin de lié notre fomrulaire à notre classe/Search et à la manipuler plus facilement
class Search
{
    /**
     * @var string
     */
    public $string = '';

    /**
     * @var Category[]
     */
    public $categories = [];
}