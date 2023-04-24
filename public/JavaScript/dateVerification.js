function compareDates() {
    var dateBegin = document.getElementById("dateBegin").value;
    var dateEnd = document.getElementById("dateEnd").value;

    if (dateBegin > dateEnd || dateBegin == dateEnd ) {
        alert("La date de départ doit être antérieure à la date d'arrivée.");
        return false;
    } else {
        return true;
    }
}
