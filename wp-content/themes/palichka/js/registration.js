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
