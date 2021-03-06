! function(e, o, t) {
    var i = o.AvocadoVideo = {};
    "function" != typeof Object.create && (Object.create = function(e) {
        function o() {}
        return o.prototype = e, new o
    }), String.prototype.replaceAll = function(e, o) {
        var t = this;
        return t.replace(new RegExp(e, "g"), o)
    };
    var n = {
            defaults: {
                autoplay: !0,
                loop: !0,
                muted: !0,
                controls: !1,
                ratio: 16 / 9,
                fitContainer: !0,
                forceAspect: !1
            },
            init: function(t, i) {
                var n = this;
                return n.$window = e(o), n.$container = e(t), n.$dataContainer = n.$container, n.options = e.extend(!0, {}, n.defaults, i), n.ID = parseInt(1e6 * Math.random()), n.outerID = "avocadoVideoOuter" + n.ID, n.innerID = "avocadoVideoInner" + n.ID, n.posterID = "avocadoVideoPoster" + n.ID, n.overlayID = "avocadoVideoOverlay" + n.ID, n.resizeEventID = "resize.AvocadoVideo" + n.ID, "BODY" === t.tagName && (n.$container = e('<div class="avocado-player fullscreen-background"></div>'), e(t).append(n.$container)), n.createPlayerDOM(), n.adapter = n.detectAdapter(), n.adapter.init(n), n.$window.on(n.resizeEventID, n.resize.bind(n)).trigger(n.resizeEventID), n.$dataContainer.trigger("player.initialised", n), n
            },
            detectAdapter: function() {
                if ("object" == typeof this.options.youTube) return Object.create(s);
                if ("object" == typeof this.options.vimeo) return Object.create(VimeoAdapter);
                if ("object" == typeof this.options.html5) return Object.create(r);
                throw "Invalid options passed, no adapter configuration found."
            },
            createPlayerDOM: function() {
                var o = this;
                o.player = {}, o.player.$outer = e('<div id="' + o.outerID + '" class="avocado-player-outer"></div>'), o.player.$inner = e('<div id="' + o.innerID + '" class="avocado-player-inner"></div>'), o.player.$poster = e('<div id="' + o.posterID + '" class="avocado-player-poster"></div>'), o.$container.append(o.player.$outer.append(o.player.$poster, o.player.$inner)), o.options.overlay && (o.player.$overlay = e('<div id="' + o.overlayID + '" class="avocado-player-overlay"></div>'), "undefined" != typeof o.options.overlay["class"] && o.player.$overlay.addClass(o.options.overlay["class"]), "undefined" != typeof o.options.overlay.opacity && o.player.$overlay.css("opacity", o.options.overlay.opacity), "undefined" != typeof o.options.overlay.color && o.player.$overlay.css("background-color", o.options.overlay.color), "undefined" != typeof o.options.overlay.image && (o.player.$overlay.css("background-image", "url(" + o.options.overlay.image + ")"), "undefined" != typeof o.options.overlay.backgroundSize && o.player.$overlay.css("background-size", "url(" + o.options.overlay.backgroundSize + ")"), "undefined" != typeof o.options.overlay.backgroundRepeat && o.player.$overlay.css("background-repeat", "url(" + o.options.overlay.backgroundRepeat + ")")), o.$container.append(o.player.$overlay))
            },
            setPoster: function(e) {
                this.player.$poster.css("background-image", "url(" + e + ")")
            },
            resize: function() {
                var o, i, n = this;
                return n.options.width = n.$container.width(), n.options.height = n.$container.height(), e.contains(t, n.player.$inner[0]) || (n.player.$inner = e("#" + n.innerID)), n.options.forceAspect ? (i = (n.options.width / n.options.ratio).toFixed(3), n.$container.height(i), void e([n.player.$inner, n.player.$poster]).each(function() {
                    e(this).css({
                        left: 0,
                        top: 0,
                        height: i,
                        width: n.options.width
                    })
                })) : (n.options.fitContainer && n.options.width / n.options.ratio < n.options.height ? (o = Math.ceil(n.options.height * n.options.ratio), e([n.player.$inner, n.player.$poster]).each(function() {
                    e(this).width(o).height(n.options.height).css({
                        left: (n.options.width - o) / 2,
                        top: 0
                    })
                })) : (i = Math.ceil(n.options.width / n.options.ratio), e([n.player.$inner, n.player.$poster]).each(function() {
                    e(this).width(n.options.width).height(i).css({
                        left: 0,
                        top: (n.options.height - i) / 2
                    })
                })), void n.$dataContainer.trigger("player.resized", n))
            },
            videoLoaded: function() {
                this.$container.addClass("loaded"), this.$dataContainer.trigger("video.loaded", this)
            },
            videoPlaying: function() {
                this.$container.removeClass("paused").addClass("playing"), this.$dataContainer.trigger("video.playing", this)
            },
            videoPaused: function() {
                this.$container.removeClass("playing").addClass("paused"), this.$dataContainer.trigger("video.paused", this)
            },
            videoEnded: function() {
                this.$container.removeClass("playing"), this.$dataContainer.trigger("video.ended", this)
            },
            destroy: function() {
                this.adapter.destroy(), this.player.$inner.remove(), this.player.$outer.remove(), this.player.$poster.remove(), this.player.$overlay && this.player.$overlay.remove(), this.$container.empty(), this.$container.removeClass("playing paused loaded transition-in"), this.$dataContainer.trigger("player.destroyed"), this.$dataContainer.removeData("player");
                for (var e in this) this[e] = null
            },
            play: function() {
                this.adapter.play()
            },
            pause: function() {
                this.adapter.pause()
            },
            goTo: function(e) {
                this.adapter.goTo(e)
            }
        },
        a = {
            defaults: {},
            init: function(e) {
                throw "Not implemented"
            },
            destroy: function() {
                throw "Not implemented"
            },
            play: function() {
                throw "Not implemented"
            },
            pause: function() {
                throw "Not implemented"
            },
            goTo: function() {
                throw "Not implemented"
            }
        },
        r = e.extend(Object.create(a), {
            defaults: {
                sources: [],
                props: {
                    preload: "auto",
                    crossorigin: null
                }
            },
            init: function(o) {
                this.avocadoVideo = o, this.options = e.extend(!0, {}, this.defaults, this.avocadoVideo.options.html5), this.avocadoVideo.$container.addClass("html5"), "undefined" != typeof this.options.src && 0 === this.options.sources.length && (this.options.props.src = this.options.src), "undefined" != typeof this.options.poster && (this.avocadoVideo.setPoster(this.options.poster), this.options.props.poster = this.options.poster), "undefined" == typeof this.options.props.autoplay && (this.options.props.autoplay = this.avocadoVideo.options.autoplay), "undefined" == typeof this.options.props.loop && (this.options.props.loop = this.avocadoVideo.options.loop), "undefined" == typeof this.options.props.controls && (this.options.props.controls = this.avocadoVideo.options.controls), "undefined" == typeof this.options.props.muted && (this.options.props.muted = this.avocadoVideo.options.muted), this.createHTML5Video()
            },
            createHTML5Video: function() {
                this.$video = e("<video></video>").html("Your browser doesn't support HTML5 video tag.").on("canplay playing pause ended", this.onPlayerStateChange.bind(this));
                for (var o in this.options.props) {
                    var t = this.options.props[o];
                    t && this.$video.prop(o, t)
                }
                for (var i in this.options.sources) this.$video.append(e("<source></source>").prop("src", this.options.sources[i][1]).prop("type", this.options.sources[i][0]));
                this.avocadoVideo.player.$inner.append(this.$video)
            },
            onPlayerStateChange: function(e) {
                switch (e.type) {
                    case "canplay":
                        this.avocadoVideo.videoLoaded();
                        break;
                    case "playing":
                        this.avocadoVideo.videoPlaying();
                        break;
                    case "pause":
                        this.avocadoVideo.videoPaused();
                        break;
                    case "ended":
                        this.avocadoVideo.videoEnded()
                }
            },
            destroy: function() {
                this.pause(), this.$video.prop("src", "#"), this.$video.remove(), this.avocadoVideo.$container.removeClass("html5");
                for (var e in this) this[e] = null
            },
            play: function() {
                this.$video[0].play()
            },
            pause: function() {
                this.$video[0].pause()
            },
            goTo: function(e) {
                this.$video[0].currentTime = e
            }
        }),
        s = e.extend(Object.create(a), {
            defaults: {
                videoId: "",
                tranitionIn: !1,
                playerVars: {
                    iv_load_policy: 3,
                    modestbranding: 1,
                    showinfo: 0,
                    wmode: "opaque",
                    branding: 0,
                    autohide: 1,
                    rel: 0
                }
            },
            init: function(o) {
                var t = this;
                t.avocadoVideo = o, this.avocadoVideo.$container.addClass("youtube"), t.options = e.extend(!0, {}, t.defaults, t.avocadoVideo.options.youTube), "undefined" != typeof t.options.poster && t.avocadoVideo.setPoster(this.options.poster), "undefined" == typeof t.options.playerVars.autoplay && (t.options.playerVars.autoplay = t.avocadoVideo.options.autoplay ? 1 : 0), "undefined" == typeof t.options.playerVars.controls && (t.options.playerVars.controls = t.avocadoVideo.options.controls ? 1 : 0), this.options.tranitionIn && this.avocadoVideo.$container.addClass("transition-in"), "undefined" == typeof i.YouTube && (i.YouTube = {
                    apiLoading: !1,
                    onApiLoad: e.Deferred()
                }), t.whenApiIsReady(t.createPlayer.bind(t)), t.loadApi()
            },
            whenApiIsReady: function(e) {
                return "object" == typeof YT ? void e() : void i.YouTube.onApiLoad.done(function() {
                    e()
                })
            },
            loadApi: function() {
                if ("undefined" == typeof YT && i.YouTube.apiLoading === !1) {
                    i.YouTube.apiLoading = !0, o.onYouTubeIframeAPIReady = function() {
                        o.onYouTubeIframeAPIReady = null, i.YouTube.onApiLoad.resolve()
                    };
                    var e = t.createElement("script"),
                        n = t.getElementsByTagName("head")[0];
                    "file://" == o.location.origin ? e.src = "http://www.youtube.com/iframe_api" : e.src = "//www.youtube.com/iframe_api", n.appendChild(e), n = null, e = null
                }
            },
            createPlayer: function() {
                var e = this;
                e.player = new YT.Player(e.avocadoVideo.innerID, {
                    videoId: e.options.videoId,
                    playerVars: e.options.playerVars,
                    events: {
                        onReady: e.onPlayerReady.bind(e),
                        onStateChange: e.onPlayerStateChange.bind(e)
                    }
                })
            },
            onPlayerReady: function(e) {
                this.avocadoVideo.videoLoaded(), this.avocadoVideo.options.muted && e.target.mute()
            },
            onPlayerStateChange: function(e) {
                var o = this;
                switch (e.data) {
                    case YT.PlayerState.PLAYING:
                        var t = setInterval(function() {
                            o.player.getCurrentTime() >= .26 && (clearInterval(t), o.avocadoVideo.videoPlaying())
                        }, 50);
                        break;
                    case YT.PlayerState.PAUSED:
                        this.avocadoVideo.videoPaused();
                        break;
                    case YT.PlayerState.ENDED:
                        this.avocadoVideo.videoEnded(), this.avocadoVideo.options.loop && (this.goTo(0), this.play())
                }
            },
            destroy: function() {
                this.pause(), this.player.destroy(), this.avocadoVideo.$container.removeClass("youtube");
                for (var e in this) this[e] = null
            },
            play: function() {
                this.player.playVideo()
            },
            pause: function() {
                this.player.pauseVideo()
            },
            goTo: function(e) {
                this.player.seekTo(e)
            }
        });
    VimeoAdapter = e.extend(Object.create(a), {
        defaults: {
            videoId: "",
            transitionIn: !1,
            playerVars: {
                autopause: !1,
                byline: !1,
                color: "00adef",
                portrait: !1,
                title: !1
            }
        },
        init: function(o) {
            var t = this;
            t.avocadoVideo = o, this.avocadoVideo.$container.addClass("vimeo"), t.options = e.extend(!0, {}, t.defaults, t.avocadoVideo.options.vimeo), t.options.playerVars.id = t.options.videoId, "undefined" == typeof i.Vimeo && (i.Vimeo = {
                apiLoading: !1,
                onApiLoad: e.Deferred(),
                apiCheckInterval: null
            }), "undefined" != typeof t.options.poster && t.avocadoVideo.setPoster(this.options.poster), "undefined" == typeof t.options.playerVars.autoplay && (t.options.playerVars.autoplay = t.avocadoVideo.options.autoplay), "undefined" == typeof t.options.playerVars.controls && (t.options.playerVars.background = !t.avocadoVideo.options.controls), "undefined" == typeof this.options.playerVars.loop && (this.options.playerVars.loop = this.avocadoVideo.options.loop), this.options.tranitionIn && this.avocadoVideo.$container.addClass("transition-in"), t.whenApiIsReady(t.createPlayer.bind(this)), t.loadApi()
        },
        whenApiIsReady: function(e) {
            return "object" == typeof Vimeo ? void e() : void i.Vimeo.onApiLoad.done(function() {
                e()
            })
        },
        loadApi: function() {
            if ("undefined" == typeof Vimeo && i.Vimeo.apiLoading === !1) {
                i.Vimeo.apiLoading = !0, i.Vimeo.apiCheckInterval = setInterval(function() {
                    "undefined" != typeof Vimeo && (clearInterval(i.Vimeo.apiCheckInterval), i.Vimeo.onApiLoad.resolve())
                }, 100);
                var e = t.createElement("script"),
                    n = t.getElementsByTagName("head")[0];
                "file://" == o.location.origin ? e.src = "http://player.vimeo.com/api/player.js" : e.src = "//player.vimeo.com/api/player.js", n.appendChild(e), n = null, e = null
            }
        },
        getVideoUrl: function() {
            var t, i;
            return i = e.param(this.options.playerVars).replaceAll("false", "0").replaceAll("true", "1"), t = "file://" == o.location.origin ? "http://player.vimeo.com/video/" : "//player.vimeo.com/video/", t + this.options.videoId + "?" + i
        },
        createPlayer: function() {
            var o = this,
                t = e("<iframe></iframe>").prop("src", this.getVideoUrl());
            this.avocadoVideo.player.$inner.append(t), this.player = new Vimeo.Player(t[0]), this.avocadoVideo.options.muted && this.player.setVolume(0), this.player.on("play", function(e) {
                var t = setInterval(function() {
                    o.player.getCurrentTime().then(function(e) {
                        e > 0 && (clearInterval(t), o.avocadoVideo.videoPlaying())
                    })
                }, 50)
            }), this.player.on("pause", this.avocadoVideo.videoPaused.bind(this.avocadoVideo)), this.player.on("ended", this.avocadoVideo.videoEnded.bind(this.avocadoVideo)), this.player.on("loaded", this.avocadoVideo.videoLoaded.bind(this.avocadoVideo)), t = null
        },
        destroy: function() {
            this.pause(), this.avocadoVideo.$container.addClass("vimeo"), this.player.unload();
            for (var e in this) this[e] = null
        },
        play: function() {
            this.player.play()
        },
        pause: function() {
            this.player.pause()
        },
        goTo: function(e) {
            this.player.setCurrentTime(e)
        }
    }), e.fn.AvocadoVideo = function(o) {
        return this.each(function() {
            var t = Object.create(n);
            t.init(this, o), e.data(this, "player", t), t = null
        })
    }
}(jQuery, window, document);

