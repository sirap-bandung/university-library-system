<?php

declare(strict_types=1);

namespace App\Book\Identifier;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'entity_type', type: 'string')]
#[ORM\DiscriminatorMap([
    'edition' => EditionIdentifierType::class,
    'author' => AuthorIdentifierType::class
])]
#[ORM\UniqueConstraint(columns: ['parent_id', 'child_order'])]
abstract class IdentifierType
{
    public function __construct(?int $id = null) {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    #[ORM\Column]
    public string $label;

    #[ORM\Column]
    public string $description;

    #[ORM\Column]
    public string $detectionRegex;

    #[ORM\Column]
    public string $validationRegex;

    #[ORM\Column]
    public string $partialLink;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'left', type: Types::INTEGER)]
    public int $left;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'right', type: Types::INTEGER)]
    public int $right;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: IdentifierType::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public ?int $parent;

    /**
     * @var array<IdentifierType>
     */
    #[ORM\OneToMany(targetEntity: IdentifierType::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['left' => 'ASC'])]
    public array $children;
}
