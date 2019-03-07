$(document).ready(function(){

    //Funcion para asignar un ticket a un empleado.
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


    //Accordion
    $("#update-pending-ticket").on('click', function(){
        
        var idTicket = $(this).attr('tid');
        
        $.ajax({
            url: 'index.php?r=ticket/ticketdetails',
            type: 'POST',
            data: {
                ticket : idTicket,
            },

            complete: function(response) {  

                console.log(response); 

                data = JSON.parse(response.responseText)
                title = data.title;

                $("#id-ticket").val(idTicket);
                $(".modal-title").html(title);
                
            },
            error: function(x){
                console.log(x);
            }

        }); 
        
        $('#myModal').modal('toggle');        
        
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



