<div class="container text-center">
    <h2><?= $_GET['titulo'] ?></h2>
    <p>Generado desde Backend</p>
</div>

<div class="container mt-3">
  <table class="table table-border">
    <colgroup>
      <col style="width:5%;">
      <col style="width:20%;">
      <col style="width:35%;">
      <col style="width:20%;">
      <col style="width:20%;">
    </colgroup>
    <thead>
      <tr class="bg-primary">  
        <th>#</th>
        <th>Nombre</th>
        <th>Bando</th>
        <th>Altura</th>
        <th>Peso</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $registro): ?>
          <tr>
            <td><?= $registro['id'] ?></td>
            <td><?= $registro['superhero_name'] ?></td>
            <td><?= $registro['alignment'] ?></td>
            <td><?= $registro['height_cm'] ?></td>
            <td><?= $registro['weight_kg'] ?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>