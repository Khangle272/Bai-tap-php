<!DOCTYPE html>
<html>

<body>
    <img id="img" src="img1.jpg" width="200" onmouseover="this.src='img2.jpg'" onmouseout="this.src='img1.jpg'">
</body>

</html>

<!DOCTYPE html>
<html>

<br>

<body>
    <form onsubmit="return validateEmail()">
        <input type="text" id="email" placeholder="Nhập email">
        <button type="submit">Kiểm tra</button>
    </form>
    <p id="msg"></p>
    <script>
        function validateEmail() {
            let email = document.getElementById("email").value;
            let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (regex.test(email)) {
                document.getElementById("msg").innerText = "Email hợp lệ";
            } else {
                document.getElementById("msg").innerText = "Email không hợp lệ";

            }
            return false;
        }
    </script>
</body>

</html>

<br>

<!DOCTYPE html>
<html>

<body>
    <h1 id="clock"></h1>

    <script>
        function updateClock() {
            let now = new Date();
            document.getElementById("clock").innerText =

                now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>

</html>