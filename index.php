<?php
session_start();
error_reporting(0);
if($_GET["twitter"]=="yes"){
$count = file_get_contents("count.txt");
$new = (int)$count+1;
fwrite(fopen('count.txt', "w"), $new);
}
$comb = array("left", "right");
if($_SESSION['c']== 0 || !isset($_SESSION['c'])){
$_SESSION['c'] = 1;
$d = $comb[0];
}else{
$_SESSION['c'] = 0;
$d = $comb[1];

}
$comb1 = array("blue, red", "red, blue");
if($_SESSION['c1']== 0 || !isset($_SESSION['c1'])){
$_SESSION['c1'] = 1;
$e = $comb1[0];
}else{
$_SESSION['c1'] = 0;
$e = $comb1[1];

}
if($_GET['member']=="yes"){
$unstoppable= true;
}
$comb2 = array("blue, cornflowerblue", "red, orange");
if($_SESSION['c2']== 0 || !isset($_SESSION['c2'])){
$_SESSION['c2'] = 1;
$f = $comb2[0];
}else{
$_SESSION['c2'] = 0;
$f = $comb2[1];
}
?>
  <html>

  <head>
    <meta charset="utf-8">
    <title>Faith Checker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Montserrat', sans-serif;
      }

      img {
        padding-left: 20px;
      }

      table,
      td {
        text-align: center;
      }

      .greetings {
        padding-top: 10px;
      }
    </style>
  </head>

  <body style="background-image: linear-gradient(to bottom <?php echo $d;?>, red, blue);">
    <div class="container-fluid">
      <div class="text-center">
        <h1 style="background: -webkit-linear-gradient(<?php echo $f;?>);-webkit-background-clip: text;-webkit-text-fill-color: transparent;" class="greetings">Faith Checker</h1>
      </div>
      <div class="row">
        <div style="margin-bottom: 10px;margin-top: 30px;" class="col-sm-12">
          <div class="card border-primary mb-12">
            <div class="card-header success"></div>
            <div class="card-body text-center">
              <div class="row">
                <div class="row col-lg-12">
                  <div class="col-sm-12">
                    <p>Cards</p>
                    <textarea class="form-control" id="ccs" rows="3" cols="50" placeholder="XXXXXXXXXXXXXXXX|XX|XXXX|XXX"></textarea><br>
                  </div>
                </div>
                <div class="row col-lg-12">
                  <div class="col-sm-6">
                    <p>Proxies (Optional)</p>
                    <textarea class="form-control" id="proxies" rows="3" cols="50" placeholder="XXX.XXX.XXX.XXX:XXXX"></textarea><br>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-12">
                        <p>Proxy Type</p>
                        <select class="form-control" id="typepr">
                        <option value="https">HTTP/HTTPs</option>
                        <option value="socks4">Socks 4</option>
                        <option value="socks5">Socks 5</option>
                      </select>
                      </div>
                    </div>
                  </div>
                </div>
                <br><button class="btn btn-danger btn-block" onclick="start()">Start</button>
              </div>
            </div>
          </div>
        </div>
        <div style="padding-bottom: 30px;margin-top:40px" class="col-sm-12">
          <div class="card border-primary mb-12">
            <div class="card-header success">
              <div class="row">
                <div class="text-left col-sm-6">Alive</div>
                <div class="text-right col-sm-6"><button onclick="alsh()" class="btn btn-danger">Show / Hide</button></div>
              </div>
            </div>
            <div class="card-body" style="color:green">
              <div id="b-li" class="row">
                <div class="col-lg-12">
                  <table class="table">
                    <tr align="center">
                      <th>STATUS</th>
                      <th>CARD</th>
                      <th>INFO</th>
                      <th>PROXY</th>
                    </tr>
                    <tbody id="lives">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="padding-bottom: 30px;" class="col-sm-12">
          <div class="card border-primary mb-12">
            <div class="card-header">
              <div class="row">
                <div class="text-left col-sm-6">Dead</div>
                <div class="text-right col-sm-6"><button onclick="desh()" class="btn btn-danger">Show / Hide</button></div>
              </div>
            </div>
            <div class="card-body" style="color:red">
              <div id="b-de" class="row">
                <div class="col-lg-12">
                  <table class="table">
                    <tr align="center">
                      <th>STATUS</th>
                      <th>CARD</th>
                      <th>INFO</th>
                      <th>PROXY</th>
                    </tr>
                    <tbody id="deds">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
  <script title="Some beauty">
    function start() {
      var linha = $("#ccs").val();
      var linhaenviar = linha.split("\n");
      linhaenviar.forEach(function(value, index) {
        setTimeout(
          function() {
            var proxies = $("#proxies").val();
            var proxies = proxies.split("\n");
            var proxy = proxies[Math.floor(Math.random() * proxies.length)];
            var e = document.getElementById("typepr");
            var type = e.options[e.selectedIndex].value;
            $.ajax({
              url: 'api.php?check=' + value + '&proxy=' + proxy + '&prtype=' + type,
              type: 'GET',
              async: true,
              success: function(resultado) {
                if (resultado.match("badge-success")) {
                  removelinha();
                  aprovadas(resultado);
                } else {
                  removelinha();
                  reprovadas(resultado);
                }
              }
            });
          }, 3000 * index);
      });
    }

    function aprovadas(str) {
      $("#lives").append(str);
    }

    function reprovadas(str) {
      $("#deds").append(str);
    }

    function removelinha() {
      var lines = $("#ccs").val().split('\n');
      lines.splice(0, 1);
      $("#ccs").val(lines.join("\n"));
    }

    function alsh() {
      var x = document.getElementById("b-li");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }

    function desh() {
      var x = document.getElementById("b-de");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>

  </html>
  <!--

JavaScript Modified from other Checkers

PHP Code Built from scratch by Blue Penguin

Powered by 

-->