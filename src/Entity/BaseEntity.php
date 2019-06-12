<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

trait BaseEntity
{
    public function serialize()
    {
        $allObject = get_object_vars($this);

        foreach ($allObject as $key => $value) {
            if ($value instanceof Collection) {
                $allObject[$key] = [];
                foreach ($value as $v) {
                    $allObject[$key] = $v->getId();
                }
            } else if (is_object($value)) {
                $allObject[$key] = $value->getId();
            }
        }
        return $allObject;
    }
    // Recuperer toutes les clés 
    // Tableau associatif clés valeur
    // JSON encode
}
