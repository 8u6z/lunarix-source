<?php
namespace App\Http\Controllers\General\Backend;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharacterCustomizer
{
    public function characterCustomizer(Request $request)
    {
        $user = auth()->user()->load('body');
        $eventTarget = $request->input('__EVENTTARGET');
        $eventArgument = $request->input('__EVENTARGUMENT');
        $decodedTarget = urldecode($eventTarget);
        $colorTargets = ['ColorChooserHead' => 'headcolor', 'ColorChooserTorso' => 'torsocolor', 'ColorChooserLeftArm' => 'leftarmcolor', 'ColorChooserRightArm' => 'rightarmcolor', 'ColorChooserLeftLeg' => 'leftlegcolor', 'ColorChooserRightLeg' => 'rightlegcolor'];
        if ($eventTarget === 'RemoveAccoutrementButton' && $eventArgument) {
            return $this->removeAccoutrement($user, (int) $eventArgument);
        }
        if ($eventTarget === 'WearAccoutrementButton' && $eventArgument) {
            return $this->wearAccoutrement($user, (int) $eventArgument);
        }
        if ($eventTarget === 'InvalidateThumbnails') {
            return $this->invalidateThumbnail($user);
        }
        foreach ($colorTargets as $target => $column) {
            if (str_contains($decodedTarget, $target) && $eventArgument) {
                return $this->setBodyColor($user, $column, (int) $eventArgument);
            }
        }
        return $this->renderCharacterCustomizer($user);
    }

    private function renderCharacterCustomizer(User $user): \Illuminate\View\View
    {
        $inventory = $user->inventory()->with('asset')->get();
        return view('my.character', ['user' => $user, 'body' => $user->body, 'inventory' => $inventory]);
    }

    private function removeAccoutrement(User $user, int $assetId): RedirectResponse
    {
        $user->wornAssets()->detach($assetId);
        $user->markRendersOutdated();
        return redirect()->back();
    }

    private function wearAccoutrement(User $user, int $assetId): RedirectResponse
    {
        $owns = $user->inventory()->where('asset_id', $assetId)->exists();
        if (! $owns) {
            return redirect()->back()->withErrors(['wear' => 'You do not own this item.']);
        }
        $asset = Asset::find($assetId);
        if ($asset->type === Asset::TYPE_FACE) {
            $user->wornAssets()->wherePivot('type', Asset::TYPE_FACE)->detach();
        }
        if ($asset->type === Asset::TYPE_SHIRT) {
            $user->wornAssets()->wherePivot('type', Asset::TYPE_SHIRT)->detach();
        }
        if ($asset->type === Asset::TYPE_TSHIRT) {
            $user->wornAssets()->wherePivot('type', Asset::TYPE_TSHIRT)->detach();
        }
        if ($asset->type === Asset::TYPE_PANTS) {
            $user->wornAssets()->wherePivot('type', Asset::TYPE_PANTS)->detach();
        }
        $alreadyWearing = $user->wornAssets()->where('asset_id', $assetId)->exists();
        if (! $alreadyWearing) {
            $asset = Asset::find($assetId);
            $user->wornAssets()->attach($assetId, ['type' => $asset->type]);
        }
        $user->markRendersOutdated();
        return redirect()->back();
    }

    private function invalidateThumbnail(User $user): RedirectResponse
    {
        $user->markRendersOutdated();
        return redirect()->back();
    }

    private function setBodyColor(User $user, string $column, int $colorId): RedirectResponse
    {
        $user->body()->update([$column => $colorId]);
        $user->markRendersOutdated();
        return redirect()->back();
    }
}
