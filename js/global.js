(function(j){var i=j(window),h,p,c=-1,d,w,z,g,H,x,o,l=!window.XMLHttpRequest,s=[],F=document.documentElement,q={},m=new Image(),n=new Image(),D,E,t,b,k,C;j(function(){j("body").append(j([D=j('<div id="lbOverlay" />').click(r)[0],E=j('<div id="lbCenter" />')[0]]).css("display","none"));t=j('<div id="lbImage" />').appendTo(E).append(b=j('<div style="position: relative;" />').append([k=j('<a id="lbPrevLink" href="#" />').click(e)[0],C=j('<a id="lbNextLink" href="#" />').click(v)[0]])[0])[0];});j.slimbox=function(K,J,I){h=j.extend({loop:false,overlayOpacity:0.95,overlayFadeDuration:400,resizeDuration:400,resizeEasing:"swing",initialWidth:250,initialHeight:250,imageFadeDuration:400,closeKeys:[27,88,67],previousKeys:[37,80],nextKeys:[39,78]},I);if(typeof K=="string"){K=[[K,J]];J=0;}H=i.scrollTop()+(i.height()/2);x=h.initialWidth;o=h.initialHeight;j(E).css({top:Math.max(0,H-(o/2))-120,width:x,height:o,marginLeft:-x/2}).show();g=l||(D.currentStyle&&(D.currentStyle.position!="fixed"));if(g){D.style.position="absolute";}j(D).css("opacity",h.overlayOpacity).fadeIn(h.overlayFadeDuration);G();u(1);p=K;h.loop=h.loop&&(p.length>1);return A(J);};j.fn.slimbox=function(I,L,K){L=L||function(M){return[M.href,M.title];};K=K||function(){return true;};var J=this;return J.unbind("click").click(function(){var O=this,Q=0,P,M=0,N;P=j.grep(J,function(S,R){return K.call(O,S,R);});for(N=P.length;M<N;++M){if(P[M]==O){Q=M;}P[M]=L(P[M],M);}return j.slimbox(P,Q,I);});};function G(){var J=i.scrollLeft(),I=i.width();j([E]).css("left",J+(I/2));if(g){j(D).css({left:J,top:i.scrollTop(),width:I,height:i.height()});}}function u(I){if(I){j("object").add(l?"select":"embed").each(function(K,L){s[K]=[L,L.style.visibility];L.style.visibility="hidden";});}else{j.each(s,function(K,L){L[0].style.visibility=L[1];});s=[];}var J=I?"bind":"unbind";i[J]("scroll resize",G);j(document)[J]("keydown",B);}function B(K){var J=K.which,I=j.inArray;return(I(J,h.closeKeys)>=0)?r():(I(J,h.nextKeys)>=0)?v():(I(J,h.previousKeys)>=0)?e():null;}function e(){return A(w);}function v(){return A(z);}function A(I){if(I>=0){c=I;d=p[c][0];w=(c||(h.loop?p.length:0))-1;z=((c+1)%p.length)||(h.loop?0:-1);y();E.className="lbLoading";showLoadingBar();q=new Image();q.onload=f;q.src=d;}return false;}function f(){E.className="";hideLoadingBar();j(t).css({backgroundImage:"url("+d+")",visibility:"hidden",display:"","background-size":"100%"});var L=q.width,I=q.height,J=i.width(),K=i.height();if(L>=J||I>=K){if(J>=K){j(b).width(K*0.8*L/I);j([b,k,C]).height(K*0.8);}else{j(b).width(J*0.8);j([b,k,C]).height(J*0.8*I/L);}}else{j(b).width(q.width);j([b,k,C]).height(q.height);}if(w>=0){m.src=p[w][0];}if(z>=0){n.src=p[z][0];}x=t.offsetWidth;o=t.offsetHeight;var M=Math.max(0,H-(o/2));if(E.offsetHeight!=o){j(E).animate({height:o,top:M},h.resizeDuration,h.resizeEasing);}if(E.offsetWidth!=x){j(E).animate({width:x,marginLeft:-x/2},h.resizeDuration,h.resizeEasing);}j(E).queue(function(){j(t).css({display:"none",visibility:"",opacity:""}).fadeIn(h.imageFadeDuration,a);});}function a(){if(w>=0){j(k).show();}if(z>=0){j(C).show();}}function y(){q.onload=null;q.src=m.src=n.src=d;j([E,t]).stop(true);j([k,C,t]).hide();}function r(){if(c>=0){y();c=w=z=-1;j(E).hide();j(D).stop().fadeOut(h.overlayFadeDuration,u);hideLoadingBar();}return false;}})(jQuery);jQuery(document).ready(initSlim());function initSlim(){jQuery(".slimbox").slimbox();}

