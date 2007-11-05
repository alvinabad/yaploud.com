YAHOO.widget.ResizePanel = function(el, userConfig) {
	if (arguments.length > 0) {
		YAHOO.widget.ResizePanel.superclass.constructor.call(this, el, userConfig);
	}
}

YAHOO.widget.ResizePanel.CSS_PANEL_RESIZE = "yui-resizepanel";
YAHOO.widget.ResizePanel.CSS_RESIZE_HANDLE = "resizehandle";
YAHOO.extend(YAHOO.widget.ResizePanel, YAHOO.widget.Panel, {
	init: function(el, userConfig) {
		YAHOO.widget.ResizePanel.superclass.init.call(this, el);
		this.beforeInitEvent.fire(YAHOO.widget.ResizePanel);
		var Dom = YAHOO.util.Dom,
		Event = YAHOO.util.Event,
		oInnerElement = this.innerElement,
		oResizeHandle = document.createElement("DIV"),
		sResizeHandleId = this.id + "_resizehandle";
		oResizeHandle.id = sResizeHandleId;
		oResizeHandle.className = YAHOO.widget.ResizePanel.CSS_RESIZE_HANDLE;
		Dom.addClass(oInnerElement, YAHOO.widget.ResizePanel.CSS_PANEL_RESIZE);
		this.resizeHandle = oResizeHandle;
		function initResizeFunctionality() {
			var me = this, oHeader = this.header, oBody = this.body, oFooter = this.footer, nStartWidth, nStartHeight, aStartPos, nBodyBorderTopWidth, nBodyBorderBottomWidth, nBodyTopPadding, nBodyBottomPadding, nBodyOffset;
			oInnerElement.appendChild(oResizeHandle);
			this.ddResize = new YAHOO.util.DragDrop(sResizeHandleId, this.id);
			this.ddResize.setHandleElId(sResizeHandleId);
			this.ddResize.onMouseDown = function(e) {
				nStartWidth = oInnerElement.offsetWidth; nStartHeight = oInnerElement.offsetHeight;
				if ( YAHOO.env.ua.ie && document.compatMode == "BackCompat") {
					nBodyOffset = 0;
				}
				else a
					{ nBodyBorderTopWidth = parseInt(Dom.getStyle(oBody, "borderTopWidth"), 10), nBodyBorderBottomWidth = parseInt(Dom.getStyle(oBody, "borderBottomWidth"), 10), nBodyTopPadding = parseInt(Dom.getStyle(oBody, "paddingTop"), 10), nBodyBottomPadding = parseInt(Dom.getStyle(oBody, "paddingBottom"), 10), nBodyOffset = nBodyBorderTopWidth + nBodyBorderBottomWidth + nBodyTopPadding + nBodyBottomPadding; } me.cfg.setProperty("width", nStartWidth + "px"); aStartPos = [Event.getPageX(e), Event.getPageY(e)]; }; this.ddResize.onDrag = function(e) { var aNewPos = [Event.getPageX(e), Event.getPageY(e)], nOffsetX = aNewPos[0] - aStartPos[0], nOffsetY = aNewPos[1] - aStartPos[1], nNewWidth = Math.max(nStartWidth + nOffsetX, 10), nNewHeight = Math.max(nStartHeight + nOffsetY, 10), nBodyHeight = (nNewHeight - (oFooter.offsetHeight + oHeader.offsetHeight + nBodyOffset)); me.cfg.setProperty("width", nNewWidth + "px"); if (nBodyHeight < 0) { nBodyHeight = 0; } oBody.style.height =  nBodyHeight + "px"; }; } function onBeforeShow() { initResizeFunctionality.call(this); this.unsubscribe("beforeShow", onBeforeShow); } function onBeforeRender() { if (!this.footer) { this.setFooter(""); } if (this.cfg.getProperty("visible")) { initResizeFunctionality.call(this); } else { this.subscribe("beforeShow", onBeforeShow); } this.unsubscribe("beforeRender", onBeforeRender); } this.subscribe("beforeRender", onBeforeRender); if (userConfig) { this.cfg.applyConfig(userConfig, true); } this.initEvent.fire(YAHOO.widget.ResizePanel); }, toString: function() { return "ResizePanel " + this.id; } }
); 
