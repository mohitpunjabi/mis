function onclick_add()
{
        var row=document.getElementById("tableid").rows;
        var f=document.getElementsByName("from5[]")[row.length-3].value;
        var t=document.getElementsByName("to5[]")[row.length-3].value;
        var a=document.getElementsByName("addr5[]")[row.length-3].value;
        var d=document.getElementsByName("dist5[]")[row.length-3].value;

        if(f=="" || t=="" || a=="" || d=="" )
                alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
        else if((new Date(f).getTime()) > (new Date(t).getTime()))
                alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
        else
        {
                var newrow=document.getElementById("tableid").insertRow(row.length);
                newrow.innerHTML=document.getElementById("addrow").innerHTML;
                var newid=newrow.cells[0].id="sno"+Number(row.length-3);
                document.getElementById(newid).innerHTML=row.length-2;
        }
}

function validate()
{
        var n_row=document.getElementById("tableid").rows.length;
        var i=0;
        for(i=0;i<n_row-3;i++)
        {
                var f=document.getElementsByName("from5[]")[i].value;
                var t=document.getElementsByName("to5[]")[i].value;
                var a=document.getElementsByName("addr5[]")[i].value;
                var d=document.getElementsByName("dist5[]")[i].value;

                if(f=="" || t=="" || a=="" || d=="" )
                {
                        alert('Sno '+(i+1)+' : Please fill up all the fields !!');
                        return false;
                }
                else if((new Date(f).getTime()) > (new Date(t).getTime()))
                {
                       alert('Sno '+(i+1)+' : Fill the period correctly !!');
                        return false;
                }
        }
        return true;
}

function onclick_submit()
{
        if(!validate())                 //validation of rows except last one
                return false;
        //validation of last row
        var row=document.getElementById("tableid").rows;
        var f=document.getElementsByName("from5[]")[row.length-3].value;
        var t=document.getElementsByName("to5[]")[row.length-3].value;
        var a=document.getElementsByName("addr5[]")[row.length-3].value;
        var d=document.getElementsByName("dist5[]")[row.length-3].value;

        if(f!="" && t!="" && (new Date(f).getTime()) > (new Date(t).getTime()))
        {
                alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
                return false;
        }
        else if((f=="" && t=="" && a=="" && d=="" )     ||      (f!="" && t!="" && a!="" && d!=""))
                return true;
        else
        {
                alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
                return false;
        }
}
