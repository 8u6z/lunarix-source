<?php
namespace App\Http\Controllers\RBXApis;
use App\Traits\AccessKey;
use App\Models\Asset;
use App\Models\Games\DStoresModel;
use App\Models\Games\DatastoresReq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DStores
{
    use AccessKey;
    private function resolveUniverseId(int $placeId): ?int
    {
        $universeId = Asset::where('id', $placeId)->where('type', 9)->value('universe_id');
        return $universeId !== null ? (int) $universeId : null;
    }

    public function set(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['key' => 'required|string', 'placeId' => 'required|integer', 'scope' => 'required|string', 'type' => 'required|string', 'target' => 'required|string']);
        if (!$request->has('value')) {
            return response()->json(['error' => 'fail']);
        }
        $universeId = $this->resolveUniverseId((int) $validated['placeId']);
        if ($universeId === null) {
            return response()->json(['error' => 'fail']);
        }
        $value = $request->input('value');
        if (Str::startsWith($value, '[{') && Str::endsWith($value, '}]')) {
            $postData = json_decode($value, true);
            if (is_array($postData) && count($postData) === 1 && isset($postData[0]['Scope'], $postData[0]['Key'], $postData[0]['Value'])) {
                $value = $postData[0]['Value'];
            }
        }
        $match = ['universe_id' => $universeId, 'scope' => $validated['scope'], 'type' => $validated['type'], 'key' => $validated['key'], 'target' => $validated['target']];
        DStoresModel::updateOrCreate($match, ['value' => $value]);
        return response()->json(['data' => $value]);
    }

    public function increment(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['key' => 'required|string', 'placeId' => 'required|integer', 'scope' => 'required|string', 'type' => 'required|string', 'target' => 'required|string', 'value' => 'required|integer']);
        $universeId = $this->resolveUniverseId((int) $validated['placeId']);
        if ($universeId === null) {
            return response()->json(['error' => '']);
        }
        $match = ['universe_id' => $universeId, 'scope' => $validated['scope'], 'type' => $validated['type'], 'key' => $validated['key'], 'target' => $validated['target']];
        $increment = (int) $validated['value'];
        $exists = DStoresModel::where($match)->exists();
        if ($exists) {
            DStoresModel::where($match)->update([
                'value' => DB::raw("(value::numeric + {$increment})::text"),
            ]);
        } else {
            DStoresModel::create(array_merge($match, ['value' => (string) $increment]));
        }
        $finalValue = DStoresModel::where($match)->value('value');
        return response()->json(['data' => [['Value' => $finalValue, 'Scope' => $validated['scope'], 'Key' => $validated['key'], 'Target' => $validated['target']]]]);
    }

    public function getSorted(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([ 'key' => 'required|string', 'placeId' => 'required|integer', 'scope' => 'required|string', 'pagesize' => 'sometimes|integer|min:1', 'exclusivestartkey' => 'sometimes|string', 'ascending' => 'sometimes|string']);
        $universeId = $this->resolveUniverseId((int) $validated['placeId']);
        if ($universeId === null) {
            return response()->json(['error' => '']);
        }
        $hasPageSize = $request->has('pagesize');
        $hasStartKey = $request->has('exclusivestartkey');
        $pageNumber = 0;
        $startKeyText = null;
        $usingCursor = false;
        if (!$hasStartKey && $hasPageSize) {
            $startKeyText = Str::random(15);
            DatastoresReq::create(['exclusive_start_key' => $startKeyText, 'page_number' => 0]);
            $usingCursor = true;
        } elseif ($hasStartKey) {
            $startKeyText = $validated['exclusivestartkey'];
            $cursorRow = DatastoresReq::where('exclusive_start_key', $startKeyText)->first();
            if ($cursorRow === null) {
                $startKeyText = null;
                $usingCursor = false;
            } else {
                $pageNumber = $cursorRow->page_number;
                $usingCursor = true;
            }
        }
        $query = DStoresModel::where('type', 'sorted')->where('universe_id', $universeId)->where('key', $validated['key'])->where('scope', $validated['scope'])->orderByRaw('value::numeric ' . (($validated['ascending'] ?? null) === 'False' ? 'DESC' : 'ASC'));
        if ($hasPageSize) {
            $limit = (int) $validated['pagesize'];
            $offset = $usingCursor ? $pageNumber * $limit : 0;
            $query->skip($offset)->take($limit);
        }
        $entries = $query->get(['target', 'value'])->map(fn ($row) => ['Target' => $row->target, 'Value' => $row->value])->all();
        $json = ['data' => ['Entries' => $entries]];
        if ($usingCursor) {
            if ($hasPageSize) {
                DatastoresReq::where('exclusive_start_key', $startKeyText)->increment('page_number');
            }
            $json['data']['ExclusiveStartKey'] = $startKeyText;
        }
        return response()->json($json);
    }

    public function getV2(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['placeId' => 'required|integer', 'scope' => 'required|string', 'type' => 'required|string']);
        $rawBody = file_get_contents('php://input');
        $qkeys = [];
        if ($rawBody !== false && strlen($rawBody) > 0) {
            $pairs = explode('&', ltrim($rawBody, '&'));
            foreach ($pairs as $pair) {
                $eqPos = strpos($pair, '=');
                if ($eqPos === false) {
                    continue;
                }
                $k = urldecode(substr($pair, 0, $eqPos));
                $v = urldecode(substr($pair, $eqPos + 1));
                $qkeys[$k] = $v;
            }
        }
        $key = $qkeys['qkeys[0].key'] ?? null;
        $target = $qkeys['qkeys[0].target'] ?? null;
        if ($key === null || $target === null) {
            return response()->json(['error' => 'Missing qkeys[0].key or qkeys[0].target']);
        }
        $universeId = $this->resolveUniverseId((int) $validated['placeId']);
        if ($universeId === null) {
            return response()->json(['data' => []]);
        }
        $rows = DStoresModel::where('universe_id', $universeId)->where('scope', $validated['scope'])->where('type', $validated['type'])->where('key', (string) $key)->where('target', (string) $target)->get(['value', 'scope', 'key', 'target']);
        $values = $rows->map(fn ($row) => ['Value' => $row->value, 'Scope' => $row->scope, 'Key' => $row->key, 'Target' => $row->target])->all();
        return response()->json(['data' => $values]);
    }
}