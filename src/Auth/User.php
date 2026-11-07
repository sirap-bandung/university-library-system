<?php

declare(strict_types=1);

namespace App\Auth;

use DateTime;
use Doctrine\DBAL\Schema\DefaultExpression\CurrentTimestamp;
use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface as TwoFactorTotpInterface;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Scheb\TwoFactorBundle\Model\Totp\TwoFactorInterface as TwoFactorEmailInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorEmailInterface, TwoFactorTotpInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public readonly int $id;

    #[ORM\Column(unique: true)]
    public string $username;

    #[ORM\Column(length: 254, unique: true)]
    public string $email;

    #[ORM\Column]
    public bool $emailVerified = false;

    #[ORM\Column(length: 255)]
    public string $password;

    #[ORM\Column]
    public array $roles = [];

    #[ORM\Column(nullable: true)]
    public ?string $totpSecret;

    #[ORM\Column(nullable: true)]
    public ?string $authCode;

    #[ORM\Column(insertable: false, updatable: false, options: ['default' => new CurrentTimestamp()])]
    public readonly DateTime $createdAt;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function isEmailAuthEnabled(): bool
    {
        return $this->email && $this->emailVerified;
    }
    public function isTotpAuthenticationEnabled(): bool
    {
        return (bool)$this->totpSecret;
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }

    public function getEmailAuthCode(): ?string
    {
        return $this->authCode;
    }

    public function setEmailAuthCode(string $authCode): void
    {
        $this->authCode = $authCode;
    }

    public function getTotpAuthenticationUsername(): ?string
    {
        return $this->username;
    }

    public function getTotpAuthenticationConfiguration(): ?TotpConfigurationInterface
    {
        $period = 30;
        $digits = 6;
        return $this->isTotpAuthenticationEnabled()
            ? new TotpConfiguration($this->totpSecret, TotpConfiguration::ALGORITHM_SHA1, $period, $digits)
            : null;
    }
}
