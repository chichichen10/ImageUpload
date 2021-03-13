link to the website: https://csci4140-assign1-1155100383.herokuapp.com/index.php

UserID/pw: Alice/csci4140

* index.php : Users can view public images uploaded by all users and their own private image, and also upload image if user is logged in.
* loginpage.php: Allow user to login.
* login.php: The system will check the input by user and return error message if there exists or login success message then redirect to index page.
* upload.php: The systen will upload the file into Postgresql provided by Heroku, the direct to editor page.
* logout.php: Perform logout and redirect to index.
* editor.php: Allow users to apply filters or discard the images. Also the function of removing filter is implemented.
* captcha.php: Generate a 4 digit validation image for login.
* view.php: After clicking on the image from index, users will be direct to the page which show the original size of the image.
* initializepage.php: If the admin log in, he/she will be directed to the page to see if he/she wants to perform system initialization.
* initialize.php: Initialize the system and redirect to index.

Since the orginal post limit in Heroku's php.ini file is only 2MB, in order to allow user to upload a larger file, a file name .user.ini is made and it can allow user to uplaod file no larger than 50MB, which is an acceptable size since there is 1GB data allowance in the database. 
