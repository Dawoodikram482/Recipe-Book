<?php include __DIR__.'/../views/header.php';?>
<div id="recipeContainer" class="container d-flex flex-column align-items-center text-center p-3">

</div>
<script src="/javascript/recipeCategory.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchRecipesByCategory('Breakfast');
    });
</script>
<?php include __DIR__.'/../views/footer.php';?>
