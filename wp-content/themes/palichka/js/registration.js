function check_submit(form, signin = true) {
  event.preventDefault();
  // form.onsubmit = () => event.preventDefault();
  // form.submit = () => event.preventDefault();
  console.log(
    form.login_validated,
    form.email_validated,
    signin || check_password(form.elements[0])
  );
  if (signin || form.checkValidity()) {
    if (form.login_validated && form.email_validated && (signin || check_password(form))) {
      let data = new FormData(form);
      if (data.get("reg") === "false") {
        data.delete("email");
      }
      data = [...data].reduce((acc, el) => ((acc[el[0]] = el[1]), acc), {});
      console.log(JSON.stringify(data));
      fetch(form.action, {
        method: "post",
        "content-type": "application/json",
        body: JSON.stringify(data)
      }).then(result =>
        result.json().then(response => {
          user_message(response.message);
          if (response.code === 200) {
            if (form.elements["returnpath"]) {
              document.location.href = form.elements["returnpath"];
            } else {
              document.location.reload();
            }
          }
        })
      );
    }
  } else {
    user_message("Заполните все поля");
  }
}

async function check_validity(me) {
  me.form.login_validated = await check_username(
    me.form.elements["username"],
    me.form.email_validated
  );
  me.form.email_validated = await check_email(me.form.elements["email"], me.form.login_validated);
}

async function check_validity_combined(me) {
  // if (/.*@.*/.test(me.value)) {
  //   me.form.email_validated = await check_email(me, true);
  //   alert(await me.form.email_validated);
  //   me.form.login_validated = await me.form.email_validated;
  // } else {
  //   me.form.login_validated = await check_username(me, true);
  //   me.form.email_validated = await me.form.login_validated;
  // }
  // setTimeout(hide_user_message, 0);
  me.form.email_validated = true;
  me.form.login_validated = true;
}

async function check_username(input, hide_message = true) {
  let username = input.value;
  let flag = true;
  let response = await fetch(input.form.action, {
    method: "POST",
    body: JSON.stringify({ username: username }),
    headers: {
      "Content-Type": "application/json"
    }
  });
  let data = await response.json();

  if (data.userfound) {
    user_message("Имя пользователя уже занято");
    flag = false;
    alert(data.userfound);
  } else if (hide_message) {
    hide_user_message();
  }
  return flag;
}

async function check_email(input, hide_message = true) {
  let email = input.value;
  let flag = true;
  let response = await fetch(input.form.action, {
    method: "POST",
    body: JSON.stringify({ email: email }),
    headers: {
      "Content-Type": "application/json"
    }
  });
  let data = response.json();
  if (data.userfound) {
    user_message("Email уже зарегистрирован");
    flag = false;
  } else if (hide_message) {
    hide_user_message();
  }
  return flag;
}

function check_password(form) {
  event.preventDefault();
  let password = document.getElementById("password").value;
  if (password !== document.getElementById("repeat_password").value) {
    password_message("Пароли не совпадают");
    form.password_validated = false;
    return false;
  }
  let password_reqexp = new RegExp(
    `^(?=([a-zA-Z0-9_]{8,}))(?=.*[0-9])${
      document.getElementById("name").value !== ""
        ? `(?!.*${document.getElementById("name").value})`
        : ""
    }(?=.*[A-Z]).*$`
  );
  if (!password_reqexp.test(password)) {
    password_message(
      `Не соблюдены требования к паролю:
      <ul>
      <li>Только латинские буквы, цифры и знак подчеркивания</li>
      <li>Не менее 8 символов</li>
      <li>Не содержит логина пользователя</li>
      <li>Содержит цифры и заглавные буквы</li>
      </ul>`
    );
    form.password_validated = false;
    return false;
  }
  hide_password_message();
  form.password_validated = true;
  return true;
}

function user_message(text) {
  let message = document.getElementById("user_error");
  if (message) {
    message.getElementsByClassName("message")[0].innerHTML = text;
    message.classList.remove("hidden");
  }
}

function hide_user_message() {
  let message = document.getElementById("user_error");
  if (message) {
    message.classList.add("hidden");
  }
}

function password_message(text) {
  let message = document.getElementById("password_error");
  if (message) {
    message.getElementsByClassName("message")[0].innerHTML = text;
    message.classList.remove("hidden");
  }
  // setTimeout(() => {
  //   message.classList.add("hidden");
  // }, 3000);
}

function hide_password_message() {
  let message = document.getElementById("password_error");
  if (message) {
    message.classList.add("hidden");
  }
}
