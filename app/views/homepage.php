<?php include __DIR__ . '/header.php'; ?>
<div class="container mt-4">
    <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
    <div class="p-4 rounded">
        <h1 class="mb-3">Welcome to Recipe Book</h1>
        <h3 class="mb-4">You can search recipes by entering name of category</h3>
        <p>Categories: </p>
        <ol><li>Breakfast</li>
            <li>Lunch</li>
            <li>Dinner</li>
        </ol>
        <form>
            <div class="mb-3">
                <label for="searchCategory" class="form-label">Categrories</label>
                <input type="text" class="form-control" id="searchCategory" placeholder="Enter Category">
            </div>
            <button type="submit" class="btn btn-primary" name="searchBtn">Search</button>
        </form>
    </div>

    <div class="posts-grid mt-4" id="recipeContainer">
    </div>
</div>
<script src="/javascript/recipeCategory.js"></script>
<?php include __DIR__ .'/footer.php'; ?>
