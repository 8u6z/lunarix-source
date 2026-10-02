<?php

namespace App\Http\Controllers\RBXApis\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Signer;
use Illuminate\Http\Response;

class Studio extends Controller
{
    public function handle(Request $request): Response
    {
        $body = '-- Setup studio cmd bar & load core scripts
pcall(function() game:GetService("InsertService"):SetFreeModelUrl("http://www.synvo.live/Game/Tools/InsertAsset.ashx?type=fm&q=%s&pg=%d&rs=%d") end)
pcall(function() game:GetService("InsertService"):SetFreeDecalUrl("http://www.synvo.live/Game/Tools/InsertAsset.ashx?type=fd&q=%s&pg=%d&rs=%d") end)
game:GetService("ScriptInformationProvider"):SetAssetUrl("http://www.synvo.live/Asset/")
game:GetService("InsertService"):SetBaseSetsUrl("http://www.synvo.live/Game/Tools/InsertAsset.ashx?nsets=10&type=base")
game:GetService("InsertService"):SetUserSetsUrl("http://www.synvo.live/Game/Tools/InsertAsset.ashx?nsets=20&type=user&userid=%d")
game:GetService("InsertService"):SetCollectionUrl("http://www.synvo.live/Game/Tools/InsertAsset.ashx?sid=%d")
game:GetService("InsertService"):SetAssetUrl("http://www.synvo.live/Asset/?id=%d")
game:GetService("InsertService"):SetAssetVersionUrl("http://www.synvo.live/Asset/?assetversionid=%d")
pcall(function() game:GetService("SocialService"):SetFriendUrl("http://www.synvo.live/Game/LuaWebService/HandleSocialRequest.ashx?method=IsFriendsWith&playerid=%d&userid=%d") end)
pcall(function() game:GetService("SocialService"):SetBestFriendUrl("http://www.synvo.live/Game/LuaWebService/HandleSocialRequest.ashx?method=IsBestFriendsWith&playerid=%d&userid=%d") end)
pcall(function() game:GetService("SocialService"):SetGroupUrl("http://www.synvo.live/Game/LuaWebService/HandleSocialRequest.ashx?method=IsInGroup&playerid=%d&groupid=%d") end)
pcall(function() game:GetService("SocialService"):SetGroupRankUrl("http://www.synvo.live/Game/LuaWebService/HandleSocialRequest.ashx?method=GetGroupRank&playerid=%d&groupid=%d") end)
pcall(function() game:GetService("SocialService"):SetGroupRoleUrl("http://www.synvo.live/Game/LuaWebService/HandleSocialRequest.ashx?method=GetGroupRole&playerid=%d&groupid=%d") end)
pcall(function() game:GetService("GamePassService"):SetPlayerHasPassUrl("http://www.synvo.live/Game/GamePass/GamePassHandler.ashx?Action=HasPass&UserID=%d&PassID=%d") end)
pcall(function() game:GetService("MarketplaceService"):SetProductInfoUrl("https://api.synvo.live/marketplace/productinfo?assetId=%d") end)
pcall(function() game:GetService("MarketplaceService"):SetDevProductInfoUrl("https://api.synvo.live/marketplace/productDetails?productId=%d") end)
pcall(function() game:GetService("MarketplaceService"):SetPlayerOwnsAssetUrl("https://api.synvo.live/ownership/hasasset?userId=%d&assetId=%d") end)
local result = pcall(function() game:GetService("ScriptContext"):AddStarterScript(37801172) end)
if not result then
  pcall(function() game:GetService("ScriptContext"):AddCoreScript(37801172,game:GetService("ScriptContext"),"StarterScript") end)
end';
       
        $signed = Signer::signString($body, useRbxSig: true);
        return response($signed, 200)->header('Content-Type', 'text/plain');
    }
}