<?php

namespace App\Service;


class EntityService
{
    public function UpdateEntityByJson(&$entity, array $json)
    {
        foreach ($json as $property => $value) {
            $method = 'set' . ucfirst($property);
            if (method_exists($entity, $method)) {
                $entity->$method($value);
            };
        }
        return $entity;
    }
}
    // Itérer json
    // Vérifier la clé et bien une methode avec un set
    // Si elle existe mettre a jour sinon non
    // retourner l'entité modifier
