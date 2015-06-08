/* Water&Electric Manager
 * @author            PhanthomParticle
 * @version           1.0.0
 * @last-time         2015.6.7
 */

$(document).ready(function() {
	iframeInitialize(iframe);
});


// iframe 初始化
// @para: [iframName]
function iframeInitialize (iframeName) {
	var iframe,
		iframeHeight = (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight) - 50 + 'px';
	iframeName ? iframe = $("iframe[name=iframeName]") : iframe = $("iframe");
	iframe.css('height', iframeHeight);
}