<div class="container p-3">
    <a href="leerPosts.php"><i style="font-size: 36px;" class="fa fa-arrow-left botonsPosts"></i></a>
    <div class="row justify-content-center align-items-center">
    <?php
          $esMio = ($post->getAutor()===$_SESSION['usuarioLogeado']['usuario']) ? true : false;

          if($esMio){?>
          <div class="col-4 col-md-6 col-sm-12">
            <a class="btn btn-outline-success w-40 mr-1 mt-1 botonsPosts" href="crearPost.php?id=<?php echo $post->getId();?>&titulo=<?php echo $post->getTitulo();?>&texto=<?php echo $post->getTexto();?>&img=<?php echo $post->getImg();?>" >Editar <i style="font-size: 20px;" class="fa fa-edit"></i></a>
            <a class="btn btn-outline-danger w-40 ml-1 mt-1 botonsPosts" href="eliminarPost.php?id=<?php echo $post->getId();?>&img=<?php echo $post->getFolderImages();?>" >Eliminar <i style="font-size: 20px;" class="fa fa-trash"></i></a>
          </div>
            <?php
          }
          ?>
          <div class="col-12">
              <h1><?php echo $post->getTitulo(); ?></h1>
              <img style="background-color: gray;" src="<?php echo $post->getFolderImages(); ?>" alt="Foto principal" height="200px"/><br/>
              <i>Creado por <strong> <?php echo ($esMio) ? "ti" : $post->getAutor(); ?></strong></i><br/>
              <h5><?php echo $post->getTexto(); ?></h5>

          </div>
    </div>
</div>
