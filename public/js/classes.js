document.addEventListener('DOMContentLoaded', init);
function init() {
    checkall = document.getElementById('checkAll')
    checkall.addEventListener('click', checkAll);
    uncheckall = document.getElementById('uncheckAll')
    uncheckall.addEventListener('click', uncheckAll);
}
function checkAll() {
    var checkboxes = document.getElementsByClassName('classesboxes');
    checkall.style.display = "none";
    uncheckall.style.display = "block";
    for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
    }
}
function uncheckAll() {
    uncheckall.style.display = "none";
    checkall.style.display = "block";
    var checkboxes = document.getElementsByClassName('classesboxes');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
    }
}

