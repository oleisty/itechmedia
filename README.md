Itechmedia Task
==================

Task description
--------
"Please put together a small web app using PHP that uses the Twitter API to get a list of the users’
latest tweets and compiles them in to a little widget for a website."

Stack
----------------------------
- Zend Framework 3
- Twitter Bootstrap 3
- jQuery 3.1

Features
----------------------------
- The site uses free sport template as a mock-up.
- The widget is on the right side od page.
- It displays 3 latest tweets of a certain Twitter user.
- The default user is set as 'UkSportsTvGuide'
- You can chage the user any time by filling user's name (named as screen_name by Twitter)
- The form has sufficient validation.
- The newly chosen user is remembered by site (located in Local Storage).

"The meat"
----------------------------
As what's there worth to watch :)

- SOLID principles
- Design patterns (Factory, Builder, Dependency Injection...)
- Object hydration
- JavaScript OOP
- Functional programmig
- Unit tests

If the solution makes an impression of not lightweight enough or not own enough then please tell me.
I wanted to show more of an enterprise scale approach. So if You want me to do something differently to show my skills then please tell me.

Installation and running the application
----------------------------------------

### Using PHP and Composer from your local machine

You need to have PHP 7.0 and Composer installed on your local machine.

1. Clone your forked repository (master branch) locally.
2. CD to project root and run `composer install`.
3. Set-up PHP built-in server by running the following command: `php -S localhost:8000 -t public`.
4. Application will be accessible by the following address: `http://localhost:8000/`.
5. Unit tests can be executed by running the following command: `vendor/bin/phpunit module/Application/test/`.