<?php

declare(strict_types=1);

namespace App\Book\Work;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Entity]
class WorkType
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

    public int $parentId;

    public int $childOrder;
}
