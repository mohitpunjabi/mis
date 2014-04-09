<?php
	require_once("../../Includes/Auth.php");
	auth('alum');
	require_once("../../Includes/ConfigSQL.php");	
	require_once(SERVER_ROOT."/Includes/Layout.php");

	function createMessage($subject, $content, $sender, $time){
		echo '	<div id="message" class="message">
					<div id="subject" class="subject"><span id="subject-content" class="subject-content wrapword"><small>Subject:</small> '.$subject.'</span><span id="time" class="time">'.$time.'</span></div>
					<div id="message-content" class="message-content"><pre class="wrapword">'.$content.'</pre></div>
					<div id="sender" class="sender"><span>From: '.$sender.'</span></div>
				</div>';
	}

	drawHeader("Messages");
?>
<style type="text/css">
pre {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	line-height: 1.5;
}
div.message {
    position: relative;
	width: 90%;
	padding: 5px 20px;
	background-color: #f6f6f6;
	margin-top: 10px;
}
div.message.user{
	float: left;
	margin-left: 30px;
}
div.message.others{
	float: right;
<?php
	if(isset($_SESSION['SESS_AUTH']) && $_SESSION['SESS_AUTH']!='AL')
		echo 'margin-left: 30px;';
	else
		echo 'margin-right: 30px;';
?>
}
div.message>div.subject{
    font-size:1.4em;
    padding:0px 0px 25px 0px;
    margin-bottom:10px;
    border-bottom:1px solid #dde;
}
div.message>div.subject>span.subject-content{
    display:block;
    float:left;
    padding:0px 10px;
    word-wrap: break-word;
}
div.message>div.subject>span.time{
    font-size:0.7em;
    display:block;
    float:right;
    padding:0px 10px;
}
div.message>div.post-content{
    display:block;
    clear:both;
    padding:0px 30px;
}
.wrapword{
	white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
	white-space: -pre-wrap;      /* Opera 4-6 */
	white-space: -o-pre-wrap;    /* Opera 7 */
	white-space: pre-wrap;       /* css-3 */
	word-wrap: break-word;       /* Internet Explorer 5.5+ */
	white-space: normal;
	word-break: break-all;
}
div.message>div.sender{	
    width:100%;
    padding:0px 10px;
}
div.message>div.sender>span{
    display:block;
    position:absolute;
    right:15px;
    bottom:5px;
}

div.create-post>span{
	margin-left:-30%;
}

div.create-post{
	margin-right: -401px;
	background-color: #efefef;
	padding: 0px 0px 5px 0px;
	border:1px solid #dfdfdf;
}
div.create-post>span{
	transition:margin-left 0.5s;
}
div.create-post{
	transition:margin-right 0.5s;
}
div.create-post:hover>form, div.create-post:hover>span{
	margin-left:0%;
}
div.create-post:hover{
	margin-right:0%;
}
ul.responsetable{
    padding: 0px;
    margin: -1px 0px 0px 1px;    
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
}
li.response-name{
    background-color: #fff;
}
li.response-name:hover, li.response-name.selected {
    background-color: #66f;
    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.5));
    cursor: pointer;
    display: block;
}
li.response-name.disabled,  li.response-name.disabled:hover{
    cursor: pointer;
    background-color: #666;
}
span.close {
	display:inline-block; 
	border-radius: 0px 2px 2px 0px; 
	padding: 5px; 
	cursor: pointer; 
	background-color: #666;
	color: #fff;
}
span.close:hover {
	background-color: #64f;
}
#bulk > div{
	border: 1px solid #ccc;
}
</style>
<script type="text/javascript" src="JS/script.js"></script>
<script type="text/javascript">
	function createNotification(title, description, type){
		if(undefined === type) type="";
		$("DIV.-feedback-content").each(function(){
			this.insertBefore(DIV = document.createElement("DIV"), this.firstChild);
		});
		$(DIV).html('<div class="notification ' + type + '"> <h2>' + title + '</h2>' + description + '</div>');
		$(DIV).html($(DIV).html() + "<span style='position:absolute; top: 5px; right: 30px; cursor: pointer; font-size: 1.2em;' onclick='this.parentNode.parentNode.removeChild(this.parentNode);'>x</span>");
		DIV.style.position = "relative";
	}
	/*
	function submit_form(){
		post_title = $("input#post-title").val();
		post_content = document.getElementById("post-content-text").value;
		if(post_title=="" || post_content==""){
			alert("Null values.");
			return false;
		}
		//alert(post_content);
		$.post("insertPost.php", {title:post_title, content:post_content, no_redirect:true}, function(str){
			if(str=="") {
				$.post("getLastPost.php", null, function(str){
					if(str=="")
						return;
					$("DIV#post-container").each(function(){
							this.insertBefore(DIV = document.createElement("DIV"), this.firstChild);
					});
					DIV.innerHTML = str;
					DIV.childNodes[1].style.border = "1px solid #9c7fa2";
					DIV.childNodes[1].style.backgroundColor = "#e6e6ff";
				});
				createNotification("Successfully posted", "", "success");
				document.getElementById("post-title").value = document.getElementById("post-content-text").value = "";
			} else {
				$("DIV.-feedback-content").each(function(){
					this.appendChild(DIV = document.createElement("DIV"));
				});
				$(DIV).html("Post failed.\n" + str);
			}
		});
		return false;
	}*/
		
