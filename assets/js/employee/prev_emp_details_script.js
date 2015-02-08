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
}

$(document).ready(function() {
        $("#add_btn").click(function(e) {
                if(!onclick_add())
                        e.preventDefault();
        });
});