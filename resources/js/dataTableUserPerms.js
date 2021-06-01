$(document).ready(function() {
    let count = 0
    let isDeletable = false

    $('#persons').DataTable({
        responsive: true,
        "pageLength": 15
    });

    $('#persons tbody').on( 'click','input', function () {
        let userId = $(this).attr('id')
        let input = $(this).parents('tr').find('input[name="deletedUserId[]"]')
        $(this).closest("tr").toggleClass('selected')

        if (input.length) {
            input.remove()
            count--
        }
        else{
            let inputDeleted = $(document.createElement('input'))
                .attr("type", "hidden")
                .attr("name", "deletedUserId[]")
                .attr("value", userId)
            $(this).closest("tr").append(inputDeleted)
            count++
        }

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
} );
