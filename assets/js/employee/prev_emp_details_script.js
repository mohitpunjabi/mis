function onclick_add()
{
        var d=document.getElementsByName("designation2")[0].value;
        var f=document.getElementsByName("from2")[0].value;
        var t=document.getElementsByName("to2")[0].value;
        var a=document.getElementsByName("addr2")[0].value;
        var r=document.getElementsByName("payscale2")[0].value;


        if(d=="" || f=="" || t=="" || a=="" || r=="")
        {
                alert('Please fill up all the fields !!');
                return false;
        }
        else if((new Date(f).getTime()) > (new Date(t).getTime()))
        {
                alert('Fill the period correctly !!');
                return false;
        }
        else
                return true;

        /*var row=document.getElementById("tableid").rows;
        var d=document.getElementsByName("designation2[]")[row.length-3].value;
        var f=document.getElementsByName("from2[]")[row.length-3].value;
        var t=document.getElementsByName("to2[]")[row.length-3].value;
        var a=document.getElementsByName("addr2[]")[row.length-3].value;
        var r=document.getElementsByName("payscale2[]")[row.length-3].value;


        if(d=="" || f=="" || t=="" || a=="" || r=="")
                alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
        else if((new Date(f).getTime()) > (new Date(t).getTime()))
                alert('Sno '+(row.length-2)+': Fill the period correctly !!');
        else
        {
                var newrow=document.getElementById("tableid").insertRow(row.length);
                newrow.innerHTML=document.getElementById("addrow").innerHTML;
                var newid=newrow.cells[0].id="sno"+Number(row.length-3);
                document.getElementById(newid).innerHTML=row.length-2;
        }*/
}

$(document).ready(function() {

        $("#add_btn").click(function(e) {
                if(!onclick_add())
                        e.preventDefault();
        });

        /*$("#fetch_id_btn").click(function() {
                fetch_details();
        });

        $("#tstatus").change(teaching_handler);
        $("#payscale").change(payband_handler);
        $("#dob").change(retirement_handler);
        $("gradepay").change(function(){
                document.getElementById('basicpay').disabled=false;
        });

        teaching_handler();     //to set default designations and departments*/
});