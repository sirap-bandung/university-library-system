<?php

declare(strict_types=1);

namespace App\Book\Work;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Entity]
class WorkType
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
    public string $label;

    #[ORM\Column]
    public string $description;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'left', type: Types::INTEGER)]
    public int $left;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'right', type: Types::INTEGER)]
    public int $right;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: WorkType::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    public ?int $parent;

    /**
     * @var Collection<int, WorkType>
     */
    #[ORM\OneToMany(targetEntity: WorkType::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['left' => 'ASC'])]
    public Collection $children;
}
