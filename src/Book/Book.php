<?php

declare(strict_types=1);

namespace App\Book;

use App\Book\Edition\Edition;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class Book
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(nullable: true)]
    public ?string $comment;

    #[ORM\ManyToOne(targetEntity: Edition::class)]
    #[ORM\JoinColumn(name: 'edition_id', referencedColumnName: 'id')]
    public Edition $edition;

    #[ORM\ManyToOne(targetEntity: BookCondition::class)]
    #[ORM\JoinColumn(name: 'condition_id', referencedColumnName: 'id')]
    public BookCondition $condition;

    #[ORM\Column(nullable: true)]
    public ?string $shelfLocation;

    // TODO: join borrow id
//    #[ORM\OneToOne(targetEntity: Borrow::class)]
//    #[ORM\JoinColumn(name: 'current_borrow_id', referencedColumnName: 'id')]
//    public ?Borrow $currentBorrow;
}
