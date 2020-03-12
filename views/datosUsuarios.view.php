<div class="container p-3">
  <table class="table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Contraseña 2</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $usuarioActual['nombre'];?></td>
        <td><?php echo $usuarioActual['apellidos'];?></td>
        <td><?php echo $usuarioActual['usuario'];?></td>
        <td><?php echo $usuarioActual['pass'];?></td>
        <td><?php echo $usuarioActual['pass2'];?></td>
      </tr>
    </tbody>
  </table>
</div>
