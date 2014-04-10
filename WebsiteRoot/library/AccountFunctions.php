<?php

	$library = array();
	
	if(is_auth('ft')) 
	{
		$library['Library']=array();
		$library['Library']['Home']="Faculty/faculty.php";
		$library['Library']['History']=array();
		$library['Library']['History']['Issued Books']="Faculty/display_issued_books.php";
		$library['Library']['History']['Requests']="Faculty/display_requests.php";
		$library['Library']['List Books']=array();
		$library['Library']['List Books']['All Books']="Faculty/all_books.php";
		$library['Library']['List Books']['Assets']="Faculty/display_assets.php";
		$library['Library']['Requisition']="Faculty/display_all_requests.php";
	}

	if(is_auth('ft'))
	{
		$library['Library']=array();
		$library['Library']['Home']="Hod/hod.php";
		$library['Library']['History']=array();
		$library['Library']['History']['Issued Books']="Hod/display_issued_books.php";
		$library['Library']['History']['Requests']="Hod/display_requests.php";
		$library['Library']['List Books']=array();
		$library['Library']['List Books']['All Books']="Hod/all_books.php";
		$library['Library']['List Books']['Assets']="Hod/display_assets.php";
		$library['Library']['Requisition']="Hod/display_all_requests.php";
	}

	if(is_auth('cselib'))
	{
		$library['Library']=array();
		$library['Library']['Home']="Librarian/admin.php";
		$library['Library']['History']=array();
		$library['Library']['History']['Issued Books']="Librarian/display_issued_books.php";
		$library['Library']['History']['Donated']="Librarian/display_donated_books.php";
		$library['Library']['History']['Requests']="Librarian/display_requests.php";
		$library['Library']['History']['Approved Requests']="Librarian/display_approved_request_main.php";
		$library['Library']['List Books']=array();
		$library['Library']['List Books']['All Books']="Librarian/all_books.php";
		$library['Library']['List Books']['Assets']="Librarian/display_assets.php";
		$library['Library']['Add Books']=array();
		$library['Library']['Add Books']['Library']="Librarian/add_books.php";
		$library['Library']['Add Books']['Donated Books']="Librarian/add_donated_book.php";
		$library['Library']['Issue Books']="Librarian/issue_books.php";
		$library['Library']['Book Return']="Librarian/return_books.php";
	}

	if(is_auth('stu'))
	{
		$library['Library']=array();
		$library['Library']['Home']="Mtech/student.php";
		$library['Library']['History']=array();
		$library['Library']['History']['Issued Books']="Mtech/display_issued_books.php";
		$library['Library']['List Books']=array();
		$library['Library']['List Books']['All Books']="Mtech/all_books.php";
		$library['Library']['List Books']['Assets']="Mtech/display_assets.php";
	}
	
?>