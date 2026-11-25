<?php

declare(strict_types=1);

namespace App\Book\Edition;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Dimensions
{
    #[ORM\Column]
    public int $width;

    #[ORM\Column]
    public int $height;

    #[ORM\Column]
    public int $depth;
}
