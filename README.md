GradeManager 3.0
=

With this you can manage all your grades of school/university easily via your webbrowser and it has a responsive layout too, so you can access it on the go!

Installation
------------
- Import the sql file in the 'inc' folder into mysql ( with PHPMyAdmin, for example )
- Open the 'config.php' file with your favorite editor and configure the username, password and host of mysql
- In the same file create the list of subjects you have before you start using it ( see the section for how to )
- Go to the url of the folder you placed the files in
- Login with the standard credentials. ( user: admin - password: admin )
- Select a period, subject, enter your grade, the weight of it and then click on Add Grade
- Select a period you want to see your grades of at the bottom, or click on overall to see your overall grades
- At the overall page you can see the structure of the grades has changed a little. 8.4  1-2 means that you have a 8.4 which has a weight of 1 and was given in period 2
- To see the date and time you added the grade hover over it
- To delete a grade click on it and then click on Ok
- If you want to know what your average is for the period you choose see the left bottom section. When you look there at overall you will see the average of the whole year.
- If you want to know what grade you need for a given grade you want to have as an average you can click on the title of a subject and fill in the information. When you click "caclulate" it will give you an answer at the bottom of the page. Sometimes the grade you need is out of range ( 0,1-10 ) then it will say "not possible yet".

Changelog
------------
- Extended feature of periods
- Shows your overall score of each period and a year
- The design changed a lot, and it is nicer believe me ;)
- Simple login system added for security purposes
- Better support for mobile devices ( small devices show some problems )
- New way of organizing grades ( with grids )
- Effects
- More changes! Check it out for yourself ;)

Add/Remove subjects
------------
If you want to add or remove subjects you have to change the items in the array at the config page. Do this at the first time you start using Gradey, otherwise things can go wrong.

For example: You want to add a subject called Aerodynamics. You have to add `$subjectcodes[97] = "Aerodynamics";` at the bottom of the list.

You can also delete a subject by removing it from the list. But don't forget to remove all the grades of it first ( or you can later ).

Note: Because php will order it wrong if you count 9/10/12/13/14 etc. you have to go from 9 to 91. And from 99 to 991 etc. otherwise the order will not be correct. 