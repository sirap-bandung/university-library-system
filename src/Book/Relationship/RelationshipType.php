<?php

declare(strict_types=1);

namespace App\Book\Relationship;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'entity_type', type: 'string')]
#[ORM\DiscriminatorMap([
    'work_author' => SeriesAuthorRelationshipType::class,
    'work_series' => WorkEditionRelationshipType::class,
    'work_edition' => WorkEditionRelationshipType::class,
    'series_author' => SeriesAuthorRelationshipType::class
])]
#[ORM\UniqueConstraint(columns: ['parent_id', 'child_order'])]
abstract class RelationshipType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column]
    public string $label;

    #[ORM\Column]
    public string $description;

    #[ORM\Column]
    public string $linkPhrase;

    #[ORM\Column]
    public string $reverseLinkPhrase;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'left', type: Types::INTEGER)]
    public int $left;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'right', type: Types::INTEGER)]
    public int $right;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: RelationshipType::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    public ?int $parent;

    #[ORM\OneToMany(targetEntity: RelationshipType::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['left' => 'ASC'])]
    public array $children;
}
