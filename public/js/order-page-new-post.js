function showNewPost(check) {
  var newPostBlock = document.getElementById("newPostBlock");
  if (check == true) {
    newPostBlock.style.display = "block";
  } else {
    newPostBlock.style.display = "none";
  }
}
(function(){
	var radioBox = document.getElementById("delivery2");
	if (radioBox.checked == true) {
	    showNewPost(true)
	} else {
		showNewPost(false)
	}
})();