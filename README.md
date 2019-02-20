# Sample PHP Api

This is a quick sample API for accessing a MySQL database using PHP. It's mostly incomplete (note the lack of an "update" file for the employees entity), and I'm not entirely certain how secure it is. You're welcome to use it however you want.

## How to use

1. Clone the repo and open `database/db.php`
2. Edit line 12 with your own API key (or make it draw API keys from a database)
3. Edit lines 21 through 24 to connect to your MySQL database
4. Create a PHP class for each entity in your database, and store them in the entities folder. See `entities/employee.php` for a sample.
5. Create a new folder for each entity in your database and create a `create.php`, `read.php`, `update.php`, and `delete.php` file for each entity. See the samples in the employees folder for how to set this up.
6. Connect to your API with the URL: `http://yourdomain.com/path/to/api/entity_name/read.php`

If you want to see sample data, use `install_sample.sql` and run the `index.html` and `app.js` files on a web server of your choice.

## Security

I'm not a security expert, so my code likely isn't perfect. Sorry about that. Use at your own risk, and always check your inputs. Test your code!