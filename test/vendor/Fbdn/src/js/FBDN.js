/**

 * 

 */
; (function ($) {

    const Config = {

        Carthtml: {
            content: '<img src="img/gif/cart.gif" class= "img-fluid" />\
                <div class= "btnActionCart col-md-12 text-center" >\
                      <button type = "button" class= "btn btn-secondary p-2" data-dismiss="modal"> Continua gli Acquisti</button >\
                      <a href="carrello.php" class="btn btn-primary p-2" >\
                      <i class="fas fa-euro-sign" ></i> Vai alla Cassa</a>\
                </div >',
        },

        modalEmptyCart: {
            content: '<div>Sei Sicuro di Voler Svuotare il Carrello?</div>\
                <div class= "btnActionCart col-md-12 text-center" >\
                      <button type = "button" class= "btn btn-secondary p-2" data-dismiss="modal">Annulla</button >\
                      <button type="button" class="btn btn-danger">Svuota il Carrello</button>\
                </div >',
        },
    };

    cartAction = (action, product_code) => {

        var queryString = "";

        if (action != "") {

            switch (action) {

                case "add":

                    queryString = 'action=' + action + '&idcorso=' + product_code + '&quantity=' + $("#qty_" + product_code).val() + '&price=' + $("#cart-item-price").val() + '&indirizzo=' + $("#cart-item-address").val() + '&datainizio=' + $("#cart-item-date").val();

                    break;

                case "remove":

                    queryString = 'action=' + action + '&code=' + product_code;

                    break;

                case "empty":

                    queryString = 'action=' + action;

                    break;

            }

        }

        $.ajax({

            url: "ajax.php",

            data: queryString,

            type: "POST",

            success: function (data) {



                if (action != "") {

                    switch (action) {

                        case "add":
                            $.ajax({

                                url: 'include/updateCart.php',

                                type: "GET",

                                success: function (Count) {

                                    $('.cartCount').text(Count);

                                    $('#cart').modal('show');
                                    $('#cart').on('shown.bs.modal', function (e) {
                                        var modal = $(this);
                                        modal.find('.modal-body').html(Config.Carthtml.content);
                                    })

                                }

                            });

                            break;

                        case "remove":

                            $.ajax({

                                url: 'include/updateCart.php',

                                type: "GET",

                                success: function (Count) {

                                    var result = confirm("Sei Sicuro di Voler Eliminare il Corso?");

                                    if (result == true) {

                                        $('.cartCount').text(Count);
                                        window.location.reload();
                                    } else {

                                        return;

                                    }

                                }

                            });

                            break;

                        case "empty":
                            $.ajax({

                                url: 'include/updateCart.php',

                                type: "GET",

                                success: function (Count) {

                                    var result = confirm("Sei Sicuro di Voler Svuotare il Carrello?");

                                    if (result == true) {

                                        $('.cartCount').text(Count);
                                        window.location.reload();
                                    } else {

                                        return;

                                    }

                                }

                            });
                            break;



                    }
                }

            },

        });

    }
    $('[data-toggle="tooltip"]').tooltip();

})(jQuery);