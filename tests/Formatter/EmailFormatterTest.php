<?php

use Deller\DataNormalizer\Formatters\Email;

covers(Email::class);

it('formats an email by trimming whitespace and converting to lowercase', function () {
    $formatter = new Email;

    $formattedEmail = $formatter->format('  EXAMPLE@DOMAIN.COM  ');

    expect($formattedEmail)->toBe('example@domain.com');
});
