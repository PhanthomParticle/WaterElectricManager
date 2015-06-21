/* Water&Electric Manager
 * @author            PhanthomParticle
 * @version           1.0.0
 * @last-time         2015.6.7
 */
var lastobj=null;
$(document).ready(function() {
	$("#header a").click(function(){
		if(lastobj!=null){
			lastobj.removeClass("active");
		}
		$(this).addClass("active");
		$("#iframe").attr( "src",$(this).attr("href") );
		lastobj=$(this);
		return false;
	});
});