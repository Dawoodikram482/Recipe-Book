document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('createRecipeBtn').addEventListener('click', function (event) {
        createRecipe();
    });
});

function createRecipe() {
    // const form = document.getElementById('newRecipeForm');
    // const formData = new FormData(form);
    const title = escapeHtml(document.getElementById("title").value);
    const ingredients = escapeHtml(document.getElementById("ingredients").value);
    const preparationSteps = escapeHtml(document.getElementById("preparationSteps").value);
    const category = escapeHtml(document.getElementById("category").value);
    const image = document.getElementById("image").files[0];

    if(!validateInput(title, ingredients, preparationSteps, category, image)){
        return;
    }

    const recipeDetails = {
        title: title,
        ingredients: ingredients,
        preparationSteps: preparationSteps,
        category: category,
    }
    const formData = new FormData();
    formData.append('image', image);
    formData.append('recipeDetails', JSON.stringify(recipeDetails));

    fetch('/api/createRecipeApi/create', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Recipe created successfully');
                document.getElementById("newRecipeForm").reset();
                document.getElementById('createRecipeAlert').innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Recipe created successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

            } else {
                console.error('Failed to create recipe:', data.error);
                document.getElementById('createRecipeAlert').innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to create recipe. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error during fetch:', error);
            document.getElementById('createRecipeAlert').innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An unexpected error occurred. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        });
}
function validateInput(title, ingredients, preparationSteps, category, image){
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
    if(!image){
        alert('Please upload an image');
        return false;
    }
    return true;
}
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}