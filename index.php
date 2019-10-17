<?php
    session_start();
    require_once("functions/config.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <title><?php echo SITE_NAME . " - " . SITE_DESC; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">

    <!-- Global CSS -->
    <?php cssArray(); ?>

    <?php prefetchArray(); ?>
    <link rel="canonical" href="<?php echo BASE_URL; ?>">
    <link rel="prefetch">

  </head>
  <body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="img/logo-01-503x200.png" class="img-fluid w-50" alt="">
                    </div>
                    <form method="POST" action="functions/shorten.php">
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-12">
                                <input type="url" id="input" name="url" class="form-control form-control-lg" placeholder="Enter a URL here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-10 input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $url; ?>/</button>
                                    <div class="dropdown-menu">
                                        <?php echo "<a id='domain1' class='dropdown-item' href='" . BASE_URL . "'>" . $url . "</a>"; ?>
                                        <a id="domain2" class="dropdown-item" href="https://bit.my.id/">bit.my.id</a>
                                    </div>
                                </div>
                                <input type="text" id="custom" name="custom" class="form-control" placeholder="Enable custom text" aria-label="Large" aria-describedby="inputGroup-sizing-sm"
                                    disabled>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="toggle()">
                                    <label class="onoffswitch-label" for="myonoffswitch"></label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6Le4UL0UAAAAAI58pD45hd5VBgHxxnFAq3WUnep3"></div>
                            </div>
                        </div> -->
                        <div class="from-group row">
                            <div class="col-sm-12 col-md-12">
                                <?php
                                if (isset($_SESSION['success'])) {
                                    echo "<div class='alert alert-success text-center' role='alert'><h4 class='alert-heading mb-3'><i class='fas fa-check'></i> Your shortened URL</h4>
                                        <div class='input-group'>" . $_SESSION['success'] . "<div class='input-group-append'><button class='btn btn-success' type='button' onclick='copyUrl()'>Copy URL</button></div></div>";
                                    echo "</div>";
                                    unset($_SESSION['success']);
                                }
                                if (isset($_SESSION['error'])) {
                                    echo "<div class='alert alert-danger' role='alert'><i class='fas fa-times-circle'></i> " . $_SESSION['error'] . "</div>";
                                    unset($_SESSION['error']);
                                }
                                if (isset($_GET['error']) && $_GET['error'] == 'db') {
                                    echo "<div class='alert alert-danger' role='alert'><i class='fas fa-times-circle'></i> <strong>Oh snap!</strong> Error in connecting to database!</div>";
                                }
                                if (isset($_GET['error']) && $_GET['error'] == 'inurl') {
                                    echo "<div class='alert alert-danger' role='alert'><i class='fas fa-times-circle'></i> <strong>Warning</strong>Not a valid URL!</div>";
                                }
                                if (isset($_GET['error']) && $_GET['error'] == 'dnp') {
                                    echo "<div class='alert alert-danger' role='alert'><i class='fas fa-times-circle'></i> Ok! So I got to know you love playing! But don't play here!!!</div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-4 offset-md-4">
                                <input type="submit" class="btn btn-danger btn-lg btn-block" value="Go">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include("layout/footer.php"); ?>

    <!-- Global JavaScript -->
    <?php jsArray(); ?>
    <!-- <script defer src="https://www.google.com/recaptcha/api.js"></script> -->
    <script defer type="text/javascript">
      function toggle () {
        if (document.getElementById('myonoffswitch').checked) {
          document.getElementById('custom').placeholder = 'Enter your custom text';
          document.getElementById('custom').disabled = false;
          document.getElementById('custom').focus();
        }
        else {
          document.getElementById('custom').value = '';
          document.getElementById('custom').placeholder = 'Enable custom text';
          document.getElementById('custom').disabled = true;
          document.getElementById('custom').blur();
          document.getElementById('input').focus();
        }
      };
      function copyUrl() {
        /* Get the text field */
        var copyText = document.getElementById("shortUrl");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        swal("Successfuly copied the text!", copyText.value, "success");
      };
    </script>
  </body>
</html>