</script>

<h1 class="page-head"><?php if(is_auth('alum')) echo'Messages'; else echo 'Queries'; ?></h1>

<?php
	$user = $_SESSION['id'];
?>
<div id="" class="" style="margin-top: 50px;">
	<!-- <span style="display:block; padding:5px 10px; background-color:#2200aa; color:#fff; height:20px; width: 90%; font-size:1.2em;">New Message</span> -->
	<form id="new-msg" name="newMsg" method="POST" action="insertMessage.php">
		<table style="width: 90%;" nozebra>
			<tr>
				<td>Message</td><td colspan="2"><textarea id="message-content" name="content" style="width:90%" placeholder="Message"></textarea></td>
			</tr>
			<tr>
				<td>
					Message Type
				</td>
				<td align="center" colspan="2">
					<input type="radio" name="msg_type" id="msg-type" value="bl" style="padding: 0px 20px;">Group</input><span style="display: inline-block; width: 40px;"></span>
					<input type="radio" name="msg_type" id="msg-type" value="sl" style="padding: 0px 20px;">Individuals</input>
				</td>
			</tr>
			<tr class="course-branch" style="display: none;">
				<td></td>
				<td colspan="2" id="course-branch">
					<input type="radio" name="groupby" id="groupby" value="course" checked="checked" style="padding: 0px 20px;" >Group by course</input><span style="display: inline-block; width: 40px;"></span>
					<input type="radio" name="groupby" id="groupby" value="coursebranch" style="padding: 0px 20px;" >Group by Course-Branch</input>
				</td>
			</tr>
			<tr>
				<td colspan="3" id="bulk">
					<div class="course" style="max-width: 30%; float: left; padding: 10px; margin: 5px; display: none;" ><div style="font-weight: 600;">Course</div><div id="course"></div></div><div class="branch" style="max-width: 30%; float: left; padding: 10px; margin: 5px; display: none;" ><div style="font-weight: 600;">Branch</div><div id="branch"></div></div><div class="sem" style="max-width: 30%; float: left; padding: 10px; margin: 5px; display: none;" ><div style="font-weight: 600;">Semster</div><div id="sem"></div></div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="submit_message" value="Send Message" style="width:100%; height:100%" />
				</td>
			</tr>
		</table>
	</form>
	
</div>

<?php
if(isset($_SESSION['SESS_AUTH'])){
	switch($_SESSION['SESS_AUTH']){
		case 'AL':	?>
					
				<?php 	break;
		case 'ST':
						break;
	}
}
?>

<?php
	$mysqli->close();
	drawFooter();
?>