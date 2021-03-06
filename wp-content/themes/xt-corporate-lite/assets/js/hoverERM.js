! function(a) {
	a.fn.hoverIntent = function(b, c, d) {
		var e = {
			interval: 100,
			sensitivity: 6,
			timeout: 0
		};
		e = "object" == typeof b ? a.extend(e, b) : a.isFunction(c) ? a.extend(e, {
			over: b,
			out: c,
			selector: d
		}) : a.extend(e, {
			over: b,
			out: b,
			selector: c
		});
		var f, g, h, i, j = function(a) {
			f = a.pageX, g = a.pageY
		}, k = function(b, c) {
			return c.hoverIntent_t = clearTimeout(c.hoverIntent_t), Math.sqrt((h - f) * (h - f) + (i - g) * (i - g)) < e.sensitivity ? (a(c).off("mousemove.hoverIntent", j), c.hoverIntent_s = !0, e.over.apply(c, [b])) : (h = f, i = g, c.hoverIntent_t = setTimeout(function() {
				k(b, c)
			}, e.interval), void 0)
		}, l = function(a, b) {
			return b.hoverIntent_t = clearTimeout(b.hoverIntent_t), b.hoverIntent_s = !1, e.out.apply(b, [a])
		}, m = function(b) {
			var c = a.extend({}, b),
				d = this;
			d.hoverIntent_t && (d.hoverIntent_t = clearTimeout(d.hoverIntent_t)), "mouseenter" === b.type ? (h = c.pageX, i = c.pageY, a(d).on("mousemove.hoverIntent", j), d.hoverIntent_s || (d.hoverIntent_t = setTimeout(function() {
				k(c, d)
			}, e.interval))) : (a(d).off("mousemove.hoverIntent", j), d.hoverIntent_s && (d.hoverIntent_t = setTimeout(function() {
				l(c, d)
			}, e.timeout)))
		};
		return this.on({
			"mouseenter.hoverIntent": m,
			"mouseleave.hoverIntent": m
		}, e.selector)
	}
}(jQuery);