<?php

function display_recipe(array $recipe) : string
{
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }
    
    return $recipe_content;
}

function display_author(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function get_recipes(array $recipes, int $limit) : array
{
    $valid_recipes = [];
    $counter = 0;

    foreach($recipes as $recipe) {
        if ($counter == $limit) {
            return $valid_recipes;
        }

        $valid_recipes[] = $recipe;
        $counter++;
    }

    return $valid_recipes;
}

function dump($variables){
   echo '<pre>';
    var_dump($variables);
    echo '</pre>';
}

function creneaux_html(array $creneaux){
    if(empty($creneaux)){
        return 'Fermé';
    };

    $phrases = [];

    foreach($creneaux as $creneau){
        $phrases[] = "de <strong> {$creneau[0]}H</strong> à <strong>{$creneau[1]}H</strong>";
    }
    return 'Ouvert ' . implode(' et ', $phrases);
    // objectif construire le tableau intermédiaire
    // implode pour construire la phrase final
};

function in_creneaux (int $heure, array $creneaux): bool 
{
    foreach($creneaux as $creneau){
        $debut = $creneau[0];
        $fin = $creneau[1];
        if($heure >= $debut && $heure < $fin){
            return true;
        }
    } 
    return false;  
};