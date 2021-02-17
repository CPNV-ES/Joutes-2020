sportSelect.addEventListener('change', selection);

function selection() {
    console.log('yoyo');

    var listSport = document.getElementById('sportSelect');
    var sportSelected = listSport.options[listSport.selectedIndex].value;
    console.log(sportSelected);

    var listTournament = document.getElementById('tournamentSelect');
    console.log(listTournament.length);

    for (i = 0; i < listTournament.length; i++) {
        if(listTournament.options[i].dataset.sport == sportSelected){

            console.log(listTournament.options[i].dataset.sport);
            listTournament.options[i].classList.remove('d-none');
        }else{
            if(listTournament.options[i].dataset.choose == 0){
                listTournament.options[i].classList.remove('d-none');
                listTournament.options[i].selected = 'selected';
            }else {
                listTournament.options[i].classList.add('d-none');

            }
        }
        //tournament = listTournament.options[i].getAttribute('data-sport');
        //console.log(tournament);
        //tournament.classList.add('d-block')
    }

    /*var catOptions = "";
    if(valeur == "Choose"){
        catOptions += "<option>--- Choisissez ---</option>";
        document.getElementById("tournamentSelect").innerHTML = catOptions;
    }
    else {
        for (i = 0; i < tournaments.length; i++) {

            if (tournaments[i].sport_id == valeur) {

                console.log(tournaments[i].sport_id);
                console.log(valeur);

                console.log('Its ok')

                catOptions += "<option value='" + tournaments[i].id + "' >" + tournaments[i].name + "</option>";
            }
        }
        document.getElementById("tournamentSelect").innerHTML = catOptions;
    }*/
}
