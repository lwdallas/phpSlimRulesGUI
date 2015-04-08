<?php
require 'vendor/autoload.php';

// The User object.
class User {

 
    public $group      = 'customer';
    public $points     = 42;
}

$ruler = new Hoa\Ruler\Ruler();

// New rule.
$rule  = 'logged(user) and group in ["customer", "guest"] and points > 30';

// New context.
$context         = new Hoa\Ruler\Context();
$context['user'] = function ( ) use ( $context ) {

    $user              = new User();
    $context['group']  = $user->group;
    $context['points'] = $user->points;

    return $user;
};
print_r( $context );

// We add the logged() operator.
$ruler->getDefaultAsserter()->setOperator('logged', function ( User $user ) {

//    return $user::CONNECTED === $user->getStatus();
    return true;
});

// Finally, we assert the rule.
var_dump(
    $ruler->assert($rule, $context)
);

/**
 * Will output:
 *     bool(true)
 */

?>
