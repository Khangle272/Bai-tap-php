<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Ajax Fetch</title>
</head>
<body>
    <h2>Gửi dữ liệu bằng Fetch API</h2>
    <button id="btnSend">Gửi yêu cầu tới Server</button>
    
    <p id="result" style="color: green; font-weight: bold;"></p>

    <script>
        document.getElementById("btnSend").addEventListener("click", function() {
            fetch("process.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "name=Khang&age=21"
            })
            .then(res => res.text())
            .then(data => {
                console.log("Phản hồi từ server:", data);
                
                document.getElementById("result").innerText = data;
            })
            .catch(error => {
                console.error("Có lỗi xảy ra:", error);
            });
        });
    </script>
</body>
</html>