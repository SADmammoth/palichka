function like(checkbox, post_id, user_id) {
  let likes = checkbox.form.getElementsByClassName("like_counter")[0];
  if (checkbox.checked) {
    fetch(checkbox.form.action, {
      method: "POST",
      "content-type": "application/json",
      body: `{"liked": true, "post": ${post_id}, "user": ${user_id}}`
    });
    //.then(response => response.text().then(text => alert(text)));
    likes.innerText = eval(likes.innerText + "+1");
  } else {
    fetch(checkbox.form.action, {
      method: "POST",
      "content-type": "application/json",
      body: `{"liked": false, "post": ${post_id}, "user": ${user_id}}`
    });
    //.then(response => response.text().then(text => alert(text)));
    if (likes.innerText !== "0") {
      likes.innerText = eval(likes.innerText + "-1");
    }
  }
}
