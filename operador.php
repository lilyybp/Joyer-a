<?php
  require('seguridad.php');
?>
<!DOCTYPE html>
<html>
<title>Joyeria Claro - Operador</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="css.css">
<body class="w3-light-grey">
  <div class="w3-bar w3-black w3-hide-small">
    <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-info-circle"></i></a>
  </div>

  <div class="w3-content">
    <header class="w3-container w3-center w3-white">
      <h1 class="w3-xxxlarge"><b>JOYERIA CLARO</b></h1>
    </header>
    <div class="w3-row w3-padding w3-border">
      <div class="w3-col l12 s12">
        <div class="w3-container w3-white w3-margin w3-padding-large">
          <div class="w3-center">
            <h2 style="text-transform: uppercase;">Sergio</h2>
            <h3>8 de Septiembre del 2017</h3>
              <div class="historial">
                <table class="operador">
                  <thead>
                    <tr>
                      <th>Folio</th>
                      <th>Prendas</th>
                      <th>Procesos</th>
                      <th>Tiempo Esp</th>
                      <th>Tiempo transc</th>
                      <th>asd</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td rowspan="2" class="folio">123456</td>
                      <td>Anillo  </td>
                      <td>
                        <ul>
                          <li>Rectificacion</li>
                          <li>Soldadura</li>
                          <li>Limpieza</li>
                        </ul>
                      </td>
                      <td rowspan="2" class="folio">22 min</td>
                      <td rowspan="2" class="folio">15 min</td>
                      <td rowspan="2" class="folio"><input type="submit" value="Terminar" class="button-terminar"></td>
                    </tr>
                    <tr class="final">

                      <td>Esclava</td>
                      <td>
                        <ul>
                          <li>Soldadura</li>
                          <li>Reparar</li>
                        </ul>
                      </td>

                    </tr>
                    <tr>
                      <td rowspan="2" class="folio">123456</td>
                      <td>Anillo  </td>
                      <td>
                        <ul>
                          <li>Rectificacion</li>
                          <li>Soldadura</li>
                          <li>Limpieza</li>
                        </ul>
                      </td>
                      <td rowspan="2" class="folio">22 min</td>
                      <td rowspan="2" class="folio">15 min</td>
                      <td rowspan="2" class="folio"><input type="submit" value="Terminar" class="button-terminar"></td>
                    </tr>
                    <tr class="final">

                      <td>Esclava</td>
                      <td>
                        <ul>
                          <li>Soldadura</li>
                          <li>Reparar</li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  // Toggle between hiding and showing blog replies/comments
  document.getElementById("myBtn").click();
  function myFunction(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else { 
          x.className = x.className.replace(" w3-show", "");
      }
  }

  function likeFunction(x) {
      x.style.fontWeight = "bold";
      x.innerHTML = "✓ Liked";
  }
  </script>

</body>
</html>

