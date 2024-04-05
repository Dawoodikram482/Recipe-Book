<?php include __DIR__.'/../views/header.php';?>
<div class="container mt-5">
    <div id="createRecipeAlert"></div>
    <h1>Create New Recipe</h1>
    <form id="newRecipeForm" enctype="multipart/form-data" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="preparationSteps" class="form-label">Preparation Steps:</label>
            <textarea id="preparationSteps" name="preparationSteps" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" id="image" name="image" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
        </div>
        <button type="button"  class="btn btn-primary" id="createRecipeBtn" name="createRecipeBtn">Create Recipe</button>
    </form>
</div>
<script src="javascript/createRecipe.js"></script>

<?php include __DIR__.'/../views/footer.php';?>

