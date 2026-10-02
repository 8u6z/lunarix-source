<?php
namespace App\Helpers;
use Illuminate\Support\Str;
class Filter
{
    protected static $filters = null;
    protected static $compiled = null;
    protected static $leetMap = ['0' => 'o', '1' => 'i', '!' => 'i', '|' => 'i', '3' => 'e', '4' => 'a', '@' => 'a', '5' => 's', '$' => 's', '7' => 't', '+' => 't', '8' => 'b', '9' => 'g', '2' => 'z', '6' => 'g'];
    public static function loadFilters(): void
    {
        if (self::$filters === null) {
            $path = storage_path('app/private/filters.txt');
            if (file_exists($path)) {
                $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $lines = array_map(fn($w) => Str::lower(trim($w)), $lines);
                self::$filters = array_values(array_filter($lines, fn($w) => $w !== ''));
            } else {
                self::$filters = [];
            }
            self::$compiled = null;
        }
    }

    protected static function normalize(string $text): string
    {
        $text = mb_strtolower($text);
        $text = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}\x{00AD}]/u', '', $text);
        if (class_exists('Transliterator') && $t = \Transliterator::create('Any-Latin; Latin-ASCII')) {
            $text = $t->transliterate($text);
        }
        $text = strtr($text, self::$leetMap);
        $text = preg_replace('/[^a-z0-9]/', '', $text);
        $text = preg_replace('/(.)\1{2,}/', '$1', $text);
        return $text;
    }

    protected static function compile(): array
    {
        if (self::$compiled !== null) {
            return self::$compiled;
        }
        self::loadFilters();
        $literals = [];
        $wildcards = [];
        foreach (self::$filters as $badword) {
            if (Str::contains($badword, ['*', '?'])) {
                $wildcards[] = ['raw' => $badword, 'regex' => self::compileWildcard($badword)];
            } else {
                $norm = self::normalize($badword);
                if ($norm !== '') {
                    $literals[] = ['raw' => $badword, 'norm' => $norm];
                }
            }
        }
        return self::$compiled = ['literals' => $literals, 'wildcards' => $wildcards];
    }

    protected static function compileWildcard(string $pattern): string
    {
        $tokens = preg_split('/([*?])/u', $pattern, -1, PREG_SPLIT_DELIM_CAPTURE);
        $regex = '';
        foreach ($tokens as $token) {
            if ($token === '*') {
                $regex .= '.*';
            } elseif ($token === '?') {
                $regex .= '.';
            } elseif ($token !== '') {
                $regex .= preg_quote(self::normalize($token), '/');
            }
        }
        return '/' . $regex . '/u';
    }

    public static function isInappropriate(string $text): bool
    {
        $compiled = self::compile();
        $normText = self::normalize($text);
        foreach ($compiled['literals'] as $entry) {
            if (strpos($normText, $entry['norm']) !== false) {
                return true;
            }
        }
        foreach ($compiled['wildcards'] as $entry) {
            if (preg_match($entry['regex'], $normText) === 1) {
                return true;
            }
        }
        return false;
    }

    public static function isTagged(string $text): string
    {
        $compiled = self::compile();
        $result = $text;
        foreach ($compiled['literals'] as $entry) {
            $chars = array_map(fn($c) => preg_quote($c, '/'), mb_str_split($entry['raw']));
            if (empty($chars)) continue;
            $pattern = '/(' . implode('[^a-z0-9]*', $chars) . ')/iu';
            $result = preg_replace_callback($pattern, fn($m) => str_repeat('#', mb_strlen($m[1])), $result);
        }
        foreach ($compiled['wildcards'] as $entry) {
            $tokens = preg_split('/([*?])/u', $entry['raw'], -1, PREG_SPLIT_DELIM_CAPTURE);
            $loose = '';
            foreach ($tokens as $token) {
                if ($token === '*') {
                    $loose .= '.*?';
                } elseif ($token === '?') {
                    $loose .= '[^a-z0-9]*.';
                } elseif ($token !== '') {
                    $chars = array_map(fn($c) => preg_quote($c, '/'), mb_str_split($token));
                    $loose .= implode('[^a-z0-9]*', $chars);
                }
            }
            if ($loose === '') continue;
            $pattern = '/(' . $loose . ')/iu';
            $result = preg_replace_callback($pattern, fn($m) => str_repeat('#', mb_strlen($m[1])), $result);
        }
        return $result;
    }
}