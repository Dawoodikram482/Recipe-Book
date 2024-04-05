document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editRecipeBtn').addEventListener('click', function (event) {
        editRecipe();
    });
});

function editRecipe() {
    const title = escapeHtml(document.getElementById("title").value);
    const ingredients = escapeHtml(document.getElementById("ingredients").value);
    const preparationSteps = escapeHtml(document.getElementById("preparationSteps").value);
    const category = escapeHtml(document.getElementById("category").value);
    const image = document.getElementById("recipeImage").files[0];
    const recipeId = document.getElementById("recipeId").value;
    if (!validateInput(title, ingredients, preparationSteps, category)) {
        return;
    }

    const recipeDetails = {
        recipeId: recipeId,
        title: title,
        ingredients: ingredients,
        preparationSteps: preparationSteps,
        category: category,
    }
    const formData = new FormData();
    formData.append('recipeImage', image);
    formData.append('recipeDetails', JSON.stringify(recipeDetails));

    fetch('/api/editApi/update', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Recipe edited successfully, show success alert
                document.getElementById('editRecipeAlert').innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Recipe edited successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                // Optionally, update UI as needed
                console.log('Recipe edited successfully');
            } else {
                // Editing failure, show error alert
                document.getElementById('editRecipeAlert').innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to edit recipe. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                console.error('Failed to edit recipe:', data.error);
            }
        })
        .catch(error => {
            // Fetch error, show error alert
            document.getElementById('editRecipeAlert').innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An unexpected error occurred. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            console.error('Error during fetch:', error);
        });
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
function validateInput(title, ingredients, preparationSteps, category){
    if(!title){
        alert('Please enter a title');
        return false;
    }
    if(!ingredients){
        alert('Please enter ingredients');
        return false;
    }
    if(!preparationSteps){
        alert('Please enter preparation steps');
        return false;
    }
    if(!category){
        alert('Please enter a category');
        return false;
    }
    return true;
}