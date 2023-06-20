<div class="container text-center">
    <h2 class="text-xl"><?= $titulo?></h2>
    <p>Generado desde Backend</p>
</div>

<div class="container mt-3">
    <?php
      function crearTabla($casa = ""){
        $nuevaTabla = "
           <h4 class='mb-1 mt-3'>{$casa}</h4>
          <table class='table table-border mb-3'>
            <colgroup>
              <col style='width:10%;'>
              <col style='width:25%;'>
              <col style='width:30%;'>
              <col style='width:20%;'>
              <col style='width:15%;'>
            </colgroup>
          <thead>
            <tr class='bg-success mb-2 '>  
                <th>ID</th>
                <th>Nick</th>
                <th>Nombre</th>
                <th>Alineción</th>
                <th>Altura</th>
            </tr>
          </thead>
          <tbody>
       ";
        echo $nuevaTabla;
      }

      function cerrarTabla(){
          $cerrarTabla ="
          </tbody>
        </table>
     
        ";
       echo $cerrarTabla; 
       echo "<h1 class='mt-3 text-end'>TOTAL: X</h1>";
      }
     
      function agregarFila($arreglo){
        echo"
        <tr>
          <td>{$arreglo['id']}</td>
          <td>{$arreglo['superhero_name']}</td>
          <td>{$arreglo['full_name']}</td>
          <td>{$arreglo['alignment']}</td>
          <td>{$arreglo['height_cm']}</td>
        </tr>   
      ";
      } 
      
      function escribirSubtitulos($casa= ""){
        echo "<h4>{$casa}</h4>";
      }
      
    
      //FIN HERLPERS

      //contabiliza/ cuenta la cantidad de registro objetivo  
      if(count($datos) > 0){
        $casaActual = $datos[0]["publisher_name"];
        
        //creamos la primera tabla/cabecera
        
        crearTabla($casaActual);
     
        foreach($datos as $registro){
          if($casaActual == $registro["publisher_name"]){
            //Agregamos a la tabla actual
            agregarFila($registro);
          }else{  
              //cerrar la tabla anterior, crear una nueva, actualizar la $casaActual
              
              cerrarTabla();
              
             crearTabla($casaActual);
            $casaActual = $registro["publisher_name"];

            //agregamos el registo a la nueva tablaHTML
            agregarFila($registro);
          }
          
        }
         cerrarTabla();
      
      }else{
        echo "<h3 class='mt-3'>No encontramos registros</3>";
      }



     
    ?>
 
</div>
