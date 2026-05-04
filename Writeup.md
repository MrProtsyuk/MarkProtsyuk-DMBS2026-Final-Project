# Write up for project

I was able to connect the database to the website but ran out
of time to fix the bugs. Users unable to sign up or login.

## Security Implementaion: Vulnerabilites and combatants

I have little to no knowledge when it comes to security, mainly
because I haven't taken the class yet. Most of this stuff comes
from my understanding that maybe you should have session
implementation and that SQLi exists. When the AI was making
edits, it explain alot of the edits it was making and the potential
vulnerabilities that it was fixing. I'm just being honest and open
about my use with AI and my own personal lack of understanding
when it comes to security and using PHP. These writes up I did
on my own from what I learned.

- login.php (Main Vulnerability SQLi)
  - Cleaning up logic to use a prepared statement to ward off —comment or 1=1 sql injection attacks
  - Using a conditional check to first fetch the user based on the username and then verify the password to that user. - Creates authentication security
  - Added rick roll redirect, essentially if any of the SQLi blacklisted terms are found in an input the hacker gets pwned themselves. I dunno I was bored.
  - On the login in, it creates a session that essentially means that if you are logged in, then you can view all the other html files.

- insert_post.php (Main Vulnerability: SQLi)
  - Using prepared statements to ward off —comment or 1=1 sql injection attacks.
  - Originally it used $conn⇒error and the full sql string when a query failed. If an error occurs then the raw sql query to the user would reveal the internal structure of the database (Column names, table names)
  - Replacing this with a simple string fixes that and Stops sensitive information disclosure.

- post_search.php and get_posts.php (Main Vulnerability: Cross site scripting)
  - both were echoing data from the database directly to the html
  - Attacker could make a post with a certain script that would run and reveal users cookie data or redirect them
  - The fix, using htmlspecialchars, which converts special characters like < and > into HTML entities which ensures the browser displays the text as is rather than executing it as code.
  - Added rick roll redirect, essentially if any of the SQLi blacklisted terms are found in an input the hacker gets pwned themselves

- db_connect.php
  - needed to add $port to the file
  - replacing the original die err with just a string to prevent unnecessary information from being disclosed like in the fix in insert_post.php

## SQL Implementation: Table, Columns

Just a side note, I used DBeaver to create tables and columns and to populate the database, so apologies if this isn't perfect.

- Category
  CREATE TABLE blog_s009.Category (
  CategoryID INT NOT NULL,
  CONSTRAINT Category_PK PRIMARY KEY (CategoryID),
  Title VARCHAR(100) NULL
  )

- Comment_Data
  CREATE TABLE blog_s009.Comment_Data (
  CommentID INT NOT NULL,
  CONSTRAINT Comment_Data_PK PRIMARY KEY (CommentID),
  UserID INT NOT NULL,
  CONSTRAINT Comment_Data_FK FOREIGN KEY (UserID),
  PostID INT NOT NULL,
  CONSTRAINT Comment_Data_FK FOREIGN KEY (PostID),
  Comment LONGTEXT
  )

- Post_Data
  CREATE TABLE blog_s009.Post_Data (
  PostID INT NOT NULL,
  CONSTRAINT Post_Data_PK PRIMARY KEY (PostID),
  UserID INT NOT NULL,
  CONSTRAINT Post_Data_FK FOREIGN KEY (UserID),
  CategoryID INT NOT NULL,
  CONSTRAINT Post_Data_FK FOREIGN KEY (CategoryID),
  Title VARCHAR(100),
  Content LONGTEXT
  )

- Post_Tag_Data
  CREATE TABLE blog_s009.Post_Tag_Data (
  TagID INT NOT NULL,
  CONSTRAINT Post_Tag_Data_FK FOREIGN KEY (TagID),
  PostID INT NOT NULL,
  CONSTRAINT Post_Tag_Data_FK FOREIGN KEY (PostID)
  )

- Tag_Data
  CREATE TABLE blog_s009.Post_Tag_Data (
  TagID INT NOT NULL,
  CONSTRAINT Tag_Data_PK PRIMARY KEY (TagID),
  TagName VARCHAR(100)
  )

- User_Data
  CREATE TABLE blog_s009.Post_Tag_Data (
  UserID INT NOT NULL,
  CONSTRAINT User_DATA_PK PRIMARY KEY (UserID),
  USERNAME VARCHAR(100),
  PASSWORD VARCHAR(100),
  EMAIL VARCHAR(100),
  ADMIN SMALLINT
  )
