
<?php if(sizeof($posts) == 0){?>
<div class="container p-3">
  <div class="alert alert-danger" role="alert">
    <p class="text-center">Aún no hay posts registrados en la web...</p>
</div>
</div>
<?php
}else{
  ?>
  <div class="container p-3">
  <div class="row justify-content-center align-items-center">
    <?php
        foreach($posts as $post){
          $esMio = ($post->getAutor()===$_SESSION['usuarioLogeado']['usuario']) ? true : false;
          ?><div class="col-3 col-sm-12 col-md-6 col-lg-4 col-xl-3 <?php if($esMio){ echo "mt-5"; } ?>">
            <a href="visorPosts.php?id=<?php echo $post->getId(); ?>&titulo=<?php echo $post->getTitulo(); ?>&texto=<?php echo $post->getTexto(); ?>&autor=<?php echo $post->getAutor(); ?>&img=<?php echo $post->getImg(); ?>">
            <img style="background-color: gray;" src="<?php echo $post->getFolderImages();?>" alt="Foto principal" height="150px"/><br/>
            <i>Creado por <strong> <?php echo ($esMio) ? "ti" : $post->getAutor(); ?></strong></i><br/>
            <h3><?php echo $post->getTitulo();?></h3>
            <p><?php echo substr($post->getTexto(), 0, 20);if(strlen($post->getTexto())>20){ echo "..." ; }?></p>
          </a>
            <?php
            if($esMio){?>
              <a class="btn btn-success w-40 mt-1 mr-1 blancoTexto botonsPosts" href="crearPost.php?id=<?php echo $post->getId();?>&titulo=<?php echo $post->getTitulo();?>&texto=<?php echo $post->getTexto();?>&img=<?php echo $post->getImg();?>" ><i style="font-size: 20px;" class="fa fa-edit"></i> Editar</a>
              <a class="btn btn-danger w-40 mt-1 ml-1 blancoTexto botonsPosts" href="eliminarPost.php?id=<?php echo $post->getId();?>&img=<?php echo $post->getFolderImages();?>" ><i style="font-size: 20px;" class="fa fa-trash"></i> Eliminar</a>
            <?php
            }
            ?>
          </div>
 <?php  }
      }
?>
</div>
</div>
