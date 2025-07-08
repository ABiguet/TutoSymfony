<?php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 200)]
    public ?string $nom = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    public ?string $email = null;

    #[Assert\NotBlank]
    public ?string $message = null;

    #[Assert\NotBlank]
    public ?string $service = null;
}