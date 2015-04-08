RUN
===
http-app$ php -S localhost:8000
rulespoc$ php -S localhost:3000
(port doesn't matter but front-end expects 3000 for curl ATM)

REST Examples
=============

List
----
curl -X GET http://127.0.0.1:3000/rule
curl -X GET http://127.0.0.1:3000/ruleset

Update
------
curl -X PUT -d "ruleset=1" -d "rule_active=0" -d "rule_comment=ignore this one" -d "rule=something = 1 and another < 10 or unfinished idea" http://127.0.0.1:3000/rule/3

Insert
------
curl -X POST -d "ruleset=1" -d "rule_active=0" -d "rule_comment=ignore this one" -d "rule=something = 1 and another < 10 or unfinished idea" http://127.0.0.1:3000/rule

Create the SQLite DB
--------------------
http://127.0.0.1:3000/install

Delete record
-------------
curl -X DELETE http://127.0.0.1:3000/rule/3

Dependancies
------------
PHP5
sqlite3
Composer
Slim


TODO
====
interface enhancements
ruleset flow control
salience
prioritization entropy
execute route, figure out the JSON parameter structure if any 
reflection
ability to choose test object
ability to init class
