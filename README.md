# Foxx's Library

# Introduction
## Description
For this project I plain to make a stupid simple book library that a user can check out a book and a admin can add, edit and remove books. Along with checking books back in.

## How do I envision this looking like?
As a by-product from a mental illness I have named [Aphantasia](https://en.wikipedia.org/wiki/Aphantasia) I can not imagine things. As you might guess this made it difficult to make my site look good, so my process instead of imagining it, I just used a WYSIWYG editor to drag stuff around and make it look good. The editor I chose was [Bootstrap Studio](https://bootstrapstudio.io/).

## Goals
### 30S Goals
- [x] Create a simple library program
- [x] Make it easy to use
- [x] Make a good/secure log in system
- [x] Make a page to display all books in the library
- [x] Make a page to show the details of a book
- [x] Make a custom database to store all the books and users
- [x] Make a custom login system that prevents a user from logging in with the wrong password, and prevents the wrong user type from accessing the wrong page (admin to user and vice versa)

### 40S Goals
- [ ] Make it easy to add books to the library (for admins)
- [ ] Make it easy to remove books from the library (for admins)
- [ ] Add a fee system for overdue or lost books.
- [ ] make a page to display all users in the library
- [ ] Make a page to show the details of a user
- [ ] Make a system to generate library cards for users (by admins)
- [ ] Make it easy to add users to the library (for admins)
- [ ] Make the error pages for when a user tries to access a page they are not allowed to access or things alike


# Prospective

## User Prospective
The user will be able to log in to their account and see what books they have checked out, what books they have overdue, and what books they have lost. 
They will also be able to see their fees and pay them. They will also be able to see what books are available in the library. 
They will be able to check out books and return books.

When going to the home page you will be greeted with a list of all books in the library.
To the upper right you will see a button that says "Log In". Clicking this button will take you to the log in page.
In the list of books there is a button on the card that says "Details". Clicking this button will take you to the details page.

On the details page you will see the book's title, author, genre, and description. You will also see a button that says "Check Out". Clicking this button will take you to the check out page. An adition there is a star rating system. You can click on the stars to give the book a rating. This of course means there is a rating for the book. The rating is a number between 1 and 5. The rating is the average of all the ratings. The rating is displayed on the details page.

That login page will have a email and password field. You will enter your email and password and click the "Log In" button.
If you have entered the correct email and password you will be taken to the dashboard. If you have entered the wrong email and password you will be taken to the log in page again.

## Admin Prospective
The admin will be able to retrieve the user's information and see what books they have checked out, what books they have overdue, and what books they have lost. They will also be able to see their fees and pay them. They will also be able to see what books are available in the library. They will be able to check out books and return books. They will also be able to add books to the library and remove books from the library. They will also be able to add users to the library and remove users from the library.

When going to the home page you will be greeted with a list of all books in the library.
To the upper right you will see a button that says "Log In". Clicking this button will take you to the log in page.
In the list of books there is a button on the card that says "Details". Clicking this button will take you to the details page.

On the details page you will see the book's title, author, genre, and description. You will also see a button that says "Check Out". Clicking this button will take you to the check out page. An adition there is a star rating system. You can click on the stars to give the book a rating. This of course means there is a rating for the book. The rating is a number between 1 and 5. The rating is the average of all the ratings. The rating is displayed on the details page.

That login page will have a email and password field. You will enter your email and password and click the "Log In" button.
If you have entered the correct email and password you will be taken to the dashboard. If you have entered the wrong email and password you will be taken to the log in page again.


# Mastery factors
## **Computer Science 20S - Mastery Factors:** To achieve a mastery factor of 1.0, students must have mastered at least 5 of the following 10 aspects:

- [x] Changing/altering object properties
- [x] Creating a complex design using the IDE designer
- [x] Creating and use simple primitives (variables)
- [x] Creating and using variables in a more complex way and converting between different types
- [x] Use of simple selection (if, if/else, if/else if/else)
- [x] Use of complex selection (nested if, if with multiple conditions or else if)
- [x] Use of loops (for, while)
- [x] Use of complex loops (nested loops)
- [x] Use of an advanced design element (e.g. timers, menus multiple forms, etc.)
- [x] Use of any advanced programming concepts beyond the grade 10 course (from the higher grades mastery list, or approved by Mr. Wachs) – this can be used up to 5 times

## **Computer Science 30S - Mastery Factors:** To achieve a mastery factor of 1.0, students must have mastered at least 10 of the following 20 aspects:

- [x] Use of any 5 grade 10 Computer Science master factors (see above) – this can be used up to 2 times
- [x] Use of a programmer defined method
- [x] Use of a programmer defined method that uses parameter(s) (the parameters have to be useful and used within the method body)
- [x] Use of a programmer defined method that returns a value (primitive or object)
- [x] Use of programmer defined methods that incorporate optional prams
- [x] Use of primitive arrays storing data
- [ ] Use of parallel arrays to store data concurrently (and algorithm treat them as parallel)
- [x] Use of a 2 or more dimensional array
- [x] Use of a class with contained properties and/or methods
- [x] Use of a class that incorporates encapsulation into the class design
- [ ] Use of abstract methods/properties within a class so as it can be used without instantiation
- [x] Use of multiple classes that incorporates inheritance into the design
- [ ] Use of a sub-class that over-rides a method from its super class
- [ ] Proper use of polymorphic constructor methods within a class  <!-- make it so constructor can be done diffrent ways -->
- [ ] Use of inheritance to shown polymorphism of various classes of the same type
- [x] Use of graphical imported libraries or utility libraries
- [x] Proper use of event handling code
- [x] Proper separation of user interface from programmatic logic (e.g. MVC model)
- [x] Proper comment documentation style
- [x] Use of any advanced programming concepts beyond the grade 11 course (from the grade 12 mastery list, or approved by Mr.Wachs) – this can be used up to 5 times

## **Computer Science 40S - Mastery Factors:** To achieve a mastery factor of 1.0, students must have mastered at least 10 of the following 30 aspects:

- [ ] Use of any 5 grade 11 Computer Science master factors (see above) – this can be used up to 3 times
- [ ] Use of recursive method
- [ ] Use of recursive method with multiple recursive cases or multiple bases cases
- [ ] Use of the Object class and/or over-ridding methods from it (toString() and equals() methods)
- [ ] Proper use of the protected modifier as it relates to properties and/or methods
- [ ] Use of abstract methods and an abstract class
- [x] Use of the enhanced for loop and/or the instanceof operator
- [x] Proper use of a static method(s) or static properties
- [ ] use of a built-in way to read and write to a file
- [x] Use of the try catch block error trap
- [x] Use of a built-in way to to work with files
- [ ] Use of a built-in way to have the user select a file graphically
- [ ] Use of a linear and/or binary search algorithm
- [ ] Use of a sort algorithm (bubble, selection, quick, shell, insertion)
- [ ] Use of a search and/or sort algorithm recursively
- [ ] Use of a Generic (template) data type or method
- [ ] Use of a programmer defined single LinkedList class with a programmer defined Node class
- [ ] Use of a programmer defined doubly LinkedList with head and tail references
- [ ] Use of methods to insert/delete to the front, back, and middle of a LinkedList
- [ ] Use of Collection libraries LinkedList, ArrayList, or Queue objects
- [ ] Use of a Stack and/or Queue objects (and appropriate methods) inherited from a programmer defined LinkedList class
- [ ] Use of a programmer defined binary Tree class and relevant methods
- [ ] Use of a HastTable class and relevant methods
- [ ] Use of an ADT (list, stack, queue, tree, or table) in combination with Generics
- [ ] Proper implementation of multiple threading in the application
- [ ] Use of an interface class in the application design
- [x] Use of graphical scripts 
- [x] Proper separation of user interface from programmatic logic (e.g. MVC model)
- [ ] Proper comment documentation style (e.g. JavaDoc)
- [ ] Use of any advanced programming concepts beyond the grade 12 course (approved by Mr. Wachs) – this can be used up to 5 times

# Conclusion
## Did I meet my goals?
I met all of the goals I set for myself! I am very happy with the result of this project. I think I did a good job of making a simple library program that is easy to use. I think I did a good job of making a good/secure log in system. I think I did a good job of making a page to display all books in the library. I think I did a good job of making a page to show the details of a book. I think I did a good job of making a custom database to store all the books and users. I think I did a good job of making a custom login system that prevents a user from logging in with the wrong password, and prevents the wrong user type from accessing the wrong page (admin to user and vice versa).

## What did I learn?
- Middleware - I learned what middleware is and how to use it.
- OOP - Because I was asking for help form a friend they suggested I use OOP. I learned how to apply the OOP model to php.
- MVC - I learned what MVC is and how to use it.
- Database - I learned how to make a database out of json.

## What obstacles did I face?
- The major problem I had was with authorization and middleware.

## If I had more time, what would I do?
As I plain to add to this for my 40S project I forced myself to stop at parts so this is moot.

## Is this efficient?
The one thing that technically incorrect is my use of the `503` error and how I implemented it. Using [this](https://github.com/PrincessFoxx/Library/blob/master/src/Middleware/RoutingErrorMiddleware.php#L52-L55) switch statement along with [this](https://github.com/PrincessFoxx/Library/blob/master/src/Middleware/RoutingErrorMiddleware.php#L56-L57) return is incorrect as its not being used as a error so it being in my error catching middleware is not right. I *should* have made it a custom action for it. 

## Is all this code my own?
No, (not counting the imported things) I got help from friends. The main example of this is [this](https://github.com/PrincessFoxx/Library/blob/master/src/Core/Model/User.php#L105-L121) getter and setter. This was made by a discord user named [Command_String#6538](https://github.com/commandstring). 99% of the bug fixing that I couldn't solve was assisted by a user named [Freezemage0
#2203](https://github.com/freezemage0)
