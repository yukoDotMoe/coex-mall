<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 15801375;
    ;(function (n, t, c) {
        function i(n) {
            return e._h ? e._h.apply(null, n) : e._q.push(n)
        }

        var e = {
            _q: [], _h: null, _v: "2.0", on: function () {
                i(["on", c.call(arguments)])
            }, once: function () {
                i(["once", c.call(arguments)])
            }, off: function () {
                i(["off", c.call(arguments)])
            }, get: function () {
                if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
                return i(["get", c.call(arguments)])
            }, call: function () {
                i(["call", c.call(arguments)])
            }, init: function () {
                var n = t.createElement("script");
                n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
            }
        };
        !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
    }(window, document, [].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/15801375/" rel="nofollow">Chat with us</a>, powered by <a
        href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
<title>{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}</title>
<link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
<meta name="description" content="{{ \App\Http\Controllers\ApiController::getSetting('page_decs') }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}"/>
<meta property="og:description" content="{{ \App\Http\Controllers\ApiController::getSetting('page_decs') }}"/>
<meta property="og:url" content="/"/>
<meta property="og:image" content="{{ asset('logo.png') }}"/>
<meta property="og:site_name" content="{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}"/>
