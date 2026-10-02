<?php
//le legacy
namespace App\Http\Controllers\RBXApis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Asset;

class Legacy
{
    public function bodyColors(Request $request)
    {
        $userId = $request->query('userId');
        if (!$userId) {
            return response('<roblox/>', 400)->header('Content-Type', 'application/xml');
        }
        $body = DB::table('user_body')->where('userid', $userId)->first();
        $HeadColor = $body->headcolor ?? 194;
        $LeftArmColor = $body->leftarmcolor ?? 194;
        $LeftLegColor = $body->leftlegcolor ?? 102;
        $RightArmColor = $body->rightarmcolor ?? 194;
        $RightLegColor = $body->rightlegcolor ?? 102;
        $TorsoColor = $body->torsocolor ?? 23;
        $xml = <<<XML
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
  <External>null</External>
  <External>nil</External>
  <Item class="BodyColors">
    <Properties>
      <int name="HeadColor">{$HeadColor}</int>
      <int name="LeftArmColor">{$LeftArmColor}</int>
      <int name="LeftLegColor">{$LeftLegColor}</int>
      <string name="Name">Body Colors</string>
      <int name="RightArmColor">{$RightArmColor}</int>
      <int name="RightLegColor">{$RightLegColor}</int>
      <int name="TorsoColor">{$TorsoColor}</int>
      <bool name="archivable">true</bool>
    </Properties>
  </Item>
</roblox>
XML;
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function oldAvatarFetch(Request $request)
    {
        $userId = $request->query('userId');
        if (!$userId) {
            return response('Missing userId', 400);
        }
        $urls = [];
        $urls[] = "http://lunarix.lol/Asset/BodyColors.ashx?userId={$userId}";
        $assets = DB::table('user_equippedassets')->where('userid', $userId)->first();
        if ($assets && is_string($assets->assets)) {
            foreach (explode(';', $assets->assets) as $assetId) {
                $assetId = (int) trim($assetId);
                if ($assetId > 0) {
                    $urls[] = url("/Asset/?id={$assetId}");
                }
            }
        }
        $response = implode(';', $urls);
        return response($response, 200)->header('Content-Type', 'text/plain');
    }
}