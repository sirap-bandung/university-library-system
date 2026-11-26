<?php

declare(strict_types=1);

namespace App\Book\Identifier;

use Doctrine\Common\Collections\Collection;
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

    /** @var Collection<int, Identifier> */
    #[ORM\OneToMany(targetEntity: Identifier::class, mappedBy: 'set', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public Collection $identifiers;
}
