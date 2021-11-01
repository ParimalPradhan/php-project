$(document).ready(function() 
{
    $('#summernote').summernote
    ( 
      { 
        height: 200
      }
    );
  });

$(document).ready(function()
{
  $('#selectAllBoxes').click(function(event)
  {
    if (this.checked)
    {
      $('.checkbox').each(function ()
      {
        this.checked = true;
      });
    }
    else
    {
      $('.checkbox').each(function()
      {
        this.checked = false;
      });
    }
  });

  var div_box = "<div id='load-screen'><div id='loading'></div></div>";

  $("body").prepend(div_box);


  $('#load-screen').delay(2000).fadeOut(800, function()
  {
    $(this).remove();
  });

// });

function loadUsersOnline()
{
  $.get("functions.php?onlineusers=result", function(data)
  {
    $(".usersonline").text(data);
  });
}

setInterval(function()
{
  loadUsersOnline();
},500);
});