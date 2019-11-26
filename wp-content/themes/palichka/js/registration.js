function check_username(input) {
  let username = input.value;
  fetch(input.form.action, {
    method: "POST",
    body: JSON.stringify({ username: username }),
    headers: {
      "Content-Type": "application/json"
    }
  })
    .then(response => {
      response
        .json()
        .then(data =>
          data.userfound ? user_message("Имя пользователя уже занято") : hide_user_message()
        );
    })
    .catch(message => user_message(message));
}

function check_email(input) {
  let email = input.value;
  fetch(input.form.action, {
    method: "POST",
    body: JSON.stringify({ email: email }),
    headers: {
      "Content-Type": "application/json"
    }
  })
    .then(response => {
      response
        .json()
        .then(data =>
          data.userfound ? user_message("Email уже зарегистрирован") : hide_user_message()
        );
    })
    .catch(message => user_message(message));
}

function check_password() {
  event.preventDefault();
  let password = document.getElementById("password").value;
  if (password !== document.getElementById("repeat_password").value) {
    password_message("Пароли не совпадают");
    return;
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
    return;
  }
  hide_password_message();
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
