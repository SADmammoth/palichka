function like(checkbox, post_id, user_id) {
  if (checkbox.checked) {
    fetch(checkbox.form.action, {
      method: "POST",
      "content-type": "application/json",
      body: `{"liked": true, "post": ${post_id}, "user": ${user_id}}`
    }).then(response => response.text().then(text => alert(text)));
  } else {
    fetch(checkbox.form.action, {
      method: "POST",
      "content-type": "application/json",
      body: `{"liked": false, "post": ${post_id}, "user": ${user_id}}`
    }).then(response => response.text().then(text => alert(text)));
  }
}
