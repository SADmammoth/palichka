function check_submit(button) {
  event.preventDefault();
  alert(me.form.email_validated);
  if (button.from.validate()) {
    if (
      button.form.login_validated &&
      button.form.email_validated &&
      button.form.password_validated
    ) {
      button.form.submit();
    }
  } else {
    user_message("Заполните все поля");
  }
}

async function check_validity(me) {
  me.form.login_validated = await check_username(
    me.form.elements["login"],
    !me.form.email_validated
  );
  me.form.email_validated = await check_email(me.form.elements["email"], !me.form.login_validated);
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
  response
    .json()
    .then(data => {
      if (data.userfound) {
        user_message("Имя пользователя уже занято");
        flag = false;
      } else {
        if (hide_message) {
          hide_user_message();
        }
      }
    })
    .catch(message => {
      user_message(message);
      flag = false;
    });
  return flag;
}

async function check_email(input, hide_message = true) {
  let email = input.value;
  input.form.email_validated = false;
  let flag = false;
  let response = await fetch(input.form.action, {
    method: "POST",
    body: JSON.stringify({ email: email }),
    headers: {
      "Content-Type": "application/json"
    }
  });
  response
    .json()
    .then(data => {
      if (data.userfound) {
        user_message("Email уже зарегистрирован");
        flag = false;
      } else {
        if (hide_message) {
          hide_user_message();
        }
      }
    })
    .catch(message => {
      user_message(message);
      flag = false;
    });
  return flag;
}

function check_password(button) {
  event.preventDefault();
  let password = document.getElementById("password").value;
  if (password !== document.getElementById("repeat_password").value) {
    password_message("Пароли не совпадают");
    button.from.password_validated = false;
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
    button.from.password_validated = false;
    return false;
  }
  hide_password_message();
  button.from.password_validated = true;
  return true;
}

function user_message(text) {
  let message = document.getElementById("user_error");
  message.getElementsByClassName("message")[0].innerHTML = text;
  message.classList.remove("hidden");
}

function hide_user_message() {
  let message = document.getElementById("user_error");
  message.classList.add("hidden");
}

function password_message(text) {
  let message = document.getElementById("password_error");
  message.getElementsByClassName("message")[0].innerHTML = text;
  message.classList.remove("hidden");
  // setTimeout(() => {
  //   message.classList.add("hidden");
  // }, 3000);
}

function hide_password_message() {
  let message = document.getElementById("password_error");
  message.classList.add("hidden");
}
