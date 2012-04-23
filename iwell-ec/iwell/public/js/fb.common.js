var log = function(a, b) {
	if (typeof (DEBUG) == "undefined" || DEBUG === false) {
		return false
	} else {
		console.log(a);
		if ("undefined" != typeof (b) && null != b) {
			console.log(JSON.stringify(b))
		}
	}
};
Function.prototype.method = function(a, b) {
	this.prototype[a] = b;
	return this
};
Array.prototype.unique = function() {
	var c = [];
	var b = this.length;
	for ( var e = 0; e < b; e++) {
		for ( var d = e + 1; d < b; d++) {
			if (this[e] === this[d]) {
				d = ++e
			}
		}
		c.push(this[e])
	}
	return c
};
if (!Array.prototype.remove) {
	Array.prototype.remove = function(c, b) {
		var a = this.slice((b || c) + 1 || this.length);
		this.length = c < 0 ? this.length + c : c;
		return this.push.apply(this, a)
	}
}
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(c, b) {
		for ( var a = this.length, b = b < 0 ? b + a < 0 ? 0 : b + a : b || 0; b < a
				&& this[b] !== c; b++) {
		}
		return a <= b ? -1 : b
	}
}
String.prototype.unescapeHtml = function() {
	var a = document.createElement("div");
	a.innerHTML = this;
	var b = a.childNodes[0].nodeValue;
	a.removeChild(a.firstChild);
	return b
};
var showMessage = function(b, c, d, e, a) {
	if (c == "error") {
		$("#" + b + " .fabShopSprite").attr("class",
				"fabShopSprite errorMessageIcon")
	} else {
		$("#" + b + " .fabShopSprite").attr("class",
				"fabShopSprite successMessageIcon")
	}
	$("#" + b + " .errorMessage").html(d);
	$("#" + b).css("display", "inline-block");
	if (e == undefined || e != 0) {
		$("#" + b).delay(5000).fadeOut("slow", function() {
			if (typeof (a) == "function") {
				a()
			}
		})
	}
};
var fabMsgHandler = function(b, c, d, e, a) {
	$("#" + b + " .fabShopSprite").attr("class",
			"fabShopSprite " + c + "MessageIcon");
	$("#" + b + " .errorMessage").html(d);
	$("#" + b).fadeIn();
	if (e == true) {
		$("#" + b).delay(6000).fadeOut("slow", function() {
			if (typeof (a) == "function") {
				a()
			}
		})
	}
};
(function(a) {
	a.fn.hideDomOnClick = function(c) {
		var b = this;
		var d = function(e) {
			if (a(e.target).closest(b).get(0) == null
					&& a(e.target).closest(c.join(",")).get(0) == null) {
				b.hide()
			}
		};
		return b.each(function() {
			a(document).unbind("click", d);
			a(document).bind("click", d)
		})
	}
})(jQuery);
var Helper = {
	encode : function(a) {
		return $("<div/>").text(a).html()
	},
	decode : function(a) {
		return $("<div/>").html(a).text()
	},
	hideDomOnClick : function(a, b, c) {
		$("body").click(function(g) {
			if (b.indexOf(g.target.id) != -1) {
				return false
			}
			for ( var f = 0, d = b.length; f < d; f++) {
				if (g.target.className.split(" ").indexOf(b[f]) != -1) {
					return false
				}
			}
			a.hide();
			if (typeof (c) == "function") {
				c(a)
			}
		})
	},
	getCount : function(c) {
		var b = "__count__", a = Object.prototype.hasOwnProperty;
		if (typeof c[b] === "number" && !a.call(c, b)) {
			return c[b]
		}
		b = 0;
		for ( var d in c) {
			if (a.call(c, d)) {
				b++
			}
		}
		return b
	},
	showMessage : function(f, d, c, e) {
		var a = $(f), b = [ "error", "success" ];
		e = $.extend({
			delay : 2000
		}, e);
		a.html(c).removeClass(b[0]).removeClass(b[1]).addClass(d).fadeIn()
				.delay(e.delay).fadeOut()
	},
	facebookShare : function(c, b) {
		var a = {
			method : "feed",
			message : (c.message == undefined ? "" : c.message),
			picture : ((c.attachment.media == undefined || c.attachment.media.length == 0) ? ""
					: c.attachment.media[0].src),
			source : ((c.attachment.media == undefined || c.attachment.media.length == 0) ? ""
					: c.attachment.media[0].src),
			caption : (c.attachment.caption == undefined ? ""
					: c.attachment.caption),
			name : (c.attachment.name == undefined ? "" : c.attachment.name),
			description : ((c.attachment.description == undefined || c.attachment.description == "") ? " "
					: c.attachment.description),
			properties : (c.attachment.properties == undefined ? ""
					: c.attachment.properties),
			link : (c.attachment.href == undefined ? "" : c.attachment.href),
			to : (c.to == undefined ? "" : c.to)
		};
		FB.ui(a, b)
	},
	countChar : function(c, b) {
		var a = parseInt(c.attr("maxlength"));
		c
				.unbind("keyup")
				.bind(
						"keyup",
						function() {
							(c.val().length < a) ? b.html(a
									- $(this).val().length)
									: $(this).val($(this).val().substr(0, a))
											+ b
													.html('<SPAN style="COLOR: #ff0000">0</SPAN>')
						});
		if (!c.hasClass("deft")) {
			c.trigger("keyup")
		}
	},
	checkValidDateWithSlash : function(b) {
		var d = /^\d{2}\/\d{2}\/\d{4}$/, e = true;
		var g = b.split("/")[0], c = b.split("/")[1], a = b.split("/")[2], f = new Date(
				a, g - 1, c);
		if ((f.getMonth() + 1 != g) || (f.getDate() != c)
				|| (f.getFullYear() != a)) {
			alert(1)
		}
		return e
	},
	changeDateFormat : function(f, b, a, e, d) {
		var c = f.split(e);
		if (b == "month_first") {
			if (b == "date_first") {
				return c[1] + d + c[0] + d + c[2]
			} else {
				return c[0] + d + c[1] + d + c[2]
			}
		} else {
			if (b == "date_first") {
				return c[0] + d + c[1] + d + c[2]
			} else {
				return c[1] + d + c[0] + d + c[2]
			}
		}
	},
	validateEmail : function(a) {
		var b = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
		return b.test(a)
	}
};
(function(a) {
	a.cookie = function(b, l, k) {
		if (typeof l != "undefined") {
			k = k || {};
			if (l === null) {
				l = "";
				k.expires = -1
			}
			var f = "";
			if (k.expires
					&& (typeof k.expires == "number" || k.expires.toUTCString)) {
				var c;
				if (typeof k.expires == "number") {
					c = new Date();
					c.setTime(c.getTime() + (k.expires * 24 * 60 * 60 * 1000))
				} else {
					c = k.expires
				}
				f = "; expires=" + c.toUTCString()
			}
			var n = k.path ? "; path=" + (k.path) : "";
			var d = k.domain ? "; domain=" + (k.domain) : "";
			var j = k.secure ? "; secure" : "";
			document.cookie = [ b, "=", encodeURIComponent(l), f, n, d, j ]
					.join("")
		} else {
			var h = null;
			if (document.cookie && document.cookie != "") {
				var m = document.cookie.split(";");
				for ( var e = 0; e < m.length; e++) {
					var g = a.trim(m[e]);
					if (g.substring(0, b.length + 1) == (b + "=")) {
						h = decodeURIComponent(g.substring(b.length + 1));
						break
					}
				}
			}
			return h
		}
	}
}(jQuery));
(function(a) {
	a.switchDefTxt = function() {
		a("[rel^='dtext']").each(function() {
			var c = a(this).attr("title"), b = a(this);
			b.blur(function() {
				if (b.val() == "") {
					b.val(c).addClass("deft")
				}
			}).trigger("blur");
			b.focus(function() {
				if (b.val() == c) {
					b.val("").removeClass("deft")
				}
			})
		})
	}
}(jQuery));
(function(a) {
	a.addCardHandler = function() {
		var c = {
			"34" : "acard",
			"37" : "acard",
			"6011" : "dcard",
			"65" : "dcard",
			"50" : "mcard",
			"51" : "mcard",
			"52" : "mcard",
			"53" : "mcard",
			"54" : "mcard",
			"55" : "mcard",
			"40" : "vcard",
			"41" : "vcard",
			"42" : "vcard",
			"43" : "vcard",
			"44" : "vcard",
			"45" : "vcard",
			"46" : "vcard",
			"47" : "vcard",
			"48" : "vcard",
			"49" : "vcard"
		};
		a("input.ccNumber").bind("cut copy paste", function(d) {
			d.preventDefault();
			return false;
			a(this).focus()
		});
		a("#cnumber1")
				.keyup(
						function() {
							var f = a(this).val() == "6011" ? a(this).val()
									: a(this).val().slice(0, 2), d = f.length;
							if (a("#cnumber1").val() == "") {
								a(".cardImages .ccard").removeClass(
										"fullOpactiy");
								b();
								return
							}
							if (d >= 2) {
								var e = c[f] || null;
								if (e) {
									if (a(".cardImages ." + e).hasClass(
											"fullOpactiy")) {
										return
									}
									a(".cardImages .ccard").removeClass(
											"fullOpactiy");
									a(".cardImages ." + e).addClass(
											"fullOpactiy");
									if (e == "acard") {
										a("#cardTip")
												.text(
														"(the 15 digits on the front of the card)");
										a("#cvvTip")
												.text(
														"(Last 4 digits on back of card)");
										a("#cnumber4").attr("rel", "optional")
												.val("").hide();
										a("#cnumber1").attr({
											maxlength : "4",
											size : "4"
										}).css("width", "58");
										a("#cnumber2").attr({
											maxlength : "6",
											size : "6"
										}).css("width", "78").val("");
										a("#cnumber3").attr({
											maxlength : "5",
											size : "5"
										}).css("width", "68").val("");
										a("#card_cvv").attr({
											maxlength : "4",
											size : "4"
										}).val("")
									} else {
										b()
									}
									a.switchFocus(a(".ccNumber"))
								}
							} else {
								a(".cardImages .ccard").removeClass(
										"fullOpactiy");
								return
							}
						});
		var b = function() {
			a("#cardTip").text("(the 16 digits on the front of the card)");
			a("#cvvTip").text("(Last 3 digits on back of card)");
			a("#cnumber1").attr({
				maxlength : "4",
				size : "4"
			}).css("width", "58");
			a("#cnumber2, #cnumber3").attr({
				maxlength : "4",
				size : "4"
			}).val("").css("width", "58");
			a("#cnumber4").removeAttr("rel").val("").show();
			a("#card_cvv").attr({
				maxlength : "3",
				size : "3"
			}).val("")
		}
	}
}(jQuery));
(function(a) {
	a.switchFocus = function(b) {
		b.unbind("keyup");
		a.addCardHandler();
		b.each(function() {
			a(this).keyup(function() {
				var f = a(this), e = f.val(), c = e.length, d = f.next();
				if (c == f.attr("size") && d.length > 0) {
					if (d.val().length === 0) {
						d.focus()
					}
				}
			})
		})
	}
}(jQuery));
(function(a) {
	a.fn.faderEffect = function(b) {
		var b = a.extend({
			count : 1,
			speed : 2000,
			callback : function() {
			}
		}, b || {});
		return this.each(function() {
			if (a(this).is(":visible")) {
				a(this).fadeOut()
			}
			a(this).fadeIn(b.speed, function() {
				b.count = b.count - 1;
				if (b.count === 0) {
					if (a.isFunction(b.callback)) {
						b.callback()
					}
					return
				}
				a(this).faderEffect(b)
			})
		})
	}
}(jQuery));
(function(b) {
	var a = {
		start_timer : function(c, f) {
			var e = c.from;
			var d = setInterval(function() {
				if (e == 0) {
					if (typeof (f) == "function") {
						f(d)
					}
				}
				if (typeof c.tick == "function" && e >= 0) {
					c.tick(e)
				}
				e--
			}, 1000);
			return d
		}
	};
	b.fn.timer = function(c) {
		var c = b.extend({
			from : 720,
			tick : "",
			end : ""
		}, c);
		var f = b(this[0]), e = f.data("timer");
		if (e) {
			if (c.end == "") {
				c.end = e.opt.end
			}
			if (c.tick == "") {
				c.tick = e.opt.tick
			}
			clearTimeout(e.countdown);
			f.removeData("timer")
		}
		var d = a.start_timer(c, function(g) {
			clearTimeout(g);
			if (typeof c.end == "function") {
				c.end()
			}
		});
		f.data("timer", {
			target : f,
			opt : c,
			countdown : d
		})
	}
}(jQuery));
(function() {
	if (window.__twitterIntentHandler) {
		return
	}
	var a = /twitter\.com(\:\d{2,4})?\/intent\/(\w+)/, g = "scrollbars=yes,resizable=yes,toolbar=no,location=yes", b = 550, f = 260, d = screen.height, c = screen.width;
	function e(l) {
		l = l || window.event;
		var n = l.target || l.srcElement, h, k, j;
		while (n && n.nodeName.toLowerCase() !== "a") {
			n = n.parentNode
		}
		if (n && n.nodeName.toLowerCase() === "a" && n.href) {
			h = n.href.match(a);
			if (h) {
				k = Math.round((c / 2) - (b / 2));
				j = 0;
				if (d > f) {
					j = Math.round((d / 2) - (f / 2))
				}
				window.open(n.href, "intent", g + ",width=" + b + ",height="
						+ f + ",left=" + k + ",top=" + j);
				l.returnValue = false;
				l.preventDefault && l.preventDefault()
			}
		}
	}
	if (document.addEventListener) {
		document.addEventListener("click", e, false)
	} else {
		if (document.attachEvent) {
			document.attachEvent("onclick", e)
		}
	}
	window.__twitterIntentHandler = true
}());
Array.prototype.intersect = function() {
	if (!arguments.length) {
		return []
	}
	var e = this;
	var d = a2 = null;
	var h = 0;
	while (h < arguments.length) {
		d = [];
		a2 = arguments[h];
		var c = e.length;
		var b = a2.length;
		for ( var g = 0; g < c; g++) {
			for ( var f = 0; f < b; f++) {
				if (e[g] === a2[f]) {
					d.push(e[g])
				}
			}
		}
		e = d;
		h++
	}
	return d.unique()
};
Array.prototype.unique = function() {
	var c = [];
	var b = this.length;
	for ( var e = 0; e < b; e++) {
		for ( var d = e + 1; d < b; d++) {
			if (this[e] === this[d]) {
				d = ++e
			}
		}
		c.push(this[e])
	}
	return c
};
(function(a) {
	a.postalServiceCheck = function(d) {
		var c = " " + d.replace(",", " ") + " ", b = c
				.match(/\s+(PO|P\.O\.|P\. O\. Box|Post Office|APO|A\.P\.O\.|Army Post Office|Air Force Post Office|FPO|F\.P\.O\.|Fleet Post Office)\s+/gi);
		if (b && b.length > 0) {
			return true
		} else {
			return false
		}
	}
}(jQuery));
(function(a) {
	a.QueryString = (function(d) {
		if (d == "") {
			return {}
		}
		var c = {};
		for ( var e = 0; e < d.length; ++e) {
			var f = d[e].split("=");
			if (f.length != 2) {
				continue
			}
			c[f[0]] = decodeURIComponent(f[1].replace(/\+/g, " "))
		}
		return c
	})(window.location.search.substr(1).split("&"))
})(jQuery);
(function(b) {
	function a(e) {
		var d = e, c = Math.floor(d / 86400);
		return c == 0
				&& (d < 60 && "just now" || d < 120 && "1 minute ago"
						|| d < 3600 && Math.floor(d / 60) + " minutes ago"
						|| d < 7200 && "1 hour ago" || d < 86400
						&& Math.floor(d / 3600) + " hours ago") || c == 1
				&& "Yesterday" || c < 7 && c + " days ago" || c < 31
				&& Math.ceil(c / 7) + " weeks ago" || c > 31
				&& Math.ceil(c / 31) + " months ago"
	}
	b.fn.prettyDate = function() {
		return this.each(function() {
			var c = a(b(this).attr("title"));
			if (c) {
				b(this).text(c)
			}
		})
	}
})(jQuery);
var Mustache = function() {
	var a = function() {
	};
	a.prototype = {
		otag : "{{",
		ctag : "}}",
		pragmas : {},
		buffer : [],
		pragmas_implemented : {
			"IMPLICIT-ITERATOR" : true
		},
		context : {},
		render : function(b, e, d, f) {
			if (!f) {
				this.context = e;
				this.buffer = []
			}
			if (!this.includes("", b)) {
				if (f) {
					return b
				} else {
					this.send(b);
					return
				}
			}
			b = this.render_pragmas(b);
			var c = this.render_section(b, e, d);
			if (f) {
				return this.render_tags(c, e, d, f)
			}
			this.render_tags(c, e, d, f)
		},
		send : function(b) {
			if (b != "") {
				this.buffer.push(b)
			}
		},
		render_pragmas : function(b) {
			if (!this.includes("%", b)) {
				return b
			}
			var d = this;
			var c = new RegExp(this.otag + "%([\\w-]+) ?([\\w]+=[\\w]+)?"
					+ this.ctag);
			return b
					.replace(
							c,
							function(e, g, f) {
								if (!d.pragmas_implemented[g]) {
									throw ({
										message : "This implementation of mustache doesn't understand the '"
												+ g + "' pragma"
									})
								}
								d.pragmas[g] = {};
								if (f) {
									var h = f.split("=");
									d.pragmas[g][h[0]] = h[1]
								}
								return ""
							})
		},
		render_partial : function(b, d, c) {
			b = this.trim(b);
			if (!c || c[b] === undefined) {
				throw ({
					message : "unknown_partial '" + b + "'"
				})
			}
			if (typeof (d[b]) != "object") {
				return this.render(c[b], d, c, true)
			}
			return this.render(c[b], d[b], c, true)
		},
		render_section : function(b, d, c) {
			if (!this.includes("#", b) && !this.includes("^", b)) {
				return b
			}
			var f = this;
			var e = new RegExp(this.otag + "(\\^|\\#)\\s*(.+)\\s*" + this.ctag
					+ "\n*([\\s\\S]+?)" + this.otag + "\\/\\s*\\2\\s*"
					+ this.ctag + "\\s*", "mg");
			return b.replace(e,
					function(h, j, g, k) {
						var l = f.find(g, d);
						if (j == "^") {
							if (!l || f.is_array(l) && l.length === 0) {
								return f.render(k, d, c, true)
							} else {
								return ""
							}
						} else {
							if (j == "#") {
								if (f.is_array(l)) {
									return f.map(
											l,
											function(m) {
												return f.render(k, f
														.create_context(m), c,
														true)
											}).join("")
								} else {
									if (f.is_object(l)) {
										return f.render(k, f.create_context(l),
												c, true)
									} else {
										if (typeof l === "function") {
											return l.call(d, k, function(m) {
												return f.render(m, d, c, true)
											})
										} else {
											if (l) {
												return f.render(k, d, c, true)
											} else {
												return ""
											}
										}
									}
								}
							}
						}
					})
		},
		render_tags : function(j, b, d, f) {
			var e = this;
			var k = function() {
				return new RegExp(e.otag + "(=|!|>|\\{|%)?([^\\/#\\^]+?)\\1?"
						+ e.ctag + "+", "g")
			};
			var h = k();
			var g = function(n, o, m) {
				switch (o) {
				case "!":
					return "";
				case "=":
					e.set_delimiters(m);
					h = k();
					return "";
				case ">":
					return e.render_partial(m, b, d);
				case "{":
					return e.find(m, b);
				default:
					return e.escape(e.find(m, b))
				}
			};
			var l = j.split("\n");
			for ( var c = 0; c < l.length; c++) {
				l[c] = l[c].replace(h, g, this);
				if (!f) {
					this.send(l[c])
				}
			}
			if (f) {
				return l.join("\n")
			}
		},
		set_delimiters : function(c) {
			var b = c.split(" ");
			this.otag = this.escape_regex(b[0]);
			this.ctag = this.escape_regex(b[1])
		},
		escape_regex : function(c) {
			if (!arguments.callee.sRE) {
				var b = [ "/", ".", "*", "+", "?", "|", "(", ")", "[", "]",
						"{", "}", "\\" ];
				arguments.callee.sRE = new RegExp("(\\" + b.join("|\\") + ")",
						"g")
			}
			return c.replace(arguments.callee.sRE, "\\$1")
		},
		find : function(b, d) {
			b = this.trim(b);
			function c(f) {
				return f === false || f === 0 || f
			}
			var e;
			if (c(d[b])) {
				e = d[b]
			} else {
				if (c(this.context[b])) {
					e = this.context[b]
				}
			}
			if (typeof e === "function") {
				return e.apply(d)
			}
			if (e !== undefined) {
				return e
			}
			return ""
		},
		includes : function(c, b) {
			return b.indexOf(this.otag + c) != -1
		},
		escape : function(b) {
			b = String(b === null ? "" : b);
			return b.replace(/&(?!\w+;)|["'<>\\]/g, function(c) {
				switch (c) {
				case "&":
					return "&amp;";
				case "\\":
					return "\\\\";
				case '"':
					return "&quot;";
				case "'":
					return "&#39;";
				case "<":
					return "&lt;";
				case ">":
					return "&gt;";
				default:
					return c
				}
			})
		},
		create_context : function(d) {
			if (this.is_object(d)) {
				return d
			} else {
				var c = ".";
				if (this.pragmas["IMPLICIT-ITERATOR"]) {
					c = this.pragmas["IMPLICIT-ITERATOR"].iterator
				}
				var b = {};
				b[c] = d;
				return b
			}
		},
		is_object : function(b) {
			return b && typeof b == "object"
		},
		is_array : function(b) {
			return Object.prototype.toString.call(b) === "[object Array]"
		},
		trim : function(b) {
			return b.replace(/^\s*|\s*$/g, "")
		},
		map : function(f, d) {
			if (typeof f.map == "function") {
				return f.map(d)
			} else {
				var e = [];
				var b = f.length;
				for ( var c = 0; c < b; c++) {
					e.push(d(f[c]))
				}
				return e
			}
		}
	};
	return ({
		name : "mustache.js",
		version : "0.3.1-dev",
		to_html : function(d, c, e, f) {
			var b = new a();
			if (f) {
				b.send = f
			}
			b.render(d, c, e);
			if (!f) {
				return b.buffer.join("\n")
			}
		}
	})
}();
(function(b) {
	b.fn.autoComplete = function(k) {
		var g = {
			url : "",
			data : {},
			onStart : function() {
			},
			onEnd : function() {
			},
			onSelectItem : function(n, m) {
			},
			onEmptyItem : function(m) {
			},
			enableCache : true,
			template : "{{#items}}<li id='{{id}}'>{{permalink}}</li>{{/items}}",
			items : {
				key : "city",
				array : [ {
					id : 1,
					city : "Mumbai",
					permalink : "mumbai"
				}, {
					id : 2,
					city : "Pune",
					permalink : "pune"
				} ]
			},
			path : "data",
			resultContainer : "#" + b(this).attr("id") + "_result",
			delay : 300
		};
		if (k) {
			b.extend(g, k)
		}
		var h = this, e = b(h), d = b(g.resultContainer), c = null, f = g.path
				.split("->"), j = [];
		e.attr("autocomplete", "off");
		b(":not(div" + g.resultContainer + ")").click(function() {
			d.hide()
		});
		var l = function() {
			this.items = g.items, this.ritems = [], this.brequest = true
		};
		l.prototype.render = function() {
			var o = this, n = g.template, m = {
				items : o.ritems,
				ifitems : function() {
					if (o.ritems == 0) {
						return false
					} else {
						return true
					}
				}
			}, p = Mustache.to_html(n, m);
			d.html(p).show()
		};
		l.prototype.init = function() {
			var m = this, n = false;
			var o = function(q) {
				m.items = q;
				if (m.items != "") {
					for ( var p = 0; p < f.length; p++) {
						m.ritems = m.items[f[p]]
					}
					if (j.length == 0) {
						j.push({
							q : e.val(),
							r : q
						})
					} else {
						n = false;
						for ( var p = 0; p < j.length; p++) {
							if (e.val() == j[p].q) {
								n = true;
								break
							}
						}
						if (n == false) {
							j.push({
								q : e.val(),
								r : q
							})
						}
					}
					m.render();
					if (m.ritems == 0) {
						m.brequest = false;
						return
					}
					d.find("li:not(.ignore)").each(
							function(s, r) {
								r = b(r);
								r.mouseenter(function() {
									d.find("li.active:not(.ignore)")
											.removeClass("active");
									b(this).addClass("active")
								});
								r.click(function() {
									e.attr("value", r.text());
									if (typeof (g.onSelectItem) == "function") {
										g.onSelectItem(
												m.ritems[b(this).index()], e)
									}
									d.hide()
								})
							})
				} else {
					m.brequest = false
				}
			};
			e
					.keyup(function(u) {
						var q = ((typeof (u.charCode) == "undefined" || u.charCode === 0) ? u.keyCode
								: u.charCode), p = String.fromCharCode(q);
						if (q === 8) {
							m.brequest = true
						}
						if (q == 27) {
							d.hide()
						}
						if (q == 13) {
							var s = d.find("li.active:not(.ignore)");
							if (e.val() != "" && s.length == 0) {
								if (typeof (g.onEmptyItem) == "function") {
									g.onEmptyItem(e)
								}
								d.hide()
							}
							s.trigger("click")
						}
						if ((p.match(/[a-zA-Z0-9_\- ]/) || q === 8 || q === 46 || q === 91)
								&& (g.url === "" || m.brequest === true)) {
							clearTimeout(c);
							c = setTimeout(
									function() {
										if (e.val() != "") {
											if (typeof (g.onStart) == "function") {
												g.onStart()
											}
											if (j.length > 0 && g.enableCache) {
												for ( var v = 0; v < j.length; v++) {
													if (j[v].q == e.val()) {
														o(j[v].r);
														if (typeof (g.onEnd) == "function") {
															g.onEnd()
														}
														return
													}
												}
											}
											if (g.url === "") {
												o({
													err : null,
													data : a(e.val(), g.items)
												});
												if (typeof (g.onEnd) === "function") {
													g.onEnd(e)
												}
											} else {
												b
														.ajax({
															url : g.url,
															data : b
																	.extend(
																			g.data,
																			{
																				q : e
																						.val()
																			}),
															complete : function() {
																if (typeof (g.onEnd) === "function") {
																	g.onEnd()
																}
															},
															success : function(
																	w) {
																o(w)
															}
														})
											}
										}
									}, g.delay)
						}
						if (q == 38 || q == 40) {
							var r = d.find("li:not(.ignore)");
							if (d.find("li.active:not(.ignore)").length == 0) {
								if (q == 38) {
									b(r[r.length - 1]).addClass("active")
								} else {
									b(r[0]).addClass("active")
								}
							} else {
								var t = false;
								r.each(function(w, v) {
									v = b(v);
									if (!t && v.hasClass("active")) {
										v.removeClass("active");
										b(r[(q == 38 ? (w - 1) : (w + 1))])
												.addClass("active");
										t = true
									}
								})
							}
						}
						if (e.val() == "") {
							d.hide();
							m.brequest = true
						}
					})
		};
		return (function(m) {
			m.init()
		})(new l())
	};
	function a(l, e) {
		var m = [], k, o, n = e.constructor == Array;
		if (n) {
			k = e
		} else {
			k = e.array;
			o = e.key
		}
		for ( var d = 0, f = k.length; d < f; ++d) {
			var c = -1;
			var g = 1;
			while (g == 1 && ++c < l.length) {
				var h, p = l.toLowerCase();
				if (n) {
					h = k[d].toLowerCase()
				} else {
					h = k[d][o].toLowerCase()
				}
				if (h.charAt(c) != p.charAt(c)) {
					g = 0
				}
			}
			if (g == 1) {
				m[m.length] = k[d]
			}
		}
		return m
	}
})(jQuery);
(function(a) {
	a.fn.modal = function(b) {
		var c = {
			animation : "fadeAndPop",
			animationspeed : 600,
			closeonbackgroundclick : false,
			dismissmodalclass : "closeModal",
			modalSize : "medium",
			content : "",
			onOpen : function() {
			},
			onClose : function() {
			}
		};
		var b = a.extend({}, c, b);
		return this
				.each(function() {
					var o = a(this), k = a("#fabModalContent"), j = parseInt(o
							.css("top")), g = o.height() + j, h = false, l = a(".modal-bg");
					if (l.length == 0) {
						l = a('<div class="modal-bg" />').insertAfter(o)
					}
					d();
					var m = a("." + b.dismissmodalclass).bind(
							"click.modalEvent", e);
					if (b.closeonbackgroundclick) {
						l.css({
							cursor : "pointer"
						});
						l.bind("click.modalEvent", e)
					}
					function d() {
						k.html(b.content);
						l.unbind("click.modalEvent");
						o.attr("class", "modal").addClass(b.modalSize);
						a("." + b.dismissmodalclass).unbind("click.modalEvent");
						if (!h) {
							n();
							if (b.animation == "fadeAndPop") {
								o.css({
									top : a(document).scrollTop() - g,
									opacity : 0,
									visibility : "visible",
									marginLeft : -((o.width() / 2))
								});
								l.fadeIn(b.animationspeed / 2);
								o.delay(b.animationspeed / 2).animate({
									top : a(document).scrollTop() + j,
									opacity : 1
								}, b.animationspeed, f())
							}
							if (b.animation == "fade") {
								o.css({
									opacity : 0,
									visibility : "visible",
									top : a(document).scrollTop() + j
								});
								l.fadeIn(b.animationspeed / 2);
								o.delay(b.animationspeed / 2).animate({
									opacity : 1
								}, b.animationspeed, f())
							}
							if (b.animation == "none") {
								o.css({
									visibility : "visible",
									top : a(document).scrollTop() + j
								});
								l.css({
									display : "block"
								});
								f()
							}
						}
						b.onOpen.apply()
					}
					function e() {
						if (!h) {
							n();
							if (b.animation == "fadeAndPop") {
								l.delay(b.animationspeed).fadeOut(
										b.animationspeed);
								o.animate({
									top : a(document).scrollTop() - g,
									opacity : 0
								}, b.animationspeed / 2, function() {
									o.css({
										top : j,
										opacity : 1,
										visibility : "hidden"
									});
									f()
								})
							}
							if (b.animation == "fade") {
								l.delay(b.animationspeed).fadeOut(
										b.animationspeed);
								o.animate({
									opacity : 0
								}, b.animationspeed, function() {
									o.css({
										opacity : 1,
										visibility : "hidden",
										top : j
									});
									f()
								})
							}
							if (b.animation == "none") {
								o.css({
									visibility : "hidden",
									top : j
								});
								l.css({
									display : "none"
								})
							}
						}
						b.onClose.apply()
					}
					function f() {
						h = false
					}
					function n() {
						h = true
					}
				})
	}
})(jQuery);
/*
 * ! NETEYE Activity Indicator jQuery Plugin
 * 
 * Copyright (c) 2010 NETEYE GmbH Licensed under the MIT license
 * 
 * Author: Felix Gnass [fgnass at neteye dot de] Version: 1.0.0
 */
