var x=0;

function notibarShow()
{
    document.getElementById('notiBox').style.display ="block";
    if(x==1)
    {
        notibarHide();
    }
    else
    {
        x=1;
    }
    
}

function notibarHide()
{
    document.getElementById('notiBox').style.display ="none";
    document.getElementById('notiNumber').style.display="none";
    x=0;
}