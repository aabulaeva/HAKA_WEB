<form method="post" class="needs-validation" novalidate>
	<div class="form-group">
		<label>Adresse mail</label>
		<input type="email" name="mail" class="bg-light shadow-sm pb-4 pt-4 form-control <?php echo $validMail ?>" style="border-radius: 12px;" placeholder="Entrer votre adresse mail" value="<?php echo $inputMail ?>">
	</div>
	<div class="pb-3 invalid-feedback <?php echo $validMail ?>">
    	Entrez une adresse mail valide
  	</div>
	<div class="form-group">
		<label>Mot de passe</label>
		<input type="password" name="password" class="bg-light shadow-sm pb-4 pt-4 form-control <?php echo $validPassword ?>" style="border-radius: 12px;" placeholder="Entrer votre mot de passe" value="<?php echo $inputPassword ?>">
	</div>
	<div class="pb-3 invalid-feedback <?php echo $validPassword ?>">
    	Entrez un mot de passe valide (3-20 caractères)
  	</div>
    <div class="text-danger text-center <?php echo $corres ?>">
        Pas de correspondance entre le mail et le mot de passe
    </div>
	<button type="submit" name="submit" class="btn submit-btn w-100 mt-4 p-2" style="border-radius: 20px;">Se connecter</button>
</form> 