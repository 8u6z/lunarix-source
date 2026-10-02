<?php
namespace App\Helpers;

class XMLBuilder
{
    private const XSI_SCHEMA_LOCATION = 'http://www.lunarix.le/roblox.xsd';
    private static function assetHost(): string
    {
        return 'http://' . config('app.base_url_nohttp') . '/asset';
    }
    public static function buildDecal(int $imageAssetId, string $name = 'Decal'): string
    {
        $name = self::escape($name);
        $url = self::assetUrl($imageAssetId);
        return <<<XML
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="{self::XSI_SCHEMA_LOCATION}" version="4">
  <External>null</External>
  <External>nil</External>
  <Item class="Decal" referent="RBX0">
    <Properties>
      <token name="Face">5</token>
      <string name="Name">{$name}</string>
      <float name="Shiny">20</float>
      <float name="Specular">0</float>
      <Content name="Texture">
        <url>{$url}</url>
      </Content>
      <bool name="archivable">true</bool>
    </Properties>
  </Item>
</roblox>
XML;
    }
    public static function buildFace(int $imageAssetId, string $name = 'Face'): string
    {
        return self::buildDecal($imageAssetId, $name);
    }
    public static function buildShirt(int $templateImageAssetId, string $name = 'Shirt'): string
    {
        $name = self::escape($name);
        $url = self::assetUrl($templateImageAssetId);
        return <<<XML
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="{self::XSI_SCHEMA_LOCATION}" version="4">
    <External>null</External>
    <External>nil</External>
    <Item class="Shirt" referent="RBX0">
      <Properties>
        <Content name="ShirtTemplate">
          <url>{$url}</url>
        </Content>
        <string name="Name">{$name}</string>
        <bool name="archivable">true</bool>
      </Properties>
    </Item>
</roblox>
XML;
    }
    public static function buildPants(int $templateImageAssetId, string $name = 'Pants'): string
    {
        $name = self::escape($name);
        $url = self::assetUrl($templateImageAssetId);
        return <<<XML
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="{self::XSI_SCHEMA_LOCATION}" version="4">
  <External>null</External>
  <External>nil</External>
  <Item class="Pants" referent="RBX0">
    <Properties>
      <Content name="PantsTemplate">
        <url>{$url}</url>
      </Content>
      <string name="Name">{$name}</string>
      <bool name="archivable">true</bool>
    </Properties>
  </Item>
</roblox>
XML;
    }
    private static function assetUrl(int $assetId): string
    {
        return self::assetHost() . '?id=' . $assetId;
    }
    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
