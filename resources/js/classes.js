function checkAll() {
    checkAll(document.getElementById('checkAll')) // On initialise le label du bouton 'checkAll'
    function checkAll(checkbox) {
        // Get all the checkboxes
        var checkboxes = document.getElementsByName('classesboxes');

        // loop through the checkboxes
        for (var i = 0; i < checkboxes.length; i++) {
            // Set their state to the checkbox state
            checkboxes[i].checked = checkbox.checked;
        }

        // change the label of the checkbox
        checkbox.parentNode.querySelector('span').innerHTML = checkbox.checked ? 'Uncheck All' : 'Check All';
    }
}
