<?php

declare(strict_types=1);

namespace App\Book\Series;

use App\Book\Alias\AliasSet;
use App\Book\Identifier\IdentifierSet;
use App\Book\Relationship\RelationshipSet;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Series
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    #[ORM\OneToOne(targetEntity: AliasSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'alias_set_id', referencedColumnName: 'id')]
    public AliasSet $aliasSet;

    #[ORM\OneToOne(targetEntity: IdentifierSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'identifier_set_id', referencedColumnName: 'id', nullable: true)]
    public ?IdentifierSet $identifierSet;

    #[ORM\OneToOne(targetEntity: RelationshipSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'relationship_set_id', referencedColumnName: 'id', nullable: true)]
    public ?RelationshipSet $relationshipSet;
}
