<?php

declare(strict_types=1);

namespace App\Book\Work;

use App\Book\Alias\AliasSet;
use App\Book\Identifier\IdentifierSet;
use App\Book\Language;
use App\Book\Relationship\RelationshipSet;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Work
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(nullable: true)]
    public ?string $disambiguation;

    #[ORM\ManyToOne(targetEntity: WorkType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id', nullable: true)]
    public ?WorkType $type;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: true)]
    public ?Language $language;

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
