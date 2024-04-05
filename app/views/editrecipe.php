<?php
include __DIR__.'/../views/header.php';?>
    <div class="container mt-5">
        <div id="editRecipeAlert"></div>
        <h1>Edit Recipe</h1>
        <form id="newRecipeForm" enctype="multipart/form-data" method="post">
            <input type="hidden" id ="recipeId" name="recipeId" value="<?= $recipe->getRecipeId() ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value=" <?=$recipe->getRecipeTitle() ?>" required>
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients:</label>
                <textarea id="ingredients" name="ingredients" class="form-control" required><?= $recipe->getIngredients()?></textarea>
            </div>

            <div class="mb-3">
                <label for="preparationSteps" class="form-label">Preparation Steps:</label>
                <textarea id="preparationSteps" name="preparationSteps" class="form-control" required><?= $recipe->getInstructions()?></textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="<?= $recipe->getCategory() ?>" selected><?= $recipe->getCategory() ?></option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="recipeImage" name="recipeImage" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                <img src="/images/<?= $recipe->getImage() ?>" class="mt-2" width="100" height="100"
                     alt="Recipe Image">
            </div>
            <button type="button"  class="btn btn-primary" id="editRecipeBtn" name="editRecipeBtn">Edit Recipe</button>
        </form>
    </div>
<script src="javascript/editRecipe.js"></script>


<?php include __DIR__.'/../views/footer.php';?>