jQuery.fn.postLike = function() {
	if ($(this).hasClass('done')) {
		showNotice('您已经赞过啦！');
		return false;
	} else {
		$(this).addClass('done');
		var id = $(this).data("id"),
		rateHolder = $(this).children('.love-count');
		var ajax_data = {
			action: "lo_like",
			um_id: id
		};
		$.post(ajax.ajax_url, ajax_data,
		function(data) {
			$(rateHolder).html(data);
		});
		return false;
	}
};
$(document).on("click", ".favorite",function() {$(this).postLike();});

jQuery(document).ready(function($) {
	var $commentform = $('#commentform'),
	txt1 = '<div id="loading"><img src="' + ajax.gif + '">正在提交, 请稍候...</div>',
	txt2 = '<div id="error">#</div>',
	txt3 = '">提交成功',
	edt1 = ', 刷新页面之前可以<a rel="nofollow" href="#edit" onclick=\'return addComment.moveForm("',
	edt2 = ')\'>再编辑</a>',
	cancel_edit = '取消编辑',
	edit,
	num = 1,
	$comments = $('#comments-title span'),
	$cancel = $('#cancel-comment-reply-link'),
	cancel_text = $cancel.text(),
	$submit = $('#commentform #submit');
	$submit.attr('disabled', false),
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body'),
	comm_array = [];
	comm_array.push('');
	$('#textarea_label').after(txt1 + txt2);
	$('#loading').hide();
	$('#error').hide();
	$(document).on("submit", "#commentform",
	function() {
		if (edit) $('#comment').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');
		editcode();
		$submit.attr('disabled', true).fadeTo('slow', 0.5);
		$('#loading').slideDown();
		showLoadingBar();
		$.ajax({
			url: ajax.ajax_url,
			data: $(this).serialize() + "&action=ajax_comment",
			type: $(this).attr('method'),
			error: function(request) {
				$('#loading').hide();
				hideLoadingBar();
				showNotice('提交评论失败');
				$("#error").slideDown().html(request.responseText);
				setTimeout(function() {
					$submit.attr('disabled', false).fadeTo('slow', 1);
					$('#error').slideUp();
				},
				3000);
			},
			success: function(data) {
				if ($(".reply-to-read").length > 0) {
					var ajax_data = {
						action: "ajax_post_content",
						id: $("#comment_post_ID").attr("value"),
					};
					$.post(ajax.ajax_url, ajax_data,
					function(data) {
						$(".entry-content").html(data);
					});
				}
				
				$('#loading').hide();
				$('.content-header-none .respond-overlay').fadeOut(300);
				hideLoadingBar();
				showNotice('成功提交评论');
				comm_array.push($('#comment').val());
				$('textarea').each(function() {
					this.value = ''
				});
				var t = addComment,
				cancel = t.I('cancel-comment-reply-link'),
				temp = t.I('wp-temp-form-div'),
				respond = t.I(t.respondId),
				post = t.I('comment_post_ID').value,
				parent = t.I('comment_parent').value;
				if (!edit && $comments.length) {
					n = parseInt($comments.text().match(/\d+/));
					$comments.text($comments.text().replace(n, n + 1));
				}
				new_htm = '" id="new_comm_' + num + '"></';
				new_htm = (parent == '0') ? ('\n<ol style="clear:both;" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');
				ok_htm = '\n<div class="ajax-notice" id="success_' + num + txt3;
				div_ = (document.body.innerHTML.indexOf('div-comment-') == -1) ? '': ((document.body.innerHTML.indexOf('li-comment-') == -1) ? 'div-': '');
				ok_htm = ok_htm.concat(edt1, div_, 'comment-', parent, '", "', parent, '", "respond", "', post, '", ', num, edt2);
				ok_htm += '</span><span></span>\n';
				ok_htm += '</div>\n';
				$('.responses').before(new_htm);
				$('#new_comm_' + num).append(data);
				/*$('#new_comm_' + num + ' li').append(ok_htm);*/
				$body.animate({
					scrollTop: $('#new_comm_' + num).offset().top - 200
				},
				900);
				countdown();
				num++;
				edit = '';
				$('*').remove('#edit_id');
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		});
		return false;
	});
	addComment = {
		moveForm: function(commId, parentId, respondId, postId, num) {
			var t = this,
			div,
			comm = t.I(commId),
			respond = t.I(respondId),
			cancel = t.I('cancel-comment-reply-link'),
			parent = t.I('comment_parent'),
			post = t.I('comment_post_ID');
			if (edit) exit_prev_edit();
			num ? (t.I('comment').value = comm_array[num], edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2], $new_sucs = $('#success_' + num), $new_sucs.hide(), $new_comm = $('#new_comm_' + num), $new_comm.hide(), $cancel.text(cancel_edit)) : $cancel.text(cancel_text);
			t.respondId = respondId;
			postId = postId || false;
			if (!t.I('wp-temp-form-div')) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			} ! comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
			$body.animate({
				scrollTop: $('#respond').offset().top - 180
			},
			400);
			if (post && postId) post.value = postId;
			parent.value = parentId;
			cancel.style.display = '';
			cancel.onclick = function() {
				if (edit) exit_prev_edit();
				var t = addComment,
				temp = t.I('wp-temp-form-div'),
				respond = t.I(t.respondId);
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp);
				}
				this.style.display = 'none';
				this.onclick = null;
				return false;
			};
			try {
				t.I('comment').focus();
			}
			 catch(e) {}
			return false;
		},
		I: function(e) {
			return document.getElementById(e);
		}
	};
	function exit_prev_edit() {
		$new_comm.show();
		$new_sucs.show();
		$('textarea').each(function() {
			this.value = ''
		});
		edit = '';
	}
	var wait = 15,
	submit_val = $submit.val();
	function countdown() {
		if (wait > 0) {
			$submit.val(wait);
			wait--;
			setTimeout(countdown, 1000);
		} else {
			$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
			wait = 15;
		}
	}
	function editcode() {
		var a = "",
		b = $("#comment").val(),
		start = b.indexOf("<code>"),
		end = b.indexOf("</code>");
		if (start > -1 && end > -1 && start < end) {
			a = "";
			while (end != -1) {
				a += b.substring(0, start + 6) + b.substring(start + 6, end).replace(/<(?=[^>]*?>)/gi, "&lt;").replace(/>/gi, "&gt;");
				b = b.substring(end + 7, b.length);
				start = b.indexOf("<code>") == -1 ? -6: b.indexOf("<code>");
				end = b.indexOf("</code>");
				if (end == -1) {
					a += "</code>" + b;
					$("#comment").val(a)
				} else if (start == -6) {
					myFielde += "&lt;/code&gt;"
				} else {
					a += "</code>"
				}
			}
		}
		var b = a ? a: $("#comment").val(),
		a = "",
		start = b.indexOf("<pre>"),
		end = b.indexOf("</pre>");
		if (start > -1 && end > -1 && start < end) {
			a = a
		} else return;
		while (end != -1) {
			a += b.substring(0, start + 5) + b.substring(start + 5, end).replace(/<(?=[^>]*?>)/gi, "&lt;").replace(/>/gi, "&gt;");
			b = b.substring(end + 6, b.length);
			start = b.indexOf("<pre>") == -1 ? -5: b.indexOf("<pre>");
			end = b.indexOf("</pre>");
			if (end == -1) {
				a += "</pre>" + b;
				$("#comment").val(a)
			} else if (start == -5) {
				myFielde += "&lt;/pre&gt;"
			} else {
				a += "</pre>"
			}
		}
	}
	function grin(a) {
		var b;
		a = " " + a + " ";
		if (document.getElementById("comment") && document.getElementById("comment").type == "textarea") {
			b = document.getElementById("comment")
		} else {
			return false
		}
		if (document.selection) {
			b.focus();
			sel = document.selection.createRange();
			sel.text = a;
			b.focus()
		} else if (b.selectionStart || b.selectionStart == "0") {
			var c = b.selectionStart;
			var d = b.selectionEnd;
			var e = d;
			b.value = b.value.substring(0, c) + a + b.value.substring(d, b.value.length);
			e += a.length;
			b.focus();
			b.selectionStart = e;
			b.selectionEnd = e
		} else {
			b.value += a;
			b.focus()
		}
	}
});

