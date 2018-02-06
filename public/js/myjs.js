function showToast(text, color = '#009936'){
	var x = document.getElementById("snackbar");
	x.innerHTML = text;
	x.style.backgroundColor = color;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function deleteComment(element){
	if(confirm('Delete this comment? You CANNOT UNDO this.') == true){
		// var link = element.parentNode.lastChild;
		// $(link)[0].click();
		var commentId = element.parentNode.lastChild.innerHTML;
		var divtodelete = element.parentNode.parentNode.parentNode.parentNode;

		$.post(deleteRoute, {'id': commentId, '_token': token}, function(data) {
			if(data == "Success")
			{
				$(divtodelete).remove();
				showToast("Comment deleted");
			}
		});
	}
}

function editComment(element){
	var formEditComment = element.parentNode.parentNode.parentNode.querySelector("#formEditComment");
	var commentbodyP = formEditComment.parentNode.querySelector("#commentbody");
	var oldCommentBody = $(commentbodyP).html();
	commentbodyP.style.display = "none";
	$(formEditComment.firstChild).val(oldCommentBody);
	formEditComment.style.display = "block";
}

function saveCommentEdit(element){
	var comment_body = element.parentNode.firstChild.value;
	var comment_id = $(element.parentNode.parentNode.querySelector("#comment_id")).html();
	var commentbodyP = element.parentNode.parentNode.querySelector("#commentbody");
	
	if(comment_body != "")
	{
		$.post(editRoute, {'comment_body': comment_body, 'id': comment_id, '_token': token}, function(data) {
			$(element.parentNode).hide();
			if(data != "Failed"){
				$(commentbodyP).html(data)
				$(commentbodyP).show();
				showToast('Comment edited');
			}else{
				$(commentbodyP).show();
				showToast("Failed. Please try later.");
			}
		});
	}else{
		element.parentNode.firstChild.focus();
	}
}

function disableEditComment(element){
	var form = element.parentNode;
	var commentP = form.parentNode.querySelector("#commentbody");
	form.style.display = "none";
	commentP.style.display = "block";
}

// function enableDisableConfirm(element){
// 	var btnConfirm = element.parentNode.parentNode.lastChild;
// 	if(element.value.length >= 4){
// 		$(btnConfirm).prop('disabled', false);
// 	}else{
// 		$(btnConfirm).prop('disabled', true);
// 	}
// }

function confirmPassword(element){
	var email = element.parentNode.firstChild.firstChild.value;
	var password = element.parentNode.firstChild.lastChild.value;
	element.parentNode.firstChild.lastChild.value = "";
	var divtodisplay = document.getElementById("passEditing");
	var cancelPassChanging = document.getElementById("cancelPassChanging");
	// $("#changepasstext").css('display', 'none');
	// divtodisplay.style.display = "block";

	$.post(confirmPassRoute, {'email': email, 'password': password, '_token':token}, function(data) {
		if(data == 'true'){
			$("#changepasstext").css('display', 'none');
			cancelPassChanging.style.display = "block";
			divtodisplay.style.display = "block";
		}else{
			showToast('Wrong password', 'red');
		}
	});
}