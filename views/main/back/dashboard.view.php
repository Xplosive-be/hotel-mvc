<h1 class='text-center my-3 text-danger fw-bolder'>Bienvenu(e) <?=  $_SESSION['surname'] . ' ' . $_SESSION['name']?></h1>
<div class="container py-4">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12 col-md-auto mb-3">
            <div class="d-flex flex-column align-items-center p-5 bg-light border border rounded-3 border-3 sizeAdminIcons">
                <a href="profil"><i class="fa-sharp fa-solid fa-user big-icons mb-3" ></i></a>
                <p class="lead">Gérer les clients</p>
            </div>
        </div>
        <div class="col-12 col-md-auto mb-3">
            <div class="d-flex flex-column align-items-center p-5 bg-light border border rounded-3 border-3 sizeAdminIcons">
                <a href="reservationView"> <i class="fa-solid
                fa-calendar-days big-icons mb-3"></i></a>
                <p class="lead">Gérer les réservations</p>
            </div>
        </div>
    </div>
</div>

