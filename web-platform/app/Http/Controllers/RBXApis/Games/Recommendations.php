<?php
namespace App\Http\Controllers\RBXApis\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Recommendations extends Controller
{
    public function omniSorts(Request $request)
    {
        return response()->json([
            'pageType' => 'Home',
            'requestId' => \Illuminate\Support\Str::uuid()->toString(),
            'sorts' => [
                [
                    'topic' => 'bitch ass game',
                    'topicId' => 100000000,
                    'treatmentType' => 'SortlessGrid',
                    'recommendationList' => [
                        [
                            'contentType' => 'Game',
                            'contentId' => 1,
                            'contentStringId' => '',
                            'contentMetadata' => new \stdClass(),
                            'analyticsData' => ['sourceSortId' => '100000000']
                        ]
                    ],
                    'nextPageTokenForTopic' => null,
                    'numberOfRows' => 2,
                    'topicLayoutData' => [
                        'enableExplicitFeedback' => 'true',
                        'enableSponsoredFeedback' => 'true',
                        'playButtonStyle' => 'Disabled',
                        'componentType' => 'GridTile'
                    ],
                    'analyticsData' => new \stdClass(),
                    'subId' => ''
                ]
            ],
            'sortsRefreshInterval' => 10800,
            'contentMetadata' => [
                'Game' => [
                    '1686885941' => [
                        'totalUpVotes' => 8070793,
                        'totalDownVotes' => 1322654,
                        'universeId' => 1,
                        'name' => 'Lunarix Hangout',
                        'rootPlaceId' => 1,
                        'description' => null,
                        'playerCount' => 11121212,
                        'primaryMediaAsset' => new \stdClass(),
                        'under9' => false,
                        'under13' => false,
                        'minimumAge' => 0,
                        'contentMaturity' => 'minimal',
                        'ageRecommendationDisplayName' => 'Maturity: Minimal',
                        'friendVisits' => null,
                        'layoutDataBySort' => new \stdClass()
                    ]
                ]
            ],
            'contentMetadataByStringId' => [
                'RecommendedFriend' => new \stdClass(),
                'CatalogAvatar' => new \stdClass()
            ],
            'nextPageToken' => '',
            'isSessionExpired' => false,
            'globalLayoutData' => new \stdClass(),
            'isPartialFeed' => false,
            'DebugInfoGroups' => null,
            'sdui' => null
        ]);
    }
}