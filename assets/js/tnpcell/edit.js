function EditProject(seq)
{
    if($("#editbutton_project"+seq).val() == "Edit")
    {
      $("[name='place"+seq+"']").prop('disabled',false);
      $("[name='title"+seq+"']").prop('disabled',false);
      $("[name='duration"+seq+"']").prop('disabled',false);
      $("[name='role"+seq+"']").prop('disabled',false);
      $("[name='description"+seq+"']").prop('disabled',false);
      $("#editbutton_project"+seq).val("Save");	
    }
    else if($("#editbutton_project"+seq).val() == "Save")
    {	
      var place= $("[name='place"+seq+"']").prop('disabled',true);
      var title= $("[name='title"+seq+"']").prop('disabled',true);
      var duration= $("[name='duration"+seq+"']").prop('disabled',true);
      var role= $("[name='role"+seq+"']").prop('disabled',true);
      var description= $("[name='description"+seq+"']").prop('disabled',true);
      var xmlhttp;
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }		
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          alert(xmlhttp.responseText);
          //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
        }
      }
      var project_details = new Array();
      project_details['place']= place;
      project_details['title']= title;
      project_details['role']= role;
      project_details['description']= description;
      alert("are you sure?");
      xmlhttp.open("POST",site_url(base_url+"index.php/tnpcell/cv/update_project/"+project_details),true);
      xmlhttp.send();
      xmlDoc=xmlhttp.responseXML;
      console.log(xmlhttp.responseText);
      $("#editbutton_project"+seq).val("Edit");
    }
}