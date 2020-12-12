<?php
namespace App\Constant;

/**
 * @package GitHubRepos
 * @author Abdallah <a.nassar@gmail.com>
 * Filters
 *
 */
class Filters
{
    /**
     * @const Date
     */
    const DATE = 'date';

    /**
     * @const LANGUAGE
     */
    const LANGUAGE = 'language';

    public static function getFilters(): array
    {
        return [
            self::DATE,
            self::LANGUAGE,
        ];
    }
}
