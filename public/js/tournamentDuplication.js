sportSelect.addEventListener('change', selection);
copyTournament.addEventListener('click', emptyInput);

function selection() {

    var listSport = document.getElementById('sportSelect');
    var sportSelected = listSport.options[listSport.selectedIndex].value;

    var listTournament = document.getElementById('tournamentSelect');

    for (i = 0; i < listTournament.length; i++) {
        if (listTournament.options[i].dataset.sport == sportSelected) {

            listTournament.options[i].classList.remove('d-none');
        } else {
            if (listTournament.options[i].dataset.choose == 0) {
                listTournament.options[i].classList.remove('d-none');
                listTournament.options[i].selected = 'selected';
            } else {
                listTournament.options[i].classList.add('d-none');

            }
        }

    }
}

function emptyInput()
{
    $input = document.getElementById("max_teams");
    $input.value = 12
}
