<?php
declare(strict_types=1);

/**
 * Is a pass phrase valid?
 *
 * It is valid if each word only exists once.
 * For part 2, each word is sorted before checking for uniqueness to find alla anagrams.
 *
 * @param array $words
 * @param bool $includeAnagrams  should the word be sorted before checking for uniqueness to include anagrams?
 * @return bool
 */
function isValidPassPhrase(array $words, bool $includeAnagrams): bool
{
    $used = [];
    foreach ($words as $word) {

        if ($includeAnagrams) {
            $word = str_sort($word);
        }

        if (isset($used[$word])) {
            return false;
        }

        $used[$word] = true;
    }

    return true;
}

/**
 * Sort the characters in a word alphabetically
 *
 * @param string $string
 * @return string
 */
function str_sort(string $string): string
{
    $chars = str_split($string);
    sort($chars);
    return implode('', $chars);
}
