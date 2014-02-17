MIS
===

The Management Information System for Indian School of Mines, Dhanbad. Currently under developement.

Here's a summary of all the includes:

Auth.php
---

`auth(...)`: Calling it ensures that someone must be logged in to view the page. Provide arguments, if you want to restrict access. Eg: `auth('deo', 'stu')` restricts the page to Data Entry Operators and Students.

`is_auth($auth_id)`: Returns `true` if the user is of authorization `$auth_id`. Returns false otherwise.

`start_session_sec()`: Starts the secured session. Use this function everywhere instead of the default `session_start()`.

`strclean($str)`: Returns a trimmed, and escaped string `$str`. Prevents SQL Injection. Clean all strings before running queries.

Layout.php
---

`drawHeader($title)`: Renders the page header, navbar and sets the page title to `$title`.

`drawFooter()`: Renders the page footer.

`currentModule()`: Returns the module id of the current module user is in.

`drawNotification($title, $description, $type)`: Draws a notification with the specified title and description. `$type` is optional. Use `"error"` or `"success"` for `$type`.

ConfigSQL.php
---

Defines global database variables. Creates a mysqli object `$mysqli`. Use this variable to connect to the database everywhere.