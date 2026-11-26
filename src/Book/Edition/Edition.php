<?php

declare(strict_types=1);

namespace App\Book\Edition;

use App\Book\Alias\AliasSet;
use App\Book\Identifier\IdentifierSet;
use App\Book\Publisher\Publisher;
use App\Book\Relationship\RelationshipSet;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Edition
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

    #[ORM\Column(nullable: true)]
    public ?string $disambiguation;

    #[ORM\Column(nullable: true)]
    public ?DateTime $releaseDate;

    #[ORM\ManyToOne(targetEntity: Publisher::class)]
    #[ORM\JoinColumn(name: 'publisher_id', referencedColumnName: 'id', nullable: true)]
    public ?Publisher $publisher;

    #[ORM\Embedded(class: Dimensions::class)]
    public ?Dimensions $dimensions;

    #[ORM\Column(nullable: true)]
    public ?int $weight;  // in grams

    #[ORM\Column(nullable: true)]
    public ?int $pages;

    #[ORM\ManyToOne(targetEntity: Edition::class)]
    #[ORM\JoinColumn(name: 'format_id', referencedColumnName: 'id', nullable: true)]
    public ?EditionFormat $format;

    #[ORM\ManyToOne(targetEntity: EditionStatus::class)]
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id', nullable: true)]
    public ?EditionStatus $status;

    #[ORM\OneToOne(targetEntity: AliasSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'alias_set_id', referencedColumnName: 'id')]
    public AliasSet $aliasSet;

    #[ORM\OneToOne(targetEntity: IdentifierSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'identifier_set_id', referencedColumnName: 'id', nullable: true)]
    public ?IdentifierSet $identifierSet;

    #[ORM\OneToOne(targetEntity: RelationshipSet::class, orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'relationship_set_id', referencedColumnName: 'id', nullable: true)]
    public ?RelationshipSet $relationshipSet;

    /** @var Collection<int, Publisher> */
    #[ORM\ManyToMany(targetEntity: Publisher::class, inversedBy: 'editions')]
    #[ORM\JoinTable(name: "edition_publishers")]
    #[ORM\JoinColumn(name: "edition_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "publisher_id", referencedColumnName: "id")]
    public Collection $publishers;
}
