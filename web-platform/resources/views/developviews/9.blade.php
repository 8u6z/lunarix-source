                    
                    
                                                  <table class="section-header">
                          <tbody>
                          <a href="/places/create" id="CreatePlace" class="create-new-button btn-medium btn-primary">Create New Place</a>
                              <tr>
                          <td class="content-title">
                            <div>
                              <h2 class="header-text">Places</h2>
                            </div>
                          </td>
                          <td>
                            <div class="creation-context-filters-and-sorts" data-fetchplaceurl="/build/gamesbycontext?groupId=">
                              <div class="option">
                                <label class="sort-label">Created by:</label>
                                <select class="place-creationcontext-drop-down" size="1">
                                  <option value="NonGameCreation"> Me </option>
                                  <option value="GameAuthorsCreation">My Games</option>
                                  <option value="NonGameAuthorsCreation">Other Games</option>
                                </select>
                              </div>
                            </div>
                          </td>
                        </tr>
                                                  
                        <tr class="creation-context-breadcrumb" style="display:none">
                          <td style="height:21px">
                            <div class="breadCrumb creation-context-breadcrumb">
                              <a href="#breadcrumbs=gamecontext" class="breadCrumbContext">Context</a>
                              <span class="context-game-separator" style="display:none"> » </span>
                              <a href="#breadcrumbs=game" class="breadCrumbGame notranslate" style="display:none">Game</a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="items-container games-container">
                      <script>
                        function editGameInStudio(play_placeId) {
                          LunarixLaunch._GoogleAnalyticsCallback = function() {
                            var isInsideLunarixIDE = 'website';
                            if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) {
                              isInsideLunarixIDE = 'Studio';
                            };
                            GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);
                            GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Edit']);
                            EventTracker.fireEvent('GameLaunchAttempt_Win32', 'GameLaunchAttempt_Win32_Plugin');
                            if (typeof Lunarix.GamePlayEvents != 'undefined') {
                              Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId);
                            }
                          };
                          Lunarix.Client.WaitForLunarix(function() {
                            if (Lunarix.VideoPreRollDFP) {
                              Lunarix.VideoPreRollDFP.showVideoPreRoll = false;
                            }
                            LunarixLaunch.StartGame('/Game/edit.ashx?PlaceID=' + play_placeId + '&upload=' + play_placeId, 'edit.ashx', '/Login/Negotiate.ashx', 'FETCH', true);
                          });
                        }
                      </script>
                      <span id="verifiedEmail" style="display:none"></span>
                      <span id="assetLinks" style="display:none" data-asset-links-enabled="True"></span>
                      @forelse ($assets as $asset)
                        <table class="item-table" data-item-id="{{ $asset->id }}" data-type="game" data-universeid="0">
                        <tbody>
                          <tr>
                            <td class="image-col">
                              <a href="/games/{{ $asset->id }}/{{ $asset->getSlug() }}" class="game-image">
                                <img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" alt="{{ $asset->name }}" width="70" height="70">
                              </a>
                            </td>
                            <td class="name-col">
                              <a class="title notranslate" href="/games/{{ $asset->id }}/{{ $asset->getSlug() }}">{{ $asset->name }}</a>
                              <table class="details-table">
                                <tbody>
                                  <tr>
                                    <td class="activate-cell">
                                      <a class="place-active" href="/universes/configure?id={{ $asset->id }}">
                                          Active
                                      </a>
                                    </td>
                                    <td class="item-date">
                                      <span>Updated:</span>{{ $asset->updated_at->format('n/j/Y') }}                                    </td>
                                    
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td class="stats-col-games">
                              <div class="totals-label">Total Visitors: <span>{{ $asset->visits ?? 0 }}</span>
                              </div>
                              <div class="totals-label">Last 7 days: <span>0</span>
                              </div>
                            </td>
                            <td class="edit-col">
                              <a class="lunarix-edit-button btn-control btn-control-large" href="javascript:">Edit</a>
                            </td>
                            <td class="menu-col">
                              <div class="gear-button-wrapper">
                                <a href="#" class="gear-button"></a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
			@unless ($loop->last)
<div class="separator"></div>
			@endunless
			@empty
			@endforelse
                    </div>
                    <div class="build-loading-container" style="display:none">
                      <div class="buildpage-loading-container">
                        <img alt="^_^" src="https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif">
                      </div>
                    </div>