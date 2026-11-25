<?php

declare(strict_types=1);

namespace App\Book\Relationship;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\ManyToOne(targetEntity: RelationshipType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id')]
    public RelationshipType $type;

    #[ORM\ManyToOne(targetEntity: RelationshipSet::class, inversedBy: 'source_relationships')]
    #[ORM\JoinColumn(name: 'source_set_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public RelationshipSet $sourceSet;

    #[ORM\ManyToOne(targetEntity: RelationshipSet::class, inversedBy: 'target_relationships')]
    #[ORM\JoinColumn(name: 'target_set_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public RelationshipSet $targetSet;

    #[ORM\Column]
    public int $relationshipOrder = 0;
}
