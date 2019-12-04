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
    user_message(input.form, "Заполните все поля");
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
  if (/.*@.*/.test(me.value)) {
    me.form.email_validated = await check_email(me, true);
    me.form.login_validated = await me.form.email_validated;
  } else {
    me.form.login_validated = await check_username(me, true);
    me.form.email_validated = await me.form.login_validated;
  }
  setTimeout(hide_user_message, 0);
}

async function check_username(input, hide_message = true) {
  let username = input.value;
  if (username !== "" && !/[a-zA-Z][a-zA-Z0-9_]{3,14}/.test(username)) {
    user_message(
      input.form,
      `<ul>Логин не соответствует требованиям:
        <li>Должен состоять из латинских букв, цифр, знака подчеркивания</li>
        <li>Первый символ - не цифра и не знак подчеркивания</li>
        <li>Длиной от 4 до 15 символов</li>
      </ul>`
    );
    return false;
  }
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
    user_message(input.form, "Имя пользователя уже занято");
    flag = false;
  } else if (hide_message) {
    hide_user_message(input.form);
  }
  return flag;
}

async function check_email(input, hide_message = true) {
  let email = input.value;
  if (email !== "" && !/[a-zA-Z][a-zA-Z0-9_.-]*@[a-zA-Z0-9_.-]+.[a-z]+/.test(email)) {
    user_message(input.form, `Введите правильный Email`);
    return false;
  }
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
    user_message(input.form, "Email уже зарегистрирован");
    flag = false;
  } else if (hide_message) {
    hide_user_message(input.form);
  }
  return flag;
}

function check_password(form) {
  event.preventDefault();
  let password = document.getElementsByClassName("password").value;
  if (password !== document.getElementsByClassName("repeat_password").value) {
    password_message(input.form, "Пароли не совпадают");
    form.password_validated = false;
    return false;
  }
  let password_reqexp = new RegExp(
    `^(?=([a-zA-Z0-9_]{8,}))(?=.*[0-9])${
      document.getElementsByClassName("name").value !== ""
        ? `(?!.*${document.getElementsByClassName("name").value})`
        : ""
    }(?=.*[A-Z]).*$`
  );
  if (!password_reqexp.test(password)) {
    password_message(
      input.form,
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
  hide_password_message(input.form);
  form.password_validated = true;
  return true;
}

function user_message(form, text) {
  let message = form.getElementsByClassName("user_message")[0];
  if (message) {
    message.getElementsByClassName("message")[0].innerHTML = text;
    message.classList.remove("hidden");
  }
}

function hide_user_message(form) {
  let message = form.getElementsByClassName("user_message")[0];
  if (message) {
    message.classList.add("hidden");
  }
}

function password_message(form, text) {
  let message = form.getElementsByClassName("password_error")[0];
  if (message) {
    message.getElementsByClassName("message")[0].innerHTML = text;
    message.classList.remove("hidden");
  }
  // setTimeout(() => {
  //   message.classList.add("hidden");
  // }, 3000);
}

function hide_password_message(form) {
  let message = form.getElementsByClassName("password_error");
  if (message) {
    message.classList.add("hidden");
  }
}
