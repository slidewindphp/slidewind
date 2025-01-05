<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\DocumentProperties;

final class Properties extends Element
{
    public function render()
    {
        $properties = new DocumentProperties;

        // TODO: custom property

        foreach ($this->children as $property) {
            match ($property->name) {
                'creator' => $properties->setCreator($property->value),
                'last-modified-by' => $properties->setLastModifiedBy($property->value),
                'title' => $properties->setTitle($property->value),
                'description' => $properties->setDescription($property->value),
                'subject' => $properties->setSubject($property->value),
                'keywords' => $properties->setKeywords($property->value),
                'category' => $properties->setCategory($property->value),
                'company' => $properties->setCompany($property->value),
                'status' => $properties->setStatus($property->value),
                'created' => $properties->setCreated((new \DateTime($property->value))->getTimestamp()),
                'modified' => $properties->setModified((new \DateTime($property->value))->getTimestamp()),
                'revision' => $properties->setRevision($property->value),
                default => null
            };
        }

        return $properties;
    }
}
