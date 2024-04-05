<?php
namespace models;
enum Category: string
{
    case Breakfast = 'Breakfast';
    case Lunch = 'Lunch';
    case Dinner = 'Dinner';

    public function getCategoryType(): string
    {
        return match ($this) {
            Category::Breakfast => 'Breakfast',
            Category::Lunch => 'Lunch',
            Category::Dinner => 'Dinner',
        };
    }

    public static function createFrom(string $value): Category
    {
        switch ($value) {
            case 'Breakfast':
                return Category::Breakfast;
            case 'Lunch':
                return Category::Lunch;
            case 'Dinner':
                return Category::Dinner;
            default:
                // Handle unknown values or throw an exception
                throw new \InvalidArgumentException("Invalid Category value: $value");
        }
    }
}
