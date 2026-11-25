<?php

declare(strict_types=1);

namespace App\Book\Alias;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AliasSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    /** @var array<Alias> */
    #[ORM\OneToMany(targetEntity: Alias::class, mappedBy: 'set', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public array $aliases;
}
