<h1>Liste des articles</h1>
<?php if(Service::checkIfUserIsConnected()):?>
<a href="/?page=article_add">
  <button type="button" class="btn btn-primary" style="position:relative; float: right; margin-bottom:10px;">Créer un
    article</button></a>
<?php endif ?>
<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">PublishedDate</th>
      <th scope="col">Info</th>

    </tr>
  </thead>
  <tbody>
    <?php  foreach ($params['articles'] as $key => $article): ?>
    <tr>
      <th scope="row"><?php echo $article->getId() ?>
      </th>
      <td><?php echo $article->getTitle() ?></td>
      <td><?php echo $article->getContent() ?></td>
      <td><?php echo (new DateTime($article->getPublishedDate()))->format('d-m-Y H:i:s')  ?></td>
      <td><a href="?page=article_show&id=<?php echo $article->getId() ?>">
          <button type="button" class="btn btn-primary">Voir</button></a>
        <!-- Button trigger modal -->
        <?php if(Service::checkIfUserIsConnected()):?>
        <!-- /l'id de l'article stocké dans un data-attribut data-article_id au niveau du bouton /supprimer/ ouvrant la modal et qui ajoute une value -->
        <button type="button" class="btn btn-danger article_supp_deleted" data-bs-toggle="modal"
          data-bs-target="#exampleModal" data-article_id="<?= $article->getId() ?>"> Supprimer
        </button>
        <?php endif ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require_once dirname(__DIR__)."/Articles/templat_part/__deleted_modal.phtml";?>