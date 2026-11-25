<?php

declare(strict_types=1);

namespace App\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @template-extends AbstractType<?>
 */
class UserRegistrationFormType extends AbstractType
{
    // https://cheatsheetseries.owasp.org/cheatsheets/Email_Validation_and_Verification_Cheat_Sheet.html
    #[Assert\NotBlank]
    #[Assert\Email]
    public readonly string $email;

    // https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html#implement-proper-password-strength-controls
    // - Minimum length 8 for MFA, and 15 for no MFA.
    // - Maximum length at least 64.
    // - Allow usage of all characters.
    // - No requirement for upper or lower case or numbers or special characters.
    // - No periodic password changes.
    #[Assert\NotBlank]
    #[Assert\Length(min: 15, max: 128)]
    public readonly string $password;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    }
}
