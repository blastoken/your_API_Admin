<?php
if(isset($_SESSION['erroresPost'])){
  $erroresPost=$_SESSION['erroresPost'];
}else{
  $erroresPost = [];
}
?>
<div class="container mt-5">
<?php if(sizeof($erroresPost) > 0){?>
<div class="alert alert-danger" role="alert">
  <strong>Hay problemas...</strong><br/>
  <?php
  foreach ($erroresPost as $key => $value) {
    echo $value."<br/>";
  }
  ?>
</div>
<?php }
  if($esCorrecto){?>
  <div class="alert alert-success" role="alert">
    <strong>Se ha registrado el post correctamente!</strong><br/>
  </div>
  <?php } ?>
  <div class="row justify-content-center align-items-center h-100">
    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
      <form action="crearPost.php" method="post" enctype="multipart/form-data">
          <?php if($edicion){ ?>
            <input type="hidden" id="id" name="id" value="<?php echo $post->getId(); ?>" />
            <input type="hidden" id="imgAnterior" name="imgAnterior" value="<?php echo $post->getFolderImages(); ?>" />
          <?php ;} ?>
          <input type="text" id="titulo" name="titulo" class="form-control text-center mb-1" placeholder="Titulo" value="<?php if($edicion){ echo $post->getTitulo() ;} ?>"/>
          <textarea id="texto" name="texto" class="form-control text-center mb-1" placeholder="Texto del post" rows="10"><?php if($edicion){ echo $post->getTexto() ;} ?></textarea>
          <label >Imagen principal:</label>
          <?php if($edicion){ ?>
            <img src="<?php echo $post->getFolderImages(); ?>" alt="img" height="150px" />
          <?php } ?>
          <input type="file" name="imagen">
          <input <?php if($edicion){ ?> id="editar" type="submit" name="editar" value="Editar" <?php ;}else { ?> id="publicar" type="submit" name="publicar" value="Publicar"<?php } ?>  class="btn btn-primary w-100 mt-1 blancoTexto"/>
      </form>
    </div>
  </div>