$(document).on("click", ".commentnav a",
    function() {
		showLoadingBar();
        var baseUrl = $(this).attr("href"),
        commentsHolder = $(".commentshow"),
        id = $(this).parent().data("postid"),
        page = 1,
        concelLink = $("#cancel-comment-reply-link");
        /comment-page-/i.test(baseUrl) ? page = baseUrl.split(/comment-page-/i)[1].split(/(\/|#|&).*jQuery/)[0] : /cpage=/i.test(baseUrl) && (page = baseUrl.split(/cpage=/)[1].split(/(\/|#|&).*jQuery/)[0]);
        concelLink.click();
        var ajax_data = {
            action: "ajax_comment_page_nav",
            um_post: id,
            um_page: page
        };
		commentsHolder.html('<div>loading..</div>');
		jQuery("body, html").animate({
                scrollTop: commentsHolder.offset().top - 150
            },
            1e3);
        //add loading
        jQuery.post(ajax.ajax_url, ajax_data,
        function(data) {
            commentsHolder.html(data);
            //remove loading
            $("body, html").animate({
                scrollTop: commentsHolder.offset().top - 50
            },
            1e3);
			hideLoadingBar();
        });
        return false;
    });
jQuery(window).scroll(function() {
	jQuery(this).scrollTop() > 800 ? jQuery("#gotop").css({
		bottom: "80px"
	}) : jQuery("#gotop").css({
		bottom: "-80px"
	})
});
jQuery("#gotop").click(function() {
	return jQuery("body,html").animate({
		scrollTop: 1
	},
	800),
	!1
});
jQuery(document).on('click', '.show-form', 
function() {
	jQuery('#comment-info').toggle(300);
});
function showNotice(message) {
	clearNotice();
	$('body').append('<div class="notice">' + message + '</div>');
	setTimeout("clearNotice()", 2000);
}
function clearNotice() {
	if ($(".notice").length > 0) {
		$(".notice").remove();
	}
}
function showLoadingBar() {
	$('.loading-bar').show();
}
function hideLoadingBar() {
	$('.loading-bar').hide();
}
var _last = 0;
jQuery(window).scroll(function() {
	var _top = jQuery(this).scrollTop();
	if ( _top < _last && _top > 200) {
		jQuery('#header').removeClass('slideUp');
		jQuery('#header').removeClass('standard');
		jQuery('#header').addClass('slideDown');
	} else if ( _top > _last && _top > 200){
		jQuery('#header').removeClass('slideDown');
		jQuery('#header').removeClass('standard');
		jQuery('#header').addClass('slideUp');
	} else {
		jQuery('#header').removeClass('slideUp');
		jQuery('#header').removeClass('slideDown');
		jQuery('#header').addClass('standard');
	}
	_last = jQuery(this).scrollTop();
});

$(window).load(function() {
	hideLoadingBar();
});

jQuery(document).ready(function($) {
	
});