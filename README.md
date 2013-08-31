GradeManager 2.0
=

With this you can manage all your grades of school easily via your webbrowser and since this version even from your mobile phone which makes it a lot easier!

Installation
------------
- Import the sql file in the 'inc' folder into mysql ( with PHPMyAdmin, for example )
- Open the 'index.php' file with your favorite editor and configure the username, password and host of mysql
- Go to the url of the folder you placed the files in
- Select a subject, enter your grade, the weight of it and then click on Add Grade
- You can view and remove all your grades on the same page
- To see the date and time you added the grade hover over it
- To delete a grade click on it and then click on Ok
- If you want to know what grade you should get you can enter your desired grade and the weight of the 
grade you will get and click on calculate to see what grade you need to get. Sometimes a grade is out of range.

Changelog
------------
- Easier to use, because of not noticable refresh when something is done
- Better design
- Mobile support
- No need to scroll everytime you want to add a grade or want to calculate something

For advanced users
------------
If you want to add or remove subjects you have to change the items in the array at the top of the page.

For example: You want to add a subject called Aerodynamics. You have to add `$subjectcodes[15] = "Aerodynamics";` at the bottom of the list.

You can also delete a subject by removing it from the list. But don't forget to remove all the grades of it first.