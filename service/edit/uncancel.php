<!-- /**
 * @author [Ioannes Lazaridi]
 * @email [ioannis.lazaridis@cc-lit.gr]
 * @create date 2021-02-11 13:07:37
 * @modify date 2021-02-11 13:07:37
 * @desc [This is the view for the page uncancel RMA.]
 */ -->
<!doctype html>
<html lang="el">

<head>
    <title>Uncancel RMA | CC-lit S.A.</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css"> -->
</head>
<style>
      table.center {
    margin-left:auto; 
    margin-right:auto;
  table-layout: fixed;
  width: 50%;
    margin: 0px auto;
    float: none;
  }
</style>
<body style="background-color:#CAD8E5">
    <div class="container-uncancel" style="text-align: center;">
        <div id="alert" class="">
            <!-- Πρεοσθεσε εδώ το κέιμενο του alert me JS -->
            <div id="rmaid" hidden><?php echo $rmaid ?></div>
            <span class="" style="text-align:center" id="alert-text"></span>
        </div>
        <div class="uncancel-title" style="color:#0000CD;">
            <h1>Αναίρεση Ακύρωσης RMA</h1>
        </div>
        <form  method="POST">
        <div id="rmaids_list">
            <table class=" table table-hover center table-sm " style ="text-align:center">
                <thead>
                    <tr>
                        <th>RMA</th>
                        <th>Online</th>
                        <th>Προϊόν</th>
                        <th>S/N</th>
                        <th>Πελάτης</th>
                    </tr>
                </thead>
                <tbody id="rmaids_tbody">

                </tbody>
            </table>
        </div>
            <br>
            <button id="submit" name="submit" class=" btn-default uncancel-button-submit">Αναίρεση ακύρωσης</button>

        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->

    <script>
        function getRmaIds() {
            rmaid = $('#rmaid').text();
            rmaid_data = $.ajax({
                type: "POST",
                url: "uncancel1.php",
                data: {
                    rmaid : rmaid,
                },
                dataType: "json",
                success: function (response) {
                    $('#rmaids_tbody').html('');
                    for (let index = 0; index < response.length; index++) {
                        const rma_id = response[index].rma_id;
                        const online = response[index].online;
                        const codcode = response[index].codcode;
                        const sn = response[index].sn;
                        const leename = response[index].leename;
                        $('#rmaids_tbody').append('<tr><td><input type="checkbox" id="'+rma_id+'" class="rmaid_checkbox form-check-input" value ="'+rma_id+'"name="'+rma_id+'"><label for="'+rma_id+'">  '+rma_id+'</label></td><td>'+online+'</td><td>'+codcode+'</td><td>'+sn+'</td><td>'+leename+'</td></tr>');
                    }
                }
            });
        }
        $(document).ready(function () {
            getRmaIds();
        });

        $('#submit').on('click', function (e) {
            e.preventDefault();
            var selected_rmaids = [];
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("Πρέπει να επιλέξετε τουλάχιστον ένα RMA.");
                return false;
            }else{
                $('input[type="checkbox"]:checked').each(function () {
                    selected_rmaids.push($(this).val());
                });
                
                $.ajax({
                    type: "POST",
                    url: "auto_uncancel.php",
                    data: {
                        selected_rmaids : selected_rmaids,
                     },
                    dataType: "json",
                    success: function (response) {
                        uncanceled_rmaid_array = response;
                        alert('Εγινε αναίρεση της ακύρωσης στα παρακάτω RMA\n' + JSON.stringify(uncanceled_rmaid_array));
                        getRmaIds()
                        
                    }
                });
            }

        });
    </script>
</body>
</html>