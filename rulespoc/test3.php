<?php
require 'vendor/autoload.php';

$ruler = new Hoa\Ruler\Ruler();

// New rule.
$rule  = 'logged(user) and group in ["customer", "guest"] and points > 30';
$database->save(
    serialize(
        Hoa\Ruler\Ruler::interpret(
            $rule
        )
    )
);

?>
