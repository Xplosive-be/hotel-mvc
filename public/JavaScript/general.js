function validateDates(event) {
    var dateBegin = document.getElementsByName('dateBegin')[0];
    var dateEnd = document.getElementsByName('dateEnd')[0];
    var dateBeginValue = new Date(dateBegin.value);
    var dateEndValue = new Date(dateEnd.value);

    if (dateEndValue <= dateBeginValue) {
        alert("La date d'arrivée doit être au moins un jour après la date de départ.");
        event.preventDefault();
        return;
    }

    if (dateBeginValue.getTime() === dateEndValue.getTime()) {
        alert("La date de départ ne peut pas être égale à la date d'arrivée.");
        event.preventDefault();
        return;
    }

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    if (dateBeginValue.getTime() === tomorrow.getTime()) {
        alert("La date d'arrivée sélectionnée ne peut pas être sélectionnée comme date de départ.");
        event.preventDefault();
        return;
    }
}