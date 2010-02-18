if (!UserVoice) {
  var UserVoice = {}
}

if (!UserVoice.Util) {
UserVoice.Util = {
	sslAssetHost: "https://uservoice.com",
	assetHost: "http://cdn.uservoice.com",
  getAssetHost: function() {
    return ("https:" == document.location.protocol) ? this.sslAssetHost : this.assetHost
  },
  requireCss: function(path) {
	  document.write('<style type="text/css" media="screen">@import url(\'' + this.getAssetHost() + '/stylesheets/' + path + '\');</style>')
  },
  requireJs: function(path) {
		document.write('<script type="text/javascript" src=\'' + this.getAssetHost() + '/javascripts/' + path  + '\'></script>')
  },
  render: function(template, params) {
    return template.replace(/\#{([^{}]*)}/g,
      function (a, b) {
          var r = params[b]
          return typeof r === 'string' || typeof r === 'number' ? r : a
      }
    )
  },
  toQueryString: function(params) {
	  var pairs = []
	  for (key in params) { 
		  if (params[key] != null && params[key] != '') {
  		  pairs.push([key, params[key]].join('='))
      }
    }
    return pairs.join('&')
  }
}
}

UserVoice.Page = {
  getDimensions: function() {
    var de = document.documentElement
    var width = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth
    var height = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight
    return {width: width, height: height}
  }
}

UserVoice.Dialog = {
  show: function(id_or_html) {
    var element = document.getElementById(id_or_html)
    var html = (element == null) ? id_or_html : element.innerHTML

    this.Overlay.show()
    this.setContent(html)
    this.setPosition()
    UserVoice.Element.addClassName(this.htmlElement(), 'dialog-open')
    this.element().style.display = 'block'
  },

  close: function() {
    this.element().style.display = 'none'
    UserVoice.Element.removeClassName(this.htmlElement(), 'dialog-open')
    this.Overlay.hide()
    UserVoice.onClose()
  },

  /****** Protected Methods ******/

  id: 'uservoice-dialog',
	css_template: "a#uservoice-dialog-close { background-image: url(#{background_image_url}); }",

  element: function() {
    if (!document.getElementById(this.id)){
      var dummy = document.createElement('div')
      dummy.innerHTML = '<div id="'+this.id+'" class="uservoice-component" style="display:none;">' + 
        '<a href="#" onclick="UserVoice.Dialog.close(); return false;" id="'+this.id+'-close"></a>' + 
        '<div id="'+this.id+'-content"></div></div>'
      document.body.appendChild(dummy.firstChild)
    }
    return document.getElementById(this.id)
  },

  setContent: function(html) {
    this.element() // lazily created
    if (typeof(Prototype) != 'undefined') { // gracefully degredation in the absence of Prototype.js
      document.getElementById(this.id+"-content").innerHTML = html.stripScripts()
      setTimeout(function() {html.evalScripts()}, 100)
    } else {
      document.getElementById(this.id+"-content").innerHTML = html
    }
  },

  setPosition: function() {
    var dialogDimensions = UserVoice.Element.getDimensions(this.element())
    var pageDimensions = UserVoice.Page.getDimensions()

    var els = this.element().style
    els.width = 'auto'
    els.height = 'auto'
    els.left = ((pageDimensions.width - dialogDimensions.width)/2) + "px"
    els.top = ((pageDimensions.height - dialogDimensions.height)/2) + "px"
  },

  htmlElement: function() {
    return document.getElementsByTagName('html')[0]
  }
}

UserVoice.Dialog.Overlay = {

  show: function() {
    this.element().style.display = 'block'
  },

  hide: function() {
    this.element().style.display = 'none'
  },

  /****** Protected Methods ******/

  id: 'uservoice-overlay',

  element: function() {
    if (!document.getElementById(this.id)){
      var dummy = document.createElement('div')
      dummy.innerHTML = '<div id="'+this.id+'" class="uservoice-component" onclick="UserVoice.Dialog.close(); return false;" style="display:none;"></div>'
      document.body.appendChild(dummy.firstChild)
    }
    return document.getElementById(this.id)
  }
}

// Culled from Prototype.js
UserVoice.Element = {
  getDimensions: function(element) {
    var display = element.display
    if (display != 'none' && display != null) // Safari bug
      return {width: element.offsetWidth, height: element.offsetHeight}

    // All *Width and *Height properties give 0 on elements with display none,
    // so enable the element temporarily
    var els = element.style
    var originalVisibility = els.visibility
    var originalPosition = els.position
    var originalDisplay = els.display
    els.visibility = 'hidden'
    els.position = 'absolute'
    els.display = 'block'
    var originalWidth = element.clientWidth
    var originalHeight = element.clientHeight
    els.display = originalDisplay
    els.position = originalPosition
    els.visibility = originalVisibility
    return {width: originalWidth, height: originalHeight}
  },

  hasClassName: function(element, className) {
    var elementClassName = element.className
    return (elementClassName.length > 0 && (elementClassName == className ||
      new RegExp("(^|\\s)" + className + "(\\s|$)").test(elementClassName)))
  },

  addClassName: function(element, className) {
    if (!this.hasClassName(element, className))
      element.className += (element.className ? ' ' : '') + className
    return element
  },

  removeClassName: function(element, className) {
    element.className = element.className.replace(
      new RegExp("(^|\\s+)" + className + "(\\s+|$)"), ' ')
    return element
  }
}

UserVoice.onClose = function() {}

// Load CSS and images
UserVoice.Util.requireCss('lib/dialog.css')
document.write('<style type="text/css">' + UserVoice.Util.render(UserVoice.Dialog.css_template, {background_image_url: UserVoice.Util.getAssetHost()+'/images/icons/close.png'}) + '</style>')