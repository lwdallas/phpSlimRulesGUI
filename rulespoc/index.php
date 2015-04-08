<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->contentType('application/json');
$db = new PDO('sqlite:db.sqlite3');

function getTitleFromUrl($url)
{
    preg_match('/<title>(.+)<\/title>/', file_get_contents($url), $matches);
    return mb_convert_encoding($matches[1], 'UTF-8', 'UTF-8');
}

function returnResult($action, $success = true, $id = 0)
{
    echo json_encode([
        'action' => $action,
        'success' => $success,
        'id' => intval($id),
    ]);
}

$app->get('/rule', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM rule;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});

$app->get('/rule/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM rule WHERE id = ? LIMIT 1;');
    $sth->execute([intval($id)]);
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS)[0]);
});

$app->post('/rule', function () use ($db, $app) {
    $rule = $app->request()->post('rule');
    $ruleset = intval($app->request()->post('ruleset'));
    $rule_comment = $app->request()->post('rule_comment');
    $rule_active = ($app->request()->post('rule_active') == true);
    $sth = $db->prepare('INSERT INTO rule (rule, ruleset, rule_active, rule_comment) VALUES (?, ?, ?, ?);');
    $sth->execute([
        $app->request()->post('rule'),
        $app->request()->post('ruleset'),
        intval($app->request()->post('rule_active') == true),
        $app->request()->post('rule_comment')
    ]);

    returnResult('add', $sth->rowCount() == 1, $db->lastInsertId());
});

$app->put('/rule/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('UPDATE rule SET rule = ?, ruleset = ?, rule_active = ?, rule_comment = ? WHERE id = ?;');
    $sth->execute([
        $app->request()->post('rule'),
        $app->request()->post('ruleset'),
        intval($app->request()->post('rule_active') == true),
        $app->request()->post('rule_comment'),
        intval($id),
    ]);

    returnResult('edit', $sth->rowCount() == 1, $id);
});

$app->delete('/rule/:id', function ($id) use ($db) {
    $sth = $db->prepare('DELETE FROM rule WHERE id = ?;');
    $sth->execute([intval($id)]);

    returnResult('delete', $sth->rowCount() == 1, $id);
});

$app->get('/install', function () use ($db) {
    $db->exec('  CREATE TABLE IF NOT EXISTS rule (
                    id INTEGER PRIMARY KEY, 
                    ruleset INTEGER, 
                    rule TEXT, 
                    rule_active TEXT,
                    rule_comment TEXT);');

    $db->exec('  CREATE TABLE IF NOT EXISTS ruleset (
                    ruleset_id INTEGER PRIMARY KEY, 
                    ruleset TEXT, 
                    ruleset_active TEXT,
                    ruleset_comment TEXT);');

    returnResult('install');
});

/* rule set functions */

$app->get('/ruleset', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM ruleset;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});

$app->get('/ruleset/:ruleset_id', function ($ruleset_id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM ruleset WHERE ruleset_id = ? LIMIT 1;');
    $sth->execute([intval($ruleset_id)]);
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS)[0]);
});

$app->post('/ruleset', function () use ($db, $app) {
    $ruleset = $app->request()->post('ruleset');
    $ruleset_comment = $app->request()->post('ruleset_comment');
    $ruleset_active = ($app->request()->post('ruleset_active') == true);
    $sth = $db->prepare('INSERT INTO ruleset (ruleset, ruleset_active, ruleset_comment) VALUES (?, ?, ?);');
    $sth->execute([
        $app->request()->post('ruleset'),
        intval($app->request()->post('ruleset_active') == true),
        $app->request()->post('ruleset_comment')
    ]);

    returnResult('add', $sth->rowCount() == 1, $db->lastInsertId());
});

$app->put('/ruleset/:ruleset_id', function ($ruleset_id) use ($db, $app) {
    $sth = $db->prepare('UPDATE ruleset SET ruleset = ?, ruleset_active = ?, ruleset_comment = ? WHERE ruleset_id = ?;');
    $sth->execute([
        $app->request()->post('ruleset'),
        intval($app->request()->post('ruleset_active') == true),
        $app->request()->post('ruleset_comment'),
        intval($ruleset_id),
    ]);

    returnResult('edit', $sth->rowCount() == 1, $id);
});

$app->delete('/ruleset/:ruleset_id', function ($ruleset_id) use ($db) {
    $sth = $db->prepare('DELETE FROM ruleset WHERE ruleset_id = ?;');
    $sth->execute([intval($ruleset_id)]);

    returnResult('delete', $sth->rowCount() == 1, $id);
});

/* for a quick test */

$app->get('/hello/:name', function ($name) {
	echo "Hello, $name";
});

/* run a test */

$app->get('/rule/test/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM rule WHERE id = ? LIMIT 1;');
    $sth->execute([intval($id)]);
    $result = ($sth->fetchAll(PDO::FETCH_CLASS)[0]);
    $rule = $result->rule;
    require_once('ClassMetricsTest.php');

    returnResult( $rule, $ruler->assert($rule, $context), $id);

});


/* run a test on an entire ruleset */

$app->get('/ruleset/test/:ruleset_id', function ($ruleset_id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM rule WHERE rule_active = 1 and ruleset = ? ;');
    $sth->execute([intval($ruleset_id)]);
    $results = ($sth->fetchAll(PDO::FETCH_CLASS));

    $rc=true;

    foreach( $results as $result ){
        $rule = $result->rule;
        require_once('ClassMetricsTest.php');
        $rc = ($ruler->assert($rule, $context) && $rc);
    }

    returnResult( "ruleset test", $rc, $ruleset_id);

});

$app->run();
?>
