<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <title>Registration form</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main/style.css">
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
  <header style="margin-bottom: 150px;">
    <?php require '../main/meta.php'; ?>
    <?php require '../main/nav.php'; ?>
    <?php require '../main/header.php'; ?>
  </header>

    <div class="container">
      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Personal Information - Customer</h4>
          <form class="needs-validation" action="validation.php?reg=customer" method="post" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" name="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email ( used for login )</label>
              <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="pass">Password</label>
              <input type="password" class="form-control" name="pass" placeholder="abc123" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-6">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your address.
              </div>
            </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">City</label>
                <input type="text" class="form-control" name="city" placeholder="" required>
                <div class="invalid-feedback">
                  City required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="eula" required>
              <label class="custom-control-label" for="eula">I agree with the terms of service</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="row">
              <div class="col-md-6 my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="ideal" checked required>
                <label class="custom-control-label" for="credit">IDeal</label>
              </div>
            </div>
            <div class="col-md-5 mb-3">
                <label for="country">Bank</label>
                <select class="custom-select d-block w-100" name="bank" required>
                  <option value="">Choose...</option>
                  <option value="rabo">Rabobank</option>
                  <option value="ing">ING</option>
                  <option value="abna">ABN Amro</option>
                  <option value="knab">Knab</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid bank.
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" name="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-number">IBAN Number</label>
                <input type="text" class="form-control" name="cc-iban" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Card Number</label>
                <input type="number" class="form-control" name="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn offset-md-11" type="submit">Register</button>
          </form>
        </div>
      </div>
    </div>

    <footer>
      <?php require '../main/footer.php'; ?>
    </footer>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
