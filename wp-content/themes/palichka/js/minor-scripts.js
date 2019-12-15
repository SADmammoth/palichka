function close_dropdown(el, cancel = false, submit = true) {
  let curr = el;

  while (!curr.classList.contains("dropdown")) {
    curr = curr.parentElement;
  }
  // console.log(curr.querySelector('.dropdown-trigger'));
  curr.querySelector(".dropdown-trigger").checked = false;
  if (submit) {
    el.form.submit();
  }
  if (cancel) {
    curr.querySelector(".dropdown-trigger").form.reset();
  }
}

function show_additional_gallery(button, gallery_id, ...items_to_hide) {
  document.body.querySelector(gallery_id).classList.remove("hidden");
  items_to_hide.forEach(item => {
    if (typeof item === "string") {
      document.body.querySelector(item).classList.add("hidden");
    } else {
      item.classList.add("hidden");
    }
  });
}

function hide_additional_gallery(button, gallery_id, ...items_to_show) {
  document.body.querySelector(gallery_id).classList.add("hidden");
  items_to_show.forEach(item => {
    if (typeof item === "string") {
      document.body.querySelector(item).classList.remove("hidden");
    } else {
      item.classList.remove("hidden");
    }
  });
}

function show_message(form, selector) {
  form.querySelector(selector).style.display = "block";
  setTimeout(
    (form, selector) => {
      form.querySelector(selector).style.display = "none";
      form.submit();
    },
    1000,
    form,
    selector
  );
}
