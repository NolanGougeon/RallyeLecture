<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Livre/Add'); ?>
<div>Titre      : <input type="text" name="titre" value="<?php echo $this->input->post('titre'); ?>" /></div>
<!-- <div>Couverture : <input type="text" name="couverture" value="<?php //echo $this->input->post('couverture'); ?>" /></div> -->
<div>Couverture :<input type="file" name="couverture" id="couv" /></div>
<div>Auteur     : <?php $comboBoxAuteur->Render(); ?></div>
<div>Editeur    : <?php $comboBoxEditeur->Render(); ?></div>
<div>Quizz      : <?php $comboBoxQuizz->Render(); ?></div>
<div><output id="list"></output></div>
<div><img src="<?php echo base_url('img/'.$this->input->post('couverture')) ?>" alt="<?php echo $this->input->post('titre'); ?>" height="100" width="100"> </div>
<button type="submit">Sauvegarder</button>
<?php echo form_close(); ?>
<script type="text/javascript">
    if (window.FileReader) {
        document.getElementById('couv').addEventListener('change',handleFileSelect, false);
    }
    else {
        alert('Ce navigateur ne supporte pas FileReader');
    }
    function handleFileSelect(evt){
        var files = evt.target.files;
        var f = files[0];
        var reader = new FileReader();
        
        reader.onload = (function(theFile){
            return function(e){
                document.getElementById('list').innerHTML = ['<img src="',e.target.result,'" title="', theFile.name,'" width="150" />'].join('');
            };            
        })(f);
        reader.readAsDataURL(f);
    }
    </script>
