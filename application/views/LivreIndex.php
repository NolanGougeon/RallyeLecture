<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('livre/add');?>">Ajouter</a>
     <a href="<?php echo base_url('livre/supprimer');?>">Supprimer</a>
    <?php 
        echo validation_errors();
        echo form_open(base_url('/Livre/recherche'));
        echo form_input('recherche','');
        echo form_submit('Valider','Valider');
        echo form_close();
    ?>
    <br>
    nombre de livre : <?php echo $nbLivre; ?>
</div>
<table>
    <tr>
        <td>#</td>
        <td>titre</td>
        <td>couverture</td>
        <td>id auteur</td>
        <td>id editeur</td>
        <td>id quizz</td>
        <td>image</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($livres as $l) : ?>
        <tr>
            <td><?php echo $l['id']; ?></td>
            <td><?php echo $l['titre']; ?></td>
            <td><?php echo $l['couverture']; ?></td>
            <td><?php echo $l['idAuteur']; ?></td>
            <td><?php echo $l['idEditeur']; ?></td>
            <td><?php echo $l['idQuizz']; ?></td>
            <td><img src="<?php echo base_url('img/'.$l['couverture']) ?>" alt="<?php echo $l['titre']; ?>" height="50" width="50"> </td>
            <td>
                <a href="<?php echo site_url('livre/edit/'.$l['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('livre/remove/'.$l['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
echo $links;
?>