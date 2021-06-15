/*
    Principe:
    - Chaque poule contient deux listes d'équipes: les entrantes et les sortantes (classement)
    - On donne un id aux équipes sortantes et aux équipes de départ
    - Chaque équipe 'entrante' a un champ 'data-previous' qui contient l'id d'une équipe sortante
    - Au survol d'une équipe avec la souris, on lit le previous et on la met en évidence avec une classe 'highlight'
  */
document.addEventListener('DOMContentLoaded', function () {
    Array.from(document.getElementsByClassName("team")).forEach(function (element) {
        element.addEventListener('mouseover', function (evt) {
            previous = document.getElementById(evt.target.dataset.previous)
            previous.classList.add('highlight')
            evt.target.classList.add('highlight')
            connect(previous.getBoundingClientRect(),evt.target.getBoundingClientRect())
        });
        element.addEventListener('mouseout', function (evt) {
            previous = document.getElementById(evt.target.dataset.previous)
            previous.classList.remove('highlight')
            evt.target.classList.remove('highlight')
            
        });
    });
})
var table, rows, switching, i, x, y, shouldSwitch;

document.addEventListener('DOMContentLoaded', function sortTable() {
    table = document.getElementsByClassName("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        for (x = 0; x < (table.length - 1); x++) {
            rows = table[x].rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
})

