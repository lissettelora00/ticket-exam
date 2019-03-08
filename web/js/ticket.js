$(document).ready(function(){   
   
    //Date Picker
    $('#initial-date, #final-date').datepicker({
        beforeShow: customRange, //Validate date ranges
        dateFormat: "yy/m/d",
    }).datepicker("setDate",'now');


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

                console.log(response); 

                $('#loader').fadeOut();              
                $('#content-header').fadeIn(); 
                
                setTimeout(window.location.href = 'index.php?r=ticket%2Funassigned', 3000);

            },
            error: function(x){
                console.log(x);
            }

        }); 

    });


    //Accordion pending ticket
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

                data  = JSON.parse(response.responseText)

                //Get ticket title
                title = data.title;

                $("#id-ticket").val(idTicket);

                //Set ticket title as modal title
                $(".modal-title").html(title);
                
            },
            error: function(x){
                console.log(x);
            }

        }); 
        //Show modal
        $('#myModal').modal('toggle');        
        
    });

    $("#generate-report-btn").on('click', function()
    {
        var initDate    = $("#initial-date").val();
        var finalDate   = $("#final-date").val();
        
        if(initDate != "" && finalDate !="")
        {
            
            $.ajax({
                url: 'index.php?r=ticket/reportdata',
                type: 'POST',
                data: {
                    initDate : initDate,
                    finalDate : finalDate,
                },
    
                complete: function(response) {  
                    
                    div = "div-report-render";
                    console.log(response.responseText);  
                    data = JSON.parse(response.responseText);
                    
                    renderTable(data, div);   

                },
                error: function(x){
                    console.log(x);
                }
    
            }); 

        }else{
            $("#div-report-render").html("error");
        }
    });
  
});

/*
**
*/
function showSaveIcon(element, ticketId) {
    
    var selectedText  = element.options[element.selectedIndex].innerHTML;
    var selectedValue = element.value;

    if(selectedValue != ""){
        document.getElementById("icon-"+ticketId).style.display = 'inline';
    }else{
        document.getElementById("icon-"+ticketId).style.display = 'none';
    }
    
}

/*
**
*/
function customRange(input) {
    
    if (input.id == 'final-date') {

        var minDate = new Date($('#initial-date').val());
        minDate.setDate(minDate.getDate())

        return {
            minDate: minDate    
        };
    }  
    
    if (input.id == 'initial-date') {

        var maxDate = new Date($('#final-date').val());
        maxDate.setDate(maxDate.getDate())

        return {
            maxDate: maxDate    
        };
    }  

    return {}

}


/*
**
*/
function renderTable(data, divid) {

    div = "#"+divid;
    
    if(data.length === 0){
  
      div_str =`
        <div class="has-error">
          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> There's no data of ticket in the date range selected.</label>
          <span class="help-block">Try with another range.</span>
        </div>`;
  
    }else{
  
        div_str =` 
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <th style="width:5%">Id</th>
              <th style="width:17%">Title</th>
              <th style="width:28%">Description</th>
              <th style="width:10%">Responsible</th>
              <th style="width:15%">Requestor</th>
              <th style="width:15%">Request Date</th>
              <th style="width:5%">Status</th>
              <th style="width:5%">Info</th>
            </tr>`;  

        data.forEach(function(x) {

            div_str += `
            <tr>
                <td>${x.id_record}</td>
                <td>${x.title}</td>
                <td>${x.description}</td>
                <td>${x.assigned}</td>
                <td>${x.requestor}</td>
                <td>${x.request_date}</td>
                <td><span class="badge bg-${x.status_color}">${x.status_name}</span></td>
                <td><a href="index.php?r=ticket/view&id=${x.id_record}"><i class="fa fa-eye"></i></a></td>
            </tr>`;
        });

        div_str+=`</tbody></table>`;
    }
  
    $(div).html(div_str);
    $(div).fadeIn();
  
  }



