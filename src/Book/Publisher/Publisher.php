<?php

declare(strict_types=1);

namespace App\Book\Publisher;

use App\Book\Alias\AliasSet;
use App\Book\Edition\Edition;
use App\Book\Identifier\IdentifierSet;
use App\Book\Relationship\RelationshipSet;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Publisher
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(nullable: true)]
    public ?string $disambiguation;

    #[ORM\OneToOne(targetEntity: AliasSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'alias_set_id', referencedColumnName: 'id')]
    public AliasSet $aliasSet;

    #[ORM\OneToOne(targetEntity: IdentifierSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'identifier_set_id', referencedColumnName: 'id', nullable: true)]
    public ?IdentifierSet $identifierSet;

    #[ORM\OneToOne(targetEntity: RelationshipSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'relationship_set_id', referencedColumnName: 'id', nullable: true)]
    public ?RelationshipSet $relationshipSet;

    /** @var array<Edition> */
    #[ORM\ManyToMany(targetEntity: Edition::class, mappedBy: 'publishers')]
    public array $editions;
}
