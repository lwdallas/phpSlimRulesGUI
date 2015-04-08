# phpSlimRulesGUI
A simple PHP GUI and REST API build on top of the SLIM PHP framework, Composer, and HOA Project Rules lib.

This is not a release. There are going to be changes.

MASSIVE kudos to HOA Rules and Slim. This is just another step down the road for your users.

Load the dependancies, then run composer.phar update. Finally, curl the install step.

Dependancies
------------
PHP5  
sqlite3  
Composer  
Slim  

RUN
===
http-app$ php -S localhost:4000  
rulespoc$ php -S localhost:3000  
(port doesn't matter but front-end expects 3000 for curl ATM)  

REST Examples
=============

Create the SQLite DB (REQUIRED FIRST STEP)
--------------------
curl -X GET http://127.0.0.1:3000/install

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

Delete record
-------------
curl -X DELETE http://127.0.0.1:3000/rule/3

Roadmap
-------
interface enhancements  
ruleset flow control  
salience  
prioritization entropy  
execute route, figure out the JSON parameter structure if any  
reflection  
ability to choose test object  
ability to init class  
Live data example

Please send feedback! Let me know how you use it.
