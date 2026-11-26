<?php

declare(strict_types=1);

namespace App\Book\Edition;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EditionFormat
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
}
