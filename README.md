# postgresPatternDB
This is the Postgres and local image file version of the pattern database
The PHP files are being worked on and are uploaded when I think they work. 
Import the sql file on linux thusly:
1. Copy it to /var/lib/postgres
2. Become user postgres (sudo su - postgres)
3. Create the database with "createb patterns"
4. Create the user patterns
5. Go into psql as user postgres:
   CREATE USER patterns WITH PASSWORD 'p@tt3rns';
   GRANT ALL on patterns TO patterns;
   \i patterns-blank.sql;
ctrl+d to exit psql or \td to list your tables

Now the server must have support for postgres 
I installed php7.2-pgsql on Linux mint to get it working.
So far the sql file when imported will create both pattern and publisher tables then it will populate the latter.
I have patterns only from these 23 publishers, and if I need to add a new one I'll just add a row using the command line in psql, mostly because it's such an infrequent event that writing a web interface would be very poor use of time.
Let me know what you think, whether it's useful, what could be improved etc. It's very very basic and I just wrote it to work. If it was for an employer it'd be a lot more structured and a lot more secure.
This was written to work on a standalone server or PC. 
I would strongly advise not putting any of it on the network without modifying and hardening the code. Like I said, it's not secure, especially since the default database username and password is now public knowledge!

At this stage the web interface allows you to add pattern entries, upload a .jpg of the cover for each one and edit existing entries. I could enhance it to allow other file types but it's not a high priority.

Here are a couple of tips:
1. If, like me, you start this having hundreds of patterns, add the entries but not the pictures until you're finished. 
2. Reduce your image file sizes, or an ear could take up the whole browser window.
3. When your images are ready to upload, look at the database home screen for the database ID of each photo, rename all of them and just copy them into your upload folder. This version of the pattern database doesn't have any bizarre data checks for photos, the web server simply checks for a file called <database id>.jpg in the pattern-pics folder while it's loading the index page. Uploading this way saves you an enormous amount of time. If you later want to add a single entry, the web interface may be more convenient.
   
I have used the MySQL version in a hosted environment, but that was years ago and the passwords and my attention to security alerts were different then.

If you have trouble uploading images or anything else where you get access denied, change ownership of the files to the owner of the web server. E.g. on Mint, as root, chown -R /var/www/html/*.
