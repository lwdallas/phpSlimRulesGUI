# phpSlimRulesGUI
A simple PHP GUI and REST API build on top of the SLIM PHP framework, Composer, and HOA Project Rules lib.

This is not a release. There are going to be changes.

MASSIVE kudos to HOA Rules and Slim. This is just another step down the road for your users.

Load the dependancies, then run composer.phar update. Finally, curl the install step.

Screen Shots
------------
Start the web service on port 3000.  
![Starting the API](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/1.png?raw=true)  
Start the web server on port 4000. In production, you would likely use Apache or reverse proxy.   
![Starting the web server in development](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/2.png?raw=true)  
Top level page.  
![First page controls](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/3.png?raw=true)  
Rulesets.  
![Rulesets](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/5.png?raw=true)  
It is a good idea to create a ruleset for your rules, but it isn't required.  
![Creating a new ruleset - not required but recommended](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/4.png?raw=true)
The menu bar.  
![Menu bar](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/6.png?raw=true)  
Create a new rule. Only the rule is required but all fields are recommended. Active should be 1 or 0, 1 represents true.  
![Create a rule, Active = 1 for true](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/7.png?raw=true)  
Test cases are managed under Tests.  
![Click tests to manage test cases](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/8.png?raw=true)  
Click the test button next to a rule to test it.  
![Click the test button next to a rule to test it](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/9.png?raw=true)  
Test result.  
![test result](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/10.png?raw=true)  
You can also test an entire resultset. Currently they run in order.  
![you can also test an entire resultset. Currently they run in order](https://github.com/lwdallas/phpSlimRulesGUI/blob/master/doc/img/11.png?raw=true)  

Dependancies
------------
PHP5  
sqlite3  
Composer  
Slim  

RUN
===
```bash
http-app$ php -S localhost:4000  
rulespec$ php -S localhost:3000  
# (port doesn't matter but front-end expects 3000 for curl ATM)  
```

REST Examples
=============

Create the SQLite DB (REQUIRED FIRST STEP)
--------------------
```bash
curl -X GET http://127.0.0.1:3000/install
```

List
----
```bash
curl -X GET http://127.0.0.1:3000/rule  
curl -X GET http://127.0.0.1:3000/ruleset
```

Update
------
```bash
curl -X PUT -d "ruleset=1" -d "rule_active=0" -d "rule_comment=ignore this one" -d "rule=something = 1 and another < 10 or unfinished idea" http://127.0.0.1:3000/rule/3
```
Insert
------
```bash
curl -X POST -d "ruleset=1" -d "rule_active=0" -d "rule_comment=ignore this one" -d "rule=something = 1 and another < 10 or unfinished idea" http://127.0.0.1:3000/rule
```

Delete record
-------------
```bash
curl -X DELETE http://127.0.0.1:3000/rule/3
```

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
