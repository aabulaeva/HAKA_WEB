<form class="container" method="POST" action="groupe_ajouté.php">
    <div class="form-group row">
        <label for="Name" class="col-sm-2 col-form-label">Nom du groupe</label>
        <div class="col-sm-10">
            <input class="form-control" id="Name" placeholder="Nom du groupe" name="name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="descr">Description</label>
        <textarea class="form-control" id="descr" rows="3" name="description" required></textarea>
    </div>
    <div class="container w-25 m-auto">
        <button type="submit" name="submit" class="btn submit-btn w-100 mt-4 p-2">Ajouter</button>
    </div>
</form>