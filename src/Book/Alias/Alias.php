<?php

declare(strict_types=1);

namespace App\Book\Alias;

use App\Book\Language;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Alias
{
    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly ?int $id;

    #[ORM\Column]
    public string $name;

    #[ORM\ManyToMany(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: true)]
    public ?Language $language;

    #[ORM\ManyToOne(targetEntity: AliasSet::class, inversedBy: 'aliases')]
    #[ORM\JoinColumn(name: 'set_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public AliasSet $set;

    #[ORM\Column]
    public bool $isPrimary = false;
}
