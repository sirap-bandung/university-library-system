<?php

declare(strict_types=1);

namespace App\Book\Identifier;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\UniqueConstraint(columns: ['type_id', 'value'])]
class Identifier
{
    public function __construct(?int $id = null) {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    #[ORM\ManyToOne(targetEntity: IdentifierType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id')]
    public IdentifierType $type;

    #[ORM\ManyToOne(targetEntity: IdentifierSet::class, inversedBy: 'identifiers')]
    #[ORM\JoinColumn(name: 'set_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public IdentifierSet $set;

    #[ORM\Column]
    public string $value;
}
