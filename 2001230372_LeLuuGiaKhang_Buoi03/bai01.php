<!DOCTYPE html>
<html>

<body>
    <h2 id="msg"></h2>
    <script>
        document.getElementById("msg").innerText = "Hello JavaScript";
    </script>
</body>

</html>

<!DOCTYPE html>
<html>

<body>
    <div id="info"></div>
    <script>
        let name = "Khang";
        let age = 21;
        console.log(name, age);
        document.getElementById("info").innerHTML = `Tên: ${name}, Tuổi: ${age}`;
    </script>
</body>

</html>

<!DOCTYPE html>
<html>

<body>
    <input type="number" id="age" placeholder="Nhập tuổi">
    <button onclick="checkAge()">Kiểm tra</button>
    <p id="result"></p>

    <script>
        function checkAge() {
            let age = document.getElementById("age").value;
            if (age >= 18) {
                document.getElementById("result").innerText = "Bạn đã đủ tuổi";

            } else {
                document.getElementById("result").innerText = "Bạn chưa đủ tuổi";
            }
        }
    </script>
</body>

</html>