<?php
namespace App\Http\Controllers\General\Frontend\Catalog;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class Browse
{
    private const RESULTS_PER_CATALOG_PAGE = 42;
    private const CATEGORY_NAMES = [0 => 'Featured', 1 => 'All Categories', 2 => 'Collectibles', 3 => 'Clothing', 4 => 'Body Parts', 5 => 'Gear'];
    private const SUBCATEGORY_NAMES = [9 => 'Hats', 12 => 'Shirts', 13 => 'T-Shirts', 14 => 'Pants', 5 => 'Gear', 10 => 'Faces', 11 => 'Packages', 15 => 'Heads'];
    public function browseCatalog(Request $request)
    {
        $category = (int) $request->input('Category', 1);
        $subcategory = (int) $request->input('Subcategory', $category);
        $keyword = trim((string) $request->input('Keyword', ''));
        $sortType = (int) $request->input('SortType', 0);
        $sortAggregation = (int) $request->input('SortAggregation', 3);
        $sortCurrency = (int) $request->input('SortCurrency', 0);
        $currencyType = (int) $request->input('CurrencyType', 0);
        $creatorId = (int) $request->input('CreatorID', 0);
        $pxMin = (int) $request->input('PxMin', 0);
        $pxMax = (int) $request->input('PxMax', 0);
        $includeNotForSale = filter_var($request->input('IncludeNotForSale', false), FILTER_VALIDATE_BOOLEAN);
        $legendExpanded = filter_var($request->input('LegendExpanded', false), FILTER_VALIDATE_BOOLEAN);
        $pageNumber = max((int) $request->input('PageNumber', $request->input('Page', 1)), 1);
        $resultsPerPage = self::RESULTS_PER_CATALOG_PAGE;
        $query = Asset::query()->notGhosted()->publiclyAvailable()->with('creator');
        if ($category === 0) {
            $query->where('creator_id', Asset::FEATURED_CREATOR_ID);
            if (isset(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]) && $subcategory !== $category) {
                $query->ofType(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]);
            } else {
                $query->whereIn('type', Asset::FEATURED_TYPES);
            }
        } elseif ($category === 2) {
            $query->where(function ($q) {
                $q->where('is_limited', true)->orWhere('is_limited_unique', true);
            });
            if (isset(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]) && $subcategory !== $category) {
                $query->ofType(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]);
            } else {
                $query->whereIn('type', Asset::TYPES_ACCESSORIES);
            }
        } elseif (isset(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]) && $subcategory !== $category) {
            $query->ofType(Asset::SUBCATEGORY_TYPE_MAP[$subcategory]);
        } elseif (isset(Asset::CATEGORY_TYPE_MAP[$category])) {
            $query->whereIn('type', Asset::CATEGORY_TYPE_MAP[$category]);
        } else {
            $query->whereIn('type', array_merge(Asset::TYPES_CLOTHING, Asset::TYPES_ACCESSORIES, Asset::TYPES_BODY_PARTS, [Asset::TYPE_GEAR, Asset::TYPE_PACKAGE]));
        }
        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
        if ($creatorId > 0) {
            $query->where('creator_id', $creatorId);
        }
        if (!$includeNotForSale) {
            $query->onSale();
        }
        if ($pxMin > 0) {
            $query->where('robux', '>=', $pxMin);
        }
        if ($pxMax > 0) {
            $query->where('robux', '<=', $pxMax);
        }
        switch ($currencyType) {
            case 1:
                $query->where('onsale', true)->where('robux', '>', 0);
                break;
            case 5:
                $query->where('onsale', true)->where('robux', 0);
                break;
        }
        switch ($sortType) {
            case 1:
                $query->orderByDesc('created_at');
                break;
            case 2:
                $query->orderByDesc('sales_count');
                break;
            case 3:
                $query->orderByDesc('updated_at');
                break;
            case 4:
                $query->orderBy('robux');
                break;
            case 5:
                $query->orderByDesc('robux');
                break;
            default:
                $query->orderByDesc('created_at');
                break;
        }
        if ($category === 0) {
            $query->reorder('created_at', 'desc');
        }
        $total = (clone $query)->count();
        $totalPages = max(1, (int) ceil($total / $resultsPerPage));
        $pageNumber = min($pageNumber, $totalPages);
        $items = $query->skip(($pageNumber - 1) * $resultsPerPage)->take($resultsPerPage)->get();
        $paginator = new LengthAwarePaginator($items, $total, $resultsPerPage, $pageNumber);
        $categoryName = self::CATEGORY_NAMES[$category] ?? 'All Categories';
        $subcategoryName = self::SUBCATEGORY_NAMES[$subcategory] ?? null;
        if ($subcategory === $category) {
            $subcategoryName = null;
        }
        $creatorUsername = null;
        if ($creatorId > 0) {
            $creatorUsername = User::query()->where('id', $creatorId)->value('username');
        }
        $catalogConfig = ['Subcategory' => $subcategory, 'Category' => $category, 'CurrencyType' => $currencyType, 'SortType' => $sortType, 'SortAggregation' => $sortAggregation, 'SortCurrency' => $sortCurrency, 'Gears' => null, 'Genres' => null, 'CatalogContext' => (int) $request->input('CatalogContext', 1), 'Keyword' => $keyword !== '' ? $keyword : null, 'PageNumber' => $pageNumber, 'CreatorID' => $creatorId, 'PxMin' => $pxMin, 'PxMax' => $pxMax, 'IncludeNotForSale' => $includeNotForSale, 'LegendExpanded' => $legendExpanded, 'ResultsPerPage' => $resultsPerPage];
        return view('catalog.browse', ['items' => $items, 'paginator' => $paginator, 'totalPages' => $totalPages, 'totalResults' => $total, 'catalogConfig' => $catalogConfig, 'pageNumber' => $pageNumber, 'categoryName' => $categoryName, 'subcategoryName' => $subcategoryName, 'creatorUsername' => $creatorUsername, 'keyword' => $keyword]);
    }
}
