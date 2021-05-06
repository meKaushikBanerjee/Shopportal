$(function(){
    $('a').each(function(){
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active'); $(this).parents('li').addClass('active');
        }
    });
});

function validmob(event)
{
  var regex = new RegExp("^[0-9]");
  var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
  var char = event.which || event.keyCode;
  if((!regex.test(key)) && (char != 8) && (char !=9)) 
  {
    event.preventDefault();
    return false;
  }
} 

function validname(event)
{
  var regex = new RegExp("^[A-Za-z ]");
  var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
  var char = event.which || event.keyCode;
  if((!regex.test(key)) && (char != 8) && (char !=9)) 
  {
    event.preventDefault();
    return false;
  }
} 