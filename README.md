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

`notify($user_id_to, $title, $description, $path, $type = "")`: Notifies the `$user_id_to` with the `$title` and `$description`. `$path` is the link of the page relative to the module. `$type` may by `"error"` or `"success"` (optional).


ConfigSQL.php
---

Defines global database variables. Creates a mysqli object `$mysqli`. Use this variable to connect to the database everywhere.

Also defines the `WEBSITE_ROOT` variable. Set this to the local path of the WebsiteRoot folder of the project.


Auth Types
---

Following is the list of standard Auth Types that will be used. Note that the auth types of local modules are prefixed with the module id. Although all modules can use that auth id, but only that particular module has the right to add and remove the entries for that auth id in the `user_auth_types` table.

The auth IDs with no prefix are core IDs and are created by the core modules. Please create an issue if your auth



| Auth ID	| Description 						|
|:-------------:|:-----------------------------------------------------:|
|`acmc_cs`	|Civil Supervisor					|
|`acmc_es`	|Electrical Supervisor					|
|`chw`		|Chief Hostel Warden					|
|`cmi_ace`	|Campus Maintainence Assistant Campus Engineer		|
|`cmi_aee`	|Campus Maintainence Assistant Engineer (Electrical)	|
|`cmi_ce`	|Campus Maintainence Campus Engineer			|
|`cmi_inc`	|Campus Maintainence Store Incharge			|
|`deo`		|Data Entry Operator					|
|`emp`		|Employee						|
|`fictp`	|Departmental Faculty Incharge Training and Placement	|
|`ft`		|Faculty						|
|`guard_sup`	|Guard Supervisor					|
|`health_doc`	|Health Center Doctor					|
|`health_reg`	|Health Center Registration Desk			|
|`health_wd`	|Health Center Ward					|
|`hod`		|Head of Department					|
|`hostel_wd`	|Hostel Warden						|
|`jrf`		|Junior Research Fellow					|
|`nfta`		|Non Faculty Academic					|
|`nftn`		|Non Faculty Non Academic				|
|`pg`		|Post Graduate						|
|`stock_inc`	|Departmental Stock and Inventory Incharge		|
|`stu`		|Student						|
|`timetable_inc`|Timetable Incharge					|
|`tpo`		|Training and Placement Officer				|
|`ug`		|Under Graduate						|