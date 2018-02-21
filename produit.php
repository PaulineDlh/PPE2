<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Produi</title>
    <link rel="icon" href="./assets/img/logoIcon.gif"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  </head>
  <body>
    <?php include 'nav.php'; ?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img src="assets/img/poulpe1.jpg" style="width:200px;height:165px;margin:100px;"></div>
                    <div>
                      <img src="assets/img/poulpe2.jpg" style="height:80px;margin:3px;width:80px;">
                      <img src="assets/img/poulpe3.jpg" style="margin:3px;width:80px;height:80px;">
                      <img src="assets/img/poulpe4.jpg" style="margin:3px;width:80px;height:80px;">
                      <img src="assets/img/poulpe5.jpg" style="margin:3px;height:80px;width:80px;">
                      <img src="assets/img/poulpe6.jpg" style="margin:3px;height:80px;width:80px;">
                    </div>
                </div>
                <div class="col-md-6">
                    <aside style="height:200px;">
                        <div>
                            <h1 class="text-center text-primary" style="padding:11px;margin:4px;">TITRE </h1>
                        </div>
                        <div>
                            <h1 style="font-size:22px;">Heading (0 en stock)&nbsp;</h1>
                        </div>
                        <div>
                            <div style="width:201px;">
                                <h1 class="text-dark" style="font-size:22px;width:109px;margin:6px;height:28px;float:left;">Quantité</h1>
                                <select style="height:25px;width:40px;margin-right:4px;margin-left:147px;min-height:-1px;">
                                  <option value="" selected="">1</option>
                                  <option value="">2</option>
                                  <option value="">3</option>
                                  <option value="">4</option>
                                  <option value="">5</option>
                                  <option value="">6</option>
                                  <option value="">7</option>
                                  <option value="">8</option>
                                  <option value="">9</option>
                                </select>
                              </div>
                            <div style="width:200px;">
                                <h1 class="text-dark" style="font-size:22px;width:109px;margin:6px;height:28px;float:left;">Taille</h1>
                                <select style="height:25px;width:53px;padding:0px;margin-top:0px;margin-bottom:0px;min-height:-1px;">
                                  <option value="" selected="">XS</option>
                                  <option value="">S</option>
                                  <option value="">M</option>
                                  <option value="">L</option>
                                  <option value="">XL</option>
                                  <option value="">XXL</option>
                                </select>
                              </div>
                            </div>
                            <div>
                    <h1 style="font-size:22px;">PRIX</h1>
                </div><button class="btn btn-primary" type="button">Button</button></aside>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div>
                        <h1>Descrption</h1>
                    </div>
                    <div>
                        <p>ParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagrapeParagraph</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>

 </body>
 </html>
