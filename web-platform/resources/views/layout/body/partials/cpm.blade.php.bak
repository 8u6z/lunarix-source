@php
$colors = [45 => '#B4D2E4', 1024 => '#AFDDFF', 11 => '#80BBDC', 102 => '#6E99CA', 23 => '#0D69AC', 1010 => '#0000FF', 1012 => '#2154B9', 1011 => '#002060', 1027 => '#9FF3E9', 1018 => '#12EED4', 151 => '#789082', 1022 => '#7F8E64', 135 => '#74869D', 1019 => '#00FFFF', 1013 => '#04AFEC', 107 => '#008F9C', 1028 => '#CCFFCC', 29 => '#A1C48C', 119 => '#A4BD47', 37 => '#4B974B', 1021 => '#3A7D15', 1020 => '#00FF00', 28 => '#287F47', 141 => '#27462D', 1029 => '#FFFFCC', 226 => '#FDEA8D', 1008 => '#C1BE42', 24 => '#F5CD30', 1017 => '#FFAF00', 1009 => '#FFFF00', 1005 => '#FFAF00', 105 => '#E29B40', 1025 => '#FFC9C9', 125 => '#EAB892', 101 => '#DA867A', 1007 => '#A34B4B', 1016 => '#FF66CC', 1032 => '#FF00BF', 1004 => '#FF0000', 21 => '#C4281C', 9 => '#E8BAC8', 1026 => '#B1A7FF', 1006 => '#B480FF', 153 => '#957977', 1023 => '#8C5B9F', 1015 => '#AA00AA', 1031 => '#6225D1', 104 => '#6B327C', 5 => '#D7C59A', 1030 => '#FFCC99', 18 => '#CC8E69', 106 => '#DA8541', 38 => '#A05F35', 1014 => '#AA5500', 217 => '#7C5C46', 192 => '#694028', 1001 => '#F8F8F8', 1 => '#F2F3F3', 208 => '#E5E4DF', 1002 => '#CDCDCD', 194 => '#A3A2A5', 199 => '#635F62', 26 => '#1B2A35', 1003 => '#111111'];
$chunks = array_chunk(array_keys($colors), 8, true);
@endphp

<div id="Popup{{ $part }}" class="modalPopup unifiedModal ColorPickerModal simplemodal-data">
    <div style="height:38px; padding-top:2px;">Choose a Body Color</div>
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="left:-36px;"></a>
    </div>
    <div class="unifiedModalContent ColorPickerContainer">
        <table cellspacing="0" border="0" style="border-width:0px; border-collapse:collapse;">
            @foreach ($chunks as $row)
                <tr>
                    @foreach ($row as $colorId)
                        <td>
                            <div class="ColorPickerItem" onclick="__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$ColorChooser{{ $part }}$DataListColors$ctl63$LinkButton1','{{ $colorId }}')" style="display:inline-block; background-color:{{ $colors[$colorId] }}; height:40px; width:40px;">
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</div>