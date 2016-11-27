<!DOCTYPE html>
<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
 ?>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/creative.css" rel="stylesheet">
    <link href="css/registration.css" rel="stylesheet">
    <link rel="stylesheet" href="css/card.css">

    <script type="text/javascript" src="scripts/card.js"></script>
    <script src='scripts/updateDB.js' type='text/javascript'></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- If you're using Stripe for payments -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-12 col-md-4">


            <!-- CREDIT CARD FORM STARTS HERE -->
<form action="finish.html">
    <div class="panel panel-default credit-card-box">
        <div class="panel-heading display-table" >
            <div class="row display-tr" >
                <h3 class="panel-title display-td" >Payment Details</h3>
                <div class="display-td" >
                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                </div>
            </div>
        </div>
        <hr style="width: 70%;">
        <div class="panel-body">
            <form role="form" id="payment-form">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="first_pay_group" class="form-group">
                            <label for="cardNumber">CARD NUMBER</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="cardNumber"
                                    placeholder="Valid Card Number"
                                    autocomplete="cc-number"
                                    pattern=".{3,}"
                                    required autofocus
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7 col-md-7">
                        <div class="form-group">
                            <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                            <input
                                type="text"
                                class="form-control"
                                name="cardExpiry"
                                placeholder="MM / YY"
                                autocomplete="cc-exp"
                                pattern="[0-1]/[0-2][0-9]"
                                required
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="cardCVC">CV CODE</label>
                            <input
                                type="number"
                                class="form-control"
                                name="cardCVC"
                                placeholder="CVC"
                                autocomplete="cc-csc"
                                required
                            />
                        </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
<a href="finish.html"><button type="button" class="btn btn-primary btn-xl" onclick='saveSeats(<?php echo json_encode($_SESSION); ?>)'>
Finish Payment        </button></a>

                 </div>
                </div>
                <div class="row" style="display:none;">
                    <div class="col-xs-12">
                        <p class="payment-errors"></p>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</form>
            <!-- CREDIT CARD FORM ENDS HERE -->


        </div>
    </div>
</body>
</html>
