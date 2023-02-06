if (document.readyState === 'complete') {
    console.log("AHAHAH");
}

function edit_row(no) {
    var editButtons = document.getElementsByClassName("edit_button");
    for (var i = 0; i < editButtons.length; i++) {
        editButtons[i].style.display = "none";
    }
    document.getElementById("edit_button" + no).style.display = "none";
    document.getElementById("save_button" + no).style.display = "block";

    var time = document.getElementById("time" + no);
    var contender1 = document.getElementById("contender1_row" + no);
    var contender2 = document.getElementById("contender2_row" + no);
    contender1.style.display = "none";
    contender2.style.display = "none";
    document.getElementById("firstContenderEdit" + no).style.display = "table-cell";

    document.getElementById("secondContenderEdit" + no).style.display = "table-cell";
    document.getElementById("courtEdit" + no).style.display = "table-cell";
    var court = document.getElementById("court" + no);
    court.style.display = "none";
    var DOB = document.createElement("input");
    DOB.setAttribute("type", "time");
    DOB.setAttribute("name", "timeEdited");
    time.append(DOB)
}

function del_row(no) {
    if (document.getElementById("game" + no + "isDeleted").value == 0) {
        row = document.getElementById("tr" + no);
        row.style.backgroundColor = "red";
        document.getElementById("game" + no + "isDeleted").value = 1;
        document.getElementById("trashButton" + no).className = "fas fa-trash-restore fa-lg";
    } else {
        row = document.getElementById("tr" + no);
        row.style.backgroundColor = "white";
        document.getElementById("game" + no + "isDeleted").value = 0;

        document.getElementById("trashButton" + no).className = "fa fa-trash fa-lg";
    }
}

