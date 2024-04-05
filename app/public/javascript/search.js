
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('form');
    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission
        const searchCategory = document.getElementById('searchCategory').value;
        fetchRecipesByCategory(searchCategory);
    });
});
