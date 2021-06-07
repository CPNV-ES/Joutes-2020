$(document).ready(function() {
    let count = 0
    let isDeletable = false

    //Apply a setup to ajax call for the csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            global: false
        }
    });

    // Define the custom utility function that brings back a "Representative String" for a TD for DataTables' Search & Sort
    function getRepresentativeStringForTDContent(el) {

        // Will store concenatenated string for this TD cell
        let all_search_values = "";

        // NOTE: "el" is the content of TD, which could be either
        //      (1) input field(s) themselves -- one or multiple, or
        //      (2) wrapping element(s) in which we need to find() -- one or multiple
        $(el).each(function (index) {
            let inputsInput = $(this).is('input') ? $(this) : $(this).find('input');
            let inputsSelect = $(this).is('select') ? $(this) : $(this).find('select');

            inputsInput.each( function( i, e) {
                // Text Inputs added by value
                all_search_values += $(e).val();
            });
            inputsSelect.each( function( i, e) {
                // Select Inputs added by Selected Option text (not value)
                all_search_values += $(e).find('option:selected').text();
            });

        });

        return all_search_values;
    }

    // Define the DataTable custom Search function for Input/Select fields
    $.fn.dataTableExt.ofnSearch['html-input'] = function(el) {
        return getRepresentativeStringForTDContent(el);
    };

    // Define datable
    $('#persons').DataTable({
        columnDefs: [
            { "type": "html-input", "targets": [2] },  // Search Logic for the special types
            { "orderDataType": "html-input", type: "string", "targets": [2] }  // Sort Logic for the special types
        ],
        responsive: true,
        "pageLength": 12,
        "order": [[ 2, "desc" ]] //Sort on Roles column to show admin first
    });


    //On click listener on the checkboxes for deletion
    $('#persons tbody').on( 'click','input', function () {
        let userId = $(this).attr('id')

        //Check if the user selected is already selected
        let input = $(this).parents('tr').find('input[name="deletedUserId[]"]')
        $(this).closest("tr").toggleClass('selected')


        //Check the input length (0 if there is no input)
        if (input.length) {
            input.remove()
            count--
        }
        else{
            let inputDeleted = $(document.createElement('input'))
                .attr("type", "hidden")
                .attr("name", "deletedUserId[]") //[] for concatenation of ids when sending post request
                .attr("value", userId)
            $(this).closest("tr").append(inputDeleted)
            count++
        }


        //Toggle or untoggle the delete button to send the post request
        if(count > 0 && !isDeletable){
            $('#deleteInput').children('input').toggleClass('invisible', 0)
            $('#deleteInput').children('input').toggleClass('visible', 1)
            isDeletable = true
        }
        else if(count === 0 && isDeletable) {
            $('#deleteInput').children('input').toggleClass('visible', 0)
            $('#deleteInput').children('input').toggleClass('invisible', 1)
            isDeletable = false
        }
    } );


    //On change listener for the select to change roles
    $('#persons tbody').on('change', 'select', function (){
        console.log("salit")
       let userId = this.id;
       let roleId = $(this).children(":selected").attr("id");
       //Create an object to parse in JSON
       let data = {"role_id": roleId}

       //Create the patch request
       $.ajax({
           url: "http://localhost:8080/users/" + userId, //Todo: Change hardcoded url
           contentType: "application/json",
           data: JSON.stringify(data),
           type: "PUT"
       })

        location.reload();

    });

} );
