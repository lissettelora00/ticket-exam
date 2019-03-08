# ticket-exam
 The purpose of this repository is the creation of a ticket system as part of the recruitment processes at Net Tech International.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.



Important

The default URL format uses a query parameter named "r" to represent the route and normal query parameters to represent the query parameters associated with the route. For example, the URL /index.php?r=user/view&id=1 represents the route user/view and the id query parameter 1. 

In order to run the application you need to run ticketdb.sql script, this has to be done manually before you can access it.


You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~

