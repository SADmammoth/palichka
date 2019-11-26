function close_dropdown(el) {
  let curr = el;

  while (!curr.classList.contains("dropdown")) {
    curr = curr.parentElement;
  }
  // console.log(curr.querySelector('.dropdown-trigger'));
  curr.querySelector(".dropdown-trigger").checked = false;
  curr.querySelector(".dropdown-trigger").form.reset();
  // el.form.submit();
}

function show_additional_gallery(button, gallery_id, ...items_to_hide) {
  document.body.querySelector(gallery_id).classList.remove("hidden");
  items_to_hide.forEach(item => {
    if (typeof item === "string") {
      document.body.querySelector(item).classList.add("hidden");
    } else {
      console.log(item);
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
