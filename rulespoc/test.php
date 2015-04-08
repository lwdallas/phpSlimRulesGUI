<?php
require 'vendor/autoload.php';

$ruler = new Hoa\Ruler\Ruler();

// 1. Write a rule.
$rule  = 'group in ["customer", "guest"] and points > 30';

// 2. Create a context.
$context           = new Hoa\Ruler\Context();
$context['group']  = 'customer';
$context['points'] = function ( ) {

    return 42;
};

// 3. Assert!
var_dump(
    $ruler->assert($rule, $context)
);

/**
 * Will output:
 *     bool(true)
 */
?>
