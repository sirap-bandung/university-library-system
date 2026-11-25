<?php

declare(strict_types=1);

namespace App\Book\Author;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AuthorType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column]
    public string $label;
}
