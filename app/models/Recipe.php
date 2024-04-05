<?php

use Cassandra\Date;

require_once __DIR__ . '/user.php';
require_once __DIR__ . '/Category.php';
class Recipe implements JsonSerializable
{
    private int $RecipeId;
    private string $RecipeTitle;
    private string $Ingredients;
    private string $Instructions;
    private string $Image;
    private int $UserId;
    private string $Category;
    private string $Createdate;
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getRecipeId(): int
    {
        return $this->RecipeId;
    }

    /**
     * @return string
     */
    public function getRecipeTitle(): string
    {
        return $this->RecipeTitle;
    }

    /**
     * @return string
     */
    public function getIngredients(): string
    {
        return $this->Ingredients;
    }

    /**
     * @return string
     */
    public function getInstructions(): string
    {
        return $this->Instructions;
    }
    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->Image;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->UserId;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * @return Date
     */
    public function getCreatedate(): Date
    {
        return $this->Createdate;
    }
    /**
     * @param int $RecipeId
     */
    public function setRecipeId(int $RecipeId): void
    {
        $this->RecipeId = $RecipeId;
    }

    /**
     * @param string $Ingredients
     */
    public function setIngredients(string $Ingredients): void
    {
        $this->Ingredients = $Ingredients;
    }

    /**
     * @param string $Instructions
     */
    public function setInstructions(string $Instructions): void
    {
        $this->Instructions = $Instructions;
    }

    /**
     * @param string $Image
     */
    public function setImage(string $Image): void
    {
        $this->Image = $Image;
    }

    /**
     * @param string $RecipeTitle
     */
    public function setRecipeTitle(string $RecipeTitle): void
    {
        $this->RecipeTitle = $RecipeTitle;
    }


    /**
     * @param int $UserId
     */
    public function setUserId(int $UserId): void
    {
        $this->UserId = $UserId;
    }

    /**
     * @param Category $Category
     */
    public function setCategory(Category $Category): void
    {
        $this->Category = $Category;
    }

    /**
     * @param Date $Createdate
     */
    public function setCreatedate(Date $Createdate): void
    {
        $this->Createdate = $Createdate;
    }
    public function jsonSerialize():mixed
    {
        return get_object_vars($this);
    }
}