(function(f) {
	f.fn.activity = function(h) {
		this.each(function() {
			var n = f(this);
			var m = n.data("activity");
			if (m) {
				clearInterval(m.data("interval"));
				m.remove();
				n.removeData("activity")
			}
			if (h !== false) {
				h = f.extend({
					color : n.css("color")
				}, f.fn.activity.defaults, h);
				m = b(n, h).css("position", "absolute").prependTo(
						h.outside ? "body" : n);
				var l = n.outerHeight() - m.height();
				var k = n.outerWidth() - m.width();
				var j = {
					top : h.valign == "top" ? h.padding
							: h.valign == "bottom" ? l - h.padding : Math
									.floor(l / 2),
					left : h.align == "left" ? h.padding
							: h.align == "right" ? k - h.padding : Math
									.floor(k / 2)
				};
				var o = n.offset();
				if (h.outside) {
					m.css({
						top : o.top + "px",
						left : o.left + "px"
					})
				} else {
					j.top -= m.offset().top - o.top;
					j.left -= m.offset().left - o.left
				}
				m.css({
					marginTop : j.top + "px",
					marginLeft : j.left + "px"
				});
				e(m, h.segments, Math.round(10 / h.speed) / 10);
				n.data("activity", m)
			}
		});
		return this
	};
	f.fn.activity.defaults = {
		segments : 8,
		steps : 3,
		opacity : 0.3,
		space : 0,
		length : 5,
		width : 4,
		speed : 1.5,
		align : "center",
		valign : "center",
		padding : 4,
		color : "#0b0b0b"
	};
	f.fn.activity.getOpacity = function(l, k) {
		var j = l.steps || l.segments - 1;
		var h = l.opacity !== undefined ? l.opacity : 1 / j;
		return 1 - Math.min(k, j) * (1 - h) / j
	};
	var b = function() {
		return f("<div>").addClass("busy")
	};
	var e = function() {
	};
	function a(j, h) {
		var k = document.createElementNS("http://www.w3.org/2000/svg", j
				|| "svg");
		if (h) {
			f.each(h, function(m, l) {
				k.setAttributeNS(null, m, l)
			})
		}
		return f(k)
	}
	if (document.createElementNS
			&& document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect) {
		b = function(o, m) {
			var n = m.width * 2 + m.space;
			var l = (n + m.length + Math.ceil(m.width / 2) + 1);
			var j = a().width(l * 2).height(l * 2);
			var k = a("g", {
				"stroke-width" : m.width,
				"stroke-linecap" : "round",
				stroke : m.color
			}).appendTo(a("g", {
				transform : "translate(" + l + "," + l + ")"
			}).appendTo(j));
			for ( var h = 0; h < m.segments; h++) {
				k.append(a("line", {
					x1 : 0,
					y1 : n,
					x2 : 0,
					y2 : n + m.length,
					transform : "rotate(" + (360 / m.segments * h) + ", 0, 0)",
					opacity : f.fn.activity.getOpacity(m, h)
				}))
			}
			return f("<div>").append(j).width(2 * l).height(2 * l)
		};
		if (document.createElement("div").style.WebkitAnimationName !== undefined) {
			var g = {};
			e = function(j, m, k) {
				if (!g[m]) {
					var h = "spin" + m;
					var n = "@-webkit-keyframes " + h + " {";
					for ( var l = 0; l < m; l++) {
						var q = Math.round(100000 / m * l) / 1000;
						var p = Math.round(100000 / m * (l + 1) - 1) / 1000;
						var o = "% { -webkit-transform:rotate("
								+ Math.round(360 / m * l) + "deg); }\n";
						n += q + o + p + o
					}
					n += "100% { -webkit-transform:rotate(100deg); }\n}";
					document.styleSheets[0].insertRule(n);
					g[m] = h
				}
				j
						.css("-webkit-animation", g[m] + " " + k
								+ "s linear infinite")
			}
		} else {
			e = function(k, h, m) {
				var j = 0;
				var l = k.find("g g").get(0);
				k.data("interval", setInterval(function() {
					l.setAttributeNS(null, "transform", "rotate("
							+ (++j % h * (360 / h)) + ")")
				}, m * 1000 / h))
			}
		}
	} else {
		var d = f("<shape>").css("behavior", "url(#default#VML)").appendTo(
				"body");
		if (d.get(0).adj) {
			var c = document.createStyleSheet();
			f.each([ "group", "shape", "stroke" ], function() {
				c.addRule(this, "behavior:url(#default#VML);")
			});
			b = function(q, n) {
				var p = n.width * 2 + n.space;
				var l = (p + n.length + Math.ceil(n.width / 2) + 1);
				var k = l * 2;
				var m = -Math.ceil(k / 2);
				var j = f("<group>", {
					coordsize : k + " " + k,
					coordorigin : m + " " + m
				}).css({
					top : m,
					left : m,
					width : k,
					height : k
				});
				for ( var h = 0; h < n.segments; h++) {
					j.append(f("<shape>", {
						path : "m " + p + ",0  l " + (p + n.length) + ",0"
					}).css({
						width : k,
						height : k,
						rotation : (360 / n.segments * h) + "deg"
					}).append(f("<stroke>", {
						color : n.color,
						weight : n.width + "px",
						endcap : "round",
						opacity : f.fn.activity.getOpacity(n, h)
					})))
				}
				return f("<group>", {
					coordsize : k + " " + k
				}).css({
					width : k,
					height : k,
					overflow : "hidden"
				}).append(j)
			};
			e = function(k, h, m) {
				var j = 0;
				var l = k.get(0);
				k.data("interval", setInterval(function() {
					l.style.rotation = ++j % h * (360 / h)
				}, m * 1000 / h))
			}
		}
		f(d).remove()
	}
})(jQuery);
var FabModule = (function() {
	var b = function(e) {
		this.params = e || {}
	};
	var d = {
		admin : "FabAdminBase",
		IBase : "InspirationBase",
		invite : "InviteBase",
		auth : "AccountBase",
		sales : "SalesBase",
		supplier : "SupplierBase",
		cart : "CartBase",
		liveFeed : "LiveFeedBase"
	};
	for ( var c in d) {
		if (!d.hasOwnProperty(c)) {
			continue
		}
		var a = d[c];
		b.prototype[c] = (function(e) {
			var f = "";
			return function(g) {
				if (f == "") {
					if (typeof (this) != "object") {
						f = null;
						return f
					}
					f = new b[e](g, this);
					if (typeof (f.init) == "function") {
						f.init()
					}
				}
				return f
			}
		}(a))
	}
	$.switchDefTxt();
	if (window.opera && typeof (window.opera) === "object") {
		$("body").addClass("operaBrowser")
	}
	return b
})();
var FabModule = (function(FabModule) {
	FabModule.AccountBase = function(params, base) {
		this.fabBase = base;
		this.params = params || {}
	};
	FabModule.AccountBase
			.method(
					"init",
					function() {
						var self = this, lgnContentEle = $("#loginLBContent");
						createPass = $("#createPassLB");
						$("img[name='seal']").attr("height", "57");
						$("#btNvsIconsP").show();
						self.modalBindings();
						self.floatingHeader();
						var modal_pass = $("#fabModal")
								.hasClass("createPassLB");
						if (self.params.accId > 0) {
							self.fbTimeLineFlyDown()
						}
						if ($("#splOfferLink").length > 0) {
							var hm_pg_params = $("#splOfferLink").attr(
									"data-params");
							self.homePageFlyDown(hm_pg_params);
							if ($.cookie("soa") == null) {
								$.cookie("soa", 1, {
									expires : 1,
									path : "/"
								});
								$("#splOfferLink").trigger("click")
							}
						}
						$("body").click(
								function(e) {
									$("#userSettingOpt")
											.removeClass("selected").find(
													".userMenuD").hide()
								});
						$("#userSettingOpt > a").click(function(e) {
							var parent = $(this).parent();
							parent.toggleClass("selected");
							parent.find("div.userMenuD").toggle();
							e.preventDefault();
							e.stopPropagation()
						});
						self.loginContent = lgnContentEle.html();
						lgnContentEle.empty();
						self.createPassContent = createPass.html();
						createPass.empty();
						if (self.params.accId == 0) {
							$("#uLgnBtn").click(function() {
								self.lgnLightBox()
							});
							$(".showLoginBox").click(function() {
								self.lgnLightBox()
							})
						} else {
							if ($("#sCart").length > 0) {
								self.get_fly_cart()
							}
						}
						$("#uSupBtn").click(function() {
						});
						$(".showLoginBox").click(function() {
						});
						if (self.params.accId == 0) {
							$("#fabGerSelected").click(function() {
								if ($("#rememberUSAGerChoice").is(":checked")) {
									$.cookie("rcs", 1, {
										expires : 3650,
										path : "/"
									})
								}
								window.location = "https://fab.de"
							});
							$("#fabUSASelected").click(function() {
								if ($("#rememberUSAGerChoice").is(":checked")) {
									$.cookie("rcs", 1, {
										expires : 3650,
										path : "/"
									})
								}
								$("#EuroVisitor").addClass("hide");
								$("#LoginScreen").removeClass("hide")
							});
							$(".one").click(function() {
								if ($(".twoWrap").hasClass("active")) {
									$(".twoWrap").hide()
								}
								if ($(".twoWrap")[0].style.display == "block") {
									$(".twoWrap").hide()
								}
								$(".oneWrap").toggle().toggleClass("active")
							});
							$("body")
									.click(
											function(e) {
												if (!$(e.target)
														.hasClass(
																"signUpPageQuestionMarkTip")
														&& !$(e.target)
																.hasClass(
																		"spanremindfriend")
														&& !$(e.target)
																.hasClass(
																		"signUpPageQuestionInfo")
														&& !$(e.target)
																.parent()
																.hasClass(
																		"signUpPageQuestionInfo")) {
													if ($(".oneWrap")[0].style.display == "block") {
														$(".oneWrap").hide()
													}
													if ($(".twoWrap")[0].style.display == "block") {
														$(".twoWrap").hide()
													}
												}
											});
							$(".signUpPageQuestionMarkTip.one")
									.mouseover(
											function() {
												$(
														".signUpPageQuestionMarkTip.one .spanremindfriend")
														.css("color", "#dd0017")
											});
							$(".signUpPageQuestionMarkTip.one")
									.mouseout(
											function() {
												$(
														".signUpPageQuestionMarkTip.one .spanremindfriend")
														.css("color", "black")
											});
							$(".signUpPageQuestionMarkTip.two")
									.mouseover(
											function() {
												$(
														".signUpPageQuestionMarkTip.two .spanremindfriend")
														.css("color", "#dd0017")
											});
							$(".signUpPageQuestionMarkTip.two")
									.mouseout(
											function() {
												$(
														".signUpPageQuestionMarkTip.two .spanremindfriend")
														.css("color", "black")
											});
							$(".two").click(function() {
								if ($(".oneWrap").hasClass("active")) {
									$(".oneWrap").hide()
								}
								if ($(".oneWrap")[0].style.display == "block") {
									$(".oneWrap").hide()
								}
								$(".twoWrap").toggle().toggleClass("active")
							});
							$(".notjoi").click(function() {
								$(".signUpPageQuestionInfo").hide()
							})
						}
						switch (self.fabBase.params.pg) {
						case "web_sale_index":
							self.featchImageForShops();
							break;
						case "web_user_welcome":
							var longHeight = $("#contentLeftUpSale").height();
							$(".paContentLeftSml").height(longHeight);
							break;
						case "web_user_settings":
							self.onLoadRequired();
							self.saveChangedUsername();
							self.resetPassword();
							self.saveChangedEmail();
							self.setPrimaryShippingAddress();
							$("#deactivateAccount").click(function() {
								self.deactivate_ac_LB()
							});
							break;
						case "web_user_my_email_preferences":
							self.emailPrefPreview();
							$("#onOffDailySettingBtn")
									.click(
											function(e) {
												var userSettingVal = $(this)
														.attr("data-modal-name") == 1 ? 0
														: 1, that = this;
												$(this).attr("data-modal-name",
														userSettingVal);
												var $btn = $(
														"#onOffDailySettingBtn .onOffsliderButton",
														this.el);
												$btn.activity({
													width : 1
												});
												var that = this;
												$btn
														.animate(
																{
																	left : userSettingVal == 0 ? 0
																			: 35
																},
																200,
																function() {
																	if (userSettingVal == 0) {
																		$(
																				"#onOffDailySettingBtn")
																				.addClass(
																						"subGblActive");
																		$(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.removeAttr(
																						"checked",
																						"checked")
																				.attr(
																						"disabled",
																						"true");
																		var changeClass = $(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.next()
																				.hasClass(
																						"bellIconDGray");
																		$(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.parent()
																				.parent()
																				.removeClass(
																						"selected");
																		if (changeClass == true) {
																			$(
																					".dailySalesOptRight")
																					.find(
																							"span.bellIconDGray")
																					.removeClass(
																							"bellIconDGray")
																					.addClass(
																							"bellIconLGray")
																		}
																	} else {
																		$(
																				"#onOffDailySettingBtn")
																				.removeClass(
																						"subGblActive");
																		if ($(
																				"#onOffsubBtn .switchText")
																				.text() == "NO") {
																			$(
																					"#onOffsubBtn")
																					.removeClass(
																							"gblActive");
																			$(
																					"#onOffsubBtn")
																					.trigger(
																							"click")
																		}
																		var changeDClass = $(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.next()
																				.hasClass(
																						"bellIconLGray");
																		$(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.parent()
																				.parent()
																				.addClass(
																						"selected");
																		$(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.attr(
																						"checked",
																						"checked");
																		if (changeDClass == true) {
																			$(
																					".dailySalesOptRight")
																					.find(
																							"span.bellIconLGray")
																					.removeClass(
																							"bellIconLGray")
																					.addClass(
																							"bellIconDGray")
																		}
																		$(
																				".dailySalesOptRight")
																				.find(
																						":input")
																				.removeAttr(
																						"disabled")
																	}
																	$btn
																			.css(
																					"left",
																					0);
																	$btn
																			.activity(false);
																	$(that)
																			.toggleClass(
																					"onButton");
																	$(that)
																			.toggleClass(
																					"offButton");
																	if (userSettingVal) {
																		$(
																				"#onOffDailySettingBtn .switchText",
																				that.el)
																				.html(
																						"ON")
																	} else {
																		$(
																				"#onOffDailySettingBtn .switchText",
																				that.el)
																				.html(
																						"OFF")
																	}
																})
											});
							$("#onOffWeeklySettingBtn")
									.click(
											function(e) {
												var userSettingVal = $(this)
														.attr("data-modal-name") == 1 ? 0
														: 1, that = this, vLIcon = $(
														".weeklySalesOptRight")
														.find(":input").next()
														.hasClass(
																"vintageDIcon"), fLIcon = $(
														".weeklySalesOptRight")
														.find(":input").next()
														.hasClass(
																"fashionDIcon"), foodLIcon = $(
														".weeklySalesOptRight")
														.find(":input").next()
														.hasClass("foodDIcon"), KLIcon = $(
														".weeklySalesOptRight")
														.find(":input").next()
														.hasClass("kidsDIcon"), PLIcon = $(
														".weeklySalesOptRight")
														.find(":input").next()
														.hasClass("petsDIcon");
												$(this).attr("data-modal-name",
														userSettingVal);
												var $btn = $(
														"#onOffWeeklySettingBtn .onOffsliderButton",
														this.el);
												$btn.activity({
													width : 1
												});
												var that = this;
												$btn
														.animate(
																{
																	left : userSettingVal == 0 ? 0
																			: 35
																},
																200,
																function() {
																	if (userSettingVal == 0) {
																		$(
																				".weeklySalesOptRight")
																				.find(
																						":input")
																				.parent()
																				.parent()
																				.removeClass(
																						"selected");
																		$(
																				".weeklySalesOptRight")
																				.find(
																						":input")
																				.removeAttr(
																						"checked",
																						"checked")
																				.attr(
																						"disabled",
																						"true");
																		if (vLIcon == true) {
																			$(
																					".weeklySalesOptRight")
																					.find(
																							"span.vintageDIcon")
																					.removeClass(
																							"vintageDIcon")
																					.addClass(
																							"vintageLIcon")
																		}
																		if (fLIcon == true) {
																			$(
																					".weeklySalesOptRight")
																					.find(
																							"span.fashionDIcon")
																					.removeClass(
																							"fashionDIcon")
																					.addClass(
																							"fashionLIcon")
																		}
																		if (foodLIcon == true) {
																			$(
																					".weeklySalesOptRight")
																					.find(
																							"span.foodDIcon")
																					.removeClass(
																							"foodDIcon")
																					.addClass(
																							"foodLIcon")
																		}
																		if (KLIcon == true) {
																			$(
																					".weeklySalesOptRight")
																					.find(
																							"span.kidsDIcon")
																					.removeClass(
																							"kidsDIcon")
																					.addClass(
																							"kidsLIcon")
																		}
																		if (PLIcon == true) {
																			$(
																					".weeklySalesOptRight")
																					.find(
																							"span.petsDIcon")
																					.removeClass(
																							"petsDIcon")
																					.addClass(
																							"petsLIcon")
																		}
																	} else {
																		if ($(
																				"#onOffsubBtn .switchText")
																				.text() == "NO") {
																			$(
																					"#onOffsubBtn")
																					.removeClass(
																							"gblActive");
																			$(
																					"#onOffsubBtn")
																					.trigger(
																							"click")
																		}
																		$(
																				".weeklySalesOptRight")
																				.find(
																						":input")
																				.parent()
																				.parent()
																				.addClass(
																						"selected");
																		$(
																				".weeklySalesOptRight")
																				.find(
																						":input")
																				.removeAttr(
																						"disabled");
																		$(
																				".weeklySalesOptRight")
																				.find(
																						":input")
																				.attr(
																						"checked",
																						"checked")
																	}
																	$btn
																			.css(
																					"left",
																					0);
																	$btn
																			.activity(false);
																	$(that)
																			.toggleClass(
																					"onButton");
																	$(that)
																			.toggleClass(
																					"offButton");
																	if (userSettingVal) {
																		$(
																				"#onOffWeeklySettingBtn .switchText",
																				that.el)
																				.html(
																						"ON")
																	} else {
																		$(
																				"#onOffWeeklySettingBtn .switchText",
																				that.el)
																				.html(
																						"OFF")
																	}
																})
											});
							$("#onOffWeeklyMailPreview")
									.click(
											function(e) {
												var userSettingVal = $(this)
														.attr("data-modal-name") == 1 ? 0
														: 1, that = this;
												$(this).attr("data-modal-name",
														userSettingVal);
												var $btn = $(
														"#onOffWeeklyMailPreview .onOffsliderButton",
														this.el);
												$btn.activity({
													width : 1
												});
												var that = this;
												$btn
														.animate(
																{
																	left : userSettingVal == 0 ? 0
																			: 35
																},
																200,
																function() {
																	if (userSettingVal == 0) {
																	} else {
																		if ($(
																				"#onOffsubBtn .switchText")
																				.text() == "NO") {
																			$(
																					"#onOffsubBtn")
																					.removeClass(
																							"gblActive");
																			$(
																					"#onOffsubBtn")
																					.trigger(
																							"click")
																		}
																	}
																	$btn
																			.css(
																					"left",
																					0);
																	$btn
																			.activity(false);
																	$(that)
																			.toggleClass(
																					"onButton");
																	$(that)
																			.toggleClass(
																					"offButton");
																	if (userSettingVal) {
																		$(
																				"#onOffWeeklyMailPreview .switchText",
																				that.el)
																				.html(
																						"ON")
																	} else {
																		$(
																				"#onOffWeeklyMailPreview .switchText",
																				that.el)
																				.html(
																						"OFF")
																	}
																})
											});
							$("#onOffinviteBtn")
									.click(
											function(e) {
												var userSettingVal = $(this)
														.attr("data-modal-name") == 1 ? 0
														: 1, that = this;
												$(this).attr("data-modal-name",
														userSettingVal);
												var $btn = $(
														"#onOffinviteBtn .onOffsliderButton",
														this.el);
												$btn.activity({
													width : 1
												});
												var that = this;
												$btn
														.animate(
																{
																	left : userSettingVal == 0 ? 0
																			: 35
																},
																200,
																function() {
																	if (userSettingVal == 0) {
																	} else {
																		if ($(
																				"#onOffsubBtn .switchText")
																				.text() == "NO") {
																			$(
																					"#onOffsubBtn")
																					.removeClass(
																							"gblActive");
																			$(
																					"#onOffsubBtn")
																					.trigger(
																							"click")
																		}
																	}
																	$btn
																			.css(
																					"left",
																					0);
																	$btn
																			.activity(false);
																	$(that)
																			.toggleClass(
																					"onButton");
																	$(that)
																			.toggleClass(
																					"offButton");
																	if (userSettingVal) {
																		$(
																				"#onOffinviteBtn .switchText",
																				that.el)
																				.html(
																						"YES")
																	} else {
																		$(
																				"#onOffinviteBtn .switchText",
																				that.el)
																				.html(
																						"NO")
																	}
																})
											});
							$("#every_time_my_order_status").click(
									function(e) {
										if ($("#onOffsubBtn .switchText")
												.text() == "NO") {
											$("#onOffsubBtn").removeClass(
													"gblActive");
											$("#onOffsubBtn").trigger("click")
										}
									});
							$("#onOffsubBtn")
									.click(
											function(e) {
												var userSettingVal = $(this)
														.attr("data-modal-name") == 0 ? 1
														: 0, that = this;
												$(this).attr("data-modal-name",
														userSettingVal);
												var $btn = $(
														"#onOffsubBtn .onOffsliderButton",
														this.el);
												$btn.activity({
													width : 1
												});
												var that = this;
												$btn
														.animate(
																{
																	left : userSettingVal == 0 ? 35
																			: 0
																},
																200,
																function() {
																	if (userSettingVal == 1) {
																		$(
																				"div.newSubsMails")
																				.addClass(
																						"unSubscribeIcon");
																		$(
																				"#switchTextSUB")
																				.html(
																						"You are unsubscribed");
																		$(
																				"#switchMainTextSUB")
																				.html(
																						"You have opted to unsubscribe from Fab communication mailers. In order to apply this, please click on the 'Save Changes' button.");
																		var $insp_img_fab_e_pref_off = $("#insp_img_fab_e_pref_off"), $insp_img_comment_e_pref_off = $("#insp_img_comment_e_pref_off"), $insp_img_comment_i_commented_e_pref_off = $("#insp_img_comment_i_commented_e_pref_off"), $insp_img_tag_e_pref_off = $("#insp_img_tag_e_pref_off");
																		$(
																				"#insp_img_fab_e_pref_off,#insp_img_comment_e_pref_off,#insp_img_comment_i_commented_e_pref_off,#insp_img_tag_e_pref_off")
																				.attr(
																						"checked",
																						"checked");
																		if ($(
																				"#onOffDailySettingBtn .switchText")
																				.text() == "ON") {
																			$(
																					"#onOffDailySettingBtn")
																					.trigger(
																							"click")
																		}
																		if ($(
																				"#onOffWeeklySettingBtn .switchText")
																				.text() == "ON") {
																			$(
																					"#onOffWeeklySettingBtn")
																					.trigger(
																							"click")
																		}
																		if ($(
																				"#onOffWeeklyMailPreview .switchText")
																				.text() == "ON") {
																			$(
																					"#onOffWeeklyMailPreview")
																					.trigger(
																							"click")
																		}
																		if ($(
																				"#onOffinviteBtn .switchText")
																				.text() == "YES") {
																			$(
																					"#onOffinviteBtn")
																					.trigger(
																							"click")
																		}
																		$(
																				"#every_time_my_order_status")
																				.prop(
																						"checked",
																						false)
																	} else {
																		$(
																				"#switchTextSUB")
																				.html(
																						"You are subscribed");
																		$(
																				"#switchMainTextSUB")
																				.html(
																						"Do you want to keep receiving Fab.com's email?");
																		$(
																				"div.newSubsMails")
																				.removeClass(
																						"unSubscribeIcon");
																		var globalActiveOn = $(
																				"#onOffsubBtn")
																				.hasClass(
																						"gblActive");
																		if (globalActiveOn == true) {
																			if ($(
																					"#onOffDailySettingBtn .switchText")
																					.text() == "OFF") {
																				$(
																						"#onOffDailySettingBtn")
																						.trigger(
																								"click")
																			}
																			if ($(
																					"#onOffWeeklySettingBtn .switchText")
																					.text() == "OFF") {
																				$(
																						"#onOffWeeklySettingBtn")
																						.trigger(
																								"click")
																			}
																			if ($(
																					"#onOffWeeklyMailPreview .switchText")
																					.text() == "OFF") {
																				$(
																						"#onOffWeeklyMailPreview")
																						.trigger(
																								"click")
																			}
																			if ($(
																					"#onOffinviteBtn .switchText")
																					.text() == "NO") {
																				$(
																						"#onOffinviteBtn")
																						.trigger(
																								"click")
																			}
																			$(
																					"#emailPositivePrefOn,#emailPositivePrefCOn,#emailPositivePrefEOn,#emailPositivePrefEEPOn,#every_time_my_order_status")
																					.attr(
																							"checked",
																							"checked")
																		}
																		$(
																				"#onOffsubBtn")
																				.addClass(
																						"gblActive")
																	}
																	$btn
																			.css(
																					"left",
																					0);
																	$btn
																			.activity(false);
																	$(that)
																			.toggleClass(
																					"onButton");
																	$(that)
																			.toggleClass(
																					"offButton");
																	if (userSettingVal) {
																		$(
																				"#onOffsubBtn .switchText",
																				that.el)
																				.html(
																						"NO")
																	} else {
																		$(
																				"#onOffsubBtn .switchText",
																				that.el)
																				.html(
																						"YES")
																	}
																})
											});
							$(".dailySalesOptRight")
									.find(":input")
									.each(
											function() {
												$(this)
														.click(
																function() {
																	var unchecked = $(
																			this)
																			.parent()
																			.parent()
																			.parent()
																			.find(
																					".emailPrefCheckBox")
																			.is(
																					":checked");
																	if ($(this)
																			.parent()
																			.parent()
																			.hasClass(
																					"selected")) {
																		$(this)
																				.parent()
																				.parent()
																				.removeClass(
																						"selected");
																		if (unchecked == false) {
																			if ($(
																					"#onOffDailySettingBtn .switchText")
																					.text() == "ON") {
																				$(
																						"#onOffDailySettingBtn")
																						.trigger(
																								"click")
																			}
																		}
																	} else {
																		$(this)
																				.parent()
																				.parent()
																				.toggleClass(
																						"selected");
																		$(this)
																				.removeClass(
																						"unchecked")
																	}
																})
											});
							$(".weeklySalesOptRight")
									.find(":input")
									.each(
											function() {
												$(this)
														.click(
																function() {
																	var unchecked = $(
																			this)
																			.parent()
																			.parent()
																			.parent()
																			.find(
																					".emailPrefCheckBox")
																			.is(
																					":checked");
																	$(this)
																			.parent()
																			.parent()
																			.toggleClass(
																					"selected");
																	if (unchecked == false) {
																		if ($(
																				"#onOffWeeklySettingBtn .switchText")
																				.text() == "ON") {
																			$(
																					"#onOffWeeklySettingBtn")
																					.trigger(
																							"click")
																		}
																	}
																})
											});
							$(".emailPositivePref").click(
									function() {
										if ($("#onOffsubBtn .switchText")
												.text() == "NO") {
											$("#onOffsubBtn").removeClass(
													"gblActive");
											$("#onOffsubBtn").trigger("click")
										}
									});
							self.onEmailPrefLoadRequired();
							self.params.emailPrefs = [
									$("#onOffDailySettingBtn").attr(
											"data-modal-name"),
									$("#onOffWeeklyMailPreview").attr(
											"data-modal-name"),
									$("input:checkbox[id=custom_sale_email_freq_1]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_2]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_3]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_4]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_5]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_6]:checked"),
									$("input:checkbox[id=custom_sale_email_freq_7]:checked"),
									$("#onOffWeeklySettingBtn").attr(
											"data-modal-name"),
									$("input:checkbox[id=weekly_shop_email_freq_1]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_2]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_3]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_4]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_5]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_6]:checked"),
									$("input:checkbox[id=weekly_shop_email_freq_7]:checked"),
									$("#onOffinviteBtn")
											.attr("data-modal-name"),
									$("input:radio[name=insp_img_fab_e_pref]:checked"),
									$("input:radio[name=insp_img_tag_e_pref]:checked"),
									$("input:radio[name=insp_img_comment_e_pref]:checked"),
									$("input:radio[name=insp_img_comment_i_commented_e_pref]:checked") ];
							self.submitEmailSettings();
							break;
						case "web_user_my_payment_methods":
							self.showHideForms();
							self.setPrimaryBillingAddress();
							break;
						case "web_user_my_account_credits":
							$(".fadeOutEffect").animate({
								backgroundColor : "white"
							}, 8000);
							break;
						case "web_user_index":
							$(function() {
								$("#requestInvite")
										.click(
												function() {
													$(this).hide();
													$("#uLgnButton").parent()
															.show();
													$(
															"#loginWrap, #forgotPWBlock, #errBar")
															.hide();
													$("#invSignUpWrap, #aMWrap")
															.show();
													$("#inviteMsg").css(
															"height", "275px");
													$("#inviteForm ").css(
															"height", "275px");
													$("#userId")
															.val(
																	"Email address or username");
													$("#password").val("")
												});
								$("#forgotPW").click(function(e) {
									$(this).hide();
									$("#forgotPWBlock").show();
									$("#inviteMsg").css("height", "395px");
									$("#inviteForm").css("height", "395px");
									$("#resetPWEmail").val("Email address");
									$("#errBar").hide()
								});
								$("#reLogin")
										.click(
												function(e) {
													$("#uLgnButton").parent()
															.hide();
													$(
															"#aMWrap, #invSignUpWrap, #errBar")
															.hide();
													$(
															"#loginWrap, #forgotPW, #requestInvite")
															.show();
													$("#inviteMsg").height(
															$("#inviteForm")
																	.height())
												});
								$("#requestInvite").click(function(e) {
									$("#user_email").val("Email address")
								});
								$("#msgLogin")
										.click(
												function(e) {
													$("#uLgnButton").parent()
															.hide();
													$(
															"#aMWrap, #invSignUpWrap, #errBar")
															.hide();
													$(
															"#loginWrap, #forgotPW, #requestInvite")
															.show()
												});
								$("#uSignup")
										.submit(
												function(e) {
													var useremail = $.trim($(
															"#user_email")
															.val());
													if (useremail == ""
															|| useremail == "Email address") {
														fabMsgHandler(
																"errBar",
																"error",
																"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Please enter a email address.");
														return false;
														$("#aMWrap").show()
													} else {
														return true
													}
												});
								$("#uLgnButton")
										.click(
												function() {
													$("#uLgnButton").parent()
															.hide();
													$(
															"#aMWrap, #invSignUpWrap, #errBar")
															.hide();
													$(
															"#loginWrap, #forgotPW, #requestInvite")
															.show();
													$("#inviteMsg").height(
															$("#inviteForm")
																	.height())
												});
								$("#resetPWForm").submit(function(event) {
									event.preventDefault();
									self.requestPWResetLink();
									return false
								})
							});
							$("#uLogin")
									.submit(
											function() {
												$("#forgotPWBlock").hide();
												$("#forgotPW").show();
												$("#inviteMsg").css("height",
														"275px");
												$("#inviteForm ").css("height",
														"275px");
												var pass_val = $("#password")
														.val(), user_val = $
														.trim($("#userId")
																.val());
												if (pass_val == ""
														|| (user_val == "" || user_val == "Email address or username")) {
													fabMsgHandler(
															"errBar",
															"error",
															"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Username & Password required.");
													return false
												} else {
													return true
												}
											});
							$("#reLoginFrmCrtPass")
									.submit(
											function() {
												var errMsg = "", pass_val = $(
														"#password").val(), cpass_val = $(
														"#cPassword").val();
												if (pass_val == ""
														&& cpass_val == "") {
													errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Password can not be blank."
												} else {
													if (pass_val != cpass_val) {
														errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Passwords do not match."
													} else {
														if (!$("#accecptTerms")
																.is(":checked")) {
															errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Please accept the Terms Of Use and Privacy Statement."
														}
													}
												}
												if (errMsg != "") {
													$("#errBar").show();
													$("#createPassErr").html(
															errMsg).show();
													return false
												} else {
													return true
												}
											});
							$("#reLoginFrm")
									.submit(
											function() {
												if ($("#password").val() == "") {
													$("#errBar").show();
													$("#createPassErr")
															.html(
																	"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Password cannot be blank.")
															.show();
													return false
												} else {
													return true
												}
											});
							$.switchDefTxt();
							break;
						case "web_cart_cart_index":
							if (self.params.reserve_time > 0) {
								self.fabTimer(self.params.reserve_time)
							}
							break;
						case "web_inspiration_inspiration_images_show":
							if (self.params.accId == 0) {
								$("#favInspImg").click(function() {
									$("#uLgnBtn").trigger("click")
								});
								$("#add_new_tag").focus(function() {
									$("#uLgnBtn").trigger("click")
								})
							}
							break;
						case "web_user_my_order":
							$("html").smoothScroll();
							var order_id;
							$(".orderTimer").each(function(index) {
								start_time = $(this).text();
								var hrs = Math.floor(start_time / 60);
								var mins = (start_time % 60);
								if (hrs < 10) {
									hrs = "0" + hrs
								}
								if (mins < 10) {
									mins = "0" + mins
								}
								$(this).text(hrs + ":" + mins);
								self.hourTimer(start_time, $(this).attr("id"))
							});
							$(".change_shipping").each(function(index) {
								var id = $(this).attr("id");
								id = id.replace("addr_", "");
								var order = id.replace("change_shipping_", "");
								$("#" + id).click(function() {
									self.listShipBillInfo("ship", order)
								})
							});
							$(".hoverElmnt").each(function(index) {
								var id = $(this).attr("id");
								var order = id.replace("shipping_", "");
								$("#" + id).click(function() {
									self.listShipBillInfo("ship", order)
								})
							});
							$(".cancel_order")
									.each(
											function(index) {
												$(this)
														.click(
																function() {
																	self
																			.cancelOrderProduct(
																					$(
																							this)
																							.attr(
																									"order"),
																					$(
																							this)
																							.attr(
																									"order_product"))
																})
											});
							$("a[id=resolveOrder]").click(function() {
								order_id = parseInt(this.name.substring(12));
								self.listShipBillInfo("bill", order_id)
							});
							break
						}
					});
	FabModule.AccountBase
			.method(
					"state_ac_init",
					function(params) {
						$(".state_autocomplete")
								.each(
										function() {
											var $self = $(this), targetid = $self
													.attr("id").slice(0, -3);
											$self
													.autoComplete({
														template : "{{#items}}<li id='{{.}}'>{{.}}</li>{{/items}}{{#ifitems}}<li class='ignore lastLiAC'><span style='color:#666'>Add more characters to narrow your search</span></li>{{/ifitems}}{{^items}}<li class='ignore lastLiAC'>We can't find that.</li>{{/items}}",
														items : params,
														onStart : function() {
															$("#" + targetid)
																	.val("")
														},
														onSelectItem : function(
																r) {
															$("#" + targetid)
																	.val(r)
														}
													})
										})
					});
	FabModule.AccountBase
			.method(
					"floatingHeader",
					function() {
						if (!($.browser.msie && $.browser.version == "7.0")) {
							var $floatingbox = $(".floatingHeader"), $floatingPhantomDiv = $(".floatingPhantomDiv");
							if ($floatingbox.length > 0) {
								var bodyY = parseInt($(".fabBlock").offset().top);
								$(window)
										.scroll(
												function() {
													var scrollY = $(window)
															.scrollTop()
															+ $floatingPhantomDiv
																	.height();
													var isfixed = $floatingbox
															.css("position") == "fixed";
													if (scrollY > bodyY
															&& !isfixed) {
														$floatingbox
																.addClass("customShadow");
														$floatingPhantomDiv
																.show();
														$floatingbox
																.stop()
																.css(
																		{
																			position : "fixed",
																			top : 0
																		})
													} else {
														if (scrollY < bodyY
																&& isfixed) {
															$floatingbox
																	.removeClass("customShadow");
															$floatingPhantomDiv
																	.hide();
															$floatingbox
																	.css({
																		position : "relative",
																		top : 0
																	})
														}
													}
												})
							}
						}
					});
	FabModule.AccountBase
			.method(
					"listShipBillInfo",
					function(addr_type, order_id) {
						var self = this;
						if (addr_type == "bill") {
							$
									.ajax({
										url : "/billing-address-list/",
										data : {
											order_id : order_id
										},
										type : "GET",
										dataType : "html",
										success : function(response) {
											if (response != "") {
												$("#fabModal")
														.modal(
																{
																	content : response,
																	modalSize : "orderPGBilingLB",
																	onOpen : function() {
																		$(
																				"#saveBillInfo")
																				.click(
																						function() {
																							self
																									.saveBillingInfo()
																						});
																		$(
																				"a[id=addBillingAddress]")
																				.click(
																						function() {
																							var order_id = $(
																									"#resolve_order_id")
																									.val();
																							self
																									.addEditShipBillInfo(
																											"bill",
																											order_id)
																						})
																	},
																	onClose : function() {
																	}
																})
											}
										},
										error : function() {
										}
									})
						} else {
							if (addr_type == "ship") {
								$
										.ajax({
											url : "/shipping-address-list/",
											data : {
												order_id : order_id
											},
											type : "GET",
											dataType : "html",
											success : function(response) {
												if (response != "") {
													$("#fabModal")
															.modal(
																	{
																		content : response,
																		modalSize : "addEditPaymentInfo",
																		onOpen : function() {
																			$(
																					"#saveShipInfo")
																					.click(
																							function() {
																								self
																										.saveShippingInfo(order_id)
																							});
																			$(
																					"#addShippingAddress")
																					.click(
																							function() {
																								self
																										.addEditShipBillInfo(
																												"ship",
																												order_id)
																							})
																		},
																		onClose : function() {
																		}
																	})
												}
											},
											error : function() {
											}
										})
							}
						}
						_gaq.push([ "_trackPageview",
								"/" + addr_type + "-address-list/" ])
					});
	FabModule.AccountBase
			.method(
					"addEditShipBillInfo",
					function(addr_type, order_id) {
						var self = this;
						if (addr_type == "bill") {
							$("#fabModal")
									.modal(
											{
												content : "<iframe src='/add-billing-info-to-resolve-order/"
														+ order_id
														+ "/' id='btCardLB' name='btCardLB' scrolling='auto' width='780' height='740' onLoad='' frameborder='0' vspace='0' hspace='0' marginwidth='0' marginheight='0'></iframe>",
												modalSize : "resolvePaymentInfo card",
												onOpen : function() {
													$("#fabModalContent").attr(
															"style",
															"*height:800px")
												},
												onClose : function() {
												}
											});
							_gaq
									.push([ "_trackPageview",
											"/edit-billing-info/" ])
						} else {
							if (addr_type == "ship") {
								$
										.ajax({
											url : "/add-shipping-info/",
											data : {
												order_id : order_id
											},
											type : "GET",
											dataType : "html",
											success : function(response) {
												if (response != "") {
													$("#fabModal")
															.modal(
																	{
																		content : response,
																		modalSize : "addEditPaymentInfo",
																		onOpen : function() {
																			fabObj
																					.auth()
																					.state_ac_init(
																							JSON
																									.parse($(
																											"#countries_list")
																											.val()));
																			$
																					.switchDefTxt();
																			$(
																					"#saveShipInfo")
																					.click(
																							function() {
																								self
																										.saveShippingInfo()
																							});
																			$(
																					"#ship_address_line1")
																					.blur(
																							function() {
																								$address_tag = $("#ship_address_tag");
																								if ($address_tag
																										.val() == "") {
																									$address_tag
																											.val($(
																													this)
																													.val()
																													.substr(
																															0,
																															18))
																								}
																							});
																			$(
																					".fabTip")
																					.unbind(
																							"click")
																					.click(
																							function() {
																								var $this = $(this);
																								$this
																										.parent()
																										.parent()
																										.find(
																												".tipContent")
																										.toggle()
																										.find(
																												".greyCross")
																										.unbind(
																												"click")
																										.click(
																												function() {
																													$this
																															.parent()
																															.parent()
																															.find(
																																	".tipContent")
																															.hide()
																												})
																							});
																			$(
																					".tipContent")
																					.hideDomOnClick(
																							[ ".fabTip" ])
																		},
																		onClose : function() {
																		}
																	})
												}
											},
											error : function() {
											}
										});
								_gaq.push([ "_trackPageview",
										"/edit-shipping-info/" ])
							}
						}
					});
	FabModule.AccountBase.method("validate_card", function(params) {
		var has_error = false, cvvLen = $("#card_cvv").val().length, cardType;
		try {
			cardType = $(".fullOpactiy")[0].id
		} catch (e) {
			cardType = ""
		}
		if (cardType == "" || $("#card_number").val().length < 15) {
			$(".ccNumber").addClass("fabError").parent().parent().find(
					".errorMsgWrapper").show().find(".errorMessage").text(
					"Please enter a valid card number.");
			$("#card_cvv").addClass("fabError").parent().find(
					".errorMsgWrapper").show().find(".errorMessage").text(
					"A valid CVS/CVC is required.");
			has_error = true
		} else {
			if (cardType == "amex" && cvvLen != 4) {
				$("#card_cvv").addClass("fabError").parent().find(
						".errorMsgWrapper").show().find(".errorMessage").text(
						"A valid CVS/CVC is required.");
				has_error = true
			} else {
				if (cardType != "amex" && cvvLen != 3) {
					$("#card_cvv").addClass("fabError").parent().find(
							".errorMsgWrapper").show().find(".errorMessage")
							.text("A valid CVS/CVC is required.");
					has_error = true
				}
			}
		}
		return has_error
	});
	FabModule.AccountBase
			.method(
					"saveBillingInfo",
					function() {
						var self = this, uniqId = "billLBError", msg = "";
						$
								.ajax({
									url : "/add-billing-info/",
									data : $("#shippingSubmitForm").serialize(),
									type : "POST",
									dataType : "json",
									success : function(response) {
										if (response.err == null) {
											$(".closeModal").trigger("click");
											$("#order-bar-" + response.order_id)
													.html(
															"<span style='margin-top: 2px;' class='successMessageIcon fabShopSprite'></span>&nbsp;<span style='color: #333333;font-family: Georgia;font-size: 12px;font-style: italic;'>Payment method successfully updated.</span>");
											setTimeout(
													"window.location = '/my-order'",
													5000);
											return
										} else {
											if (response.err == "err1") {
												msg = "Please provide mandatory values"
											} else {
												if (response.err == "err13") {
													msg = "The selected payment method failed authorization. Please select a different payment method or enter a new one."
												} else {
													msg = "Unable to process transaction. Please contact your card issuer or try another card."
												}
											}
										}
										if (msg != "") {
											fabMsgHandler("errMsg" + uniqId,
													"error", msg)
										}
									},
									error : function() {
									}
								});
						_gaq.push([ "_trackPageview", "/add-billing-info/" ])
					});
	FabModule.AccountBase.method("lgnLightBox", function() {
		var self = this;
		$("#fabModal").modal({
			content : self.loginContent,
			modalSize : "loginLB",
			onOpen : function() {
				$("#requestInvite").click(function(e) {
					$(this).hide();
					$("#errBar").hide();
					$("#forgotPW, #loginWrap, #forgotPWBlock, ").hide();
					$("#invSignUpWrap, #aMWrap").show();
					$("#user_email").val("Email address");
					$("#inviteMsg").css("height", "253px");
					$("#inviteForm").css("height", "253px")
				});
				$("#forgotPW").click(function(e) {
					$(this).hide();
					$("#inviteMsg").css("height", "397px");
					$("#inviteForm").css("height", "397px");
					$("#forgotPWBlock").toggle();
					$("#errBar").hide()
				});
				$("#reLogin").click(function(e) {
					$("#errBar").hide();
					$("#invSignUpWrap, #aMWrap").hide();
					$("#loginWrap, #forgotPW, #requestInvite").show();
					$("#inviteMsg, #inviteForm").css("height", "256px");
					$(".loginForm").css("height", "275px");
					$(".loginMsg ").css("height", "275px")
				});
				$("#forgotPW").bind("click", function() {
					$("#errBar").hide();
					$("#forgotPWBlock").show();
					$("#inviteMsg").height($("#inviteForm").height())
				});
				$("#resetPWForm").submit(function(event) {
					event.preventDefault();
					self.requestPWResetLink();
					return false
				});
				$.switchDefTxt()
			},
			onClose : function() {
				if (self.fabBase.params.pg == "web_user_index") {
					$(".inviteWrapper, #changePWWrapper").show();
					$("#email").focus()
				}
			}
		})
	});
	FabModule.AccountBase
			.method(
					"createPassLB",
					function() {
						var self = this;
						$(".closeModal ", "#fabModal").remove();
						$("#fabModal")
								.modal(
										{
											content : self.createPassContent,
											modalSize : "createPassLB",
											onOpen : function() {
												$("#createPassFrm")
														.submit(
																function() {
																	var errMsg = "", pass_val = $(
																			"#password")
																			.val(), cpass_val = $(
																			"#cPassword")
																			.val();
																	if (pass_val == ""
																			&& cpass_val == "") {
																		errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Password can not be blank."
																	} else {
																		if (pass_val != cpass_val) {
																			errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Passwords do not match."
																		} else {
																			if (!$(
																					"#accecptTerms")
																					.is(
																							":checked")) {
																				errMsg = "<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Please accept the Terms Of Use and Privacy Statement."
																			}
																		}
																	}
																	if (errMsg != "") {
																		$(
																				"#errBar")
																				.show();
																		$(
																				"#createPassErr")
																				.html(
																						errMsg)
																				.show();
																		return false
																	} else {
																		return true
																	}
																})
											},
											onClose : function() {
											}
										})
					});
	FabModule.AccountBase
			.method(
					"createLogin",
					function(url) {
						var err = false, $loginuserloader = $("#login_user_loader");
						var inputs = $("#uLogin :input"), values = {};
						inputs.each(function() {
							if (this.name != undefined && $(this).val() == "") {
								err = true
							}
							if (this.name != undefined && $(this).val() != "") {
								values[this.name] = $(this).val()
							}
						});
						if (err) {
							fabMsgHandler("errBar", "error",
									"Username & Password required.");
							return false
						}
						$loginuserloader.activity({
							width : 4,
							color : "#fff"
						});
						$
								.ajax({
									url : url,
									type : "POST",
									dataType : "json",
									data : (values),
									success : function(response) {
										if (response.err != null) {
											if (response.err == "err1") {
												fabMsgHandler("errBar",
														"error",
														"Username & Password required.")
											}
											if (response.err == "err2") {
												fabMsgHandler("errBar",
														"error",
														"Oops!  That username does not exist.")
											}
											if (response.err == "err3") {
												fabMsgHandler("errBar",
														"error",
														"Oops!  That username does not exist.")
											} else {
												fabMsgHandler("errBar",
														"error",
														"Oops! Password does not match. Please try again.")
											}
										} else {
											window.location.reload()
										}
									},
									complete : function(data) {
										$loginuserloader.activity(false)
									},
									error : function(data) {
										fabMsgHandler("errBar", "error",
												"Ugh. Fab.com has a headache. Please try again in a few minutes.")
									}
								});
						_gaq.push([ "_trackPageview", "/user-login" ]);
						return false
					});
	FabModule.AccountBase
			.method(
					"sendReminderLink",
					function(uid, msgDivId) {
						var self = this;
						if (uid == "" || parseInt(uid) == 0) {
							fabMsgHandler(msgDivId, "error",
									"We are not able to send the reminder link. Please try later.");
							return false
						}
						$
								.ajax({
									url : "/send-reminder-link/",
									type : "POST",
									dataType : "json",
									data : {
										uid : uid
									},
									success : function(response) {
										if (response.err == null) {
											fabMsgHandler(msgDivId, "success",
													"Reminder link to access your account is sent on your email.")
										} else {
											fabMsgHandler(msgDivId, "error",
													"We are not able to send the reminder link. Please try later.")
										}
									},
									error : function() {
										fabMsgHandler(msgDivId, "error",
												"We are not able to send the reminder link. Please try later.")
									}
								});
						_gaq
								.push([ "_trackPageview",
										"/subscription-reminder" ])
					});
	FabModule.AccountBase
			.method(
					"resetPassword",
					function() {
						$("#changePwdForm")
								.submit(
										function(event) {
											event.preventDefault();
											var inputs = $("#changePwdForm :input"), values = {}, emptyErr = false, $chngPwdLoader = $("#change_pwd_loader");
											inputs
													.each(function() {
														if (this.name != undefined
																&& $(this)
																		.val() == "") {
															emptyErr = true
														}
														if (this.name != undefined
																&& $(this)
																		.val() != "") {
															values[this.name] = $(
																	this).val()
														}
													});
											if (emptyErr) {
												Helper
														.showMessage(
																"#pwdChangeMsg",
																"",
																"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Required fields cannot be left blank.",
																{
																	delay : 5000
																});
												var wrongPwdInputBoxes = [];
												if (values.old_password == "") {
													wrongPwdInputBoxes = wrongPwdInputBoxes
															.concat("old_password")
												}
												if (values.new_password == "") {
													wrongPwdInputBoxes = wrongPwdInputBoxes
															.concat("new_password")
												}
												if (values.conf_password == "") {
													wrongPwdInputBoxes = wrongPwdInputBoxes
															.concat("conf_password")
												}
												$
														.each(
																wrongPwdInputBoxes,
																function(index,
																		value) {
																	$(
																			'input[name="'
																					+ value
																					+ '"]')
																			.addClass(
																					"errorInput")
																});
												return false
											}
											if (values.new_password != values.conf_password) {
												Helper
														.showMessage(
																"#pwdChangeMsg",
																"",
																"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Passwords do not match.",
																{
																	delay : 5000
																});
												$
														.each(
																[
																		"new_password",
																		"conf_password" ],
																function(index,
																		value) {
																	$(
																			'input[name="'
																					+ value
																					+ '"]')
																			.addClass(
																					"errorInput")
																});
												return false
											}
											$chngPwdLoader.activity({
												width : 4
											});
											$
													.ajax({
														url : "/reset-password/",
														type : "POST",
														dataType : "json",
														data : (values),
														success : function(
																response) {
															var wrongPwdInputBoxes = [];
															if (response.err == null) {
																Helper
																		.showMessage(
																				"#pwdChangeMsg",
																				"success",
																				"<span class='successMessageIcon fabShopSprite'></span>Your password has been successfully changed.",
																				{
																					delay : 5000
																				});
																$(
																		'input[name="old_password"]')
																		.val("");
																$(
																		'input[name="new_password"]')
																		.val("");
																$(
																		'input[name="conf_password"]')
																		.val("")
															} else {
																if (response.err == "err1") {
																	wrongPwdInputBoxes = [ "old_password" ];
																	Helper
																			.showMessage(
																					"#pwdChangeMsg",
																					"error",
																					"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Old password is wrong!",
																					{
																						delay : 5000
																					})
																} else {
																	if (response.err == "err3") {
																		wrongPwdInputBoxes = [
																				"new_password",
																				"conf_password" ];
																		Helper
																				.showMessage(
																						"#pwdChangeMsg",
																						"error",
																						"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Passwords do not match.",
																						{
																							delay : 5000
																						})
																	}
																}
																$
																		.each(
																				wrongPwdInputBoxes,
																				function(
																						index,
																						value) {
																					$(
																							'input[name="'
																									+ value
																									+ '"]')
																							.addClass(
																									"errorInput")
																				})
															}
														},
														complete : function(
																data) {
															$chngPwdLoader
																	.activity(false)
														}
													});
											_gaq
													.push([ "_trackPageview",
															"/logged-in-reset-password" ])
										})
					});
	FabModule.AccountBase
			.method(
					"requestPWResetLink",
					function() {
						var self = this, email = $("#resetPWEmail").val(), $resetuserpwdloader = $("#reset_user_pwd_loader");
						if (email == "" || email == "Email address") {
							fabMsgHandler(
									"errBar",
									"error",
									"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> Please enter a valid email address.");
							$("#forgotPWBlock").hide();
							$("#forgotPW").show();
							$("#inviteMsg").css("height", "253px");
							$("#inviteForm").css("height", "253px");
							return false
						}
						$resetuserpwdloader.activity({
							width : 4,
							color : "#fff"
						});
						$
								.ajax({
									url : "/password-reset/",
									type : "POST",
									dataType : "json",
									data : {
										pass_reset_email : email
									},
									success : function(response) {
										if (response.err != null) {
											if (response.err == "err1") {
												fabMsgHandler(
														"errBar",
														"error",
														"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> That email address is not registered with Fab.com.")
											} else {
												if (response.err == "err2") {
													fabMsgHandler(
															"errBar",
															"error",
															"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> An invite has previously been requested with this email address but an account has not yet been created. <span style='color:#dd0017; cursor:pointer' class='reminderLink'>Click here</span> for us to email you an access link to this email address.");
													$(".reminderLink")
															.click(
																	function(e) {
																		self
																				.sendReminderLink(
																						response.uid,
																						"errBar")
																	})
												} else {
													fabMsgHandler(
															"errBar",
															"error",
															"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> We're unable to reset your password right now. Please try again in a few minutes.")
												}
											}
										} else {
											fabMsgHandler("errBar", "success",
													"Success. A new password is on its way. Please check your email.")
										}
									},
									complete : function(data) {
										$resetuserpwdloader.activity(false);
										$("#forgotPWBlock").hide();
										$("#forgotPW").show();
										$("#inviteMsg").css("height", "253px");
										$("#inviteForm").css("height", "253px")
									},
									error : function(data) {
										fabMsgHandler(
												"errBar",
												"error",
												"<span style='font-size:1.2em;color:#dd0017'>Oops!</span> We're unable to reset your password right now. Please try again in a few minutes.")
									}
								});
						_gaq.push([ "_trackPageview", "/reset-password-link" ]);
						return false
					});
	FabModule.AccountBase
			.method(
					"saveChangedUsername",
					function() {
						$("#changeUserNameForm")
								.submit(
										function(event) {
											event.preventDefault();
											var $changeUserNameloader = $("#changeUserNameLoader"), $new_username = $('input[name="new_username"]'), username = $
													.trim($new_username.val());
											if (username == "") {
												Helper
														.showMessage(
																"#usernameChangeMssgBox",
																"success",
																"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Username can not be blank.",
																{
																	delay : 3000
																});
												return false
											}
											$changeUserNameloader.activity({
												width : 4
											});
											$
													.ajax({
														url : "/save-username/",
														type : "POST",
														dataType : "json",
														data : ({
															username : username
														}),
														success : function(
																response) {
															if (response.err == null) {
																$new_username
																		.val("");
																$(
																		"#username_stated")
																		.text(
																				username);
																Helper
																		.showMessage(
																				"#usernameChangeMssgBox",
																				"success",
																				"<span class='successMessageIcon fabShopSprite' style='margin-top: 0px;line-height: 24px;'></span>User Name changed successfully",
																				{
																					delay : 3000
																				});
																return false
															} else {
																if (response.err == "err2") {
																	Helper
																			.showMessage(
																					"#usernameChangeMssgBox",
																					"success",
																					"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>This username is already used. Please choose another.",
																					{
																						delay : 3000
																					})
																} else {
																	Helper
																			.showMessage(
																					"#usernameChangeMssgBox",
																					"success",
																					"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Username is not in proper format",
																					{
																						delay : 3000
																					})
																}
															}
														},
														complete : function(
																data) {
															$changeUserNameloader
																	.activity(false)
														}
													});
											_gaq.push([ "_trackPageview",
													"/save-changed-username" ])
										})
					});
	FabModule.AccountBase
			.method(
					"saveChangedEmail",
					function() {
						$("#changeEmailForm")
								.submit(
										function(event) {
											event.preventDefault();
											var $changeEmailLoader = $("#changeEmailLoader"), $new_email = $('input[name="new_email"]'), email = $
													.trim($new_email.val());
											if (email == "") {
												Helper
														.showMessage(
																"#emailChangeMssgBox",
																"success",
																"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Please provide an email address.",
																{
																	delay : 3000
																});
												return false
											}
											$changeEmailLoader.activity({
												width : 4
											});
											$
													.ajax({
														url : "/save-email/",
														type : "POST",
														dataType : "json",
														data : ({
															email : email
														}),
														success : function(
																response) {
															if (response.err == null) {
																$new_email
																		.val("");
																$(
																		"#user_email_address")
																		.text(
																				email);
																Helper
																		.showMessage(
																				"#emailChangeMssgBox",
																				"success",
																				"<span class='successMessageIcon fabShopSprite' style='margin-top: 0px;'></span>Email changed successfully.",
																				{
																					delay : 3000
																				});
																return false
															} else {
																if (response.err == "err2") {
																	Helper
																			.showMessage(
																					"#emailChangeMssgBox",
																					"success",
																					"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Provide a valid email.",
																					{
																						delay : 3000
																					})
																} else {
																	if (response.err == "err3") {
																		Helper
																				.showMessage(
																						"#emailChangeMssgBox",
																						"success",
																						"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>oops! That email address is already being used.",
																						{
																							delay : 3000
																						})
																	} else {
																		Helper
																				.showMessage(
																						"#emailChangeMssgBox",
																						"success",
																						"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Please provide email address.",
																						{
																							delay : 3000
																						})
																	}
																}
															}
														},
														complete : function(
																data) {
															$changeEmailLoader
																	.activity(false)
														}
													});
											_gaq.push([ "_trackPageview",
													"/save-changed-email" ])
										})
					});
	FabModule.AccountBase
			.method(
					"submitEmailSettings",
					function() {
						var self = this;
						$("#emailPrefForm")
								.submit(
										function(event) {
											event.preventDefault();
											var values = {}, msg = "", $saveEmailPrefLoader = $("#save_email_pref_loader");
											values.daily_sale_email_freq = $(
													"#onOffDailySettingBtn")
													.attr("data-modal-name");
											values.weekly_sale_email_freq = $(
													"#onOffWeeklyMailPreview")
													.attr("data-modal-name");
											values.unsubscribe_all_pref = $(
													"#onOffsubBtn").attr(
													"data-modal-name");
											values.friend_joined_email_freq = $(
													"#onOffinviteBtn").attr(
													"data-modal-name");
											values.insp_img_fab_e_pref = $(
													"input:radio[name=insp_img_fab_e_pref]:checked")
													.val();
											values.insp_img_tag_e_pref = $(
													"input:radio[name=insp_img_tag_e_pref]:checked")
													.val();
											values.custom_sale_email_freq = $(
													"input:checkbox[name=custom_sale_email_freq]")
													.map(function() {
														if (this.checked) {
															return "1"
														} else {
															return "0"
														}
													}).get();
											values.weekly_shop_email_freq = $(
													"input:checkbox[name=weekly_shop_email_freq]")
													.map(function() {
														if (this.checked) {
															return "1"
														} else {
															return "0"
														}
													}).get();
											values.night_sale_email_freq = $(
													"#onOffWeeklySettingBtn")
													.attr("data-modal-name");
											values.insp_img_comment_e_pref = $(
													"input:radio[name=insp_img_comment_e_pref]:checked")
													.val();
											values.insp_img_comment_i_commented_e_pref = $(
													"input:radio[name=insp_img_comment_i_commented_e_pref]:checked")
													.val();
											values.order_status_email_freq = $(
													"input:checkbox[id=every_time_my_order_status]:checked")
													.val();
											if (values.insp_img_fab_e_pref == ""
													|| values.insp_img_tag_e_pref == ""
													|| values.insp_img_comment_e_pref == ""
													|| values.insp_img_comment_i_commented_e_pref == ""
													|| values.daily_sale_email_freq == ""
													|| values.friend_joined_email_freq == ""
													|| values.unsubscribe_all_pref == "") {
												msg = "Please select an option";
												$("#emailPrefMsg").text(msg)
														.show();
												return false
											}
											$saveEmailPrefLoader.activity({
												width : 4
											});
											$
													.ajax({
														url : "/save-email-prefs/",
														type : "POST",
														dataType : "json",
														data : (values),
														success : function(
																response) {
															if (response.err == null) {
																self.params.emailPrefs = [
																		$(
																				"#onOffDailySettingBtn")
																				.attr(
																						"data-modal-name"),
																		$(
																				"#onOffWeeklyMailPreview")
																				.attr(
																						"data-modal-name"),
																		$("input:checkbox[id=custom_sale_email_freq_1]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_2]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_3]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_4]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_5]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_6]:checked"),
																		$("input:checkbox[id=custom_sale_email_freq_7]:checked"),
																		$(
																				"#onOffWeeklySettingBtn")
																				.attr(
																						"data-modal-name"),
																		$("input:checkbox[id=weekly_shop_email_freq_1]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_2]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_3]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_4]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_5]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_6]:checked"),
																		$("input:checkbox[id=weekly_shop_email_freq_7]:checked"),
																		$(
																				"#onOffinviteBtn")
																				.attr(
																						"data-modal-name"),
																		$("input:radio[name=insp_img_fab_e_pref]:checked"),
																		$("input:radio[name=insp_img_tag_e_pref]:checked"),
																		$("input:radio[name=insp_img_comment_e_pref]:checked"),
																		$("input:radio[name=insp_img_comment_i_commented_e_pref]:checked") ];
																$("#cnfSubBlk")
																		.hide();
																if ($(
																		"#main_email_pref_admin_new")
																		.is(
																				":checked")) {
																	Helper
																			.showMessage(
																					"#emailPrefMsg",
																					"success",
																					"<span class='successMessageIcon fabShopSprite' style='margin-top: 0px;'></span> Your email preferences have been successfully updated.",
																					{
																						delay : 2000
																					})
																}
															} else {
																if (response.err == "err1"
																		|| response.err == "err2"
																		|| response.err == "err3") {
																	$(
																			"#emailPrefMsg")
																			.text(
																					"Sorry! Update Failed")
																			.show()
																}
															}
														},
														complete : function() {
															$saveEmailPrefLoader
																	.activity(false)
														}
													});
											_gaq.push([ "_trackPageview",
													"/save-email-prefs" ])
										})
					});
	FabModule.AccountBase
			.method(
					"getShippingInfo",
					function(shipId, $form) {
						var self = this;
						$
								.ajax({
									url : "/get-shipping-info/",
									dataType : "json",
									data : ({
										id : shipId
									}),
									success : function(response) {
										if (response.err == null) {
											var shippinAddr = response.shipping_info;
											var fieldArray = [ "first_name",
													"last_name",
													"address_line1",
													"address_line2", "city",
													"state", "zip_code",
													"telephone_no",
													"address_tag" ];
											for ( var i = 0; i < fieldArray.length; i++) {
												$("#" + fieldArray[i])
														.val(
																Helper
																		.decode(shippinAddr[fieldArray[i]]))
											}
											if (shippinAddr.state != null) {
												$("#state").val(
														shippinAddr.state)
														.removeClass("deft")
											}
											$("#ship_" + shipId).append(
													$form.slideDown().attr(
															"data-id", shipId));
											$(".tipContent").hide();
											$(".fabTip")
													.unbind("click")
													.click(
															function() {
																var $this = $(this);
																$this
																		.parent()
																		.parent()
																		.find(
																				".tipContent")
																		.toggle()
																		.find(
																				".greyCross")
																		.unbind(
																				"click")
																		.click(
																				function() {
																					$this
																							.parent()
																							.parent()
																							.find(
																									".tipContent")
																							.hide()
																				})
															});
											$(".tipContent").hideDomOnClick(
													[ ".fabTip" ])
										}
									},
									complete : function(data) {
										$(
												".addMoreShpAdrsBg, #delete_confirm_clone")
												.hide();
										$("a[data-del-ship-id]").show()
												.parent().show();
										$("a[data-edit-ship-id=" + shipId + "]")
												.addClass("active");
										$("a[data-del-ship-id=" + shipId + "]")
												.hide()
									}
								});
						_gaq.push([ "_trackPageview", "/get-shipping-info" ])
					});
	FabModule.AccountBase
			.method(
					"addUpdateShippingAddress",
					function(shipId) {
						var values = {}, msg = "", $shippingAddrLoader = $("#save_new_adrs_loader");
						values.ship_first_name = $("#first_name").val();
						values.ship_last_name = $("#last_name").val();
						values.ship_address_line1 = $("#address_line1").val();
						values.ship_address_line2 = $("#address_line2").val();
						values.ship_city = $("#city").val();
						values.ship_state = $.trim($("#state").val());
						values.ship_zip_code = $("#zip_code").val();
						values.ship_telephone_no = $("#telephone_no").val();
						values.ship_address_tag = $("#address_tag").val() == "" ? values.ship_address_line1
								.substr(0, 18)
								: $("#address_tag").val().substr(0, 18);
						values.id = shipId;
						values.make_primary_ship_addr = $("#make_this_primary")[0].checked ? "yes"
								: "";
						if (values.ship_first_name == ""
								|| values.ship_last_name == ""
								|| values.ship_address_line1 == ""
								|| values.ship_city == ""
								|| values.ship_state == ""
								|| values.ship_zip_code == ""
								|| values.ship_telephone_no == "") {
							Helper
									.showMessage(
											"#addAdrsMsg",
											"success",
											"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>Please fill the mandatory fields.",
											{
												delay : 5000
											});
							return false
						} else {
							if (values.ship_zip_code.length < 5
									|| isNaN(values.ship_zip_code)) {
								Helper
										.showMessage(
												"#addAdrsMsg",
												"success",
												"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>Invalid Zip Code.",
												{
													delay : 5000
												});
								return false
							} else {
								if (values.ship_telephone_no.length < 10
										|| isNaN(values.ship_telephone_no)) {
									Helper
											.showMessage(
													"#addAdrsMsg",
													"success",
													"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>Invalid Telephone Number.",
													{
														delay : 5000
													});
									return false
								} else {
									if ($.inArray(values.ship_state
											.toLowerCase(), eval($(
											"#lowercase_state_list").val())) == -1) {
										Helper
												.showMessage(
														"#addAdrsMsg",
														"success",
														"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>State is required.",
														{
															delay : 5000
														});
										return false
									} else {
										if ($
												.postalServiceCheck(values.ship_address_line1)) {
											Helper
													.showMessage(
															"#addAdrsMsg",
															"success",
															"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>Invalid Postal Address.",
															{
																delay : 5000
															});
											return false
										} else {
											if ($
													.postalServiceCheck(values.ship_address_line2)) {
												Helper
														.showMessage(
																"#addAdrsMsg",
																"success",
																"<span class='errorIcon fabShopSprite' style='margin-top: 0px;'></span>Invalid Postal Address.",
																{
																	delay : 5000
																});
												return false
											}
										}
									}
								}
							}
						}
						$("#newShippingAddress input[type=submit]").attr(
								"disabled", "disabled");
						$shippingAddrLoader.activity({
							width : 4
						});
						$
								.ajax({
									url : "/save-shipping-address/",
									type : "POST",
									dataType : "json",
									data : (values),
									success : function(response) {
										$shippingAddrLoader.activity(false);
										if (response.err == null) {
											if (shipId == 0) {
												$("#addAdrsMsg")
														.html(
																"<span class='successMessageIcon fabShopSprite' style='margin-top: 6px;'></span>Your shipping address updated successfully.")
														.css("display",
																"inline-block")
														.fadeOut(
																2000,
																function() {
																	$(
																			"#shipping_addr_cancel")
																			.click();
																	$(
																			".shippingAdBlock .shpAdrsBlk")
																			.prepend(
																					response.savedAddrHtml);
																	$(
																			".addMoreShpAdrsBg")
																			.show()
																})
											} else {
												$("#addAdrsMsg")
														.html(
																"<span class='successMessageIcon fabShopSprite' style='margin-top: 6px;'></span>Your shipping address updated successfully.")
														.css("display",
																"inline-block")
														.fadeOut(
																2000,
																function() {
																	$(
																			"#shipping_addr_cancel")
																			.click();
																	$(
																			"#address_tag_"
																					+ values.id)
																			.text(
																					Helper
																							.decode(response.displayAddTag));
																	$(
																			"#address_string_"
																					+ values.id)
																			.text(
																					Helper
																							.decode(response.displayAddString));
																	$(
																			"#name_string_"
																					+ values.id)
																			.text(
																					Helper
																							.decode(response.nameString))
																});
												if (values.make_primary_ship_addr == "yes") {
													$("#addr_btn_" + values.id)[0].checked = "checked"
												}
											}
										} else {
											if (response.err == "err1") {
												$("#addAdrsMsg")
														.html(
																"<span class='errorIcon fabShopSprite' style='margin-top: 6px;'></span>Mandatory values missing.")
														.css("display",
																"inline-block")
														.fadeOut(3000)
											} else {
												$("#addAdrsMsg")
														.html(
																"<span class='errorIcon fabShopSprite' style='margin-top: 6px;'></span>There is Some problem. Please try after some time.")
														.css("display",
																"inline-block")
														.fadeOut(3000)
											}
										}
									},
									complete : function() {
										$(
												"#newShippingAddress input[type=submit]")
												.removeAttr("disabled")
									}
								});
						_gaq
								.push([ "_trackPageview",
										"/add-edit-shipping-info" ])
					});
	FabModule.AccountBase.method("setPrimaryShippingAddress", function() {
		$(".shippinAddrRadioBttn").live("click", function(event) {
			var $this = $(this);
			$this.checked = true;
			var values = {
				id : $this.val()
			};
			$.ajax({
				url : "/choose-primary-shipping-address/",
				type : "POST",
				dataType : "json",
				data : (values),
				success : function(response) {
					if (response.err == null) {
					} else {
					}
				},
				complete : function(data) {
				}
			})
		});
		_gaq.push([ "_trackPageview", "/set-primary-shipping-address" ])
	});
	FabModule.AccountBase.method("setPrimaryBillingAddress", function() {
		$(".billAddrRadioBttn").live("click", function(event) {
			var $this = $(this);
			$this.checked = true;
			$.ajax({
				url : "/choose-primary-billing-address/",
				type : "POST",
				dataType : "json",
				data : ({
					id : $this.val()
				}),
				success : function(response) {
					if (response.err == null) {
					} else {
					}
				},
				complete : function(data) {
				}
			})
		});
		_gaq.push([ "_trackPageview", "/set-primary-billing-address" ])
	});
	FabModule.AccountBase
			.method(
					"homePageFlyDown",
					function(params) {
						var animateHeight = (params == "inspiration") ? "48px"
								: "46px", $splOfferDom = $("#splOfferLink"), $flyDownObj = $("#homePageflwDownWrap"), inProcess = false;
						$splOfferDom
								.click(function() {
									if (!inProcess) {
										inProcess = true;
										var topH = $splOfferDom
												.hasClass("active") ? "-"
												+ (params == "inspiration" ? "330"
														: "281") + "px"
												: animateHeight;
										$splOfferDom.toggleClass("active");
										$flyDownObj.animate({
											top : topH
										}, 1000, function() {
											inProcess = false
										})
									}
								});
						$("#crossIconTPHP").click(function() {
							$splOfferDom.trigger("click")
						})
					});
	FabModule.AccountBase
			.method(
					"fbTimeLineFlyDown",
					function(params) {
						if ($.cookie("fb_tl_fd")) {
							return false
						}
						var self = this, fbId = $("#feedFlwDownWrap").attr(
								"userFbId");
						setTimeout(function() {
							FB.api("/" + fbId, function(response) {
								$("#tlFlyDownFbUserName").html(response.name)
							})
						}, 2000);
						$("#feedFlwDownWrap .fbTlEnableCt .switch")
								.click(
										function() {
											var appId = self.fabBase.params.fb_app_id;
											var nextUrl = self.fabBase.params.fb_access_token_url;
											window
													.open(
															"https://www.facebook.com/dialog/oauth?client_id="
																	+ appId
																	+ "&redirect_uri="
																	+ nextUrl
																	+ "&response_type=code&scope=publish_actions&display=popup",
															"",
															"height=320,width=640")
										});
						var showFlyDown = $("#feedFlwDownWrap").attr(
								"showFlyDown");
						if (showFlyDown === "1") {
							$("#feedFlwDownWrap")
									.show()
									.animate(
											{
												top : window.location.pathname
														.indexOf("inspiration") !== -1 ? 103
														: 54
											}, 1000)
						}
						$("#feedFlwDownWrap #crossIconLfeedP").click(
								function() {
									$("#feedFlwDownWrap").animate({
										top : -290
									}, 1000, function() {
										$("#feedFlwDownWrap").hide();
										$.cookie("fb_tl_fd", 1, {
											expires : 7,
											path : "/"
										})
									})
								})
					});
	FabModule.AccountBase
			.method(
					"modalBindings",
					function() {
						$("a[data-modal-name]")
								.click(
										function(e) {
											e.preventDefault;
											e.stopPropogation;
											var modalType = $(this).attr(
													"data-modal-name"), url = $(
													this).attr("href"), response = "dummy";
											$
													.ajax({
														url : url,
														data : $
																.extend(
																		{
																			modal : modalType
																		},
																		{
																			data : $(
																					this)
																					.attr(
																							"data-params")
																		}),
														success : function(
																response) {
															if (response.err == null) {
																switch (modalType) {
																case "contact-us":
																	$(
																			"#fabModal")
																			.modal(
																					{
																						content : response.html,
																						modalSize : "contatUs",
																						onOpen : function() {
																							var doc = ($.browser.chrome || $.browser.safari) ? "body"
																									: "html";
																							$(
																									doc)
																									.animate(
																											{
																												scrollTop : 0
																											})
																						}
																					});
																	break
																}
															} else {
															}
														},
														error : function() {
														}
													});
											_gaq.push([ "_trackPageview",
													"/" + modalType + "/" ]);
											return false
										})
					});
	FabModule.AccountBase
			.method(
					"onLoadRequired",
					function() {
						var self = this;
						$("#changeUNameBlock").hide();
						$("#changePwdBlock").hide();
						$("#changeEmailBlock").hide();
						$(".newShipingAdBlk").hide();
						$(".conformationBlk").hide();
						$("body").click(function(e) {
							$(".dropDownList ").hide()
						});
						$(".userNameSettingBlk .hoverElmnt").click(function() {
							$("#changeUNameBlock").toggle();
							$(this).toggleClass("eyeIcon")
						});
						$(".passwrdSettingBlk  .hoverElmnt").click(function() {
							$("#changePwdBlock").toggle();
							$(this).toggleClass("eyeIcon")
						});
						$(".EmailSettingBlk  .hoverElmnt").click(function() {
							$("#changeEmailBlock").toggle();
							$(this).toggleClass("eyeIcon")
						});
						$(".confrmN").click(function() {
							$("#delCnfrmBox").hide()
						});
						var $delete = $("#delete_confirm_clone"), $newForm = $("#shipping_form_clone"), self = this;
						$("a[data-del-ship-id]")
								.live(
										"click",
										function(event) {
											var shipping_id = $(this).attr(
													"data-del-ship-id");
											$("a[data-del-ship-id]").show()
													.parent().show();
											$(".shipAddrEdit").removeClass(
													"active");
											$("#shipping_addr_cancel").trigger(
													"click");
											$newForm.hide();
											$(this).parent().hide();
											$("#ship_" + shipping_id)
													.append(
															$delete
																	.attr(
																			"data-id",
																			shipping_id)
																	.show())
										});
						$(".confrmN", $delete).live("click", function() {
							$delete.hide();
							$("a[data-del-ship-id]").parent().show()
						});
						$(".confrmY", $delete)
								.live(
										"click",
										function() {
											var shipping_id = $delete
													.attr("data-id");
											$
													.ajax({
														url : "/delete-shipping-address/",
														type : "POST",
														data : {
															id : shipping_id
														},
														success : function(
																response) {
															if (response.err == null) {
																var $shipping = $("#ship_"
																		+ shipping_id);
																$shipping
																		.slideUp(
																				"fast",
																				function() {
																					var $this = $(this);
																					$this
																							.remove();
																					if ($(
																							"input[type='radio']",
																							$this)
																							.is(
																									":checked")) {
																						$(
																								".shpAdrsBlk")
																								.find(
																										"li:first")
																								.find(
																										".shippinAddrRadioBttn")
																								.trigger(
																										"click")
																					}
																				})
															} else {
															}
														}
													});
											return false
										});
						$("a[data-edit-ship-id]")
								.live(
										"click",
										function(event) {
											self.getShippingInfo($(this).attr(
													"data-edit-ship-id"),
													$newForm);
											$("#delete_confirm_clone").hide();
											$("a[data-del-ship-id]").parent()
													.show();
											$(".addMoreShpAdrsBg").hide();
											$(".shipAddrEdit")
													.removeClass("active")
													.parent()
													.find(
															"a[data-del-ship-id], a[data-edit-ship-id]")
													.show();
											$(this).addClass("active");
											$(this).parent().find(
													"a[data-del-ship-id]")
													.hide()
										});
						$("#shipping_addr_cancel").live("click", function() {
							$(".shipAddrEdit").removeClass("active");
							$("a[data-del-ship-id]").show();
							$("#newShippingAddress")[0].reset();
							$("#shipping_form_clone").hide();
							$(".addMoreShpAdrsBg").show()
						});
						$("#address_line1").blur(function() {
							$address_tag = $("#address_tag");
							if ($address_tag.val() == "") {
								$address_tag.val($(this).val().substr(0, 18))
							}
						});
						$newForm.find("form").bind(
								"submit",
								function(e) {
									self.addUpdateShippingAddress($newForm
											.attr("data-id"));
									return false
								});
						$(".addMoreShpAdrsBg")
								.live(
										"click",
										function(event) {
											$(
													"#newShippingAddress input[type=submit]")
													.removeAttr("disabled");
											$("#delete_confirm_clone").hide();
											$("a[data-del-ship-id]").parent()
													.show();
											$(this).hide();
											$(".shipAddrEdit").removeClass(
													"active");
											$("#newShippingAddress")[0].reset();
											var $formDiv = $("#shipping_form_clone");
											$(this).parent().after(
													$formDiv.attr("data-id", 0)
															.show());
											$.switchDefTxt();
											$(".fabTip")
													.unbind("click")
													.click(
															function() {
																var $this = $(this);
																$this
																		.parent()
																		.parent()
																		.find(
																				".tipContent")
																		.toggle()
																		.find(
																				".greyCross")
																		.unbind(
																				"click")
																		.click(
																				function() {
																					$this
																							.parent()
																							.parent()
																							.find(
																									".tipContent")
																							.hide()
																				})
															})
										});
						$("#shipping_addr_cancel_0").click(function() {
							$(".newShipingAdBlk").hide();
							$(".addMoreShpAdrsBg").show()
						})
					});
	FabModule.AccountBase.method("onEmailPrefLoadRequired", function() {
	});
	FabModule.AccountBase.method("showHideForms", function() {
		var self = this;
		$("#fabAddPaymentInfo").hide();
		$(".addEditCard").click(function(event) {
			var $this = $(this);
			if (!$this.hasClass("active")) {
				$(".addEditCard").removeClass("active");
				$this.addClass("active");
				$("#delCnfrmBox").hide();
				$(".delBut, .addEditCard").show();
				$this.parent().find(".delBut").hide();
				$("#braintreeCardSubmitForm").remove();
				self.getBillingForm($(this).attr("id").split("_")[1])
			}
		});
		$(".delBut").click(
				function(event) {
					var $newLi = $("#delCnfrmBox");
					var $delYesUniq = $(this).attr("id").split("_")[1];
					$(".delBut, .addEditCard").show();
					$(".addEditCard.active").removeClass("active").closest(
							".shpRowBlk").find(".fabAddPaymentInfo").hide();
					$(this).parent().find(".delBut, .addEditCard").hide();
					$(this).parent().append($newLi.show());
					$(".confrmY").unbind("click").click(function(event) {
						self.removeBillingInfo($delYesUniq);
						$(this).closest("li").remove();
						$("#mypmWrap").append($newLi.hide())
					});
					$(".confrmN").unbind("click").click(
							function(event) {
								$(this).closest(".shiButWrap").find(
										".delBut, .addEditCard").show();
								$("#delCnfrmBox").hide();
								$(".addMoreShpAdrs").show()
							})
				});
		$(".canButoon").live("click", function() {
			$("#braintreeCardSubmitForm").remove();
			$(".fabAddPaymentInfoWrap").hide();
			$(".addMoreShpAdrs").show();
			$(".addEditCard").removeClass("active");
			$(".delBut").show()
		})
	});
	FabModule.AccountBase.method("getBillingForm", function(uniqId) {
		var self = this;
		$.ajax({
			url : "/get-billing-form/",
			type : "POST",
			data : {
				user_billing_id : uniqId
			},
			success : function(response) {
				if (response.err == null) {
					$("#fabAddPaymentInfo_" + uniqId)
							.html(response.html_string).show();
					$("img[name='seal']").attr("height", "57");
					$("#btNvsIcons").show();
					$.switchDefTxt();
					$(".fabAddPaymentInfoWrap").css({
						height : "100%",
						"background-color" : "transparent"
					}).show();
					self.state_ac_init(JSON.parse($("#countries_list").val()));
					$("#delCnfrmBox").hide();
					$(".addMoreShpAdrs").hide();
					$.switchFocus($(".ccNumber"));
					self.bindBillingForm()
				} else {
				}
			}
		});
		_gaq.push([ "_trackPageview", "/get-billing-form/" ])
	});
	FabModule.AccountBase
			.method(
					"bindBillingForm",
					function() {
						var self = this;
						$("#sendBTCardRequest")
								.unbind("click")
								.click(
										function() {
											$("#card_holder_name")
													.val(
															Helper
																	.decode($(
																			"#cc_bill_first_name")
																			.val()
																			+ " "
																			+ $(
																					"#cc_bill_last_name")
																					.val()));
											$("#card_number").val(
													$("#cnumber1").val()
															+ $("#cnumber2")
																	.val()
															+ $("#cnumber3")
																	.val()
															+ $("#cnumber4")
																	.val());
											$("#bill_first_name")
													.val(
															Helper
																	.decode($(
																			"#cc_bill_first_name")
																			.val()));
											$("#bill_last_name")
													.val(
															Helper
																	.decode($(
																			"#cc_bill_last_name")
																			.val()));
											if (validateForm()) {
												$("#paymentMethodLoder")
														.activity({
															width : 4
														});
												$("#braintreeCardSubmitForm")
														.submit()
											}
										});
						var validateForm = function() {
							var no_error = true, errMsgs = {
								cc_bill_first_name : "First name is required.",
								cc_bill_last_name : "Last name is required.",
								card_number : "Please enter a valid card number.",
								card_cvv : "A valid CVS/CVC is required.",
								card_expiry_month : "Please select a valid expiration date.",
								card_expiry_year : "Please select a valid expiration date.",
								bill_address_line1 : "Address Line1 is required.",
								bill_city : "City is required.",
								bill_state : "State is required.",
								bill_zip_code : "Zip Code is required.",
								invalid_postal : "Invalid Postal Address"
							}, areNumbers = [ "cnumber1", "cnumber2",
									"cnumber3", "cnumber4", "card_cvv",
									"bill_zip_code" ];
							$(".fabError").removeClass("fabError");
							$(".errorMsgWrapper").hide();
							$(
									"#braintreeCardSubmitForm input[type='text'], #braintreeCardSubmitForm select")
									.not(
											"#braintreeCardSubmitForm input[rel='optional']")
									.each(
											function(e) {
												var $this = $(this);
												if (($this.val() == "")
														|| ($this.val() != "" && $this
																.val() == $this
																.attr("title"))) {
													if ($this.attr("id") == "cnumber1"
															|| $this.attr("id") == "cnumber2"
															|| $this.attr("id") == "cnumber3"
															|| $this.attr("id") == "cnumber4") {
														$this
																.addClass(
																		"fabError")
																.parent()
																.parent()
																.find(
																		".errorMsgWrapper")
																.show()
																.find(
																		".errorMessage")
																.text(
																		errMsgs.card_number)
													} else {
														$this
																.addClass(
																		"fabError")
																.parent()
																.find(
																		".errorMsgWrapper")
																.show()
																.find(
																		".errorMessage")
																.text(
																		errMsgs[$this
																				.attr("id")])
													}
													no_error = false
												}
											});
							for (i = 0, len = areNumbers.length; i < len; i++) {
								var itemVal = $("#" + areNumbers[i]).val();
								if (isNaN(itemVal)
										&& itemVal != ""
										&& itemVal != $("#" + areNumbers[i])
												.attr("title")) {
									$("#" + areNumbers[i]).addClass("fabError")
											.parent().find(".errorMsgWrapper")
											.show().find(".errorMessage").text(
													"Expecting Number");
									if (areNumbers[i] == "cnumber1"
											|| areNumbers[i] == "cnumber2"
											|| areNumbers[i] == "cnumber3"
											|| areNumbers[i] == "cnumber4") {
										$("#" + areNumbers[i]).addClass(
												"fabError").parent().parent()
												.find(".errorMsgWrapper")
												.show().find(".errorMessage")
												.text("Expecting Number")
									}
								}
							}
							if (self.validate_card()) {
								no_error = false
							}
							return no_error
						};
						$(".select_v1").change(function() {
							$(this).find('option[value=""]').remove()
						})
					});
	FabModule.AccountBase.method("removeBillingInfo", function(uniqId) {
		$.ajax({
			url : "/remove-payment-info/",
			type : "POST",
			data : {
				user_billing_id : uniqId
			},
			success : function(response) {
				if (response.err == null) {
				} else {
				}
			}
		});
		_gaq.push([ "_trackPageview", "/remove-payment-info/" ])
	});
	FabModule.AccountBase.method("get_fly_cart", function() {
		var self = this;
		$.ajax({
			url : "/cart/",
			data : {
				c : 1
			},
			type : "POST",
			success : function(response) {
				$("#sCart").html(response.data);
				if (response.reserved_time > 0) {
					self.fabTimer(response.reserved_time);
					$("#scMenu .crtLstNotification").html(response.count).css(
							"display", (response.count > 0 ? "block" : "none"))
				}
			},
			error : function(response) {
			}
		})
	});
	FabModule.AccountBase
			.method(
					"saveShippingInfo",
					function(order_id) {
						if ($("#isSelectForm").length == 0) {
							var self = this, uniqId = "shipLBError", msg = "", error = false, errMsgs = {
								ship_first_name : "First name is required.",
								ship_last_name : "Last name is required.",
								ship_address_line1 : "Address Line1 is required.",
								ship_city : "City is required.",
								ship_state : "State is required.",
								ship_zip_code : "Zip Code is required.",
								ship_telephone_no : "Telephone Number is required.",
								invalid_postal : "Invalid Postal Address"
							}, areNumbers = [ "ship_zip_code",
									"ship_telephone_no" ];
							$(".fabError").removeClass("fabError");
							$(".errorMsgWrapper").hide();
							$(
									"#shippingSubmitForm input[type='text'], #shippingSubmitForm select")
									.not(
											"#shippingSubmitForm input[rel='optional']")
									.each(
											function(e) {
												var $this = $(this);
												if (($this.val() == "")
														|| ($this.val() != "" && $this
																.val() == $this
																.attr("title"))) {
													if ($this.attr("id") == "cnumber1"
															|| $this.attr("id") == "cnumber2"
															|| $this.attr("id") == "cnumber3"
															|| $this.attr("id") == "cnumber4") {
														$this
																.addClass(
																		"fabError")
																.parent()
																.parent()
																.find(
																		".errorMsgWrapper")
																.show()
																.find(
																		".errorMessage")
																.text(
																		errMsgs.card_number)
													} else {
														$this
																.addClass(
																		"fabError")
																.parent()
																.find(
																		".errorMsgWrapper")
																.show()
																.find(
																		".errorMessage")
																.text(
																		errMsgs[$this
																				.attr("id")])
													}
													error = true
												}
											});
							for (i = 0, len = areNumbers.length; i < len; i++) {
								var itemVal = $("#" + areNumbers[i]).val();
								if (isNaN(itemVal)
										&& itemVal != ""
										&& itemVal != $("#" + areNumbers[i])
												.attr("title")) {
									$("#" + areNumbers[i]).addClass("fabError")
											.parent().find(".errorMsgWrapper")
											.show().find(".errorMessage").text(
													"Expecting Number");
									error = true
								}
							}
							if ($.postalServiceCheck($("#ship_address_line1")
									.val())) {
								$("#ship_address_line1").addClass("fabError")
										.parent().find(".errorMsgWrapper")
										.fadeOut().fadeIn().find(
												".errorMessage").text(
												errMsgs.invalid_postal);
								error = true
							}
							if ($.postalServiceCheck($("#ship_address_line2")
									.val())) {
								$("#ship_address_line2").addClass("fabError")
										.parent().find(".errorMsgWrapper")
										.fadeOut().fadeIn().find(
												".errorMessage").text(
												errMsgs.invalid_postal);
								error = true
							}
							if ($("#ship_zip_code").val()
									&& $("#ship_zip_code").val().length < 5) {
								$("#ship_zip_code").addClass("fabError")
										.parent().find(".errorMsgWrapper")
										.show().find(".errorMessage").text(
												"Invalid Zip Code.");
								error = true
							}
							if ($("#ship_telephone_no").val()
									&& $("#ship_telephone_no").val().length < 10) {
								$("#ship_telephone_no").addClass("fabError")
										.parent().find(".errorMsgWrapper")
										.show().find(".errorMessage").text(
												"Invalid Telephone Number.");
								error = true
							}
							if (error) {
								return false
							}
						}
						$
								.ajax({
									url : "/add-shipping-info/",
									data : $("#shippingSubmitForm").serialize(),
									type : "POST",
									dataType : "json",
									success : function(response) {
										if (response.err == null) {
											if (response.reload) {
												window.location = window.location;
												return
											} else {
												$("#showShippingAddress").html(
														response.shipping_addr)
														.show();
												$("#addShippingAddress")
														.remove();
												$("#changeShippingAddress")
														.show();
												$("#fabModal .closeModal")
														.trigger("click")
											}
										} else {
											if (response.err == "err1") {
												msg = "Please provide mandatory values"
											} else {
												msg = "Something went wrong. Please try after some time."
											}
										}
										if (msg != "") {
											fabMsgHandler("errMsg" + uniqId,
													"error", msg)
										}
									},
									error : function() {
									}
								});
						_gaq.push([ "_trackPageview", "/add-shipping-info/" ])
					});
	FabModule.AccountBase
			.method(
					"cancelOrderProduct",
					function(order_id, order_product) {
						$("#fabModal")
								.modal(
										{
											content : "<div style='padding: 8px 8px 25px 15px; font-size: 24px; font-weight: bold; color: #333;'>Are you sure you want to cancel?</div><div style='margin-bottom: 15px;'><a href='javascript:void(0)' id='cancelOrderProducts' class='changePwdButton'>Yes</a><a href='javascript:void(0)' id='reject_cancel' class='changePwdButton'>No</a></div>",
											modalSize : "cancelOrder",
											onOpen : function() {
												$("#cancelOrderProducts")
														.click(
																function() {
																	$
																			.ajax({
																				url : "/cancel-order/",
																				data : {
																					order_id : order_id,
																					order_product_id : order_product
																				},
																				type : "POST",
																				dataType : "json",
																				success : function(
																						response) {
																					if (response.err == null) {
																						window.location = window.location
																					} else {
																						$(
																								"#fabModal .closeModal")
																								.trigger(
																										"click");
																						$(
																								"#order-error-"
																										+ order_id)
																								.show()
																					}
																				},
																				error : function() {
																					$(
																							"#fabModal .closeModal")
																							.trigger(
																									"click");
																					$(
																							"#order-error-"
																									+ order_id)
																							.show()
																				}
																			})
																});
												$("#reject_cancel")
														.click(
																function() {
																	$(
																			"#fabModal .closeModal")
																			.trigger(
																					"click")
																})
											},
											onClose : function() {
											}
										})
					});
	FabModule.AccountBase.method("hourTimer", function(start_time, id) {
		var mins = (start_time % 60);
		var hours = Math.floor(start_time / 60);
		var hrs, minutes;
		setInterval(function() {
			if (hours > 0 || mins > 0) {
				if (hours < 10) {
					hrs = "0" + hours
				} else {
					hrs = hours
				}
				if (mins < 10) {
					minutes = "0" + mins
				} else {
					minutes = mins
				}
				$("#" + id).text(hrs + ":" + minutes);
				mins = mins - 1;
				if (mins < 0) {
					hours = hours - 1;
					mins = 59
				}
			} else {
				var remove_timer_id = id.replace("time_", "");
				var arr = id.split("_");
				var order_id = arr[arr.length - 1];
				$("#" + remove_timer_id).remove();
				$("#shipping_" + order_id).remove()
			}
		}, 60000)
	});
	FabModule.AccountBase
			.method(
					"fabTimer",
					function(start_time) {
						$("body")
								.timer(
										{
											from : start_time,
											end : function() {
												if ($("#cartNav").length > 0) {
													$("#sCart li")
															.not(
																	"#sCartTimer, .cartLast")
															.remove();
													$("#sCartTimer")
															.before(
																	'<li class="cartEmpty">There are no items in your cart</li>');
													$(".cartLast #proceedToCO")
															.remove()
												}
											},
											tick : function(sec) {
												if (sec <= 120) {
													if (sec == 120) {
														var $sCart = $("#sCart"), cart_timeout = null, cart_hide = function() {
															$sCart.fadeOut()
														};
														$("html, body")
																.animate(
																		{
																			scrollTop : 0
																		},
																		"slow");
														if ($sCart
																.is(":hidden")) {
															$sCart.fadeIn()
														}
														clearTimeout(cart_timeout);
														cart_timeout = null;
														cart_timeout = setTimeout(
																cart_hide,
																20000);
														Helper
																.hideDomOnClick(
																		$sCart,
																		[ "addToCart" ],
																		function(
																				$dom) {
																			clearTimeout(cart_timeout);
																			cart_timeout = null
																		})
													}
													$("#sCartTimer").addClass(
															"runningOut")
												}
												var mins = Math.floor(sec / 60), secs = sec % 60;
												$(".fabReserveTimer")
														.text(
																(mins > 9 ? mins
																		: "0"
																				+ mins)
																		+ " : "
																		+ (secs > 9 ? secs
																				: "0"
																						+ secs))
											}
										})
					});
	FabModule.AccountBase.method("deactivate_ac_LB", function() {
		var self = this;
		$.ajax({
			url : "/deactivate-account/",
			data : {},
			type : "GET",
			dataType : "html",
			success : function(response) {
				if (response != "") {
					$("#fabModal").modal({
						content : response,
						modalSize : "deactivateAccountLB",
						onOpen : function() {
							$.switchDefTxt();
							$("#deactivateAccountForm").submit(function(e) {
								e.preventDefault();
								self.deactivateAccount()
							})
						},
						onClose : function() {
						}
					})
				}
			},
			error : function() {
			}
		})
	});
	FabModule.AccountBase
			.method(
					"deactivateAccount",
					function() {
						var deactivateReason = $("#deactivateReason").val(), reasonText = $(
								"#deactivateReasonText").val();
						if (reasonText == "The reason being...") {
							reasonText = ""
						}
						$
								.ajax({
									url : "/deactivate-account/",
									data : {
										deactivate_reason : deactivateReason,
										reason_text : reasonText
									},
									type : "POST",
									dataType : "html",
									success : function(response) {
										if (response.err == null) {
											window.location = "/"
										} else {
											Helper
													.showMessage(
															"#deactivateAccountMsgBox",
															"success",
															"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Oops..Something went wrong. Please try again later.",
															{
																delay : 3000
															})
										}
									},
									error : function() {
										Helper
												.showMessage(
														"#deactivateAccountMsgBox",
														"success",
														"<span class='errorIcon fabShopSprite' style='margin-top: -4px;'></span>Oops..Something went wrong. Please try again later.",
														{
															delay : 3000
														})
									}
								})
					});
	FabModule.AccountBase.method("afterFBLike", function(activity, sale_id,
			product_id, inspiration_id, href) {
		$.ajax({
			url : "/after-fb-like",
			data : {
				activity : activity,
				sale_id : sale_id,
				product_id : product_id,
				inspiration_image_id : inspiration_id,
				href : href
			},
			type : "POST",
			success : function(r) {
				if (r.err == null) {
				}
			},
			complete : function() {
			}
		})
	});
	FabModule.AccountBase.method("afterGPlus", function(activity, sale_id,
			product_id, inspiration_id, href) {
		$.ajax({
			url : "/after-gplus",
			data : {
				activity : activity,
				sale_id : sale_id,
				product_id : product_id,
				inspiration_image_id : inspiration_id,
				href : href
			},
			type : "POST",
			success : function(r) {
				if (r.err == null) {
				}
			},
			complete : function() {
			}
		})
	});
	FabModule.AccountBase.method("showAppDownloadLB", function(device) {
		if (device === "") {
			return
		}
		$.ajax({
			url : "/fab-app-download-lb/",
			data : {
				device : device
			},
			type : "GET",
			dataType : "html",
			success : function(response) {
				if (response != "") {
					$("body").append(response);
					$("#over-lay").css("min-height",
							$("#fabWrapper").height() + 98);
					$("#appDldFlwDownWrap").animate({
						top : "-3px"
					}, 2000, function() {
						$("#over-lay").show()
					});
					$("#dismissFlyDown").click(function() {
						$("#over-lay").hide();
						$("#appDldFlwDownWrap").animate({
							top : "-3000px"
						}, 2000, function() {
							$("#appDldFlwDownWrap").hide();
							$.cookie("dfd", 1, {
								expires : 1,
								path : "/"
							})
						})
					})
				}
			}
		})
	});
	FabModule.AccountBase.method("featchImageForShops", function() {
		var self = this, $originalImage = $("#originalImage");
		$.ajax({
			url : "/index-shop-strip/",
			type : "POST",
			dataType : "json",
			data : {
				exclude_shops : $("#displayedShops").val()
			},
			success : function(res) {
				var noOfPages = parseInt(((res.shop_list).length / 5), 10);
				if (parseInt(((res.shop_list).length % 5), 10) > 0) {
					noOfPages = noOfPages + 1
				}
				if (noOfPages > 0) {
					noOfPages++;
					self.appendShopsToList(5, res.shop_list);
					$("#featuredAlbumSlidesContainer").slider({
						dimensions : [ 840, 160 ],
						prevButton : "#nextButton",
						nextButton : "#prvButton",
						pages : noOfPages,
						onClickRightOnce : function(r) {
							self.appendShopsToList(5, res.shop_list);
							$originalImage.addClass("displayNone")
						}
					})
				}
			}
		})
	});
	FabModule.AccountBase
			.method(
					"appendShopsToList",
					function(total_to_append, imagesList) {
						var self = this;
						var addList = imagesList.splice(0, total_to_append);
						for ( var i = 0; i < addList.length; i++) {
							var shop_url, shopName = ((addList[i].shop_name).length > 17 ? (addList[i].shop_name)
									.substring(0, 15)
									+ "..."
									: (addList[i].shop_name)), shop_link_text;
							if (addList[i].type == "popup_shop") {
								shop_url = "/sale/";
								shop_link_text = addList[i].shop_id
							} else {
								if (addList[i].type == "weekly_shop") {
									shop_url = "/weekly-shops/";
									shop_link_text = addList[i].shop_name
											.toLowerCase()
								} else {
									shop_url = "/shops/";
									shop_link_text = addList[i].shop_id
								}
							}
							var shop_type_title;
							if (addList[i].type == "popup_shop") {
								shop_type_title = '<span class="floatLeft popUpShopTitle"><span class="floatLeft popTitleWrap"><em class="popShopTitle" >Pop-up Shop</em><h3 class=""><span class="mainTitlePopUp">'
										+ shopName
										+ "</span></h3></span></span>"
							} else {
								if (addList[i].type == "weekly_shop") {
									shop_type_title = '<span class="floatLeft popUpShopTitle"><span class="floatLeft popTitleWrap"><em class="popShopTitle" >Weekly Shop</em><h3 class=""><span class="mainTitlePopUp">'
											+ shopName
											+ "</span></h3></span></span>"
								} else {
									shop_type_title = '<span class="floatLeft"><h3>'
											+ shopName + "</h3></span>"
								}
							}
							$("#foundImages")
									.append(
											"<li class='alignCenter foundImagesSlide poRel'><a data-img-url='' class='gimg' href='"
													+ shop_url
													+ shop_link_text
													+ "/'><img alt='' src='"
													+ addList[i].image_url
													+ "'/><span class='imgInfoBottom imgInfoBottomShopsMain'>"
													+ shop_type_title
													+ "</span></a></li>")
						}
						self.featuredShopSlider()
					});
	FabModule.AccountBase
			.method(
					"featuredShopSlider",
					function() {
						$("#foundImages li ")
								.mouseenter(
										function() {
											var $this = $(this);
											var newBottomDesc = [
													'<span class="viewDet floatRight round20 fabGrad">',
													'<span class="fabShopSprite gtIcon imgInfoArrow"></span>',
													"</span>" ].join("");
											var x = $this.position().left;
											$("#foundImages").addClass(
													"newOpacity");
											$("#originalImage")
													.html(
															$this
																	.html()
																	.replace(
																			"imgInfoBottomShopsMain",
																			"imgInfoBottomShops"))
													.css({
														left : x - 40
													}).removeClass(
															"displayNone");
											$("#originalImage a .imgInfoBottom")
													.append(newBottomDesc)
										});
						$("#originalImage").mouseleave(function() {
							$("#originalImage").addClass("displayNone");
							$("#foundImages").removeClass("newOpacity")
						})
					});
	FabModule.AccountBase.method("emailPrefPreview", function() {
		$("span[data-model-preview]").live("click", function(e) {
			var previewFor = $(this).attr("data-model-preview");
			e.preventDefault;
			e.stopPropogation;
			$.ajax({
				url : "/get-email-pref-preview/",
				type : "POST",
				data : {
					prev_for : previewFor
				},
				dataType : "json",
				success : function(response) {
					if (response.err == null) {
						$("#fabModal").modal({
							content : response.lb_content,
							modalSize : "previewEmailMailContent",
							onOpen : function() {
							}
						})
					} else {
					}
				},
				error : function() {
				}
			})
		})
	});
	return FabModule
})(FabModule);
/*
 * ! Smooth Scrolling jQuery Plugin v1.4 @link
 * http://github.com/mathiasbynens/Smooth-Scrolling-jQuery-Plugin @author
 * Mathias Bynens <http://mathiasbynens.be/>
 */
(function(a) {
	a.fn.smoothScroll = function(b, d, c) {
		b = ~~b || 400;
		d = d || 0;
		this
				.find("a[href*=#]")
				.click(
						function(h) {
							h.stopPropagation();
							h.preventDefault();
							var f = a(this);
							var e = a.browser.opera ? a("html")
									: a("html, body"), g = a(this.hash);
							if (location.pathname.replace(/^\//, "") === this.pathname
									.replace(/^\//, "")
									&& location.hostname === this.hostname) {
								if (g.length) {
									e.stop().animate({
										scrollTop : g.offset().top + d
									}, b, function() {
										if (typeof (c) === "function") {
											c(f)
										}
									})
								}
							}
						});
		return this
	}
})(jQuery);