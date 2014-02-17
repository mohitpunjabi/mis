MIS
===

The Management Information System for Indian School of Mines, Dhanbad. Currently under developement.

Here's a summary of all the includes:

Auth.php
---

`auth(...)`: Calling it ensures that someone must be logged in to view the page. Provide arguments, if you want to restrict access. Eg: `auth('deo', 'stu')` restricts the page to Data Entry Operators and Students.