# postgresPatternDB
The Postgres and local image file version of the pattern database
The PHP files are being worked on and will be uploaded later. 
If you're keen, import the sql file on linux thusly:
1. Copy it to /var/lib/postgres
2. Become user postgres (sudo su - postgres)
3. Create the database with "createb patterns"
4. Create the user patterns
5. Go into psql as user postgres:
   CREATE USER patterns WITH PASSWORD 'p@tt3rns';
   GRANT ALL on patterns TO patterns;
   \i patterns-blank.sql
ctrl+d to exit psql or \td to list your tables
 
