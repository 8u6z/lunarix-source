!(function () {
    var n = {
            779: function (e, t) {
                var n;
                /*!
	Copyright (c) 2018 Jed Watson.
	Licensed under the MIT License (MIT), see
	http://jedwatson.github.io/classnames
*/
                !(function () {
                    "use strict";
                    var i = {}.hasOwnProperty;
                    function c() {
                        for (var e = [], t = 0; t < arguments.length; t++) {
                            var n = arguments[t];
                            if (n) {
                                var r,
                                    a = typeof n;
                                if ("string" == a || "number" == a) e.push(n);
                                else if (Array.isArray(n)) !n.length || ((r = c.apply(null, n)) && e.push(r));
                                else if ("object" == a)
                                    if (
                                        n.toString === Object.prototype.toString ||
                                        n.toString.toString().includes("[native code]")
                                    )
                                        for (var o in n) i.call(n, o) && n[o] && e.push(o);
                                    else e.push(n.toString());
                            }
                        }
                        return e.join(" ");
                    }
                    e.exports
                        ? ((c.default = c), (e.exports = c))
                        : void 0 ===
                              (n = function () {
                                  return c;
                              }.apply(t, [])) || (e.exports = n);
                })();
            },
            226: function (e) {
                e.exports = 'module.exports = __webpack_public_path__ + "../html/navigation.html";';
            },
        },
        r = {};
    function Ar(e) {
        if (r[e]) return r[e].exports;
        var t = (r[e] = { exports: {} });
        return n[e](t, t.exports, Ar), t.exports;
    }
    (Ar.n = function (e) {
        var t =
            e && e.__esModule
                ? function () {
                      return e.default;
                  }
                : function () {
                      return e;
                  };
        return Ar.d(t, { a: t }), t;
    }),
        (Ar.d = function (e, t) {
            for (var n in t) Ar.o(t, n) && !Ar.o(e, n) && Object.defineProperty(e, n, { enumerable: !0, get: t[n] });
        }),
        (Ar.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (function () {
            "use strict";
            function t() {
                return document.getElementById("navigation-container");
            }
            var j = React,
                L = Ar.n(j),
                q = CoreUtilities,
                e = ReactDOM,
                D = Roblox,
                n = Ar.n(D),
                d = HeaderScripts,
                M = ReactUtilities,
                _ = { arrowUp: 38, arrowDown: 40, tab: 9, enter: 13 },
                r = "container-main",
                a = { name: "Roblox.Logout" },
                o = 1,
                i = { clickMerchandise: "clickMerchandiseInLeftNav", goToAmazonStore: "clickContinueToAmazonStore" },
                c = {
                    friendshipNotifications: "FriendshipNotifications",
                    requestCountChanged: "Roblox.Friends.CountChanged",
                    friendshipCreated: "FriendshipCreated",
                    friendshipDestroyed: "FriendshipDestroyed",
                    friendshipDeclined: "FriendshipDeclined",
                    friendshipRequested: "FriendshipRequested",
                },
                u = { name: "Roblox.Messages.CountChanged" },
                l = "?",
                s = { name: "headerMenuIconClick" },
                f = { quickLogin: "quickLogin", logout: "logout", settings: "settings" },
                m = { common: ["CommonUI.Features", "Common.AlertsAndOptions"], feature: "Feature.ShopDialog" },
                p = PropTypes,
                v = Ar.n(p),
                b = Ar(779),
                h = Ar.n(b),
                y = ReactStyleGuide,
                g = RobloxThumbnails,
                S = RobloxBadges,
                E = D.EnvironmentUrls.apiGatewayUrl,
                w = D.EnvironmentUrls.apiGatewayCdnUrl,
                F =
                    (D.EnvironmentUrls.localeApi,
                    {
                        experimentLayer: "Website.TopNavSearchBox",
                        debounceTimeout: 100,
                        debouncedSearchInputMaxLength: 35,
                        expiryTimeout: 5e3,
                        variationId: 1,
                        trendingVariationId: 0,
                        avatarAutocompleteQueryPaddingAmount: 10,
                        requestSuggestionUrl: {
                            url: E + "/games-autocomplete/v1/request-suggestion",
                            withCredentials: !0,
                        },
                        getSuggestionUrl: { url: E + "/games-autocomplete/v1/get-suggestion/", withCredentials: !0 },
                        avatarRequestSuggestionUrl: { url: E + "/autocomplete-avatar/v2/suggest", withCredentials: !0 },
                        avatarRequestSuggestionCdnUrl: {
                            url: w + "/autocomplete-avatar/v2/suggest",
                            withCredentials: !0,
                        },
                        englishLanguageCode: "en",
                        avatarAutocompleteUrlLocations: ["Catalog", "Trades", "Inventory", "Avatar", "CatalogItem"],
                        avatarAutocompleteSuggestionLimit: 5,
                        isSpecialTreatmentAutocompleteRestricted: function () {
                            return (
                                7 === parseInt(t().dataset.numberOfAutocompleteSuggestions, 10) &&
                                B.miscSearchLink
                                    .reduce(function (e, t) {
                                        return e.push.apply(e, t.pageSort), e;
                                    }, [])
                                    .reduce(function (e, t) {
                                        return e || -1 < window.location.pathname.indexOf(t);
                                    }, !1)
                            );
                        },
                        isSpecialTreatment: function () {
                            var e;
                            return (
                                7 ===
                                parseInt(
                                    null === (e = t()) || void 0 === e
                                        ? void 0
                                        : e.dataset.numberOfAutocompleteSuggestions,
                                    10
                                )
                            );
                        },
                        numberOfSpecialTreatmentAutocompleteSuggestions: 3,
                        isAutocompleteSuggestionsIXPTestEnabled: function () {
                            var e;
                            return (
                                0 <
                                parseInt(
                                    null === (e = t()) || void 0 === e
                                        ? void 0
                                        : e.dataset.numberOfAutocompleteSuggestions,
                                    10
                                )
                            );
                        },
                        numberOfAutocompleteSuggestions: function () {
                            var e;
                            return (
                                parseInt(
                                    null === (e = t()) || void 0 === e
                                        ? void 0
                                        : e.dataset.numberOfAutocompleteSuggestions,
                                    10
                                ) || 0
                            );
                        },
                        isRedirectLibraryToCreatorMarketplaceEnabled: function () {
                            var e;
                            return (
                                "True" ===
                                (null === (e = t()) || void 0 === e
                                    ? void 0
                                    : e.dataset.isRedirectLibraryToCreatorMarketplaceEnabled)
                            );
                        },
                    }),
                O = (0, D.Endpoints.getAbsoluteUrl)("/moderation-portal/"),
                C = function (e, t) {
                    for (var n = 0, r = t.length, a = e.length; n < r; n++, a++) e[a] = t[n];
                    return e;
                },
                x = D.Endpoints.getAbsoluteUrl,
                p = D.EnvironmentUrls.authApi,
                b = {
                    url: x("/discover/?Keyword="),
                    label: "Label.Experience",
                    pageSort: ["home", "games", "discover"],
                    icon: "icon-menu-games-off",
                },
                E = {
                    url: x("/catalog?CatalogContext=1&Keyword="),
                    label: "Heading.Marketplace",
                    pageSort: ["catalog", "inventory", "bundles", "my/avatar", "trades"],
                    icon: "icon-menu-shop",
                },
                w = [
                    {
                        url: x("/search/users?keyword="),
                        label: "Label.Players",
                        pageSort: ["users"],
                        icon: "icon-menu-profile",
                    },
                    E,
                    {
                        url: x("/search/groups?keyword="),
                        label: "Label.sGroups",
                        pageSort: ["groups"],
                        icon: "icon-menu-groups",
                    },
                    {
                        url: x("/develop/library?CatalogContext=2&Category=6&Keyword="),
                        label: "Label.CreatorMarketplace",
                        pageSort: ["develop"],
                        icon: "icon-menu-library",
                    },
                ],
                B = {
                    creatorMarketplaceUrl:
                        "https://create." + D.EnvironmentUrls.domain + "/marketplace/models?keyword=",
                    scrollListItems: {
                        home: {
                            url: x("/"),
                            idSelector: "nav-home",
                            iconClass: "icon-nav-home",
                            name: "home",
                            labelTranslationKey: "Label.sHome",
                        },
                        profile: {
                            url: x("/users/" + d.authenticatedUser.id + "/profile"),
                            idSelector: "nav-profile",
                            iconClass: "icon-nav-profile",
                            name: "profile",
                            labelTranslationKey: "Label.sProfile",
                        },
                        messages: {
                            url: x("/my/messages/#!/inbox"),
                            urlForNotification: x("/my/messages/#!/inbox"),
                            idSelector: "nav-message",
                            iconClass: "icon-nav-message",
                            name: "messages",
                            labelTranslationKey: "Label.sMessages",
                        },
                        friends: {
                            url: x("/users/friends"),
                            urlForNotification: x("/users/friends#!/friend-requests"),
                            idSelector: "nav-friends",
                            iconClass: "icon-nav-friends",
                            name: "friends",
                            labelTranslationKey: "Label.sFriends",
                        },
                        avatar: {
                            url: x("/my/avatar"),
                            idSelector: "nav-character",
                            iconClass: "icon-nav-charactercustomizer",
                            name: "avatar",
                            labelTranslationKey: "Label.sAvatar",
                        },
                        inventory: {
                            url: x("/users/" + d.authenticatedUser.id + "/inventory"),
                            idSelector: "nav-inventory",
                            iconClass: "icon-nav-inventory",
                            name: "inventory",
                            labelTranslationKey: "Label.sInventory",
                        },
                        trade: {
                            url: x("/trades"),
                            urlForNotification: x("/trades"),
                            idSelector: "nav-trade",
                            iconClass: "icon-nav-trade",
                            name: "trade",
                            labelTranslationKey: "Label.sTrade",
                        },
                        groups: {
                            url: x("/my/groups"),
                            idSelector: "nav-group",
                            iconClass: "icon-nav-group",
                            name: "groups",
                            labelTranslationKey: "Label.sGroups",
                        },
                        blog: {
                            url: x("https://blog.lunarix.my"),
                            idSelector: "nav-blog",
                            iconClass: "icon-nav-blog",
                            name: "blog",
                            labelTranslationKey: "Label.sBlog",
                            blankTarget: !0,
                        },
                    },
                    sponsorEvents: { label: { labelTranslationKey: "Label.sEvents" }, events: {} },
                    gameSearchLink: b,
                    avatarSearchLink: E,
                    miscSearchLink: w,
                    universalSearchUrls: [
                        { url: x("/search/users?keyword="), label: "Label.Players", pageSort: [] },
                        {
                            url: x("/games/?Keyword="),
                            label: "Label.Games",
                            pageSort: ["home", "games", "discover"],
                        },
                        {
                            url: x("/catalog/browse.aspx?CatalogContext=1&Keyword="),
                            label: "Label.sCatalog",
                            pageSort: ["catalog", "inventory", "bundles"],
                        },
                        { url: x("/search/groups?keyword="), label: "Label.sGroups", pageSort: ["groups"] },
                        {
                            url: x("/develop/library?CatalogContext=2&Category=6&Keyword="),
                            label: "Label.CreatorMarketplace",
                            pageSort: ["develop"],
                        },
                    ],
                    newUniversalSearchUrls: C([b], w),
                    settingsUrl: {
                        settings: { url: x("/my/account"), label: "Label.sSettings" },
                        quickLogin: { url: x("/home"), label: "Label.sQuickLogin" },
                        help: { url: x("/info/help?locale="), label: "Label.sHelp" },
                        logout: { url: p + "/v2/logout", label: "Label.sLogout" },
                    },
                    buyRobuxUrl: {
                        robuxBalance: { url: x("/transactions"), label: "Label.sRobuxMessage" },
                        buyRobux: { url: x("/upgrades/robux?ctx=navpopover"), label: "Label.sBuyRobux" },
                    },
                    userDataUrl: x("/navigation/userData"),
                    quickLoginUrl: x("/crossdevicelogin/ConfirmCode"),
                },
                A = D.Endpoints.getAbsoluteUrl,
                I = D.EnvironmentUrls.authApi,
                k = D.EnvironmentUrls.accountSettingsApi,
                N = D.EnvironmentUrls.websiteUrl,
                R = (D.EnvironmentUrls.adsApi, D.EnvironmentUrls.economyApi),
                T = D.EnvironmentUrls.privateMessagesApi,
                U = D.EnvironmentUrls.tradesApi,
                P = D.EnvironmentUrls.friendsApi,
                C =
                    (D.EnvironmentUrls.apiGatewayUrl,
                    function () {
                        return A("/account/signupredir");
                    }),
                b = function () {
                    return N;
                },
                w = function () {
                    return A("/");
                },
                O = function (e, t) {
                    return A("/".concat(e.toLowerCase(), "/").concat(t));
                },
                p = function () {
                    return A("/login");
                },
                G = function () {
                    return "".concat(k, "/v1/email");
                },
                K = function () {
                    return "".concat(I, "/v2/logout");
                },
                V = function () {
                    return "".concat(T, "/v1/messages/unread/count");
                },
                Q = function (e) {
                    return "".concat(R, "/v1/users/").concat(e, "/currency");
                },
                H = function () {
                    return "".concat(U, "/v1/trades/inbound/count");
                },
                W = function () {
                    return "".concat(P, "/v1/user/friend-requests/count");
                },
                z = function () {
                    var e = { url: V(), withCredentials: !0 };
                    return q.httpService.get(e);
                },
                $ = function (e) {
                    e = { url: Q(e), withCredentials: !0 };
                    return q.httpService.get(e);
                },
                X = function () {
                    var e = { url: H(), withCredentials: !0 };
                    return q.httpService.get(e);
                },
                Y = function () {
                    var e = { url: W(), withCredentials: !0 };
                    return q.httpService.get(e);
                },
                J = function () {
                    var e = { url: G(), withCredentials: !0 };
                    return q.httpService.get(e);
                },
                Z = function () {
                    var e = { url: K(), withCredentials: !0 };
                    return q.httpService.post(e);
                },
                ee = CoreRobloxUtilities;
            function te(e, t, n) {
                return (
                    t in e
                        ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 })
                        : (e[t] = n),
                    e
                );
            }
            var ne = ee.dataStores.userDataStore.maxFriendRequestNotificationCount;
            function re(e) {
                var t = e.translate,
                    n = e.idSelector,
                    r = e.isModal,
                    a = e.name,
                    o = e.iconClass,
                    i = e.labelTranslationKey,
                    c = e.url,
                    u = e.urlForNotification,
                    l = e.onClickShopLink,
                    s = e.friendsData,
                    f = e.messagesData,
                    m = e.tradeData,
                    p = e.blankTarget,
                    e = (te((e = {}), B.scrollListItems.friends.name, s),
                    te(e, B.scrollListItems.messages.name, f),
                    te(e, B.scrollListItems.trade.name, m),
                    e)[a],
                    c = null != e && e.count ? u : c,
                    p = p ? "_blank" : "_self";
                return r
                    ? L().createElement(
                          "li",
                          { key: a },
                          L().createElement(
                              "button",
                              { id: n, type: "button", onClick: l, className: "dynamic-overflow-container text-nav" },
                              L().createElement("div", null, L().createElement("span", { className: o })),
                              L().createElement("span", { className: "font-header-2 dynamic-ellipsis-item" }, t(i))
                          )
                      )
                    : L().createElement(
                          "li",
                          { key: a },
                          L().createElement(
                              y.Link,
                              { url: c, id: n, className: "dynamic-overflow-container text-nav", target: p },
                              L().createElement("div", null, L().createElement("span", { className: o })),
                              L().createElement("span", { className: "font-header-2 dynamic-ellipsis-item" }, t(i)),
                              e &&
                                  0 < e.count &&
                                  L().createElement(
                                      "div",
                                      { className: "dynamic-width-item align-right" },
                                      L().createElement(
                                          "span",
                                          {
                                              className: "notification-blue notification",
                                              title: q.numberFormat.getNumberFormat(e.count),
                                          },
                                          (function (e, t) {
                                              if (e === B.scrollListItems.friends.name && ne <= t)
                                                  return "".concat(ne, "+");
                                              return q.abbreviateNumber.getTruncValue(t, 1e3);
                                          })(a, e.count)
                                      )
                                  )
                          )
                      );
            }
            (re.defaultProps = {
                idSelector: "",
                url: "",
                urlForNotification: "",
                isModal: !1,
                blankTarget: !1,
                friendsData: { count: 0 },
                messagesData: { count: 0 },
                tradeData: { count: 0 },
            }),
                (re.propTypes = {
                    idSelector: v().string,
                    translate: v().func.isRequired,
                    isModal: v().bool,
                    name: v().string.isRequired,
                    iconClass: v().string.isRequired,
                    labelTranslationKey: v().string.isRequired,
                    url: v().string,
                    urlForNotification: v().string,
                    onClickShopLink: v().func.isRequired,
                    blankTarget: v().bool,
                    friendsData: v().shape({ count: v().number }),
                    messagesData: v().shape({ count: v().number }),
                    tradeData: v().shape({ count: v().number }),
                });
            var ae = re;
            (x = ee.eventStreamService.eventTypes).pageLoad, v().func.isRequired, v().instanceOf(Array);
            var x = angular,
                oe = Ar.n(x);
            function ie(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    ue(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function ce(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return le(e);
                    })(e) ||
                    (function (e) {
                        if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e);
                    })(e) ||
                    ue(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function ue(e, t) {
                if (e) {
                    if ("string" == typeof e) return le(e, t);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    return (
                        "Object" === n && e.constructor && (n = e.constructor.name),
                        "Map" === n || "Set" === n
                            ? Array.from(e)
                            : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                              ? le(e, t)
                              : void 0
                    );
                }
            }
            function le(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function se(e, t, n, r, a, o, i) {
                try {
                    var c = e[o](i),
                        u = c.value;
                } catch (e) {
                    return void n(e);
                }
                c.done ? t(u) : Promise.resolve(u).then(r, a);
            }
            function fe(c) {
                return function () {
                    var e = this,
                        i = arguments;
                    return new Promise(function (t, n) {
                        var r = c.apply(e, i);
                        function a(e) {
                            se(r, t, n, a, o, "next", e);
                        }
                        function o(e) {
                            se(r, t, n, a, o, "throw", e);
                        }
                        a(void 0);
                    });
                };
            }
            function me() {
                var t = d.authenticatedUser.id;
                return Z().then(
                    fe(
                        regeneratorRuntime.mark(function e() {
                            return regeneratorRuntime.wrap(
                                function (e) {
                                    for (;;)
                                        switch ((e.prev = e.next)) {
                                            case 0:
                                                return (
                                                    (e.prev = 0),
                                                    (e.next = 3),
                                                    ee.cryptoUtil.deleteUserCryptoKeyPairUponLogout(t.toString())
                                                );
                                            case 3:
                                                e.next = 8;
                                                break;
                                            case 5:
                                                (e.prev = 5), (e.t0 = e.catch(0)), console.debug(e.t0);
                                            case 8:
                                                window.location.href = Se();
                                            case 9:
                                            case "end":
                                                return e.stop();
                                        }
                                },
                                e,
                                null,
                                [[0, 5]]
                            );
                        })
                    )
                );
            }
            var pe = B.universalSearchUrls,
                de = B.newUniversalSearchUrls,
                ve = B.avatarSearchLink,
                be = q.urlService.getQueryParam,
                ye = (q.urlService.parseUrl, q.urlService.composeQueryString),
                ge = C,
                he = p,
                Se = w,
                Ee = o,
                we = a,
                Oe = !d.authenticatedUser.isAuthenticated,
                C = function () {
                    var r = d.authenticatedUser.created;
                    return J()
                        .then(function (e) {
                            var t,
                                n = e.data.verified;
                            return (t = r), (e = n), (n = new Date()), (t = new Date(t)), +(Ee < (n - t) / 864e5 && !e);
                        })
                        .catch(function (e) {
                            console.debug(e);
                        });
                },
                p = function () {
                    var e = (e = be("returnUrl") || window.location.href) === he() ? "" : e,
                        t = ge();
                    return "".concat(t, "?").concat(ye({ returnUrl: e }));
                },
                b = function () {
                    var e = be("returnUrl") || window.location.href,
                        t = he();
                    return "".concat(t, "?").concat(ye({ returnUrl: e }));
                },
                w = function (e) {
                    e.stopPropagation(),
                        e.preventDefault(),
                        document.dispatchEvent(new CustomEvent(we.name)),
                        oe().isUndefined(oe().element("#chat-container").scope()) ||
                            (e = oe().element("#chat-container").scope()).$digest(
                                e.$broadcast("Roblox.Chat.destroyChatCookie")
                            ),
                        null !== D.EmailVerificationService &&
                            void 0 !== D.EmailVerificationService &&
                            D.EmailVerificationService.handleUserEmailUpsellAtLogout(me).then(function (e) {
                                (e && !e.emailAddress) || me();
                            });
                },
                o = me,
                Ce = function (e) {
                    D.EventStream && D.EventStream.SendEventWithTarget(e, "click", {}, D.EventStream.TargetTypes.WWW);
                },
                xe = function (e) {
                    if (Oe || !D.RealTime) return function () {};
                    document.addEventListener(c.requestCountChanged, e);
                    var t = D.RealTime.Factory.GetClient();
                    return (
                        t.Subscribe(c.friendshipNotifications, e),
                        function () {
                            document.removeEventListener(c.requestCountChanged, e),
                                t.Unsubscribe(c.friendshipNotifications, e);
                        }
                    );
                },
                Ae = function (e) {
                    return Oe || !D.RealTime
                        ? function () {}
                        : (document.addEventListener(u, e),
                          function () {
                              document.removeEventListener(u, e);
                          });
                },
                Ie = function () {
                    var e;
                    return null !== (e = (null === (e = window) || void 0 === e ? void 0 : e.innerWidth) < 543) && e;
                },
                a = function () {
                    var e = (null === (e = window) || void 0 === e ? void 0 : e.location).pathname,
                        e = null !== (e = null == e ? void 0 : e.toLowerCase()) && void 0 !== e ? e : "";
                    return !e.startsWith("/login") && !e.startsWith("/newlogin");
                },
                ke = function () {
                    var e = ce(pe);
                    return (
                        e.sort(function (e) {
                            return e.pageSort.reduce(function (e, t) {
                                return e || -1 < window.location.href.indexOf(t);
                            }, !1)
                                ? -1
                                : 1;
                        }),
                        e
                    );
                },
                Ne = function () {
                    var e = ce(de),
                        t = e.filter(function (e) {
                            return e.pageSort.some(function (e) {
                                return -1 < window.location.pathname.indexOf(e);
                            });
                        }),
                        e = e.filter(function (e) {
                            return e.pageSort.every(function (e) {
                                return -1 === window.location.pathname.indexOf(e);
                            });
                        });
                    return [].concat(ce(t), ce(e));
                },
                Re = function () {
                    return ve.pageSort.some(function (e) {
                        return -1 < window.location.pathname.indexOf(e);
                    });
                },
                Te = function () {
                    return (
                        document.getElementById("navigation-container") &&
                        document.getElementById("navigation-container").className
                    );
                },
                Ue = function (e) {
                    var n = {};
                    return (
                        ("?" === e[0] ? e.substr(1) : e).split("&").forEach(function (e) {
                            var t;
                            e.includes("=") &&
                                ((e = (t = ie(e.split("="), 2))[0]),
                                (t = t[1]),
                                (n[null === (e = decodeURIComponent(e)) || void 0 === e ? void 0 : e.toLowerCase()] =
                                    decodeURIComponent(t)));
                        }),
                        n
                    );
                };
            function Pe() {
                return (Pe =
                    Object.assign ||
                    function (e) {
                        for (var t = 1; t < arguments.length; t++) {
                            var n,
                                r = arguments[t];
                            for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]);
                        }
                        return e;
                    }).apply(this, arguments);
            }
            function je(t, e) {
                var n,
                    r = Object.keys(t);
                return (
                    Object.getOwnPropertySymbols &&
                        ((n = Object.getOwnPropertySymbols(t)),
                        e &&
                            (n = n.filter(function (e) {
                                return Object.getOwnPropertyDescriptor(t, e).enumerable;
                            })),
                        r.push.apply(r, n)),
                    r
                );
            }
            function Le(r) {
                for (var e = 1; e < arguments.length; e++) {
                    var a = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? je(Object(a), !0).forEach(function (e) {
                              var t, n;
                              (t = r),
                                  (e = a[(n = e)]),
                                  n in t
                                      ? Object.defineProperty(t, n, {
                                            value: e,
                                            enumerable: !0,
                                            configurable: !0,
                                            writable: !0,
                                        })
                                      : (t[n] = e);
                          })
                        : Object.getOwnPropertyDescriptors
                          ? Object.defineProperties(r, Object.getOwnPropertyDescriptors(a))
                          : je(Object(a)).forEach(function (e) {
                                Object.defineProperty(r, e, Object.getOwnPropertyDescriptor(a, e));
                            });
                }
                return r;
            }
            function qe(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return De(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return De(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function De(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Me(e, t) {
                if (null == e) return {};
                var n,
                    r = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            a = {},
                            o = Object.keys(e);
                        for (r = 0; r < o.length; r++) (n = o[r]), 0 <= t.indexOf(n) || (a[n] = e[n]);
                        return a;
                    })(e, t);
                if (Object.getOwnPropertySymbols)
                    for (var a = Object.getOwnPropertySymbols(e), o = 0; o < a.length; o++)
                        (n = a[o]),
                            0 <= t.indexOf(n) || (Object.prototype.propertyIsEnumerable.call(e, n) && (r[n] = e[n]));
                return r;
            }
            var _e = i;
            function Fe(e) {
                var t = e.translate,
                    n = Me(e, ["translate"]),
                    r = qe((0, j.useState)(!1), 2),
                    a = r[0],
                    o = r[1],
                    i = (0, j.useCallback)(function () {
                        o(function (e) {
                            return !e;
                        }),
                            Ce(_e.clickMerchandise);
                    }, []),
                    c = function () {
                        o(!1);
                    },
                    u = Object.values(B.scrollListItems).map(function (e) {
                        return L().createElement(
                            ae,
                            Pe({ key: e.name }, Le(Le({ translate: t, onClickShopLink: i }, e), n))
                        );
                    }),
                    e = null;
                    r = L().createElement(
                        L().Fragment,
                        null,
                        L().createElement(
                            "p",
                            { className: "shop-description" },
                            t("Description.RetailWebsiteRedirect")
                        ),
                        L().createElement("p", { className: "shop-warning" }, t("Description.PurchaseAgeWarning"))
                    ),
                    c = L().createElement(y.SimpleModal, {
                        title: t("Heading.LeavingRoblox"),
                        body: r,
                        show: a,
                        actionButtonShow: !0,
                        actionButtonText: t("Action.Continue"),
                        neutralButtonText: t("Action.Cancel"),
                        onAction: function () {
                            var e = decodeURIComponent(D.EnvironmentUrls.amazonWebStoreLink);
                            window.open(e, "_blank"), Ce(_e.goToAmazonStore);
                        },
                        onNeutral: c,
                        onClose: c,
                    });
                return L().createElement("ul", { className: "left-col-list" }, u, e, !1, c);
            }
            (Fe.defaultProps = { sponsoredPagesData: [] }),
                (Fe.propTypes = { sponsoredPagesData: v().instanceOf(Array), translate: v().func.isRequired });
            var Be = Fe;
            function Ge(t, e) {
                var n,
                    r = Object.keys(t);
                return (
                    Object.getOwnPropertySymbols &&
                        ((n = Object.getOwnPropertySymbols(t)),
                        e &&
                            (n = n.filter(function (e) {
                                return Object.getOwnPropertyDescriptor(t, e).enumerable;
                            })),
                        r.push.apply(r, n)),
                    r
                );
            }
            function Ke(r) {
                for (var e = 1; e < arguments.length; e++) {
                    var a = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? Ge(Object(a), !0).forEach(function (e) {
                              var t, n;
                              (t = r),
                                  (e = a[(n = e)]),
                                  n in t
                                      ? Object.defineProperty(t, n, {
                                            value: e,
                                            enumerable: !0,
                                            configurable: !0,
                                            writable: !0,
                                        })
                                      : (t[n] = e);
                          })
                        : Object.getOwnPropertyDescriptors
                          ? Object.defineProperties(r, Object.getOwnPropertyDescriptors(a))
                          : Ge(Object(a)).forEach(function (e) {
                                Object.defineProperty(r, e, Object.getOwnPropertyDescriptor(a, e));
                            });
                }
                return r;
            }
            function Ve(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Qe(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Qe(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Qe(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function He(e) {
                var n = d.authenticatedUser.isAuthenticated,
                    t = Ve((0, j.useState)({}), 2),
                    r = t[0],
                    a = t[1],
                    o = (c = Ve((0, j.useState)({}), 2))[0],
                    i = c[1],
                    c = (t = Ve((0, j.useState)({}), 2))[0],
                    u = t[1];
                return (
                    (0, j.useEffect)(function () {
                        var e = function () {},
                            t = function () {};
                        return (
                            n &&
                                ((e = xe(function () {
                                    Y().then(
                                        function (e) {
                                            e = e.data;
                                            a(e);
                                        },
                                        function (e) {
                                            console.debug(e);
                                        }
                                    );
                                })),
                                (t = Ae(function () {
                                    z().then(function (e) {
                                        e = e.data;
                                        i(e);
                                    });
                                })),
                                Y().then(
                                    function (e) {
                                        e = e.data;
                                        a(e);
                                    },
                                    function (e) {
                                        console.debug(e);
                                    }
                                ),
                                z().then(
                                    function (e) {
                                        e = e.data;
                                        i(e);
                                    },
                                    function (e) {
                                        console.debug(e);
                                    }
                                ),
                                X().then(
                                    function (e) {
                                        e = e.data;
                                        u(e);
                                    },
                                    function (e) {
                                        console.debug(e);
                                    }
                                )),
                            function () {
                                e(), t();
                            }
                        );
                    }, []),
                    L().createElement(Be, Ke({ friendsData: r, messagesData: o, tradeData: c }, e))
                );
            }
            var O = d.authenticatedUser.name,
                x = d.authenticatedUser.displayName,
                We = {
                    nameForDisplay:
                        null !== D.DisplayNames && void 0 !== D.DisplayNames && D.DisplayNames.Enabled() ? x : O,
                    nameForHeader:
                        null !== D.DisplayNames && void 0 !== D.DisplayNames && D.DisplayNames.Enabled()
                            ? q.concatTexts.concat(["", O])
                            : O,
                };
            function ze(e, t, n, r, a, o, i) {
                try {
                    var c = e[o](i),
                        u = c.value;
                } catch (e) {
                    return void n(e);
                }
                c.done ? t(u) : Promise.resolve(u).then(r, a);
            }
            function $e(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Xe(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Xe(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Xe(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Ye(e, t) {
                if (null == e) return {};
                var n,
                    r = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            a = {},
                            o = Object.keys(e);
                        for (r = 0; r < o.length; r++) (n = o[r]), 0 <= t.indexOf(n) || (a[n] = e[n]);
                        return a;
                    })(e, t);
                if (Object.getOwnPropertySymbols)
                    for (var a = Object.getOwnPropertySymbols(e), o = 0; o < a.length; o++)
                        (n = a[o]),
                            0 <= t.indexOf(n) || (Object.prototype.propertyIsEnumerable.call(e, n) && (r[n] = e[n]));
                return r;
            }
            function Je(e) {
                var t = e.isLeftNavOpen,
                    n = Ye(e, ["isLeftNavOpen"]),
                    r = $e((0, j.useState)(!1), 2),
                    e = r[0],
                    a = r[1],
                    o = (0, j.useRef)(null);
                (0, j.useEffect)(
                    function () {
                        (function () {
                            var c,
                                e =
                                    ((c = regeneratorRuntime.mark(function e() {
                                        return regeneratorRuntime.wrap(
                                            function (e) {
                                                for (;;)
                                                    switch ((e.prev = e.next)) {
                                                        case 0:
                                                            e.next = 4;
                                                            break;
                                                        case 4:
                                                            return (
                                                                (e.prev = 4),
                                                                (e.next = 7),
                                                                (0, S.robloxBadgesReadyForRender)()
                                                            );
                                                        case 7:
                                                            e.sent && a((0, S.currentUserHasVerifiedBadge)()),
                                                                (e.next = 14);
                                                            break;
                                                        case 11:
                                                            (e.prev = 11), (e.t0 = e.catch(4)), a(!1);
                                                        case 14:
                                                        case "end":
                                                            return e.stop();
                                                    }
                                            },
                                            e,
                                            null,
                                            [[4, 11]]
                                        );
                                    })),
                                    function () {
                                        var e = this,
                                            i = arguments;
                                        return new Promise(function (t, n) {
                                            var r = c.apply(e, i);
                                            function a(e) {
                                                ze(r, t, n, a, o, "next", e);
                                            }
                                            function o(e) {
                                                ze(r, t, n, a, o, "throw", e);
                                            }
                                            a(void 0);
                                        });
                                    });
                            return function () {
                                return e.apply(this, arguments);
                            };
                        })()().catch(function () {});
                    },
                    [t, o]
                );
                (r =
                    e && S.VerifiedBadgeIconContainer
                        ? L().createElement(
                              "section",
                              {
                                  ref: function (e) {
                                      o.current = e;
                                  },
                              },
                              L().createElement(S.VerifiedBadgeIconContainer, {
                                  overrideImgClass: "verified-badge-icon-header",
                                  size: S.BadgeSizes.CAPTIONHEADER,
                              })
                          )
                        : null),
                    (t = h()("rbx-left-col", { "nav-show": t })),
                    (e = h()("font-header-2 dynamic-ellipsis-item", { "verified-badge-left-nav": e }));
                return L().createElement(
                    "div",
                    { id: "navigation", className: t },
                    L().createElement(
                        "ul",
                        null,
                        L().createElement(
                            "li",
                            { key: "username" },
                            L().createElement(
                                y.Link,
                                {
                                    className: "dynamic-overflow-container text-nav",
                                    role: "link",
                                    url: B.scrollListItems.profile.url,
                                },
                                L().createElement(
                                    "span",
                                    { className: "avatar avatar-headshot-xs" },
                                    L().createElement(g.Thumbnail2d, {
                                        containerClass: "avatar-card-image",
                                        targetId: d.authenticatedUser.id,
                                        type: g.ThumbnailTypes.avatarHeadshot,
                                        altName: d.authenticatedUser.name,
                                    })
                                ),
                                L().createElement("div", { className: e }, We.nameForDisplay),
                                r
                            )
                        ),
                        L().createElement("li", { key: "divider", className: "rbx-divider" })
                    ),
                    L().createElement(y.ScrollBar, { className: "rbx-scrollbar" }, L().createElement(He, n))
                );
            }
            Je.propTypes = { isLeftNavOpen: v().bool.isRequired };
            var Ze = Je;
            function et(t, e) {
                var n,
                    r = Object.keys(t);
                return (
                    Object.getOwnPropertySymbols &&
                        ((n = Object.getOwnPropertySymbols(t)),
                        e &&
                            (n = n.filter(function (e) {
                                return Object.getOwnPropertyDescriptor(t, e).enumerable;
                            })),
                        r.push.apply(r, n)),
                    r
                );
            }
            function tt(r) {
                for (var e = 1; e < arguments.length; e++) {
                    var a = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? et(Object(a), !0).forEach(function (e) {
                              var t, n;
                              (t = r),
                                  (e = a[(n = e)]),
                                  n in t
                                      ? Object.defineProperty(t, n, {
                                            value: e,
                                            enumerable: !0,
                                            configurable: !0,
                                            writable: !0,
                                        })
                                      : (t[n] = e);
                          })
                        : Object.getOwnPropertyDescriptors
                          ? Object.defineProperties(r, Object.getOwnPropertyDescriptors(a))
                          : et(Object(a)).forEach(function (e) {
                                Object.defineProperty(r, e, Object.getOwnPropertyDescriptor(a, e));
                            });
                }
                return r;
            }
            function nt(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return rt(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return rt(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function rt(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            var at,
                ot = s,
                it = (0, M.withTranslations)(function (e) {
                    var t = d.authenticatedUser.isAuthenticated,
                        n = nt((0, j.useState)(!1), 2),
                        r = n[0],
                        a = n[1],
                        o = (0, j.useCallback)(
                            function () {
                                a(!r);
                            },
                            [r]
                        );
                    return (
                        (0, j.useEffect)(
                            function () {
                                return (
                                    document.addEventListener(ot.name, o),
                                    function () {
                                        document.removeEventListener(ot.name, o);
                                    }
                                );
                            },
                            [o]
                        ),
                        t ? L().createElement(Ze, tt({ isLeftNavOpen: r }, e)) : null
                    );
                }, m),
                ct = function () {
                    return (ct =
                        Object.assign ||
                        function (e) {
                            for (var t, n = 1, r = arguments.length; n < r; n++)
                                for (var a in (t = arguments[n]))
                                    Object.prototype.hasOwnProperty.call(t, a) && (e[a] = t[a]);
                            return e;
                        }).apply(this, arguments);
                },
                ut = function (e, i, c, u) {
                    return new (c = c || Promise)(function (n, t) {
                        function r(e) {
                            try {
                                o(u.next(e));
                            } catch (e) {
                                t(e);
                            }
                        }
                        function a(e) {
                            try {
                                o(u.throw(e));
                            } catch (e) {
                                t(e);
                            }
                        }
                        function o(e) {
                            var t;
                            e.done
                                ? n(e.value)
                                : ((t = e.value) instanceof c
                                      ? t
                                      : new c(function (e) {
                                            e(t);
                                        })
                                  ).then(r, a);
                        }
                        o((u = u.apply(e, i || [])).next());
                    });
                },
                lt = function (n, r) {
                    var a,
                        o,
                        i,
                        c = {
                            label: 0,
                            sent: function () {
                                if (1 & i[0]) throw i[1];
                                return i[1];
                            },
                            trys: [],
                            ops: [],
                        },
                        e = { next: t(0), throw: t(1), return: t(2) };
                    return (
                        "function" == typeof Symbol &&
                            (e[Symbol.iterator] = function () {
                                return this;
                            }),
                        e
                    );
                    function t(t) {
                        return function (e) {
                            return (function (t) {
                                if (a) throw new TypeError("Generator is already executing.");
                                for (; c; )
                                    try {
                                        if (
                                            ((a = 1),
                                            o &&
                                                (i =
                                                    2 & t[0]
                                                        ? o.return
                                                        : t[0]
                                                          ? o.throw || ((i = o.return) && i.call(o), 0)
                                                          : o.next) &&
                                                !(i = i.call(o, t[1])).done)
                                        )
                                            return i;
                                        switch (((o = 0), i && (t = [2 & t[0], i.value]), t[0])) {
                                            case 0:
                                            case 1:
                                                i = t;
                                                break;
                                            case 4:
                                                return c.label++, { value: t[1], done: !1 };
                                            case 5:
                                                c.label++, (o = t[1]), (t = [0]);
                                                continue;
                                            case 7:
                                                (t = c.ops.pop()), c.trys.pop();
                                                continue;
                                            default:
                                                if (
                                                    !(i = 0 < (i = c.trys).length && i[i.length - 1]) &&
                                                    (6 === t[0] || 2 === t[0])
                                                ) {
                                                    c = 0;
                                                    continue;
                                                }
                                                if (3 === t[0] && (!i || (t[1] > i[0] && t[1] < i[3]))) {
                                                    c.label = t[1];
                                                    break;
                                                }
                                                if (6 === t[0] && c.label < i[1]) {
                                                    (c.label = i[1]), (i = t);
                                                    break;
                                                }
                                                if (i && c.label < i[2]) {
                                                    (c.label = i[2]), c.ops.push(t);
                                                    break;
                                                }
                                                i[2] && c.ops.pop(), c.trys.pop();
                                                continue;
                                        }
                                        t = r.call(n, c);
                                    } catch (e) {
                                        (t = [6, e]), (o = 0);
                                    } finally {
                                        a = i = 0;
                                    }
                                if (5 & t[0]) throw t[1];
                                return { value: t[0] ? t[1] : void 0, done: !0 };
                            })([t, e]);
                        };
                    }
                },
                st = q.httpService.createCancelToken();
            function ft(e) {
                return void 0 === (null == e ? void 0 : e.label);
            }
            function mt(e) {
                return void 0 !== (null == e ? void 0 : e.Query);
            }
            function pt(e) {
                if (mt(e)) return "avatar";
                switch (e.type) {
                    case at.QuerySuggestion:
                        return "keyword";
                    case at.GameSuggestion:
                        return "game";
                    default:
                        throw Error("Unrecognized autocomplete suggestion, ".concat(JSON.stringify(e)));
                }
            }
            function dt(e) {
                switch (e.label) {
                    case "Label.Players":
                        return "defaultPlayers";
                    case "Heading.Marketplace":
                    case "Label.AvatarShop":
                    case "Label.sCatalog":
                        return "defaultShops";
                    case "Label.sGroups":
                        return "defaultGroups";
                    case "Label.CreatorMarketplace":
                        return "defaultLibrary";
                    case "Label.Experience":
                        return "defaultGames";
                    default:
                        throw Error("Unrecognized default suggestion, ".concat(JSON.stringify(e)));
                }
            }
            ((i = at = at || {})[(i.GameSuggestion = 0)] = "GameSuggestion"),
                (i[(i.QuerySuggestion = 1)] = "QuerySuggestion"),
                (i[(i.TrendingQuerySuggestion = 2)] = "TrendingQuerySuggestion");
            var vt = function (t) {
                    return ut(void 0, void 0, Promise, function () {
                        return lt(this, function (e) {
                            switch (e.label) {
                                case 0:
                                    return (
                                        st.cancel(),
                                        (st = q.httpService.createCancelToken()),
                                        [
                                            4,
                                            q.httpService.get(
                                                ct(ct({}, F.getSuggestionUrl), {
                                                    url: F.getSuggestionUrl.url + encodeURIComponent(t.toLowerCase()),
                                                    cancelToken: st.token,
                                                })
                                            ),
                                        ]
                                    );
                                case 1:
                                    return [2, e.sent().data];
                            }
                        });
                    });
                },
                bt = function (n, r, a, o, i) {
                    return (
                        void 0 === i && (i = !1),
                        ut(void 0, void 0, Promise, function () {
                            var t;
                            return lt(this, function (e) {
                                switch (e.label) {
                                    case 0:
                                        return (
                                            null === (t = r) && (t = F.englishLanguageCode),
                                            (t = { prefix: n.toLowerCase(), limit: a, lang: t, q: o }),
                                            st.cancel(),
                                            (st = q.httpService.createCancelToken()),
                                            i
                                                ? [
                                                      4,
                                                      q.httpService.get(
                                                          ct(ct({}, F.avatarRequestSuggestionUrl), {
                                                              timeout: F.expiryTimeout,
                                                              cancelToken: st.token,
                                                              fullError: !0,
                                                          }),
                                                          t
                                                      ),
                                                  ]
                                                : [3, 2]
                                        );
                                    case 1:
                                        return [2, e.sent().data];
                                    case 2:
                                        return [
                                            4,
                                            q.httpService.get(
                                                ct(ct({}, F.avatarRequestSuggestionCdnUrl), {
                                                    timeout: F.expiryTimeout,
                                                    cancelToken: st.token,
                                                    fullError: !0,
                                                }),
                                                t
                                            ),
                                        ];
                                    case 3:
                                        return [2, e.sent().data];
                                }
                            });
                        })
                    );
                },
                yt = ft,
                gt = mt,
                ht = pt,
                St = dt,
                Et = function (e, t) {
                    var n;
                    return ft(e) && mt(e)
                        ? B.avatarSearchLink.url + encodeURIComponent(e.Query)
                        : ft(e)
                          ? B.gameSearchLink.url + encodeURIComponent(e.searchQuery)
                          : null != t && null !== (n = t.target) && void 0 !== n && n.value
                            ? e.url + encodeURIComponent(t.target.value)
                            : "";
                },
                wt = function () {
                    var e = new D.TranslationResourceProvider().intl.locale,
                        t = e.indexOf("-");
                    return (
                        (e = e.substring(0, -1 !== t ? t : e.length)) !== F.englishLanguageCode &&
                            (e += ",".concat(F.englishLanguageCode)),
                        e
                    );
                },
                Ot = function (e, t) {
                    return e
                        .map(function (e) {
                            return ft(e)
                                ? "".concat(pt(e), "|").concat(e.searchQuery)
                                : "".concat(dt(e), "|").concat(t);
                        })
                        .join(",");
                },
                Ct = ee.eventStreamService.eventTypes,
                xt = "searchAutocomplete",
                At = {
                    actionTypes: { open: "open", submit: "submit", close: "close" },
                    generateSessionInfo: q.uuidService.generateRandomUuid,
                    searchTextTrim: function (e, t, n, r) {
                        return [
                            { name: "searchTextTrim", type: Ct.formInteraction, context: xt },
                            { kwd: e, resultingKwd: t, searchType: n, sessionInfo: r },
                        ];
                    },
                    searchClear: function (e, t, n, r) {
                        return [
                            { name: "searchClear", type: Ct.formInteraction, context: xt },
                            { kwd: e, searchType: t, sessionInfo: n, page: r },
                        ];
                    },
                    searchSuggestionClicked: function (e, t, n, r, a, o, i) {
                        return [
                            { name: "searchSuggestionClicked", type: Ct.formInteraction, context: xt },
                            {
                                kwd: e,
                                searchType: t,
                                suggestionPosition: n,
                                suggestionClicked: r,
                                suggestionType: a,
                                suggestions: o,
                                sessionInfo: i,
                            },
                        ];
                    },
                    searchAutocomplete: function (e, t, n, r, a, o, i, c, u, l) {
                        return [
                            { name: "searchAutocomplete", type: Ct.formInteraction, context: xt },
                            {
                                kwd: e,
                                previousKwd: t,
                                fromLocalCache: n,
                                suggestions: r,
                                algorithm: a,
                                latency: o,
                                timeoutDelayMs: i,
                                sessionInfo: c,
                                page: u,
                                isPersonalizedBasedOnPreviousQuery: l,
                            },
                        ];
                    },
                    search: function (e, t, n) {
                        return [
                            { name: "search", type: Ct.formInteraction, context: xt },
                            { kwd: e, actionType: t, sessionInfo: n },
                        ];
                    },
                    catalogSearch: function (e, t) {
                        return [
                            { name: "catalogSearch", type: Ct.formInteraction, context: xt },
                            { autocompleteFlag: e, previousPage: t },
                        ];
                    },
                };
            function It(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return Rt(e);
                    })(e) ||
                    (function (e) {
                        if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e);
                    })(e) ||
                    Nt(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function kt(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    Nt(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Nt(e, t) {
                if (e) {
                    if ("string" == typeof e) return Rt(e, t);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    return (
                        "Object" === n && e.constructor && (n = e.constructor.name),
                        "Map" === n || "Set" === n
                            ? Array.from(e)
                            : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                              ? Rt(e, t)
                              : void 0
                    );
                }
            }
            function Rt(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Tt(e) {
                var o = e.translate,
                    i = e.searchInput,
                    c = e.indexOfSelectedOption,
                    u = e.autocompleteSessionInfo,
                    l = e.resetAutocompleteSessionInfo,
                    s = ke();
                return L().createElement(
                    L().Fragment,
                    null,
                    Object.entries(s).map(function (e) {
                        var t = kt(e, 2),
                            n = t[0],
                            r = t[1],
                            a = r.url,
                            e = r.label,
                            t = h()("navbar-search-option rbx-clickable-li", parseInt(n, 10) === c ? " selected" : "");
                        return L().createElement(
                            "li",
                            { key: n, className: t },
                            L().createElement(
                                y.Link,
                                {
                                    className: "navbar-search-anchor",
                                    url: a + i,
                                    onClick: function () {
                                        ee.eventStreamService.sendEvent.apply(
                                            ee.eventStreamService,
                                            It(At.searchSuggestionClicked(i, void 0, n, i, St(r), Ot(s, i), u))
                                        ),
                                            l();
                                    },
                                },
                                o("Label.sSearchPhrase", { phrase: i, location: o(e) })
                            )
                        );
                    })
                );
            }
            Tt.propTypes = {
                translate: v().func.isRequired,
                searchInput: v().string.isRequired,
                indexOfSelectedOption: v().number.isRequired,
                autocompleteSessionInfo: v().string.isRequired,
                resetAutocompleteSessionInfo: v().func.isRequired,
            };
            var Ut = Tt;
            function Pt(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return jt(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return jt(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function jt(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            var Lt = B.gameSearchLink,
                qt = B.avatarSearchLink,
                Dt = B.creatorMarketplaceUrl;
            function Mt(e) {
                var t = e.translate,
                    n = e.selected,
                    r = e.suggestion,
                    a = e.onClick,
                    o = h()("navbar-search-option rbx-clickable-li", { "new-selected": n }),
                    i = r.type,
                    c = r.universeId,
                    e = r.searchQuery,
                    n = Pt((0, j.useState)(!1), 2),
                    r = n[0],
                    u = n[1];
                return i === at.GameSuggestion
                    ? L().createElement(
                          "li",
                          { className: o },
                          L().createElement(
                              y.Link,
                              {
                                  className: "new-navbar-search-anchor",
                                  url: Lt.url + encodeURIComponent(e),
                                  onClick: a,
                              },
                              L().createElement("span", { className: h()(Lt.icon, "navbar-list-option-icon") }),
                              L().createElement("span", { className: "navbar-list-option-text" }, e),
                              L().createElement(
                                  "span",
                                  { className: "navbar-list-option-suffix" },
                                  t("Label.sSearchPhraseV2", { location: t(Lt.label) })
                              ),
                              L().createElement(
                                  "span",
                                  {
                                      className: h()("navbar-list-option-thumbnail", {
                                          "navbar-list-option-thumbnail-visible": r,
                                      }),
                                  },
                                  L().createElement("span", { className: "background-icon" }),
                                  L().createElement(g.Thumbnail2d, {
                                      type: g.ThumbnailTypes.gameIcon,
                                      size: g.DefaultThumbnailSize,
                                      targetId: c,
                                      containerClass: "thumbnail-icon",
                                      format: g.ThumbnailFormat.jpeg,
                                      onLoad: function () {
                                          u(!0);
                                      },
                                  })
                              )
                          )
                      )
                    : L().createElement(
                          "li",
                          { className: o },
                          L().createElement(
                              y.Link,
                              {
                                  className: "new-navbar-search-anchor",
                                  url: Lt.url + encodeURIComponent(e),
                                  onClick: a,
                              },
                              L().createElement("span", { className: h()(Lt.icon, "navbar-list-option-icon") }),
                              L().createElement("span", { className: "navbar-list-option-text" }, e),
                              L().createElement(
                                  "span",
                                  { className: "navbar-list-option-suffix" },
                                  t("Label.sSearchPhraseV2", { location: t(Lt.label) })
                              )
                          )
                      );
            }
            function _t(e) {
                var t = e.translate,
                    n = e.selected,
                    r = e.suggestion,
                    e = e.onClick,
                    n = h()("navbar-search-option rbx-clickable-li", { "new-selected": n }),
                    r = r.Query;
                return L().createElement(
                    "li",
                    { className: n },
                    L().createElement(
                        y.Link,
                        { className: "new-navbar-search-anchor", url: qt.url + encodeURIComponent(r), onClick: e },
                        L().createElement("span", { className: h()(qt.icon, "navbar-list-option-icon") }),
                        L().createElement("span", { className: "navbar-list-option-text" }, r),
                        L().createElement(
                            "span",
                            { className: "navbar-list-option-suffix" },
                            t("Label.sSearchPhraseV2", { location: t(qt.label) })
                        )
                    )
                );
            }
            function Ft(e) {
                var t = e.translate,
                    n = e.selected,
                    r = e.searchInput,
                    a = e.suggestion,
                    o = e.onClick,
                    i = a.url,
                    e = a.label,
                    a = a.icon,
                    i =
                        (0, F.isRedirectLibraryToCreatorMarketplaceEnabled)() && "Label.CreatorMarketplace" === e
                            ? Dt
                            : i,
                    n = h()("navbar-search-option rbx-clickable-li", { "new-selected": n });
                return L().createElement(
                    "li",
                    { className: n },
                    L().createElement(
                        y.Link,
                        { className: "new-navbar-search-anchor", url: i + encodeURIComponent(r), onClick: o },
                        L().createElement("span", { className: h()(a, "navbar-list-option-icon") }),
                        L().createElement("span", { className: "navbar-list-option-text" }, r.toLowerCase()),
                        L().createElement(
                            "span",
                            { className: "navbar-list-option-suffix" },
                            t("Label.sSearchPhraseV2", { location: t(e) })
                        )
                    )
                );
            }
            function Bt(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return Gt(e);
                    })(e) ||
                    (function (e) {
                        if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e);
                    })(e) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Gt(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Gt(e, t);
                    })(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Gt(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Kt(e) {
                function r(t, n) {
                    return function () {
                        var e = c[n];
                        ee.eventStreamService.sendEvent.apply(
                            ee.eventStreamService,
                            Bt(At.searchSuggestionClicked(o, void 0, n, yt(e) ? e.searchQuery : o, t, Ot(c, o), u))
                        ),
                            l();
                        e = t.includes("default") ? 0 : 1;
                        ee.eventStreamService.sendEvent.apply(
                            ee.eventStreamService,
                            Bt(At.catalogSearch(e, q.pageName.PageNameProvider.getInternalPageName()))
                        );
                    };
                }
                var a = e.translate,
                    o = e.searchInput,
                    i = e.indexOfSelectedOption,
                    c = e.searchSuggestions,
                    u = e.autocompleteSessionInfo,
                    l = e.resetAutocompleteSessionInfo;
                return c.map(function (e, t) {
                    var n = parseInt(t, 10) === i;
                    return yt(e) && gt(e)
                        ? L().createElement(_t, {
                              key: e.Query,
                              translate: a,
                              selected: n,
                              suggestion: e,
                              onClick: r(ht(e), t),
                          })
                        : yt(e)
                          ? L().createElement(Mt, {
                                key: e.searchQuery,
                                translate: a,
                                selected: n,
                                suggestion: e,
                                onClick: r(ht(e), t),
                            })
                          : L().createElement(Ft, {
                                key: e.url,
                                translate: a,
                                selected: n,
                                suggestion: e,
                                searchInput: o,
                                onClick: r(St(e), t),
                            });
                });
            }
            (Mt.propTypes = {
                translate: v().func.isRequired,
                selected: v().bool.isRequired,
                suggestion: v().shape({
                    type: v().number.isRequired,
                    score: v().number.isRequired,
                    universeId: v().number,
                    canonicalTitle: v().string,
                    thumbnailUrl: v().string,
                    searchQuery: v().string.isRequired,
                    trendingSearchStartDateTime: v().string,
                }).isRequired,
                onClick: v().func.isRequired,
            }),
                (_t.propTypes = {
                    translate: v().func.isRequired,
                    selected: v().bool.isRequired,
                    suggestion: v().shape({ Query: v().string }).isRequired,
                    onClick: v().func.isRequired,
                }),
                (Ft.propTypes = {
                    translate: v().func.isRequired,
                    selected: v().bool.isRequired,
                    searchInput: v().string.isRequired,
                    suggestion: v().shape({
                        url: v().string.isRequired,
                        label: v().string.isRequired,
                        pageSort: v().arrayOf(v().string).isRequired,
                        icon: v().string.isRequired,
                    }).isRequired,
                    onClick: v().func.isRequired,
                }),
                (Kt.propTypes = {
                    translate: v().func.isRequired,
                    searchInput: v().string.isRequired,
                    indexOfSelectedOption: v().number.isRequired,
                    searchSuggestions: v().arrayOf(
                        v().oneOfType([
                            v().shape({
                                type: v().number.isRequired,
                                score: v().number.isRequired,
                                universeId: v().number.isRequired,
                                canonicalTitle: v().string,
                                thumbnailUrl: v().string,
                                searchQuery: v().string.isRequired,
                                trendingSearchStartDateTime: v().string,
                            }),
                            v().shape({
                                url: v().string.isRequired,
                                label: v().string.isRequired,
                                pageSort: v().arrayOf(v().string).isRequired,
                                icon: v().string.isRequired,
                            }),
                            v().shape({ Query: v().string.isRequired, Score: v().number.isRequired }),
                        ])
                    ).isRequired,
                    autocompleteSessionInfo: v().string.isRequired,
                    resetAutocompleteSessionInfo: v().func.isRequired,
                });
            var Vt = Kt;
            function Qt(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return Ht(e);
                    })(e) ||
                    (function (e) {
                        if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e);
                    })(e) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Ht(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Ht(e, t);
                    })(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Ht(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Wt(e) {
                var t = e.translate,
                    n = e.searchInput,
                    r = e.isMenuOpen,
                    a = e.openMenu,
                    o = e.closeMenu,
                    i = e.handleSearch,
                    c = e.setIsMenuHover,
                    u = e.indexOfSelectedOption,
                    l = e.onSubmit,
                    s = e.onKeyDown,
                    f = e.onKeyUp,
                    m = e.isUniverseSearchShown,
                    p = e.searchSuggestions,
                    d = e.autocompleteSessionInfo,
                    v = e.resetAutocompleteSessionInfo,
                    b = e.isAvatarAutocompleteEnabled,
                    y = (0, j.createRef)(),
                    g = (0, j.createRef)(),
                    e = function () {
                        var e;
                        ee.eventStreamService.sendEvent.apply(
                            ee.eventStreamService,
                            Qt(
                                At.searchClear(
                                    n,
                                    void 0,
                                    d,
                                    null === q.pageName ||
                                        void 0 === q.pageName ||
                                        null === (e = q.pageName.PageNameProvider) ||
                                        void 0 === e
                                        ? void 0
                                        : e.getInternalPageName()
                                )
                            )
                        ),
                            null == y || (null !== (e = y.current) && void 0 !== e && e.focus()),
                            i({ target: { value: "" } });
                    },
                    m = h()("navbar-left navbar-search col-xs-5 col-sm-6 col-md-2 col-lg-3", {
                        "navbar-search-open": r,
                        shown: m,
                    }),
                    b = F.isAutocompleteSuggestionsIXPTestEnabled() || b;
                return (
                    (0, M.useOnClickOutside)([y, g], o),
                    L().createElement(
                        "div",
                        { "data-testid": "navigation-search-input", className: m, role: "search" },
                        L().createElement(
                            "div",
                            { className: "input-group" },
                            L().createElement(
                                "form",
                                { onSubmit: l },
                                b
                                    ? L().createElement(
                                          "div",
                                          { className: "form-has-feedback" },
                                          L().createElement("input", {
                                              ref: y,
                                              id: "navbar-search-input",
                                              "data-testid": "navigation-search-input-field",
                                              className: "form-control input-field new-input-field",
                                              value: n,
                                              onChange: i,
                                              placeholder: t("Label.sSearch"),
                                              maxLength: "120",
                                              onFocus: a,
                                              onKeyDown: s,
                                              onKeyUp: f,
                                              autoComplete: "off",
                                              autoCorrect: "off",
                                              autoCapitalize: "off",
                                              spellCheck: "false",
                                          }),
                                          0 < n.length &&
                                              L().createElement(
                                                  "span",
                                                  {
                                                      "data-testid": "navigation-search-input-clear-button",
                                                      tabIndex: 0,
                                                      role: "button",
                                                      "aria-label": "Clear Search",
                                                      onClick: e,
                                                      onKeyDown: e,
                                                      className: "clear-search icon-actions-clear-sm",
                                                  },
                                                  L().createElement("span", null)
                                              )
                                      )
                                    : L().createElement("input", {
                                          ref: y,
                                          id: "navbar-search-input",
                                          "data-testid": "navigation-search-input-field",
                                          className: "form-control input-field",
                                          type: "text",
                                          value: n,
                                          onChange: i,
                                          placeholder: t("Label.sSearch"),
                                          maxLength: "120",
                                          onFocus: a,
                                          onKeyDown: s,
                                          onKeyUp: f,
                                          autoComplete: "off",
                                      })
                            ),
                            L().createElement(
                                "div",
                                { className: "input-group-btn" },
                                L().createElement(
                                    "button",
                                    {
                                        "data-testid": "navigation-search-input-search-button",
                                        className: "input-addon-btn",
                                        type: "submit",
                                    },
                                    L().createElement("span", { className: "icon-common-search-sm" })
                                )
                            )
                        ),
                        L().createElement(
                            "ul",
                            {
                                ref: g,
                                className: h()("dropdown-menu", { "new-dropdown-menu": b }),
                                role: "menu",
                                onMouseEnter: function () {
                                    c(!0);
                                },
                                onMouseLeave: function () {
                                    c(!1);
                                },
                            },
                            b
                                ? L().createElement(Vt, {
                                      translate: t,
                                      searchInput: n,
                                      indexOfSelectedOption: u,
                                      searchSuggestions: p,
                                      autocompleteSessionInfo: d,
                                      resetAutocompleteSessionInfo: v,
                                  })
                                : L().createElement(Ut, {
                                      translate: t,
                                      searchInput: n,
                                      indexOfSelectedOption: u,
                                      autocompleteSessionInfo: d,
                                      resetAutocompleteSessionInfo: v,
                                  })
                        )
                    )
                );
            }
            (Wt.defaultProps = { isUniverseSearchShown: !0, isAvatarAutocompleteEnabled: !1 }),
                (Wt.propTypes = {
                    translate: v().func.isRequired,
                    searchInput: v().string.isRequired,
                    isMenuOpen: v().bool.isRequired,
                    openMenu: v().func.isRequired,
                    closeMenu: v().func.isRequired,
                    handleSearch: v().func.isRequired,
                    setIsMenuHover: v().func.isRequired,
                    indexOfSelectedOption: v().number.isRequired,
                    onSubmit: v().func.isRequired,
                    onKeyDown: v().func.isRequired,
                    onKeyUp: v().func.isRequired,
                    isUniverseSearchShown: v().bool,
                    isAvatarAutocompleteEnabled: v().bool,
                    searchSuggestions: v().arrayOf(
                        v().oneOfType([
                            v().shape({
                                type: v().number.isRequired,
                                score: v().number.isRequired,
                                universeId: v().number.isRequired,
                                canonicalTitle: v().string,
                                thumbnailUrl: v().string,
                                searchQuery: v().string.isRequired,
                                trendingSearchStartDateTime: v().string,
                            }),
                            v().shape({
                                url: v().string.isRequired,
                                label: v().string.isRequired,
                                pageSort: v().arrayOf(v().string).isRequired,
                                icon: v().string,
                            }),
                            v().shape({ query: v().string.isRequired, score: v().number.isRequired }),
                        ])
                    ).isRequired,
                    autocompleteSessionInfo: v().string.isRequired,
                    resetAutocompleteSessionInfo: v().func.isRequired,
                });
            var zt = Wt;
            function $t(e, t, n, r, a, o, i) {
                try {
                    var c = e[o](i),
                        u = c.value;
                } catch (e) {
                    return void n(e);
                }
                c.done ? t(u) : Promise.resolve(u).then(r, a);
            }
            function Xt(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return Zt(e);
                    })(e) ||
                    (function (e) {
                        if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e);
                    })(e) ||
                    Jt(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Yt(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    Jt(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Jt(e, t) {
                if (e) {
                    if ("string" == typeof e) return Zt(e, t);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    return (
                        "Object" === n && e.constructor && (n = e.constructor.name),
                        "Map" === n || "Set" === n
                            ? Array.from(e)
                            : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                              ? Zt(e, t)
                              : void 0
                    );
                }
            }
            function Zt(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function en(e) {
                var t = e.translate,
                    n = e.isUniverseSearchShown,
                    r = Yt((0, j.useState)(Ue(window.location.search).keyword || ""), 2),
                    o = r[0],
                    a = r[1],
                    i = (0, M.useDebounce)(o, F.debounceTimeout),
                    u = (0, M.usePrevious)(i),
                    e = Yt((0, j.useState)(null), 2),
                    c = e[0],
                    l = e[1],
                    r = Yt((0, j.useState)(At.generateSessionInfo()), 2),
                    s = r[0],
                    f = r[1],
                    e = Yt((0, j.useState)(!1), 2),
                    m = e[0],
                    p = e[1],
                    r = Yt((0, j.useState)(!0), 2),
                    d = r[0],
                    v = r[1],
                    e = Yt((0, j.useState)(!1), 2),
                    b = e[0],
                    r = e[1],
                    e = Yt((0, j.useState)(0), 2),
                    y = e[0],
                    g = e[1],
                    e = Yt((0, j.useState)(!1), 2),
                    h = e[0],
                    S = e[1],
                    e = Yt((0, j.useState)(!1), 2),
                    E = e[0],
                    w = e[1],
                    O = _,
                    e = Yt((0, j.useState)((F.isAutocompleteSuggestionsIXPTestEnabled() ? Ne : ke)()), 2),
                    C = e[0],
                    x = e[1],
                    A = C.findIndex(function (e) {
                        return e.label === B.gameSearchLink.label;
                    }),
                    I = Ne().findIndex(function (e) {
                        return e.label === B.avatarSearchLink.label;
                    }),
                    k = wt();
                (0, j.useEffect)(function () {
                    D.ExperimentationService &&
                        D.ExperimentationService.getAllValuesForLayer(F.experimentLayer).then(function (e) {
                            e.ixpDisableGamesAutocomplete && S(!0);
                        });
                }, []);
                function N(e) {
                    if (e) {
                        if (R) {
                            var t =
                                    -1 ===
                                    c.findIndex(function (e) {
                                        return e.searchQuery === i.toLowerCase() && gt(e);
                                    }),
                                n = e.filter(function (e) {
                                    return e.searchQuery !== i.toLowerCase() || gt(e);
                                });
                            return [].concat(Xt(C.slice(0, t ? I + 1 : I)), Xt(n), Xt(C.slice(I + 1)));
                        }
                        if (F.isSpecialTreatmentAutocompleteRestricted()) return C;
                        (n =
                            -1 ===
                            e.findIndex(function (e) {
                                return e.searchQuery === i.toLowerCase() && e.type === at.GameSuggestion;
                            })),
                            (e = e
                                .filter(function (e) {
                                    return e.searchQuery !== i.toLowerCase() || e.type === at.GameSuggestion;
                                })
                                .slice(
                                    0,
                                    F.isSpecialTreatment()
                                        ? F.numberOfSpecialTreatmentAutocompleteSuggestions
                                        : F.numberOfAutocompleteSuggestions()
                                ));
                        return [].concat(Xt(C.slice(0, n ? A + 1 : A)), Xt(e), Xt(C.slice(A + 1)));
                    }
                    return C;
                }
                var R = Re(),
                    T = (0, j.useMemo)(
                        function () {
                            return N(c);
                        },
                        [c, C]
                    ),
                    U = T.length;
                (0, j.useEffect)(
                    function () {
                        d ||
                            ee.eventStreamService.sendEvent.apply(
                                ee.eventStreamService,
                                Xt(At.search(o, At.actionTypes.submit, s))
                            ),
                            v(!1);
                        var e = (function () {
                            var c,
                                e =
                                    ((c = regeneratorRuntime.mark(function e() {
                                        var t, n, r, a, o;
                                        return regeneratorRuntime.wrap(
                                            function (e) {
                                                for (;;)
                                                    switch ((e.prev = e.next)) {
                                                        case 0:
                                                            if (
                                                                !(
                                                                    "" !== i &&
                                                                    i.length <= F.debouncedSearchInputMaxLength
                                                                )
                                                            ) {
                                                                e.next = 34;
                                                                break;
                                                            }
                                                            if ((l(null), (t = Date.now()), R))
                                                                return (
                                                                    (e.prev = 4),
                                                                    (n = Date.now()),
                                                                    (e.next = 8),
                                                                    bt(
                                                                        i,
                                                                        k,
                                                                        F.avatarAutocompleteQueryPaddingAmount,
                                                                        u,
                                                                        E
                                                                    )
                                                                );
                                                            e.next = 20;
                                                            break;
                                                        case 8:
                                                            (a = e.sent),
                                                                (o = (function (e, t) {
                                                                    var n = 0,
                                                                        r = [];
                                                                    return (
                                                                        e.forEach(function (e) {
                                                                            n < F.avatarAutocompleteSuggestionLimit &&
                                                                                e.Query !== t &&
                                                                                (r.push(e), (n += 1));
                                                                        }),
                                                                        r
                                                                    );
                                                                })(a.Data, i)),
                                                                ee.eventStreamService.sendEvent.apply(
                                                                    ee.eventStreamService,
                                                                    Xt(
                                                                        At.searchAutocomplete(
                                                                            i,
                                                                            u,
                                                                            !1,
                                                                            o,
                                                                            a.Args.Algo,
                                                                            n - t,
                                                                            F.debounceTimeout,
                                                                            "",
                                                                            q.pageName.PageNameProvider.getInternalPageName(),
                                                                            "" !== u
                                                                        )
                                                                    )
                                                                ),
                                                                l(o),
                                                                (e.next = 18);
                                                            break;
                                                        case 14:
                                                            (e.prev = 14),
                                                                (e.t0 = e.catch(4)),
                                                                q.httpService.isCancelled(e.t0) || l([]),
                                                                w(!0);
                                                        case 18:
                                                            e.next = 34;
                                                            break;
                                                        case 20:
                                                            if (F.isAutocompleteSuggestionsIXPTestEnabled() && !h)
                                                                return (e.prev = 21), (e.next = 24), vt(i);
                                                            e.next = 34;
                                                            break;
                                                        case 24:
                                                            (r = e.sent),
                                                                (a = Date.now()),
                                                                (o = N(r.entries)),
                                                                ee.eventStreamService.sendEvent.apply(
                                                                    ee.eventStreamService,
                                                                    Xt(
                                                                        At.searchAutocomplete(
                                                                            i,
                                                                            u,
                                                                            !1,
                                                                            Ot(o, i),
                                                                            r.algorithmName,
                                                                            a - t,
                                                                            F.debounceTimeout,
                                                                            s,
                                                                            q.pageName.PageNameProvider.getInternalPageName(),
                                                                            !1
                                                                        )
                                                                    )
                                                                ),
                                                                l(r.entries),
                                                                (e.next = 34);
                                                            break;
                                                        case 31:
                                                            (e.prev = 31),
                                                                (e.t1 = e.catch(21)),
                                                                q.httpService.isCancelled(e.t1) || l([]);
                                                        case 34:
                                                        case "end":
                                                            return e.stop();
                                                    }
                                            },
                                            e,
                                            null,
                                            [
                                                [4, 14],
                                                [21, 31],
                                            ]
                                        );
                                    })),
                                    function () {
                                        var e = this,
                                            i = arguments;
                                        return new Promise(function (t, n) {
                                            var r = c.apply(e, i);
                                            function a(e) {
                                                $t(r, t, n, a, o, "next", e);
                                            }
                                            function o(e) {
                                                $t(r, t, n, a, o, "throw", e);
                                            }
                                            a(void 0);
                                        });
                                    });
                            return function () {
                                return e.apply(this, arguments);
                            };
                        })();
                        R && x(Ne()), e();
                    },
                    [i]
                );
                function P() {
                    f(At.generateSessionInfo());
                }
                return L().createElement(zt, {
                    searchInput: o,
                    handleSearch: function (e) {
                        e = e.target.value;
                        e.length < o.length &&
                            ee.eventStreamService.sendEvent.apply(
                                ee.eventStreamService,
                                Xt(At.searchTextTrim(o, e, void 0, s))
                            ),
                            0 === e.length && P(),
                            g(0),
                            p(0 < e.length),
                            a(e);
                    },
                    openMenu: function () {
                        var e = At.generateSessionInfo();
                        ee.eventStreamService.sendEvent.apply(
                            ee.eventStreamService,
                            Xt(At.search(o, At.actionTypes.open, e))
                        ),
                            f(e),
                            0 === o.length || b || p(!0);
                    },
                    closeMenu: function () {
                        m &&
                            (ee.eventStreamService.sendEvent.apply(
                                ee.eventStreamService,
                                Xt(At.search(o, At.actionTypes.close, s))
                            ),
                            p(!1));
                    },
                    setIsMenuHover: r,
                    isMenuOpen: m,
                    indexOfSelectedOption: y,
                    onSubmit: function (e) {
                        e.preventDefault(), e.stopPropagation();
                    },
                    onKeyDown: function (e) {
                        var t = y;
                        !m ||
                            (e.keyCode !== O.arrowUp && e.keyCode !== O.arrowDown && e.keyCode !== O.tab) ||
                            (e.stopPropagation(),
                            e.preventDefault(),
                            e.keyCode === O.arrowUp ? --t : (t += 1),
                            (t %= U) < 0 && (t = U + t),
                            g(t));
                    },
                    onKeyUp: function (e) {
                        var t, n, r, a;
                        e.keyCode === O.enter &&
                            (e.stopPropagation(),
                            e.preventDefault(),
                            (t = T[y]),
                            yt(t)
                                ? (ee.eventStreamService.sendEvent.apply(
                                      ee.eventStreamService,
                                      Xt(At.searchSuggestionClicked(i, void 0, y, t.searchQuery, ht(t), Ot(T, o), s))
                                  ),
                                  ee.eventStreamService.sendEvent.apply(
                                      ee.eventStreamService,
                                      Xt(At.catalogSearch(1, q.pageName.PageNameProvider.getInternalPageName()))
                                  ))
                                : (ee.eventStreamService.sendEvent.apply(
                                      ee.eventStreamService,
                                      Xt(At.searchSuggestionClicked(i, void 0, y, i, St(t), Ot(T, o), s))
                                  ),
                                  ee.eventStreamService.sendEvent.apply(
                                      ee.eventStreamService,
                                      Xt(At.catalogSearch(0, q.pageName.PageNameProvider.getInternalPageName()))
                                  )),
                            P(),
                            (a = Et(t, e)) &&
                                ((n = F.isRedirectLibraryToCreatorMarketplaceEnabled),
                                (a = a),
                                "Label.CreatorMarketplace" === t.label &&
                                    n() &&
                                    ((a = B.creatorMarketplaceUrl),
                                    null != e &&
                                        null !== (r = e.target) &&
                                        void 0 !== r &&
                                        r.value &&
                                        (a += encodeURIComponent(e.target.value))),
                                (window.location = a)));
                    },
                    isUniverseSearchShown: n,
                    translate: t,
                    searchSuggestions: T,
                    autocompleteSessionInfo: s,
                    resetAutocompleteSessionInfo: P,
                    isAvatarAutocompleteEnabled: R,
                });
            }
            (en.defaultProps = { isUniverseSearchShown: !0 }),
                (en.propTypes = { translate: v().func.isRequired, isUniverseSearchShown: v().bool });
            var tn = (0, M.withTranslations)(en, m);
            function nn(e) {
                return (nn =
                    "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                        ? function (e) {
                              return typeof e;
                          }
                        : function (e) {
                              return e &&
                                  "function" == typeof Symbol &&
                                  e.constructor === Symbol &&
                                  e !== Symbol.prototype
                                  ? "symbol"
                                  : typeof e;
                          })(e);
            }
            function rn(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var r = t[n];
                    (r.enumerable = r.enumerable || !1),
                        (r.configurable = !0),
                        "value" in r && (r.writable = !0),
                        Object.defineProperty(e, r.key, r);
                }
            }
            function an(e, t) {
                return (an =
                    Object.setPrototypeOf ||
                    function (e, t) {
                        return (e.__proto__ = t), e;
                    })(e, t);
            }
            function on(n) {
                var r = (function () {
                    if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                    if (Reflect.construct.sham) return !1;
                    if ("function" == typeof Proxy) return !0;
                    try {
                        return Date.prototype.toString.call(Reflect.construct(Date, [], function () {})), !0;
                    } catch (e) {
                        return !1;
                    }
                })();
                return function () {
                    var e,
                        t = cn(n);
                    return (
                        (e = r
                            ? ((e = cn(this).constructor), Reflect.construct(t, arguments, e))
                            : t.apply(this, arguments)),
                        (t = this),
                        !(e = e) || ("object" !== nn(e) && "function" != typeof e)
                            ? (function (e) {
                                  if (void 0 !== e) return e;
                                  throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                              })(t)
                            : e
                    );
                };
            }
            function cn(e) {
                return (cn = Object.setPrototypeOf
                    ? Object.getPrototypeOf
                    : function (e) {
                          return e.__proto__ || Object.getPrototypeOf(e);
                      })(e);
            }
            var un = (function () {
                !(function (e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function");
                    (e.prototype = Object.create(t && t.prototype, {
                        constructor: { value: e, writable: !0, configurable: !0 },
                    })),
                        t && an(e, t);
                })(a, L().Component);
                var e,
                    t,
                    n,
                    r = on(a);
                function a() {
                    return (
                        (function (e) {
                            if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function");
                        })(this),
                        r.apply(this, arguments)
                    );
                }
                return (
                    (e = a),
                    (t = [
                        {
                            key: "componentDidMount",
                            value: function () {
                                try {
                                    oe().module("notificationStreamIcon"),
                                        oe().bootstrap(this.container, ["notificationStreamIcon"]);
                                } catch (e) {
                                    console.log(e);
                                }
                            },
                        },
                        {
                            key: "render",
                            value: function () {
                                var t = this;
                                return L().createElement(
                                    "span",
                                    {
                                        ref: function (e) {
                                            t.container = e;
                                        },
                                        className: "nav-robux-icon rbx-menu-item",
                                    },
                                    L().createElement("span", {
                                        id: "notification-stream-icon-container",
                                        "notification-stream-indicator": "true",
                                    })
                                );
                            },
                        },
                    ]) && rn(e.prototype, t),
                    n && rn(e, n),
                    a
                );
            })();
            function ln(e) {
                return (ln =
                    "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                        ? function (e) {
                              return typeof e;
                          }
                        : function (e) {
                              return e &&
                                  "function" == typeof Symbol &&
                                  e.constructor === Symbol &&
                                  e !== Symbol.prototype
                                  ? "symbol"
                                  : typeof e;
                          })(e);
            }
            function sn(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var r = t[n];
                    (r.enumerable = r.enumerable || !1),
                        (r.configurable = !0),
                        "value" in r && (r.writable = !0),
                        Object.defineProperty(e, r.key, r);
                }
            }
            function fn(e, t) {
                return (fn =
                    Object.setPrototypeOf ||
                    function (e, t) {
                        return (e.__proto__ = t), e;
                    })(e, t);
            }
            function mn(n) {
                var r = (function () {
                    if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                    if (Reflect.construct.sham) return !1;
                    if ("function" == typeof Proxy) return !0;
                    try {
                        return Date.prototype.toString.call(Reflect.construct(Date, [], function () {})), !0;
                    } catch (e) {
                        return !1;
                    }
                })();
                return function () {
                    var e,
                        t = pn(n);
                    return (
                        (e = r
                            ? ((e = pn(this).constructor), Reflect.construct(t, arguments, e))
                            : t.apply(this, arguments)),
                        (t = this),
                        !(e = e) || ("object" !== ln(e) && "function" != typeof e)
                            ? (function (e) {
                                  if (void 0 !== e) return e;
                                  throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                              })(t)
                            : e
                    );
                };
            }
            function pn(e) {
                return (pn = Object.setPrototypeOf
                    ? Object.getPrototypeOf
                    : function (e) {
                          return e.__proto__ || Object.getPrototypeOf(e);
                      })(e);
            }
            var dn = (function () {
                    !(function (e, t) {
                        if ("function" != typeof t && null !== t)
                            throw new TypeError("Super expression must either be null or a function");
                        (e.prototype = Object.create(t && t.prototype, {
                            constructor: { value: e, writable: !0, configurable: !0 },
                        })),
                            t && fn(e, t);
                    })(a, L().Component);
                    var e,
                        t,
                        n,
                        r = mn(a);
                    function a() {
                        return (
                            (function (e) {
                                if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function");
                            })(this),
                            r.apply(this, arguments)
                        );
                    }
                    return (
                        (e = a),
                        (t = [
                            {
                                key: "componentDidMount",
                                value: function () {
                                    try {
                                        oe().module("notificationStream"),
                                            oe().bootstrap(this.container, ["notificationStream"]);
                                    } catch (e) {
                                        console.log(e);
                                    }
                                },
                            },
                            {
                                key: "render",
                                value: function () {
                                    var t = this,
                                        e = Te(),
                                        e = h()("notification-stream-base", e);
                                    return L().createElement("div", {
                                        ref: function (e) {
                                            t.container = e;
                                        },
                                        className: e,
                                        "notification-stream-base-view": "true",
                                    });
                                },
                            },
                        ]) && sn(e.prototype, t),
                        n && sn(e, n),
                        a
                    );
                })(),
                vn = { name: "nsCloseContent", context: "click", additionalProperties: {} };
            function bn() {
                var e = (0, j.useRef)();
                return L().createElement(
                    "li",
                    { id: "navbar-stream", ref: e, className: "navbar-icon-item navbar-stream notification-margins" },
                    L().createElement(
                        y.Popover,
                        {
                            id: "notification-stream-popover",
                            trigger: "click",
                            placement: "bottom",
                            closeOnClick: !1,
                            button: L().createElement(
                                "button",
                                { type: "button", className: "btn-uiblox-common-common-notification-bell-md" },
                                L().createElement(un, null)
                            ),
                            container: e.current,
                            onExit: function () {
                                window.dispatchEvent(new Event("Roblox.NotificationStream.StreamClosed")),
                                    ee.eventStreamService.sendEventWithTarget(
                                        vn.name,
                                        vn.context,
                                        vn.additionalProperties
                                    );
                            },
                            role: "menu",
                        },
                        L().createElement(dn, null)
                    )
                );
            }
            bn.propTypes = {};
            var yn = bn;
            function gn(e) {
                var t = e.accountNotificationCount,
                    e = h()("notification-red notification nav-setting-highlight", { hidden: 0 === t });
                return L().createElement(
                    "span",
                    { id: "settings-icon", className: "nav-settings-icon rbx-menu-item" },
                    L().createElement("span", {
                        className: "icon-nav-settings roblox-popover-close",
                        id: "nav-settings",
                    }),
                    L().createElement("span", { className: e }, t)
                );
            }
            (gn.defaultProps = { accountNotificationCount: 0 }),
                (gn.propTypes = { accountNotificationCount: v().number });
            var hn = gn,
                Sn = B.settingsUrl,
                En = B.quickLoginUrl,
                wn = w,
                On = f.quickLogin,
                Cn = f.settings,
                xn = f.logout;
            function An(e) {
                var r = e.translate,
                    t = e.accountNotificationCount,
                    a = void 0 === t ? 0 : t,
                    o = void 0 !== (e = e.isCrossDeviceLoginCodeValidationDisplayed) && e,
                    i = h()("notification-blue notification nav-setting-highlight", { hidden: 0 === a }),
                    e = Object.entries(Sn)
                        .filter(function (e) {
                            e[0];
                            e = e[1];
                            return !("isVisibleFn" in e) || e.isVisibleFn();
                        })
                        .map(function (e) {
                            var t = e[0],
                                n = e[1],
                                e = n.url,
                                n = n.label;
                            return L().createElement(
                                "li",
                                { key: t },
                                t === xn &&
                                    L().createElement(
                                        y.Link,
                                        { className: "rbx-menu-item logout-menu-item", key: t, onClick: wn, url: "#" },
                                        r(n)
                                    ),
                                t === On &&
                                    o &&
                                    L().createElement(y.Link, { className: "rbx-menu-item", key: t, url: En }, r(n)),
                                t !== xn &&
                                    t !== On &&
                                    L().createElement(
                                        y.Link,
                                        { cssClasses: "rbx-menu-item", key: t, url: e },
                                        r(n),
                                        t === Cn && L().createElement("span", { className: i }, a)
                                    )
                            );
                        });
                return L().createElement(L().Fragment, null, e);
            }
            function In(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return kn(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return kn(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function kn(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Nn(e) {
                var t = e.translate,
                    n = e.accountNotificationCount,
                    r = In((0, j.useState)(!1), 2),
                    e = r[0],
                    a = r[1],
                    r = (0, j.useRef)();
                return (
                    (0, j.useEffect)(function () {
                        a(!0);
                    }, []),
                    L().createElement(
                        "li",
                        { id: "navbar-settings", ref: r, className: "navbar-icon-item" },
                        L().createElement(
                            y.Popover,
                            {
                                id: "settings-popover",
                                trigger: "click",
                                placement: "bottom",
                                className: Te(),
                                containerPadding: 20,
                                button: L().createElement(
                                    "button",
                                    { type: "button", className: "btn-navigation-nav-settings-md" },
                                    L().createElement(hn, { accountNotificationCount: n })
                                ),
                                container: r.current,
                                role: "menu",
                            },
                            L().createElement(
                                "div",
                                { className: Te() },
                                L().createElement(
                                    "ul",
                                    { id: "settings-popover-menu", className: "dropdown-menu" },
                                    L().createElement(An, {
                                        isCrossDeviceLoginCodeValidationDisplayed: e,
                                        translate: t,
                                        accountNotificationCount: n,
                                    })
                                )
                            )
                        )
                    )
                );
            }
            (Nn.defaultProps = { accountNotificationCount: 0 }),
                (Nn.propTypes = { translate: v().func.isRequired, accountNotificationCount: v().number });
            var Rn = Nn;
            function Tn(e) {
                var t = e.robuxAmount,
                    n = e.isGetCurrencyCallDone,
                    e = e.robuxError,
                    t = e ? l : q.abbreviateNumber.getTruncValue(t),
                    t = L().createElement(
                        j.Fragment,
                        null,
                        L().createElement("span", {
                            className: "icon-robux-28x28 roblox-popover-close",
                            id: "nav-robux",
                        }),
                        L().createElement(
                            "span",
                            { className: "rbx-text-navbar-right text-header", id: "nav-robux-amount" },
                            n && t
                        )
                    );
                return L().createElement(
                    "span",
                    { id: "nav-robux-icon", className: "nav-robux-icon rbx-menu-item" },
                    e
                        ? L().createElement(
                              y.Tooltip,
                              {
                                  id: "current-error",
                                  content: e,
                                  placement: "bottom",
                                  containerClassName: "nav-buy-robux-icon-tooltip-container",
                              },
                              t
                          )
                        : t
                );
            }
            (Tn.defaultProps = { robuxAmount: 0, robuxError: "" }),
                (Tn.propTypes = {
                    robuxAmount: v().number,
                    robuxError: v().string,
                    isGetCurrencyCallDone: v().bool.isRequired,
                });
            var Un = Tn,
                Pn = B.buyRobuxUrl;
            function jn(e) {
                var t = e.translate,
                    n = e.robuxAmount,
                    r = e.isGetCurrencyCallDone,
                    n = e.robuxError ? l : q.numberFormat.getNumberFormat(n);
                return L().createElement(
                    L().Fragment,
                    null,
                    L().createElement(
                        "li",
                        null,
                        L().createElement(
                            y.Link,
                            { cssClasses: "rbx-menu-item", id: "nav-robux-balance", url: Pn.robuxBalance.url },
                            r && t("Label.sRobuxMessage", { robuxValue: n })
                        )
                    ),
                    L().createElement(
                        "li",
                        null,
                        L().createElement(
                            y.Link,
                            {
                                cssClasses: "rbx-menu-item",
                                url: Pn.buyRobux.url,
                                onClick: function () {
                                    ee.paymentFlowAnalyticsService.sendUserPurchaseFlowEvent(
                                        ee.paymentFlowAnalyticsService.ENUM_TRIGGERING_CONTEXT.WEB_ROBUX_PURCHASE,
                                        !1,
                                        ee.paymentFlowAnalyticsService.ENUM_VIEW_NAME.NAVIGATION_DROPDOWN_MENU,
                                        ee.paymentFlowAnalyticsService.ENUM_PURCHASE_EVENT_TYPE.USER_INPUT,
                                        ee.paymentFlowAnalyticsService.ENUM_VIEW_MESSAGE.BUY_ROBUX
                                    );
                                },
                            },
                            t(Pn.buyRobux.label)
                        )
                    )
                );
            }
            (jn.defaultProps = { robuxAmount: 0, robuxError: "" }),
                (jn.propTypes = {
                    translate: v().func.isRequired,
                    robuxAmount: v().number,
                    robuxError: v().string,
                    isGetCurrencyCallDone: v().bool.isRequired,
                });
            var Ln = jn;
            function qn(e) {
                var t = e.translate,
                    n = e.robuxAmount,
                    r = e.isGetCurrencyCallDone,
                    a = e.robuxError,
                    e = (0, j.useRef)();
                return L().createElement(
                    "li",
                    { id: "navbar-robux", ref: e, className: "navbar-icon-item" },
                    L().createElement(
                        y.Popover,
                        {
                            id: "buy-robux-popover",
                            trigger: "click",
                            placement: "bottom",
                            button: L().createElement(
                                "button",
                                { type: "button", className: "btn-navigation-nav-robux-md" },
                                L().createElement(Un, { robuxAmount: n, isGetCurrencyCallDone: r, robuxError: a })
                            ),
                            role: "menu",
                            container: e.current,
                        },
                        L().createElement(
                            "div",
                            { className: Te() },
                            L().createElement(
                                "ul",
                                { id: "buy-robux-popover-menu", className: "dropdown-menu" },
                                L().createElement(Ln, {
                                    translate: t,
                                    robuxAmount: n,
                                    isGetCurrencyCallDone: r,
                                    robuxError: a,
                                })
                            )
                        )
                    )
                );
            }
            (qn.defaultProps = { robuxAmount: 0, robuxError: "" }),
                (qn.propTypes = {
                    translate: v().func.isRequired,
                    robuxAmount: v().number,
                    robuxError: v().string,
                    isGetCurrencyCallDone: v().bool.isRequired,
                });
            var Dn = qn;
            function Mn(e) {
                e = e.toggleUniverseSearch;
                return L().createElement(
                    "li",
                    { className: "rbx-navbar-right-search" },
                    L().createElement(
                        "button",
                        { type: "button", className: "rbx-menu-item btn-navigation-nav-search-white-md", onClick: e },
                        L().createElement("span", { className: "icon-nav-search-white" })
                    )
                );
            }
            Mn.propTypes = { toggleUniverseSearch: v().func.isRequired };
            var _n = Mn,
                Fn = RobloxPresence;
            function Bn(e, t, n, r, a, o, i) {
                try {
                    var c = e[o](i),
                        u = c.value;
                } catch (e) {
                    return void n(e);
                }
                c.done ? t(u) : Promise.resolve(u).then(r, a);
            }
            function Gn(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Kn(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Kn(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Kn(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            function Vn() {
                var t = (0, j.useRef)(null),
                    e = d.authenticatedUser.isUnder13,
                    n =
                        (0, S.currentUserHasVerifiedBadge)() && S.VerifiedBadgeIconContainer
                            ? L().createElement(
                                  "section",
                                  {
                                      ref: function (e) {
                                          t.current = e;
                                      },
                                  },
                                  L().createElement(S.VerifiedBadgeIconContainer, {
                                      overrideImgClass: "verified-badge-icon-header",
                                      size: S.BadgeSizes.CAPTIONHEADER,
                                  })
                              )
                            : null,
                    r = Gn((0, j.useState)(!1), 2),
                    a = r[0],
                    o = r[1];
                return (
                    (0, j.useEffect)(function () {
                        function e() {
                            var c;
                            return (
                                (c = regeneratorRuntime.mark(function e() {
                                    var t;
                                    return regeneratorRuntime.wrap(
                                        function (e) {
                                            for (;;)
                                                switch ((e.prev = e.next)) {
                                                    case 0:
                                                        return (
                                                            (e.prev = 0),
                                                            (e.next = 4),
                                                            D.ExperimentationService.getAllValuesForLayer(
                                                                "Zcotton.Test"
                                                            )
                                                        );
                                                    case 4:
                                                        (t = e.sent),
                                                            o(
                                                                null !== (t = t.invisibleModeAllowed) &&
                                                                    void 0 !== t &&
                                                                    t
                                                            ),
                                                            (e.next = 11);
                                                        break;
                                                    case 8:
                                                        (e.prev = 8), (e.t0 = e.catch(0)), console.error(e.t0);
                                                    case 11:
                                                    case "end":
                                                        return e.stop();
                                                }
                                        },
                                        e,
                                        null,
                                        [[0, 8]]
                                    );
                                })),
                                (e = function () {
                                    var e = this,
                                        i = arguments;
                                    return new Promise(function (t, n) {
                                        var r = c.apply(e, i);
                                        function a(e) {
                                            Bn(r, t, n, a, o, "next", e);
                                        }
                                        function o(e) {
                                            Bn(r, t, n, a, o, "throw", e);
                                        }
                                        a(void 0);
                                    });
                                }).apply(this, arguments)
                            );
                        }
                        !(function () {
                            e.apply(this, arguments);
                        })();
                    }, []),
                    L().createElement(
                        "div",
                        { className: "age-bracket-label text-header" },
                        L().createElement(
                            y.Link,
                            { className: "text-link dynamic-overflow-container", url: B.scrollListItems.profile.url },
                            L().createElement(
                                "span",
                                { className: "avatar avatar-headshot-xs" },
                                L().createElement(g.Thumbnail2d, {
                                    containerClass: "avatar-card-image",
                                    targetId: d.authenticatedUser.id,
                                    type: g.ThumbnailTypes.avatarHeadshot,
                                    altName: d.authenticatedUser.name,
                                }),
                                a &&
                                    D.CurrentUser.userId &&
                                    L().createElement(Fn.PresenceStatusIcon, {
                                        className: "avatar-status",
                                        userId: Number.parseInt(D.CurrentUser.userId, 10),
                                    })
                            ),
                            L().createElement(
                                "span",
                                { className: "text-overflow age-bracket-label-username font-caption-header" },
                                We.nameForHeader
                            ),
                            n
                        ),
                        L().createElement(
                            "span",
                            { className: "xsmall age-bracket-label-age text-secondary" },
                            e ? "<13" : "13+"
                        )
                    )
                );
            }
            Vn.propTypes = {};
            var Qn = Vn;
            function Hn(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return Wn(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Wn(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function Wn(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            var zn = C;
            function $n(e) {
                var t = e.translate,
                    n = e.toggleUniverseSearch,
                    r = d.authenticatedUser.isAuthenticated,
                    a = d.authenticatedUser.id,
                    o = Hn((0, j.useState)(0), 2),
                    i = o[0],
                    c = o[1],
                    u = Hn((0, j.useState)(!1), 2),
                    l = u[0],
                    s = u[1],
                    e = Hn((0, j.useState)(0), 2),
                    o = e[0],
                    f = e[1],
                    u = Hn((0, j.useState)(""), 2),
                    e = u[0],
                    m = u[1];
                (0, j.useEffect)(
                    function () {
                        r &&
                            (zn().then(c),
                            $(a)
                                .then(
                                    function (e) {
                                        e = e.data;
                                        f(e.robux);
                                    },
                                    function () {
                                        m("Currency service unavailable");
                                    }
                                )
                                .finally(function () {
                                    s(!0);
                                }));
                    },
                    [r, a]
                );
                var p = L().createElement(
                    "li",
                    { id: "navbar-stream", className: "navbar-icon-item navbar-stream" },
                    L().createElement(
                        "span",
                        { className: "nav-robux-icon rbx-menu-item" },
                        L().createElement("span", {
                            id: "notification-stream-icon-container",
                            "notification-stream-indicator": "true",
                        })
                    )
                );
                try {
                    oe().module("notificationStreamIcon"),
                        oe().module("notificationStream"),
                        (p = L().createElement(yn, null));
                } catch (e) {
                    console.log(e);
                }
                return L().createElement(
                    "ul",
                    { className: "nav navbar-right rbx-navbar-icon-group" },
                    L().createElement(Qn, null),
                    L().createElement(_n, { translate: t, toggleUniverseSearch: n }),
                    p,
                    L().createElement(Dn, { translate: t, robuxAmount: o, isGetCurrencyCallDone: l, robuxError: e }),
                    L().createElement(Rn, { translate: t, accountNotificationCount: i })
                );
            }
            function Xn() {
                window.location.href = Jn();
            }
            ($n.defaultProps = { accountNotificationCount: 0 }),
                ($n.propTypes = {
                    translate: v().func.isRequired,
                    accountNotificationCount: v().number,
                    toggleUniverseSearch: v().func.isRequired,
                });
            var Yn = $n,
                Jn = p;
            function Zn(e) {
                e = e.translate;
                return L().createElement(
                    "li",
                    { className: "signup-button-container" },
                    L().createElement(
                        y.Link,
                        {
                            onClick: Xn,
                            url: Jn(),
                            id: "sign-up-button",
                            className: "rbx-navbar-signup btn-growth-sm nav-menu-title signup-button",
                        },
                        e("Label.sSignUp")
                    )
                );
            }
            function er() {
                window.location.href = rr();
            }
            Zn.propTypes = { translate: v().func.isRequired };
            var tr = Zn,
                nr = a,
                rr = b;
            function ar(e) {
                e = e.translate;
                return L().createElement(
                    "li",
                    { className: "login-action" },
                    nr() &&
                        L().createElement(
                            y.Link,
                            {
                                onClick: er,
                                url: rr(),
                                className: "rbx-navbar-login btn-secondary-sm nav-menu-title rbx-menu-item",
                            },
                            e("Label.sLogin")
                        )
                );
            }
            ar.propTypes = { translate: v().func.isRequired };
            var or = ar;
            function ir() {
                return (ir =
                    Object.assign ||
                    function (e) {
                        for (var t = 1; t < arguments.length; t++) {
                            var n,
                                r = arguments[t];
                            for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]);
                        }
                        return e;
                    }).apply(this, arguments);
            }
            function cr(e, t) {
                if (null == e) return {};
                var n,
                    r = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            a = {},
                            o = Object.keys(e);
                        for (r = 0; r < o.length; r++) (n = o[r]), 0 <= t.indexOf(n) || (a[n] = e[n]);
                        return a;
                    })(e, t);
                if (Object.getOwnPropertySymbols)
                    for (var a = Object.getOwnPropertySymbols(e), o = 0; o < a.length; o++)
                        (n = a[o]),
                            0 <= t.indexOf(n) || (Object.prototype.propertyIsEnumerable.call(e, n) && (r[n] = e[n]));
                return r;
            }
            function ur(e) {
                var t = e.translate,
                    n = e.toggleUniverseSearch,
                    e = cr(e, ["translate", "toggleUniverseSearch"]);
                return d.authenticatedUser.isAuthenticated
                    ? L().createElement(
                          "div",
                          { className: "navbar-right rbx-navbar-right" },
                          L().createElement(Yn, ir({ translate: t, toggleUniverseSearch: n }, e))
                      )
                    : L().createElement(
                          "div",
                          { className: "navbar-right rbx-navbar-right" },
                          L().createElement(
                              "ul",
                              { className: "nav navbar-right rbx-navbar-right-nav" },
                              L().createElement(tr, { translate: t }),
                              L().createElement(or, { translate: t }),
                              L().createElement(_n, { translate: t, toggleUniverseSearch: n })
                          )
                      );
            }
            ur.propTypes = { translate: v().func.isRequired, toggleUniverseSearch: v().func.isRequired };
            var lr = ur;
            function sr() {
                return (sr =
                    Object.assign ||
                    function (e) {
                        for (var t = 1; t < arguments.length; t++) {
                            var n,
                                r = arguments[t];
                            for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]);
                        }
                        return e;
                    }).apply(this, arguments);
            }
            function fr(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        if ("undefined" == typeof Symbol || !(Symbol.iterator in Object(e))) return;
                        var n = [],
                            r = !0,
                            a = !1,
                            o = void 0;
                        try {
                            for (
                                var i, c = e[Symbol.iterator]();
                                !(r = (i = c.next()).done) && (n.push(i.value), !t || n.length !== t);
                                r = !0
                            );
                        } catch (e) {
                            (a = !0), (o = e);
                        } finally {
                            try {
                                r || null == c.return || c.return();
                            } finally {
                                if (a) throw o;
                            }
                        }
                        return n;
                    })(e, t) ||
                    (function (e, t) {
                        if (!e) return;
                        if ("string" == typeof e) return mr(e, t);
                        var n = Object.prototype.toString.call(e).slice(8, -1);
                        "Object" === n && e.constructor && (n = e.constructor.name);
                        if ("Map" === n || "Set" === n) return Array.from(e);
                        if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return mr(e, t);
                    })(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function mr(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r;
            }
            var pr = (0, M.withTranslations)(function (e) {
                    var t = Ie(),
                        n = fr((0, j.useState)(t), 2),
                        r = n[0],
                        a = n[1],
                        t = (n = fr((0, j.useState)(!t), 2))[0],
                        o = n[1],
                        i = (0, j.useCallback)(
                            function () {
                                var e = Ie();
                                r !== e && (a(e), o(!e));
                            },
                            [r]
                        );
                    return (
                        (0, j.useEffect)(
                            function () {
                                return (
                                    window.addEventListener("resize", i),
                                    function () {
                                        window.removeEventListener("resize", i);
                                    }
                                );
                            },
                            [i]
                        ),
                        L().createElement(
                            L().Fragment,
                            null,
                            L().createElement(tn, sr({ isUniverseSearchShown: t }, e)),
                            L().createElement(
                                lr,
                                sr(
                                    {
                                        toggleUniverseSearch: function () {
                                            o(function (e) {
                                                return !e;
                                            });
                                        },
                                    },
                                    e
                                )
                            )
                        )
                    );
                }, m),
                dr = r;
            function vr(e) {
                var e = e.translate,
                    t = document.getElementById(dr);
                return L().createElement(
                    y.Button,
                    {
                        id: "skip-to-main-content",
                        size: y.Button.sizes.extraSmall,
                        variant: y.Button.variants.primary,
                        onClick: function () {
                            return t.focus();
                        },
                    },
                    e("Action.SkipToMainContent") || "Skip to main content"
                );
            }
            vr.propTypes = { translate: v().func.isRequired };
            var br = vr,
                yr = s,
                gr = d.authenticatedUser.isAuthenticated;
            function hr(e) {
                var t = y.IconButton.iconTypes;
                return L().createElement(
                    j.Fragment,
                    null,
                    L().createElement(br, e),
                    gr &&
                        L().createElement(y.IconButton, {
                            className: "menu-button",
                            iconType: t.navigation,
                            iconName: "nav-menu",
                            onClick: function () {
                                document.dispatchEvent(new CustomEvent(yr.name));
                            },
                        })
                );
            }
            hr.propTypes = {};
            var Sr = (0, M.withTranslations)(hr, m);
            function Er(t, e) {
                var n,
                    r = Object.keys(t);
                return (
                    Object.getOwnPropertySymbols &&
                        ((n = Object.getOwnPropertySymbols(t)),
                        e &&
                            (n = n.filter(function (e) {
                                return Object.getOwnPropertyDescriptor(t, e).enumerable;
                            })),
                        r.push.apply(r, n)),
                    r
                );
            }
            function wr(r) {
                for (var e = 1; e < arguments.length; e++) {
                    var a = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? Er(Object(a), !0).forEach(function (e) {
                              var t, n;
                              (t = r),
                                  (e = a[(n = e)]),
                                  n in t
                                      ? Object.defineProperty(t, n, {
                                            value: e,
                                            enumerable: !0,
                                            configurable: !0,
                                            writable: !0,
                                        })
                                      : (t[n] = e);
                          })
                        : Object.getOwnPropertyDescriptors
                          ? Object.defineProperties(r, Object.getOwnPropertyDescriptors(a))
                          : Er(Object(a)).forEach(function (e) {
                                Object.defineProperty(r, e, Object.getOwnPropertyDescriptor(a, e));
                            });
                }
                return r;
            }
            Ar(226);
            var o = o,
                Or = "right-navigation-header",
                Cr = "left-navigation-container",
                xr = "header-menu-icon";
            (n().NavigationService = wr(wr({}, n().NavigationService), {}, { logoutAndRedirect: o })),
                (0, q.ready)(function () {
                    document.getElementById(xr) &&
                        (0, e.render)(L().createElement(Sr, null), document.getElementById(xr)),
                        document.getElementById(Or) &&
                            (0, e.render)(L().createElement(pr, null), document.getElementById(Or)),
                        document.getElementById(Cr) &&
                            (0, e.render)(L().createElement(it, null), document.getElementById(Cr));
                });
        })();
})();
//# sourceMappingURL=https://js.rbxcdn.com/53aecdc325bbbba8d01aadb87fc5f8a0-navigation.bundle.min.js.map

/* Bundle detector */
window.Roblox && window.Roblox.BundleDetector && window.Roblox.BundleDetector.bundleDetected("Navigation");