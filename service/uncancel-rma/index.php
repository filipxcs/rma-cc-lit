<!doctype html>
<html lang="en">

<head>
    <title>Uncancel RMA | CC-lit S.A.</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="">
    <div class="container">
        <div id="alert-on-success" class="alert alert-success alert-dismissible fade show d-none" role="alert">
            <!-- Πρεοσθεσε εδώ το κέιμενο του alert me JS -->
            <span class="text-center" id="alert-success-text"></span>
            <button type="button" class="close alert-close"  aria-label="Κλείσιμο">
                <span aria-hidden="true">&times;</span>
            </button>
    
        </div>
        <div id="alert-on-fail"  class="alert alert-danger alert-dismissible fade show d-none" role="alert">
            <!-- Πρεοσθεσε εδώ το κέιμενο του alert me JS -->
            <div class="text-center" id="alert-fail-text"></div>

            <button type="button" class="close alert-close"  aria-label="Κλείσιμο">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 p-2">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h1>Uncancel RMA</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="">
                            <div class="form-group">
                                <label for="online_rma">Online RMA</label>
                                <!-- If this field empty show -> id="alert-on-fail" and add text "Παρακαλώ συμπληρώστε το πεδίο του Online RMA". If  not empty then start the ajax -->
                                <input type="text" name="online_rma" id="onlibe_rma_field" class="form-control" 
                                    placeholder="Προσθέστε τον αριθμό του ακυρωμένου RMA" aria-describedby="helpId">
                            </div>
                            <button id="submit" name="submit" class="btn btn-primary">Αναίρεση ακύρωσης</input>
                                
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-lg text-primary float-right" data-toggle="modal"
                data-target="#infoModal"><i class="fas fa-question-circle fa-lg"></i>
                <a id='infoPopup' data-toggle="popover" data-trigger="focus" data-placement='right'
                    data-content='Εδώ θα βρείτε πληροφορίες και οδηγίες που αφορούν την χρήση της εφαρμογής.'
                    data-title='Οδηγίες Χρήσης'></a>
            </button>

        </div>

    </div>

    <!-- Info Button -->

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infomodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infomodalLabel">Οδηγίες</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Κλείσιμο">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <h1 id="uncancel-rma">Uncancel RMA</h1>
                    <h2 id="-">Περιγραφή</h2>
                    <hr/>
                    <p>Η εφαρμογή <strong>Uncancel RMA</strong> δημιουργήθηκε με σκοπό να αυτοματοποιηθεί η αναίρεση ακύρωσης συγκεκριμένων RMA που έχει παρέλθει η ημερομηνία αποστολής - παραλαβής τους.</p>
                    <h2 id="-">Χρήση</h2>
                    <ul>
                    <li><p>Για να κάνουμε αναίρεση της ακύρωσης είναι απαραίτητο να γνωρίζουμε τον online αριθμό του RMA.</p>
                    <li>Η εφαρμογή <strong>Uncancel RMA</strong> θα βρει <strong>ΟΛΑ</strong> τα προϊόντα που ανήκουν στο online RMA και θα ελέγξει την κατάσταση τους. Σε περίπτωση που το status τους είναι <code>Ακυρωμένο</code> θα τα επαναφέρει στο status <code>Δήλωση</code>.</li>
                    </li>
                    <li><p>Προσθέτουμε τον online αριθμό RMA στο πεδίο και πατάμε <code>Αναίρεση ακύρωσης</code></p>
                    </li>
                    </ul>
                    <h2 id="-">Σημαντικές Σημειώσεις</h2>
                    <ul>
                    <li>Κάνουμε αναίρεση ακύρωσης μόνο όταν έχουμε την δυνατότητα παραλαβής των προϊόντων. Σε περίπτωση που δεν ολοκληρωθεί η παραλαβή το RMA θα αποκτήσει status ακυρωμένο την επόμενη ημέρα στις <strong>9:00 π.μ.</strong>.</li>
                    <li>Δεν μπορούμε να κάνουμε αναίρεση ακύρωσης σε μεμονωμένα προϊόντα ενός online RMA μέσω της εφαρμογής. Για το συγκεκριμένο task είναι απαραίτητη η δημιουργία ticket  στο <a href="ticket.cc-lit.gr">ticket.cc-lit.gr</a></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Κλείσιμο</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>

        //Help Button Popup
        $(function () {
            $("#infoPopup").popover('show');
        });

        /**
         *  Function to show error and success messages.
         *  @params string: "success", "fail"
         */

        function alertNotification(type,text){
            if(type == "success") {
                $("#alert-success-text").text(text);
                $("#alert-on-success").removeClass('d-none');
            }else{
                $("#alert-fail-text").text(text);
                $('#alert-on-fail').removeClass('d-none');
            }
            setTimeout(function(){  $("#alert-on-success").addClass('d-none'); 
                $("#alert-on-fail").addClass('d-none');}, 10000);
        }
        $('.alert-close').click(function(e) {
            e.preventDefault();
            $("#alert-on-success").addClass('d-none'); 
            $("#alert-on-fail").addClass('d-none');
        });


        $("html").on("mouseup", function (e) {
            var l = $(e.target);
            if (l[0].className.indexOf("popover") == -1) {
                $(".popover").each(function () {
                    $(this).popover("hide");
                });
            }
        });


        $('#submit').click(function (e) {
            e.preventDefault();
            online_rma_data = $('#onlibe_rma_field').val();
            if(online_rma_data == "" || online_rma_data == undefined){
                alertNotification('fail',"Παρακαλώ συμπληρώστε το πεδίο του 'Online RMA'",10000)
                
            }else{
                $.ajax({
                    type: "POST",
                    url: "includes/auto_uncancel.php",
                    data: {
                        online_rma : online_rma_data,
                    },
                    success: function (response) {
                        $('#onlibe_rma_field').val("");
                        if (response != 'Δεν υπάρχουν ακυρωμένα RMAs') {
                            alertNotification('success', response, 10000);
                        }
                        alertNotification('fail', response, 10000);

                    }
                });
            }


        });
    </script>
</body>

</html>