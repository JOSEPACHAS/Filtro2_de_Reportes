<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio02</title>
  <!-- Bootstrap 5.2.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <!-- Cabecera -->
    <div class="row mt-5 text-center">
      <h3>Superhéroes</h3>
      <p>Reportes PDF</p>
    </div>

    <!-- Filtro -->
    <div class="row">
      <div class="col-md-12">
        <!-- Inicio Card -->
        <div class="card">
          <div class="card-header bg-primary bg-opacity-25  text-dark ">
            Filtro De Altura
          </div>
          <!-- Inicio de Body -->
          <div class="card-body">
            <div class="row gap-3 align-items-center">
              <div class="col-md-auto flex-grow-1">
                <label for="casas" class="form-label">Lista SuperHero</label>
                <select name="casas" id="casas" class="form-select" autofocus>
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="col-md-auto flex-grow-1">
                <label for="" class="form-label">Indicar Altura Maxima y Minima:</label>
                <div class="row gap-3">
                  <div class="col-md-auto flex-grow-1">
                    <input type="number" class="form-control" id="alturamin" placeholder="min">
                  </div>
                  <div class="col-md-auto flex-grow-1">
                    <input type="number" class="form-control" id="alturamax" placeholder="max">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer text-end">
            <button type="button" id="generarpdf" class="btn btn-info">Generar PDF</button>
          </div>
          <!-- Fin de Body -->
        </div>
        <!-- Fin Card -->
      </div>
    </div>

    <!-- Datos - Tabla -->
    <div class="row mt-4">
      <div class="col-md-12">
        <table class="table table-striped table-sm" id="tabla-superhero">
          <colgroup>
            <col width="10%">
            <col width="20%">
            <col width="25%">
            <col width="10%">
            <col width="10%">
            <col width="25%">
          </colgroup>
          <thead class="table-danger">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Bando</th>
              <th>Altura(cm)</th>
              <th>Peso(kg)</th>
              <th>Casa Distribuidora</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5.2.3 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const selectCasas = document.querySelector("#casas");
      const inputAlturaMin = document.querySelector("#alturamin");
      const inputAlturaMax = document.querySelector("#alturamax");
      const btnGenerarPDF = document.querySelector("#generarpdf");
      const cuerpoTabla = document.querySelector("#tabla-superhero tbody");
      let filtroPDF = -1;

      function listarCasaDistribuidora() {
        fetch(`./controllers/publisher.php?op=listarCasaDistribuidora`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option");
              optionTag.value = element.id;
              optionTag.text = element.publisher_name;
              selectCasas.appendChild(optionTag);
            });
          });
      }

      function listarFiltrosSuperheroes() {
        const parametros = new URLSearchParams();
        parametros.append('op', 'listarPublisherHeight');
        parametros.append('publisher_id', parseInt(selectCasas.value));
        parametros.append('height_min_cm', inputAlturaMin.value);
        parametros.append('height_max_cm', inputAlturaMax.value);

        fetch(`./controllers/superhero.php?${parametros}`)
          .then(respuesta => respuesta.text())
          .then(datos => {
            let i = 1;

            if (!datos || datos.length === 0) {
              alert('No hay datos disponibles.');
              cuerpoTabla.innerHTML = '';
              // selectBandos.value = 0;
              inputAlturaMin.value = '';
              inputAlturaMax.value = '';
              filtroPDF = -1;
            } else {
              registro = JSON.parse(datos);
              cuerpoTabla.innerHTML = '';
              filtroPDF = 1;

              registro.forEach(element => {
                let tableRow = `
                  <tr>
                    <td>${i++}</td>
                    <td>${element['superhero_name']}</td>
                    <td>${element['alignment']}</td>
                    <td>${element['height_cm']}</td>
                    <td>${element['weight_kg']}</td>
                    <td>${element['publisher_name']}</td>
                  </tr>        
                `
                cuerpoTabla.innerHTML += tableRow;
              });
            }
          })
          .catch(e => {
            console.log(e);
          });
      }
      function generarpdf(){
        if(inputAlturaMin.value == "" && inputAlturaMax.value == ""){
          alert("Debes ingresar una altura para generar el PDF");
        }else if(filtroPDF > 0){
          // mandamos los parammetros a la url que nos genera pdf 
          const parametros = new URLSearchParams();
          parametros.append("publisher_id", selectCasas.value)
          parametros.append("height_min_cm", inputAlturaMin.value)
          parametros.append("height_max_cm", inputAlturaMax.value)
          parametros.append("titulo", selectCasas.options[selectCasas.selectedIndex].text)
          
          // abrimos en una ventana aparte el PDF generado 
          window.open(`./reports/filtro2/reporte.php?${parametros}`, '_blank')
          
        }
      }
      // selectCasas.addEventListener("change", listarFiltrosSuperheroes);
      inputAlturaMax.addEventListener("keypress", (e) => {
        if (e.charCode == 13) listarFiltrosSuperheroes();
      });
      btnGenerarPDF.addEventListener('click', generarpdf)
      listarCasaDistribuidora();
    });
  </script>
</body>

</html>