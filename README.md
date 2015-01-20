# Coderity

[Coderity Website](http://www.coderity.com) - CakePHP CMS

[Coderity Docs](http://www.coderity.com/docs) - Full Documentation

[GitHub](https://www.github.com/coderity/app) - Latest Version

[Report Any Issues](http://www.github.com/coderity/app/issues)

##How to Install

1) Once the source is downloaded, ensure that the app/tmp (and subfolders) are writable.

2) Create a new database and dump the following sql into the DB:
   app/Config/Schema/coderity.sql

3) Copy the app/Config/database.php.default file to app/Config/database.php and set your database details.

4) Open the website in your browser.  You will be taken to the Coderity Installer where you can set your site details and create the Admin user.

##Configuration

In app/Config/bootstrap.php you will find the following block of code, which allows you to turn on / off various features of Coderity.

   Configure::write('Coderity', array(
      'routes' => array(
                  'autoRouting' => true,
                  'autoRoutingIgnoreRoutes' => 'add|view|display|delete|admin|users|leads|blog|domains'
               ),
      'blocks' => true,
      'articles' => true,
      'leads' => true,
      'redirects' => true,
      'additionalAdminMenu' => array()
   ));

To view the full documentation, visit: http://www.coderity.com/docs

# CakePHP

[![Latest Stable Version](https://poser.pugx.org/cakephp/cakephp/v/stable.svg)](https://packagist.org/packages/cakephp/cakephp)
[![License](https://poser.pugx.org/cakephp/cakephp/license.svg)](https://packagist.org/packages/cakephp/cakephp)
[![Bake Status](https://secure.travis-ci.org/cakephp/cakephp.png?branch=master)](http://travis-ci.org/cakephp/cakephp)
[![Code consistency](http://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/grade.svg)](http://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/)

[![CakePHP](http://cakephp.org/img/cake-logo.png)](http://www.cakephp.org)

CakePHP is a rapid development framework for PHP which uses commonly known design patterns like Active Record, Association Data Mapping, Front Controller and MVC.
Our primary goal is to provide a structured framework that enables PHP users at all levels to rapidly develop robust web applications, without any loss to flexibility.


## Some Handy Links

[CakePHP](http://www.cakephp.org) - The rapid development PHP framework

[CookBook](http://book.cakephp.org) - THE CakePHP user documentation; start learning here!

[API](http://api.cakephp.org) - A reference to CakePHP's classes

[Plugins](http://plugins.cakephp.org/) - A repository of extensions to the framework

[The Bakery](http://bakery.cakephp.org) - Tips, tutorials and articles

[Community Center](http://community.cakephp.org) - A source for everything community related

[Training](http://training.cakephp.org) - Join a live session and get skilled with the framework

[CakeFest](http://cakefest.org) - Don't miss our annual CakePHP conference

[Cake Software Foundation](http://cakefoundation.org) - Promoting development related to CakePHP


## Get Support!

[#cakephp](http://webchat.freenode.net/?channels=#cakephp) on irc.freenode.net - Come chat with us, we have cake

[Google Group](https://groups.google.com/group/cake-php) - Community mailing list and forum

[GitHub Issues](https://github.com/cakephp/cakephp/issues) - Got issues? Please tell us!

[Roadmaps](https://github.com/cakephp/cakephp/wiki#roadmaps) - Want to contribute? Get involved!


## Contributing

[CONTRIBUTING.md](CONTRIBUTING.md) - Quick pointers for contributing to the CakePHP project

[CookBook "Contributing" Section (2.x)](http://book.cakephp.org/2.0/en/contributing.html) [(3.0)](http://book.cakephp.org/3.0/en/contributing.html) - Version-specific details about contributing to the project