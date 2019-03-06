$(document).ready(function(){

    //alert("no");
    $(".btn-assign").on('click', function(){
        
        var userId   = $("#user-id_record").val();
        var ticket   = $(this).attr('id');
        var ticketId = ticket.replace("icon-", "");

        $.ajax({
            url: 'index.php?r=ticket/assignticket',
            type: 'POST',
            data: {
                user   : userId,
                ticket : ticketId,
            },

            complete: function(response) {  

                $('#loader').fadeOut();
                console.log(response);               
                $('#content-header').fadeIn(); 
                
                setTimeout(window.location.href = 'index.php?r=ticket%2Funassigned', 2000);

            },
            error: function(x){
                console.log(x);
            }

        }); 
    });
  
});

function showSaveIcon(element, ticketId) {
    
    var selectedText  = element.options[element.selectedIndex].innerHTML;
    var selectedValue = element.value;

    if(selectedValue != ""){
        document.getElementById("icon-"+ticketId).style.display = 'inline';
    }else{
        document.getElementById("icon-"+ticketId).style.display = 'none';
    }
    
}



