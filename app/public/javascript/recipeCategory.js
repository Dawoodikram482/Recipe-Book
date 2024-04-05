document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('recipeContainer').addEventListener('click', function (event) {
        const deleteButton = event.target.closest('.btn-danger');
        const editButton = event.target.closest('.btn-secondary');
        if (deleteButton) {
            console.log('Delete button clicked:', deleteButton.id);
            const recipeId = deleteButton.id.replace('deleteRecipeBtn_', '');
            const confirmation = confirm('Are you sure you want to delete this recipe?');
            if (confirmation) {
                // Send the delete request
                deleteRecipe(recipeId);

            }
        }
        else if (editButton) {
            const recipeId = editButton.id.replace('editRecipeBtn_', '');
            window.location.href = `editrecipe?id=${recipeId}`;
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('form');
    const recipeContainer = document.getElementById('recipeContainer');
    // const errorMessage = document.getElementById('errorMessage');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const searchCategory = document.getElementById('searchCategory').value;
        recipeContainer.innerHTML = '';
        fetchRecipesByCategory(searchCategory);
    });
});


 function fetchRecipesByCategory(category) {
    fetch(`api/fetchApi/fetch?category=${encodeURIComponent(category)}`)
        .then(response => response.text())
        .then(responseText => {

            try {
                const recipes = JSON.parse(responseText);
                recipes.forEach(recipe => {
                    document.getElementById('recipeContainer').insertAdjacentHTML('beforeend', createRecipeHtml(recipe));
                });
            } catch (jsonError) {
                console.error("Error parsing JSON response: ", jsonError);
            }
        })
        .catch(error => {
            console.error("An error occurred fetching recipes: ", error);
        });
}

function createRecipeHtml(recipe) {
    const categories = recipe.Category ? recipe.Category.split('\r\n') : [];
    const ingredients = recipe.Ingredients ? recipe.Ingredients.split('\r\n') : [];
    const preparationSteps = recipe.Instructions ? recipe.Instructions.split('\r\n') : [];

    const categoriesHtml = categories.map(category => `<span class="category text-black">${category}</span>`).join(' ');
    const ingredientsHtml = ingredients.map(ingredient => `<li>${ingredient}</li>`).join('');
    const preparationStepsHtml = preparationSteps.map(step => `<li>${step}</li>`).join('');
    const buttonsHtml = `
         <button id="deleteRecipeBtn_${recipe.RecipeId}" class="btn btn-danger mx-2">Delete</button>
         <button id="editRecipeBtn_${recipe.RecipeId}" class="btn btn-secondary mx-2">Edit</button>
    `;

    return `
        <div class="recipe-card row mb-4">
            <div class="col-sm-6">
                <div class="recipe-image">
                    <img src="/images/${recipe.Image || ''}" class="card-img-top" alt="Recipe Image" style="width: 50%; height: 400px; object-fit: cover;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="recipe-details">
                    <div class="recipe-description">
                        <h4 class="card-title">${recipe.RecipeTitle || ''}</h4>
                        <p class="card-categories">Categories: ${categoriesHtml}</p>
                    </div>
                    <div class="recipe-ingredients">
                        <h5>Ingredients:</h5>
                        <p>${ingredientsHtml}</p>
                    </div>
                    <div class="recipe-preparation-steps">
                        <h5>Preparation Steps:</h5>
                        <p>${preparationStepsHtml}</p>
                    </div>
                    <div class="recipe-buttons">
                        ${buttonsHtml}
                    </div>
                </div>
            </div>
        </div>`;
}
function deleteRecipe(recipeId) {
    fetch(`api/deleteApi/delete?RecipeId=${recipeId}`, {
        method: 'DELETE',
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Recipe deleted successfully');
                const recipeCard = document.getElementById(`deleteRecipeBtn_${recipeId}`).closest('.recipe-card');
                if (recipeCard) {
                    recipeCard.remove();
                } else {
                    console.error('Failed to find recipe card for removal');
                }
            } else {
                console.error('Response data:', data);
                console.error('Failed to delete recipe:', data.error);
                alert(`Failed to delete recipe: ${data.error}`);
            }
        })
        .catch(error => {
            console.error('Error during fetch:', error);
            alert('An unexpected error occurred. Please try again.');
        });
}



