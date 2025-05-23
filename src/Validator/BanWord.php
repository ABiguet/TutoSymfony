<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class BanWord extends Constraint
{
    public function __construct(
        public string $message = 'This value "{{ banWord }}" is not allowed.',
        /** @var string[] $banWords */
        public array $banWords = ['spam', 'viagra'],
        ?array $groups = null,
        mixed $payload = null

    ) {
        parent::__construct(null, $groups, $payload);
    }
}
