<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Raza</title>
  <!-- Bootstrap 5.2.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <!-- Cabecera -->
    <div class="row mt-5 text-center">
      <h3>Superhéroes - organizado por razas</h3>
      <p>Reportes PDF</p>
    </div>

    <!-- Filtro -->
    <div class="row">
      <div class="col-md-12">
        <!-- Inicio Card -->
        <div class="card">
          <div class="card-header bg-primary bg-opacity-25  text-dark ">
            Filtro por razas
          </div>
          <!-- Inicio de Body -->
          <div class="card-body">
            <div class="row gap-3 align-items-center">
              <div class="col-md-auto flex-grow-1">
                
                <select name="raza" id="raza" class="form-select" autofocus>
                  <option value="">Seleccione</option>
                </select>
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
            <col width="20%">
            <col width="20%">
            <col width="45%">
          </colgroup>
          <thead class="table-info">
            <tr>
              <th>ID</th>
              <th>Nick</th>
              <th>Nombre</th>
              <th>Casa</th>
              <th>Alineción</th>
              <th>Altura</th>
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
      const selectRazas = document.querySelector("#raza");
      const btnGenerarPDF = document.querySelector("#generarpdf");
      const tabla = document.querySelector("#tabla-superhero tbody");

      function listarRaza() {
        fetch(`../controllers/race.php?op=listarRaza`)
          .then(respuesta => respuesta.json())
          .then(datos => {
           /*  console.log(datos) */
            datos.forEach(element => {
              const optionTag = document.createElement("option");
              optionTag.value = element.id;
              optionTag.text = element.race;
              selectRazas.appendChild(optionTag);
            });
          });
      }

      function getByRaces(){
        
        const parametros = new URLSearchParams();
        parametros.append("op", "listarPorRazas");
        parametros.append("race_id", selectRazas.value);

        fetch(`../controllers/superhero.php?${parametros}`)
        .then(respuesta => respuesta.json())
        .then(datos =>{
          tabla.innerHTML = ``;
          datos.forEach(element =>{
            const registro = `
            <tr>
              <td>${element.id}</td>
              <td>${element.superhero_name}</td>
              <td>${element.full_name}</td>
              <td>${element.publisher_name}</td>
              <td>${element.alignment}</td>
              <td>${element.height_cm}</td>
            </tr> 
            `;


            tabla.innerHTML += registro;
          });
        });

      }
      
        selectRazas.addEventListener("change",getByRaces);

      listarRaza();
    
    });
    
  </script>

</body>

</html>