var xmlHttp;

function showCustomer(str)
{
    xmlHttp=GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Your browser does not support AJAX!, Please enable javascrip in your browser. Search in option");
        return;
    }

    var url="getcustomer.asp";
    url=url+"?q="+str;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange=stateChanged;
    xmlHttp.open("POST","<?php echo site_url('topic') ?>",true);
    xmlHttp.send(null);
}

function stateChanged()
{
    if (xmlHttp.readyState==4)
    {
        document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
    }
}

function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}