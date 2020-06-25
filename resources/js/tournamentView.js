var canvas
var ctx
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
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });
    });

    canvas = document.getElementById("canvas");
    ctx = canvas.getContext("2d");
    area = tournament.getBoundingClientRect()
    canvas.width = area.width
    canvas.height = area.height
})
