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
This is for your PC. I wouldn't advise putting this on the network, instead keep it to localhost. Like I said, it's not secure, especially since the default username and password is now public knowledge!
