$(function(){
  $('#bootbox-1').click(function(){ bootbox.alert("This is an alert with a callback!", function(){ alert('This was logged in the callback!'); }); })
  $('#bootbox-2').click(function(){ bootbox.confirm("This is the default confirm!", function(result){ alert('This was logged in the callback: ' + result); }); })
  $('#bootbox-3').click(function(){ bootbox.prompt("This is the default prompt!", function(result){ alert(result); }); })
    $('#bootbox-4').click(function(){
      bootbox.confirm({
        title: "Destroy planet?",
        message: "Do you want to activate the Deathstar now? This cannot be undone.",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm'
            }
        },
        callback: function (result) {
            alert('This was logged in the callback: ' + result);
        }
    });
    });
    
    $("#bootbox-5").click(function(){ 
        bootbox.dialog({
          message:"I am a custom dialog",title:"Custom title",
          buttons:{
            later:{label:"Later",className:"btn-gray",callback:function(){alert("uh oh, look out!")}},
            danger:{label:"<i class='fa fa-times'></i> Remove",className:"btn-danger",callback:function(){alert("Primary button")}},
            success:{label:"<i class='fa fa-check'></i> Go",className:"btn-success",callback:function(){alert("great success")}},
          }
        });
    });
});