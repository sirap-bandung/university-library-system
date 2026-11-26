<?php

declare(strict_types=1);

namespace App\Book\Identifier;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class IdentifierSet
{
    public function __construct(?int $id = null) {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    /** @var array<Identifier> */
    #[ORM\OneToMany(targetEntity: Identifier::class, mappedBy: 'set', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public array $identifiers;
}
