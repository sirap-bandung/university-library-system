<?php

declare(strict_types=1);

namespace App\Book\Identifier;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AuthorIdentifierType extends IdentifierType
{
}
