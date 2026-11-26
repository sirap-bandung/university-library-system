<?php

declare(strict_types=1);

namespace App\Book\Relationship;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class RelationshipSet
{
    public function __construct(?int $id = null) {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    /** @var array<Relationship> */
    #[ORM\OneToMany(targetEntity: Relationship::class, mappedBy: 'sourceSet', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public array $sourceRelationships;


    /** @var array<Relationship> */
    #[ORM\OneToMany(targetEntity: Relationship::class, mappedBy: 'targetSet', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public array $targetRelationships;
}
