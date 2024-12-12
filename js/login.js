function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");

    var isValid = true;

    var usernameRegex = /^[a-zA-Z0-9_]{6,}$/;
    if (!usernameRegex.test(username)) {
        usernameError.textContent = "Tên đăng nhập phải có ít nhất 6 ký tự, chỉ bao gồm chữ cái, số và dấu gạch dưới.";
        usernameError.style.display = "block";
        isValid = false;
    } else {
        usernameError.style.display = "none";
    }

    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (!passwordRegex.test(password)) {
        passwordError.textContent = "Mật khẩu phải có ít nhất 8 ký tự, bao gồm một chữ cái viết hoa, một chữ cái viết thường và một chữ số.";
        passwordError.style.display = "block";
        isValid = false;
    } else {
        passwordError.style.display = "none";
    }
    return isValid;
}

const checkLogin = (login, message) => {
    var note = document.getElementById("note");
    if (login === true) {
        note.textContent = message;
        note.style.color = "green";
        note.style.display = 'block';
    } else {
        note.textContent = message;
        note.style.color = "red";
        note.style.display = 'block';
    }
}
