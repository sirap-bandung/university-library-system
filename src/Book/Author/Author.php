<?php

declare(strict_types=1);

namespace App\Book\Author;

use App\Book\Alias\AliasSet;
use App\Book\Identifier\IdentifierSet;
use App\Book\Relationship\RelationshipSet;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Author
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

    #[ORM\Column]
    public ?string $description;

    #[ORM\Column(nullable: true)]
    public ?string $disambiguation;

    #[ORM\ManyToOne(targetEntity: AuthorType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id', nullable: true)]
    public ?AuthorType $type;

    #[ORM\ManyToOne(targetEntity: Gender::class)]
    #[ORM\JoinColumn(name: 'gender', referencedColumnName: 'id', nullable: true)]
    public ?Gender $gender;

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
