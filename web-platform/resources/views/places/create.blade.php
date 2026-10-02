@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___335c7b8a45e52c280387f93bc1a3a19c_m.css">
@endpush
@push('js')
<script src="https://js.lunarix.lol/c6b47ce9ee4cd0423d35c985917d2b4e.js"></script>
<script src="/js/CreatePlace.js"></script>
@endpush
@section('content')
@include('layout.header')
       <div id="navContent" class="nav-content"><div class="nav-content-inner">
    <div id="MasterContainer" >
        

<script type="text/javascript">
    $(function(){
        function trackReturns() {
            function dayDiff(d1, d2) {
                return Math.floor((d1-d2)/86400000);
            }
            if (!localStorage) {
                return false;
            }

            var cookieName = 'RBXReturn';
            var cookieOptions = {expires:9001};
            var cookieStr = localStorage.getItem(cookieName) || "";
            var cookie = {};

            try {
                cookie = JSON.parse(cookieStr);
            } catch (ex) {
                // busted cookie string from old previous version of the code
            }

            try {
                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }
            } catch (ex) {
                return false;
            }

            var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
            if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
                LunarixEventManager.triggerEvent('lrx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                LunarixEventManager.triggerEvent('lrx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

        GoogleListener.init();


    
        LunarixEventManager.initialize(true);
        LunarixEventManager.triggerEvent('lrx_evt_pageview');
        trackReturns();
        

    
        LunarixEventManager._idleInterval = 450000;
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_initial_install_start');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_ftp');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_initial_install_success');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_fmp');
        LunarixEventManager.startMonitor();
        

    });

</script>



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>
        
        @include('layout.body.alert')
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
<div id="BodyWrapper">
    <div id="RepositionBody">
        <div id="Body" style='width:970px;'>
            <div>
                <h1>Create Place</h1>
            <div id="CreateTabs" class="tab-container">
                    <div id="TemplatesTab" class="tab-active">Templates</div>
                    <div id="BasicSettingsTab">Basic Settings</div>
                    <div id="AccessTab">Access</div>
                    <div id="AdvancedSettingsTab" >Advanced Settings</div>
                </div>
                <div>
                    <div id="Templates" class="tab-active">
                    
                    </div>
                    <div id="BasicSettings">
                        <h2 style="margin-bottom:30px;">Basic Settings</h2>
                        <form style="display:flex;flex-direction:column;gap:6px;">
                            <label>Name:</label>
                            <input type="text" name="name" value="{{ $defaultName }}" style="width: 400px;">
                            <label>Description:</label>
                            <textarea type="text" name="description" style="width: 400px; height: 100px;"></textarea>
                            <label>Genre:</label>
                            <select name="genre" style="height:20px;width:100px;">
                                <option value="all">All</option>
                                <option value="adventure">Adventure</option>
                                <option value="building">Building</option>
                                <option value="comedy">Comedy</option>
                                <option value="fighting">Fighting</option>
                                <option value="fps">FPS</option>
                                <option value="horror">Horror</option>
                                <option value="medieval">Medieval</option>
                                <option value="military">Military</option>
                                <option value="naval">Naval</option>
                                <option value="rpg">RPG</option>
                                <option value="scifi">Sci-Fi</option>
                                <option value="sports">Sports</option>
                                <option value="townandcity">Town and City</option>
                                <option value="western">Western</option>
                            </select>
                        </form>
                    </div>
                    <div id="Access">
                        <div id="playerAccess" class="default-hidden" style="display: block;">
                        <div class="headline" style="margin-bottom:20px;">
                        <h2>Access</h2>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:6px;">
                        <div id="devices">
                            <label>Playable Devices:</label><br>
                            <input type="checkbox" name="devices" value="Computer" checked><label style="margin-left:8px;">Computer</label><br>
                            <input type="checkbox" name="devices" value="Phone" checked><label style="margin-left:8px;">Phone</label><br>
                            <input type="checkbox" name="devices" value="Tablet" checked><label style="margin-left:8px;">Tablet</label><br>
                        </div>
                        <div id="servertype" style="margin-top:15px;">
                            <label>Place Type:</label>
                            <ul class="nav nav-pills">
                                <li class="active" data-type="game"><a>Game Place</a></li>
                                <li data-type="personal"><a>Personal Server</a></li>
                            </ul>
                        </div>
                        <div id="options" style="display:flex;flex-direction:column;gap:8px;margin-top:15px;">
                            <label class="form-label" for="NumPlayers">Number of Players:</label>
                            <select class="form-select" id="NumPlayers" name="NumPlayers" style="margin:0;height:20px;width:100px;">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>  
                                <option selected="selected">6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                                <option>24</option>
                                <option>25</option>
                                <option>26</option>
                                <option>27</option>
                                <option>28</option>
                                <option>29</option>
                                <option>30</option>
                                <option>31</option>
                                <option>32</option>
                                <option>33</option>
                                <option>34</option>
                                <option>35</option>
                                <option>36</option>
                                <option>37</option>
                                <option>38</option>
                                <option>39</option>
                                <option>40</option>
                                <option>41</option>
                                <option>42</option>
                                <option>43</option>
                                <option>44</option>
                                <option>45</option>
                                <option>46</option>
                                <option>47</option>
                                <option>48</option>
                                <option>49</option>
                                <option>50</option>
                            </select>
                            <label class="form-label" for="Access">Access:</label>
                            <select class="form-select" id="Access" name="Access" style="margin:0;height:20px;width:100px;">
                                <option selected="selected">Everyone</option>
                                <option>Friends</option>
                                <option>No One</option>
                            </select>
                            <img class="TipsyImg tooltip-bottom h2-tooltip place-access-tooltip" src="/images/65cb6e4009a00247ca02800047aafb87.png" data-toggle="tooltip" alt="To restrict who may access this place, first you must disable private servers and not sell experience access." data-original-title="To restrict who may access this place, first you must disable private servers and not sell experience access." original-title="" style="display: none;">
                            <span class="field-validation-valid" data-valmsg-for="Access" data-valmsg-replace="true"></span>
                            <div style="clear:both;"></div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div id="AdvancedSettings">
                        <div class="headline">
                        <h2>wip</h2>
                        </div>
                        </div>
                        <a id="CreatePlaceSubmit" class="btn-medium btn-primary" style="float:left;margin-left: 15px;">Create Place</a>
                        <a class="btn-medium btn-negative" href="/develop?View=9" style="margin-left: 15px;">Cancel</a>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>
        <div id="ProcessingView" class="ProcessingView" style="display:none">
            <div class="ProcessingModalBody">
                <p style="margin:0px"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Processing..." /></p>
                <p style="margin:7px 0px">Creating Place...</p>
            </div>
        </div>
@include('layout.footerlegacy')
@endsection